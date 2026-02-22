<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
        }
        .header .icon {
            font-size: 64px;
            margin-bottom: 15px;
        }
        .content {
            padding: 30px;
        }
        .status-update {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }
        .status-update h2 {
            margin: 0 0 10px 0;
            color: #1976d2;
            font-size: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 16px;
            margin: 10px 0;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-processing {
            background: #cfe2ff;
            color: #084298;
        }
        .status-shipped {
            background: #e7d4f5;
            color: #6f42c1;
        }
        .status-delivered {
            background: #d1e7dd;
            color: #0f5132;
        }
        .status-cancelled {
            background: #f8d7da;
            color: #842029;
        }
        .order-info {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .order-info h3 {
            margin-top: 0;
            color: #667eea;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #6c757d;
        }
        .value {
            color: #2d3748;
        }
        .timeline {
            margin: 30px 0;
        }
        .timeline-item {
            display: flex;
            margin-bottom: 20px;
        }
        .timeline-icon {
            width: 40px;
            height: 40px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .timeline-icon.completed {
            background: #28a745;
        }
        .timeline-icon.current {
            background: #ffc107;
        }
        .timeline-content h4 {
            margin: 0 0 5px 0;
            color: #2d3748;
        }
        .timeline-content p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 14px 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 20px 0;
            font-weight: 600;
            font-size: 16px;
        }
        .footer {
            background: #2d3748;
            color: white;
            padding: 30px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">
                <?php
                $icons = [
                    'pending' => '⏳',
                    'processing' => '⚙️',
                    'shipped' => '🚚',
                    'delivered' => '✅',
                    'cancelled' => '❌'
                ];
                echo $icons[$new_status] ?? '📦';
                ?>
            </div>
            <h1>Order Status Update</h1>
            <p style="font-size: 18px; margin: 0;">Order #<?= $order_id ?></p>
        </div>
        
        <div class="content">
            <div class="status-update">
                <h2>📢 Your order status has been updated</h2>
                <p style="margin: 10px 0;">
                    Your order is now: 
                    <span class="status-badge status-<?= $new_status ?>">
                        <?= $status ?>
                    </span>
                </p>
            </div>
            
            <div class="order-info">
                <h3>📋 Order Details</h3>
                <div class="info-row">
                    <span class="label">Order Number:</span>
                    <span class="value"><strong>#<?= $order_id ?></strong></span>
                </div>
                <div class="info-row">
                    <span class="label">Order Date:</span>
                    <span class="value"><?= date('F j, Y', strtotime($order['created_at'])) ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Current Status:</span>
                    <span class="value"><strong><?= $status ?></strong></span>
                </div>
            </div>
            
            <h3 style="color: #2d3748; margin-top: 30px;">📍 Order Progress</h3>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon completed">✓</div>
                    <div class="timeline-content">
                        <h4>Order Placed</h4>
                        <p>Your order has been received</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon <?= in_array($new_status, ['processing', 'shipped', 'delivered']) ? 'completed' : ($new_status == 'pending' ? 'current' : '') ?>">
                        <?= in_array($new_status, ['processing', 'shipped', 'delivered']) ? '✓' : '2' ?>
                    </div>
                    <div class="timeline-content">
                        <h4>Processing</h4>
                        <p>We're preparing your order</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon <?= in_array($new_status, ['shipped', 'delivered']) ? 'completed' : ($new_status == 'processing' ? 'current' : '') ?>">
                        <?= in_array($new_status, ['shipped', 'delivered']) ? '✓' : '3' ?>
                    </div>
                    <div class="timeline-content">
                        <h4>Shipped</h4>
                        <p>Your order is on the way</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon <?= $new_status == 'delivered' ? 'completed' : ($new_status == 'shipped' ? 'current' : '') ?>">
                        <?= $new_status == 'delivered' ? '✓' : '4' ?>
                    </div>
                    <div class="timeline-content">
                        <h4>Delivered</h4>
                        <p>Order has been delivered</p>
                    </div>
                </div>
            </div>
            
            <?php if ($new_status == 'shipped'): ?>
            <div style="background: #e7d4f5; border-left: 4px solid #6f42c1; padding: 20px; margin: 25px 0; border-radius: 4px;">
                <h4 style="margin: 0 0 10px 0; color: #6f42c1;">🚚 Your order is on the way!</h4>
                <p style="margin: 0; color: #6f42c1;">
                    Your package has been shipped and should arrive within 3-5 business days.
                </p>
            </div>
            <?php elseif ($new_status == 'delivered'): ?>
            <div style="background: #d1e7dd; border-left: 4px solid #0f5132; padding: 20px; margin: 25px 0; border-radius: 4px;">
                <h4 style="margin: 0 0 10px 0; color: #0f5132;">🎉 Your order has been delivered!</h4>
                <p style="margin: 0; color: #0f5132;">
                    We hope you enjoy your purchase! Please let us know if you have any issues.
                </p>
            </div>
            <?php elseif ($new_status == 'cancelled'): ?>
            <div style="background: #f8d7da; border-left: 4px solid #842029; padding: 20px; margin: 25px 0; border-radius: 4px;">
                <h4 style="margin: 0 0 10px 0; color: #842029;">❌ Order Cancelled</h4>
                <p style="margin: 0; color: #842029;">
                    Your order has been cancelled. If you have any questions, please contact our support team.
                </p>
            </div>
            <?php endif; ?>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="<?= site_url('shop') ?>" class="button">
                    Continue Shopping →
                </a>
            </div>
            
            <p style="color: #6c757d; font-size: 14px; margin-top: 30px;">
                If you have any questions about your order, please contact us at 
                <a href="mailto:support@ibidsiam.com" style="color: #667eea;">support@ibidsiam.com</a>
            </p>
        </div>
        
        <div class="footer">
            <p style="font-size: 18px; margin: 0 0 10px 0;"><strong>IBidSiam Vinyl Shop</strong></p>
            <p style="margin: 5px 0;">Premium Vinyl Records & Music Collections</p>
            <p style="font-size: 12px; color: #adb5bd; margin-top: 20px;">
                © <?= date('Y') ?> IBidSiam. All rights reserved.<br>
                <a href="<?= site_url() ?>">Visit our website</a>
            </p>
        </div>
    </div>
</body>
</html>
