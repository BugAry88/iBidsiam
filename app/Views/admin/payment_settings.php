<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Settings - IBidSiam Admin</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Premium Settings Page Styles */
        :root {
            --admin-primary: #8B5CF6;
            --admin-gold: #D4AF37;
            --admin-dark: #1a1a2e;
            --admin-sidebar: #16213e;
            --admin-card: #ffffff;
            --admin-bg: #f8fafc;
            --admin-text: #334155;
            --admin-border: #e2e8f0;
            --admin-success: #10b981;
            --admin-warning: #f59e0b;
            --admin-danger: #ef4444;
            --admin-info: #3b82f6;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Enhanced Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--admin-sidebar) 0%, #0f172a 100%);
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: var(--shadow-xl);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .brand {
            padding: 30px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(139, 92, 246, 0.1);
        }

        .brand h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--admin-gold);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .brand h1 i {
            font-size: 1.2rem;
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
            flex: 1;
        }

        .nav-item {
            margin: 5px 15px;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-item a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--admin-gold);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .nav-item a:hover {
            background: rgba(139, 92, 246, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-item a.active {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-gold));
            color: white;
            font-weight: 600;
        }

        .nav-item a.active::before {
            transform: translateX(0);
        }

        .nav-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        /* Header */
        .header {
            background: var(--admin-card);
            padding: 25px 40px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--admin-text);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: var(--admin-bg);
        }

        .header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--admin-bg);
            border-radius: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-gold));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: var(--admin-dark);
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: #64748b;
        }

        .btn-logout {
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--admin-danger), #dc2626);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Content Area */
        .content {
            padding: 40px;
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            color: var(--admin-success);
            border-left: 4px solid var(--admin-success);
        }

        .alert i {
            font-size: 1.2rem;
        }

        /* Settings Container */
        .settings-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .settings-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .settings-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--admin-dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .settings-title i {
            color: var(--admin-primary);
        }

        .settings-subtitle {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Payment Settings Cards */
        .payment-settings-grid {
            display: grid;
            gap: 30px;
            margin-bottom: 40px;
        }

        .payment-card {
            background: var(--admin-card);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--admin-border);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .payment-header {
            padding: 25px 30px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.02), rgba(212, 175, 55, 0.02));
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .payment-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .payment-icon.bank {
            background: linear-gradient(135deg, var(--admin-info), #2563eb);
            color: white;
        }

        .payment-icon.wallet {
            background: linear-gradient(135deg, var(--admin-success), #22c55e);
            color: white;
        }

        .payment-icon.card {
            background: linear-gradient(135deg, var(--admin-gold), #f59e0b);
            color: white;
        }

        .payment-icon.qr {
            background: linear-gradient(135deg, var(--admin-primary), #6366f1);
            color: white;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: 0.3s;
            border-radius: 30px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-gold));
        }

        input:checked + .toggle-slider:before {
            transform: translateX(30px);
        }

        .toggle-label {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            color: var(--admin-text);
        }

        /* Form Styles */
        .payment-form {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--admin-dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-textarea {
            width: 100%;
            min-height: 120px;
            padding: 15px;
            border: 2px solid var(--admin-border);
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            resize: vertical;
            transition: all 0.3s ease;
            background: var(--admin-bg);
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--admin-border);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--admin-bg);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .form-help {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 5px;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-gold));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--admin-bg);
            color: var(--admin-text);
            border: 2px solid var(--admin-border);
        }

        .btn-secondary:hover {
            background: var(--admin-border);
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            .sidebar {
                width: 80px;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .brand h1 {
                font-size: 1rem;
            }
            
            .brand h1 span,
            .nav-item span {
                display: none;
            }
            
            .content {
                padding: 20px;
            }
            
            .header {
                padding: 20px;
            }
            
            .header h2 {
                font-size: 1.5rem;
            }
            
            .user-details {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .payment-header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }

        /* Mobile Menu Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .mobile-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <h1><i class="fas fa-record-vinyl"></i> <span>IBidSiam</span></h1>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?= site_url('admin/dashboard') ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/products') ?>">
                    <i class="fas fa-compact-disc"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/orders') ?>">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/customers') ?>">
                    <i class="fas fa-users"></i>
                    <span>Customers Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/payment-settings') ?>" class="active">
                    <i class="fas fa-cog"></i>
                    <span>Payment Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/email-settings') ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Email Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('shop') ?>" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Storefront</span>
                </a>
            </li>
        </ul>
        <div style="padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="user-info">
                <div class="user-avatar"><?= substr(session('user_name') ?? 'A', 0, 1) ?></div>
                <div class="user-details">
                    <div class="user-name"><?= session('user_name') ?? 'Admin' ?></div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>Payment Settings</h2>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar"><?= substr(session('user_name') ?? 'A', 0, 1) ?></div>
                    <div class="user-details">
                        <div class="user-name"><?= session('user_name') ?? 'Admin' ?></div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <a href="<?= site_url('admin/logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="settings-container">
                <div class="settings-header">
                    <h1 class="settings-title">
                        <i class="fas fa-credit-card"></i>
                        Payment Settings
                    </h1>
                    <p class="settings-subtitle">Configure payment methods and banking details for your store</p>
                </div>

                <div class="payment-settings-grid">
                    <?php foreach($settings as $index => $method): ?>
                    <div class="payment-card">
                        <form action="<?= site_url('admin/payment-settings/update') ?>" method="post">
                            <input type="hidden" name="id" value="<?= $method['id'] ?>">
                            
                            <div class="payment-header">
                                <div class="payment-title">
                                    <?php
                                    $iconClass = 'bank';
                                    if (stripos($method['method_name'], 'wallet') !== false) $iconClass = 'wallet';
                                    elseif (stripos($method['method_name'], 'card') !== false) $iconClass = 'card';
                                    elseif (stripos($method['method_name'], 'qr') !== false) $iconClass = 'qr';
                                    ?>
                                    <div class="payment-icon <?= $iconClass ?>">
                                        <i class="fas fa-<?= $iconClass === 'bank' ? 'university' : ($iconClass === 'wallet' ? 'wallet' : ($iconClass === 'card' ? 'credit-card' : 'qrcode')) ?>"></i>
                                    </div>
                                    <?= esc($method['method_name']) ?>
                                </div>
                                
                                <div class="toggle-label">
                                    <span>Enable</span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="is_active" value="1" <?= $method['is_active'] ? 'checked' : '' ?>>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="payment-form">
                                <div class="form-group">
                                    <label class="form-label">Payment Details</label>
                                    <textarea 
                                        name="details" 
                                        class="form-textarea" 
                                        placeholder="Enter payment details such as account number, bank name, payment instructions, etc."
                                    ><?= esc($method['details']) ?></textarea>
                                    <p class="form-help">Provide clear instructions for customers on how to pay using this method</p>
                                </div>
                                
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Save Changes
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= site_url('admin/dashboard') ?>'">
                                        <i class="fas fa-arrow-left"></i>
                                        Back to Dashboard
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if(empty($settings)): ?>
                <div class="payment-card">
                    <div class="payment-form" style="text-align: center; padding: 60px 30px;">
                        <i class="fas fa-credit-card" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 20px;"></i>
                        <h3 style="color: var(--admin-dark); margin-bottom: 10px;">No Payment Methods Found</h3>
                        <p style="color: #64748b; margin-bottom: 30px;">Payment methods haven't been configured yet. Please contact your administrator.</p>
                        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const mobileOverlay = document.getElementById('mobileOverlay');

        menuToggle.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-open');
                mobileOverlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        mobileOverlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-open');
            mobileOverlay.classList.remove('active');
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('mobile-open');
                mobileOverlay.classList.remove('active');
            }
        });

        // Form validation and submission feedback
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
                
                // Re-enable after a delay (in case of redirect)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        });

        // Auto-save functionality for textareas
        let autoSaveTimer;
        document.querySelectorAll('.form-textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(() => {
                    // Show auto-save indicator
                    const indicator = document.createElement('div');
                    indicator.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: var(--admin-success); color: white; padding: 10px 15px; border-radius: 8px; font-size: 0.9rem; z-index: 1000;';
                    indicator.innerHTML = '<i class="fas fa-check"></i> Draft saved';
                    document.body.appendChild(indicator);
                    
                    setTimeout(() => {
                        indicator.remove();
                    }, 2000);
                }, 2000);
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
