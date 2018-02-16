<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App
 */
class Project extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'preloader',
        'hero_image',
        'hero_image_preview',
        'hero_color',
        'info_subtitle',
        'info_description',
        'start_date',
        'end_date',
        'country_id',
        'client_id',
        'is_featured',
    ];

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
     */
    public function addSection($modelClass, $modelId)
    {
        $this->sections()->save(
            new ProjectSection([
                'model_id' => $modelId,
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

    //Scope a query to only include feature projects.
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
}
