@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Add New Album</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Album Title<span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Artists -->
        <div class="mb-3">
            <label for="artists" class="form-label">Artists<span class="text-danger">*</span></label>
            <select name="artist_ids[]" class="form-select" multiple required>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Cover Art -->
        <div class="mb-3">
            <label for="cover_art" class="form-label">Cover Art</label>
            <input type="file" name="cover_art" class="form-control" accept="image/*">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <!-- Release Date -->
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input type="date" name="release_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Album</button>
    </form>
</div>
@endsection
