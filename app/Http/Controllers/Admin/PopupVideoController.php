<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $rules = [
            'video_type' => 'required|in:local,youtube,vimeo,facebook',
            'delay_seconds' => 'required|integer|min:0|max:10',
        ];

        if ($request->video_type === 'local') {
            $rules['video_file'] = 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/webm|max:102400'; // 100MB max
        } else {
            $rules['video_url'] = 'required|url|max:500';
        }

        $request->validate($rules);

        $video = PopupVideo::first();

        $data = [
            'video_type' => $request->video_type,
            'delay_seconds' => $request->delay_seconds,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->video_type === 'local' && $request->hasFile('video_file')) {
            // Delete old video file if exists
            if ($video && $video->video_file) {
                Storage::disk('public')->delete($video->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('popup-videos', 'public');
            $data['video_url'] = null;
        } elseif ($request->video_type !== 'local') {
            $data['video_url'] = $request->video_url;
            $data['video_file'] = null;
        }

        if ($video) {
            $video->update($data);
        } else {
            PopupVideo::create($data);
        }

        return redirect()->route('admin.popup-video.index')
            ->with('success', 'Popup video updated successfully.');
    }
}
