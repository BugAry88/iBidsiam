<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
.pc-container {
    max-width: 600px;
    margin: 40px auto;
    padding: 0 20px 60px;
}

.pc-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 35px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}

.pc-title {
    font-size: 1.3rem;
    color: #333;
    margin: 0 0 5px 0;
}

.pc-subtitle {
    color: #999;
    font-size: 0.85rem;
    margin-bottom: 25px;
}

.pc-order-info {
    background: #f8f9fa;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 18px;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pc-order-info .order-id {
    font-weight: 700;
    color: #333;
}

.pc-order-info .amount {
    font-weight: 800;
    color: #b12704;
    font-size: 1.2rem;
}

.pc-bank-box {
    background: #fffbeb;
    border: 1px solid #fbbf24;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
}

.pc-bank-box h4 {
    margin: 0 0 10px 0;
    color: #92400e;
    font-size: 0.9rem;
}

.pc-bank-box pre {
    margin: 0;
    font-family: inherit;
    font-size: 0.9rem;
    color: #78350f;
    line-height: 1.6;
    white-space: pre-wrap;
}

.pc-upload-area {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    margin-bottom: 20px;
    transition: 0.2s;
    cursor: pointer;
    position: relative;
}

.pc-upload-area:hover {
    border-color: #007bff;
    background: #f8f9ff;
}

.pc-upload-area input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.pc-upload-area .icon {
    font-size: 2rem;
    margin-bottom: 8px;
}

.pc-upload-area .text {
    color: #666;
    font-size: 0.9rem;
}

.pc-upload-area .hint {
    color: #999;
    font-size: 0.75rem;
    margin-top: 5px;
}

.pc-preview {
    display: none;
    max-width: 200px;
    max-height: 200px;
    margin: 10px auto;
    border-radius: 6px;
    border: 1px solid #eee;
}

.pc-form-group {
    margin-bottom: 20px;
}

.pc-form-group label {
    display: block;
    color: #555;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 6px;
}

.pc-form-group label .required {
    color: #dc3545;
}

.pc-form-group input {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    color: #333;
    background: #fafafa;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}

.pc-form-group input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    background: #fff;
}

.pc-form-group .error-msg {
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 5px;
    display: none;
}

.pc-form-group input.is-invalid {
    border-color: #dc3545;
}

.pc-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.pc-btn {
    display: block;
    width: 100%;
    background: #28a745;
    color: #fff;
    border: none;
    padding: 16px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.pc-btn:hover {
    background: #218838;
}

.pc-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.pc-back {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #999;
    font-size: 0.85rem;
    text-decoration: none;
}

.pc-back:hover {
    color: #007bff;
}

.pc-alert {
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 0.85rem;
}

.pc-alert-error {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.pc-alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}
</style>

<div class="pc-container">
    <div class="pc-card">
        <h1 class="pc-title">💳 แจ้งชำระเงิน</h1>
        <p class="pc-subtitle">อัพโหลดหลักฐานการชำระเงินสำหรับคำสั่งซื้อของคุณ</p>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="pc-alert pc-alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Order Info -->
        <div class="pc-order-info">
            <span class="order-id">Order #<?= $order['id'] ?></span>
            <span class="amount">฿<?= number_format($order['total_amount'], 2) ?></span>
        </div>

        <!-- Bank Details -->
        <?php if(!empty($bank_details)): ?>
        <div class="pc-bank-box">
            <h4>🏦 โอนเงินไปยังบัญชี</h4>
            <pre><?= esc($bank_details) ?></pre>
        </div>
        <?php endif; ?>

        <!-- Upload Form -->
        <form action="<?= site_url('payment-confirm/' . $order['id']) ?>" method="post" enctype="multipart/form-data" id="payment-form">
            <?= csrf_field() ?>

            <div class="pc-form-row">
                <div class="pc-form-group">
                    <label>จำนวนเงินที่โอน <span class="required">*</span></label>
                    <input type="number" name="payment_amount" id="payment-amount" step="0.01" min="<?= $order['total_amount'] ?>" placeholder="฿<?= number_format($order['total_amount'], 2) ?>" required>
                    <div class="error-msg" id="amount-error">จำนวนเงินต้องไม่น้อยกว่า ฿<?= number_format($order['total_amount'], 2) ?></div>
                </div>
                <div class="pc-form-group">
                    <label>วันที่ / เวลาที่โอน <span class="required">*</span></label>
                    <input type="datetime-local" name="payment_datetime" id="payment-datetime" required>
                </div>
            </div>

            <div class="pc-upload-area" id="upload-area">
                <input type="file" name="payment_proof" id="file-input" accept="image/*" required>
                <div class="icon">📷</div>
                <div class="text">Click to upload payment slip</div>
                <div class="hint">JPG, PNG (Max 5MB)</div>
            </div>
            
            <img id="preview" class="pc-preview" alt="Preview">

            <button type="submit" class="pc-btn" id="submit-btn">✅ ยืนยันการชำระเงิน</button>
        </form>

        <a href="<?= site_url('user/order/' . $order['id']) ?>" class="pc-back">← กลับไปหน้ารายละเอียดคำสั่งซื้อ</a>
    </div>
</div>

<script>
const minAmount = <?= $order['total_amount'] ?>;
const amountInput = document.getElementById('payment-amount');
const amountError = document.getElementById('amount-error');
const submitBtn = document.getElementById('submit-btn');

// Set default datetime to now (24h format handled by browser)
const now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById('payment-datetime').value = now.toISOString().slice(0, 16);

// Validate amount
amountInput.addEventListener('input', function() {
    const val = parseFloat(this.value);
    if (val < minAmount) {
        this.classList.add('is-invalid');
        amountError.style.display = 'block';
    } else {
        this.classList.remove('is-invalid');
        amountError.style.display = 'none';
    }
});

// Prevent form submit if amount is invalid
document.getElementById('payment-form').addEventListener('submit', function(e) {
    const val = parseFloat(amountInput.value);
    if (isNaN(val) || val < minAmount) {
        e.preventDefault();
        amountInput.classList.add('is-invalid');
        amountError.style.display = 'block';
        amountInput.focus();
    }
});

// File preview
document.getElementById('file-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const preview = document.getElementById('preview');
            preview.src = ev.target.result;
            preview.style.display = 'block';
            document.querySelector('.pc-upload-area .text').textContent = file.name;
            document.querySelector('.pc-upload-area .icon').textContent = '✅';
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?= $this->endSection() ?>
