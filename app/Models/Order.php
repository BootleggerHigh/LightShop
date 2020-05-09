<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\Exception\LogicException;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class Order extends Model
{

    protected $fillable = ['name', 'phone', 'status'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count', 'product_id')->withTimestamps();
    }

    public function getAllCostProduct()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getAllSumProduct();
        }
        $this->amount = $sum;
        $this->save();
        return $sum;
    }

    /**
     * Получение имени продукта в корзине, для flash уведомления о добавлении/удалении продукта в корзине;
     * @param $product_ID
     * @param $key
     * @return mixed
     */
    protected function getNameProductInOrder($product_ID, $key)
    {
        $order = $this->checkOrderOrCreateOrderAndSessionOrGetOrder($key);
        return $order->products->where('id', $product_ID)->first()->name;
    }

    /**
     * Для пользователя :
     *
     * Проверка существования сессии,в случае отсутствие сессии вызывается getCreateSessionAndModel;
     * В случае отсутствие сессии и вызова маршрута корзины,во избежании пустых строк,запись  не будет создана в NULL;
     * getCreateSessionAndModel нужен для создания сессии и корзины.
     *
     * Для Администратора :
     * Ключ Сессии count всегда будет сброшен. Администратор получает из БД ордер и его отношения.
     * @param $key
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    protected function checkOrderOrCreateOrderAndSessionOrGetOrder($key, $basket = null)
    {
        if (is_numeric($key)) {
            Session::forget(['count', $key]);
            return $this->with('products')->where('id', $key)->first();
        } else {
            if (is_null($basket) && is_null(session()->get($key))) {
                return $this->getCreateSessionAndModel($key);
            } else {
                if (!is_null(session()->get($key))) {

                    $order = $this->with('products')->where('id', session()->get($key))->first();
                    return $order ?? $this->getCreateSessionAndModel($key);
                } else {
                    return $this->getCreateSessionAndModel($key);
                }
            }
        }

    }

    /** Создания сессии и корзины
     * @param $key
     * @return object
     */
    private function getCreateSessionAndModel($key): object
    {
        $order = $this->create();
        Session::put($key, $order->id);
        Session::save();
        return $order->with('products')->latest()->first();
    }

    /**
     * Проверка существования сессии;
     * Изменения количества продукта в корзине;
     * @param $key
     * @param null $product_id
     * @param null $incrementCount
     * @return bool
     */
    protected function checkOrCreateSessionOrModelAndSetModelAndCountProducts(
        $key,
        $product_id = null,
        $incrementCount = null
    ): bool {
        $order = $this->checkOrderOrCreateOrderAndSessionOrGetOrder($key);
        if ($this->setModelAndCount($order, $product_id, $incrementCount)) {
            return true;
        }
        return false;
    }

    /**
     * Проверка существования продукта в корзине,в случае отсутствия добавляется данный продукт в корзину
     * @param $order
     * @param $productId
     * @param $incrementCount
     * @return bool
     */
    private function setModelAndCount($order, $productId, $incrementCount): bool
    {
        if ($order->products->contains($productId)) {
            $pivot = $order->products->where('id', $productId)->first()->pivot;
            $this->getManipulationsCount($order, $pivot, $incrementCount, $productId);
        } else {
            $order->products()->attach($productId);
            $order->load('products');
        }
        session(['count' => $order->products()->sum('count')]);
        return true;
    }

    /**
     * Взависимости от состояния $incrementCount определяется увеличение или уменьшения количества продукта в корзине;
     * В случае, когда количество продукта меньше одного - из корзины удаляется данный продукт и удаляется
     * ключ сессии count.
     * session('count') определяет общее, текущее, количество в корзине
     * @param $order
     * @param $pivot
     * @param $incrementCount
     * @param $productId
     */
    private function getManipulationsCount($order, $pivot, $incrementCount, $productId)
    {
        if ($incrementCount) {
            $pivot->count++;
            $pivot->update();
        } else {
            if ($pivot->count > 1) {
                $pivot->count--;
                $pivot->save();
            } else {
                $order->products()->detach($productId);
                session()->forget(['count']);
            }
        }

    }

    /**
     * Создания ордера,сохранение записи в БД об ордере;
     * удаление ключа корзины и  общего, текущего, количества в корзине
     * @param $request
     * @param $model
     * @param $key
     * @param $order
     * @return bool
     */
    protected function saveOrder($request, $model, $key)
    {
        if (session()->get('count') > 0) {
            session()->forget(['count']);
            DB::beginTransaction();
                try {
                    foreach ($model->products as $product) {
                        $product->lockForUpdate();
                        if ($product->product_count < $product->pivot->count) {
                            throw new LogicException();
                        }
                        $product->increment('product_count_reserve', $product->pivot->count);
                        $product->decrement('product_count', $product->pivot->count);
                    }
                        $model->name = $request->name;
                        $model->phone = $request->phone;
                        $model->email = $request->email;
                        $model->amount = $model->getAllCostProduct();
                        $model->save();
                    session()->forget([$key]);
                        DB::commit();
                }
                catch (\LogicException $e) {
                    DB::rollBack();
                    $model->delete();
                    return false;
                }
                return true;
        }
        return false;
    }

    /**
     * Изменяет количество товара в заказе из админки.
     * @param $order
     * @param $productId
     * @param $incrementCount
     * @return bool
     */
    protected function adminEditOrder($order, $productId, $incrementCount)
    {
        $order = $this->checkOrderOrCreateOrderAndSessionOrGetOrder($order)->first();
        $this->setModelAndCount($order, $productId, $incrementCount);
        return true;
    }

    protected static function getUsersEmail()
    {
        return Auth::user()->email;
    }

    protected function checkIsOrder($order)
    {
        if (!$order->getAllCostProduct()) {
            return false;
        }
        return true;
    }

    public function getCountReserveProductsDecrementAttribute()
    {
        foreach ($this->products as $product) {
            $product->decrement('product_count_reserve', $product->pivot->count);
        }
    }

    public function getCountProductsIncrementAttribute()
    {
        foreach ($this->products as $product) {
            $product->increment('product_count', $product->pivot->count);
        }
    }
}
