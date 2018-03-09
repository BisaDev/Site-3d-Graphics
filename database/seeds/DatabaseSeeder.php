<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all tables
        Artisan::call('migrate:refresh');

        $this->call(UserSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(ProjectsSeeder::class);
        $this->call(ProjectServiceSeeder::class);
        $this->call(ProjectQuoteSeeder::class);
        $this->call(ProjectGallerySeeder::class);
        $this->call(ProjectTextInformationsSeeder::class);
        $this->call(ProjectStickySeeder::class);

    }
}
