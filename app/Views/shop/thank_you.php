<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
.ty-container {
    max-width: 700px;
    margin: 60px auto;
    padding: 50px 40px;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.ty-icon {
    font-size: 4rem;
    margin-bottom: 10px;
}

.ty-title {
    font-size: 1.8rem;
    font-weight: 800;
    color: #28a745;
    margin: 0 0 10px 0;
}

.ty-subtitle {
    color: #777;
    font-size: 1rem;
    margin-bottom: 30px;
}

.ty-order-badge {
    display: inline-block;
    background: #f0f4ff;
    border: 1px solid #d0d8f0;
    color: #333;
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 30px;
}

.ty-order-badge span {
    color: #007bff;
}

.ty-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    text-align: left;
    margin-bottom: 30px;
}

.ty-info-card {
    background: #fafafa;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 20px;
}

.ty-info-card h4 {
    margin: 0 0 10px 0;
    font-size: 0.85rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.ty-info-card p {
    margin: 0;
    color: #333;
    font-size: 0.95rem;
    font-weight: 600;
}

.ty-bank-details {
    background: #fffbeb;
    border: 1px solid #fbbf24;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
    text-align: left;
}

.ty-bank-details h4 {
    margin: 0 0 10px 0;
    color: #92400e;
    font-size: 0.95rem;
}

.ty-bank-details pre {
    margin: 0;
    font-family: inherit;
    font-size: 0.9rem;
    color: #78350f;
    line-height: 1.6;
    white-space: pre-wrap;
}

.ty-bank-details .amount {
    margin-top: 10px;
    font-size: 0.85rem;
    color: #92400e;
}

.ty-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
}

.ty-btn {
    display: inline-block;
    padding: 13px 28px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    transition: 0.2s;
    border: none;
    cursor: pointer;
}

.ty-btn-primary {
    background: #007bff;
    color: #fff;
}

.ty-btn-primary:hover {
    background: #0056b3;
}

.ty-btn-success {
    background: #28a745;
    color: #fff;
}

.ty-btn-success:hover {
    background: #1e7e34;
}

.ty-btn-outline {
    background: transparent;
    color: #666;
    border: 1px solid #ddd;
}

.ty-btn-outline:hover {
    border-color: #007bff;
    color: #007bff;
}

@media (max-width: 600px) {
    .ty-info-grid {
        grid-template-columns: 1fr;
    }
    .ty-container {
        margin: 30px 15px;
        padding: 30px 20px;
    }
}
</style>

<div class="ty-container">
    <div class="ty-icon">✅</div>
    <h1 class="ty-title">Order Confirmed!</h1>
    <p class="ty-subtitle">ขอบคุณสำหรับคำสั่งซื้อ! เราจะดำเนินการจัดส่งให้เร็วที่สุด</p>

    <div class="ty-order-badge">Order <span>#<?= $order['id'] ?></span></div>

    <div class="ty-info-grid">
        <div class="ty-info-card">
            <h4>💰 Total Amount</h4>
            <p style="color: #b12704;">฿<?= number_format($order['total_amount'], 2) ?></p>
        </div>
        <div class="ty-info-card">
            <h4>💳 Payment Method</h4>
            <p><?= esc($order['payment_method']) ?></p>
        </div>
        <?php if(!empty($order['shipping_name'])): ?>
        <div class="ty-info-card">
            <h4>📦 Ship To</h4>
            <p><?= esc($order['shipping_name']) ?></p>
            <p style="font-weight: 400; color: #777; font-size: 0.85rem; margin-top: 4px;"><?= esc($order['shipping_phone'] ?? '') ?></p>
        </div>
        <div class="ty-info-card">
            <h4>📍 Address</h4>
            <p style="font-weight: 400; font-size: 0.85rem; line-height: 1.5;"><?= esc($order['shipping_address'] ?? '') ?></p>
        </div>
        <?php endif; ?>
    </div>

    <?php if(!empty($bank_details)): ?>
    <div class="ty-bank-details">
        <h4>🏦 Bank Transfer Instructions</h4>
        <pre><?= esc($bank_details) ?></pre>
        <p class="amount">กรุณาโอนเงินจำนวน <strong>฿<?= number_format($order['total_amount'], 2) ?></strong> แล้วแจ้งชำระเงินด้านล่าง</p>
    </div>
    <?php endif; ?>

    <div class="ty-actions">
        <a href="<?= site_url('payment-confirm/' . $order['id']) ?>" class="ty-btn ty-btn-success">💳 แจ้งชำระเงิน</a>
        <?php if(session()->get('is_user_logged_in')): ?>
            <a href="<?= site_url('user/order/' . $order['id']) ?>" class="ty-btn ty-btn-primary">📋 View Order</a>
        <?php endif; ?>
        <a href="<?= site_url('shop') ?>" class="ty-btn ty-btn-outline">← Continue Shopping</a>
    </div>
</div>

<?= $this->endSection() ?>
