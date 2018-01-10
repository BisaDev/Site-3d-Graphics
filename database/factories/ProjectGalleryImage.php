<?php

use App\ProjectGallery;
use App\ProjectGalleryImage;
use Faker\Generator as Faker;

$factory->define(ProjectGalleryImage::class, function (Faker $faker) {
    return [
        'project_gallery_id' => function () {
            return factory(ProjectGallery::class)->create()->id;
        },
        'image' => '_project-gallery-image-text.jpg',
    ];
});
