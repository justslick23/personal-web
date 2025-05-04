@extends('layouts.auth')

@section('content')
<div class="container mt-4">
    <h2>{{ $album->title }}</h2>
    <p><strong>Release Date:</strong> {{ $album->release_date ?? 'N/A' }}</p>

    @if ($album->cover_image)
        <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Art" class="img-fluid mb-3" style="max-width:300px;">
    @endif

    <h4>Songs in this Album</h4>
    <ul class="list-group">
        @forelse($album->songs as $song)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $song->track_number }}. {{ $song->title }}
                @if ($song->file_path)
                    <audio controls style="height: 25px;">
                        <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @endif
            </li>
        @empty
            <li class="list-group-item">No songs found in this album.</li>
        @endforelse
    </ul>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
