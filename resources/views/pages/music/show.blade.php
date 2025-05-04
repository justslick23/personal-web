@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => $track->title,
        'breadcrumbs' => [
            ['name' => 'Music', 'url' => route('music')],
            ['name' => $track->title, 'url' => '#'],
        ]
    ])

    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-5">
                <img src="{{ $track->cover_art ? asset('storage/' . $track->cover_art) : 'https://via.placeholder.com/400x400?text=No+Cover' }}"
                     class="img-fluid rounded shadow" alt="{{ $track->title }}">
            </div>
            <div class="col-md-7">
                <h2>{{ $track->title }}</h2>

                @if($track->relationLoaded('artists'))
                    <p><strong>Artist{{ $track->artists->count() > 1 ? 's' : '' }}:</strong>
                        {{ $track->artists->pluck('name')->join(', ') }}
                    </p>
                @endif

                <p><strong>Type:</strong> {{ class_basename($track) }}</p>
                <p><strong>Released:</strong> {{ $track->release_date ? \Carbon\Carbon::parse($track->release_date)->format('F d, Y') : 'N/A' }}</p>

                @if($track->description)
                    <p class="mt-4">{{ $track->description }}</p>
                @endif

                @if($track instanceof \App\Models\Song && $track->file_path)
                    <!-- Plyr Audio Player -->
                    <div class="mt-3">
                        <audio id="player" controls class="plyr">
                            <source src="{{ asset('storage/' . $track->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                <!-- Stats: Views, Plays, Downloads -->
           <!-- Stats: Views, Plays, Downloads -->
<div class="mt-5">
    <div class="row text-center">
        <!-- Views -->
        <div class="col-4">
            <div class="stat-item">
                <i class="fas fa-eye fa-3x mb-2 text-primary"></i>
                <h4 class="font-weight-bold">{{ $track->statistics->views ?? 0 }}</h4>
                <p class="text-muted">Views</p>
            </div>
        </div>

        <!-- Plays -->
        <div class="col-4">
            <div class="stat-item">
                <i class="fas fa-play-circle fa-3x mb-2 text-success"></i>
                <h4 class="font-weight-bold">{{ $track->statistics->plays ?? 0 }}</h4>
                <p class="text-muted">Plays</p>
            </div>
        </div>

        <!-- Downloads -->
        <div class="col-4">
            <div class="stat-item">
                <i class="fas fa-download fa-3x mb-2 text-danger"></i>
                <h4 class="font-weight-bold">{{ $track->statistics->downloads ?? 0 }}</h4>
                <p class="text-muted">Downloads</p>
            </div>
        </div>
    </div>
</div>


                <!-- Custom Download Button -->
                @if($track instanceof \App\Models\Song && $track->id)
                    <a href="{{ route('music.download', $track->slug) }}" class="btn btn-primary mt-3">
                        <i class="fas fa-download mr-2"></i> Download Now
                    </a>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Plyr Library CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.6.2/dist/plyr.css" />
    <script src="https://cdn.jsdelivr.net/npm/plyr@3.6.2/dist/plyr.min.js"></script>

    <script>
        // Initialize Plyr globally
        document.addEventListener('DOMContentLoaded', function () {
            const players = new Plyr('.plyr'); // Initialize all players on the page

            // Listen for the play event
            players.forEach(player => {
                player.on('play', function () {
                    // Send AJAX request to increment plays
                    fetch('{{ route('music.trackPlay', $track->slug) }}', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                        }
                    });
                });
            });
        });
    </script>
@endpush

@endsection
