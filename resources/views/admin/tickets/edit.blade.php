@extends('admin.layout')

@section('title', 'Edit Ticket')

@section('content')
<h2 class="mb-4"><i class="fas fa-edit"></i> Edit Ticket</h2>

<form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label class="form-label">Ticket Name *</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $ticket->name) }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $ticket->description) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Price *</label>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $ticket->price) }}" step="0.01" min="0" required>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        @if($ticket->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $ticket->image) }}" alt="{{ $ticket->name }}" style="max-width: 200px; border-radius: 5px;">
            </div>
        @endif
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        <small class="text-muted">Leave empty to keep current image</small>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Display Order</label>
        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $ticket->order) }}">
        @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $ticket->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Update Ticket
        </button>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>
</form>
@endsection
