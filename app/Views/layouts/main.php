<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBidSiam Vinyl Shop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@400;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <header class="main-nav">
        <div class="nav-container">
            <!-- Logo -->
            <a href="<?= site_url('shop') ?>" class="nav-logo">
                <div class="ibidsiam-logo">
                    <span class="logo-i">i</span><span class="logo-b">B</span><span class="logo-i2">i</span><span class="logo-d">d</span><span class="logo-s">S</span><span class="logo-i3">i</span><span class="logo-a">a</span><span class="logo-m">m</span>
                </div>
                <span style="font-size: 0.7rem; letter-spacing: 2px; color: #8B5CF6; display: block; margin-top: -5px; text-transform: uppercase; font-weight: 600;">VINYL SHOP</span>
            </a>

            <!-- Navigation Links -->
            <div class="nav-links">
                <a href="<?= site_url('shop') ?>" class="nav-link">Home</a>
                <a href="<?= site_url('shop') ?>" class="nav-link">Shop</a>
                <a href="<?= site_url('about') ?>" class="nav-link">About</a>
                <a href="<?= site_url('contact') ?>" class="nav-link">Contact</a>
                <a href="<?= site_url('faq') ?>" class="nav-link">FAQ</a>
            </div>

            <!-- Search Bar (Center) -->
            <div class="nav-search">
                <form action="<?= site_url('shop') ?>" method="get" style="display: flex; width: 100%;">
                    <input type="text" name="q" placeholder="Search for vinyl, artists..." value="<?= esc($search_query ?? '') ?>">
                    <button type="submit">🔍</button>
                </form>
            </div>

            <!-- Icons/Actions (Right) -->
            <div class="nav-actions">
                <?php if(session()->get('is_admin')): ?>
                    <a href="<?= site_url('admin/products') ?>" class="nav-icon-link" title="Admin">
                        ⚙️ Admin
                    </a>
                <?php endif; ?>

                <?php if(session()->get('is_user_logged_in')): ?>
                    <a href="<?= site_url('user') ?>" class="nav-icon-link" title="Account">
                        👤 <?= esc(session()->get('user_name')) ?>
                    </a>
                    <a href="<?= site_url('logout') ?>" class="nav-icon-link" title="Logout">
                        🚪
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" class="nav-icon-link">Login</a>
                <?php endif; ?>

                <a href="#" id="cart-toggle-global" class="nav-icon-link" style="position: relative;">
                    🛒
                    <?php $cartCount = array_sum(array_column(session('cart')??[], 'quantity')); ?>
                    <span id="cart-count" class="cart-badge" style="<?= $cartCount > 0 ? '' : 'display:none;' ?>"><?= $cartCount ?></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Mini Cart Drawer -->
    <div id="cart-drawer" style="position: fixed; top: 0; right: -400px; width: 400px; height: 100%; background: #ffffff; border-left: 1px solid #ddd; transition: right 0.3s ease; z-index: 1000; padding: 20px; box-sizing: border-box; box-shadow: -5px 0 15px rgba(0,0,0,0.1); display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">
            <h2 style="margin: 0; color: #333;">Your Cart</h2>
            <button id="cart-close" style="background: none; border: none; color: #333; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div id="mini-cart-content" style="display: flex; flex-direction: column; height: 100%;">
            <div id="cart-items-list" style="flex: 1; overflow-y: auto; padding-bottom: 20px;"></div>
            
            <div style="border-top: 1px solid #eee; padding-top: 15px; background: #fff;">
                 <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                     <span style="color: #333; font-weight: 600; font-size: 1rem;">Total</span>
                     <span style="color: #b12704; font-weight: bold; font-size: 1.2rem;">฿<span id="cart-total-display">0.00</span></span>
                 </div>
                 <a href="<?= site_url('shop/checkout') ?>" id="checkout-btn" style="display: block; width: 100%; background: #007bff; color: #fff; border: none; font-weight: bold; padding: 14px; border-radius: 6px; cursor: pointer; text-align: center; text-decoration: none; font-size: 1rem; box-sizing: border-box;">CHECKOUT →</a>
                 <a href="<?= site_url('shop') ?>" style="display: block; text-align: center; margin-top: 10px; color: #999; font-size: 0.85rem; text-decoration: none;">Continue Shopping</a>
            </div>
        </div>
    </div>

    <!-- Cart Scripts -->
    <script>
        const api_urls = {
            add: '<?= site_url('cart/add') ?>',
            remove: '<?= site_url('cart/remove') ?>',
            update: '<?= site_url('cart/update') ?>'
        };
        const csrf_token = '<?= csrf_token() ?>';
        const csrf_hash = '<?= csrf_hash() ?>';

        // Cart drawer toggle
        const globalCartToggle = document.getElementById('cart-toggle-global');
        if(globalCartToggle) {
            globalCartToggle.addEventListener('click', (e) => {
                e.preventDefault();
                cart.openDrawer();
            });
        }
        
        const cartCloseBtn = document.getElementById('cart-close');
        if(cartCloseBtn) {
            cartCloseBtn.addEventListener('click', () => {
                cart.closeDrawer();
            });
        }
    </script>
    <script src="<?= base_url('js/cart.js') ?>?v=<?= time() ?>"></script>

    <?= $this->renderSection('content') ?>

    <!-- ===== SITE FOOTER ===== -->
    <footer>
        <!-- Main Footer -->
        <div class="footer-main">
            
            <!-- Column 1: Brand -->
            <div class="footer-brand">
                <h3>IBidSiam</h3>
                <span class="tagline">VINYL SHOP</span>
                <p>
                    Your destination for premium vinyl records. We curate the finest pressings from around the world, delivering exceptional sound quality to collectors and enthusiasts.
                </p>
                <!-- Social Icons -->
                <div class="footer-social">
                    <a href="#" title="Facebook">f</a>
                    <a href="#" title="Twitter">𝕏</a>
                    <a href="#" title="Instagram">ig</a>
                    <a href="#" title="YouTube">▶</a>
                </div>
            </div>

            <!-- Column 2: Shop -->
            <div class="footer-column">
                <h4>Shop</h4>
                <ul>
                    <li><a href="<?= site_url('shop') ?>">All Products</a></li>
                    <li><a href="<?= site_url('shop?genre=Rock') ?>">Rock</a></li>
                    <li><a href="<?= site_url('shop?genre=Jazz') ?>">Jazz</a></li>
                    <li><a href="<?= site_url('shop?genre=Electronic') ?>">Electronic</a></li>
                    <li><a href="<?= site_url('shop?genre=Synthwave') ?>">Synthwave</a></li>
                    <li><a href="<?= site_url('shop?genre=Classical') ?>">Classical</a></li>
                </ul>
            </div>

            <!-- Column 3: Customer Service -->
            <div class="footer-column">
                <h4>Customer Service</h4>
                <ul>
                    <li><a href="<?= site_url('contact') ?>">Contact Us</a></li>
                    <li><a href="<?= site_url('shipping') ?>">Shipping & Returns</a></li>
                    <li><a href="<?= site_url('faq') ?>">FAQ</a></li>
                    <li><a href="<?= site_url('privacy') ?>">Privacy Policy</a></li>
                    <li><a href="<?= site_url('terms') ?>">Terms of Service</a></li>
                    <li><a href="<?= site_url('login') ?>">My Account</a></li>
                </ul>
            </div>

            <!-- Column 4: Newsletter -->
            <div class="footer-column">
                <h4>Stay in the Groove</h4>
                <p>
                    Subscribe to get exclusive deals, new arrivals, and curated playlists delivered to your inbox.
                </p>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" id="newsletterEmail" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
                <div id="newsletterMessage" style="margin-top: 10px; font-size: 0.85rem; font-weight: 600;"></div>
                <div class="footer-features">
                    <span>💳 Secure Payments</span>
                    <span>📦 Worldwide Shipping</span>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <p class="footer-copyright">&copy; <?= date('Y') ?> IBidSiam Vinyl Shop. All rights reserved.</p>
            <div class="footer-payments">
                <span>🔒 SSL Secured</span>
                <span>Visa / Mastercard / PromptPay</span>
            </div>
        </div>
    </footer>

    <!-- Search JavaScript -->
    <script src="<?= base_url('js/search.js') ?>"></script>

    <!-- Newsletter JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterEmail = document.getElementById('newsletterEmail');
        const newsletterMessage = document.getElementById('newsletterMessage');
        
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = newsletterEmail.value.trim();
                
                if (!email) {
                    showNewsletterMessage('Please enter your email address', 'error');
                    return;
                }
                
                // Show loading state
                const submitBtn = newsletterForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Subscribing...';
                
                // Submit to server
                fetch('<?= site_url('newsletter/subscribe') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `email=${encodeURIComponent(email)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNewsletterMessage(data.message, 'success');
                        newsletterEmail.value = '';
                    } else {
                        showNewsletterMessage(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Newsletter error:', error);
                    showNewsletterMessage('An error occurred. Please try again.', 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
            });
        }
        
        function showNewsletterMessage(message, type) {
            newsletterMessage.textContent = message;
            newsletterMessage.style.color = type === 'success' ? '#27ae60' : '#e74c3c';
            newsletterMessage.style.display = 'block';
            
            // Hide message after 5 seconds
            setTimeout(() => {
                newsletterMessage.style.display = 'none';
            }, 5000);
        }
    });
    </script>

</body>
</html>
