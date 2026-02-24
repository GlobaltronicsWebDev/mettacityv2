@extends('admin.layout')

@section('title', 'Carousel Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-images"></i> Carousel Management</h2>
    <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Carousel Image
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($carousels as $item)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 5px;">
                </td>
                <td>{{ $item->title ?: 'No title' }}</td>
                <td>{{ $item->order }}</td>
                <td>
                    <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.carousel.edit', $item) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.carousel.destroy', $item) }}" method="POST" class="d-inline">
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
                <td colspan="5" class="text-center">No carousel images found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $carousels->links() }}
@endsection
