<?php

/* @var $factory Factory */

use App\Visit;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'begin_hour' => $faker->time($format = 'H:i:s'),
        'end_hour' => $end,
        'visit_date' => $faker->date($format = 'Y-m-d'),
        'duration' => $faker->word
    ];
});
