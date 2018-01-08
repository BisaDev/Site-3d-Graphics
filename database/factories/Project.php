<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'description' => $faker->text(50),
        'preloader' => $faker->text(50),
        'hero_image' => '_project-test.png',
        'hero_color' => $faker->hexColor,

        'info_title' => $faker->text(140),
        'info_description' => $faker->text(300),
        'info_year' => '2015 - 2018',
        'info_country' => 'usa',

        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
    ];
});
