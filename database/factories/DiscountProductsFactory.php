<?php

use Faker\Generator as Faker;
use App\Library\Services\AbstractDiscount;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\DiscountProducts::class, function (Faker $faker) {
    return [
        'discount_id' => $faker->unique()->numberBetween(1,100),
        'product_id'  => $faker->unique()->numberBetween(1,1000)
    ];
});
