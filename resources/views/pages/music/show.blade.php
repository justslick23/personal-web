@extends('layouts.app')
@section('title', $track->title . ' - Tokelo Foso')

@section('content')

@include('partials.page-header', [
    'title' => $track->title,
    'breadcrumbs' => [
        ['name' => 'Music', 'url' => route('music')],
        ['name' => $track->title, 'url' => '#'],
    ]
])

<section class="music-track-details section-padding">
    <div class="container">
        <!-- Hero Section -->
        <div class="row align-items-center mb-5">
            <!-- Track Cover -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="track-cover-container animate-fade-left">
                    <div class="profile-container">
                        <img src="{{ $track->cover_art ? asset('public/' . $track->cover_art) : 'https://via.placeholder.com/400x400?text=No+Cover' }}"
                             class="profile-image track-cover" alt="{{ $track->title }}">
                    </div>
                </div>
            </div>

            <!-- Track Details -->
            <div class="col-lg-7 animate-fade-right">
                <div class="track-info">
                    <h1 class="display-4 fw-bold text-gradient mb-3">{{ $track->title }}</h1>

                    @if($track->relationLoaded('artists') || $track->artists->isNotEmpty())
                        <p class="lead mb-3">
                            <i class="fas fa-microphone me-2 text-primary"></i>
                            <strong>Artist{{ $track->artists->count() > 1 ? 's' : '' }}:</strong>
                            <span class="text-gradient">{{ $track->artists->pluck('name')->join(', ') }}</span>
                        </p>
                    @endif

                    <div class="track-meta mb-4">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="modern-card p-3">
                                    <i class="fas fa-music text-primary me-2"></i>
                                    <strong>Type:</strong> {{ class_basename($track) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="modern-card p-3">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong>Released:</strong> {{ $track->release_date ? \Carbon\Carbon::parse($track->release_date)->format('F d, Y') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($track->genre)
                        <div class="mb-4">
                            <div class="modern-card p-3">
                                <i class="fas fa-tags text-primary me-2"></i>
                                <strong>Genre:</strong> <span class="text-gradient">{{ $track->genre }}</span>
                            </div>
                        </div>
                    @endif

                    @if($track->description)
                        <div class="track-description mb-4">
                            <div class="modern-card p-4">
                                <h5 class="text-gradient mb-3">
                                    <i class="fas fa-info-circle me-2"></i>About This Track
                                </h5>
                                <p class="mb-0">{{ $track->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Stats -->
                    <div class="stats-grid mb-4">
                        <div class="stat-item">
                            <div class="stat-number">{{ number_format($track->songStatistics->views ?? 0) }}</div>
                            <div class="text-secondary">
                                <i class="fas fa-headphones me-1"></i>Plays
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ number_format($track->songStatistics->downloads ?? 0) }}</div>
                            <div class="text-secondary">
                                <i class="fas fa-download me-1"></i>Downloads
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audio Player Section -->
        @if($track instanceof \App\Models\Song && $track->file_path)
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="modern-card p-4 audio-player-container animate-fade-up">
                        <h4 class="text-gradient mb-3">
                            <i class="fas fa-play-circle me-2"></i>Listen Now
                        </h4>
                        <audio id="audio-{{ $track->id }}" class="song-audio w-100" controls
                               data-song-id="{{ $track->id }}" style="filter: sepia(1) hue-rotate(180deg) saturate(2);">
                            <source src="{{ asset('public/' . $track->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
        @endif

        <!-- Download Button -->
        @if($track instanceof \App\Models\Song && $track->id)
            <div class="text-center mb-5">
                <a href="{{ route('music.download', $track->slug) }}" 
                   class="btn-primary-modern btn-lg"
                   onclick="incrementDownload({{ $track->id }})">
                    <i class="fas fa-download me-2"></i>Download Now
                </a>
            </div>
        @endif

        <!-- Related Tracks -->
        @if(isset($relatedTracks) && $relatedTracks->isNotEmpty())
            <div class="related-section animate-fade-up">
                <h3 class="text-gradient mb-4 text-center">
                    <i class="fas fa-music me-2"></i>More from this Artist
                </h3>
                <div class="portfolio-grid">
                    @foreach($relatedTracks as $relatedTrack)
                        <div class="portfolio-item">
                            <div class="portfolio-image-container">
                                <img src="{{ $relatedTrack->cover_art ? asset($relatedTrack->cover_art) : 'https://via.placeholder.com/300x300?text=No+Cover' }}"
                                     class="portfolio-image" alt="{{ $relatedTrack->title }}">
                                <div class="portfolio-overlay">
                                    <a href="{{ route('music.track', $relatedTrack->slug) }}" class="btn-modern">
                                        <i class="fas fa-play me-2"></i>Play Track
                                    </a>
                                </div>
                            </div>
                            <div class="p-4">
                                <h5 class="text-gradient mb-2">{{ $relatedTrack->title }}</h5>
                                <p class="text-secondary mb-3">
                                    {{ $relatedTrack->artists->pluck('name')->join(', ') }}
                                </p>
                                <a href="{{ route('music.track', $relatedTrack->slug) }}" class="btn-modern btn-sm">
                                    <i class="fas fa-info-circle me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="modern-card p-4 mb-4" style="border-color: var(--primary-color);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle text-primary me-3 fs-4"></i>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        <!-- Newsletter Signup -->
        <div class="newsletter-section animate-fade-up">
            <div class="modern-card p-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h4 class="text-gradient mb-3">
                            <i class="fas fa-envelope me-2"></i>Stay Updated
                        </h4>
                        <p class="text-secondary mb-4">Subscribe to our mailing list for new music updates and exclusive releases</p>
                        <form action="{{ route('subscribe') }}" method="POST" class="row g-3 justify-content-center align-items-end">
                            @csrf
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control form-control-lg" 
                                       placeholder="Enter your email address" required
                                       style="background: var(--card-bg); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 50px;">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn-primary-modern btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<style>
    .bg-dark {
        background-color: #1a1a1a !important;
    }
    .text-light-50 {
        color: rgba(255, 255, 255, 0.7);
    }
</style>

<script>


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.song-audio').forEach(audio => {
        audio.addEventListener('play', () => {
            incrementPlay(audio.dataset.songId);
        });
    });
});


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
@endpush
@endsection
