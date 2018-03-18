<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Productinfo::class, function (Faker $faker) {
    return [
        'description' => '描述描述描述描述～～～',
    ];
});
