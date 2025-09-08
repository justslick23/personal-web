@extends('layouts.app')
@section('title', 'Wishlist - Tokelo Foso')

@section('content')

{{-- ✅ Page Header --}}
@include('partials.page-header', [
    'title' => 'Slicksters List',
    'breadcrumbs' => [
        ['name' => 'Wishlist', 'url' => route('wishlist.public')],
    ]
])

<section class="wishlist-showcase">
    <div class="container py-5">

        @if($items->isEmpty())
            <!-- Empty State -->
            <div class="empty-wishlist text-center py-5">
                <div class="empty-illustration mb-4">
                    <i class="fas fa-heart-broken fa-4x text-muted opacity-50"></i>
                </div>
                <h3 class="text-muted mb-3">Wishlist is currently empty</h3>
                <p class="text-muted">Check back soon for new items!</p>
            </div>
        @else
            <!-- Wishlist Grid -->
            <div class="row g-4">
                @foreach($items as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            {{-- Fulfilled Badge --}}
                            @if($item->is_received)
                                <div class="position-absolute top-0 end-0 m-2 badge bg-success px-3 py-2 shadow">
                                    <i class="fas fa-heart me-1"></i> Fulfilled
                                </div>
                            @endif

                            {{-- Image --}}
                            <img src="{{ $item->image ? asset('public/' . $item->image) : 'https://via.placeholder.com/400x400?text=No+Image' }}"
                                 alt="{{ $item->title }}"
                                 class="wishlist-image">

                            {{-- Details --}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">{{ $item->title }}</h5>

                                @if($item->description)
                                    <p class="card-text text-muted small mb-3">{{ $item->description }}</p>
                                @endif

                                @if($item->price)
                                    <p class="fw-bold mb-3 text-primary">M{{ number_format($item->price, 2) }}</p>
                                @endif

                                <div class="mt-auto d-flex flex-column gap-2">
                                    @if(!$item->is_received)
                                        {{-- Contribute --}}
                                        @if($item->contribution_link)
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-contribute dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-heart me-1"></i> Contribute
                                                </button>
                                                <ul class="dropdown-menu w-100 shadow-sm">
                                                    <li>
                                                        <a class="dropdown-item" target="_blank" href="https://paypal.me/JustSlick?country.x=LS&locale.x=en_US">
                                                            <i class="fab fa-paypal me-2 text-primary"></i> PayPal
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mpesaModal">
                                                            <i class="fas fa-mobile-alt me-2 text-success"></i> M-Pesa / EcoCash
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eftModal">
                                                            <i class="fas fa-university me-2 text-dark"></i> EFT / Bank Transfer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif

                                        {{-- Buy Direct --}}
                                        @if($item->url)
                                            <a href="{{ $item->url }}" target="_blank" class="btn btn-sm btn-purchase w-100">
                                                <i class="fas fa-external-link-alt me-1"></i> Buy This
                                            </a>
                                        @endif
                                    @else
                                        <div class="fulfilled-message text-center">
                                            <i class="fas fa-check-circle me-1"></i> Dream fulfilled! 🎉
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer Message -->
            <div class="wishlist-footer text-center mt-5 pt-4 border-top">
                <p class="text-muted mb-2">
                    <i class="fas fa-heart text-danger me-2"></i>
                    Thank you for helping make dreams come true!
                </p>
                <small class="text-muted">
                    Every contribution, big or small, means the world to me ✨
                </small>
            </div>
        @endif
    </div>
</section>

<!-- M-Pesa/EcoCash Modal -->
<div class="modal fade" id="mpesaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">M-Pesa / EcoCash</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Send to:</strong></p>
                <ul class="list-unstyled">
                    <li class="text-muted">M-Pesa: <strong>+266 5676 9106</strong></li>
                    <li class="text-muted">EcoCash: <strong>+266 6823 1628</strong></li>
                </ul>
                <p class="text-muted small">Please include your name or the item name in the reference.</p>
            </div>
        </div>
    </div>
</div>

<!-- EFT Modal -->
<div class="modal fade" id="eftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">EFT / Bank Transfer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Banking Details:</strong></p>
                <ul class="list-unstyled">
                    <li class="text-muted"><strong>Bank:</strong> First National Bank</li>
                    <li class="text-muted"><strong>Account Name:</strong> Tokelo Foso</li>
                    <li class="text-muted"><strong>Account Number:</strong> 62512324782</li>
                    <li class="text-muted"><strong>Branch Code:</strong> 280061</li>
                </ul>
                <p class="text-muted small">Use your name or item name as reference. Kindly notify me once done.</p>
            </div>
        </div>
    </div>
</div>

@endsection