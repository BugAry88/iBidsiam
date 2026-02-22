<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* Search Results Page */
.search-results-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    min-height: calc(100vh - 200px);
}

.search-header {
    margin-bottom: 40px;
}

.search-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 10px;
    font-family: var(--font-secondary);
}

.search-query {
    color: var(--accent-gold);
    font-weight: 700;
}

.search-count {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin-bottom: 20px;
}

.search-filters {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 30px;
    padding: 20px;
    background: var(--sidebar-bg);
    border-radius: 12px;
    border: 1px solid var(--border-light);
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-label {
    font-weight: 600;
    color: var(--text-color);
    font-size: 0.95rem;
}

.filter-select {
    padding: 8px 12px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    background: var(--card-bg);
    color: var(--text-color);
    font-size: 0.9rem;
    min-width: 120px;
    transition: border-color 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: var(--accent-gold);
}

.search-sort {
    margin-left: auto;
}

.search-content {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 40px;
}

.search-sidebar {
    background: var(--sidebar-bg);
    border-radius: 16px;
    padding: 30px;
    border: 1px solid var(--border-light);
    height: fit-content;
    position: sticky;
    top: 100px;
}

.sidebar-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--accent-gold);
}

.sidebar-section {
    margin-bottom: 30px;
}

.sidebar-section h4 {
    color: var(--text-color);
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.sidebar-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-list li {
    margin-bottom: 10px;
}

.sidebar-list a {
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 8px;
    display: block;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 20px;
}

.sidebar-list a::before {
    content: '•';
    position: absolute;
    left: 8px;
    color: var(--accent-gold);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sidebar-list a:hover,
.sidebar-list a.active {
    color: var(--accent-dark);
    background: rgba(212, 175, 55, 0.1);
    transform: translateX(4px);
    font-weight: 600;
}

.sidebar-list a:hover::before,
.sidebar-list a.active::before {
    opacity: 1;
}

.price-range {
    display: flex;
    gap: 10px;
    align-items: center;
}

.price-input {
    width: 100%;
    padding: 8px 12px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    background: var(--card-bg);
    color: var(--text-color);
    font-size: 0.9rem;
    text-align: center;
}

.price-separator {
    color: var(--text-muted);
    font-weight: 600;
}

.search-results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
}

.search-product-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    border: 1px solid var(--border-light);
}

.search-product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.search-product-image {
    aspect-ratio: 1;
    overflow: hidden;
    position: relative;
}

.search-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.search-product-card:hover .search-product-image img {
    transform: scale(1.05);
}

.search-product-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.search-product-badge.new {
    background: var(--accent-gold);
    color: var(--accent-dark);
}

.search-product-badge.sale {
    background: var(--danger-color);
    color: white;
}

.search-product-info {
    padding: 20px;
}

.search-product-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.search-product-artist {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 12px;
}

.search-product-price {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--accent-gold);
    margin-bottom: 15px;
}

.search-product-actions {
    display: flex;
    gap: 10px;
}

.btn-add-cart-small {
    flex: 1;
    padding: 10px 15px;
    background: var(--accent-gold);
    border: none;
    color: var(--accent-dark);
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-align: center;
    text-decoration: none;
}

.btn-add-cart-small:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
}

.btn-view-details {
    padding: 10px 15px;
    background: transparent;
    border: 2px solid var(--accent-gold);
    color: var(--accent-gold);
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
}

.btn-view-details:hover {
    background: var(--accent-gold);
    color: var(--accent-dark);
}

.no-results {
    text-align: center;
    padding: 80px 40px;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.no-results-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.3;
}

.no-results-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 15px;
}

.no-results-text {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.5;
}

.no-results-suggestions {
    background: var(--sidebar-bg);
    border-radius: 12px;
    padding: 25px;
    margin-top: 30px;
}

.suggestions-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--accent-dark);
    margin-bottom: 15px;
}

.suggestion-links {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.suggestion-link {
    padding: 8px 16px;
    background: var(--accent-gold);
    color: var(--accent-dark);
    text-decoration: none;
    font-weight: 600;
    border-radius: 20px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.suggestion-link:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .search-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .search-sidebar {
        position: static;
        order: -1;
    }
    
    .search-results-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .search-results-page {
        padding: 20px 15px 40px;
    }
    
    .search-title {
        font-size: 1.5rem;
    }
    
    .search-filters {
        padding: 15px;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .filter-select {
        width: 100%;
        min-width: auto;
    }
    
    .search-sort {
        margin-left: 0;
        width: 100%;
    }
    
    .search-results-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .search-product-info {
        padding: 15px;
    }
    
    .search-product-actions {
        flex-direction: column;
    }
}
</style>

<div class="search-results-page">
    <!-- Search Header -->
    <div class="search-header">
        <h1 class="search-title">Search Results for "<span class="search-query"><?= esc($search_query) ?></span>"</h1>
        <div class="search-count">
            <?php if ($total_results > 0): ?>
                Found <?= $total_results ?> product<?= $total_results > 1 ? 's' : '' ?>
            <?php else: ?>
                No products found
            <?php endif; ?>
        </div>
    </div>

    <!-- Search Filters -->
    <div class="search-filters">
        <div class="filter-group">
            <label class="filter-label">Sort by:</label>
            <select class="filter-select" onchange="sortResults(this.value)">
                <option value="relevance">Relevance</option>
                <option value="name_asc">Name: A-Z</option>
                <option value="name_desc">Name: Z-A</option>
                <option value="price_low">Price: Low to High</option>
                <option value="price_high">Price: High to Low</option>
                <option value="newest">Newest First</option>
            </select>
        </div>
        
        <div class="filter-group search-sort">
            <label class="filter-label">View:</label>
            <select class="filter-select" onchange="changeView(this.value)">
                <option value="grid">Grid</option>
                <option value="list">List</option>
            </select>
        </div>
    </div>

    <?php if (!empty($products)): ?>
        <div class="search-content">
            <!-- Sidebar Filters -->
            <aside class="search-sidebar">
                <h3 class="sidebar-title">Filters</h3>
                
                <!-- Genre Filter -->
                <div class="sidebar-section">
                    <h4>Genre</h4>
                    <ul class="sidebar-list">
                        <li><a href="#" class="active">All Genres</a></li>
                        <?php if (!empty($genres)): ?>
                            <?php foreach ($genres as $genre): ?>
                                <li><a href="<?= site_url('shop') ?>?genre=<?= urlencode($genre) ?>"><?= esc($genre) ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <!-- Price Range -->
                <div class="sidebar-section">
                    <h4>Price Range</h4>
                    <div class="price-range">
                        <input type="number" class="price-input" placeholder="Min" min="0" step="50">
                        <span class="price-separator">-</span>
                        <input type="number" class="price-input" placeholder="Max" min="0" step="50">
                    </div>
                    <button class="btn-add-cart-small" style="width: 100%; margin-top: 10px;" onclick="applyPriceFilter()">
                        Apply Filter
                    </button>
                </div>
                
                <!-- Condition -->
                <div class="sidebar-section">
                    <h4>Condition</h4>
                    <ul class="sidebar-list">
                        <li><a href="#" class="active">All Conditions</a></li>
                        <li><a href="#">Mint</a></li>
                        <li><a href="#">Near Mint</a></li>
                        <li><a href="#">Very Good</a></li>
                        <li><a href="#">Good</a></li>
                    </ul>
                </div>
                
                <!-- Availability -->
                <div class="sidebar-section">
                    <h4>Availability</h4>
                    <ul class="sidebar-list">
                        <li><a href="#" class="active">All Items</a></li>
                        <li><a href="#">In Stock</a></li>
                        <li><a href="#">Pre-Order</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Search Results Grid -->
            <main class="search-results-grid" id="searchResultsGrid">
                <?php foreach ($products as $product): ?>
                    <div class="search-product-card">
                        <div class="search-product-image">
                            <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>">
                            <?php if (rand(0, 3) === 0): ?>
                                <span class="search-product-badge new">New</span>
                            <?php elseif (rand(0, 4) === 0): ?>
                                <span class="search-product-badge sale">Sale</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="search-product-info">
                            <h3 class="search-product-name"><?= esc($product['name']) ?></h3>
                            <div class="search-product-artist">Various Artists</div>
                            <div class="search-product-price">฿<?= number_format($product['price'], 2) ?></div>
                            
                            <div class="search-product-actions">
                                <a href="<?= site_url('shop/product/' . $product['id']) ?>" class="btn-view-details">View Details</a>
                                <a href="#" class="btn-add-cart-small" onclick="addToCart(<?= $product['id'] ?>)">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </main>
        </div>
    <?php else: ?>
        <!-- No Results -->
        <div class="no-results">
            <div class="no-results-icon">🔍</div>
            <h2 class="no-results-title">No products found</h2>
            <p class="no-results-text">
                We couldn't find any products matching "<strong><?= esc($search_query) ?></strong>"
            </p>
            
            <div class="no-results-suggestions">
                <h3 class="suggestions-title">Try searching for:</h3>
                <div class="suggestion-links">
                    <a href="<?= site_url('shop') ?>?q=vinyl" class="suggestion-link">Vinyl</a>
                    <a href="<?= site_url('shop') ?>?q=rock" class="suggestion-link">Rock</a>
                    <a href="<?= site_url('shop') ?>?q=jazz" class="suggestion-link">Jazz</a>
                    <a href="<?= site_url('shop') ?>?q=electronic" class="suggestion-link">Electronic</a>
                    <a href="<?= site_url('shop') ?>?q=classic" class="suggestion-link">Classic</a>
                    <a href="<?= site_url('shop') ?>" class="suggestion-link">Browse All</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Search functionality
function sortResults(sortBy) {
    const url = new URL(window.location);
    url.searchParams.set('sort', sortBy);
    window.location.href = url.toString();
}

function changeView(viewType) {
    const grid = document.getElementById('searchResultsGrid');
    if (viewType === 'list') {
        grid.style.gridTemplateColumns = '1fr';
    } else {
        grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
    }
}

function applyPriceFilter() {
    const minPrice = document.querySelector('.price-input[placeholder="Min"]').value;
    const maxPrice = document.querySelector('.price-input[placeholder="Max"]').value;
    
    const url = new URL(window.location);
    if (minPrice) url.searchParams.set('min_price', minPrice);
    if (maxPrice) url.searchParams.set('max_price', maxPrice);
    
    window.location.href = url.toString();
}

// Add to cart functionality
function addToCart(productId) {
    const button = event.target;
    const originalText = button.textContent;
    
    button.disabled = true;
    button.textContent = 'Adding...';
    
    fetch('<?= site_url('cart/add') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `id=${productId}&qty=1`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            button.textContent = '✓ Added';
            button.style.background = '#27ae60';
            
            // Update cart badge
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                cartBadge.textContent = data.total_items;
                cartBadge.style.display = data.total_items > 0 ? 'block' : 'none';
            }
            
            setTimeout(() => {
                button.disabled = false;
                button.textContent = originalText;
                button.style.background = '';
            }, 2000);
        } else {
            button.disabled = false;
            button.textContent = originalText;
            alert('Error adding to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        button.textContent = originalText;
        alert('Error adding to cart');
    });
}

// Highlight search terms in results
document.addEventListener('DOMContentLoaded', function() {
    const searchQuery = '<?= esc($search_query) ?>';
    if (searchQuery) {
        const productNames = document.querySelectorAll('.search-product-name');
        const regex = new RegExp(`(${searchQuery})`, 'gi');
        
        productNames.forEach(name => {
            const originalText = name.textContent;
            name.innerHTML = originalText.replace(regex, '<mark>$1</mark>');
        });
    }
});
</script>

<?= $this->endSection() ?>
