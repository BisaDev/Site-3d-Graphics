<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
