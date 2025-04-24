@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Portfolio</h2>
        <a href="{{ route('portfolio.create') }}" class="btn btn-success">+ Add New</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($portfolios->count())
        <div class="row">
            @foreach ($portfolios as $portfolio)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" class="card-img-top" alt="{{ $portfolio->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $portfolio->title }}</h5>
                            <p class="card-text">{{ Str::limit($portfolio->description, 100) }}</p>
                            @if ($portfolio->link)
                                <a href="{{ $portfolio->link }}" target="_blank" class="btn btn-sm btn-outline-primary">View Project</a>
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <small class="text-muted">{{ $portfolio->category ?? 'Uncategorized' }}</small>
                            <div>
                                <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No portfolio items found. Start by <a href="{{ route('portfolio.create') }}">adding one</a>.</p>
    @endif
</div>
@endsection
