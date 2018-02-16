<?php

use App\Project;
use App\Service;
use Illuminate\Database\Seeder;

class ProjectServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicesIds = Service::all()->pluck('id');

        Project::all()->each(function ($project) use ($servicesIds) {
            $project->services()->sync($servicesIds);
        });
    }
}
