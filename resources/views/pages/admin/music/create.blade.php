@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Add New Song or Album</h2>
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

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required>
        </div>
    
        <!-- Type -->
        <div class="mb-3">
            <label for="type" class="form-label">Type<span class="text-danger">*</span></label>
            <select name="type" class="form-select" required>
                <option value="song">Song</option>
                <option value="album">Album</option>
            </select>
        </div>
    
        <!-- Artists -->
        <div class="mb-3">
            <label for="artists" class="form-label">Select Existing Artists</label>
            <select name="artist_ids[]" class="form-select" multiple>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (or Command) to select multiple artists.</small>
        </div>
        
        <!-- Add New Artist -->
        <div class="mb-3">
            <label for="new_artist" class="form-label">Or Add New Artist</label>
            <input type="text" name="new_artist[]" class="form-control" placeholder="Enter new artist name">
            <small class="text-muted">Enter names of new artists separated by commas.</small>
        </div>
    
        <!-- Cover Art -->
        <div class="mb-3">
            <label for="cover_art" class="form-label">Cover Art</label>
            <input type="file" name="cover_art" class="form-control" accept="image/*">
        </div>
    
        <!-- Audio or Zip File -->
        <div class="mb-3">
            <label for="audio_file" class="form-label">Upload File</label>
            <input type="file" name="audio_file" class="form-control" accept="audio/*,application/zip">
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
    
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
</div>
@endsection
