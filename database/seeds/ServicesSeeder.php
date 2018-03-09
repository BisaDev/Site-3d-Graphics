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
        $areas = \App\Area::all()->toArray();
        collect([
            [
                'name' => 'Branding',
                'area_id' => $areas[0]['id'],
            ],
            [
                'name' => 'Illustration',
                'area_id' => $areas[0]['id'],
            ],
            [
                'name' => 'UI Design',
                'area_id' => $areas[0]['id'],
            ],
            [
                'name' => 'UX Design',
                'area_id' => $areas[0]['id'],
            ],
            [
                'name' => 'Back End',
                'area_id' => $areas[1]['id'],
            ],
            [
                'name' => 'Front End',
                'area_id' => $areas[1]['id'],
            ],
            [
                'name' => 'App Development',
                'area_id' => $areas[1]['id'],
            ],
            [
                'name' => 'Installation',
                'area_id' => $areas[2]['id'],
            ],
            [
                'name' => 'Game Design & Development',
                'area_id' => $areas[2]['id'],
            ],
            [
                'name' => '3D Modeling & Rendering',
                'area_id' => $areas[2]['id'],
            ],
        ])->each(function ($service) {
            factory(App\Service::class)->create(['name' => $service['name'], 'area_id' => $service['area_id'] ]);
        });
    }
}
