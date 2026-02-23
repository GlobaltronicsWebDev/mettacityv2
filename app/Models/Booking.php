<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'visit_date',
        'number_of_guests',
        'message',
        'status',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];
}
