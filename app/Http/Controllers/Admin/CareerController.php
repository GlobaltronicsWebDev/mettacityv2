<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->paginate(10);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('careers', 'public');
        }

        Career::create($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Career posted successfully!');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($career->image) {
                Storage::disk('public')->delete($career->image);
            }
            $validated['image'] = $request->file('image')->store('careers', 'public');
        }

        $career->update($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Career updated successfully!');
    }

    public function destroy(Career $career)
    {
        if ($career->image) {
            Storage::disk('public')->delete($career->image);
        }
        
        $career->delete();

        return redirect()->route('admin.careers.index')->with('success', 'Career deleted successfully!');
    }
}
