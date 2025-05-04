@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>{{ $song->name }}</h1>
    <p><strong>Release Date:</strong> {{ $song->release_date ? \Carbon\Carbon::parse($song->release_date)->format('F j, Y') : 'N/A' }}</p>
    
    @if ($song->cover_art)
        <img src="{{ asset('storage/' . $song->cover_art) }}" alt="Cover Art" style="max-width: 300px;">
    @endif

    <p><strong>Description:</strong> {{ $song->description ?? 'No description provided.' }}</p>

    <p><strong>Artists:</strong>
        @foreach ($song->artists as $artist)
            {{ $artist->name }}{{ !$loop->last ? ',' : '' }}
        @endforeach
    </p>

    @if ($song->file_path)
        <audio controls>
            <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
