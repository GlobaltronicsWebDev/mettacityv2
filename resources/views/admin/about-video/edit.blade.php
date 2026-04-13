@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Edit About Video</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.about-video.update', $aboutVideo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Current Video</label>
                    @if ($aboutVideo->video_file)
                        <div class="mb-2">
                            <small class="text-muted">{{ basename($aboutVideo->video_file) }}</small>
                        </div>
                        <video width="100%" height="300" controls style="border-radius: 8px;">
                            <source src="{{ asset('storage/' . $aboutVideo->video_file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <p class="text-muted">No video uploaded</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="video_file" class="form-label">Replace Video File</label>
                    <input type="file" class="form-control @error('video_file') is-invalid @enderror" 
                           id="video_file" name="video_file" accept="video/*">
                    <small class="form-text text-muted">
                        Leave empty to keep current video. Supported formats: MP4, MPEG, MOV, AVI, WebM (Max 500MB)
                    </small>
                    @error('video_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                           @if ($aboutVideo->is_active) checked @endif>
                    <label class="form-check-label" for="is_active">
                        Active (Display on about page)
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Video
                    </button>
                    <a href="{{ route('admin.about-video.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
