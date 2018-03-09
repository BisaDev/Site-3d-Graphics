<?php

use Faker\Generator as Faker;
use App\Project;
use App\ProjectQuote;


$factory->define(ProjectQuote::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory(Project::class)->create()->id;
        },
        'body' => $faker->text(300),
        'author' => $faker->name(),
        'title' => $faker->text(191),
    ];
});
