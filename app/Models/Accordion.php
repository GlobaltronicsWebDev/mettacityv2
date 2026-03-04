<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accordion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'video_type',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getEmbedCodeAttribute()
    {
        if (!$this->video_url || $this->video_type === 'none') {
            return null;
        }

        switch ($this->video_type) {
            case 'youtube':
                // Extract YouTube video ID
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
                return $videoId ? '<iframe width="100%" height="400" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' : null;

            case 'vimeo':
                // Extract Vimeo video ID
                preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches);
                $videoId = $matches[1] ?? null;
                return $videoId ? '<iframe src="https://player.vimeo.com/video/' . $videoId . '" width="100%" height="400" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>' : null;

            case 'facebook':
                // Facebook video embed
                $encodedUrl = urlencode($this->video_url);
                return '<iframe src="https://www.facebook.com/plugins/video.php?href=' . $encodedUrl . '&width=500&show_text=false&appId" width="100%" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>';

            default:
                return null;
        }
    }
}
