<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectQuote extends Model
{
    public $timestamps = false;

    protected $fillable = ['body','author','title'];
}
