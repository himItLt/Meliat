<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'question',
        'ask',
        'locale',
        'published'
    ];
}
