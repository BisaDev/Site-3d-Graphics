<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => 'Service Name',
        'icon' => '_service-icon-test.png',
    ];
});
