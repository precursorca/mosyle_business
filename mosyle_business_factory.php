<?php

// Database seeder
// Please visit https://github.com/fzaninotto/Faker for more options

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Mosyle_business_model::class, function (Faker\Generator $faker) {

    return [
        'version' => $faker->word(),
        'org_name' => $faker->word(),
        'attempt_date' => $faker->word(),
        'success_date' => $faker->word(),
        'location_enabled' => $faker->boolean(),
    ];
});
