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
        <p class="text-center text-muted mb-5">Click a cover to view song/album details.</p>

        <div class="row g-4">
            @foreach ($tracks as $track)
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('music.show', $track->id) }}" class="text-decoration-none text-dark">
                        <div class="card shadow-sm h-100 border-0">
                            <img src="{{ $track->cover_url }}" class="card-img-top" alt="{{ $track->title }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $track->title }}</h5>
                                <p class="card-text text-center text-muted">{{ $track->artist }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
