@extends('layouts.app')
@section('title', 'Wishlist - Tokelo Foso')

@section('content')

@include('partials.page-header', [
    'title' => 'Slicksters List',
    'breadcrumbs' => [
        ['name' => 'Wishlist', 'url' => route('wishlist.public')],
    ]
])

<section class="section-padding">
    <div class="container">

        @if($items->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-5 scroll-animate">
                <div class="mb-4">
                    <i class="fas fa-heart-broken fa-5x" style="color: var(--accent-primary); opacity: 0.3;"></i>
                </div>
                <h3 class="mb-3">Wishlist is currently empty</h3>
                <p class="text-secondary">Check back soon for new items!</p>
            </div>
        @else
            <!-- Disclaimer Banner -->
            <div class="modern-card mb-4 scroll-animate" style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(168, 85, 247, 0.05) 100%); border-left: 4px solid var(--accent-primary);">
                <div class="p-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="fas fa-info-circle fa-2x" style="color: var(--accent-primary); flex-shrink: 0;"></i>
                        <div>
                            <h6 class="fw-bold mb-2" style="color: var(--accent-primary);">
                                <i class="fas fa-lightbulb me-1"></i> Shopping Flexibility
                            </h6>
                            <p class="mb-0 text-secondary" style="line-height: 1.6;">
                                The "Buy This" links are just suggestions to give you an idea of what I'm looking for. 
                                <strong>You're welcome to shop around and find better deals or similar items elsewhere!</strong> 
                                What matters most is the thoughtfulness, not the specific store or exact product. 
                                Feel free to get creative! 🎁✨
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter and Sort Controls -->
            <div class="row mb-5 g-4">
                <div class="col-lg-8">
                    <div class="modern-card scroll-animate">
                        <h6 class="fw-semibold mb-3">Filter Items</h6>
                        <div class="filter-buttons mb-4">
                            <button class="filter-btn active" data-status="all">
                                <i class="fas fa-list me-1"></i> All Items
                            </button>
                            <button class="filter-btn" data-status="available">
                                <i class="fas fa-heart me-1"></i> Available
                            </button>
                            <button class="filter-btn" data-status="fulfilled">
                                <i class="fas fa-check-circle me-1"></i> Fulfilled
                            </button>
                        </div>
                        
                        <!-- Price Range Filter -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="priceRange" class="form-label small text-secondary">Price Range</label>
                                <select class="form-select" id="priceRange">
                                    <option value="all">All Prices</option>
                                    <option value="0-100">M0 - M100</option>
                                    <option value="100-500">M100 - M500</option>
                                    <option value="500-1000">M500 - M1,000</option>
                                    <option value="1000+">M1,000+</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="searchInput" class="form-label small text-secondary">Search</label>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search items...">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="modern-card scroll-animate" style="animation-delay: 0.1s;">
                        <h6 class="fw-semibold mb-3">Sort By</h6>
                        <select class="form-select mb-3" id="sortBy">
                            <option value="default">Default Order</option>
                            <option value="name-asc">Name (A-Z)</option>
                            <option value="name-desc">Name (Z-A)</option>
                            <option value="price-asc">Price (Low to High)</option>
                            <option value="price-desc">Price (High to Low)</option>
                            <option value="status">Status (Available First)</option>
                        </select>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-secondary">
                                Showing <span class="fw-bold" style="color: var(--accent-primary);" id="itemCount">{{ $items->count() }}</span> of {{ $items->count() }}
                            </small>
                            <button class="btn-modern py-2 px-3" id="clearFilters" style="font-size: 0.875rem;">
                                <i class="fas fa-times me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist Grid -->
            <div class="portfolio-grid" id="wishlistGrid">
                @foreach($items as $index => $item)
                    <div class="wishlist-item scroll-animate" 
                         data-status="{{ $item->is_received == 1 ? 'fulfilled' : 'available' }}"
                         data-price="{{ $item->price ?? 0 }}"
                         data-name="{{ strtolower($item->title) }}"
                         data-description="{{ strtolower($item->description ?? '') }}"
                         style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="modern-card p-0 overflow-hidden h-100">
                            {{-- Fulfilled Badge --}}
                            @if($item->is_received == 1)
                                <div class="position-absolute top-0 end-0 m-3 badge px-3 py-2" style="background: #22c55e; color: white; z-index: 10;">
                                    <i class="fas fa-heart me-1"></i> Fulfilled
                                </div>
                            @endif

                            {{-- Image --}}
                          {{-- Image --}}
<div class="position-relative overflow-hidden" style="background: #f8f9fa;">
    @php
        // For cPanel hosting - images stored in public folder
        if ($item->image) {
            // Remove 'public/' prefix if it exists in database
            $cleanPath = str_replace('public/', '', $item->image);
            // Ensure path starts with / for absolute URL
            $imagePath = asset(ltrim($cleanPath, '/'));
        } else {
            $imagePath = asset('images/default-portfolio.jpg');
        }
    @endphp
    <img src="{{ $imagePath }}"
         alt="{{ $item->title }}"
         class="portfolio-image"
         style="object-fit: cover; width: 100%; height: 250px;"
         onerror="this.onerror=null; this.src='{{ asset('images/default-portfolio.jpg') }}'; this.style.objectFit='contain'; this.style.padding='20px';">
</div>
                            {{-- Details --}}
                            <div class="p-4">
                                <h5 class="fw-bold mb-2">{{ $item->title }}</h5>

                                @if($item->description)
                                    <p class="text-secondary small mb-3">{{ Str::limit($item->description, 100) }}</p>
                                @endif

                                @if($item->price)
                                    <p class="fw-bold mb-2" style="color: var(--accent-primary); font-size: 1.25rem;">
                                        M{{ number_format($item->price, 2) }}
                                    </p>
                                    <p class="text-muted small mb-4" style="font-size: 0.75rem;">
                                        <i class="fas fa-tag me-1"></i> Approximate price - feel free to find better deals!
                                    </p>
                                @endif

                                @if(!$item->is_received || $item->is_received == 0)
                                    <div class="d-flex flex-column gap-2">
                                        {{-- Contribute Dropdown --}}
                                        @if($item->contribution_link)
                                            <div class="dropdown">
                                                <button class="btn-modern btn-primary-modern w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-heart me-1"></i> Contribute
                                                </button>
                                                <ul class="dropdown-menu w-100">
                                                    <li>
                                                        <a class="dropdown-item" target="_blank" href="https://paypal.me/JustSlick?country.x=LS&locale.x=en_US">
                                                            <i class="fab fa-paypal me-2" style="color: var(--accent-primary);"></i> PayPal
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mpesaModal">
                                                            <i class="fas fa-mobile-alt me-2" style="color: #22c55e;"></i> M-Pesa / EcoCash
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eftModal">
                                                            <i class="fas fa-university me-2" style="color: var(--accent-primary);"></i> EFT / Bank Transfer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif

                                        {{-- Buy Direct --}}
                                        @if($item->url)
                                            <a href="{{ $item->url }}" target="_blank" class="btn-modern w-100">
                                                <i class="fas fa-external-link-alt me-1"></i> View Example
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-center py-3 rounded" style="background: rgba(34, 197, 94, 0.1);">
                                        <i class="fas fa-check-circle me-1" style="color: #22c55e;"></i> 
                                        <span style="color: #22c55e;" class="fw-medium">Dream fulfilled! 🎉</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-5" style="display: none;">
                <div class="mb-4">
                    <i class="fas fa-search fa-4x" style="color: var(--accent-primary); opacity: 0.3;"></i>
                </div>
                <h4 class="mb-3">No items found</h4>
                <p class="text-secondary">Try adjusting your filters or search terms.</p>
            </div>

            <!-- Footer Message -->
            <div class="text-center mt-5 pt-5 scroll-animate">
                <p class="text-secondary mb-2">
                    <i class="fas fa-heart me-2" style="color: var(--accent-primary);"></i>
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
        <div class="modal-content" style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="modal-header border-bottom" style="border-color: var(--border-color) !important;">
                <h5 class="modal-title">
                    <i class="fas fa-mobile-alt me-2" style="color: #22c55e;"></i>M-Pesa / EcoCash
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #22c55e;"></i>
                    <h6 style="color: #22c55e;">Mobile Money Transfer</h6>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="modern-card text-center">
                            <div class="mb-2 fw-bold">M-Pesa</div>
                            <h5 class="mb-0" style="color: var(--accent-primary);">+266 5676 9106</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="modern-card text-center">
                            <div class="mb-2 fw-bold">EcoCash</div>
                            <h5 class="mb-0" style="color: var(--accent-primary);">+266 6823 1628</h5>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3" style="background: rgba(168, 85, 247, 0.1); border-color: var(--accent-primary); color: var(--text-secondary);">
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
        <div class="modal-content" style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="modal-header border-bottom" style="border-color: var(--border-color) !important;">
                <h5 class="modal-title">
                    <i class="fas fa-university me-2" style="color: var(--accent-primary);"></i>EFT / Bank Transfer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-university fa-3x mb-3" style="color: var(--accent-primary);"></i>
                    <h6 style="color: var(--accent-primary);">Bank Transfer Details</h6>
                </div>
                
                <div class="modern-card">
                    <div class="row g-2">
                        <div class="col-5 fw-bold" style="color: var(--accent-primary);">Bank:</div>
                        <div class="col-7 text-secondary">First National Bank</div>
                        <div class="col-12"><hr style="border-color: var(--border-color);"></div>
                        <div class="col-5 fw-bold" style="color: var(--accent-primary);">Account Name:</div>
                        <div class="col-7 text-secondary">Tokelo Foso</div>
                        <div class="col-12"><hr style="border-color: var(--border-color);"></div>
                        <div class="col-5 fw-bold" style="color: var(--accent-primary);">Account Number:</div>
                        <div class="col-7"><strong style="color: var(--accent-primary);">62512324782</strong></div>
                        <div class="col-12"><hr style="border-color: var(--border-color);"></div>
                        <div class="col-5 fw-bold" style="color: var(--accent-primary);">Branch Code:</div>
                        <div class="col-7 text-secondary">280061</div>
                    </div>
                </div>
                
                <div class="alert alert-warning mt-3" style="background: rgba(251, 191, 36, 0.1); border-color: #fbbf24; color: var(--text-secondary);">
                    <i class="fas fa-bell me-2"></i>
                    <strong>Important:</strong> Use your name or item name as reference. Please notify me once the transfer is complete.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.wishlist-item');
    const statusFilters = document.querySelectorAll('.filter-btn');
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
        const activeStatusFilter = document.querySelector('.filter-btn.active').dataset.status;
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
            visibleItems.forEach(item => {
                item.style.display = 'block';
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
    statusFilters.forEach(filter => filter.addEventListener('click', function() {
        statusFilters.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        filterAndSort();
    }));
    
    priceFilter.addEventListener('change', filterAndSort);
    sortSelect.addEventListener('change', filterAndSort);
    searchInput.addEventListener('input', filterAndSort);

    // Clear filters
    clearFiltersBtn.addEventListener('click', function() {
        document.querySelector('.filter-btn[data-status="all"]').click();
        priceFilter.value = 'all';
        sortSelect.value = 'default';
        searchInput.value = '';
        filterAndSort();
    });

    // Scroll Animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
});
</script>
@endpush