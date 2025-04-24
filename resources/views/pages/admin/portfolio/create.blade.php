@extends('layouts.auth')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Portfolio Item</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Please fix the following issues:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description </label>
            <textarea name="description" rows="5" class="form-control" ></textarea>
        </div>

        <!-- Category (optional) -->
        <div class="form-group">
            <label for="category">Category (Optional)</label>
            <select name="category" class="form-control">
                <option value="">-- Select Category --</option>
                <option value="Web App Design">App Design</option>
                <option value="Poster Design">Poster Design</option>
             
            </select>
        </div>
        

        <!-- Image Upload -->
        <div class="form-group">
            <label for="image">Project Image <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control-file" accept="image/*" required>
        </div>

        <!-- Project URL (optional) -->
        <div class="form-group">
            <label for="link">Project URL (Optional)</label>
            <input type="url" name="link" class="form-control">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Save Portfolio Item</button>
        <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
