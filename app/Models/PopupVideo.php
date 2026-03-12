<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupVideo extends Model
{
    protected $table = 'popup_video';
    
    protected $fillable = [
        'video_file',
        'video_url',
        'video_type',
        'is_active',
        'delay_seconds'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getVideoSourceAttribute()
    {
        // Check video_file column first
        if (isset($this->video_file) && $this->video_file) {
            return asset('storage/' . $this->video_file);
        }
        
        // Fallback: check if video_url contains a file path (not a URL)
        if (isset($this->video_url) && $this->video_url && str_starts_with($this->video_url, 'popup-videos/')) {
            return asset('storage/' . $this->video_url);
        }

        return $this->getEmbedUrlAttribute();
    }

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
