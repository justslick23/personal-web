@extends('layouts.auth')

@section('title', 'Wishlist Email Subscribers')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Wishlist Email Subscribers</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('wishlistEmails.create') }}" class="btn btn-primary mb-3">Add New Subscriber</a>

    @if($subscribers->isEmpty())
        <p>No subscribers found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Subscribed On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $subscriber)
                <tr>
                    <td>{{ $loop->iteration + ($subscribers->currentPage() - 1) * $subscribers->perPage() }}</td>
                    <td>{{ $subscriber->first_name ?? '-' }}</td>
                    <td>{{ $subscriber->last_name ?? '-' }}</td>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('wishlistEmails.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('Delete this subscriber?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $subscribers->links() }}
    @endif
</div>
@endsection
