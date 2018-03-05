<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectStickySection
 * @package App
 */
class ProjectStickySection extends Model
{
    protected $fillable = [
        'project_id',
        'body',
        'image',
    ];

    /**
     * Project Parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
