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
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
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
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #856404;
        }
        .product-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .product-info h3 {
            margin-top: 0;
            color: #dc3545;
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
        .stock-level {
            font-size: 24px;
            font-weight: 700;
            color: #dc3545;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
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
            color: #dc3545;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">⚠️</div>
            <h1>Low Stock Alert!</h1>
            <p>Inventory Warning</p>
        </div>
        
        <div class="content">
            <div class="warning-box">
                <strong>⚡ Immediate Attention Required:</strong> Product stock is running low and needs to be restocked soon.
            </div>
            
            <div class="product-info">
                <h3>📦 Product Details</h3>
                <div class="info-row">
                    <span class="label">Product Name:</span>
                    <span class="value"><strong><?= esc($product['name']) ?></strong></span>
                </div>
                <div class="info-row">
                    <span class="label">Product ID:</span>
                    <span class="value">#<?= $product['id'] ?></span>
                </div>
                <?php if (isset($product['genre'])): ?>
                <div class="info-row">
                    <span class="label">Genre:</span>
                    <span class="value"><?= esc($product['genre']) ?></span>
                </div>
                <?php endif; ?>
                <div class="info-row">
                    <span class="label">Price:</span>
                    <span class="value">฿<?= number_format($product['price'], 2) ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Current Stock:</span>
                    <span class="stock-level"><?= $quantity ?> units</span>
                </div>
            </div>
            
            <div style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; border-radius: 4px; margin: 20px 0; color: #721c24;">
                <strong>⚠️ Stock Level Critical:</strong><br>
                This product has reached the minimum stock threshold. Please reorder immediately to avoid stockouts.
            </div>
            
            <div style="text-align: center;">
                <a href="<?= site_url('admin/products/edit/' . $product['id']) ?>" class="button">
                    Update Product Stock →
                </a>
            </div>
            
            <p style="color: #6c757d; font-size: 14px; margin-top: 30px;">
                <strong>Recommended Actions:</strong><br>
                • Contact supplier for restock<br>
                • Update product quantity<br>
                • Consider marking as "Pre-Order" if out of stock<br>
                • Review sales data to optimize inventory
            </p>
        </div>
        
        <div class="footer">
            <p><strong>IBidSiam Vinyl Shop</strong> - Inventory Alert</p>
            <p>
                <a href="<?= site_url('admin/dashboard') ?>">Admin Dashboard</a> | 
                <a href="<?= site_url('admin/products') ?>">Manage Products</a>
            </p>
            <p style="font-size: 12px; color: #adb5bd; margin-top: 10px;">
                This is an automated notification. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
