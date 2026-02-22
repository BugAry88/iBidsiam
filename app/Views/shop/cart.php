<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* Cart Page Styles */
.cart-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    min-height: calc(100vh - 200px);
}

.cart-header {
    text-align: center;
    margin-bottom: 50px;
}

.cart-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 10px;
    font-family: var(--font-secondary);
    text-transform: uppercase;
    letter-spacing: 2px;
}

.cart-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
    font-weight: 500;
}

.cart-container {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 40px;
    align-items: start;
}

/* Cart Items */
.cart-items {
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.cart-item {
    display: grid;
    grid-template-columns: 120px 1fr auto;
    gap: 25px;
    padding: 25px;
    border-bottom: 1px solid var(--border-light);
    align-items: center;
    transition: background-color 0.3s ease;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item:hover {
    background: rgba(212, 175, 55, 0.02);
}

.cart-item-image {
    width: 120px;
    height: 120px;
    border-radius: 12px;
    overflow: hidden;
    background: var(--sidebar-bg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.cart-item:hover .cart-item-image img {
    transform: scale(1.05);
}

.cart-item-details {
    flex: 1;
}

.cart-item-name {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
    line-height: 1.3;
}

.cart-item-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 15px;
    line-height: 1.4;
}

.cart-item-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent-gold);
    margin-bottom: 15px;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 12px;
}

.quantity-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 2px solid var(--border-light);
    border-radius: 50px;
    overflow: hidden;
    background: var(--card-bg);
}

.quantity-btn {
    width: 36px;
    height: 36px;
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

.quantity-btn:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
}

.quantity-input {
    width: 60px;
    height: 36px;
    border: none;
    text-align: center;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-color);
    background: transparent;
}

.cart-item-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 15px;
}

.cart-item-total {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--accent-dark);
    text-align: right;
}

.remove-item {
    background: none;
    border: none;
    color: var(--danger-color);
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: underline;
    padding: 5px 0;
}

.remove-item:hover {
    color: #c0392b;
    transform: translateY(-1px);
}

/* Cart Summary */
.cart-summary {
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    padding: 30px;
    border: 1px solid var(--border-light);
    position: sticky;
    top: 100px;
}

.summary-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--accent-gold);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 1rem;
}

.summary-row.subtotal {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-light);
}

.summary-label {
    color: var(--text-secondary);
    font-weight: 500;
}

.summary-value {
    color: var(--text-color);
    font-weight: 600;
}

.summary-row.total {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid var(--border-light);
}

.summary-row.total .summary-label {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--accent-dark);
}

.summary-row.total .summary-value {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--accent-gold);
}

.checkout-btn {
    width: 100%;
    padding: 18px 24px;
    background: linear-gradient(135deg, var(--accent-gold), #b8941f);
    border: none;
    color: var(--accent-dark);
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    border-radius: 50px;
    margin-top: 25px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: var(--shadow-md);
    font-family: var(--font-secondary);
}

.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    background: linear-gradient(135deg, #e6c547, var(--accent-gold));
}

.continue-shopping {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.continue-shopping:hover {
    color: var(--accent-gold);
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 80px 40px;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.empty-cart-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.3;
}

.empty-cart-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 15px;
}

.empty-cart-text {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.5;
}

.empty-cart-btn {
    display: inline-block;
    padding: 15px 30px;
    background: var(--accent-gold);
    color: var(--accent-dark);
    text-decoration: none;
    font-weight: 700;
    border-radius: 50px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.empty-cart-btn:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .cart-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .cart-summary {
        position: static;
        order: -1;
    }
}

@media (max-width: 768px) {
    .cart-page {
        padding: 20px 15px 40px;
    }
    
    .cart-title {
        font-size: 2rem;
    }
    
    .cart-item {
        grid-template-columns: 80px 1fr;
        gap: 15px;
        padding: 20px 15px;
    }
    
    .cart-item-image {
        width: 80px;
        height: 80px;
        grid-row: span 2;
    }
    
    .cart-item-actions {
        grid-column: span 2;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    
    .cart-item-quantity {
        order: -1;
    }
}

/* Loading State */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cart-item {
    animation: slideIn 0.3s ease;
}
</style>

<div class="cart-page">
    <!-- Header -->
    <div class="cart-header">
        <h1 class="cart-title">Shopping Cart</h1>
        <p class="cart-subtitle">Review your items before checkout</p>
    </div>

    <?php if (!empty($cart)): ?>
        <div class="cart-container">
            <!-- Cart Items -->
            <div class="cart-items">
                <?php foreach ($cart as $item): ?>
                    <div class="cart-item" data-id="<?= $item['id'] ?>">
                        <!-- Product Image -->
                        <div class="cart-item-image">
                            <img src="<?= esc($item['image']) ?>" alt="<?= esc($item['name']) ?>">
                        </div>

                        <!-- Product Details -->
                        <div class="cart-item-details">
                            <h3 class="cart-item-name"><?= esc($item['name']) ?></h3>
                            <p class="cart-item-description"><?= esc($item['description'] ?? 'Premium vinyl record') ?></p>
                            <div class="cart-item-price">฿<?= number_format($item['price'], 2) ?></div>
                            
                            <!-- Quantity Controls -->
                            <div class="cart-item-quantity">
                                <span class="quantity-label">Quantity:</span>
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn decrease" data-id="<?= $item['id'] ?>">−</button>
                                    <input type="number" class="quantity-input" value="<?= $item['quantity'] ?>" min="1" max="99" data-id="<?= $item['id'] ?>">
                                    <button type="button" class="quantity-btn increase" data-id="<?= $item['id'] ?>">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="cart-item-actions">
                            <div class="cart-item-total">฿<?= number_format($item['price'] * $item['quantity'], 2) ?></div>
                            <button type="button" class="remove-item" data-id="<?= $item['id'] ?>">Remove</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                
                <div class="summary-row subtotal">
                    <span class="summary-label">Subtotal (<?= $totalItems ?> items)</span>
                    <span class="summary-value">฿<?= number_format($subtotal, 2) ?></span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Shipping</span>
                    <span class="summary-value">฿<?= number_format($shipping, 2) ?></span>
                </div>
                
                <div class="summary-row total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value">฿<?= number_format($total, 2) ?></span>
                </div>
                
                <a href="<?= site_url('shop/checkout') ?>" class="checkout-btn">Proceed to Checkout</a>
                <a href="<?= site_url('shop') ?>" class="continue-shopping">← Continue Shopping</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty Cart -->
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h2 class="empty-cart-title">Your cart is empty</h2>
            <p class="empty-cart-text">
                Looks like you haven't added any vinyl records to your cart yet.<br>
                Browse our collection and find your favorite albums!
            </p>
            <a href="<?= site_url('shop') ?>" class="empty-cart-btn">Start Shopping</a>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity increase/decrease functionality
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
            let quantity = parseInt(input.value);
            
            if (this.classList.contains('increase')) {
                quantity = Math.min(quantity + 1, 99);
            } else {
                quantity = Math.max(quantity - 1, 1);
            }
            
            updateQuantity(id, quantity);
        });
    });
    
    // Quantity input change
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.dataset.id;
            let quantity = parseInt(this.value);
            quantity = Math.max(Math.min(quantity, 99), 1);
            this.value = quantity;
            updateQuantity(id, quantity);
        });
    });
    
    // Remove item functionality
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                removeItem(id);
            }
        });
    });
    
    function updateQuantity(id, quantity) {
        const cartItem = document.querySelector(`.cart-item[data-id="${id}"]`);
        cartItem.classList.add('loading');
        
        fetch('<?= site_url('cart/update') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `id=${id}&qty=${quantity}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload(); // Reload to update totals
            } else {
                alert('Error updating quantity');
                cartItem.classList.remove('loading');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            cartItem.classList.remove('loading');
        });
    }
    
    function removeItem(id) {
        const cartItem = document.querySelector(`.cart-item[data-id="${id}"]`);
        cartItem.classList.add('loading');
        
        fetch('<?= site_url('cart/remove') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                cartItem.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => location.reload(), 300);
            } else {
                alert('Error removing item');
                cartItem.classList.remove('loading');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            cartItem.classList.remove('loading');
        });
    }
});

// Add slide out animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideOut {
        to {
            opacity: 0;
            transform: translateX(-20px);
        }
    }
`;
document.head.appendChild(style);
</script>

<?= $this->endSection() ?>
