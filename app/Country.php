<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App
 */
class Country extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    public $timestamps = false;

    /**
     * Country related Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
