<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Branding',
                'area_id' => 1,
            ],
            [
                'name' => 'Illustration',
                'area_id' => 1,
            ],
            [
                'name' => 'UI Design',
                'area_id' => 1,
            ],
            [
                'name' => 'UX Design',
                'area_id' => 1,
            ],
            [
                'name' => 'Back End',
                'area_id' => 2,
            ],
            [
                'name' => 'Front End',
                'area_id' => 2,
            ],
            [
                'name' => 'App Development',
                'area_id' => 2,
            ],
            [
                'name' => 'Installation',
                'area_id' => 3,
            ],
            [
                'name' => 'Game Design & Development',
                'area_id' => 3,
            ],
            [
                'name' => '3D Modeling & Rendering',
                'area_id' => 3,
            ],
        ])->each(function ($service) {
            factory(App\Service::class)->create(['name' => $service['name'], 'area_id' => $service['area_id'] ]);
        });
    }
}
