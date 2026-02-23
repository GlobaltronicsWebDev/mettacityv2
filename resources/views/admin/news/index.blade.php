@extends('admin.layout')

@section('title', 'News Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-newspaper"></i> News Management</h2>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add News
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Published Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $item)
            <tr>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    @else
                        <div style="width: 60px; height: 60px; background: #ddd; border-radius: 5px;"></div>
                    @endif
                </td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->published_date->format('M d, Y') }}</td>
                <td>
                    <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No news found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $news->links() }}
@endsection
