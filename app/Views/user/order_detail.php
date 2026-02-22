<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
.od-container {
    max-width: 900px;
    margin: 30px auto;
    padding: 0 20px 60px;
}

.od-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #007bff;
}

.od-header h1 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.od-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.od-btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    transition: 0.2s;
    border: none;
    cursor: pointer;
}

.od-btn-pay {
    background: #28a745;
    color: #fff;
}

.od-btn-pay:hover {
    background: #218838;
}

.od-btn-outline {
    background: transparent;
    color: #666;
    border: 1px solid #ddd;
}

.od-btn-outline:hover {
    border-color: #007bff;
    color: #007bff;
}

/* Info Grid */
.od-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.od-info-card {
    background: #f9f9f9;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 18px;
}

.od-info-card .label {
    font-size: 0.75rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.od-info-card .value {
    font-size: 0.95rem;
    color: #333;
    font-weight: 600;
}

.status-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-paid, .status-confirmed { background: #d4edda; color: #155724; }
.status-shipped { background: #d1ecf1; color: #0c5460; }
.status-completed { background: #cce5ff; color: #004085; }
.status-cancelled { background: #f8d7da; color: #721c24; }

/* Bank Details */
.od-bank-box {
    background: #fffbeb;
    border: 1px solid #fbbf24;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
}

.od-bank-box h4 {
    margin: 0 0 10px 0;
    color: #92400e;
    font-size: 0.95rem;
}

.od-bank-box pre {
    margin: 0;
    font-family: inherit;
    font-size: 0.9rem;
    color: #78350f;
    line-height: 1.6;
    white-space: pre-wrap;
}

/* Payment Proof */
.od-proof-box {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.od-proof-box a {
    color: #155724;
    font-weight: 600;
}

/* Items Table */
.od-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
}

.od-table thead th {
    background: #f8f9fa;
    padding: 14px 16px;
    text-align: left;
    font-size: 0.8rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e0e0e0;
}

.od-table tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid #f0f0f0;
    color: #333;
    font-size: 0.9rem;
}

.od-table tbody tr:last-child td {
    border-bottom: none;
}

.od-table .total-row td {
    border-top: 2px solid #333;
    font-weight: 800;
    font-size: 1.05rem;
    background: #f9f9f9;
}

.od-table .total-row .price {
    color: #b12704;
}

@media (max-width: 600px) {
    .od-header {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<div class="od-container">
    <!-- Header -->
    <div class="od-header">
        <h1>📋 Order #<?= $order['id'] ?></h1>
        <div class="od-actions">
            <?php if($order['status'] == 'pending' || $order['status'] == 'awaiting_payment'): ?>
                <a href="<?= site_url('payment-confirm/' . $order['id']) ?>" class="od-btn od-btn-pay">💳 แจ้งชำระเงิน</a>
            <?php endif; ?>
            <a href="<?= site_url('user') ?>" class="od-btn od-btn-outline">← Back to Dashboard</a>
        </div>
    </div>

    <!-- Order Info Cards -->
    <div class="od-info-grid">
        <div class="od-info-card">
            <div class="label">Order Date</div>
            <div class="value"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></div>
        </div>
        <div class="od-info-card">
            <div class="label">Status</div>
            <div class="value">
                <?php 
                    $statusClass = 'status-' . strtolower($order['status']);
                ?>
                <span class="status-badge <?= $statusClass ?>"><?= ucfirst(str_replace('_', ' ', $order['status'])) ?></span>
            </div>
        </div>
        <div class="od-info-card">
            <div class="label">Payment Method</div>
            <div class="value"><?= esc($order['payment_method'] ?? 'N/A') ?></div>
        </div>
        <div class="od-info-card">
            <div class="label">Total Amount</div>
            <div class="value" style="color: #b12704; font-size: 1.1rem;">฿<?= number_format($order['total_amount'], 2) ?></div>
        </div>
    </div>

    <!-- Shipping Info -->
    <?php if(!empty($order['shipping_name'])): ?>
    <div class="od-info-grid" style="grid-template-columns: 1fr 1fr;">
        <div class="od-info-card">
            <div class="label">📦 Ship To</div>
            <div class="value"><?= esc($order['shipping_name']) ?></div>
            <div style="color: #777; font-size: 0.85rem; margin-top: 4px;"><?= esc($order['shipping_phone'] ?? '') ?></div>
        </div>
        <div class="od-info-card">
            <div class="label">📍 Shipping Address</div>
            <div class="value" style="font-weight: 400; font-size: 0.85rem; line-height: 1.5;">
                <?= esc($order['shipping_address'] ?? '') ?>
                <?php if(!empty($order['shipping_note'])): ?>
                    <div style="color: #999; margin-top: 6px; font-style: italic;">Note: <?= esc($order['shipping_note']) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bank Transfer Details -->
    <?php if(!empty($bank_details) && ($order['status'] == 'pending' || $order['status'] == 'awaiting_payment')): ?>
    <div class="od-bank-box">
        <h4>🏦 Bank Transfer Details</h4>
        <pre><?= esc($bank_details) ?></pre>
        <p style="font-size: 0.85rem; color: #92400e; margin-top: 10px;">กรุณาโอนเงินจำนวน <strong>฿<?= number_format($order['total_amount'], 2) ?></strong> แล้วกดปุ่ม "แจ้งชำระเงิน" ด้านบน</p>
    </div>
    <?php endif; ?>

    <!-- Payment Proof -->
    <?php if(!empty($order['payment_proof'])): ?>
    <div class="od-proof-box">
        <span>✅ Payment Proof Submitted</span>
        <a href="<?= base_url($order['payment_proof']) ?>" target="_blank">View Slip →</a>
    </div>
    <?php endif; ?>

    <!-- Items Table -->
    <table class="od-table">
        <thead>
            <tr>
                <th>Product</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: right;">Unit Price</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $item): ?>
            <tr>
                <td><?= esc($item['product_name']) ?></td>
                <td style="text-align: center;"><?= $item['quantity'] ?></td>
                <td style="text-align: right;">฿<?= number_format($item['price'], 2) ?></td>
                <td style="text-align: right;">฿<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">GRAND TOTAL</td>
                <td style="text-align: right;" class="price">฿<?= number_format($order['total_amount'], 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
