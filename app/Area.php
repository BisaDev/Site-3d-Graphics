<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
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
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Project Many => Many Services 1 => Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getProjectsAttribute()
    {
        //@todo Refactor implementing hasManyThrough if possible
        //@todo "with and appends" issue: https://github.com/laravel/framework/issues/20106
        $projects = [];

        $this->services->each(function($services) use(&$projects) {
            $services->projects->map(function($project) use(&$projects){
                $projects[] = ['id' => $project->id, 'name' => $project->name,];
                return [ 'id' => $project->id,'name' => $project->name,];
            });
        });

        return $projects;
    }
}
