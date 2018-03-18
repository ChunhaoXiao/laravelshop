<?php
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        //
        'name' => 'sdfsdfsdfdssssssssss',
        'product_sn' => $faker->randomNumber(),
        'category_id' => 7,

        'price' => 1000,
        'brief' =>'sadfsdfsdfsdfasdfasdfasdf',
        'sales' => 100,
        'number'=>6,
       // 'description' => 'ssssssssssssssssssssssssssssssssssssssssssssss',

    ];
});
