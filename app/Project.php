<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Project's Client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Project services.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * Registers a new section for this project.
     *
     * @param  string $modelClass
     * @param  int $modelId
     * @param  string $component
     */
    public function addSection($modelClass, $modelId, $component)
    {
        $this->sections()->save(
            new ProjectSection([
                'model_id' => $modelId,
                'component' => $component,
                'model_class' => $modelClass,
            ])
        );
    }

    /**
     * Collection of additional text information for this project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(ProjectSection::class);
    }
}
