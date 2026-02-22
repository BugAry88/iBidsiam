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
        .success-message {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
            color: #155724;
        }
        .success-message h2 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }
        .order-summary {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .order-summary h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 18px;
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
            text-align: right;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
        }
        .total-row {
            background: #f8f9fa;
            font-weight: 700;
            font-size: 18px;
        }
        .total-row td {
            color: #28a745;
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
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-box h4 {
            margin: 0 0 10px 0;
            color: #1976d2;
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
        .social-links {
            margin: 15px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #adb5bd;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">✅</div>
            <h1>Order Confirmed!</h1>
            <p style="font-size: 18px; margin: 0;">Thank you for your purchase</p>
        </div>
        
        <div class="content">
            <div class="success-message">
                <h2>🎉 Your order has been successfully placed!</h2>
                <p style="margin: 10px 0 0 0;">We've received your order and will process it shortly. You'll receive another email when your order ships.</p>
            </div>
            
            <div class="order-summary">
                <h3>📋 Order Summary</h3>
                <div class="info-row">
                    <span class="label">Order Number:</span>
                    <span class="value"><strong>#<?= $order_id ?></strong></span>
                </div>
                <div class="info-row">
                    <span class="label">Order Date:</span>
                    <span class="value"><?= date('F j, Y', strtotime($order['created_at'])) ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Order Status:</span>
                    <span class="value" style="color: #ffc107; font-weight: 600;">
                        <?= ucfirst($order['status']) ?>
                    </span>
                </div>
            </div>
            
            <?php if (!empty($items)): ?>
            <h3 style="color: #2d3748; margin-top: 30px;">🎵 Your Items</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= esc($item['product_name']) ?></td>
                        <td style="text-align: center;"><?= $item['quantity'] ?></td>
                        <td style="text-align: right;">฿<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total Amount:</strong></td>
                        <td style="text-align: right;"><strong>฿<?= $total ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <?php endif; ?>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="<?= site_url('shop') ?>" class="button">
                    Continue Shopping →
                </a>
            </div>
            
            <div class="info-box">
                <h4>📦 What happens next?</h4>
                <p style="margin: 5px 0;">
                    1. We'll verify your payment<br>
                    2. Your order will be prepared for shipping<br>
                    3. You'll receive a shipping confirmation email<br>
                    4. Track your package until it arrives
                </p>
            </div>
            
            <div class="info-box" style="background: #fff3cd; border-left-color: #ffc107;">
                <h4 style="color: #856404;">💳 Payment Instructions</h4>
                <p style="margin: 5px 0; color: #856404;">
                    Please complete your payment within 24 hours to avoid order cancellation. 
                    Check your order details for payment information.
                </p>
            </div>
            
            <p style="color: #6c757d; font-size: 14px; margin-top: 30px;">
                If you have any questions about your order, please don't hesitate to contact us at 
                <a href="mailto:support@ibidsiam.com" style="color: #667eea;">support@ibidsiam.com</a>
            </p>
        </div>
        
        <div class="footer">
            <p style="font-size: 18px; margin: 0 0 10px 0;"><strong>IBidSiam Vinyl Shop</strong></p>
            <p style="margin: 5px 0;">Premium Vinyl Records & Music Collections</p>
            
            <div class="social-links">
                <a href="#">📘</a>
                <a href="#">📷</a>
                <a href="#">🐦</a>
            </div>
            
            <p style="font-size: 12px; color: #adb5bd; margin-top: 20px;">
                © <?= date('Y') ?> IBidSiam. All rights reserved.<br>
                <a href="<?= site_url() ?>">Visit our website</a>
            </p>
        </div>
    </div>
</body>
</html>
