<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .product-detail-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    /* Top Section: Image & Info */
    .product-top-section {
        display: flex;
        gap: 50px;
        margin-bottom: 60px;
    }
    .product-image-col {
        flex: 1;
        max-width: 500px;
    }
    .product-info-col {
        flex: 1;
    }

    .main-product-image {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
        border: 1px solid #333;
    }

    .product-title-large {
        font-size: 2.5rem;
        margin: 0 0 10px 0;
        color: #fff;
        line-height: 1.2;
    }
    .product-artist-large {
        font-size: 1.2rem;
        color: var(--accent-cyan);
        margin-bottom: 20px;
        font-weight: bold;
    }
    
    .product-meta {
        margin-bottom: 30px;
        border-bottom: 1px solid #333;
        padding-bottom: 20px;
    }
    .product-price-large {
        font-size: 2rem;
        color: #fff;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 4px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .in-stock { background: rgba(0, 255, 157, 0.1); color: #00ff9d; border: 1px solid #00ff9d; }
    .out-stock { background: rgba(255, 68, 68, 0.1); color: #ff4444; border: 1px solid #ff4444; }
    .pre-order { background: rgba(255, 170, 0, 0.1); color: #ffaa00; border: 1px solid #ffaa00; }

    .add-to-cart-box {
        background: #111;
        padding: 20px;
        border: 1px solid #333;
        border-radius: 8px;
    }
    .qty-input {
        background: #222;
        border: 1px solid #444;
        color: #fff;
        padding: 10px;
        width: 60px;
        text-align: center;
        font-size: 1rem;
        margin-right: 15px;
    }
    
    /* Tabs / Description */
    .product-description-section {
        margin-bottom: 60px;
    }
    .section-title {
        font-size: 1.5rem;
        border-bottom: 2px solid var(--accent-purple);
        padding-bottom: 10px;
        margin-bottom: 20px;
        color: #fff;
        display: inline-block;
    }
    .description-content {
        line-height: 1.6;
        color: #ccc;
        font-size: 1.1rem;
    }

    /* Related Products */
    .related-section {
        margin-top: 80px;
    }
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    @media (max-width: 768px) {
        .product-top-section { flex-direction: column; gap: 30px; }
        .product-image-col { max-width: 100%; }
    }
</style>

<div class="product-detail-container">
    <div class="product-top-section">
        <!-- Left: Image -->
        <div class="product-image-col">
            <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>" class="main-product-image">
        </div>

        <!-- Right: Info -->
        <div class="product-info-col">
            <h1 class="product-title-large"><?= esc($product['name']) ?></h1>
            <div class="product-artist-large"><?= esc($product['description']) ?></div> <!-- Using description as artist/subtitle -->
            
            <div class="product-meta">
                <div class="product-price-large">฿<?= number_format($product['price'], 2) ?></div>
                
                <?php if($product['status'] == 'out_of_stock' || $product['quantity'] < 1): ?>
                    <span class="status-badge out-stock">Out of Stock</span>
                <?php elseif($product['status'] == 'pre_order'): ?>
                    <span class="status-badge pre-order">Pre-Order</span>
                <?php else: ?>
                    <span class="status-badge in-stock">In Stock</span>
                <?php endif; ?>
                
                <div style="margin-top: 10px; color: #888;">
                    SKU: VINYL-<?= $product['id'] ?>
                </div>
            </div>

            <div class="add-to-cart-box">
                <?php if($product['status'] == 'out_of_stock' || $product['quantity'] < 1): ?>
                    <button class="btn" style="width: 100%; background: #333; border-color: #555; cursor: not-allowed;">SOLD OUT</button>
                <?php else: ?>
                    <div style="display: flex; align-items: center;">
                        <!-- Quantity logic not fully implemented in cart.js yet, defaulting to 1 add -->
                        <!-- <input type="number" value="1" min="1" class="qty-input"> -->
                        <a href="#" class="btn btn-add-cart" data-id="<?= $product['id'] ?>" style="flex: 1; text-align: center; background: var(--accent-cyan); color: #000; border-color: var(--accent-cyan);">ADD TO CART</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 20px; font-size: 0.9rem; color: #aaa;">
                <p>✓ Fast Shipping</p>
                <p>✓ Secure Packaging</p>
                <p>✓ 100% Authentic</p>
            </div>
        </div>
    </div>

    <!-- Description / Tracklist -->
    <div class="product-description-section">
        <h2 class="section-title">Product Details</h2>
        <div class="description-content">
            <p><strong>Artist/Album:</strong> <?= esc($product['name']) ?></p>
            <p><strong>Genre:</strong> <?= esc($product['genre'] ?? 'N/A') ?></p>
            <p><strong>Description:</strong></p>
            <p><?= nl2br(esc($product['description'])) ?></p>
            
            <!-- Placeholder for Tracklist -->
            <br>
            <h3 style="color: #fff;">Tracklist</h3>
            <ol style="margin-left: 20px; color: #ccc;">
                <li>Side A - Track 1</li>
                <li>Side A - Track 2</li>
                <li>Side B - Track 1</li>
                <li>Side B - Track 2</li>
            </ol>
        </div>
    </div>

    <!-- Related Products -->
    <div class="related-section">
        <h2 class="section-title">Recommended For You</h2>
        <div class="related-grid">
            <?php foreach($related as $rel): ?>
                <div class="product-card">
                    <a href="<?= site_url('shop/product/' . $rel['id']) ?>" style="text-decoration: none; color: inherit;">
                        <img src="<?= esc($rel['image']) ?>" alt="<?= esc($rel['name']) ?>" class="vinyl-cover">
                        <h3 class="product-title" style="font-size: 0.9rem;"><?= esc($rel['name']) ?></h3>
                        <div class="product-price" style="font-size: 1rem;">฿<?= number_format($rel['price'], 2) ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Mini Cart Drawer (Reused) -->
<!-- ... We rely on the layout or duplicated helper ... -->
<!-- The layout main.php doesn't include the drawer, index.php did. 
     We should probably move the drawer to main.php or include it here. 
     For now, to ensure it works, I will verify if main.php has it. 
     Use task context: main.php has the toggle but not the drawer HTML. 
     I should add the drawer HTML here or in main.php. 
     Let's add it here to be safe and self-contained like index.php 
-->
<div id="cart-drawer" style="position: fixed; top: 0; right: -350px; width: 350px; height: 100%; background: #111; border-left: 1px solid #333; transition: 0.3s; z-index: 1000; padding: 20px; box-sizing: border-box; box-shadow: -5px 0 15px rgba(0,0,0,0.5); display: flex; flex-direction: column;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 15px;">
        <h2 style="margin: 0; color: #fff;">Cart</h2>
        <button id="cart-close" style="background: none; border: none; color: #fff; font-size: 1.5rem; cursor: pointer;">&times;</button>
    </div>
    <div id="mini-cart-content" style="display: flex; flex-direction: column; height: 100%;">
        <div id="cart-items-list" style="flex: 1; overflow-y: auto; padding-bottom: 20px;"></div>
        
        <form action="<?= site_url('shop/place-order') ?>" method="post" id="checkout-form" style="border-top: 1px solid #333; padding-top: 15px; background: #111;">
             <div style="margin-bottom: 15px;">
                 <h4 style="color: #fff; margin-bottom: 10px;">Payment Method</h4>
                 <?php if(!empty($payment_methods)): ?>
                    <?php foreach($payment_methods as $method): ?>
                        <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #ccc;">
                            <input type="radio" name="payment_method" value="<?= esc($method['method_name']) ?>" required> 
                            <?= esc($method['method_name']) ?>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
             </div>
             <div style="text-align: center;">
                 <h3 style="color: var(--accent-cyan); margin-bottom: 15px;">Total: <span id="cart-total-display"><?= number_format(array_sum(array_map(function($i){ return $i['price']*$i['quantity']; }, $cart)), 2) ?></span> ฿</h3>
                 <button type="submit" class="btn" style="width: 100%; background: var(--accent-cyan); color: #000; border: none; font-weight: bold;">CONFIRM ORDER</button>
             </div>
        </form>
    </div>
</div>

<script>
    const api_urls = {
        add: '<?= site_url('cart/add') ?>',
        remove: '<?= site_url('cart/remove') ?>',
        update: '<?= site_url('cart/update') ?>'
    };
    const csrf_token = '<?= csrf_token() ?>';
    const csrf_hash = '<?= csrf_hash() ?>';

    const globalCartToggle = document.getElementById('cart-toggle-global');
    if(globalCartToggle) {
        globalCartToggle.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('cart-drawer').classList.add('open');
        });
    }
    
    document.getElementById('cart-close').addEventListener('click', () => {
        document.getElementById('cart-drawer').classList.remove('open');
    });
</script>
<script src="<?= base_url('js/cart.js') ?>?v=<?= time() ?>"></script>

<?= $this->endSection() ?>
