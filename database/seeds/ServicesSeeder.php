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
            'Graphic design',
            'Branding',
            'UI Design',
            'Backend',
            'Frontend',
            'UX Design',
        ])->each(function ($service) {
            factory(App\Service::class)->create(['name' => $service]);
        });
    }
}
