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
     * Enum values from position field
     *
     * @var array
     */
    public static $positions = [
        '3d',
        'backend',
        'design',
        'frontend',
        'fullStack',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'comments',
        'code_profile',
        'position',
        'file',
    ];
}
