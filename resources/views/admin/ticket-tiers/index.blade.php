@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Ticket Tiers Management</h1>
        <a href="{{ route('admin.ticket-tiers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Tier
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
            <i class="fas fa-ticket-alt me-1"></i>
            All Ticket Tiers ({{ $tiers->count() }})
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Order</th>
                            <th width="150">Image</th>
                            <th>Name</th>
                            <th width="100">Status</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tiers as $tier)
                        <tr>
                            <td class="text-center">{{ $tier->order }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $tier->image) }}" 
                                     alt="{{ $tier->name }}" 
                                     class="img-thumbnail" 
                                     style="max-height: 80px;">
                            </td>
                            <td>{{ $tier->name }}</td>
                            <td>
                                @if($tier->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.ticket-tiers.edit', $tier) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.ticket-tiers.destroy', $tier) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this tier?');">
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
                                <p class="text-muted mb-0">No ticket tiers found. Add your first tier!</p>
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
