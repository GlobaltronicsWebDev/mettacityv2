@extends('admin.layout')

@section('title', 'Edit Carousel Image')

@section('content')
<h2 class="mb-4"><i class="fas fa-edit"></i> Edit Carousel Image</h2>

<form action="{{ route('admin.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label class="form-label">Title (Optional)</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $carousel->title) }}">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description (Optional)</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $carousel->description) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        @if($carousel->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}" style="max-width: 300px; border-radius: 5px;">
            </div>
        @endif
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        <small class="text-muted">Leave empty to keep current image. Recommended size: 1920x1080px (Max 5MB)</small>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Order</label>
        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $carousel->order) }}">
        <small class="text-muted">Lower numbers appear first</small>
        @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $carousel->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update Image
        </button>
        <a href="{{ route('admin.carousel.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>
</form>
@endsection
