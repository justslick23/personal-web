@extends('layouts.app')
@section('title', 'My Wishlist')

@section('content')
@section('title', 'Wishlist - Tokelo Foso')

@include('partials.page-header', [
    'title' => 'Slicksters List',
    'breadcrumbs' => [
        ['name' => 'Wishlist', 'url' => route('wishlist.public')],
    ]
])

<section class="wishlist-showcase">
    <div class="container py-5">
        <!-- Personal Header -->
      

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
            <!-- Wishlist Items -->
            <div class="wishlist-gallery">
                @foreach($items as $item)
                    <div class="wish-item {{ $item->is_received ? 'fulfilled' : '' }}">
                        <div class="wish-card">
                            <!-- Fulfillment Status -->
                            @if($item->is_received)
                                <div class="fulfillment-badge">
                                    <i class="fas fa-heart"></i>
                                    <span>Fulfilled!</span>
                                </div>
                            @endif

                            <!-- Item Image -->
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">


                            <!-- Item Details -->
                            <div class="wish-details">
                                <h4 class="wish-title">{{ $item->title }}</h4>
                                
                                @if($item->description)
                                    <p class="wish-description">{{ $item->description }}</p>
                                @endif

                                @if($item->price)
                                    <div class="wish-price">
                                        <span class="price-tag">M{{ number_format($item->price, 2) }}</span>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                             <!-- Action Buttons -->
                                <div class="wish-actions">
                                    @if(!$item->is_received)
                                        @if($item->contribution_link)
                                            <!-- Contribution Dropdown -->
                                            <div class="dropdown w-100">
                                                <button class="btn btn-contribute dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-heart me-2"></i>
                                                    Contribute
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

                                        @if($item->url)
                                            <a href="{{ $item->url }}" target="_blank" class="btn btn-purchase">
                                                <i class="fas fa-external-link-alt me-2"></i>
                                                Buy This
                                            </a>
                                        @endif
                                    @else
                                        <div class="fulfilled-message">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <span>Dream fulfilled! 🎉</span>
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
<div class="modal fade" id="mpesaModal" tabindex="-1" aria-labelledby="mpesaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="mpesaModalLabel">M-Pesa / EcoCash</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="mb-2"><strong>Send to:</strong></p>
          <ul class="list-unstyled">
            <li class="text-muted">M-Pesa: <strong>+266 5676 9106</strong></li>
            <li class="text-muted">EcoCash: <strong>+266 6823 1628</strong></li>
          </ul>
          <p class="text-muted">Please include your name or the item name in the reference.</p>
        </div>
      </div>
    </div>
  </div>
  
  <!-- EFT Modal -->
  <div class="modal fade" id="eftModal" tabindex="-1" aria-labelledby="eftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="eftModalLabel">EFT / Bank Transfer</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="mb-2"><strong>Banking Details:</strong></p>
          <ul class="list-unstyled">
            <li class="text-muted" ><strong>Bank:</strong> First National Bank </li>
            <li class="text-muted"><strong>Account Name:</strong> Tokelo Foso</li>
            <li class="text-muted"><strong>Account Number:</strong> 62512324782 </li>
            <li class="text-muted"><strong>Branch Code:</strong> 280061</li>
          </ul>
          <p class="text-muted">Use your name or item name as reference. Kindly notify me once done.</p>
        </div>
      </div>
    </div>
  </div>
  

<style>
.wishlist-showcase {
    min-height: 100vh;
}

.wishlist-intro {
    position: relative;
}

.profile-section {
    padding: 2rem;
}

.profile-avatar {
    margin-bottom: 1rem;
}

.social-share {
    padding: 0.5rem 1rem;
    background: rgba(108, 117, 125, 0.1);
    border-radius: 20px;
    display: inline-block;
}

.wishlist-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.wish-item {
    position: relative;
    transform: translateY(0);
    transition: all 0.3s ease;
}

.wish-item:hover {
    transform: translateY(-5px);
}

.wish-item.fulfilled {
    opacity: 0.8;
}

.wish-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    position: relative;
}

.wish-card:hover {
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.fulfillment-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 10;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.fulfillment-badge i {
    margin-right: 0.5rem;
}

.wish-image {
    position: relative;
    height: 250px;
    overflow: hidden;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.wish-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.wish-card:hover .wish-image img {
    transform: scale(1.05);
}

.image-placeholder {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.wish-details {
    padding: 1.5rem;
}

.wish-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: #2c3e50;
    line-height: 1.3;
}

.wish-description {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.5;
    font-size: 0.95rem;
}

.wish-price {
    margin-bottom: 1.5rem;
}

.price-tag {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1.1rem;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.wish-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn-contribute {
    background: linear-gradient(45deg, #fd79a8, #fdcb6e);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    flex: 1;
    text-align: center;
    min-width: 140px;
}

.btn-contribute:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(253, 121, 168, 0.4);
    color: white;
}

.btn-purchase {
    background: linear-gradient(45deg, #74b9ff, #0984e3);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    flex: 1;
    text-align: center;
    min-width: 140px;
}

.btn-purchase:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(116, 185, 255, 0.4);
    color: white;
}

.fulfilled-message {
    background: linear-gradient(45deg, #00b894, #55efc4);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-align: center;
    font-weight: 600;
    width: 100%;
}

.empty-wishlist {
    background: white;
    border-radius: 20px;
    padding: 3rem 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.wishlist-footer {
    background: rgba(255,255,255,0.8);
    border-radius: 15px;
    padding: 1.5rem;
    backdrop-filter: blur(10px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .wishlist-gallery {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .wish-actions {
        flex-direction: column;
    }
    
    .btn-contribute,
    .btn-purchase {
        flex: none;
        width: 100%;
    }
    
    .profile-section {
        padding: 1.5rem;
    }
}

/* Animation for items */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.wish-item {
    animation: fadeInUp 0.6s ease forwards;
}

.wish-item:nth-child(2) { animation-delay: 0.1s; }
.wish-item:nth-child(3) { animation-delay: 0.2s; }
.wish-item:nth-child(4) { animation-delay: 0.3s; }
.wish-item:nth-child(5) { animation-delay: 0.4s; }
.wish-item:nth-child(6) { animation-delay: 0.5s; }
</style>
@endsection