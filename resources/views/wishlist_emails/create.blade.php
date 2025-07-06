@extends('layouts.auth')

@section('title', 'Add Wishlist Email Subscriber')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Add Wishlist Email Subscriber</h1>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('wishlistEmails.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name (optional)</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name (optional)</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <button type="submit" class="btn btn-primary">Add Subscriber</button>
        <a href="{{ route('wishlistEmails.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
