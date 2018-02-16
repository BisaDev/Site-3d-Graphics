<?php

use App\Project;
use App\ProjectGallery;
use Faker\Generator as Faker;

$factory->define(ProjectGallery::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory(Project::class)->create()->id;
        },
    ];
});
