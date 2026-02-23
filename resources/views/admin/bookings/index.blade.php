@extends('admin.layout')

@section('title', 'Booking Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-check"></i> Booking Management</h2>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Cell Number</th>
                <th>Date of Booking</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>#{{ $booking->id }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->phone }}</td>
                <td>{{ $booking->visit_date->format('M d, Y') }}</td>
                <td>
                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                        @csrf
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto;">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline">
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
                <td colspan="6" class="text-center">No bookings found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $bookings->links() }}
@endsection
