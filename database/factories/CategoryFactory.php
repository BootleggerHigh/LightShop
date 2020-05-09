<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->text,
        'code'=>$faker->countryCode,
        'description'=>$faker->text,
        'name_en'=>$faker->text,
        'description_en'=>$faker->text,
    ];
});
