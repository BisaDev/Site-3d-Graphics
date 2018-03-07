<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\ProjectStickySection;

class ProjectStickySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::all()->each(function ($project) {
            $stickySection = factory(ProjectStickySection::class)->create([
                'project_id' => $project->id,
            ]);

            $project->addSection(ProjectStickySection::class, $stickySection->id);
        });
    }
}
