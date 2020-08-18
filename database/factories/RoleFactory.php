<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => 'BasicUser'
    ];
});

$factory->state(Role::class, 'Admin', [
    'name' => 'Admin',
]);

$factory->state(Role::class, 'Manager', [
    'name' => 'Manager',
]);

