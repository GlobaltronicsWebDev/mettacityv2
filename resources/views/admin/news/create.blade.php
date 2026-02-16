@extends('admin.layout')

@section('title', 'Create News')

@section('content')
<h2 class="mb-4"><i class="fas fa-plus"></i> Create News</h2>

<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Title *</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Excerpt *</label>
        <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="4" required>{{ old('excerpt') }}</textarea>
        @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Facebook Link</label>
        <input type="url" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" value="{{ old('facebook_link') }}">
        @error('facebook_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Published Date *</label>
        <input type="date" name="published_date" class="form-control @error('published_date') is-invalid @enderror" value="{{ old('published_date', date('Y-m-d')) }}" required>
        @error('published_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Create News
        </button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>
</form>
@endsection
