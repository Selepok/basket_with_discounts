<?php

use Faker\Generator as Faker;

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

$factory->define(App\BasketItem::class, function (Faker $faker) {
    return [
        'basket_id' => 1,
        'product_id' => $faker->unique()->numberBetween(1,100),
        'quantity' => $faker->unique()->numberBetween(1,10),
        'price' => $faker->unique()->numberBetween(1,1000),
    ];
});
