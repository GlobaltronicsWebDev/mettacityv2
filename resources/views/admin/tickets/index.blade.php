@extends('admin.layout')

@section('title', 'Ticket Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-ticket-alt"></i> Ticket Management</h2>
    <a href="{{ route('admin.tickets.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Ticket
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>
                    @if($ticket->image)
                        <img src="{{ asset('storage/' . $ticket->image) }}" alt="{{ $ticket->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    @else
                        <div style="width: 60px; height: 60px; background: #ddd; border-radius: 5px;"></div>
                    @endif
                </td>
                <td>{{ $ticket->name }}</td>
                <td>₱{{ number_format($ticket->price, 2) }}</td>
                <td>{{ $ticket->order }}</td>
                <td>
                    <span class="badge bg-{{ $ticket->is_active ? 'success' : 'secondary' }}">
                        {{ $ticket->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="d-inline">
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
                <td colspan="6" class="text-center">No tickets found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $tickets->links() }}
@endsection
