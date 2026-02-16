@extends('admin.layout')

@section('title', 'Edit Career')

@section('content')
<h2 class="mb-4"><i class="fas fa-edit"></i> Edit Career</h2>

<form action="{{ route('admin.careers.update', $career) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label class="form-label">Job Title *</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $career->title) }}" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description *</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6" required>{{ old('description', $career->description) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $career->location) }}">
            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Employment Type</label>
            <select name="type" class="form-select @error('type') is-invalid @enderror">
                <option value="">Select Type</option>
                <option value="Full-time" {{ old('type', $career->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time" {{ old('type', $career->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="Contract" {{ old('type', $career->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                <option value="Internship" {{ old('type', $career->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
            </select>
            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        @if($career->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $career->image) }}" alt="{{ $career->title }}" style="max-width: 200px; border-radius: 5px;">
            </div>
        @endif
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        <small class="text-muted">Leave empty to keep current image</small>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $career->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update Career
        </button>
        <a href="{{ route('admin.careers.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>
</form>
@endsection
