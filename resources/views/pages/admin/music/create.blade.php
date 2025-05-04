@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Add New Music</h2>
    
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
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs mb-4" id="musicTypeTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="song-tab" data-bs-toggle="tab" data-bs-target="#song-content" 
                    type="button" role="tab" aria-controls="song-content" aria-selected="true">Add Song</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="album-tab" data-bs-toggle="tab" data-bs-target="#album-content" 
                    type="button" role="tab" aria-controls="album-content" aria-selected="false">Add Album</button>
        </li>
    </ul>
    
    <!-- Tab content -->
    <div class="tab-content">
        <!-- Song Tab -->
        <div class="tab-pane fade show active" id="song-content" role="tabpanel" aria-labelledby="song-tab">
            <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data" id="songForm">
                @csrf
                <input type="hidden" name="type" value="song">
                
                <!-- Title -->
                <div class="mb-3">
                    <label for="song_title" class="form-label">Song Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="song_title" class="form-control" required>
                </div>
                
                <!-- Artists -->
                <div class="mb-3">
                    <label for="song_artists" class="form-label">Select Existing Artists</label>
                    <select name="artist_ids[]" id="song_artists" class="form-select" multiple>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (or Command) to select multiple artists.</small>
                </div>
                    
                <!-- Add New Artist -->
                <div class="mb-3">
                    <label for="song_new_artist" class="form-label">Or Add New Artist</label>
                    <input type="text" name="new_artist[]" id="song_new_artist" class="form-control" 
                           placeholder="Enter new artist name">
                    <small class="text-muted">Enter names of new artists separated by commas.</small>
                </div>
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="song_cover_art" class="form-label">Cover Art</label>
                    <input type="file" name="cover_art" id="song_cover_art" class="form-control" accept="image/*">
                </div>
                
                <!-- Audio File -->
                <div class="mb-3">
                    <label for="audio_file" class="form-label">Audio File</label>
                    <input type="file" name="audio_file" id="audio_file" class="form-control" accept="audio/*">
                </div>
                
             
                
                <!-- Release Date -->
                <div class="mb-3">
                    <label for="song_release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" id="song_release_date" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Save Song</button>
            </form>
        </div>
        
        <!-- Album Tab -->
        <div class="tab-pane fade" id="album-content" role="tabpanel" aria-labelledby="album-tab">
            <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data" id="albumForm">
                @csrf
                <input type="hidden" name="type" value="album">
                
                <!-- Title -->
                <div class="mb-3">
                    <label for="album_title" class="form-label">Album Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="album_title" class="form-control" required>
                </div>
                
                <!-- Artists -->
                <div class="mb-3">
                    <label for="album_artists" class="form-label">Select Existing Artists</label>
                    <select name="artist_ids[]" id="album_artists" class="form-select" multiple>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (or Command) to select multiple artists.</small>
                </div>
                    
                <!-- Add New Artist -->
                <div class="mb-3">
                    <label for="album_new_artist" class="form-label">Or Add New Artist</label>
                    <input type="text" name="new_artist[]" id="album_new_artist" class="form-control" 
                           placeholder="Enter new artist name">
                    <small class="text-muted">Enter names of new artists separated by commas.</small>
                </div>
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="album_cover_art" class="form-label">Cover Art</label>
                    <input type="file" name="cover_art" id="album_cover_art" class="form-control" accept="image/*">
                </div>
                
                <!-- Album Songs Section -->
                <div class="mb-4">
                    <h4 class="mt-4 mb-3">Album Songs</h4>
                    
                    <div id="albumSongsList">
                        <div class="song-entry card mb-3 p-3">
                            <div class="mb-2">
                                <label class="form-label">Song Title<span class="text-danger">*</span></label>
                                <input type="text" name="songs[0][title]" class="form-control" required>
                            </div>
                            
                            <div class="mb-2">
                                <label class="form-label">Audio File</label>
                                <input type="file" name="songs[0][audio_file]" class="form-control" accept="audio/*">
                            </div>
                            
                            <div class="mb-2">
                                <label class="form-label">Track Number</label>
                                <input type="number" name="songs[0][track_number]" class="form-control" min="1" value="1">
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" id="addAlbumSongBtn" class="btn btn-secondary mt-2">Add Another Song</button>
                </div>
            
                
                <!-- Release Date -->
                <div class="mb-3">
                    <label for="album_release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" id="album_release_date" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Save Album</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addAlbumSongBtn = document.getElementById('addAlbumSongBtn');
    const albumSongsList = document.getElementById('albumSongsList');
    
    let songCounter = 1;
    
    // Add new song fields for album
    addAlbumSongBtn.addEventListener('click', function() {
        const newSong = document.createElement('div');
        newSong.className = 'song-entry card mb-3 p-3';
        newSong.innerHTML = `
            <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="mb-0">Song ${songCounter + 1}</h5>
                <button type="button" class="btn-close remove-song" aria-label="Remove song"></button>
            </div>
            <div class="mb-2">
                <label class="form-label">Song Title<span class="text-danger">*</span></label>
                <input type="text" name="songs[${songCounter}][title]" class="form-control" required>
            </div>
            
            <div class="mb-2">
                <label class="form-label">Audio File</label>
                <input type="file" name="songs[${songCounter}][audio_file]" class="form-control" accept="audio/*">
            </div>
            
            <div class="mb-2">
                <label class="form-label">Track Number</label>
                <input type="number" name="songs[${songCounter}][track_number]" class="form-control" min="1" value="${songCounter + 1}">
            </div>
        `;
        
        albumSongsList.appendChild(newSong);
        songCounter++;
        
        // Add event listener to the newly created remove button
        newSong.querySelector('.remove-song').addEventListener('click', function() {
            albumSongsList.removeChild(newSong);
            updateTrackNumbers();
        });
    });
    
    // Function to update track numbers when songs are removed
    function updateTrackNumbers() {
        const songEntries = document.querySelectorAll('.song-entry');
        songEntries.forEach((entry, index) => {
            const trackInput = entry.querySelector('input[name$="[track_number]"]');
            if (trackInput) {
                trackInput.value = index + 1;
            }
        });
    }
    
    // Form validation - ensure at least one artist is selected before submission
    document.querySelectorAll('#songForm, #albumForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            const artistSelect = this.querySelector('select[name="artist_ids[]"]');
            const newArtistInput = this.querySelector('input[name="new_artist[]"]');
            
            if (artistSelect.selectedOptions.length === 0 && !newArtistInput.value.trim()) {
                event.preventDefault();
                alert('Please select at least one artist or enter a new artist name.');
            }
        });
    });
});
</script>
@endsection