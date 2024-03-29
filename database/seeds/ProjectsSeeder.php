<?php

use App\Client;
use App\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::all()->each(function ($client) {
            factory(Project::class)->create(['client_id' => $client->id]);
        });
    }
}
