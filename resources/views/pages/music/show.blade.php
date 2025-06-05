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

<section class="music-track-details">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Track Cover -->
            <div class="col-md-5">
                <img src="{{ $track->cover_art ? asset('public/' . $track->cover_art) : 'https://via.placeholder.com/400x400?text=No+Cover' }}"
                     class="img-fluid rounded shadow" alt="{{ $track->title }}">
            </div>

            <!-- Track Details -->
            <div class="col-md-7">
                <h2>{{ $track->title }}</h2>

                @if($track->relationLoaded('artists') || $track->artists->isNotEmpty())
                    <p><strong>Artist{{ $track->artists->count() > 1 ? 's' : '' }}:</strong>
                        {{ $track->artists->pluck('name')->join(', ') }}
                    </p>
                @endif

                <p><strong>Type:</strong> {{ class_basename($track) }}</p>
                <p><strong>Released:</strong> {{ $track->release_date ? \Carbon\Carbon::parse($track->release_date)->format('F d, Y') : 'N/A' }}</p>

                @if($track->genre)
                    <p><strong>Genre:</strong> {{ $track->genre }}</p>
                @endif

                @if($track->description)
                    <p class="mt-4">{{ $track->description }}</p>
                @endif

                <div class="d-flex gap-3 align-items-center mt-3">
                    <span class="badge bg-primary text-white px-3 py-2">
                        <i class="fas fa-headphones-alt me-1"></i>
                        {{ number_format($track->statistics->plays ?? 0) }} Plays
                    </span>

                    <span class="badge bg-success text-white px-3 py-2">
                        <i class="fas fa-download me-1"></i>
                        {{ number_format($track->statistics->downloads ?? 0) }} Downloads
                    </span>
                </div>

                @if($track instanceof \App\Models\Song && $track->file_path)
                    <div class="mt-4 song-item p-3 mb-3 rounded bg-dark text-white">
                        <audio id="audio-{{ $track->id }}" class="song-audio w-100" controls
                               data-song-id="{{ $track->id }}">
                            <source src="{{ asset(path: 'public/' . $track->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                @if($track instanceof \App\Models\Song && $track->id)
                    <a href="{{ route('music.download', $track->slug) }}" class="btn btn-primary mt-4"
                        onclick="incrementDownload({{ $track->id }})">
                        <i class="fas fa-download me-2"></i> Download Now
                    </a>
                @endif
            </div>
        </div>

        <hr class="my-5">

        @if(isset($relatedTracks) && $relatedTracks->isNotEmpty())
            <h4 class="mb-4">More from this Artist</h4>
            <div class="row">
                @foreach($relatedTracks as $relatedTrack)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 bg-dark text-white">
                            <img src="{{ $relatedTrack->cover_art ? asset($relatedTrack->cover_art) : 'https://via.placeholder.com/300x300?text=No+Cover' }}"
                                 class="card-img-top" alt="{{ $relatedTrack->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedTrack->title }}</h5>
                                <p class="card-text text-light-50">
                                    {{ $relatedTrack->artists->pluck('name')->join(', ') }}
                                </p>
                                <a href="{{ route('music.track', $relatedTrack->slug) }}" class="btn btn-outline-primary btn-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

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
