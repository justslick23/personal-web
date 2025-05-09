@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ isset($music) ? 'Edit Music' : 'Add New Music' }}</h2>
    
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
            <button class="nav-link {{ isset($music) && $music->type == 'song' ? 'active' : '' }}" id="song-tab" data-bs-toggle="tab" data-bs-target="#song-content" 
                    type="button" role="tab" aria-controls="song-content" aria-selected="true">Edit Song</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ isset($music) && $music->type == 'album' ? 'active' : '' }}" id="album-tab" data-bs-toggle="tab" data-bs-target="#album-content" 
                    type="button" role="tab" aria-controls="album-content" aria-selected="false">Edit Album</button>
        </li>
    </ul>
    
    <!-- Tab content -->
    <div class="tab-content">
        <!-- Song Tab -->
        <div class="tab-pane fade show {{ isset($music) && $music->type == 'song' ? 'active' : '' }}" id="song-content" role="tabpanel" aria-labelledby="song-tab">
            <form action="{{ isset($music) ? route('music.update', $music->id) : route('music.store') }}" method="POST" enctype="multipart/form-data" id="songForm">
                @csrf
                @if(isset($music))
                    @method('PUT')
                @endif
                <input type="hidden" name="type" value="song">
                
                <!-- Title -->
                <div class="mb-3">
                    <label for="song_title" class="form-label">Song Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="song_title" class="form-control" value="{{ old('title', $music->title ?? '') }}" required>
                </div>
                
                <!-- Artists -->
                <div class="mb-3">
                    <label for="song_artists" class="form-label">Select Existing Artists</label>
                    <select name="artist_ids[]" id="song_artists" class="form-select" multiple>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ isset($music) && $music->artists->contains($artist->id) ? 'selected' : '' }}>{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (or Command) to select multiple artists.</small>
                </div>
                    
                <!-- Add New Artist -->
                <div class="mb-3">
                    <label for="song_new_artist" class="form-label">Or Add New Artist</label>
                    <input type="text" name="new_artist[]" id="song_new_artist" class="form-control" 
                           value="{{ old('new_artist', '') }}" placeholder="Enter new artist name">
                    <small class="text-muted">Enter names of new artists separated by commas.</small>
                </div>
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="song_cover_art" class="form-label">Cover Art</label>
                    <input type="file" name="cover_art" id="song_cover_art" class="form-control" accept="image/*">
                    @if(isset($music) && $music->cover_art)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $music->cover_art) }}" alt="Cover Art" style="max-width: 150px;">
                        </div>
                    @endif
                </div>
                
                <!-- Audio File -->
                <div class="mb-3">
                    <label for="audio_file" class="form-label">Audio File</label>
                    <input type="file" name="audio_file" id="audio_file" class="form-control" accept="audio/*">
                </div>
                
                <!-- Release Date -->
                <div class="mb-3">
                    <label for="song_release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" id="song_release_date" class="form-control" value="{{ old('release_date', $music->release_date ?? '') }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Save Song</button>
            </form>
        </div>
        
        <!-- Album Tab -->
        <div class="tab-pane fade show {{ isset($music) && $music->type == 'album' ? 'active' : '' }}" id="album-content" role="tabpanel" aria-labelledby="album-tab">
            <form action="{{ isset($music) ? route('music.update', $music->id) : route('music.store') }}" method="POST" enctype="multipart/form-data" id="albumForm">
                @csrf
                @if(isset($music))
                    @method('PUT')
                @endif
                <input type="hidden" name="type" value="album">
                
                <!-- Title -->
                <div class="mb-3">
                    <label for="album_title" class="form-label">Album Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="album_title" class="form-control" value="{{ old('title', $music->title ?? '') }}" required>
                </div>
                
                <!-- Artists -->
                <div class="mb-3">
                    <label for="album_artists" class="form-label">Select Existing Artists</label>
                    <select name="artist_ids[]" id="album_artists" class="form-select" multiple>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ isset($music) && $music->artists->contains($artist->id) ? 'selected' : '' }}>{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (or Command) to select multiple artists.</small>
                </div>
                    
                <!-- Add New Artist -->
                <div class="mb-3">
                    <label for="album_new_artist" class="form-label">Or Add New Artist</label>
                    <input type="text" name="new_artist[]" id="album_new_artist" class="form-control" 
                           value="{{ old('new_artist', '') }}" placeholder="Enter new artist name">
                    <small class="text-muted">Enter names of new artists separated by commas.</small>
                </div>
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="album_cover_art" class="form-label">Cover Art</label>
                    <input type="file" name="cover_art" id="album_cover_art" class="form-control" accept="image/*">
                    @if(isset($music) && $music->cover_art)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $music->cover_art) }}" alt="Cover Art" style="max-width: 150px;">
                        </div>
                    @endif
                </div>
                
                <!-- Album Songs Section -->
                <div class="mb-4">
                    <h4 class="mt-4 mb-3">Album Songs</h4>
                    
                    <div id="albumSongsList">
                        @foreach($music->songs as $index => $song)
                            <div class="song-entry card mb-3 p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="mb-0">Song {{ $index + 1 }}</h5>
                                    <button type="button" class="btn-close remove-song" aria-label="Remove song"></button>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Song Title<span class="text-danger">*</span></label>
                                    <input type="text" name="songs[{{ $index }}][title]" class="form-control" value="{{ $song->title }}" required>
                                </div>
                                
                                <div class="mb-2">
                                    <label class="form-label">Audio File</label>
                                    <input type="file" name="songs[{{ $index }}][audio_file]" class="form-control" accept="audio/*">
                                    @if($song->audio_file)
                                        <div class="mt-2">
                                            <audio controls>
                                                <source src="{{ asset('storage/' . $song->audio_file) }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mb-2">
                                    <label class="form-label">Track Number</label>
                                    <input type="number" name="songs[{{ $index }}][track_number]" class="form-control" min="1" value="{{ $song->track_number }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <button type="button" class="btn btn-outline-primary" id="addSongBtn">Add Another Song</button>
                </div>
                
                <button type="submit" class="btn btn-primary">Save Album</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('addSongBtn').addEventListener('click', function() {
        const songTemplate = `
            <div class="song-entry card mb-3 p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="mb-0">Song</h5>
                    <button type="button" class="btn-close remove-song" aria-label="Remove song"></button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Song Title<span class="text-danger">*</span></label>
                    <input type="text" name="songs[][title]" class="form-control" required>
                </div>
                
                <div class="mb-2">
                    <label class="form-label">Audio File</label>
                    <input type="file" name="songs[][audio_file]" class="form-control" accept="audio/*">
                </div>
                
                <div class="mb-2">
                    <label class="form-label">Track Number</label>
                    <input type="number" name="songs[][track_number]" class="form-control" min="1">
                </div>
            </div>
        `;
        const songList = document.getElementById('albumSongsList');
        songList.insertAdjacentHTML('beforeend', songTemplate);
    });

    // Remove song entry
    document.getElementById('albumSongsList').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-song')) {
            event.target.closest('.song-entry').remove();
        }
    });
</script>

@endsection
