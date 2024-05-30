<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'resource_id',
        'filename',
        'rank',
        'alt',
        'title',
        'caption',
        'root_path',
        'watermark',
        'thumb',
        'preview'
    ];
}
