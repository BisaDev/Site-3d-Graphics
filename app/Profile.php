<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * @package App
 */
class Profile extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'comments',
        'code_profile',
        'file',
        'vacancy'
    ];
}
