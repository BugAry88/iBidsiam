<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBidSiam Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Premium Admin Dashboard Styles */
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--admin-card);
            padding: 30px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--admin-border);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-gold));
            opacity: 0.05;
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-icon.revenue {
            background: linear-gradient(135deg, var(--admin-gold), #f59e0b);
            color: white;
        }

        .stat-icon.orders {
            background: linear-gradient(135deg, var(--admin-primary), #6366f1);
            color: white;
        }

        .stat-icon.pending {
            background: linear-gradient(135deg, var(--admin-warning), #f97316);
            color: white;
        }

        .stat-icon.products {
            background: linear-gradient(135deg, var(--admin-success), #22c55e);
            color: white;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--admin-dark);
            margin-bottom: 8px;
        }

        .stat-label {
            color: #64748b;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 12px;
        }

        .stat-change.positive {
            background: rgba(16, 185, 129, 0.1);
            color: var(--admin-success);
        }

        .stat-change.negative {
            background: rgba(239, 68, 68, 0.1);
            color: var(--admin-danger);
        }

        /* Panels */
        .panel {
            background: var(--admin-card);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--admin-border);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .panel-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.02), rgba(212, 175, 55, 0.02));
        }

        .panel-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-header i {
            color: var(--admin-primary);
        }

        .btn-action {
            padding: 10px 20px;
            background: var(--admin-primary);
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
            font-size: 0.9rem;
        }

        .btn-action:hover {
            background: var(--admin-gold);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--admin-success), #22c55e);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #22c55e, var(--admin-success));
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: var(--admin-bg);
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--admin-dark);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--admin-border);
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--admin-border);
            font-size: 0.95rem;
        }

        tr:hover {
            background: rgba(139, 92, 246, 0.02);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--admin-warning);
        }

        .status-paid {
            background: rgba(16, 185, 129, 0.1);
            color: var(--admin-success);
        }

        .status-processing {
            background: rgba(59, 130, 246, 0.1);
            color: var(--admin-info);
        }

        .status-shipped {
            background: rgba(139, 92, 246, 0.1);
            color: var(--admin-primary);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--admin-success);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.1);
            color: var(--admin-danger);
        }

        /* Product Images */
        .product-img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
        }

        /* Charts Container */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: var(--admin-card);
            padding: 30px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--admin-border);
        }

        .chart-card h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin-bottom: 20px;
        }

        .chart-placeholder {
            height: 200px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(212, 175, 55, 0.05));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

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
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .charts-grid {
                grid-template-columns: 1fr;
            }
            
            .panel-header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .table-container {
                font-size: 0.85rem;
            }
            
            th, td {
                padding: 12px 8px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
                <a href="<?= site_url('admin/dashboard') ?>" class="active">
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
                    <span>Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/analytics') ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/payment-settings') ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Payment Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/email-settings') ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Email Settings</span>
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
                <h2>Dashboard Overview</h2>
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

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">฿<?= number_format($total_revenue, 2) ?></div>
                            <div class="stat-label">Total Revenue</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                +12.5% from last month
                            </div>
                        </div>
                        <div class="stat-icon revenue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?= $total_orders ?></div>
                            <div class="stat-label">Total Orders</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                +8.2% from last month
                            </div>
                        </div>
                        <div class="stat-icon orders">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?= $pending_orders ?></div>
                            <div class="stat-label">Pending Orders</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                -3.1% from last week
                            </div>
                        </div>
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?= $total_products ?></div>
                            <div class="stat-label">Total Products</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                +5 new this week
                            </div>
                        </div>
                        <div class="stat-icon products">
                            <i class="fas fa-compact-disc"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="charts-grid">
                <div class="chart-card">
                    <h4><i class="fas fa-chart-line"></i> Sales Overview</h4>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-area" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                </div>
                <div class="chart-card">
                    <h4><i class="fas fa-chart-pie"></i> Top Products</h4>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="panel">
                <div class="panel-header">
                    <h3><i class="fas fa-shopping-cart"></i> Recent Orders</h3>
                    <a href="<?= site_url('admin/orders') ?>" class="btn-action">View All Orders</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($orders)): ?>
                                <?php foreach(array_slice($orders, 0, 5) as $order): ?>
                                <tr>
                                    <td style="font-weight: 600; color: var(--admin-primary);">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div class="user-avatar" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                <?= substr(isset($order['user_id']) ? 'U' . $order['user_id'] : 'G', 0, 2) ?>
                                            </div>
                                            <?= isset($order['user_id']) ? 'User #' . $order['user_id'] : 'Guest Customer' ?>
                                        </div>
                                    </td>
                                    <td><?= date('M j, Y H:i', strtotime($order['created_at'])) ?></td>
                                    <td style="font-weight: 600; color: var(--admin-dark);">฿<?= number_format($order['total_amount'], 2) ?></td>
                                    <td>
                                        <span class="status-badge status-<?= $order['status'] ?>">
                                            <?= ucfirst(str_replace('_', ' ', $order['status'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('admin/order/'.$order['id']) ?>" class="btn-action" style="padding: 8px 16px; font-size: 0.85rem;">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                        <i class="fas fa-inbox" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                                        No recent orders found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Inventory Status -->
            <div class="panel">
                <div class="panel-header">
                    <h3><i class="fas fa-warehouse"></i> Inventory Status</h3>
                    <a href="<?= site_url('admin/products/create') ?>" class="btn-action btn-primary">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($products)): ?>
                                <?php foreach(array_slice($products, 0, 5) as $product): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <?php if($product['image']): ?>
                                                <img src="<?= esc($product['image']) ?>" class="product-img" alt="<?= esc($product['name']) ?>">
                                            <?php else: ?>
                                                <div class="product-img" style="background: var(--admin-bg); display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-compact-disc" style="color: #64748b;"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div style="font-weight: 600; color: var(--admin-dark);"><?= esc($product['name']) ?></div>
                                                <div style="font-size: 0.85rem; color: #64748b;"><?= esc($product['genre'] ?? 'Various') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-weight: 600;">฿<?= number_format($product['price'], 2) ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="font-weight: 600;"><?= $product['quantity'] ?></span>
                                            <?php if($product['quantity'] <= 5): ?>
                                                <i class="fas fa-exclamation-triangle" style="color: var(--admin-warning); font-size: 0.9rem;"></i>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($product['quantity'] < 1): ?>
                                            <span class="status-badge" style="background: rgba(239, 68, 68, 0.1); color: var(--admin-danger);">Out of Stock</span>
                                        <?php elseif($product['quantity'] <= 5): ?>
                                            <span class="status-badge" style="background: rgba(245, 158, 11, 0.1); color: var(--admin-warning);">Low Stock</span>
                                        <?php else: ?>
                                            <span class="status-badge" style="background: rgba(16, 185, 129, 0.1); color: var(--admin-success);">In Stock</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-weight: 600; color: var(--admin-success);">
                                        ฿<?= number_format(($product['price'] * (50 - $product['quantity'])), 2) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                                        <i class="fas fa-box-open" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                                        No products found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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

        // Auto-refresh data every 30 seconds
        setInterval(function() {
            // Add loading indicators
            document.querySelectorAll('.stat-value').forEach(el => {
                el.style.opacity = '0.6';
            });

            // Simulate data refresh (replace with actual AJAX calls)
            setTimeout(function() {
                document.querySelectorAll('.stat-value').forEach(el => {
                    el.style.opacity = '1';
                });
            }, 1000);
        }, 30000);

        // Add smooth scrolling
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
