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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .success-box {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #155724;
        }
        .payment-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .payment-info h3 {
            margin-top: 0;
            color: #28a745;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
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
        .amount {
            font-size: 24px;
            font-weight: 700;
            color: #28a745;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 20px 0;
            font-weight: 600;
        }
        .footer {
            background: #2d3748;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #28a745;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">💳</div>
            <h1>Payment Received!</h1>
            <p>Order #<?= $order_id ?></p>
        </div>
        
        <div class="content">
            <div class="success-box">
                <strong>✅ Payment Confirmed:</strong> A payment has been successfully received for this order.
            </div>
            
            <div class="payment-info">
                <h3>💰 Payment Details</h3>
                <div class="info-row">
                    <span class="label">Order ID:</span>
                    <span class="value">#<?= $order_id ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Payment Date:</span>
                    <span class="value"><?= date('M j, Y H:i') ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Payment Method:</span>
                    <span class="value"><?= isset($payment['payment_method']) ? ucfirst($payment['payment_method']) : 'Bank Transfer' ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Customer:</span>
                    <span class="value"><?= isset($order['customer_name']) ? esc($order['customer_name']) : 'Guest Customer' ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Amount Paid:</span>
                    <span class="amount">฿<?= $amount ?></span>
                </div>
            </div>
            
            <?php if (isset($payment['slip_image']) && $payment['slip_image']): ?>
            <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0;">
                <strong>📎 Payment Slip:</strong> Attached to order details
            </div>
            <?php endif; ?>
            
            <div style="text-align: center;">
                <a href="<?= site_url('admin/order/' . $order['id']) ?>" class="button">
                    View Order & Payment Details →
                </a>
            </div>
            
            <p style="color: #6c757d; font-size: 14px; margin-top: 30px;">
                <strong>Next Steps:</strong><br>
                • Verify payment slip/proof<br>
                • Update order status to "Processing"<br>
                • Prepare items for shipment<br>
                • Send shipping confirmation to customer
            </p>
        </div>
        
        <div class="footer">
            <p><strong>IBidSiam Vinyl Shop</strong> - Payment Notification</p>
            <p>
                <a href="<?= site_url('admin/dashboard') ?>">Admin Dashboard</a> | 
                <a href="<?= site_url('admin/orders') ?>">All Orders</a>
            </p>
            <p style="font-size: 12px; color: #adb5bd; margin-top: 10px;">
                This is an automated notification. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
