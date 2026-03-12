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
        ];

        // Only add video_type if it's a valid ENUM value
        if (Schema::hasColumn('popup_video', 'video_type')) {
            $data['video_type'] = 'local';
        }

        // Only add video_url if column exists
        if (Schema::hasColumn('popup_video', 'video_url')) {
            $data['video_url'] = null;
        }

        // Only handle video_file if column exists
        if (Schema::hasColumn('popup_video', 'video_file') && $request->hasFile('video_file')) {
            // Delete old video file if exists
            if ($video && isset($video->video_file) && $video->video_file) {
                Storage::disk('public')->delete($video->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('popup-videos', 'public');
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
