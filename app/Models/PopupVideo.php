<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupVideo extends Model
{
    protected $table = 'popup_video';
    
    protected $fillable = [
        'video_url',
        'video_type',
        'is_active',
        'delay_seconds'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getEmbedUrlAttribute()
    {
        if (!$this->video_url) {
            return null;
        }

        switch ($this->video_type) {
            case 'youtube':
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
                return $videoId ? 'https://www.youtube.com/embed/' . $videoId . '?autoplay=1' : null;

            case 'vimeo':
                preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
                return $videoId ? 'https://player.vimeo.com/video/' . $videoId . '?autoplay=1' : null;

            case 'facebook':
                $encodedUrl = urlencode($this->video_url);
                return 'https://www.facebook.com/plugins/video.php?href=' . $encodedUrl . '&autoplay=1';

            default:
                return null;
        }
    }
}
