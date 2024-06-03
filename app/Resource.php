<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin \Illuminate\Contracts\Database\Eloquent\Builder
 */
class Resource extends Model
{
    protected $fillable = [
        'parent_id',
        'menuindex',
        'de_title',
        'de_meta_title',
        'de_meta_description',
        'de_meta_keywords',
        'de_content',
        'de_alias',
        'de_uri',
        'de_menushow',
        'de_published',
        'ru_title',
        'ru_meta_title',
        'ru_meta_description',
        'ru_meta_keywords',
        'ru_content',
        'ru_alias',
        'ru_uri',
        'ru_menushow',
        'ru_published',
        'use_gallery',
        'per_page',
        'created_by',
        'modified_by',
        'use_review',
        'use_faq',
        'is_category',
        'use_citylist',
        'schema_data'
    ];

    public function setDeUriAttribute($value)
    {
        if (empty($value) && $this->id != 1) {
            $this->attributes['de_uri'] = Str::slug( mb_substr($this->de_title, 0, 40) );
        } else {
            $this->attributes['de_uri'] = $value;
        }
    }

    public function setDeAliasAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['de_alias'] = Str::slug( mb_substr($this->de_title, 0, 40) );
        } else {
            $this->attributes['de_alias'] = $value;
        }
    }

    public function setRuAliasAttribute($value)
    {
        if (!empty($this->ru_title)) {
            if (empty($value)) {
                $this->attributes['ru_alias'] = Str::slug( mb_substr($this->ru_title, 0, 40) );
            } else {
                $this->attributes['ru_alias'] = $value;
            }
        }
    }

    public function setRuUriAttribute($value)
    {
        if (!empty($this->ru_title)) {
            if (empty($value) && $this->id != 1) {
                $this->attributes['ru_uri'] = Str::slug( mb_substr($this->ru_title, 0, 40) );
            } else {
                $this->attributes['ru_uri'] = $value;
            }
        }
    }

}
