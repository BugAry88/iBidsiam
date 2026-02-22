<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Management</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <h1>CONTROL DECK</h1>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="<?= site_url('admin/dashboard') ?>">Overview</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/products') ?>">Products Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/orders') ?>">Orders Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/customers') ?>" class="active">Customers Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/payment-settings') ?>">Payment Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('shop') ?>" target="_blank">View Storefront</a></li>
        </ul>
        <div style="margin-top: auto; padding: 20px;">
             <p style="color: #adb5bd; font-size: 0.8rem;">Logged in as: <strong><?= session('user_name') ?? 'Admin' ?></strong></p>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h2>Customers Management</h2>
            <div>
                <a href="<?= site_url('admin/dashboard') ?>" class="btn-action">&larr; Dashboard</a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="stat-content">
                    <div class="stat-value"><?= count($customers) ?></div>
                    <div class="stat-label">Total Customers</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            
            <?php 
            $totalRevenue = array_sum(array_column($customers, 'total_spent'));
            $avgOrderValue = count($customers) > 0 ? $totalRevenue / array_sum(array_column($customers, 'total_orders')) : 0;
            ?>
            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="stat-content">
                    <div class="stat-value">฿<?= number_format($totalRevenue, 0) ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            
            <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="stat-content">
                    <div class="stat-value">฿<?= number_format($avgOrderValue, 0) ?></div>
                    <div class="stat-label">Avg Order Value</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <div class="content-panel">
            <?php if (session()->get('success')): ?>
                <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('error')): ?>
                <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>

            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: #2d3748; color: white;">
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Customer</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Email</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Phone</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Total Orders</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Total Spent</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Last Order</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($customers)): ?>
                        <?php foreach($customers as $customer): ?>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 12px;">
                                <div style="font-weight: 600; color: #2d3748;">
                                    <?= esc($customer['customer_name']) ?>
                                </div>
                                <?php if(!empty($customer['customer_address'])): ?>
                                    <div style="font-size: 0.85rem; color: #718096; margin-top: 4px;">
                                        <?= substr(esc($customer['customer_address']), 0, 50) ?>...
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px;">
                                <?= esc($customer['customer_email'] ?? 'N/A') ?>
                            </td>
                            <td style="padding: 12px;">
                                <?= esc($customer['customer_phone'] ?? '-') ?>
                            </td>
                            <td style="padding: 12px; font-weight: 600;">
                                <?= number_format($customer['total_orders']) ?>
                            </td>
                            <td style="padding: 12px; font-weight: 600; color: #38a169;">
                                ฿<?= number_format($customer['total_spent'], 2) ?>
                            </td>
                            <td style="padding: 12px;">
                                <?= date('M j, Y', strtotime($customer['last_order_date'])) ?>
                            </td>
                            <td style="padding: 12px;">
                                <?php if($customer['user_id']): ?>
                                    <span class="customer-type-badge registered" style="background: #e3f2fd; color: #1976d2; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">
                                        Registered
                                    </span>
                                <?php else: ?>
                                    <span class="customer-type-badge guest" style="background: #fff3e0; color: #f57c00; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">
                                        Guest
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="padding: 40px; text-align: center; color: #718096;">
                                <div style="font-size: 3rem; margin-bottom: 10px;">👥</div>
                                <p>No customers found.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <style>
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }
        
        .stat-content {
            position: relative;
            z-index: 1;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .stat-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            opacity: 0.3;
        }
        
        .content-panel {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .customer-type-badge {
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</body>
</html>
