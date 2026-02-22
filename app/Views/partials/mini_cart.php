<style>
.mini-cart {
    width: 320px;
    max-height: 400px;
    overflow-y: auto;
}

.mini-cart-empty {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-muted);
}

.mini-cart-empty-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    opacity: 0.4;
}

.mini-cart-empty-text {
    font-size: 0.95rem;
    margin-bottom: 15px;
    font-weight: 500;
}

.mini-cart-empty-link {
    color: var(--accent-gold);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: color 0.3s ease;
}

.mini-cart-empty-link:hover {
    color: var(--accent-dark);
}

.mini-cart-items {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mini-cart-item {
    display: flex;
    gap: 12px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-light);
    align-items: center;
    transition: background-color 0.3s ease;
    border-radius: 8px;
    padding: 10px;
}

.mini-cart-item:hover {
    background: rgba(212, 175, 55, 0.02);
}

.mini-cart-item-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
    border: 1px solid var(--border-light);
}

.mini-cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mini-cart-item-placeholder {
    width: 60px;
    height: 60px;
    background: var(--sidebar-bg);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 0.7rem;
    font-weight: 600;
    border: 1px solid var(--border-light);
}

.mini-cart-item-details {
    flex: 1;
    min-width: 0;
}

.mini-cart-item-name {
    color: var(--text-color);
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.2;
}

.mini-cart-item-price {
    color: var(--accent-gold);
    font-size: 0.85rem;
    font-weight: 700;
}

.mini-cart-item-remove {
    background: none;
    border: none;
    color: var(--danger-color);
    cursor: pointer;
    font-size: 1.1rem;
    padding: 5px;
    border-radius: 4px;
    transition: all 0.3s ease;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.mini-cart-item-remove:hover {
    background: rgba(231, 76, 60, 0.1);
    transform: scale(1.1);
}

.mini-cart-footer {
    padding: 15px 0;
    border-top: 2px solid var(--border-light);
    margin-top: 10px;
}

.mini-cart-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 1rem;
}

.mini-cart-total-label {
    font-weight: 600;
    color: var(--text-color);
}

.mini-cart-total-amount {
    font-weight: 800;
    color: var(--accent-gold);
    font-size: 1.1rem;
}

.mini-cart-actions {
    display: flex;
    gap: 10px;
}

.mini-cart-btn {
    flex: 1;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mini-cart-btn-view {
    background: var(--accent-gold);
    color: var(--accent-dark);
}

.mini-cart-btn-view:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
}

.mini-cart-btn-checkout {
    background: var(--accent-dark);
    color: var(--accent-gold);
}

.mini-cart-btn-checkout:hover {
    background: var(--accent-gold);
    color: var(--accent-dark);
}
</style>

<div class="mini-cart">
<?php if (empty($cart)): ?>
    <div class="mini-cart-empty">
        <div class="mini-cart-empty-icon">🛒</div>
        <div class="mini-cart-empty-text">Your cart is empty</div>
        <a href="<?= site_url('shop') ?>" class="mini-cart-empty-link">Browse Vinyl Records →</a>
    </div>
<?php else: ?>
    <ul class="mini-cart-items">
        <?php foreach ($cart as $item): ?>
            <li class="mini-cart-item">
                <?php if (!empty($item['image'])): ?>
                    <div class="mini-cart-item-image">
                        <img src="<?= esc($item['image']) ?>" alt="<?= esc($item['name']) ?>">
                    </div>
                <?php else: ?>
                    <div class="mini-cart-item-placeholder">VINYL</div>
                <?php endif; ?>
                
                <div class="mini-cart-item-details">
                    <div class="mini-cart-item-name"><?= esc($item['name']) ?></div>
                    <div class="mini-cart-item-price">
                        <?= $item['quantity'] ?> × ฿<?= number_format($item['price'], 2) ?>
                    </div>
                </div>
                
                <button class="mini-cart-item-remove" onclick="cart.remove(<?= $item['id'] ?>)" title="Remove item">
                    ×
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <?php 
    // Calculate totals
    $totalItems = 0;
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalItems += $item['quantity'];
        $totalPrice += $item['price'] * $item['quantity'];
    }
    ?>
    
    <div class="mini-cart-footer">
        <div class="mini-cart-total">
            <span class="mini-cart-total-label">Total (<?= $totalItems ?> items)</span>
            <span class="mini-cart-total-amount">฿<?= number_format($totalPrice, 2) ?></span>
        </div>
        
        <div class="mini-cart-actions">
            <a href="<?= site_url('shop/cart') ?>" class="mini-cart-btn mini-cart-btn-view">View Cart</a>
            <a href="<?= site_url('shop/checkout') ?>" class="mini-cart-btn mini-cart-btn-checkout">Checkout</a>
        </div>
    </div>
<?php endif; ?>
</div>
