<?php

use App\ProjectGallery;
use App\ProjectGalleryImage;
use Faker\Generator as Faker;

$factory->define(ProjectGalleryImage::class, function (Faker $faker) {
    return [
        'project_gallery_id' => function () {
            return factory(ProjectGallery::class)->create()->id;
        },
        'image' => '/images/plateiq.png', // @todo: Use an appropriate image factory for transparent images
        'color' => $faker->hexColor,
    ];
});
