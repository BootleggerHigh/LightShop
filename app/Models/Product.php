<?php

namespace App\Models;

use App\Services\Classes\CurrencyCode;
use App\Services\Traits\LocalizationShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes,LocalizationShop;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function getAllSumProduct()
    {
        return $this->price * $this->pivot->count;
    }

    protected function getCategory()
    {
        $category = Category::getAllCategory();
        return $category;
    }

    protected function setIsHitAttribute($value)
    {
        return $this->attributes['is_hit'] = $value ? true : false;
    }

    protected function setIsNewAttribute($value)
    {
        return $this->attributes['is_new'] = $value ? true : false;
    }

    protected function setIsRecommendAttribute($value)
    {
        return $this->attributes['is_recommend'] = $value ? true : false;
    }

    protected function checkFilter($params)
    {
        foreach (['is_hit', 'is_new', 'is_recommend'] as $fieldName) {
            if (!isset($params[$fieldName])) {
                $params[$fieldName] = false;
            }
        }
        return $params;
    }

    public function IsAvailable()
    {
       return $this->product_count  > 0;
    }

    public function isHit()
    {
        return $this->is_hit === 1;
    }

    public function isNew()
    {
        return $this->is_new === 1;
    }

    public function isRecommend()
    {
        return $this->is_recommend === 1;
    }

    protected function getProductFilterbyTagAndPrice($params)
    {
        $query_products = $this->query();
        if ($params->filled('price_from')) {
            $query_products->where('price', '>=', $params->price_from);
        }
        if ($params->filled('price_to')) {
            $query_products->where('price', '<=', $params->price_to);
        }

        foreach (['is_hit', 'is_new', 'is_recommend'] as $fieldName) {
            if ($params->has($fieldName)) {
                $query_products->where($fieldName, true);
            }
        }
        return $query_products->simplePaginate(9);
    }

    public function setCountProductAndReserveCountProduct()
    {
      return  $this->product_count - $this->pivot->count > 0 ? true : 'disabled=disabled';
    }
    public function getPriceAttribute($value)
    {
        return round(CurrencyCode::convert($value),2);
    }

}
