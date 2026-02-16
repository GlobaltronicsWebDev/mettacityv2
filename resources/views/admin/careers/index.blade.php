@extends('admin.layout')

@section('title', 'Career Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-briefcase"></i> Career Management</h2>
    @if(Auth::user()->is_super_admin)
    <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Career
    </a>
    @endif
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Location</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($careers as $career)
            <tr>
                <td>
                    @if($career->image)
                        <img src="{{ asset('storage/' . $career->image) }}" alt="{{ $career->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    @else
                        <div style="width: 60px; height: 60px; background: #ddd; border-radius: 5px;"></div>
                    @endif
                </td>
                <td>{{ $career->title }}</td>
                <td>{{ $career->location ?? 'N/A' }}</td>
                <td>{{ $career->type ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-{{ $career->is_active ? 'success' : 'secondary' }}">
                        {{ $career->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    @if(Auth::user()->is_super_admin)
                    <a href="{{ route('admin.careers.edit', $career) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @else
                    <span class="badge bg-info">View Only</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No careers found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $careers->links() }}
@endsection
