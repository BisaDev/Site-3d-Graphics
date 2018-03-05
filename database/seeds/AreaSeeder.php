<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
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
                'name' => 'Design',
                'description' => 'We have worked with companies in Mexico, the US, Germany, the Netherlands, Australia and are planning for continued growth in the coming quarter across all our practices.'
            ],
            [
                'name' => 'Software',
                'description' => 'We have worked with companies in Mexico, the US, Germany, the Netherlands, Australia and are planning for continued growth in the coming quarter across all our practices.'
            ],
            [
                'name' => '3D & VR',
                'description' => 'We have worked with companies in Mexico, the US, Germany, the Netherlands, Australia and are planning for continued growth in the coming quarter across all our practices.'
            ],
        ])->each(function ($area) {
            factory(App\Area::class)->create(['name' => $area['name'], 'description' => $area['description']]);
        });
    }
}
