@extends('layouts.auth')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">All Music</h3>
    
    <div class="mb-4">
        <a href="{{ route('music.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Song/Album</a>
    </div>
    
    <!-- Display Songs -->
    <div class="mb-4">
        <h4 class="mb-3">Songs</h4>
        <div class="row">
            @foreach($songs as $song)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $song->title }}</h5>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('music.edit', $song->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                
                                <form action="{{ route('music.destroy', $song->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Display Albums -->
    <div>
        <h4 class="mb-3">Albums</h4>
        <div class="row">
            @foreach($albums as $album)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->title }}</h5>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('music.edit', $album->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                <form action="{{ route('music.destroy', $album->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
