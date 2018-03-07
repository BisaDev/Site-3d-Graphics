<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'description' => $faker->text(50),
        'preloader' => $faker->text(50),
        'hero_image' => '/images/plateiq.png', // @todo: Use an appropriate image factory for transparent images
        'hero_image_preview' => '/images/plateiq.png', // @todo: Use an appropriate image factory for transparent images
        'hero_color' => $faker->hexColor,
        'is_dark' => $faker->boolean($chanceOfGettingTrue = 40),
        'is_featured' => $faker->boolean($chanceOfGettingTrue = 20),

        'info_subtitle' => $faker->text(140),
        'info_description' => $faker->text(300),
        'start_date' => $faker->date(),
        'end_date' =>  $faker->date(),

        'country_id' => 1, //@todo select random country

        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
    ];
});
