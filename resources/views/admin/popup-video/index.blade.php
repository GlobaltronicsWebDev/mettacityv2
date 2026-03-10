@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Popup Video Settings</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-video me-1"></i>
                    Configure Popup Video
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.popup-video.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="video_type" class="form-label">Video Type *</label>
                            <select class="form-select @error('video_type') is-invalid @enderror" 
                                    id="video_type" 
                                    name="video_type"
                                    required>
                                <option value="local" {{ old('video_type', $video->video_type ?? 'local') == 'local' ? 'selected' : '' }}>Upload Video File</option>
                                <option value="youtube" {{ old('video_type', $video->video_type ?? '') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="vimeo" {{ old('video_type', $video->video_type ?? '') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                <option value="facebook" {{ old('video_type', $video->video_type ?? '') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            </select>
                            @error('video_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="video_file_field">
                            <label for="video_file" class="form-label">Upload Video File</label>
                            @if($video && $video->video_type === 'local' && $video->video_file)
                                <div class="mb-2">
                                    <video width="100%" height="300" controls>
                                        <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <small class="text-muted d-block mt-1">Current video</small>
                                </div>
                            @endif
                            <input type="file" 
                                   class="form-control @error('video_file') is-invalid @enderror" 
                                   id="video_file" 
                                   name="video_file"
                                   accept="video/*">
                            <small class="text-muted">Supported: MP4, WebM, MOV, AVI. Max 100MB</small>
                            @error('video_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="video_url_field">
                            <label for="video_url" class="form-label">Video URL</label>
                            <input type="url" 
                                   class="form-control @error('video_url') is-invalid @enderror" 
                                   id="video_url" 
                                   name="video_url" 
                                   value="{{ old('video_url', $video->video_url ?? '') }}"
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
                            <label for="delay_seconds" class="form-label">Delay Before Showing (seconds) *</label>
                            <input type="number" 
                                   class="form-control @error('delay_seconds') is-invalid @enderror" 
                                   id="delay_seconds" 
                                   name="delay_seconds" 
                                   value="{{ old('delay_seconds', $video->delay_seconds ?? 1) }}"
                                   min="0"
                                   max="10"
                                   required>
                            <small class="text-muted">How many seconds to wait before showing the popup (0-10)</small>
                            @error('delay_seconds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   name="is_active"
                                   {{ old('is_active', $video->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Show popup on website)
                            </label>
                        </div>

                        @if($video && $video->video_type === 'local' && $video->video_file)
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <video width="100%" height="300" controls>
                                <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @elseif($video && $video->embed_url)
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px;">
                                <iframe src="{{ str_replace('autoplay=1', 'autoplay=0', $video->embed_url) }}" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                        frameborder="0" 
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        @endif

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Information
                </div>
                <div class="card-body">
                    <h6>How it works:</h6>
                    <ul class="small">
                        <li>Video popup appears when users first visit the website</li>
                        <li>Only shows once per browser session</li>
                        <li>Users can close it by clicking X, outside the video, or pressing ESC</li>
                        <li>Video will autoplay when popup opens</li>
                        <li>Disable by unchecking "Active"</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('video_type').addEventListener('change', function() {
    const videoFileField = document.getElementById('video_file_field');
    const videoUrlField = document.getElementById('video_url_field');
    
    if (this.value === 'local') {
        videoFileField.style.display = 'block';
        videoUrlField.style.display = 'none';
        document.getElementById('video_url').removeAttribute('required');
    } else {
        videoFileField.style.display = 'none';
        videoUrlField.style.display = 'block';
        document.getElementById('video_url').setAttribute('required', 'required');
    }
});

// Initial state
if (document.getElementById('video_type').value === 'local') {
    document.getElementById('video_file_field').style.display = 'block';
    document.getElementById('video_url_field').style.display = 'none';
    document.getElementById('video_url').removeAttribute('required');
} else {
    document.getElementById('video_file_field').style.display = 'none';
    document.getElementById('video_url_field').style.display = 'block';
}
</script>
@endsection
