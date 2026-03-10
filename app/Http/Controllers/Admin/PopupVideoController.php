<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupVideo;
use Illuminate\Http\Request;

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
            'video_url' => 'required|url|max:500',
            'video_type' => 'required|in:youtube,vimeo,facebook',
            'delay_seconds' => 'required|integer|min:0|max:10',
        ]);

        $video = PopupVideo::first();

        if ($video) {
            $video->update([
                'video_url' => $request->video_url,
                'video_type' => $request->video_type,
                'delay_seconds' => $request->delay_seconds,
                'is_active' => $request->has('is_active'),
            ]);
        } else {
            PopupVideo::create([
                'video_url' => $request->video_url,
                'video_type' => $request->video_type,
                'delay_seconds' => $request->delay_seconds,
                'is_active' => $request->has('is_active'),
            ]);
        }

        return redirect()->route('admin.popup-video.index')
            ->with('success', 'Popup video updated successfully.');
    }
}
