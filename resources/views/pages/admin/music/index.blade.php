@extends('layouts.auth') <!-- Assuming you have a layout for your app -->

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Songs Section -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div class="col-md-6">
            <h3>Songs</h3>
            <div class="list-group">
                @forelse($songs as $song)
                    <a href="{{ route('music.show', $song->id) }}" class="list-group-item list-group-item-action">
                        {{ $song->title }} <!-- Display song title -->
                    </a>
                @empty
                    <p>No songs available.</p>
                @endforelse
            </div>
        </div>

        <!-- Albums Section -->
        <div class="col-md-6">
            <h3>Albums</h3>
            <div class="list-group">
                @forelse($albums as $album)
                    <a href="{{ route('music.show', $album->id) }}" class="list-group-item list-group-item-action">
                        {{ $album->title }} <!-- Display album title -->
                    </a>
                @empty
                    <p>No albums available.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
