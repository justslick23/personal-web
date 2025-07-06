@extends('layouts.auth')

@section('title', 'Edit Wishlist Item')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Wishlist Item</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('wishlist.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Use POST for update route in your controller --}}
        
        <div class="mb-3">
            <label for="title" class="form-label">Item Title *</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $item->title) }}">
            @error('title')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $item->description) }}</textarea>
            @error('description')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price ($)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $item->price) }}">
            @error('price')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">Product Link</label>
            <input type="url" name="url" id="url" class="form-control" value="{{ old('url', $item->url) }}">
            @error('url')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="contribution_link" class="form-label">Contribution Link</label>
            <input type="url" name="contribution_link" id="contribution_link" class="form-control" value="{{ old('contribution_link', $item->contribution_link) }}">
            @error('contribution_link')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label><br>
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="Item Image" style="max-width: 150px; margin-bottom: 10px;">
            @endif
            <input type="file" name="image" id="image" class="form-control">
            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_received" id="is_received" value="1" {{ old('is_received', $item->is_received) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_received">Mark as Received</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('wishlist.admin') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
