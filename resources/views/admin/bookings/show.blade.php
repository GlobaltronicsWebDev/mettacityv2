@extends('admin.layout')

@section('title', 'Booking Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-check"></i> Booking Details</h2>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Booking #{{ $booking->id }}</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong><br>
                        {{ $booking->name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong><br>
                        {{ $booking->email }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Phone:</strong><br>
                        {{ $booking->phone }}
                    </div>
                    <div class="col-md-6">
                        <strong>Number of Guests:</strong><br>
                        {{ $booking->number_of_guests }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Visit Date:</strong><br>
                        {{ $booking->visit_date->format('F d, Y') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>

                @if($booking->message)
                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Message:</strong><br>
                        <p class="border p-3 rounded bg-light">{{ $booking->message }}</p>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <strong>Booked On:</strong><br>
                        {{ $booking->created_at->format('F d, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </form>

                <hr>

                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this booking?')">
                        <i class="fas fa-trash"></i> Delete Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
