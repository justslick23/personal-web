@extends('layouts.app')
@section('title', $album->title . ' - Tokelo Foso')

@section('content')

@include('partials.page-header', [
    'title' => $album->title,
    'breadcrumbs' => [
        ['name' => 'Music', 'url' => route('music')],
        ['name' => $album->title, 'url' => '#'],
    ]
])

<section class="album-section section-padding">
    <div class="container">
        <!-- Album Hero Section -->
        <div class="row align-items-center mb-5">
            <!-- Album Cover -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="album-cover-container animate-fade-left">
                    <div class="profile-container">
                        <img src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : 'https://via.placeholder.com/400x400?text=No+Cover' }}"
                             class="profile-image album-cover" alt="{{ $album->title }}">
                    </div>
                </div>
            </div>

            <!-- Album Details -->
            <div class="col-lg-7 animate-fade-right">
                <div class="album-info">
                    <h1 class="display-4 fw-bold text-gradient mb-3">{{ $album->title }}</h1>

                    @if($album->relationLoaded('artists') || $album->artists->isNotEmpty())
                        <p class="lead mb-3">
                            <i class="fas fa-microphone me-2 text-primary"></i>
                            <strong>Artist{{ $album->artists->count() > 1 ? 's' : '' }}:</strong>
                            <span class="text-gradient">{{ $album->artists->pluck('name')->join(', ') }}</span>
                        </p>
                    @endif

                    <div class="album-meta mb-4">
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <div class="modern-card p-3 text-center">
                                    <i class="fas fa-compact-disc text-primary fs-4 mb-2"></i>
                                    <div><strong>Album</strong></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="modern-card p-3 text-center">
                                    <i class="fas fa-calendar text-primary fs-4 mb-2"></i>
                                    <div><strong>{{ $album->release_date ? \Carbon\Carbon::parse($album->release_date)->format('Y') : 'N/A' }}</strong></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="modern-card p-3 text-center">
                                    <i class="fas fa-music text-primary fs-4 mb-2"></i>
                                    <div><strong>{{ $album->songs->count() }} Tracks</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($album->genre)
                        <div class="mb-4">
                            <div class="modern-card p-3">
                                <i class="fas fa-tags text-primary me-2"></i>
                                <strong>Genre:</strong> <span class="text-gradient">{{ $album->genre }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Album Stats -->
                    <div class="stats-grid mb-4">
                        <div class="stat-item">
                            <div class="stat-number">{{ number_format($album->streams ?? 0) }}</div>
                            <div class="text-secondary">
                                <i class="fas fa-headphones me-1"></i>Streams
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ number_format($album->downloads ?? 0) }}</div>
                            <div class="text-secondary">
                                <i class="fas fa-download me-1"></i>Downloads
                            </div>
                        </div>
                    </div>

                    <!-- Download Album Button -->
                    <div class="text-center">
                        <a href="{{ route('album.download', $album->slug) }}" class="btn-primary-modern btn-lg">
                            <i class="fas fa-file-archive me-2"></i>Download Full Album (ZIP)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Songs List Section -->
        <div class="row">
            <div class="col-12">
                <div class="songs-section animate-fade-up">
                    <h3 class="text-gradient mb-4 text-center">
                        <i class="fas fa-list-music me-2"></i>Track Listing
                    </h3>

                    <div class="song-list">
                        @forelse($album->songs as $index => $song)
                            <div class="song-item modern-card mb-4">
                                <div class="row align-items-center">
                                    <!-- Track Number & Info -->
                                    <div class="col-lg-4 col-md-5">
                                        <div class="d-flex align-items-center">
                                            <div class="track-number me-3">
                                                <span class="badge bg-primary rounded-circle p-2">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                            <div class="track-info">
                                                <div class="song-title fw-bold text-gradient">{{ $song->title }}</div>
                                                @if($song->artists->isNotEmpty())
                                                    <div class="song-artist text-secondary small">
                                                        {{ $song->artists->pluck('name')->join(', ') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Audio Player -->
                                    <div class="col-lg-5 col-md-4 mt-3 mt-md-0">
                                        <div class="audio-player-wrapper">
                                            <audio id="audio-{{ $song->id }}" class="song-audio w-100" controls
                                                   data-song-id="{{ $song->id }}" 
                                                   style="filter: sepia(1) hue-rotate(180deg) saturate(2); height: 40px; border-radius: 20px;">
                                                <source src="{{ asset('public/' . $song->file_path) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>

                                    <!-- Stats & Actions -->
                                    <div class="col-lg-3 col-md-3 mt-3 mt-md-0">
                                        <div class="track-actions d-flex justify-content-between align-items-center">
                                            <div class="track-stats d-flex gap-3">
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-play me-1"></i>{{ number_format($song->songStatistics->plays ?? 0) }}
                                                </span>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-download me-1"></i>{{ number_format($song->songStatistics->downloads ?? 0) }}
                                                </span>
                                            </div>
                                            <a href="{{ route('music.download', $song->slug) }}" 
                                               class="btn btn-sm btn-outline-primary rounded-pill"
                                               onclick="incrementDownload({{ $song->id }})"
                                               title="Download Track">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="modern-card p-4 text-center">
                                <i class="fas fa-music fs-1 text-secondary mb-3"></i>
                                <h5 class="text-secondary">No songs found in this album</h5>
                                <p class="text-secondary mb-0">Check back later for updates!</p>
                            </div>
                        @endforelse
                    </div>
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
</section>
  





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