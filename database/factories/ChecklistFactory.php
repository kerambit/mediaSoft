<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Checklist;
use App\User;
use Faker\Generator as Faker;

$factory->define(Checklist::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::Class)->create()->id;
        },
        'title' => $faker->sentence(5),
    ];
});
