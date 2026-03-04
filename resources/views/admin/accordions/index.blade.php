@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Accordion Management</h1>
        <a href="{{ route('admin.accordions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Accordion
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list me-1"></i>
            All Accordions ({{ $accordions->count() }})
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Order</th>
                            <th>Title</th>
                            <th>Video Type</th>
                            <th width="100">Status</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accordions as $accordion)
                        <tr>
                            <td class="text-center">{{ $accordion->order }}</td>
                            <td>{{ $accordion->title }}</td>
                            <td>
                                @if($accordion->video_type !== 'none')
                                    <span class="badge bg-info">{{ ucfirst($accordion->video_type) }}</span>
                                @else
                                    <span class="badge bg-secondary">No Video</span>
                                @endif
                            </td>
                            <td>
                                @if($accordion->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.accordions.edit', $accordion) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.accordions.destroy', $accordion) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this accordion?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <p class="text-muted mb-0">No accordions found. Add your first accordion!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
