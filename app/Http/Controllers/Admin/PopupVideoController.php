<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class PopupVideoController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $video = PopupVideo::first();
        return view('admin.popup-video.index', compact('video'));
    }

    public function update(Request $request)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/webm|max:102400', // 100MB max
            'delay_seconds' => 'required|integer|min:0|max:10',
        ]);

        $video = PopupVideo::first();

        $data = [
            'delay_seconds' => $request->delay_seconds,
            'is_active' => $request->has('is_active'),
            'video_url' => '', // Always provide a value
        ];

        // Only add video_type if it's a valid ENUM value
        if (Schema::hasColumn('popup_video', 'video_type')) {
            $data['video_type'] = 'local';
        }

        // Handle video file upload
        if ($request->hasFile('video_file')) {
            $filePath = $request->file('video_file')->store('popup-videos', 'public');
            
            // Try to use video_file column first, fallback to video_url
            if (Schema::hasColumn('popup_video', 'video_file')) {
                // Delete old video file if exists
                if ($video && isset($video->video_file) && $video->video_file) {
                    Storage::disk('public')->delete($video->video_file);
                }
                $data['video_file'] = $filePath;
                $data['video_url'] = '';
            } else {
                // Use video_url as fallback to store file path
                if ($video && isset($video->video_url) && str_starts_with($video->video_url, 'popup-videos/')) {
                    Storage::disk('public')->delete($video->video_url);
                }
                $data['video_url'] = $filePath;
            }
        } elseif ($video && isset($video->video_url)) {
            // Keep existing video_url if not uploading new file
            $data['video_url'] = $video->video_url;
        }

        if ($video) {
            $video->update($data);
        } else {
            PopupVideo::create($data);
        }

        return redirect()->route('admin.popup-video.index')
            ->with('success', 'Popup video uploaded successfully! Clear your browser cache to see it on the website.');
    }
}
