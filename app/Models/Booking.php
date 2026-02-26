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
    ];
    
    // Prevent mass assignment of status
    protected $guarded = ['status'];

    protected $casts = [
        'visit_date' => 'date',
    ];
    
    // Set default status
    protected $attributes = [
        'status' => 'pending',
    ];
}
