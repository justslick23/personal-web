@extends('layouts.app')

@section('title', 'Discography - Tokelo Foso')

@section('content')
    @include('partials.page-header', [
        'title' => 'Discography',
        'breadcrumbs' => [
            ['name' => 'Music', 'url' => route('music')],
        ]
    ])

    <section class="discography-section">
        <div class="container py-5">
            <h2 class="text-center mb-4">My Discography</h2>
            <p class="text-center text-white mb-5" style = "text-color: white;">Click a cover to view song or album details.</p>

            <div class="mt-5 text-center">
                <h5>Subscribe to our mailing list for new music updates</h5>
                <form action="{{ route('subscribe') }}" method="POST" class="row g-2 justify-content-center mt-2">
                    @csrf
                    <div class="col-auto">
                        <input type="email" name="email" class="form-control" placeholder="Your email" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
            </div>
            <br><br>            

            {{-- Albums Section --}}
            <h3 class="mb-3">Albums</h3>
            <div class="row g-4 mb-5">
                @forelse ($albums as $album)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('albums.view', $album->slug) }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100 border-0">
                                <img src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : 'https://via.placeholder.com/400x400?text=No+Cover' }}" class="card-img-top" alt="{{ $album->title }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $album->title }}</h5>
                                    <p class="card-text text-muted">
                                        @if($album->artists->isNotEmpty())
                                            {{ $album->artists->pluck('name')->join(', ') }}
                                        @else
                                            No artists available
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted">No albums found.</p>
                @endforelse
            </div>

            {{-- Songs Section --}}
            <h3 class="mb-3">All Songs</h3>
            <div class="row g-4">
                @forelse ($songs as $track)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('music.show', ['slug' => $track->slug]) }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100 border-0">
                                <img src="{{ $track->cover_art ? asset('storage/' . $track->cover_art) : 'https://via.placeholder.com/400x400?text=No+Cover' }}" class="card-img-top" alt="{{ $track->title }}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $track->title }}</h5>
                                    <p class="card-text text-center text-muted">
                                        {{ $track->artist }}
                                        @if ($track->album)
                                            — <em>{{ $track->album->title }}</em>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted">No songs found.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
@push('styles')
<style>
    .discography-section {
    position: relative;
    background: radial-gradient(
        circle at 50% 50%,
        rgba(12, 10, 21, 0.3),
        #0f0f1d 50%,
        #0a0a23 100%
    );
    background-attachment: fixed;
    overflow: hidden;
}

.discography-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/images/background 2.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    filter: brightness(50%);
    z-index: -1;
}

    </style>
    
@endpush