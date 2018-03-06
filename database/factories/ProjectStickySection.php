<?php

use App\Project;
use Faker\Generator as Faker;
use App\ProjectStickySection;

$factory->define(ProjectStickySection::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory(Project::class)->create()->id;
        },
        'body' => $faker->text(600),
        'image' => '/uploads/images/'.$faker->image(public_path('uploads/images'), 200, 800, null, false),
    ];
});
