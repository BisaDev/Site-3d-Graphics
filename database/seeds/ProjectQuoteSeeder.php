<?php

use Illuminate\Database\Seeder;
use App\ProjectQuote;
use App\Project;


class ProjectQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::all()->each(function ($project) {
            $quote = factory(ProjectQuote::class)->create();

            $project->addSection(ProjectQuote::class, $quote->id);
        });
    }
}
