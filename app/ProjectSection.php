<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSection extends Model
{
    /**
     * The model representing the project section.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = null;

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = ['id', 'component', 'model'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['model'];

    /**
     * Get the model instance associated to this project section, the instance
     * is cached, if you need to refresh it call loadModel() method instead.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getModelAttribute()
    {
        if ($this->model === null) {
            $this->loadModel();
        }

        return $this->model;
    }

    /**
     * Search the model information in database and assign the model instance to
     * the "model" property.
     */
    public function loadModel()
    {
        $this->model = $this->model_class::find($this->model_id);
    }
}
