<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* Premium Homepage Styles */
:root {
    --primary-gradient: linear-gradient(135deg, var(--accent-dark), var(--accent-gold));
    --section-padding: 80px 20px;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --hover-transform: translateY(-5px);
}

/* Hero Section */
.hero-section {
    background: var(--primary-gradient);
    padding: 120px 20px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
    border-radius: 0 0 50px 50px;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="vinyl-hero" patternUnits="userSpaceOnUse" width="60" height="60"><circle cx="30" cy="30" r="20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/><circle cx="30" cy="30" r="8" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23vinyl-hero)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 4rem;
    font-weight: 900;
    margin-bottom: 20px;
    font-family: var(--font-secondary);
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 40px;
    opacity: 0.9;
    animation: fadeInUp 1s ease-out 0.2s;
    animation-fill-mode: both;
}

.hero-cta {
    display: inline-flex;
    gap: 20px;
    animation: fadeInUp 1s ease-out 0.4s;
    animation-fill-mode: both;
}

.btn-hero-primary, .btn-hero-secondary {
    padding: 15px 35px;
    border-radius: 30px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-hero-primary {
    background: white;
    color: var(--accent-dark);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.btn-hero-primary:hover {
    transform: var(--hover-transform);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.btn-hero-secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-hero-secondary:hover {
    background: white;
    color: var(--accent-dark);
    transform: var(--hover-transform);
}

/* Features Section */
.features-section {
    padding: var(--section-padding);
    background: var(--card-bg);
}

.features-container {
    max-width: 1200px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 20px;
    font-family: var(--font-secondary);
}

.section-subtitle {
    text-align: center;
    color: var(--text-secondary);
    font-size: 1.2rem;
    margin-bottom: 60px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.feature-card {
    text-align: center;
    padding: 40px 30px;
    background: white;
    border-radius: 20px;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    border: 1px solid var(--border-light);
}

.feature-card:hover {
    transform: var(--hover-transform);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
}

.feature-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 15px;
}

.feature-description {
    color: var(--text-secondary);
    line-height: 1.6;
}

/* Categories Section */
.categories-section {
    padding: var(--section-padding);
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(212, 175, 55, 0.05));
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    max-width: 1000px;
    margin: 0 auto;
}

.category-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: block;
}

.category-card:hover {
    transform: var(--hover-transform);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    text-decoration: none;
    color: inherit;
}

.category-image {
    height: 200px;
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
}

.category-info {
    padding: 25px;
    text-align: center;
}

.category-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 10px;
}

.category-count {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

/* Brands Section */
.brands-section {
    padding: var(--section-padding);
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.05), rgba(139, 92, 246, 0.05));
}

.brands-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    max-width: 1000px;
    margin: 0 auto;
}

.brand-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: block;
    border: 1px solid var(--border-light);
}

.brand-card:hover {
    transform: var(--hover-transform);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    text-decoration: none;
    color: inherit;
}

.brand-image {
    height: 120px;
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-gold));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
}

.brand-info {
    padding: 20px;
    text-align: center;
}

.brand-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
}

.brand-count {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

/* Products Preview Section */
.products-preview-section {
    padding: var(--section-padding);
    background: var(--card-bg);
}

.products-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto 50px;
}

.product-preview-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    border: 1px solid var(--border-light);
}

.product-preview-card:hover {
    transform: var(--hover-transform);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.product-preview-image {
    height: 250px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: #adb5bd;
}

.product-preview-info {
    padding: 20px;
}

.product-preview-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
}

.product-preview-artist {
    color: var(--text-secondary);
    margin-bottom: 15px;
}

.product-preview-price {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--accent-gold);
}

.view-all-products {
    text-align: center;
}

.btn-view-all {
    display: inline-block;
    padding: 15px 40px;
    background: var(--primary-gradient);
    color: white;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-view-all:hover {
    transform: var(--hover-transform);
    box-shadow: 0 15px 40px rgba(139, 92, 246, 0.3);
    color: white;
    text-decoration: none;
}

/* Newsletter Section */
.newsletter-section {
    padding: 80px 20px;
    background: var(--primary-gradient);
    text-align: center;
    color: white;
    border-radius: 50px 50px 0 0;
}

.newsletter-content {
    max-width: 600px;
    margin: 0 auto;
}

.newsletter-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 15px;
    font-family: var(--font-secondary);
}

.newsletter-subtitle {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
}

.newsletter-form {
    display: flex;
    gap: 15px;
    max-width: 500px;
    margin: 0 auto;
}

.newsletter-input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: 30px;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.9);
}

.newsletter-input:focus {
    outline: none;
    background: white;
}

.newsletter-button {
    padding: 15px 30px;
    background: white;
    color: var(--accent-dark);
    border: none;
    border-radius: 30px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.newsletter-button:hover {
    transform: var(--hover-transform);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Animations */
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

/* Responsive Design */
/* Tablet Devices (768px - 1024px) */
@media (max-width: 1024px) and (min-width: 769px) {
    .hero-title {
        font-size: 3.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.4rem;
    }
    
    .section-title {
        font-size: 2.2rem;
    }
    
    .features-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    
    .categories-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
    
    .brands-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .brand-image {
        height: 100px;
        font-size: 2rem;
    }
    
    .products-preview-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
    
    .feature-card {
        padding: 35px 25px;
    }
    
    .category-info {
        padding: 20px;
    }
    
    .newsletter-form {
        max-width: 450px;
    }
}

/* Mobile Devices (max-width: 768px) */
@media (max-width: 768px) {
    .hero-section {
        padding: 80px 15px;
        border-radius: 0 0 30px 30px;
    }
    
    .hero-title {
        font-size: 2.2rem;
        margin-bottom: 15px;
        letter-spacing: 2px;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        margin-bottom: 30px;
        line-height: 1.5;
    }
    
    .hero-cta {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .btn-hero-primary, .btn-hero-secondary {
        width: 200px;
        padding: 12px 25px;
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 1.8rem;
        margin-bottom: 15px;
    }
    
    .section-subtitle {
        font-size: 1rem;
        margin-bottom: 40px;
        line-height: 1.5;
    }
    
    .features-section,
    .categories-section,
    .brands-section,
    .products-preview-section {
        padding: 60px 15px;
    }
    
    .features-grid,
    .categories-grid,
    .brands-grid,
    .products-preview-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .feature-card {
        padding: 30px 20px;
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    
    .feature-title {
        font-size: 1.3rem;
        margin-bottom: 12px;
    }
    
    .feature-description {
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .category-image {
        height: 150px;
        font-size: 2.5rem;
    }
    
    .category-info {
        padding: 20px 15px;
    }
    
    .category-name {
        font-size: 1.2rem;
    }
    
    .brand-image {
        height: 80px;
        font-size: 1.8rem;
    }
    
    .brand-info {
        padding: 15px;
    }
    
    .brand-name {
        font-size: 1rem;
    }
    
    .product-preview-image {
        height: 200px;
        font-size: 3rem;
    }
    
    .product-preview-info {
        padding: 15px;
    }
    
    .product-preview-title {
        font-size: 1.1rem;
        margin-bottom: 6px;
    }
    
    .product-preview-artist {
        font-size: 0.9rem;
        margin-bottom: 12px;
    }
    
    .product-preview-price {
        font-size: 1.2rem;
    }
    
    .newsletter-section {
        padding: 60px 15px;
        border-radius: 30px 30px 0 0;
    }
    
    .newsletter-title {
        font-size: 2rem;
        margin-bottom: 12px;
    }
    
    .newsletter-subtitle {
        font-size: 1rem;
        margin-bottom: 30px;
        line-height: 1.5;
    }
    
    .newsletter-form {
        flex-direction: column;
        max-width: 100%;
    }
    
    .newsletter-input {
        margin-bottom: 15px;
    }
    
    .newsletter-button {
        width: 100%;
        padding: 12px 25px;
    }
}

/* Small Mobile Devices (max-width: 480px) */
@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
        letter-spacing: 1px;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .btn-hero-primary, .btn-hero-secondary {
        width: 180px;
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .section-title {
        font-size: 1.6rem;
    }
    
    .section-subtitle {
        font-size: 0.95rem;
    }
    
    .features-section,
    .categories-section,
    .products-preview-section {
        padding: 40px 10px;
    }
    
    .feature-card {
        padding: 25px 15px;
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        font-size: 1.3rem;
    }
    
    .feature-title {
        font-size: 1.2rem;
    }
    
    .feature-description {
        font-size: 0.9rem;
    }
    
    .category-image {
        height: 120px;
        font-size: 2rem;
    }
    
    .category-info {
        padding: 15px 10px;
    }
    
    .product-preview-image {
        height: 160px;
        font-size: 2.5rem;
    }
    
    .product-preview-info {
        padding: 12px;
    }
    
    .product-preview-title {
        font-size: 1rem;
    }
    
    .product-preview-artist {
        font-size: 0.85rem;
    }
    
    .product-preview-price {
        font-size: 1.1rem;
    }
    
    .newsletter-title {
        font-size: 1.8rem;
    }
    
    .newsletter-subtitle {
        font-size: 0.9rem;
    }
}

/* Touch and Mobile Enhancements */
@media (hover: none) and (pointer: coarse) {
    .feature-card,
    .category-card,
    .product-preview-card {
        transform: none !important;
    }
    
    .feature-card:active,
    .category-card:active,
    .product-preview-card:active {
        transform: scale(0.98) !important;
        transition: transform 0.1s ease !important;
    }
    
    .btn-hero-primary:active,
    .btn-hero-secondary:active,
    .btn-view-all:active,
    .newsletter-button:active {
        transform: scale(0.95) !important;
        transition: transform 0.1s ease !important;
    }
}

/* Smooth scrolling for mobile */
@media (max-width: 768px) {
    html {
        scroll-behavior: smooth;
    }
    
    /* Prevent horizontal scroll */
    body {
        overflow-x: hidden;
    }
    
    /* Better touch targets */
    .category-card,
    .product-preview-card {
        min-height: 44px; /* iOS touch target minimum */
    }
}

/* Landscape mobile optimizations */
@media (max-width: 768px) and (orientation: landscape) {
    .hero-section {
        padding: 60px 15px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
        margin-bottom: 20px;
    }
    
    .features-section,
    .categories-section,
    .products-preview-section {
        padding: 40px 15px;
    }
    
    .newsletter-section {
        padding: 40px 15px;
    }
}

/* Large tablets and small desktops */
@media (min-width: 1025px) and (max-width: 1200px) {
    .features-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 35px;
    }
    
    .categories-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    
    .products-preview-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .hero-title {
        font-size: 3.8rem;
    }
    
    .section-title {
        font-size: 2.3rem;
    }
}

/* Bottom Navigation Bar for Mobile & Tablet */
.bottom-nav {
    display: none;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: var(--card-bg);
    border-top: 1px solid var(--border-light);
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    padding: 8px 0;
    height: 70px;
}

.bottom-nav-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    max-width: 600px;
    margin: 0 auto;
    height: 100%;
}

.bottom-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: var(--text-muted);
    transition: all 0.3s ease;
    padding: 8px 12px;
    border-radius: 12px;
    min-width: 60px;
    height: 54px;
    text-decoration: none !important;
}

.bottom-nav-item:hover {
    color: var(--accent-gold);
    background: rgba(212, 175, 55, 0.1);
    text-decoration: none !important;
}

.bottom-nav-item.active {
    color: var(--accent-gold);
    background: rgba(212, 175, 55, 0.15);
}

.bottom-nav-icon {
    font-size: 1.2rem;
    margin-bottom: 4px;
    transition: transform 0.3s ease;
}

.bottom-nav-item:hover .bottom-nav-icon {
    transform: scale(1.1);
}

.bottom-nav-label {
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1;
}

/* Force display on mobile and tablet */
@media (max-width: 1024px) {
    .bottom-nav {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    body {
        padding-bottom: 70px !important;
    }
}

/* Tablet specific adjustments */
@media (max-width: 1024px) and (min-width: 769px) {
    .bottom-nav-container {
        max-width: 500px;
    }
    
    .bottom-nav-item {
        min-width: 70px;
        padding: 10px 15px;
        height: 50px;
    }
    
    .bottom-nav-icon {
        font-size: 1.3rem;
        margin-bottom: 5px;
    }
    
    .bottom-nav-label {
        font-size: 0.75rem;
    }
    
    body {
        padding-bottom: 70px !important;
    }
}

/* Mobile specific adjustments */
@media (max-width: 768px) {
    .bottom-nav {
        padding: 6px 0;
        height: 65px;
    }
    
    .bottom-nav-item {
        min-width: 55px;
        padding: 6px 8px;
        height: 48px;
    }
    
    .bottom-nav-icon {
        font-size: 1.1rem;
        margin-bottom: 3px;
    }
    
    .bottom-nav-label {
        font-size: 0.65rem;
    }
    
    body {
        padding-bottom: 65px !important;
    }
}

/* Small mobile adjustments */
@media (max-width: 480px) {
    .bottom-nav {
        padding: 5px 0;
        height: 60px;
    }
    
    .bottom-nav-item {
        min-width: 50px;
        padding: 5px 6px;
        height: 45px;
    }
    
    .bottom-nav-icon {
        font-size: 1rem;
        margin-bottom: 2px;
    }
    
    .bottom-nav-label {
        font-size: 0.6rem;
    }
    
    body {
        padding-bottom: 60px !important;
    }
}

/* Hide on desktop */
@media (min-width: 1025px) {
    .bottom-nav {
        display: none !important;
    }
    
    body {
        padding-bottom: 0 !important;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Welcome to IBidSiam</h1>
        <p class="hero-subtitle">Discover Premium Vinyl Records & Music Collections</p>
        <div class="hero-cta">
            <a href="<?= site_url('shop') ?>" class="btn-hero-primary">Shop Now</a>
            <a href="<?= site_url('pages/about') ?>" class="btn-hero-secondary">Learn More</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="features-container">
        <h2 class="section-title">Why Choose IBidSiam?</h2>
        <p class="section-subtitle">Experience the best vinyl shopping with our premium features</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-compact-disc"></i>
                </div>
                <h3 class="feature-title">Premium Quality</h3>
                <p class="feature-description">Carefully curated selection of high-quality vinyl records from top artists and genres</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3 class="feature-title">Fast Delivery</h3>
                <p class="feature-description">Quick and secure shipping to get your favorite records delivered safely to your doorstep</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Secure Shopping</h3>
                <p class="feature-description">Safe payment methods and buyer protection for worry-free shopping experience</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="features-container">
        <h2 class="section-title">Browse Categories</h2>
        <p class="section-subtitle">Explore our diverse collection of music genres</p>
        
        <div class="categories-grid">
            <a href="<?= site_url('shop?genre=rock') ?>" class="category-card">
                <div class="category-image">
                    <i class="fas fa-guitar"></i>
                </div>
                <div class="category-info">
                    <h3 class="category-name">Rock</h3>
                    <p class="category-count">250+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?genre=jazz') ?>" class="category-card">
                <div class="category-image">
                    <i class="fas fa-saxophone"></i>
                </div>
                <div class="category-info">
                    <h3 class="category-name">Jazz</h3>
                    <p class="category-count">180+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?genre=classical') ?>" class="category-card">
                <div class="category-image">
                    <i class="fas fa-violin"></i>
                </div>
                <div class="category-info">
                    <h3 class="category-name">Classical</h3>
                    <p class="category-count">120+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?genre=electronic') ?>" class="category-card">
                <div class="category-image">
                    <i class="fas fa-headphones"></i>
                </div>
                <div class="category-info">
                    <h3 class="category-name">Electronic</h3>
                    <p class="category-count">200+ Records</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Brands Section -->
<section class="brands-section">
    <div class="features-container">
        <h2 class="section-title">Shop by Brand</h2>
        <p class="section-subtitle">Discover vinyl records from premium record labels and brands</p>
        
        <div class="brands-grid">
            <a href="<?= site_url('shop?brand=Sony') ?>" class="brand-card">
                <div class="brand-image">
                    <i class="fas fa-record-vinyl"></i>
                </div>
                <div class="brand-info">
                    <h3 class="brand-name">Sony Music</h3>
                    <p class="brand-count">150+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?brand=Universal') ?>" class="brand-card">
                <div class="brand-image">
                    <i class="fas fa-compact-disc"></i>
                </div>
                <div class="brand-info">
                    <h3 class="brand-name">Universal</h3>
                    <p class="brand-count">200+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?brand=Warner') ?>" class="brand-card">
                <div class="brand-image">
                    <i class="fas fa-music"></i>
                </div>
                <div class="brand-info">
                    <h3 class="brand-name">Warner Bros</h3>
                    <p class="brand-count">180+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?brand=EMI') ?>" class="brand-card">
                <div class="brand-image">
                    <i class="fas fa-headphones"></i>
                </div>
                <div class="brand-info">
                    <h3 class="brand-name">EMI</h3>
                    <p class="brand-count">120+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?brand=Atlantic') ?>" class="brand-card">
                <div class="brand-image">
                    <i class="fas fa-guitar"></i>
                </div>
                <div class="brand-info">
                    <h3 class="brand-name">Atlantic</h3>
                    <p class="brand-count">90+ Records</p>
                </div>
            </a>
            
            <a href="<?= site_url('shop?brand=Capitol') ?>" class="brand-card">
                <div class="brand-image">
                    <i class="fas fa-microphone"></i>
                </div>
                <div class="brand-info">
                    <h3 class="brand-name">Capitol</h3>
                    <p class="brand-count">110+ Records</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Products Preview Section -->
<section class="products-preview-section">
    <div class="features-container">
        <h2 class="section-title">Featured Products</h2>
        <p class="section-subtitle">Check out our handpicked selection of premium vinyl records</p>
        
        <div class="products-preview-grid">
            <div class="product-preview-card">
                <div class="product-preview-image">
                    <i class="fas fa-compact-disc"></i>
                </div>
                <div class="product-preview-info">
                    <h3 class="product-preview-title">Classic Rock Essentials</h3>
                    <p class="product-preview-artist">Various Artists</p>
                    <p class="product-preview-price">฿1,299</p>
                </div>
            </div>
            
            <div class="product-preview-card">
                <div class="product-preview-image">
                    <i class="fas fa-compact-disc"></i>
                </div>
                <div class="product-preview-info">
                    <h3 class="product-preview-title">Jazz Masters Collection</h3>
                    <p class="product-preview-artist">Legendary Artists</p>
                    <p class="product-preview-price">฿1,599</p>
                </div>
            </div>
            
            <div class="product-preview-card">
                <div class="product-preview-image">
                    <i class="fas fa-compact-disc"></i>
                </div>
                <div class="product-preview-info">
                    <h3 class="product-preview-title">Electronic Dreams</h3>
                    <p class="product-preview-artist">DJ Masters</p>
                    <p class="product-preview-price">฿999</p>
                </div>
            </div>
        </div>
        
        <div class="view-all-products">
            <a href="<?= site_url('shop') ?>" class="btn-view-all">View All Products</a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="newsletter-content">
        <h2 class="newsletter-title">Stay Updated</h2>
        <p class="newsletter-subtitle">Get the latest updates on new arrivals and exclusive offers</p>
        <form class="newsletter-form" onsubmit="subscribeNewsletter(event)">
            <input type="email" class="newsletter-input" placeholder="Enter your email" required>
            <button type="submit" class="newsletter-button">Subscribe</button>
        </form>
    </div>
</section>

<script>
// Newsletter subscription
function subscribeNewsletter(event) {
    event.preventDefault();
    const email = event.target.querySelector('.newsletter-input').value;
    
    // Show success message
    const button = event.target.querySelector('.newsletter-button');
    const originalText = button.textContent;
    
    button.textContent = 'Subscribing...';
    button.disabled = true;
    
    setTimeout(() => {
        button.textContent = '✓ Subscribed!';
        button.style.background = '#10b981';
        
        // Reset form
        event.target.reset();
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.background = '';
            button.disabled = false;
        }, 3000);
    }, 1500);
    
    // Here you would typically send the email to your server
    console.log('Newsletter subscription:', email);
}

// Smooth scroll animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease-out';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe feature cards and category cards
    document.querySelectorAll('.feature-card, .category-card, .product-preview-card').forEach(card => {
        card.style.opacity = '0';
        observer.observe(card);
    });
}
}

// Bottom Navigation Active State Management
document.addEventListener('DOMContentLoaded', function() {
    // Set active state based on current page
    const currentPath = window.location.pathname;
    const bottomNavItems = document.querySelectorAll('.bottom-nav-item');
    
    bottomNavItems.forEach(item => {
        item.classList.remove('active');
        
        // Check if this item matches the current page
        const href = item.getAttribute('href');
        if (href === currentPath || 
            (currentPath.includes('shop') && href.includes('shop')) ||
            (currentPath === '/' && href.includes('home'))) {
            item.classList.add('active');
        }
    });
    
    // Add touch feedback for mobile
    bottomNavItems.forEach(item => {
        item.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.95)';
        });
        
        item.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

// Hide bottom nav when scrolling down, show when scrolling up (mobile only)
let lastScrollTop = 0;
let scrollTimer = null;

window.addEventListener('scroll', function() {
    if (window.innerWidth <= 1024) {
        const bottomNav = document.querySelector('.bottom-nav');
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(function() {
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down
                bottomNav.style.transform = 'translateY(100%)';
            } else {
                // Scrolling up or at top
                bottomNav.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, 10);
    }
});

</script>

<?= $this->endSection() ?>

</header>

<!-- CONTENT -->

<section>

    <h1>About this page</h1>

    <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

    <p>If you would like to edit this page you will find it located at:</p>

    <pre><code>app/Views/welcome_message.php</code></pre>

    <p>The corresponding controller for this page can be found at:</p>

    <pre><code>app/Controllers/Home.php</code></pre>

</section>

<div class="further">

    <section>

        <h1>Go further</h1>

        <h2>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><rect x='32' y='96' width='64' height='368' rx='16' ry='16' class="svg-stroke" /><line x1='112' y1='224' x2='240' y2='224' class="svg-stroke" /><line x1='112' y1='400' x2='240' y2='400' class="svg-stroke" /><rect x='112' y='160' width='128' height='304' rx='16' ry='16' class="svg-stroke" /><rect x='256' y='48' width='96' height='416' rx='16' ry='16' class="svg-stroke" /><path d='M422.46,96.11l-40.4,4.25c-11.12,1.17-19.18,11.57-17.93,23.1l34.92,321.59c1.26,11.53,11.37,20,22.49,18.84l40.4-4.25c11.12-1.17,19.18-11.57,17.93-23.1L445,115C443.69,103.42,433.58,94.94,422.46,96.11Z' class="svg-stroke"/></svg>
            Learn
        </h2>

        <p>The User Guide contains an introduction, tutorial, a number of "how to"
            guides, and then reference documentation for the components that make up
            the framework. Check the <a href="https://codeigniter.com/user_guide/"
            target="_blank">User Guide</a> !</p>

        <h2>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z' class="svg-stroke" /><path d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11' class="svg-stroke" /></svg>
            Discuss
        </h2>

        <p>CodeIgniter is a community-developed open source project, with several
             venues for the community members to gather and exchange ideas. View all
             the threads on <a href="https://forum.codeigniter.com/"
             target="_blank">CodeIgniter's forum</a>, or <a href="https://join.slack.com/t/codeigniterchat/shared_invite/zt-rl30zw00-obL1Hr1q1ATvkzVkFp8S0Q"
             target="_blank">chat on Slack</a> !</p>

        <h2>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><line x1='176' y1='48' x2='336' y2='48' class="svg-stroke" /><line x1='118' y1='304' x2='394' y2='304' class="svg-stroke" /><path d='M208,48v93.48a64.09,64.09,0,0,1-9.88,34.18L73.21,373.49C48.4,412.78,76.63,464,123.08,464H388.92c46.45,0,74.68-51.22,49.87-90.51L313.87,175.66A64.09,64.09,0,0,1,304,141.48V48' class="svg-stroke" /></svg>
             Contribute
        </h2>

        <p>CodeIgniter is a community driven project and accepts contributions
             of code and documentation from the community. Why not
             <a href="https://codeigniter.com/contribute" target="_blank">
             join us</a> ?</p>

    </section>

</div>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>
    <div class="environment">

        <p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>

        <p>Environment: <?= ENVIRONMENT ?></p>

    </div>

    <div class="copyrights">

        <p>&copy; <?= date('Y') ?> CodeIgniter Foundation. CodeIgniter is open source project released under the MIT
            open source licence.</p>

    </div>

</footer>

<!-- SCRIPTS -->

<script {csp-script-nonce}>
    document.getElementById("menuToggle").addEventListener('click', toggleMenu);
    function toggleMenu() {
        var menuItems = document.getElementsByClassName('menu-item');
        for (var i = 0; i < menuItems.length; i++) {
            var menuItem = menuItems[i];
            menuItem.classList.toggle("hidden");
        }
    }
</script>

<!-- -->

<!-- Bottom Navigation Bar (Mobile & Tablet Only) -->
<nav class="bottom-nav">
    <div class="bottom-nav-container">
        <a href="<?= site_url() ?>" class="bottom-nav-item active">
            <i class="fas fa-home bottom-nav-icon"></i>
            <span class="bottom-nav-label">Home</span>
        </a>
        <a href="<?= site_url('shop') ?>" class="bottom-nav-item">
            <i class="fas fa-shopping-bag bottom-nav-icon"></i>
            <span class="bottom-nav-label">Shop</span>
        </a>
        <a href="<?= site_url('categories') ?>" class="bottom-nav-item">
            <i class="fas fa-th-large bottom-nav-icon"></i>
            <span class="bottom-nav-label">Categories</span>
        </a>
        <a href="<?= site_url('wishlist') ?>" class="bottom-nav-item">
            <i class="fas fa-heart bottom-nav-icon"></i>
            <span class="bottom-nav-label">Wishlist</span>
        </a>
        <a href="<?= site_url('account') ?>" class="bottom-nav-item">
            <i class="fas fa-user bottom-nav-icon"></i>
            <span class="bottom-nav-label">Account</span>
        </a>
    </div>
</nav>

</body>
</html>
