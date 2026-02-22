<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
.checkout-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 30px 20px 60px;
}

.checkout-title {
    font-size: 1.6rem;
    color: #333;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #007bff;
}

.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 40px;
    align-items: start;
}

/* Shipping Form */
.shipping-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
}

.shipping-card h3 {
    margin: 0 0 25px 0;
    font-size: 1.1rem;
    color: #333;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    color: #555;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 6px;
}

.form-group label .required {
    color: #dc3545;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9rem;
    color: #333;
    background: #fafafa;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    background: #fff;
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

/* Payment Method */
.payment-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
    margin-top: 20px;
}

.payment-card h3 {
    margin: 0 0 20px 0;
    font-size: 1.1rem;
    color: #333;
    display: flex;
    align-items: center;
    gap: 8px;
}

.payment-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 1px solid #eee;
    border-radius: 6px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: 0.2s;
}

.payment-option:hover {
    border-color: #007bff;
    background: #f8f9ff;
}

.payment-option input[type="radio"] {
    accent-color: #007bff;
    width: 18px;
    height: 18px;
}

.payment-option span {
    color: #333;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Order Summary (Right) */
.summary-card {
    background: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 25px;
    position: sticky;
    top: 20px;
}

.summary-card h3 {
    margin: 0 0 20px 0;
    font-size: 1.1rem;
    color: #333;
    padding-bottom: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.summary-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    align-items: center;
}

.summary-item-img {
    width: 55px;
    height: 55px;
    border-radius: 4px;
    object-fit: cover;
    border: 1px solid #eee;
    background: #f0f0f0;
}

.summary-item-img-placeholder {
    width: 55px;
    height: 55px;
    border-radius: 4px;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ccc;
    font-size: 0.6rem;
}

.summary-item-info {
    flex: 1;
    min-width: 0;
}

.summary-item-name {
    font-size: 0.85rem;
    color: #333;
    font-weight: 600;
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.summary-item-qty {
    font-size: 0.8rem;
    color: #777;
    margin-top: 2px;
}

.summary-item-price {
    font-weight: 700;
    color: #333;
    font-size: 0.85rem;
    white-space: nowrap;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    font-size: 0.9rem;
    color: #555;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    padding: 15px 0 0;
    margin-top: 5px;
    border-top: 2px solid #333;
    font-size: 1.15rem;
    font-weight: 800;
    color: #333;
}

.summary-total .price {
    color: #b12704;
}

.btn-confirm {
    display: block;
    width: 100%;
    background: #28a745;
    color: #fff;
    border: none;
    padding: 16px;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 20px;
    transition: 0.2s;
    text-align: center;
}

.btn-confirm:hover {
    background: #218838;
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 12px;
    color: #999;
    font-size: 0.85rem;
    text-decoration: none;
}

.back-link:hover {
    color: #007bff;
}

/* Alert */
.checkout-alert {
    background: #fff3cd;
    border: 1px solid #ffc107;
    color: #856404;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 0.85rem;
}

@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr;
    }
    .form-row {
        grid-template-columns: 1fr;
    }
    .summary-card {
        position: static;
    }
}
</style>

<div class="checkout-container">
    <h1 class="checkout-title">🛒 Checkout</h1>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="checkout-alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('shop/place-order') ?>" method="post" id="checkout-form">
        <?= csrf_field() ?>

        <div class="checkout-grid">
            <!-- LEFT: Shipping + Payment -->
            <div>
                <!-- Shipping Information -->
                <div class="shipping-card">
                    <h3>📦 Shipping Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" name="shipping_name" value="<?= esc($user['name'] ?? '') ?>" placeholder="ชื่อ-นามสกุลผู้รับ" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" name="shipping_phone" value="<?= esc($user['phone'] ?? '') ?>" placeholder="เบอร์โทรศัพท์" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Shipping Address <span class="required">*</span></label>
                        <textarea name="shipping_address" placeholder="ที่อยู่จัดส่ง (บ้านเลขที่, ซอย, ถนน, ตำบล, อำเภอ, จังหวัด, รหัสไปรษณีย์)" required><?= esc($user['address'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Order Note (Optional)</label>
                        <input type="text" name="shipping_note" placeholder="หมายเหตุเพิ่มเติม (เช่น ส่งช่วงเย็น, วางหน้าบ้าน)">
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="payment-card">
                    <h3>💳 Payment Method</h3>
                    
                    <?php if(!empty($payment_methods)): ?>
                        <?php foreach($payment_methods as $i => $method): ?>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="<?= esc($method['method_name']) ?>" <?= $i === 0 ? 'checked' : '' ?> required>
                                <span><?= esc($method['method_name']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #dc3545; font-size: 0.85rem;">ไม่มีช่องทางชำระเงินที่ใช้งานได้</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- RIGHT: Order Summary -->
            <div class="summary-card">
                <h3>Order Summary (<?= array_sum(array_column($cart, 'quantity')) ?> items)</h3>
                
                <?php foreach($cart as $item): ?>
                    <div class="summary-item">
                        <?php if(!empty($item['image'])): ?>
                            <img src="<?= esc($item['image']) ?>" class="summary-item-img" alt="">
                        <?php else: ?>
                            <div class="summary-item-img-placeholder">VINYL</div>
                        <?php endif; ?>
                        <div class="summary-item-info">
                            <div class="summary-item-name"><?= esc($item['name']) ?></div>
                            <div class="summary-item-qty">Qty: <?= $item['quantity'] ?></div>
                        </div>
                        <div class="summary-item-price">฿<?= number_format($item['price'] * $item['quantity'], 2) ?></div>
                    </div>
                <?php endforeach; ?>

                <div class="summary-row" style="margin-top: 15px;">
                    <span>Subtotal</span>
                    <span>฿<?= number_format($total, 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span style="color: #28a745;">Free</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span class="price">฿<?= number_format($total, 2) ?></span>
                </div>

                <button type="submit" class="btn-confirm">✅ CONFIRM ORDER</button>
                <a href="<?= site_url('shop') ?>" class="back-link">← Back to Shop</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
