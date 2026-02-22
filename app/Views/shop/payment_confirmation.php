<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container" style="max-width: 600px; margin-top: 50px;">
    <h1 style="text-align: center; color: var(--accent-cyan); text-transform: uppercase; letter-spacing: 2px;">แจ้งชำระเงิน</h1>
    
    <div class="card" style="background: #1a1a1a; padding: 30px; border-radius: 10px; border: 1px solid #333; box-shadow: 0 0 20px rgba(0,0,0,0.5);">
        
        <?php if(session()->getFlashdata('error')): ?>
            <div style="background: rgba(255,0,0,0.2); border: 1px solid red; color: #fff; padding: 10px; margin-bottom: 20px; text-align: center;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('shop/payment-submit') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="order_id" value="<?= esc($order_id) ?>">

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #ccc; margin-bottom: 5px;">Order ID</label>
                <input type="text" value="#<?= esc($order_id) ?>" readonly style="width: 100%; padding: 10px; background: #333; border: 1px solid #555; color: #aaa; cursor: not-allowed;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #ccc; margin-bottom: 5px;">วันที่โอน</label>
                <input type="date" name="payment_date" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #ccc; margin-bottom: 5px;">เวลาที่โอน (24 ชม.)</label>
                <input type="time" name="payment_time" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #ccc; margin-bottom: 5px;">ยอดเงินที่โอน</label>
                <input type="number" step="0.01" name="amount" required placeholder="0.00" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; color: #ccc; margin-bottom: 5px;">แนบสลิปหลักฐาน</label>
                <input type="file" name="payment_proof" accept="image/*" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff;">
            </div>

            <button type="submit" class="btn" style="width: 100%; background: var(--accent-cyan); color: #000; border: none; padding: 15px; font-weight: bold; font-size: 1.1rem; cursor: pointer; transition: 0.3s;">
                ยืนยันการแจ้งชำระเงิน
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
