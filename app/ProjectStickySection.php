<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectStickySection
 * @package App
 */
class ProjectStickySection extends Model
{
    /**
     * @todo remove project_id from migration
     * @var array
     */
    protected $fillable = [
        'body',
        'image',
    ];
}
