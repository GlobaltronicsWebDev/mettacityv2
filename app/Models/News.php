<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image',
        'facebook_link',
        'published_date',
        'is_active',
    ];

    protected $casts = [
        'published_date' => 'date',
        'is_active' => 'boolean',
    ];
}
