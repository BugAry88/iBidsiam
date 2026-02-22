<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* ============================
   Premium Shop Page Layout
   ============================ */
.premium-shop {
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px 80px;
    min-height: calc(100vh - 200px);
}

/* Premium Hero Section */
.premium-hero {
    background: linear-gradient(135deg, var(--accent-dark), var(--accent-gold));
    border-radius: 24px;
    padding: 80px 60px;
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.premium-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="vinyl-pattern" patternUnits="userSpaceOnUse" width="40" height="40"><circle cx="20" cy="20" r="15" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/><circle cx="20" cy="20" r="5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23vinyl-pattern)"/></svg>');
    opacity: 0.4;
}

.hero-content-premium {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}

.hero-title-premium {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    font-family: var(--font-secondary);
    text-transform: uppercase;
    letter-spacing: 4px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle-premium {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 30px;
    opacity: 0.9;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 60px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--accent-gold);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.stat-label {
    font-size: 1rem;
    font-weight: 600;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Shop Layout */
.shop-layout-premium {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 50px;
    margin-bottom: 60px;
}

/* Premium Sidebar */
.sidebar-premium {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 30px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
    height: fit-content;
    position: sticky;
    top: 100px;
}

.sidebar-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-title i {
    color: var(--accent-gold);
}

.filter-section {
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 1px solid var(--border-light);
}

.filter-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.filter-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 15px;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.filter-count {
    background: var(--accent-gold);
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.filter-option {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.filter-option:hover {
    background: rgba(212, 175, 55, 0.1);
}

.filter-option input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: var(--accent-gold);
}

.filter-option label {
    cursor: pointer;
    flex: 1;
    color: var(--text-secondary);
    font-weight: 500;
}

.price-range-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

.price-input {
    padding: 10px 15px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: var(--card-bg);
}

.price-input:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

/* Premium Toolbar */
.toolbar-premium {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 20px 30px;
    margin-bottom: 30px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.toolbar-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.results-count {
    color: var(--text-secondary);
    font-weight: 500;
}

.sort-dropdown {
    padding: 10px 15px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    background: var(--card-bg);
    color: var(--text-primary);
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.sort-dropdown:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.view-toggle {
    display: flex;
    gap: 8px;
    background: var(--border-light);
    padding: 4px;
    border-radius: 10px;
}

.view-btn {
    padding: 8px 12px;
    border: none;
    background: transparent;
    color: var(--text-secondary);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.view-btn.active {
    background: var(--accent-gold);
    color: white;
}

/* Premium Product Grid */
.products-grid-premium {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.products-list-premium {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.product-card-premium {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
    position: relative;
}

.product-card-premium:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.product-image-premium {
    position: relative;
    overflow: hidden;
    height: 280px;
}

.product-image-premium img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card-premium:hover .product-image-premium img {
    transform: scale(1.1);
}

.product-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.product-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    backdrop-filter: blur(10px);
}

.badge-new {
    background: linear-gradient(135deg, #10b981, #22c55e);
    color: white;
}

.badge-sale {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.badge-limited {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white;
}

.product-actions-quick {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    opacity: 0;
    transform: translateX(20px);
    transition: all 0.3s ease;
}

.product-card-premium:hover .product-actions-quick {
    opacity: 1;
    transform: translateX(0);
}

.quick-action-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    color: var(--accent-dark);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-md);
}

.quick-action-btn:hover {
    background: var(--accent-gold);
    color: white;
    transform: scale(1.1);
}

.product-info-premium {
    padding: 20px;
}

.product-genre {
    color: var(--accent-gold);
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}

.product-brand {
    color: var(--accent-purple);
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.product-brand::before {
    content: '🏷️';
    font-size: 0.7rem;
}

.product-name-premium {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-name-premium:hover {
    color: var(--accent-dark);
}

.product-artist-premium {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin-bottom: 12px;
}

.product-rating-premium {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
}

.stars {
    color: var(--accent-gold);
    font-size: 0.9rem;
}

.rating-count {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.product-price-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.product-price-premium {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--accent-dark);
}

.product-original-price {
    font-size: 1rem;
    color: #999;
    text-decoration: line-through;
}

.product-stock {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 12px;
}

.stock-high {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.stock-medium {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.stock-low {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.product-actions-premium {
    display: flex;
    gap: 10px;
}

.btn-add-cart-premium {
    flex: 1;
    padding: 10px 12px;
    background: linear-gradient(135deg, var(--accent-dark), var(--accent-gold));
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-add-cart-premium:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-view-details-premium {
    flex: 1;
    padding: 10px 12px;
    background: transparent;
    color: var(--accent-dark);
    border: 2px solid var(--border-light);
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.btn-view-details-premium:hover {
    border-color: var(--accent-gold);
    color: var(--accent-gold);
}

/* List View Styles */
.product-card-premium.list-view {
    display: flex;
    flex-direction: row;
    height: 200px;
}

.product-card-premium.list-view .product-image-premium {
    width: 200px;
    height: 100%;
    flex-shrink: 0;
}

.product-card-premium.list-view .product-info-premium {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-card-premium.list-view .product-name-premium {
    -webkit-line-clamp: 1;
}

/* Loading State */
.loading-spinner {
    display: none;
    text-align: center;
    padding: 40px;
}

.loading-spinner.active {
    display: block;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px solid var(--border-light);
    border-top: 4px solid var(--accent-gold);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Empty State */
.empty-state-premium {
    text-align: center;
    padding: 80px 40px;
    background: var(--card-bg);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.empty-icon {
    font-size: 4rem;
    color: var(--border-light);
    margin-bottom: 20px;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 10px;
}

.empty-description {
    color: var(--text-secondary);
    margin-bottom: 30px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .shop-layout-premium {
        grid-template-columns: 280px 1fr;
        gap: 30px;
    }
    
    .products-grid-premium {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .premium-shop {
        padding: 20px 15px 60px;
    }
    
    .premium-hero {
        padding: 40px 30px;
        margin-bottom: 40px;
    }
    
    .hero-title-premium {
        font-size: 2.5rem;
    }
    
    .hero-subtitle-premium {
        font-size: 1.1rem;
    }
    
    .hero-stats {
        gap: 30px;
    }
    
    .shop-layout-premium {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .sidebar-premium {
        position: static;
        order: 2;
    }
    
    .toolbar-premium {
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }
    
    .toolbar-left {
        flex-direction: column;
        gap: 15px;
    }
    
    .products-grid-premium {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .product-card-premium.list-view {
        flex-direction: column;
        height: auto;
    }
    
    .product-card-premium.list-view .product-image-premium {
        width: 100%;
        height: 250px;
    }
}

@media (max-width: 480px) {
    .hero-title-premium {
        font-size: 2rem;
    }
    
    .products-grid-premium {
        grid-template-columns: 1fr;
    }
    
    .product-actions-premium {
        flex-direction: column;
        gap: 8px;
    }
    
    .btn-add-cart-premium,
    .btn-view-details-premium {
        width: 100%;
        padding: 12px;
        font-size: 0.95rem;
    }
}

/* Animation Enhancements */
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

.product-card-premium {
    animation: fadeInUp 0.6s ease-out;
}

.product-card-premium:nth-child(1) { animation-delay: 0.1s; }
.product-card-premium:nth-child(2) { animation-delay: 0.2s; }
.product-card-premium:nth-child(3) { animation-delay: 0.3s; }
.product-card-premium:nth-child(4) { animation-delay: 0.4s; }
.product-card-premium:nth-child(5) { animation-delay: 0.5s; }
.product-card-premium:nth-child(6) { animation-delay: 0.6s; }

/* Wishlist Heart Animation */
@keyframes heartBeat {
    0% { transform: scale(1); }
    25% { transform: scale(1.3); }
    50% { transform: scale(1); }
    75% { transform: scale(1.3); }
    100% { transform: scale(1); }
}

.quick-action-btn.wishlist-active {
    animation: heartBeat 0.8s ease-in-out;
    background: var(--accent-gold);
    color: white;
}

.premium-sidebar {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 35px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
    height: fit-content;
    position: sticky;
    top: 100px;
}

.sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--accent-gold);
}

.sidebar-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--accent-dark);
    font-family: var(--font-secondary);
}

.clear-filters {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.clear-filters:hover {
    color: var(--accent-dark);
}

.filter-section-premium {
    margin-bottom: 35px;
}

.filter-section-premium h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-list-premium {
    list-style: none;
    padding: 0;
    margin: 0;
}

.filter-list-premium li {
    margin-bottom: 12px;
}

.filter-list-premium a {
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    padding: 10px 15px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.filter-list-premium a:hover {
    color: var(--accent-dark);
    background: rgba(212, 175, 55, 0.05);
    border-color: rgba(212, 175, 55, 0.2);
    transform: translateX(4px);
}

.filter-list-premium a.active {
    color: var(--accent-dark);
    background: var(--accent-gold);
    font-weight: 700;
    border-color: var(--accent-gold);
}

.filter-count {
    background: rgba(139, 92, 246, 0.1);
    color: var(--accent-purple);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.price-range-premium {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-top: 15px;
}

.price-input-premium {
    flex: 1;
    max-width: 100px;
    padding: 8px 10px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    background: var(--card-bg);
    color: var(--text-color);
    font-size: 0.85rem;
    font-weight: 500;
    text-align: center;
    transition: border-color 0.3s ease;
    height: 38px;
    box-sizing: border-box;
}

.price-input-premium:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.price-separator {
    color: var(--text-muted);
    font-weight: 600;
    font-size: 0.9rem;
    margin: 0 2px;
    flex-shrink: 0;
}

.apply-filter-btn {
    width: 100%;
    padding: 12px;
    background: var(--accent-gold);
    border: none;
    border-radius: 12px;
    color: var(--accent-dark);
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.apply-filter-btn:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: translateY(-1px);
}

/* Main Content Area */
.main-content-premium {
    min-height: 1000px;
}

/* Premium Toolbar */
.toolbar-premium {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 35px;
    padding: 20px 25px;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.results-info {
    font-size: 1rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.results-count {
    color: var(--accent-gold);
    font-weight: 700;
}

.toolbar-controls {
    display: flex;
    gap: 20px;
    align-items: center;
}

.sort-dropdown {
    padding: 10px 15px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    background: var(--card-bg);
    color: var(--text-color);
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.sort-dropdown:focus {
    outline: none;
    border-color: var(--accent-gold);
}

.view-toggle {
    display: flex;
    gap: 5px;
    background: var(--sidebar-bg);
    padding: 5px;
    border-radius: 10px;
}

.view-btn {
    width: 36px;
    height: 36px;
    border: none;
    background: transparent;
    color: var(--text-muted);
    cursor: pointer;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.view-btn.active {
    background: var(--accent-gold);
    color: var(--accent-dark);
}

/* Premium Products Grid */
.products-grid-premium {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 35px;
}

.products-grid-premium.list-view {
    grid-template-columns: 1fr;
    gap: 25px;
}

/* Premium Product Card */
.product-card-premium {
    background: var(--card-bg);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.4s ease;
    border: 1px solid var(--border-light);
    position: relative;
}

.product-card-premium:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.product-card-premium.list-view {
    display: flex;
    height: 200px;
}

.product-image-premium {
    position: relative;
    aspect-ratio: 1;
    overflow: hidden;
    background: var(--sidebar-bg);
}

.product-card-premium.list-view .product-image-premium {
    width: 200px;
    aspect-ratio: 1;
}

.product-image-premium img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card-premium:hover .product-image-premium img {
    transform: scale(1.08);
}

.product-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.product-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    backdrop-filter: blur(10px);
}

.badge-new {
    background: rgba(39, 174, 96, 0.9);
    color: white;
}

.badge-sale {
    background: rgba(231, 76, 60, 0.9);
    color: white;
}

.badge-limited {
    background: rgba(212, 175, 55, 0.9);
    color: var(--accent-dark);
}

.product-actions-quick {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    opacity: 0;
    transform: translateX(20px);
    transition: all 0.3s ease;
}

.product-card-premium:hover .product-actions-quick {
    opacity: 1;
    transform: translateX(0);
}

.quick-action-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: rgba(255, 255, 255, 0.95);
    color: var(--accent-dark);
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-md);
}

.quick-action-btn:hover {
    background: var(--accent-gold);
    transform: scale(1.1);
}

.product-info-premium {
    padding: 25px;
}

.product-card-premium.list-view .product-info-premium {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-genre {
    color: var(--accent-gold);
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}

.product-brand {
    color: var(--accent-purple);
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.product-brand::before {
    content: '🏷️';
    font-size: 0.7rem;
}

.product-name-premium {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 10px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-decoration: none;
}

.product-name-premium:hover {
    color: var(--accent-gold);
}

.product-artist-premium {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin-bottom: 15px;
    font-weight: 500;
}

.product-rating-premium {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
}

.stars-premium {
    color: var(--accent-gold);
    font-size: 1rem;
}

.rating-count-premium {
    color: var(--text-muted);
    font-size: 0.85rem;
    font-weight: 500;
}

.product-price-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.product-price-premium {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--accent-gold);
}

.product-original-price {
    font-size: 1rem;
    color: var(--text-muted);
    text-decoration: line-through;
    margin-left: 10px;
}

.stock-status-premium {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-in-premium {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.status-out-premium {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.status-pre-premium {
    background: rgba(243, 156, 18, 0.1);
    color: var(--warning-color);
}

.product-actions-premium {
    display: flex;
    gap: 12px;
}

.btn-add-cart-premium {
    flex: 1;
    padding: 10px 16px;
    background: var(--accent-gold);
    border: none;
    border-radius: 8px;
    color: var(--accent-dark);
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    min-height: 36px;
    box-sizing: border-box;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-add-cart-premium:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: translateY(-1px);
}

.btn-add-cart-premium:disabled {
    background: var(--text-muted);
    color: var(--card-bg);
    cursor: not-allowed;
    transform: none;
}

.btn-view-details-premium {
    padding: 10px 16px;
    background: transparent;
    border: 2px solid var(--accent-gold);
    border-radius: 8px;
    color: var(--accent-gold);
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    min-height: 36px;
    box-sizing: border-box;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-view-details-premium:hover {
    background: var(--accent-gold);
    color: var(--accent-dark);
}

/* Desktop Button Sizing - 50% smaller */
@media (min-width: 1025px) {
    .btn-add-cart-premium {
        padding: 5px 8px;
        font-size: 0.65rem;
        min-height: 18px;
        border-radius: 4px;
        letter-spacing: 0.25px;
        font-weight: 500;
    }
    
    .btn-view-details-premium {
        padding: 5px 8px;
        font-size: 0.65rem;
        min-height: 18px;
        border-radius: 4px;
        letter-spacing: 0.25px;
        font-weight: 500;
        border-width: 1px;
    }
    
    .btn-add-cart-premium:hover,
    .btn-view-details-premium:hover {
        transform: translateY(-0.5px);
    }
}

/* Empty State */
.empty-state-premium {
    text-align: center;
    padding: 100px 40px;
    background: var(--card-bg);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.empty-icon-premium {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.3;
}

.empty-title-premium {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 15px;
}

.empty-text-premium {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .products-grid-premium {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
}

@media (max-width: 968px) {
    .shop-layout-premium {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .premium-sidebar {
        position: static;
        order: -1;
    }
    
    .price-range-premium {
        gap: 6px;
    }
    
    .price-input-premium {
        max-width: 90px;
        padding: 6px 8px;
        font-size: 0.8rem;
        height: 34px;
    }
    
    .price-separator {
        font-size: 0.85rem;
        margin: 0 1px;
    }
    
    .btn-add-cart-premium,
    .btn-view-details-premium {
        padding: 9px 14px;
        font-size: 0.825rem;
        min-height: 34px;
        border-radius: 7px;
    }
    
    .hero-title-premium {
        font-size: 2.5rem;
    }
    
    .products-grid-premium {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .premium-shop {
        padding: 20px 15px 40px;
    }
    
    .premium-hero {
        padding: 50px 30px;
    }
    
    .hero-title-premium {
        font-size: 2rem;
    }
    
    .hero-subtitle-premium {
        font-size: 1.1rem;
    }
    
    .hero-stats {
        gap: 30px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .premium-sidebar {
        padding: 25px 20px;
    }
    
    .toolbar-premium {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }
    
    .toolbar-controls {
        justify-content: space-between;
    }
    
    .products-grid-premium {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .product-card-premium.list-view {
        flex-direction: column;
        height: auto;
    }
    
    .product-card-premium.list-view .product-image-premium {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .products-grid-premium {
        grid-template-columns: 1fr;
    }
    
    .product-actions-premium {
        flex-direction: column;
    }
    
    .btn-add-cart-premium,
    .btn-view-details-premium {
        width: 100%;
        padding: 8px 12px;
        font-size: 0.8rem;
        min-height: 32px;
        border-radius: 6px;
    }
}
</style>

<div class="premium-shop">
    <!-- Premium Hero Section -->
    <div class="premium-hero">
        <div class="hero-content-premium">
            <h1 class="hero-title-premium">Premium Vinyl Collection</h1>
            <p class="hero-subtitle-premium">
                Discover our curated selection of premium vinyl records, featuring the finest pressings 
                from around the world. Experience music the way it was meant to be heard.
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Vinyl Records</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Artists</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Genres</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Layout -->
    <div class="shop-layout-premium">
        <!-- Premium Sidebar -->
        <aside class="premium-sidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">Filters</h3>
                <a href="<?= site_url('shop') ?>" class="clear-filters">Clear All</a>
            </div>

            <!-- Genre Filter -->
            <div class="filter-section-premium">
                <h4>🎵 Genre</h4>
                <ul class="filter-list-premium">
                    <li>
                        <a href="<?= site_url('shop') ?>" class="<?= !$current_genre ? 'active' : '' ?>">
                            All Genres
                            <span class="filter-count"><?= count($products) ?></span>
                        </a>
                    </li>
                    <?php if(!empty($genres)): ?>
                        <?php foreach($genres as $genre): ?>
                            <?php 
                            $genreCount = 0;
                            foreach($products as $product) {
                                if(isset($product['genre']) && $product['genre'] === $genre) {
                                    $genreCount++;
                                }
                            }
                            ?>
                            <li>
                                <a href="<?= site_url('shop') ?>?genre=<?= urlencode($genre) ?>" class="<?= $current_genre == $genre ? 'active' : '' ?>">
                                    <?= esc($genre) ?>
                                    <span class="filter-count"><?= $genreCount ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Availability Filter -->
            <div class="filter-section-premium">
                <h4>📦 Availability</h4>
                <ul class="filter-list-premium">
                    <li>
                        <a href="#" class="active">
                            In Stock
                            <span class="filter-count"><?= count(array_filter($products, fn($p) => $p['quantity'] > 0 && $p['status'] != 'out_of_stock')) ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Pre-Order
                            <span class="filter-count"><?= count(array_filter($products, fn($p) => $p['status'] == 'pre_order')) ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Brand Filter -->
            <div class="filter-section-premium">
                <h4>🏷️ Brand</h4>
                <ul class="filter-list-premium">
                    <?php
                    // Get unique brands from products
                    $brands = [];
                    foreach ($products as $product) {
                        if (!empty($product['brand'])) {
                            $brands[] = $product['brand'];
                        }
                    }
                    $brands = array_unique($brands);
                    sort($brands);
                    
                    $current_brand = $_GET['brand'] ?? '';
                    ?>
                    <li>
                        <a href="<?= site_url('shop') ?>" class="<?= !$current_brand ? 'active' : '' ?>">
                            All Brands
                            <span class="filter-count"><?= count($products) ?></span>
                        </a>
                    </li>
                    <?php if (!empty($brands)): ?>
                        <?php foreach ($brands as $brand): ?>
                            <?php 
                            $brandCount = count(array_filter($products, fn($p) => $p['brand'] === $brand));
                            if ($brandCount > 0):
                            ?>
                            <li>
                                <a href="<?= site_url('shop') ?>?brand=<?= urlencode($brand) ?>" class="<?= $current_brand == $brand ? 'active' : '' ?>">
                                    <?= esc($brand) ?>
                                    <span class="filter-count"><?= $brandCount ?></span>
                                </a>
                            </li>
                        <?php 
                            endif;
                        endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Price Range Filter -->
            <div class="filter-section-premium">
                <h4>💰 Price Range</h4>
                <div class="price-range-premium">
                    <input type="number" class="price-input-premium" placeholder="Min" min="0" step="100">
                    <span class="price-separator">-</span>
                    <input type="number" class="price-input-premium" placeholder="Max" min="0" step="100">
                </div>
                <button class="apply-filter-btn">Apply Filter</button>
            </div>

            <!-- Condition Filter -->
            <div class="filter-section-premium">
                <h4>💎 Condition</h4>
                <ul class="filter-list-premium">
                    <li>
                        <a href="#" class="active">
                            Mint
                            <span class="filter-count">25</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Near Mint
                            <span class="filter-count">18</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Very Good
                            <span class="filter-count">12</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content-premium">
            <!-- Premium Toolbar -->
            <div class="toolbar-premium">
                <div class="results-info">
                    Showing <span class="results-count"><?= count($products) ?></span> premium vinyl records
                </div>
                <div class="toolbar-controls">
                    <select class="sort-dropdown">
                        <option>Sort by: Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Name: A-Z</option>
                        <option>Newest First</option>
                        <option>Best Rated</option>
                    </select>
                    <div class="view-toggle">
                        <button class="view-btn active" onclick="setView('grid')" title="Grid View">⚏</button>
                        <button class="view-btn" onclick="setView('list')" title="List View">☰</button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid-premium" id="productsGrid">
                <?php if(!empty($products)): ?>
                    <?php foreach($products as $product): ?>
                        <div class="product-card-premium">
                            <div class="product-image-premium">
                                <a href="<?= site_url('shop/product/' . $product['id']) ?>">
                                    <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>">
                                </a>
                                
                                <!-- Product Badges -->
                                <div class="product-badges">
                                    <?php if(rand(0, 4) === 0): ?>
                                        <span class="product-badge badge-new">New</span>
                                    <?php endif; ?>
                                    <?php if(rand(0, 5) === 0): ?>
                                        <span class="product-badge badge-sale">Sale</span>
                                    <?php endif; ?>
                                    <?php if(rand(0, 6) === 0): ?>
                                        <span class="product-badge badge-limited">Limited</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Quick Actions -->
                                <div class="product-actions-quick">
                                    <button class="quick-action-btn" onclick="toggleWishlist(<?= $product['id'] ?>)" title="Add to Wishlist">❤️</button>
                                    <button class="quick-action-btn" onclick="quickView(<?= $product['id'] ?>)" title="Quick View">👁️</button>
                                </div>
                            </div>
                            
                            <div class="product-info-premium">
                                <div class="product-genre"><?= esc($product['genre'] ?? 'Various') ?></div>
                                
                                <?php if (!empty($product['brand'])): ?>
                                <div class="product-brand"><?= esc($product['brand']) ?></div>
                                <?php endif; ?>
                                
                                <a href="<?= site_url('shop/product/' . $product['id']) ?>" class="product-name-premium">
                                    <?= esc($product['name']) ?>
                                </a>
                                
                                <div class="product-artist-premium">Various Artists</div>
                                
                                <div class="product-rating-premium">
                                    <div class="stars-premium">★★★★★</div>
                                    <span class="rating-count-premium">(<?= rand(5, 25) ?>)</span>
                                </div>
                                
                                <div class="product-price-row">
                                    <div>
                                        <span class="product-price-premium">฿<?= number_format($product['price'], 2) ?></span>
                                        <?php if(rand(0, 3) === 0): ?>
                                            <span class="product-original-price">฿<?= number_format($product['price'] * 1.3, 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php
                                    $statusClass = 'status-in-premium';
                                    $statusText = 'In Stock';
                                    if ($product['status'] == 'out_of_stock' || $product['quantity'] < 1) {
                                        $statusClass = 'status-out-premium';
                                        $statusText = 'Sold Out';
                                    } elseif ($product['status'] == 'pre_order') {
                                        $statusClass = 'status-pre-premium';
                                        $statusText = 'Pre-Order';
                                    }
                                    ?>
                                    <span class="stock-status-premium <?= $statusClass ?>"><?= $statusText ?></span>
                                </div>
                                
                                <div class="product-actions-premium">
                                    <?php if ($product['status'] == 'out_of_stock' || $product['quantity'] < 1): ?>
                                        <button class="btn-add-cart-premium" disabled>Sold Out</button>
                                    <?php elseif ($product['status'] == 'pre_order'): ?>
                                        <button class="btn-add-cart-premium" onclick="addToCart(<?= $product['id'] ?>)">Pre-Order</button>
                                    <?php else: ?>
                                        <button class="btn-add-cart-premium" onclick="addToCart(<?= $product['id'] ?>)">Add to Cart</button>
                                    <?php endif; ?>
                                    
                                    <a href="<?= site_url('shop/product/' . $product['id']) ?>" class="btn-view-details-premium">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state-premium">
                        <div class="empty-icon-premium">🎵</div>
                        <h2 class="empty-title-premium">No Products Found</h2>
                        <p class="empty-text-premium">
                            We couldn't find any products matching your criteria. 
                            Try adjusting your filters or browse our entire collection.
                        </p>
                        <a href="<?= site_url('shop') ?>" class="btn-add-cart-premium" style="display: inline-block; width: auto; padding: 15px 30px;">
                            Browse All Products
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<script>
// Enhanced Premium Shop JavaScript

// Global variables
let currentView = 'grid';
let wishlistItems = new Set();
let isLoading = false;

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeShop();
    loadWishlistFromStorage();
    setupInfiniteScroll();
    setupFilterListeners();
    animateProductsOnScroll();
});

// Initialize shop functionality
function initializeShop() {
    // Set initial view
    const gridView = document.querySelector('.view-btn[data-view="grid"]');
    if (gridView) gridView.classList.add('active');
    
    // Initialize tooltips
    initializeTooltips();
    
    // Setup keyboard navigation
    setupKeyboardNavigation();
}

// View Toggle with enhanced animation
function setView(viewType) {
    if (isLoading) return;
    
    const grid = document.getElementById('productsGrid');
    const buttons = document.querySelectorAll('.view-btn');
    const products = document.querySelectorAll('.product-card-premium');
    
    // Update button states
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Animate transition
    products.forEach((product, index) => {
        product.style.opacity = '0';
        product.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            if (viewType === 'list') {
                grid.classList.add('list-view');
                product.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
                product.classList.remove('list-view');
            }
            
            setTimeout(() => {
                product.style.opacity = '1';
                product.style.transform = 'translateY(0)';
            }, 50);
        }, index * 50);
    });
    
    currentView = viewType;
    saveViewPreference(viewType);
}

// Enhanced Add to Cart with animations
function addToCart(productId) {
    if (isLoading) return;
    
    const button = event.target;
    const originalText = button.textContent;
    const productCard = button.closest('.product-card-premium');
    
    // Disable button and show loading
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    isLoading = true;
    
    // Add ripple effect
    createRippleEffect(button);
    
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
            // Success animation
            button.innerHTML = '<i class="fas fa-check"></i> Added!';
            button.style.background = 'linear-gradient(135deg, #10b981, #22c55e)';
            
            // Product card animation
            productCard.style.transform = 'scale(1.05)';
            setTimeout(() => {
                productCard.style.transform = '';
            }, 300);
            
            // Update cart badge with animation
            updateCartBadge(data.total_items);
            
            // Show floating notification
            showNotification('Product added to cart!', 'success');
            
            // Reset button after delay
            setTimeout(() => {
                button.disabled = false;
                button.textContent = originalText;
                button.style.background = '';
                isLoading = false;
            }, 2000);
        } else {
            throw new Error(data.message || 'Failed to add to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        button.textContent = originalText;
        button.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Try Again';
        isLoading = false;
        
        showNotification('Failed to add product to cart', 'error');
        
        setTimeout(() => {
            button.textContent = originalText;
        }, 2000);
    });
}

// Enhanced Wishlist Toggle with persistence
function toggleWishlist(productId) {
    const button = event.target;
    const isWishlisted = wishlistItems.has(productId);
    
    // Toggle in set
    if (isWishlisted) {
        wishlistItems.delete(productId);
        button.classList.remove('wishlist-active');
        button.innerHTML = '🤍';
        showNotification('Removed from wishlist', 'info');
    } else {
        wishlistItems.add(productId);
        button.classList.add('wishlist-active');
        button.innerHTML = '❤️';
        showNotification('Added to wishlist!', 'success');
        
        // Heart animation
        button.style.animation = 'heartBeat 0.8s ease-in-out';
        setTimeout(() => {
            button.style.animation = '';
        }, 800);
    }
    
    // Save to localStorage
    saveWishlistToStorage();
    
    // Sync with server (placeholder)
    syncWishlistWithServer();
}

// Enhanced Quick View with modal
function quickView(productId) {
    // Create modal if it doesn't exist
    let modal = document.getElementById('quickViewModal');
    if (!modal) {
        modal = createQuickViewModal();
        document.body.appendChild(modal);
    }
    
    // Show loading state
    modal.querySelector('.modal-content').innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: var(--accent-gold);"></i>
            <p style="margin-top: 15px; color: var(--text-secondary);">Loading product details...</p>
        </div>
    `;
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    // Load product details (placeholder)
    setTimeout(() => {
        loadQuickViewContent(productId, modal);
    }, 500);
}

// Create quick view modal
function createQuickViewModal() {
    const modal = document.createElement('div');
    modal.id = 'quickViewModal';
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(5px);
    `;
    
    modal.innerHTML = `
        <div class="modal-content" style="
            background: var(--card-bg);
            border-radius: 20px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: fadeInUp 0.3s ease-out;
        ">
            <button onclick="closeQuickView()" style="
                position: absolute;
                top: 20px;
                right: 20px;
                background: none;
                border: none;
                font-size: 1.5rem;
                cursor: pointer;
                color: var(--text-secondary);
                z-index: 10;
            ">×</button>
            <div id="quickViewContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    `;
    
    // Close on backdrop click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeQuickView();
        }
    });
    
    return modal;
}

// Load quick view content (placeholder)
function loadQuickViewContent(productId, modal) {
    // This would typically fetch product details from the server
    const content = `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; padding: 30px;">
            <div>
                <img src="https://via.placeholder.com/400x400" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <h2 style="font-size: 1.8rem; margin-bottom: 10px;">Product Title</h2>
                <p style="color: var(--accent-gold); font-weight: 600; margin-bottom: 20px;">Genre Name</p>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <span style="color: var(--accent-gold);">★★★★★</span>
                    <span style="color: var(--text-secondary);">(24 reviews)</span>
                </div>
                <p style="font-size: 1.5rem; font-weight: 700; color: var(--accent-dark); margin-bottom: 20px;">฿1,299</p>
                <p style="color: var(--text-secondary); margin-bottom: 30px;">Product description goes here. This is a premium vinyl record with excellent quality and sound.</p>
                <div style="display: flex; gap: 15px;">
                    <button onclick="addToCart(productId); closeQuickView();" class="btn-add-cart-premium" style="flex: 1;">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <a href="javascript:void(0)" onclick="window.location.href='<?= site_url('shop/product/') ?>' + productId" class="btn-view-details-premium" style="text-align: center; padding: 12px 20px;">
                        View Details
                    </a>
                </div>
            </div>
        </div>
    `;
    
    modal.querySelector('.modal-content').innerHTML = content;
}

// Close quick view modal
function closeQuickView() {
    const modal = document.getElementById('quickViewModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

// Enhanced filter functionality
function setupFilterListeners() {
    // Genre filters
    const genreCheckboxes = document.querySelectorAll('input[name="genre[]"]');
    genreCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });
    
    // Price range
    const priceInputs = document.querySelectorAll('.price-input');
    priceInputs.forEach(input => {
        input.addEventListener('input', debounce(applyFilters, 500));
    });
    
    // Availability filters
    const availabilityCheckboxes = document.querySelectorAll('input[name="availability[]"]');
    availabilityCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });
}

// Apply filters with loading state
function applyFilters() {
    if (isLoading) return;
    
    isLoading = true;
    showLoadingSpinner();
    
    // Simulate filter application
    setTimeout(() => {
        hideLoadingSpinner();
        isLoading = false;
        updateResultsCount();
        animateFilteredProducts();
    }, 800);
}

// Sort functionality
function sortProducts(sortBy) {
    if (isLoading) return;
    
    isLoading = true;
    const grid = document.getElementById('productsGrid');
    const products = Array.from(grid.querySelectorAll('.product-card-premium'));
    
    // Add fade out animation
    products.forEach(product => {
        product.style.opacity = '0';
        product.style.transform = 'translateY(20px)';
    });
    
    setTimeout(() => {
        // Sort products based on criteria
        products.sort((a, b) => {
            switch(sortBy) {
                case 'price-low':
                    return getPriceFromElement(a) - getPriceFromElement(b);
                case 'price-high':
                    return getPriceFromElement(b) - getPriceFromElement(a);
                case 'name':
                    return getNameFromElement(a).localeCompare(getNameFromElement(b));
                case 'rating':
                    return getRatingFromElement(b) - getRatingFromElement(a);
                default:
                    return 0;
            }
        });
        
        // Reorder DOM
        products.forEach(product => grid.appendChild(product));
        
        // Fade in animation
        products.forEach((product, index) => {
            setTimeout(() => {
                product.style.opacity = '1';
                product.style.transform = 'translateY(0)';
            }, index * 50);
        });
        
        isLoading = false;
    }, 300);
}

// Helper functions for sorting
function getPriceFromElement(element) {
    const priceText = element.querySelector('.product-price-premium')?.textContent || '0';
    return parseFloat(priceText.replace(/[฿,]/g, ''));
}

function getNameFromElement(element) {
    return element.querySelector('.product-name-premium')?.textContent || '';
}

function getRatingFromElement(element) {
    const ratingText = element.querySelector('.rating-count')?.textContent || '0';
    return parseInt(ratingText.match(/\d+/)?.[0] || '0');
}

// Enhanced notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        z-index: 1001;
        animation: slideInRight 0.3s ease-out;
        box-shadow: var(--shadow-lg);
        display: flex;
        align-items: center;
        gap: 10px;
    `;
    
    const colors = {
        success: 'linear-gradient(135deg, #10b981, #22c55e)',
        error: 'linear-gradient(135deg, #ef4444, #dc2626)',
        info: 'linear-gradient(135deg, #3b82f6, #2563eb)'
    };
    
    notification.style.background = colors[type] || colors.info;
    
    const icons = {
        success: 'fas fa-check-circle',
        error: 'fas fa-exclamation-circle',
        info: 'fas fa-info-circle'
    };
    
    notification.innerHTML = `<i class="${icons[type] || icons.info}"></i> ${message}`;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Update cart badge with animation
function updateCartBadge(count) {
    let badge = document.querySelector('.cart-badge');
    if (!badge) {
        badge = document.createElement('span');
        badge.className = 'cart-badge';
        badge.style.cssText = `
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-gold);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        `;
        
        const cartIcon = document.querySelector('.fa-shopping-cart');
        if (cartIcon && cartIcon.parentElement) {
            cartIcon.parentElement.style.position = 'relative';
            cartIcon.parentElement.appendChild(badge);
        }
    }
    
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
    badge.style.animation = 'pulse 0.5s ease-out';
}

// Loading spinner functions
function showLoadingSpinner() {
    const spinner = document.querySelector('.loading-spinner');
    if (spinner) {
        spinner.classList.add('active');
    }
}

function hideLoadingSpinner() {
    const spinner = document.querySelector('.loading-spinner');
    if (spinner) {
        spinner.classList.remove('active');
    }
}

// Create ripple effect
function createRippleEffect(button) {
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
    `;
    
    button.style.position = 'relative';
    button.style.overflow = 'hidden';
    button.appendChild(ripple);
    
    setTimeout(() => ripple.remove(), 600);
}

// Wishlist storage functions
function saveWishlistToStorage() {
    localStorage.setItem('wishlist', JSON.stringify(Array.from(wishlistItems)));
}

function loadWishlistFromStorage() {
    const stored = localStorage.getItem('wishlist');
    if (stored) {
        wishlistItems = new Set(JSON.parse(stored));
        updateWishlistButtons();
    }
}

function updateWishlistButtons() {
    document.querySelectorAll('.quick-action-btn').forEach(button => {
        const productId = button.getAttribute('onclick')?.match(/\d+/)?.[0];
        if (productId && wishlistItems.has(parseInt(productId))) {
            button.classList.add('wishlist-active');
            button.innerHTML = '❤️';
        }
    });
}

function syncWishlistWithServer() {
    // Placeholder for server synchronization
    console.log('Syncing wishlist with server:', Array.from(wishlistItems));
}

// View preference storage
function saveViewPreference(view) {
    localStorage.setItem('preferredView', view);
}

// Infinite scroll
function setupInfiniteScroll() {
    let loading = false;
    
    window.addEventListener('scroll', debounce(() => {
        if (loading) return;
        
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight;
        const clientHeight = window.innerHeight;
        
        if (scrollTop + clientHeight >= scrollHeight - 1000) {
            loading = true;
            loadMoreProducts().then(() => {
                loading = false;
            });
        }
    }, 200));
}

function loadMoreProducts() {
    return new Promise(resolve => {
        // Placeholder for loading more products
        showLoadingSpinner();
        setTimeout(() => {
            hideLoadingSpinner();
            resolve();
        }, 1000);
    });
}

// Keyboard navigation
function setupKeyboardNavigation() {
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeQuickView();
        }
    });
}

// Initialize tooltips
function initializeTooltips() {
    // Placeholder for tooltip initialization
    console.log('Tooltips initialized');
}

// Animate products on scroll
function animateProductsOnScroll() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease-out';
                observer.unobserve(entry.target);
            }
        });
    });
    
    document.querySelectorAll('.product-card-premium').forEach(card => {
        observer.observe(card);
    });
}

// Update results count
function updateResultsCount() {
    const count = document.querySelectorAll('.product-card-premium').length;
    const countElement = document.querySelector('.results-count');
    if (countElement) {
        countElement.textContent = `Showing ${count} products`;
    }
}

// Animate filtered products
function animateFilteredProducts() {
    const products = document.querySelectorAll('.product-card-premium');
    products.forEach((product, index) => {
        product.style.animation = 'none';
        setTimeout(() => {
            product.style.animation = `fadeInUp 0.6s ease-out ${index * 0.1}s`;
        }, 10);
    });
}

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    @keyframes ripple {
        to { transform: scale(4); opacity: 0; }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
`;
document.head.appendChild(style);
</script>

<?= $this->endSection() ?>

