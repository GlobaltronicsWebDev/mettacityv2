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
                            <label for="video_file" class="form-label">Upload Video File *</label>
                            <input type="file" 
                                   class="form-control @error('video_file') is-invalid @enderror" 
                                   id="video_file" 
                                   name="video_file"
                                   accept="video/*"
                                   {{ !$video ? 'required' : '' }}>
                            <small class="text-muted">Supported: MP4, WebM, MOV, AVI. Max 100MB</small>
                            @error('video_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="delay_seconds" class="form-label">Delay Before Showing (seconds) *</label>
                            <input type="number" 
                                   class="form-control @error('delay_seconds') is-invalid @enderror" 
                                   id="delay_seconds" 
                                   name="delay_seconds" 
                                   value="{{ old('delay_seconds', optional($video)->delay_seconds ?? 1) }}"
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
                                   {{ old('is_active', optional($video)->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Show popup on website)
                            </label>
                        </div>

                        @if($video && (($video->video_file ?? null) || (isset($video->video_url) && str_starts_with($video->video_url, 'popup-videos/'))))
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <video width="100%" height="300" controls>
                                <source src="{{ asset('storage/' . ($video->video_file ?? $video->video_url)) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @endif

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Update Video
                            </button>
                            @if($video && (($video->video_file ?? null) || (isset($video->video_url) && str_starts_with($video->video_url, 'popup-videos/'))))
                            <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash"></i> Delete Video
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            @if($video && (($video->video_file ?? null) || (isset($video->video_url) && str_starts_with($video->video_url, 'popup-videos/'))))
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Popup Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the popup video? This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('admin.popup-video.delete') }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
@endsection
