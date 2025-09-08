@extends('layouts.app')

@section('title', 'Discography - Tokelo Foso')

@section('content')
    @include('partials.page-header', [
        'title' => 'Discography',
        'breadcrumbs' => [
            ['name' => 'Music', 'url' => route('music')],
        ]
    ])

    <section class="discography-section section-padding">
        <div class="container">
            <h2 class="text-center mb-4 text-gradient">My Discography</h2>
            <p class="text-center mb-5 text-secondary">Click a cover to view song or album details.</p>

            {{-- Mailing List --}}
            <div class="mt-5 text-center">
                <h5 class="text-glow">Subscribe to our mailing list for new music updates</h5>
                <form action="{{ route('subscribe') }}" method="POST" class="row g-2 justify-content-center mt-3 contact-form">
                    @csrf
                    <div class="col-auto">
                        <input type="email" name="email" class="form-control" placeholder="Your email" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn-modern btn-primary-modern">Subscribe</button>
                    </div>
                </form>
            </div>

            <br><br>

            {{-- Albums Section --}}
            <h3 class="mb-3 text-gradient">Albums</h3>
            <div class="row g-4 mb-5">
                @forelse ($albums as $album)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('albums.view', $album->slug) }}" class="text-decoration-none">
                            <div class="modern-card h-100 text-center">
                                <img src="{{ $album->cover_image ? asset('public/' . $album->cover_image) : 'https://via.placeholder.com/400x400?text=No+Cover' }}" 
                                     class="wishlist-image" 
                                     alt="{{ $album->title }}">
                                <div class="mt-3">
                                    <h5 class="card-title">{{ $album->title }}</h5>
                                    <p class="text-secondary mb-0">
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
            <h3 class="mb-3 text-gradient">All Songs</h3>
            <div class="row g-4">
                @forelse ($songs as $track)
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('music.show', ['slug' => $track->slug]) }}" class="text-decoration-none">
                            <div class="modern-card h-100 text-center">
                                <img src="{{ $track->cover_art ? asset('public/' .$track->cover_art) : 'https://via.placeholder.com/400x400?text=No+Cover' }}" 
                                     class="wishlist-image" 
                                     alt="{{ $track->title }}">
                                <div class="mt-3">
                                    <h5 class="card-title">{{ $track->title }}</h5>
                                    <p class="text-secondary mb-0">
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
