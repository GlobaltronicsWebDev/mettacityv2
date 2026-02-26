<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function __construct()
    {
        // Ensure only super admins can manage carousel
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_super_admin) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $carousels = Carousel::orderBy('order')->paginate(10);
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|max:5120',
                'order' => 'nullable|integer',
            ]);

            $validated['is_active'] = $request->has('is_active') ? true : false;

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('carousel', 'public');
            }

            Carousel::create($validated);

            return redirect()->route('admin.carousel.index')->with('success', 'Carousel image added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e; // Let validation errors pass through
        } catch (\Exception $e) {
            \Log::error('Carousel creation failed', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return back()->with('error', 'Failed to add carousel image. Please try again.')->withInput();
        }
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        try {
            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|max:5120',
                'order' => 'nullable|integer',
            ]);

            $validated['is_active'] = $request->has('is_active') ? true : false;

            if ($request->hasFile('image')) {
                if ($carousel->image) {
                    Storage::disk('public')->delete($carousel->image);
                }
                $validated['image'] = $request->file('image')->store('carousel', 'public');
            }

            $carousel->update($validated);

            return redirect()->route('admin.carousel.index')->with('success', 'Carousel image updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Carousel update failed', [
                'error' => $e->getMessage(),
                'carousel_id' => $carousel->id,
                'user_id' => auth()->id(),
            ]);
            return back()->with('error', 'Failed to update carousel image. Please try again.')->withInput();
        }
    }

    public function destroy(Carousel $carousel)
    {
        try {
            if ($carousel->image) {
                Storage::disk('public')->delete($carousel->image);
            }
            
            $carousel->delete();

            return redirect()->route('admin.carousel.index')->with('success', 'Carousel image deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Carousel deletion failed', [
                'error' => $e->getMessage(),
                'carousel_id' => $carousel->id,
                'user_id' => auth()->id(),
            ]);
            return back()->with('error', 'Failed to delete carousel image. Please try again.');
        }
    }
}
