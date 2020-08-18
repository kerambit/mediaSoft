<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\Checklist;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'checklist_id' => function () {
            return factory(Checklist::Class)->create()->id;
        },
        'user_id' => function () {
            return factory(Checklist::Class)->create()->user_id;
        },
        'text' => $faker->sentence(4),
        'checked' => $faker->numberBetween($min = 0, $max = 1),
    ];
});
