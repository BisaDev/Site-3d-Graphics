<?php

use App\ProjectGallery;
use App\ProjectGalleryImage;
use Faker\Generator as Faker;

$factory->define(ProjectGalleryImage::class, function (Faker $faker) {
    $size = $faker->randomElement($array = array([100, 800], [400, 1200]));
    return [
        'project_gallery_id' => function () {
            return factory(ProjectGallery::class)->create()->id;
        },
        'image' => '/images/plateiq.png', // @todo: Use an appropriate image factory for transparent images
        'color' => $faker->hexColor,
        'background_size' => $faker->randomElement(['cover', 'contain']),
        'width' => $size[0],
        'height' => $size[1],
    ];
});
