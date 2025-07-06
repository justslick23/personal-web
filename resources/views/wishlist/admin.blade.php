@extends('layouts.auth')

@section('title', 'Manage Wishlist')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Manage Wishlist</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Item Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Wishlist Item</div>
        <div class="card-body">
            <form action="{{ route('wishlist.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Item Title *</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
              
                <div class="mb-3">
                    <label for="price" class="form-label">Price (M)</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}">
                    @error('price')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Product Link</label>
                    <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}">
                    @error('url')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
             
                <div class="mb-3">
                    <label for="image" class="form-label">Image (optional)</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
        </div>
    </div>

    <!-- Wishlist Items Table -->
    <div class="card">
        <div class="card-header">Wishlist Items</div>
        <div class="card-body p-0">
            @if($items->isEmpty())
                <p class="p-3">No wishlist items found.</p>
            @else
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Received</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>${{ $item->price ? number_format($item->price, 2) : '-' }}</td>
                            <td>
                                @if($item->is_received)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-warning text-dark">No</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('wishlist.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>

                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary" title="Toggle Received Status">
                                        {{ $item->is_received ? 'Mark as Not Received' : 'Mark as Received' }}
                                    </button>
                                </form>

                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
