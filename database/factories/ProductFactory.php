<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => substr($faker->sentence(3), 0, -1),
        'description' => ucfirst($faker->sentence(10)),
        'long_description' => $faker->text,
        'price' => $faker->randomFloat(2, 350, 1500),

        'category_id' => $faker->numberBetween(1, 5)
    ];
});
