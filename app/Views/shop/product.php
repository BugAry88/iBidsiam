<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* ============================
   Enhanced Product Detail Page
   ============================ */
.pd-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    min-height: calc(100vh - 200px);
}

/* Breadcrumbs */
.pd-breadcrumbs {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pd-breadcrumbs a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.pd-breadcrumbs a:hover {
    color: var(--accent-gold);
}

.pd-breadcrumb-separator {
    color: var(--text-muted);
}

/* === TOP SECTION: Image + Info === */
.pd-top {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 80px;
    align-items: start;
}

/* Left: Product Image Gallery */
.pd-image-section {
    position: sticky;
    top: 100px;
}

.pd-main-image {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    margin-bottom: 20px;
    border: 1px solid var(--border-light);
}

.pd-main-image img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.pd-main-image:hover img {
    transform: scale(1.02);
}

.pd-image-gallery {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.pd-gallery-thumb {
    aspect-ratio: 1;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    background: var(--sidebar-bg);
}

.pd-gallery-thumb:hover,
.pd-gallery-thumb.active {
    border-color: var(--accent-gold);
    transform: scale(1.05);
}

.pd-gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Right: Product Info */
.pd-info {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 40px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.pd-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 15px;
    line-height: 1.2;
    font-family: var(--font-secondary);
}

.pd-artist {
    font-size: 1.2rem;
    color: var(--accent-gold);
    font-weight: 600;
    margin-bottom: 20px;
}

.pd-rating {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
}

.pd-stars {
    color: var(--accent-gold);
    font-size: 1.1rem;
}

.pd-rating-count {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.pd-price-section {
    display: flex;
    align-items: baseline;
    gap: 15px;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 2px solid var(--border-light);
}

.pd-price {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent-gold);
}

.pd-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.pd-status.in-stock {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.pd-status.out-of-stock {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.pd-status.pre-order {
    background: rgba(243, 156, 18, 0.1);
    color: var(--warning-color);
}

/* Vinyl Specific Info */
.pd-vinyl-info {
    background: var(--sidebar-bg);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
}

.pd-vinyl-info h4 {
    color: var(--accent-dark);
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pd-specs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.pd-spec-item {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
}

.pd-spec-label {
    color: var(--text-secondary);
    font-weight: 500;
}

.pd-spec-value {
    color: var(--text-color);
    font-weight: 600;
}

/* Quantity and Add to Cart */
.pd-purchase {
    margin-bottom: 25px;
}

.pd-quantity-section {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}

.pd-quantity-label {
    font-weight: 600;
    color: var(--text-color);
    font-size: 0.95rem;
}

.pd-quantity-controls {
    display: flex;
    align-items: center;
    border: 2px solid var(--border-light);
    border-radius: 50px;
    overflow: hidden;
    background: var(--card-bg);
}

.pd-quantity-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: var(--accent-gold);
    color: var(--accent-dark);
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pd-quantity-btn:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
}

.pd-quantity-input {
    width: 70px;
    height: 40px;
    border: none;
    text-align: center;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-color);
    background: transparent;
}

.pd-add-cart {
    width: 100%;
    padding: 18px 24px;
    background: linear-gradient(135deg, var(--accent-gold), #b8941f);
    border: none;
    color: var(--accent-dark);
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    border-radius: 50px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: var(--shadow-md);
    font-family: var(--font-secondary);
}

.pd-add-cart:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    background: linear-gradient(135deg, #e6c547, var(--accent-gold));
}

.pd-add-cart:disabled {
    background: var(--text-muted);
    color: var(--card-bg);
    cursor: not-allowed;
    transform: none;
}

/* Product Description */
.pd-description {
    margin-bottom: 30px;
}

.pd-description h3 {
    color: var(--accent-dark);
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--accent-gold);
}

.pd-description-text {
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 1rem;
}

/* Track Listing */
.pd-tracks {
    background: var(--sidebar-bg);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
}

.pd-tracks h3 {
    color: var(--accent-dark);
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.pd-track-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pd-track-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid var(--border-light);
    font-size: 0.95rem;
}

.pd-track-item:last-child {
    border-bottom: none;
}

.pd-track-number {
    color: var(--text-muted);
    font-weight: 600;
    width: 30px;
}

.pd-track-name {
    flex: 1;
    color: var(--text-color);
    font-weight: 500;
}

.pd-track-duration {
    color: var(--text-secondary);
    font-weight: 500;
}

/* Additional Information */
.pd-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 40px;
}

.pd-detail-card {
    background: var(--sidebar-bg);
    border-radius: 12px;
    padding: 25px;
    border: 1px solid var(--border-light);
}

.pd-detail-card h4 {
    color: var(--accent-dark);
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pd-detail-content {
    color: var(--text-secondary);
    line-height: 1.5;
    font-size: 0.95rem;
}

/* Related Products */
.pd-related {
    margin-top: 80px;
}

.pd-related h2 {
    color: var(--accent-dark);
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 40px;
    text-align: center;
    font-family: var(--font-secondary);
}

.pd-related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.pd-related-card {
    background: var(--card-bg);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    border: 1px solid var(--border-light);
}

.pd-related-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.pd-related-image {
    aspect-ratio: 1;
    overflow: hidden;
}

.pd-related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.pd-related-card:hover .pd-related-image img {
    transform: scale(1.05);
}

.pd-related-info {
    padding: 20px;
}

.pd-related-name {
    font-size: 1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
    line-height: 1.3;
}

.pd-related-price {
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--accent-gold);
}

/* Responsive Design */
@media (max-width: 968px) {
    .pd-top {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .pd-image-section {
        position: static;
    }
    
    .pd-specs-grid {
        grid-template-columns: 1fr;
    }
    
    .pd-details {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .pd-container {
        padding: 20px 15px 40px;
    }
    
    .pd-info {
        padding: 25px;
    }
    
    .pd-title {
        font-size: 1.5rem;
    }
    
    .pd-price {
        font-size: 1.5rem;
    }
    
    .pd-related-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
}
</style>

<div class="pd-container">
    <!-- Breadcrumbs -->
    <nav class="pd-breadcrumbs">
        <a href="<?= site_url('shop') ?>">Home</a>
        <span class="pd-breadcrumb-separator">›</span>
        <a href="<?= site_url('shop') ?>">Vinyl Records</a>
        <span class="pd-breadcrumb-separator">›</span>
        <span><?= esc($product['name']) ?></span>
    </nav>

    <!-- Top Section: Image + Info -->
    <div class="pd-top">
        <!-- Left: Product Image Gallery -->
        <div class="pd-image-section">
            <div class="pd-main-image">
                <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>" id="mainImage">
            </div>
            
            <!-- Thumbnail Gallery -->
            <div class="pd-image-gallery">
                <div class="pd-gallery-thumb active" onclick="changeImage('<?= esc($product['image']) ?>', this)">
                    <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>">
                </div>
                <!-- Add more thumbnails if available -->
                <div class="pd-gallery-thumb" onclick="changeImage('<?= esc($product['image']) ?>', this)">
                    <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?> - Back">
                </div>
                <div class="pd-gallery-thumb" onclick="changeImage('<?= esc($product['image']) ?>', this)">
                    <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?> - Detail">
                </div>
                <div class="pd-gallery-thumb" onclick="changeImage('<?= esc($product['image']) ?>', this)">
                    <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?> - Inner">
                </div>
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="pd-info">
            <h1 class="pd-title"><?= esc($product['name']) ?></h1>
            <div class="pd-artist">Various Artists</div>
            
            <!-- Rating -->
            <div class="pd-rating">
                <div class="pd-stars">★★★★★</div>
                <span class="pd-rating-count">(5 Reviews)</span>
            </div>

            <!-- Price & Status -->
            <div class="pd-price-section">
                <div class="pd-price">฿<?= number_format($product['price'], 2) ?></div>
                <?php
                $statusClass = 'in-stock';
                $statusText = 'In Stock';
                if ($product['status'] == 'out_of_stock' || $product['quantity'] < 1) {
                    $statusClass = 'out-of-stock';
                    $statusText = 'Out of Stock';
                } elseif ($product['status'] == 'pre_order') {
                    $statusClass = 'pre-order';
                    $statusText = 'Pre-Order';
                } elseif ($product['status'] == 'special_pre_order') {
                    $statusClass = 'special-pre-order';
                    $statusText = 'Special Pre-Order Price';
                } elseif ($product['status'] == 'available_order') {
                    $statusClass = 'available-order';
                    $statusText = 'Available For Order';
                }
                ?>
                <div class="pd-status <?= $statusClass ?>"><?= $statusText ?></div>
            </div>

            <!-- Vinyl Specific Information -->
            <div class="pd-vinyl-info">
                <h4>🎵 Vinyl Details</h4>
                <div class="pd-specs-grid">
                    <div class="pd-spec-item">
                        <span class="pd-spec-label">Format:</span>
                        <span class="pd-spec-value">LP</span>
                    </div>
                    <div class="pd-spec-item">
                        <span class="pd-spec-label">Speed:</span>
                        <span class="pd-spec-value">33⅓ RPM</span>
                    </div>
                    <div class="pd-spec-item">
                        <span class="pd-spec-label">Condition:</span>
                        <span class="pd-spec-value">Mint</span>
                    </div>
                    <div class="pd-spec-item">
                        <span class="pd-spec-label">Genre:</span>
                        <span class="pd-spec-value"><?= esc($product['genre'] ?? 'Various') ?></span>
                    </div>
                    <div class="pd-spec-item">
                        <span class="pd-spec-label">Released:</span>
                        <span class="pd-spec-value">2024</span>
                    </div>
                    <div class="pd-spec-item">
                        <span class="pd-spec-label">Label:</span>
                        <span class="pd-spec-value">IBidSiam Records</span>
                    </div>
                </div>
            </div>

            <!-- Quantity & Add to Cart -->
            <div class="pd-purchase">
                <div class="pd-quantity-section">
                    <span class="pd-quantity-label">Quantity:</span>
                    <div class="pd-quantity-controls">
                        <button type="button" class="pd-quantity-btn" onclick="decreaseQuantity()">−</button>
                        <input type="number" id="quantity" class="pd-quantity-input" value="1" min="1" max="10">
                        <button type="button" class="pd-quantity-btn" onclick="increaseQuantity()">+</button>
                    </div>
                </div>
                
                <?php if ($product['status'] == 'out_of_stock' || $product['quantity'] < 1): ?>
                    <button class="pd-add-cart" disabled>Sold Out</button>
                <?php elseif ($product['status'] == 'pre_order'): ?>
                    <button class="pd-add-cart" onclick="addToCart()">Pre-Order Now</button>
                <?php elseif ($product['status'] == 'special_pre_order'): ?>
                    <button class="pd-add-cart" onclick="addToCart()" style="background: linear-gradient(135deg, #ff6b6b, #ff8e53);">Special Pre-Order Price</button>
                <?php elseif ($product['status'] == 'available_order'): ?>
                    <button class="pd-add-cart" onclick="addToCart()">Available For Order</button>
                <?php else: ?>
                    <button class="pd-add-cart" onclick="addToCart()">Add to Cart</button>
                <?php endif; ?>
            </div>

            <!-- Product Description -->
            <div class="pd-description">
                <h3>Description</h3>
                <div class="pd-description-text">
                    <?= esc($product['description'] ?? 'Experience the warm, rich sound of premium vinyl with this exceptional record. Pressed on high-quality vinyl for the ultimate listening experience, this album delivers crystal-clear audio and deep bass that digital formats simply cannot match. Perfect for audiophiles and casual listeners alike.') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Track Listing -->
    <div class="pd-tracks">
        <h3>Track Listing</h3>
        <ul class="pd-track-list">
            <li class="pd-track-item">
                <span class="pd-track-number">1</span>
                <span class="pd-track-name">Cosmic Vibrations</span>
                <span class="pd-track-duration">4:32</span>
            </li>
            <li class="pd-track-item">
                <span class="pd-track-number">2</span>
                <span class="pd-track-name">Void Walker</span>
                <span class="pd-track-duration">5:18</span>
            </li>
            <li class="pd-track-item">
                <span class="pd-track-number">3</span>
                <span class="pd-track-name">Neon Horizon</span>
                <span class="pd-track-duration">3:45</span>
            </li>
            <li class="pd-track-item">
                <span class="pd-track-number">4</span>
                <span class="pd-track-name">Digital Dreams</span>
                <span class="pd-track-duration">6:02</span>
            </li>
            <li class="pd-track-item">
                <span class="pd-track-number">5</span>
                <span class="pd-track-name">Analog Soul</span>
                <span class="pd-track-duration">4:15</span>
            </li>
        </ul>
    </div>

    <!-- Additional Information -->
    <div class="pd-details">
        <div class="pd-detail-card">
            <h4>📦 Shipping Information</h4>
            <div class="pd-detail-content">
                Free shipping on orders over ฿1,500. All records are shipped in protective packaging with cardboard stiffeners to ensure safe delivery. International shipping available.
            </div>
        </div>
        <div class="pd-detail-card">
            <h4>🔄 Return Policy</h4>
            <div class="pd-detail-content">
                30-day return policy for unopened records. If you receive a damaged or defective item, please contact us within 7 days for a replacement or refund.
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if (!empty($related)): ?>
    <div class="pd-related">
        <h2>You Might Also Like</h2>
        <div class="pd-related-grid">
            <?php foreach ($related as $relatedProduct): ?>
            <div class="pd-related-card">
                <a href="<?= site_url('shop/product/' . $relatedProduct['id']) ?>" class="product-link">
                    <div class="pd-related-image">
                        <img src="<?= esc($relatedProduct['image']) ?>" alt="<?= esc($relatedProduct['name']) ?>">
                    </div>
                </a>
                <div class="pd-related-info">
                    <a href="<?= site_url('shop/product/' . $relatedProduct['id']) ?>" class="product-link">
                        <h3 class="pd-related-name"><?= esc($relatedProduct['name']) ?></h3>
                    </a>
                    <div class="pd-related-price">฿<?= number_format($relatedProduct['price'], 2) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// Image gallery functionality
function changeImage(imageSrc, thumbnail) {
    document.getElementById('mainImage').src = imageSrc;
    
    // Update active thumbnail
    document.querySelectorAll('.pd-gallery-thumb').forEach(thumb => {
        thumb.classList.remove('active');
    });
    thumbnail.classList.add('active');
}

// Quantity controls
function increaseQuantity() {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value);
    if (currentValue < 10) {
        input.value = currentValue + 1;
    }
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
    }
}

// Add to cart functionality
function addToCart() {
    const button = document.querySelector('.pd-add-cart');
    const originalText = button.textContent;
    
    button.disabled = true;
    button.textContent = 'Adding...';
    
    const productId = <?= $product['id'] ?>;
    const quantity = document.getElementById('quantity').value;
    
    fetch('<?= site_url('cart/add') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `id=${productId}&qty=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            button.textContent = '✓ Added to Cart';
            button.style.background = 'linear-gradient(135deg, #27ae60, #229954)';
            
            // Update cart badge if it exists
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                cartBadge.textContent = data.total_items;
            }
            
            // Update mini-cart if it exists
            const miniCart = document.querySelector('.mini-cart');
            if (miniCart) {
                fetch('<?= site_url('cart/load') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Update mini-cart HTML
                        miniCart.innerHTML = data.html;
                    }
                });
            }
            
            setTimeout(() => {
                button.disabled = false;
                button.textContent = originalText;
                button.style.background = '';
            }, 2000);
        } else {
            button.disabled = false;
            button.textContent = originalText;
            alert(data.message || 'Error adding to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        button.textContent = originalText;
        alert('Error adding to cart');
    });
}

// Input validation for quantity
document.getElementById('quantity').addEventListener('input', function() {
    let value = parseInt(this.value);
    if (isNaN(value) || value < 1) {
        this.value = 1;
    } else if (value > 10) {
        this.value = 10;
    }
});
</script>

<?= $this->endSection() ?>
