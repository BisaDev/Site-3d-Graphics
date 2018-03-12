<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model {
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @var array
     */
    //protected $appends = ['projects'];

    /**
     * Tag related Services
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services() {
        return $this->hasMany( Service::class );
    }

    /**
     * Project Many => Many Services 1 => Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getProjectsAttribute() {
        //@todo Refactor implementing hasManyThrough if possible
        //@todo "with and appends" issue: https://github.com/laravel/framework/issues/20106
        $projects = [];

        $this->services->each( function ( $services ) use ( &$projects ) {
            $services->projects->map( function ( $project ) use ( &$projects ) {
                $currentProject = [
                    'id'                 => $project->id,
                    'is_featured'        => $project->is_featured,
                    'name'               => $project->name,
                    'description'        => $project->description,
                    'hero_image'         => $project->hero_image,
                    'hero_image_preview' => $project->hero_image_preview,
                    'hero_color'         => $project->hero_color,
                    'slug'               => $project->slug,
                    'preloader'          => $project->preloader,
                    'is_dark'            => $project->is_dark,
                ];
                $projects[$project->id] = $currentProject;
                return $project;
            } );
        } );
        $projects = array_values($projects);
        usort ( $projects , function($project_a) {
            return $project_a['is_featured']  ? -1 : 1;
        });
        return $projects;
    }
}
