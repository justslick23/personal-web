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
            <!-- Filter and Sort Controls -->
            <div class="row mb-4">
                <div class="col-lg-8 col-md-7">
                    <div class="filter-controls">
                        <h6 class="text-muted mb-3">Filter Items</h6>
                        <div class="btn-group" role="group" aria-label="Filter options">
                            <input type="radio" class="btn-check" name="statusFilter" id="filterAll" value="all" checked>
                            <label class="btn btn-outline-primary" for="filterAll">
                                <i class="fas fa-list me-1"></i> All Items
                            </label>
                            
                            <input type="radio" class="btn-check" name="statusFilter" id="filterAvailable" value="available">
                            <label class="btn btn-outline-primary" for="filterAvailable">
                                <i class="fas fa-heart me-1"></i> Available
                            </label>
                            
                            <input type="radio" class="btn-check" name="statusFilter" id="filterFulfilled" value="fulfilled">
                            <label class="btn btn-outline-success" for="filterFulfilled">
                                <i class="fas fa-check-circle me-1"></i> Fulfilled
                            </label>
                        </div>
                        
                        <!-- Price Range Filter -->
                        <div class="mt-3">
                            <label for="priceRange" class="form-label text-muted">Price Range</label>
                            <select class="form-select" id="priceRange" style="max-width: 200px;">
                                <option value="all">All Prices</option>
                                <option value="0-100">M0 - M100</option>
                                <option value="100-500">M100 - M500</option>
                                <option value="500-1000">M500 - M1,000</option>
                                <option value="1000+">M1,000+</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-5">
                    <div class="sort-controls">
                        <h6 class="text-muted mb-3">Sort By</h6>
                        <select class="form-select" id="sortBy">
                            <option value="default">Default Order</option>
                            <option value="name-asc">Name (A-Z)</option>
                            <option value="name-desc">Name (Z-A)</option>
                            <option value="price-asc">Price (Low to High)</option>
                            <option value="price-desc">Price (High to Low)</option>
                            <option value="status">Status (Available First)</option>
                        </select>
                    </div>
                    
                    <!-- Items Count -->
                    <div class="mt-3">
                        <small class="text-muted">
                            Showing <span id="itemCount">{{ $items->count() }}</span> of {{ $items->count() }} items
                        </small>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" id="searchInput" placeholder="Search wishlist items...">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-outline-secondary btn-sm" id="clearFilters">
                        <i class="fas fa-times me-1"></i> Clear All Filters
                    </button>
                </div>
            </div>

            <!-- Wishlist Grid -->
            <div class="row g-4" id="wishlistGrid">
                @foreach($items as $item)
                    <div class="col-lg-4 col-md-6 wishlist-item" 
                         data-status="{{ $item->is_received ? 'fulfilled' : 'available' }}"
                         data-price="{{ $item->price ?? 0 }}"
                         data-name="{{ strtolower($item->title) }}"
                         data-description="{{ strtolower($item->description ?? '') }}">
                        <div class="card h-100 shadow-sm">
                            {{-- Fulfilled Badge --}}
                            @if($item->is_received)
                                <div class="position-absolute top-0 end-0 m-2 badge bg-success px-3 py-2 shadow-sm">
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
                                    <p class="fw-bold mb-3 text-primary fs-5">M{{ number_format($item->price, 2) }}</p>
                                @endif

                                <div class="mt-auto d-flex flex-column gap-2">
                                    @if(!$item->is_received)
                                        {{-- Contribute --}}
                                        @if($item->contribution_link)
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-heart me-1"></i> Contribute
                                                </button>
                                                <ul class="dropdown-menu w-100 shadow">
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
                                                            <i class="fas fa-university me-2 text-info"></i> EFT / Bank Transfer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif

                                        {{-- Buy Direct --}}
                                        @if($item->url)
                                            <a href="{{ $item->url }}" target="_blank" class="btn btn-outline-primary w-100">
                                                <i class="fas fa-external-link-alt me-1"></i> Buy This
                                            </a>
                                        @endif
                                    @else
                                        <div class="fulfilled-message text-center py-2 bg-light rounded">
                                            <i class="fas fa-check-circle text-success me-1"></i> 
                                            <span class="text-success fw-medium">Dream fulfilled! 🎉</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-5" style="display: none;">
                <div class="mb-4">
                    <i class="fas fa-search fa-3x text-muted opacity-50"></i>
                </div>
                <h4 class="text-muted mb-3">No items found</h4>
                <p class="text-muted">Try adjusting your filters or search terms.</p>
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
                <h5 class="modal-title">
                    <i class="fas fa-mobile-alt me-2"></i>M-Pesa / EcoCash
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <i class="fas fa-mobile-alt fa-3x text-success mb-3"></i>
                    <h6 class="text-success">Mobile Money Transfer</h6>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white text-center">
                                <strong>M-Pesa</strong>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="text-success mb-0">+266 5676 9106</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white text-center">
                                <strong>EcoCash</strong>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="text-success mb-0">+266 6823 1628</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Reference:</strong> Please include your name or the item name in the reference field.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EFT Modal -->
<div class="modal fade" id="eftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-university me-2"></i>EFT / Bank Transfer
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="text-center mb-4">
                    <i class="fas fa-university fa-3x text-primary mb-3"></i>
                    <h6 class="text-primary">Bank Transfer Details</h6>
                </div>
                
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 fw-bold text-primary">Bank:</div>
                            <div class="col-sm-8">First National Bank</div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4 fw-bold text-primary">Account Name:</div>
                            <div class="col-sm-8">Tokelo Foso</div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4 fw-bold text-primary">Account Number:</div>
                            <div class="col-sm-8"><strong>62512324782</strong></div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4 fw-bold text-primary">Branch Code:</div>
                            <div class="col-sm-8">280061</div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-bell me-2"></i>
                    <strong>Important:</strong> Use your name or item name as reference. Please notify me once the transfer is complete.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.wishlist-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
}

.filter-controls .btn-group {
    flex-wrap: wrap;
}

.search-box .input-group-text {
    border-right: none;
}

.search-box .form-control {
    border-left: none;
}

.search-box .form-control:focus {
    border-left: none;
    box-shadow: none;
}

@media (max-width: 768px) {
    .filter-controls .btn-group {
        width: 100%;
    }
    
    .filter-controls .btn-group label {
        flex: 1;
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.wishlist-item');
    const statusFilters = document.querySelectorAll('input[name="statusFilter"]');
    const priceFilter = document.getElementById('priceRange');
    const sortSelect = document.getElementById('sortBy');
    const searchInput = document.getElementById('searchInput');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const itemCount = document.getElementById('itemCount');
    const noResults = document.getElementById('noResults');
    const wishlistGrid = document.getElementById('wishlistGrid');

    function filterAndSort() {
        let visibleItems = Array.from(items);
        
        // Status Filter
        const activeStatusFilter = document.querySelector('input[name="statusFilter"]:checked').value;
        if (activeStatusFilter !== 'all') {
            visibleItems = visibleItems.filter(item => item.dataset.status === activeStatusFilter);
        }
        
        // Price Filter
        const priceRange = priceFilter.value;
        if (priceRange !== 'all') {
            visibleItems = visibleItems.filter(item => {
                const price = parseFloat(item.dataset.price);
                if (priceRange === '0-100') return price <= 100;
                if (priceRange === '100-500') return price > 100 && price <= 500;
                if (priceRange === '500-1000') return price > 500 && price <= 1000;
                if (priceRange === '1000+') return price > 1000;
                return true;
            });
        }
        
        // Search Filter
        const searchTerm = searchInput.value.toLowerCase().trim();
        if (searchTerm) {
            visibleItems = visibleItems.filter(item => 
                item.dataset.name.includes(searchTerm) || 
                item.dataset.description.includes(searchTerm)
            );
        }
        
        // Sort
        const sortBy = sortSelect.value;
        if (sortBy !== 'default') {
            visibleItems.sort((a, b) => {
                switch (sortBy) {
                    case 'name-asc':
                        return a.dataset.name.localeCompare(b.dataset.name);
                    case 'name-desc':
                        return b.dataset.name.localeCompare(a.dataset.name);
                    case 'price-asc':
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    case 'price-desc':
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    case 'status':
                        if (a.dataset.status === 'available' && b.dataset.status === 'fulfilled') return -1;
                        if (a.dataset.status === 'fulfilled' && b.dataset.status === 'available') return 1;
                        return 0;
                    default:
                        return 0;
                }
            });
        }
        
        // Hide all items first
        items.forEach(item => item.style.display = 'none');
        
        // Show filtered items
        if (visibleItems.length > 0) {
            visibleItems.forEach((item, index) => {
                item.style.display = 'block';
                // Re-append to maintain sort order
                wishlistGrid.appendChild(item);
            });
            noResults.style.display = 'none';
        } else {
            noResults.style.display = 'block';
        }
        
        // Update count
        itemCount.textContent = visibleItems.length;
    }

    // Event listeners
    statusFilters.forEach(filter => filter.addEventListener('change', filterAndSort));
    priceFilter.addEventListener('change', filterAndSort);
    sortSelect.addEventListener('change', filterAndSort);
    searchInput.addEventListener('input', filterAndSort);

    // Clear filters
    clearFiltersBtn.addEventListener('click', function() {
        document.getElementById('filterAll').checked = true;
        priceFilter.value = 'all';
        sortSelect.value = 'default';
        searchInput.value = '';
        filterAndSort();
    });

    // Initial load
    filterAndSort();
});
</script>

@endsection