<?php

use App\Project;
use App\ProjectTextInformation;
use Illuminate\Database\Seeder;

class ProjectTextInformationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::all()->each(function ($project) {
            $textInformation = factory(ProjectTextInformation::class)->create([
                'project_id' => $project->id,
            ]);

            $project->addSection(ProjectTextInformation::class, $textInformation->id);
        });
    }
}
