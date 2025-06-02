@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Portfolio</h2>
        <a href="{{ route('portfolio.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>Add New
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($portfolios->count())
        {{-- Filter/Search Section --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" id="searchPortfolio" class="form-control" placeholder="Search portfolios...">
            </div>
            <div class="col-md-3">
                <select id="categoryFilter" class="form-select">
                    <option value="">All Categories</option>
                    @php
                        $categories = $portfolios->pluck('category')->unique()->filter();
                    @endphp
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="text-muted">
                    <small>Total: <span id="portfolioCount">{{ $portfolios->count() }}</span> items</small>
                </div>
            </div>
        </div>

        <div class="row" id="portfolioGrid">
            @foreach ($portfolios as $portfolio)
                <div class="col-md-4 mb-4 portfolio-item" 
                     data-title="{{ strtolower($portfolio->title) }}" 
                     data-category="{{ $portfolio->category ?? '' }}"
                     data-description="{{ strtolower($portfolio->description ?? '') }}">
                    <div class="card h-100 shadow-sm">
                        {{-- Image with error handling --}}
                        <div class="portfolio-image-container" style="height: 200px; overflow: hidden;">
                            @if ($portfolio->image && Storage::disk('public')->exists($portfolio->image))
                            <img src="{{ asset('storage/' . $portfolio->image) }}" 
                                 class="card-img-top portfolio-image" 
                                 alt="{{ $portfolio->title }}"
                                 style="width: 100%; height: 200px; object-fit: cover;"
                                 onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                        @endif
                        
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $portfolio->title }}</h5>
                            
                            @if ($portfolio->description)
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit($portfolio->description, 100) }}
                                </p>
                            @endif

                            @if ($portfolio->link)
                                <div class="mt-auto">
                                    <a href="{{ $portfolio->link }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary"
                                       rel="noopener noreferrer">
                                        <i class="fas fa-external-link-alt me-1"></i>View Project
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                            <div>
                                @if ($portfolio->category)
                                    <span class="badge bg-secondary">{{ $portfolio->category }}</span>
                                @else
                                    <span class="badge bg-light text-dark">Uncategorized</span>
                                @endif
                                <br>
                                <small class="text-muted">{{ $portfolio->created_at->diffForHumans() }}</small>
                            </div>
                            
                            <div class="btn-group" role="group">
                                <a href="{{ route('portfolio.show', $portfolio->id) }}" 
                                   class="btn btn-sm btn-outline-info" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('portfolio.edit', $portfolio->id) }}" 
                                   class="btn btn-sm btn-outline-warning"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-outline-danger delete-btn" 
                                        data-portfolio-id="{{ $portfolio->id }}"
                                        data-portfolio-title="{{ $portfolio->title }}"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- No results message (hidden by default) --}}
        <div id="noResults" class="text-center py-5" style="display: none;">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No portfolios found</h5>
            <p class="text-muted">Try adjusting your search or filter criteria.</p>
        </div>

    @else
        {{-- Empty state --}}
        <div class="text-center py-5">
            <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">No Portfolio Items Yet</h4>
            <p class="text-muted mb-4">Start building your portfolio by adding your first project.</p>
            <a href="{{ route('portfolio.create') }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus me-2"></i>Add Your First Portfolio Item
            </a>
        </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete "<span id="deletePortfolioTitle"></span>"?</p>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.portfolio-image {
    transition: transform 0.3s ease;
}

.portfolio-image:hover {
    transform: scale(1.05);
}

.card {
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.12), 0 2px 4px rgba(0,0,0,0.08) !important;
}

.portfolio-item {
    transition: opacity 0.3s ease;
}

.portfolio-item.hidden {
    display: none !important;
}
</style>

{{-- JavaScript for Search, Filter, and Delete --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchPortfolio');
    const categoryFilter = document.getElementById('categoryFilter');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    const portfolioCount = document.getElementById('portfolioCount');
    const noResults = document.getElementById('noResults');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    
    // Search and Filter functionality
    function filterPortfolios() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value.toLowerCase();
        let visibleCount = 0;
        
        portfolioItems.forEach(item => {
            const title = item.dataset.title;
            const category = item.dataset.category.toLowerCase();
            const description = item.dataset.description;
            
            const matchesSearch = !searchTerm || 
                title.includes(searchTerm) || 
                description.includes(searchTerm);
            const matchesCategory = !selectedCategory || category === selectedCategory;
            
            if (matchesSearch && matchesCategory) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        portfolioCount.textContent = visibleCount;
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }
    
    searchInput.addEventListener('input', filterPortfolios);
    categoryFilter.addEventListener('change', filterPortfolios);
    
    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const portfolioId = this.dataset.portfolioId;
            const portfolioTitle = this.dataset.portfolioTitle;
            
            document.getElementById('deletePortfolioTitle').textContent = portfolioTitle;
            document.getElementById('deleteForm').action = 
                `{{ route('portfolio.destroy', '') }}/${portfolioId}`;
            
            deleteModal.show();
        });
    });
});
</script>
@endsection