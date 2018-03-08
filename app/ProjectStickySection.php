<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectStickySection
 * @package App
 */
class ProjectStickySection extends Model
{
    //
    public $timestamps = false;

    /**
     * @todo remove project_id from migration
     * @var array
     */
    protected $fillable = [
        'project_id',
        'title',
        'body',
        'image',
    ];
}
