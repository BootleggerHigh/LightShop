<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->text,
        'code'=>$faker->countryCode,
        'description'=>$faker->text,
        'price'=>$faker->numberBetween(100,4000),
        'is_hit'=>$faker->numberBetween(0,1),
        'is_new'=>$faker->numberBetween(0,1),
        'is_recommend'=>$faker->numberBetween(0,1),
        'product_count'=>$faker->numberBetween(0,10),
        'product_count_reserve'=>0,
        'name_en'=>$faker->text,
        'description_en'=>$faker->text,
    ];
});
