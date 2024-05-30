<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'text',
        'vote',
        'email',
        'local',
        'published'
    ];
}
