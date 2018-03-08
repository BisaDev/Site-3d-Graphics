<?php

use App\Project;
use Faker\Generator as Faker;
use App\ProjectTextInformation;

$factory->define(ProjectTextInformation::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory(Project::class)->create()->id;
        },
        'title' => $faker->text(255),
        'body' => $faker->text(300),
    ];
});
