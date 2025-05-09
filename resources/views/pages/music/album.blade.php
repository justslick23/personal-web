@extends('layouts.app')

@section('content')

@section('title', $album->title . ' - Tokelo Foso')

    @include('partials.page-header', [
        'title' => $album->title,
        'breadcrumbs' => [
            ['name' => 'Music', 'url' => route('music')],
            ['name' => $album->title, 'url' => '#'],
        ]
    ])

    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Left side: Album Cover -->
            <div class="col-md-5">
                <img src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : 'https://via.placeholder.com/400x400?text=No+Cover' }}"
                     class="img-fluid rounded shadow" alt="{{ $album->title }}">
            </div> <!-- Fixed: Added missing closing div tag -->

            <!-- Right side: Album Details -->
            <div class="col-md-7">
                <h2>{{ $album->title }}</h2>

                <!-- Artist(s) -->
                @if($album->relationLoaded('artists') || $album->artists->isNotEmpty())
                    <p><strong>Artist{{ $album->artists->count() > 1 ? 's' : '' }}:</strong>
                        {{ $album->artists->pluck('name')->join(', ') }}
                    </p>
                @endif

                <!-- Additional Details -->
                <p><strong>Type:</strong> Album</p>
                <p><strong>Released:</strong> {{ $album->release_date ? \Carbon\Carbon::parse($album->release_date)->format('F d, Y') : 'N/A' }}</p>
                <p><strong>Genre:</strong> {{ $album->genre ?? 'N/A' }}</p>

            
                </div>
                
                <div class="d-flex gap-3 align-items-center mt-3">
                    <span class="badge bg-primary text-white px-3 py-2">
                        <i class="fas fa-headphones-alt me-1"></i>
                        {{ number_format($album->streams ?? 0) }} Streams
                    </span>
                
                    <span class="badge bg-success text-white px-3 py-2">
                        <i class="fas fa-download me-1"></i>
                        {{ number_format($album->downloads ?? 0) }} Downloads
                    </span>
                <a href="{{ route('album.download', $album->slug) }}" class="btn btn-primary mb-4">
                    <i class="fas fa-file-archive"></i> Download Full Album (ZIP)
                </a>
                
            </div>
        </div>

        <hr class="my-5">

        <!-- Song List -->
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4">Songs</h4>

                <div class="song-list">
                    @forelse($album->songs as $index => $song)
                    <div class="song-item p-3 mb-3 rounded bg-dark text-white">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="d-flex align-items-center">
                                    <span class="song-number me-3 text-light-50">{{ $index + 1 }}</span>
                                    <div>
                                        <div class="song-title fw-bold">{{ $song->title }}</div>
                                        @if($song->artists->isNotEmpty())
                                            <div class="song-artist text-light-50">
                                                {{ $song->artists->pluck('name')->join(', ') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <audio id="audio-{{ $song->id }}" class="song-audio" style="width: 100%;" controls
                                       data-song-id="{{ $song->id }}"> 
                                    <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            
                            <script>
                            // Define the incrementPlay function in the global scope so it can be accessed from HTML
                            function incrementPlay(songId) {
                                console.log('Tracking play for song ID:', songId);
                                
                                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                                
                                if (!csrfToken) {
                                    console.error('CSRF token not found');
                                    return;
                                }
                                
                                fetch('/music/play/' + songId, {
                                    method: 'GET',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok: ' + response.status);
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.message === 'Play recorded') {
                                        console.log('Play incremented successfully for song ID:', songId);
                                    } else {
                                        console.log('Failed to increment play for song ID:', songId);
                                    }
                                })
                                .catch(function(error) {
                                    console.error('Error logging play:', error);
                                });
                            }
                            
                            document.addEventListener('DOMContentLoaded', function() {
                                // Get all audio players and add the 'play' event listener
                                const audioPlayers = document.querySelectorAll('.song-audio');
                                audioPlayers.forEach(audio => {
                                    audio.addEventListener('play', function() {
                                        const songId = this.getAttribute('data-song-id');
                                        incrementPlay(songId);
                                    });
                                });
                            });
                            </script>
                            
                            
                            <div class="col-lg-3 mt-2 mt-lg-0">
                                <div class="song-stats d-flex justify-content-between">
                                    <div class="text-light-50 small">
                                        <i class="fas fa-play"></i> 
                                        {{ number_format($song->songStatistics->plays ?? 0) }}
                                    </div>
                                    <div class="text-light-50 small">
                                        <i class="fas fa-download"></i>
                                        {{ number_format($song->songStatistics->downloads ?? 0) }}
                                    </div>
                                    <a href="{{ route('music.download', $song->slug) }}" class="btn btn-sm btn-outline-primary" 
                                       onclick="incrementDownload({{ $song->id }})">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @empty
                        <div class="alert alert-info">No songs found in this album.</div>
                    @endforelse
                </div>
            </div>
        </div> 
  
        @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
        @endif
    
        <div class="mt-5">
            <h5>Subscribe to our mailing list for new music updates</h5>
            <form action="{{ route('subscribe') }}" method="POST" class="row g-2">
                @csrf
                <div class="col-auto">
                    <input type="email" name="email" class="form-control" placeholder="Your email" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </div>
            </form>
        </div>
    </div>

  





    @push('scripts')
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- No need for WaveSurfer.js with standard HTML5 audio players -->
 
        
        <style>
            /* Custom audio player styles */
            .custom-audio-player {
                display: flex;
                align-items: center;
                border-radius: 8px;
                padding: 6px;
            }
            
            .bg-dark {
                background-color: #1a1a1a !important;
            }
            
            .text-light-50 {
                color: rgba(255, 255, 255, 0.7);
            }
        </style>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded - standard audio players ready');
                
                // Handle pausing other songs when one starts playing
                var audioPlayers = document.querySelectorAll('.song-audio');
                
                // Keep track of songs already played in this session
                const playedSongs = new Set();
                
           
        

                
                // Function to increment download count
                function incrementDownload(songId) {
                    console.log('Download tracked for song ID:', songId);
                    fetch('{{ url('/music/download') }}/' + songId, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    }).catch(function(error) {
                        console.error('Error logging download:', error);
                    });
                }
        
                // Function to increment album view
                function incrementAlbumView(albumId) {
                    console.log('Tracking view for album ID:', albumId);
                    fetch('/api/albums/' + albumId + '/view', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    }).catch(function(error) {
                        console.error('Error logging album view:', error);
                    });
                }
        
                // Call incrementAlbumView when page loads
                incrementAlbumView({{ $album->id }});
            });
        </script>
        
    @endpush
@endsection