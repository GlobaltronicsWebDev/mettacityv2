@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>About Page Videos</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.about-video.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Video
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($videos->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Video File</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>
                                @if ($video->video_file)
                                    <small class="text-muted">{{ basename($video->video_file) }}</small>
                                @else
                                    <span class="badge bg-warning">No file</span>
                                @endif
                            </td>
                            <td>
                                @if ($video->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $video->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.about-video.edit', $video) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.about-video.destroy', $video) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            No videos found. <a href="{{ route('admin.about-video.create') }}">Create one now</a>
        </div>
    @endif
</div>
@endsection
