@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Add New Accordion</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-list me-1"></i>
                    Accordion Information
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.accordions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="e.g., About Our Attractions"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5"
                                      placeholder="Enter detailed description..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="video_type" class="form-label">Video Type *</label>
                            <select class="form-select @error('video_type') is-invalid @enderror" 
                                    id="video_type" 
                                    name="video_type"
                                    required>
                                <option value="none" {{ old('video_type') == 'none' ? 'selected' : '' }}>No Video</option>
                                <option value="youtube" {{ old('video_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="vimeo" {{ old('video_type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                <option value="facebook" {{ old('video_type') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            </select>
                            @error('video_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="video_url_field">
                            <label for="video_url" class="form-label">Video URL</label>
                            <input type="url" 
                                   class="form-control @error('video_url') is-invalid @enderror" 
                                   id="video_url" 
                                   name="video_url" 
                                   value="{{ old('video_url') }}"
                                   placeholder="https://...">
                            <small class="text-muted">
                                YouTube: https://www.youtube.com/watch?v=...<br>
                                Vimeo: https://vimeo.com/...<br>
                                Facebook: https://www.facebook.com/watch/?v=...
                            </small>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order *</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', 0) }}"
                                   min="0"
                                   required>
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   name="is_active"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Display on website)
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Accordion
                            </button>
                            <a href="{{ route('admin.accordions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('video_type').addEventListener('change', function() {
    const videoUrlField = document.getElementById('video_url_field');
    if (this.value === 'none') {
        videoUrlField.style.display = 'none';
    } else {
        videoUrlField.style.display = 'block';
    }
});

// Initial state
if (document.getElementById('video_type').value === 'none') {
    document.getElementById('video_url_field').style.display = 'none';
}
</script>
@endsection
