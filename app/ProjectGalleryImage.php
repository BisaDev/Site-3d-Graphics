<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectGalleryImage extends Model
{
    //

    /**
     * @var array
     */
    protected $fillable = [
        'project_gallery_id',
        'color',
        'image',
        'width',
        'height',
    ];

    /**
     * Parent Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo(ProjectGallery::class);
    }
}
