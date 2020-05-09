<?php

namespace App\Models;

use App\Services\Traits\LocalizationShop;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use LocalizationShop;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function getAllCategory()
    {
        return self::all('name', 'id');
    }
}
