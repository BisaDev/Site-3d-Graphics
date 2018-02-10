<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'description' => $faker->text(50),
        'preloader' => $faker->text(50),
        'hero_image' => 'plateiq.png',
        'hero_image_preview' => 'plateiq.png',
        'hero_color' => $faker->hexColor,

        //'info_title' => $faker->text(140),
        'info_subtitle' => $faker->text(140),
        'info_description' => $faker->text(300),
        'start_date' => $faker->date(),
        'end_date' =>  $faker->date(),
        //'info_year' => '2015 - 2018',
        //'info_country' => 'usa',

        'country_id' => 1, //@todo select random country

        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
    ];
});
