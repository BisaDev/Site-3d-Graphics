<?php

use App\Project;
use App\ProjectGallery;
use App\ProjectGalleryImage;
use Illuminate\Database\Seeder;

class ProjectGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::all()->each(function ($project) {
            $gallery = factory(ProjectGallery::class)->create(['project_id' => $project->id]);
            factory(ProjectGalleryImage::class, 5)->create(['project_gallery_id' => $gallery->id]);

            $project->addSection(ProjectGallery::class, $gallery->id);
        });
    }
}
