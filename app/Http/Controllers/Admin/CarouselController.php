<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        // Check authorization
        if (!auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        $carousels = Carousel::orderBy('order')->paginate(10);
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        // Check authorization
        if (!auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        // Check authorization
        if (!auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240|dimensions:min_width=100,min_height=100',
                'mobile_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240|dimensions:width=440,height=427',
                'order' => 'nullable|integer',
            ], [
                'image.max' => 'The carousel image must not be larger than 10 MB.',
                'mobile_image.max' => 'The mobile carousel image must not be larger than 10 MB.',
                'mobile_image.dimensions' => 'The mobile carousel image must be exactly 440x427 pixels.',
            ]);

            $validated['is_active'] = $request->has('is_active') ? true : false;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                
                // Additional security: Check actual file content
                $imageInfo = getimagesize($file->getRealPath());
                if ($imageInfo === false) {
                    throw new \Exception('Invalid image file');
                }
                
                $validated['image'] = $file->store('carousel', 'public');
            }

            if ($request->hasFile('mobile_image')) {
                $validated['mobile_image'] = $request->file('mobile_image')->store('carousel/mobile', 'public');
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
        // Check authorization
        if (!auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        // Check authorization
        if (!auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240|dimensions:min_width=100,min_height=100',
                'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240|dimensions:width=440,height=427',
                'order' => 'nullable|integer',
            ], [
                'image.max' => 'The carousel image must not be larger than 10 MB.',
                'mobile_image.max' => 'The mobile carousel image must not be larger than 10 MB.',
                'mobile_image.dimensions' => 'The mobile carousel image must be exactly 440x427 pixels.',
            ]);

            $validated['is_active'] = $request->has('is_active') ? true : false;

            if ($request->hasFile('image')) {
                if ($carousel->image) {
                    Storage::disk('public')->delete($carousel->image);
                }
                $validated['image'] = $request->file('image')->store('carousel', 'public');
            }

            if ($request->hasFile('mobile_image')) {
                if ($carousel->mobile_image) {
                    Storage::disk('public')->delete($carousel->mobile_image);
                }
                $validated['mobile_image'] = $request->file('mobile_image')->store('carousel/mobile', 'public');
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
        // Check authorization
        if (!auth()->user()->is_super_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            if ($carousel->image) {
                Storage::disk('public')->delete($carousel->image);
            }
            if ($carousel->mobile_image) {
                Storage::disk('public')->delete($carousel->mobile_image);
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
