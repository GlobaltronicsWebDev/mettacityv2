<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accordion;
use Illuminate\Http\Request;

class AccordionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $accordions = Accordion::orderBy('order')->get();
        return view('admin.accordions.index', compact('accordions'));
    }

    public function create()
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        return view('admin.accordions.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url|max:500',
            'video_type' => 'required|in:youtube,vimeo,facebook,none',
            'order' => 'required|integer|min:0',
        ]);

        Accordion::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'video_type' => $request->video_type,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.accordions.index')
            ->with('success', 'Accordion created successfully.');
    }

    public function edit(Accordion $accordion)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        return view('admin.accordions.edit', compact('accordion'));
    }

    public function update(Request $request, Accordion $accordion)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url|max:500',
            'video_type' => 'required|in:youtube,vimeo,facebook,none',
            'order' => 'required|integer|min:0',
        ]);

        $accordion->update([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'video_type' => $request->video_type,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.accordions.index')
            ->with('success', 'Accordion updated successfully.');
    }

    public function destroy(Accordion $accordion)
    {
        if (!auth()->user()->is_super_admin) {
            abort(403);
        }

        $accordion->delete();

        return redirect()->route('admin.accordions.index')
            ->with('success', 'Accordion deleted successfully.');
    }
}
