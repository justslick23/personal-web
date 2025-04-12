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
                <img src="{{ $track->cover_url }}" class="img-fluid rounded shadow" alt="{{ $track->title }}">
            </div>
            <div class="col-md-7">
                <h2>{{ $track->title }}</h2>
                <p><strong>Artist:</strong> {{ $track->artist }}</p>
                <p><strong>Genre:</strong> {{ $track->genre }}</p>
                <p><strong>Released:</strong> {{ $track->year }}</p>
                <p class="mt-4">{{ $track->description }}</p>

                <audio controls class="w-100 mt-3">
                    <source src="{{ $track->audio_url }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </div>
@endsection
