<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutVideoController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $videos = AboutVideo::all();
        return view('admin.about-video.index', compact('videos'));
    }

    public function create()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        return view('admin.about-video.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'video_file' => 'required|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/webm|max:512000', // 500MB max
            'is_active' => 'nullable|boolean',
        ]);

        $filePath = $request->file('video_file')->store('about-videos', 'public');

        AboutVideo::create([
            'video_file' => $filePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.about-video.index')
            ->with('success', 'About video uploaded successfully!');
    }

    public function edit(AboutVideo $aboutVideo)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        return view('admin.about-video.edit', compact('aboutVideo'));
    }

    public function update(Request $request, AboutVideo $aboutVideo)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/webm|max:512000',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('video_file')) {
            // Delete old video
            if ($aboutVideo->video_file) {
                Storage::disk('public')->delete($aboutVideo->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('about-videos', 'public');
        }

        $aboutVideo->update($data);

        return redirect()->route('admin.about-video.index')
            ->with('success', 'About video updated successfully!');
    }

    public function destroy(AboutVideo $aboutVideo)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        if ($aboutVideo->video_file) {
            Storage::disk('public')->delete($aboutVideo->video_file);
        }

        $aboutVideo->delete();

        return redirect()->route('admin.about-video.index')
            ->with('success', 'About video deleted successfully!');
    }
}
