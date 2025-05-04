@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Discography',
        'breadcrumbs' => [
            ['name' => 'Music', 'url' => route('music')],
        ]
    ])

    <div class="container py-5">
        <h2 class="text-center mb-4">My Discography</h2>
        <p class="text-center text-muted mb-5">Click a cover to view song or album details.</p>

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
@endsection
