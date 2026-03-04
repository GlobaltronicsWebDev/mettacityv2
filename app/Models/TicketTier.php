<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketTier extends Model
{
    protected $fillable = [
        'name',
        'image',
        'url',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
