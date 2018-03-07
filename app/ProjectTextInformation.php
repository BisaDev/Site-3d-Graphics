<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTextInformation extends Model
{
    //
    public $timestamps = false;

    /**
     * @todo remove project_id from migration
     * @var array
     */
    protected $fillable = [
        'project_id',
        'body',
    ];
}
