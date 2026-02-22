<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
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
            <li class="nav-item"><a href="<?= site_url('admin/orders') ?>" class="active">Orders Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/payment-settings') ?>">Payment Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('shop') ?>" target="_blank">View Storefront</a></li>
        </ul>
        <div style="margin-top: auto; padding: 20px;">
             <p style="color: #adb5bd; font-size: 0.8rem;">Logged in as: <strong><?= session('user_name') ?? 'Admin' ?></strong></p>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h2>Orders Management</h2>
            <div>
                <a href="<?= site_url('admin/dashboard') ?>" class="btn-action">&larr; Dashboard</a>
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
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Order ID</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Customer</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Email</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Date</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Total</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Status</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #4a5568;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($orders)): ?>
                        <?php foreach($orders as $order): ?>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 12px;">
                                <span style="font-weight: 600; color: #4299e1;">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></span>
                            </td>
                            <td style="padding: 12px;">
                                <?= esc($order['customer_name'] ?? 'Guest Customer') ?>
                            </td>
                            <td style="padding: 12px;">
                                <?= esc($order['customer_email'] ?? 'N/A') ?>
                            </td>
                            <td style="padding: 12px;">
                                <?= date('M j, Y H:i', strtotime($order['created_at'])) ?>
                            </td>
                            <td style="padding: 12px; font-weight: 600;">
                                ฿<?= number_format($order['total_amount'], 2) ?>
                            </td>
                            <td style="padding: 12px;">
                                <span class="status-badge status-<?= $order['status'] ?>" style="padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">
                                    <?= ucfirst(str_replace('_', ' ', $order['status'])) ?>
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                <a href="<?= site_url('admin/order/'.$order['id']) ?>" class="btn-action" style="padding: 6px 12px; font-size: 0.85rem;">View</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="padding: 40px; text-align: center; color: #718096;">
                                <div style="font-size: 3rem; margin-bottom: 10px;">📦</div>
                                <p>No orders found.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <style>
        .status-badge {
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pending {
            background: #fef5e7;
            color: #f39c12;
        }
        
        .status-processing {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .status-shipped {
            background: #f3e5f5;
            color: #7b1fa2;
        }
        
        .status-delivered {
            background: #e8f5e8;
            color: #2e7d32;
        }
        
        .status-cancelled {
            background: #ffebee;
            color: #c62828;
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
    </style>
</body>
</html>
