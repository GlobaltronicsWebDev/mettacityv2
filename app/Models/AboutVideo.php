<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutVideo extends Model
{
    protected $table = 'about_videos';
    
    protected $fillable = [
        'video_file',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getVideoSourceAttribute()
    {
        if ($this->video_file) {
            return asset('storage/' . $this->video_file);
        }
        return null;
    }
}
