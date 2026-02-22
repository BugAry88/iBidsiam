// Live Search Functionality
class LiveSearch {
    constructor() {
        this.searchInput = null;
        this.searchResults = null;
        this.searchTimeout = null;
        this.minSearchLength = 2;
        this.init();
    }

    init() {
        // Find search input in navigation
        this.searchInput = document.querySelector('.nav-search input');
        if (!this.searchInput) return;

        // Create search results container
        this.createSearchResultsContainer();
        
        // Add event listeners
        this.searchInput.addEventListener('input', this.handleSearchInput.bind(this));
        this.searchInput.addEventListener('focus', this.handleSearchFocus.bind(this));
        this.searchInput.addEventListener('blur', this.handleSearchBlur.bind(this));
        
        // Handle keyboard navigation
        this.searchInput.addEventListener('keydown', this.handleKeydown.bind(this));
        
        // Close results when clicking outside
        document.addEventListener('click', this.handleDocumentClick.bind(this));
    }

    createSearchResultsContainer() {
        this.searchResults = document.createElement('div');
        this.searchResults.className = 'search-results';
        this.searchResults.style.display = 'none';
        
        // Insert after search form
        const searchForm = this.searchInput.closest('form');
        searchForm.parentNode.insertBefore(this.searchResults, searchForm.nextSibling);
    }

    handleSearchInput(e) {
        const query = e.target.value.trim();
        
        // Clear previous timeout
        if (this.searchTimeout) {
            clearTimeout(this.searchTimeout);
        }
        
        if (query.length < this.minSearchLength) {
            this.hideResults();
            return;
        }
        
        // Debounce search
        this.searchTimeout = setTimeout(() => {
            this.performSearch(query);
        }, 300);
    }

    handleSearchFocus() {
        const query = this.searchInput.value.trim();
        if (query.length >= this.minSearchLength) {
            this.performSearch(query);
        }
    }

    handleSearchBlur() {
        // Delay hiding to allow clicking on results
        setTimeout(() => {
            this.hideResults();
        }, 200);
    }

    handleKeydown(e) {
        const items = this.searchResults.querySelectorAll('.search-result-item');
        let currentIndex = -1;
        
        // Find current selected item
        items.forEach((item, index) => {
            if (item.classList.contains('selected')) {
                currentIndex = index;
            }
        });
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                currentIndex = Math.min(currentIndex + 1, items.length - 1);
                this.selectResult(currentIndex);
                break;
                
            case 'ArrowUp':
                e.preventDefault();
                currentIndex = Math.max(currentIndex - 1, 0);
                this.selectResult(currentIndex);
                break;
                
            case 'Enter':
                e.preventDefault();
                if (currentIndex >= 0) {
                    items[currentIndex].click();
                }
                break;
                
            case 'Escape':
                this.hideResults();
                this.searchInput.blur();
                break;
        }
    }

    handleDocumentClick(e) {
        if (!e.target.closest('.nav-search') && !e.target.closest('.search-results')) {
            this.hideResults();
        }
    }

    async performSearch(query) {
        try {
            const response = await fetch(`<?= site_url('shop/search') ?>?q=${encodeURIComponent(query)}&ajax=1`);
            const data = await response.json();
            
            if (data.success) {
                this.displayResults(data.products, query);
            } else {
                this.displayError(data.message || 'Search failed');
            }
        } catch (error) {
            console.error('Search error:', error);
            this.displayError('Search temporarily unavailable');
        }
    }

    displayResults(products, query) {
        if (products.length === 0) {
            this.displayNoResults(query);
            return;
        }
        
        let html = '<div class="search-results-header">';
        html += `<span class="search-results-count">${products.length} results for "${query}"</span>`;
        html += `<a href="<?= site_url('shop') ?>?q=${encodeURIComponent(query)}" class="view-all-results">View all results</a>`;
        html += '</div>';
        
        html += '<div class="search-results-list">';
        products.forEach((product, index) => {
            html += this.createResultItem(product, index);
        });
        html += '</div>';
        
        this.searchResults.innerHTML = html;
        this.showResults();
    }

    createResultItem(product, index) {
        const price = product.price ? `฿${parseFloat(product.price).toFixed(2)}` : 'Price unavailable';
        const image = product.image || '/images/placeholder-vinyl.jpg';
        const name = product.name || 'Unknown Product';
        
        let html = `<div class="search-result-item" data-index="${index}" tabindex="0">`;
        html += `<div class="search-result-image">`;
        html += `<img src="${image}" alt="${name}" onerror="this.src='/images/placeholder-vinyl.jpg'">`;
        html += `</div>`;
        html += `<div class="search-result-content">`;
        html += `<div class="search-result-name">${this.highlightMatch(name, this.searchInput.value)}</div>`;
        html += `<div class="search-result-price">${price}</div>`;
        html += `</div>`;
        html += `</div>`;
        
        return html;
    }

    highlightMatch(text, query) {
        if (!query) return text;
        const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    displayNoResults(query) {
        let html = '<div class="search-no-results">';
        html += `<div class="no-results-icon">🔍</div>`;
        html += `<div class="no-results-text">No products found for "${query}"</div>`;
        html += `<div class="no-results-suggestions">Try searching for "vinyl", "record", or browse our categories</div>`;
        html += `</div>`;
        
        this.searchResults.innerHTML = html;
        this.showResults();
    }

    displayError(message) {
        let html = '<div class="search-error">';
        html += `<div class="error-icon">⚠️</div>`;
        html += `<div class="error-text">${message}</div>`;
        html += `</div>`;
        
        this.searchResults.innerHTML = html;
        this.showResults();
    }

    selectResult(index) {
        const items = this.searchResults.querySelectorAll('.search-result-item');
        items.forEach((item, i) => {
            item.classList.toggle('selected', i === index);
        });
        
        if (index >= 0 && items[index]) {
            items[index].scrollIntoView({ block: 'nearest' });
        }
    }

    showResults() {
        this.searchResults.style.display = 'block';
        this.searchResults.classList.add('show');
    }

    hideResults() {
        this.searchResults.style.display = 'none';
        this.searchResults.classList.remove('show');
    }
}

// Initialize live search when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new LiveSearch();
});

// Add CSS styles dynamically
const searchStyles = `
.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--card-bg);
    border: 1px solid var(--border-light);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
    margin-top: 5px;
}

.search-results.show {
    animation: slideDown 0.2s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border-light);
    background: var(--sidebar-bg);
}

.search-results-count {
    font-size: 0.85rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.view-all-results {
    font-size: 0.85rem;
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.view-all-results:hover {
    color: var(--accent-dark);
}

.search-results-list {
    max-height: 300px;
    overflow-y: auto;
}

.search-result-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.search-result-item:hover,
.search-result-item.selected {
    background: rgba(212, 175, 55, 0.05);
}

.search-result-item:last-child {
    border-bottom: none;
}

.search-result-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 12px;
    flex-shrink: 0;
    border: 1px solid var(--border-light);
}

.search-result-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.search-result-content {
    flex: 1;
    min-width: 0;
}

.search-result-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 4px;
    line-height: 1.3;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.search-result-price {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--accent-gold);
}

.search-result-name mark {
    background: var(--accent-gold);
    color: var(--accent-dark);
    padding: 1px 2px;
    border-radius: 2px;
}

.search-no-results,
.search-error {
    padding: 30px 20px;
    text-align: center;
}

.no-results-icon,
.error-icon {
    font-size: 2rem;
    margin-bottom: 10px;
    opacity: 0.5;
}

.no-results-text,
.error-text {
    font-size: 0.95rem;
    color: var(--text-color);
    font-weight: 600;
    margin-bottom: 8px;
}

.no-results-suggestions {
    font-size: 0.85rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .search-results {
        left: -20px;
        right: -20px;
        border-radius: 0;
        margin-top: 0;
    }
    
    .search-result-item {
        padding: 15px;
    }
    
    .search-result-image {
        width: 60px;
        height: 60px;
    }
}
`;

// Inject styles
const styleSheet = document.createElement('style');
styleSheet.textContent = searchStyles;
document.head.appendChild(styleSheet);
