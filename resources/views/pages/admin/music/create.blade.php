@extends('layouts.auth')

@section('content')
    <div class="container">
        <h2>Add New Music</h2>

        <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Music Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="artist">Artist</label>
                <select id="artist" name="artist" class="form-control" required>
                    <option value="">Select an artist</option>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                    <option value="new_artist">Add New Artist</option>
                </select>
            </div>

            <!-- Option to add a new artist if needed -->
            <div class="form-group" id="new-artist-group" style="display: none;">
                <label for="new_artist_name">New Artist Name</label>
                <input type="text" id="new_artist_name" name="new_artist_name" class="form-control">
            </div>

            <div class="form-group">
                <label for="album">Album (Optional)</label>
                <input type="text" id="album" name="album" class="form-control">
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="song">Song</option>
                    <option value="album">Album</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cover_image">Cover Image (Optional)</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*">
            </div>

            <div class="form-group" id="song-files" style="display: none;">
                <label for="songs">Songs (Only for Albums)</label>
                <input type="file" id="songs" name="songs[]" class="form-control" multiple accept=".mp3,.wav">
            </div>

            <div class="form-group" id="file-upload" style="display: none;">
                <label for="file">Music File (Only for Songs)</label>
                <input type="file" id="file" name="file" class="form-control" accept=".mp3,.wav">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <script>
        // Toggle fields based on the selected type (song or album)
        document.getElementById('type').addEventListener('change', function() {
            var coverImage = document.getElementById('cover-image');
            var songFiles = document.getElementById('song-files');
            var fileUpload = document.getElementById('file-upload');

            if (this.value === 'album') {
                coverImage.style.display = 'block';
                songFiles.style.display = 'block';
                fileUpload.style.display = 'none';
            } else {
                coverImage.style.display = 'block'; // Always show cover image for songs
                songFiles.style.display = 'none';
                fileUpload.style.display = 'block';
            }
        });

        // Toggle new artist input field if "Add New Artist" is selected
        document.getElementById('artist').addEventListener('change', function() {
            var newArtistGroup = document.getElementById('new-artist-group');
            if (this.value === 'new_artist') {
                newArtistGroup.style.display = 'block';
            } else {
                newArtistGroup.style.display = 'none';
            }
        });
    </script>
@endsection
