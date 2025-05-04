@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Create New Album</h2>
    
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
    
    <div class="mb-4">
        <a href="{{ route('song.create') }}" class="btn btn-outline-primary">
            <i class="fas fa-music"></i> Add Single Song Instead
        </a>
    </div>
    
    <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Album Details</h4>
            </div>
            <div class="card-body">
                <!-- Album Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Album Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                
                <!-- Artists -->
                <div class="mb-3">
                    <label for="artists" class="form-label">Album Artists<span class="text-danger">*</span></label>
                    <select name="artist_ids[]" class="form-select" multiple required>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (or Command) to select multiple artists.</small>
                </div>
                
                <!-- Add New Artist -->
                <div class="mb-3">
                    <label for="new_artist" class="form-label">Or Add New Artist</label>
                    <input type="text" name="new_artist" class="form-control" placeholder="Enter new artist name">
                    <small class="text-muted">Enter names of new artists separated by commas.</small>
                </div>
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="cover_art" class="form-label">Album Cover Art<span class="text-danger">*</span></label>
                    <input type="file" name="cover_art" class="form-control" accept="image/*" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Release Date -->
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="date" name="release_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Genre -->
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" name="genre" class="form-control">
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Album Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                
                <!-- Bulk Upload Option -->
                <div class="mb-3">
                    <label for="zip_file" class="form-label">Bulk Upload (Optional)</label>
                    <input type="file" name="zip_file" class="form-control" accept="application/zip">
                    <small class="text-muted">You can upload a zip file containing all album tracks. Track names will be taken from filenames.</small>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Album Tracks</h4>
                <button type="button" class="btn btn-light" id="addTrackBtn">
                    <i class="fas fa-plus"></i> Add Track
                </button>
            </div>
            <div class="card-body">
                <div id="tracksList">
                    <!-- Tracks will be added here dynamically -->
                </div>
                
                <div class="text-center py-4" id="noTracksMessage">
                    <p class="text-muted">No tracks added yet. Click "Add Track" to begin adding songs to this album.</p>
                </div>
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Save Album
            </button>
        </div>
    </form>
</div>

<!-- Track Template (hidden) -->
<template id="trackTemplate">
    <div class="track-item card mb-3">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Track <span class="track-number"></span></h5>
            <button type="button" class="btn btn-sm btn-danger remove-track">
                <i class="fas fa-times"></i> Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Track Title<span class="text-danger">*</span></label>
                        <input type="text" name="tracks[INDEX][title]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Track Number</label>
                        <input type="number" name="tracks[INDEX][track_number]" class="form-control" value="INDEX" min="1">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" name="tracks[INDEX][duration]" class="form-control" placeholder="03:45">
                        <small class="text-muted">Auto-detected from file</small>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Audio File<span class="text-danger">*</span></label>
                <input type="file" name="tracks[INDEX][audio_file]" class="form-control" accept="audio/*" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Featured Artists (if different from album artists)</label>
                <select name="tracks[INDEX][artist_ids][]" class="form-select" multiple>
                    <option value="">Same as album</option>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Track Description</label>
                <textarea name="tracks[INDEX][description]" class="form-control" rows="2"></textarea>
            </div>
        </div>
    </div>
</template>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addTrackBtn = document.getElementById('addTrackBtn');
    const tracksList = document.getElementById('tracksList');
    const trackTemplate = document.getElementById('trackTemplate');
    const noTracksMessage = document.getElementById('noTracksMessage');
    let trackCount = 0;
    
    // Add track function
    function addTrack() {
        const index = trackCount;
        trackCount++;
        
        // Hide the "no tracks" message
        noTracksMessage.style.display = 'none';
        
        // Clone the template
        const trackNode = document.importNode(trackTemplate.content, true);
        
        // Update track number and field names
        trackNode.querySelector('.track-number').textContent = trackCount;
        
        // Replace INDEX with actual index in all field names
        const inputs = trackNode.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.name) {
                input.name = input.name.replace(/INDEX/g, index);
            }
        });
        
        // Set initial track number value
        const trackNumberInput = trackNode.querySelector('input[name="tracks[' + index + '][track_number]"]');
        if (trackNumberInput) {
            trackNumberInput.value = trackCount;
        }
        
        // Add remove event listener
        const removeBtn = trackNode.querySelector('.remove-track');
        removeBtn.addEventListener('click', function() {
            this.closest('.track-item').remove();
            updateTrackNumbers();
            
            // Show "no tracks" message if all tracks are removed
            if (tracksList.children.length === 0) {
                noTracksMessage.style.display = 'block';
            }
        });
        
        // Add to DOM
        tracksList.appendChild(trackNode);
    }
    
    // Update track numbers after removal
    function updateTrackNumbers() {
        const tracks = tracksList.querySelectorAll('.track-item');
        tracks.forEach((track, idx) => {
            track.querySelector('.track-number').textContent = idx + 1;
            
            // Update track number input value to match position
            const trackNumberInput = track.querySelector('input[name*="[track_number]"]');
            if (trackNumberInput) {
                trackNumberInput.value = idx + 1;
            }
        });
    }
    
    // Add track button
    addTrackBtn.addEventListener('click', addTrack);
});
</script>
@endsection