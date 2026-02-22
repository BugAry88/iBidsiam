<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดคำสั่งซื้อ #<?= $order['id'] ?></title>
    <style>
        body {
            background-color: #050505;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #111;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #333;
        }
        h2 { color: #00ffff; margin-top: 0; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .meta { margin-bottom: 20px; color: #aaa; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1a1a1a;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #333;
            text-align: left;
        }
        th { color: #bc13fe; }
        .total-row { font-weight: bold; font-size: 1.2rem; }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            border: 1px solid #fff;
            padding: 8px 15px;
            border-radius: 4px;
        }
        .btn-back:hover { background: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order #<?= $order['id'] ?></h2>
        <div class="meta" style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p><strong>วันที่สั่งซื้อ:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                <p><strong>สถานะปัจจุบัน:</strong> <span style="color: #0f0; font-weight: bold;"><?= ucfirst($order['status']) ?></span></p>
                <hr style="border-color: #333;">
                <h3 style="color: var(--accent-cyan); margin-bottom: 10px;">ข้อมูลลูกค้า</h3>
                <?php if($order['user_id']): ?>
                    <p><strong>ชื่อ:</strong> <?= esc($order['customer_name'] ?? 'Unknown') ?></p>
                    <p><strong>Email:</strong> <?= esc($order['customer_email']) ?></p>
                    <p><strong>เบอร์โทร:</strong> <?= esc($order['customer_phone'] ?? '-') ?></p>
                    <p><strong>ที่อยู่จัดส่ง:</strong><br><?= nl2br(esc($order['customer_address'] ?? '-')) ?></p>
                <?php else: ?>
                    <p><em>สั่งซื้อโดยไม่ล็อกอิน (Guest)</em></p>
                <?php endif; ?>
                <?php if(!empty($order['payment_proof'])): ?>
                    <hr style="border-color: #333;">
                    <h3 style="color: var(--accent-cyan); margin-bottom: 10px;">หลักฐานการชำระเงิน</h3>
                    <p><strong>วันที่โอน:</strong> <?= $order['payment_date'] ?></p>
                    <a href="<?= base_url($order['payment_proof']) ?>" target="_blank">
                        <img src="<?= base_url($order['payment_proof']) ?>" style="max-width: 100%; border: 1px solid #555; border-radius: 4px;" alt="Payment Proof">
                    </a>
                <?php endif; ?>
            </div>
            
            <div style="background: #222; padding: 20px; border-radius: 8px; border: 1px solid #444;">
                <h3 style="margin-top: 0; color: #fff;">อัปเดตสถานะ</h3>
                <form action="<?= site_url('admin/order/update-status') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <select name="status" style="padding: 10px; width: 100%; margin-bottom: 10px; background: #000; color: #fff; border: 1px solid #555;">
                        <?php 
                            $statuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];
                            foreach($statuses as $s): 
                        ?>
                            <option value="<?= $s ?>" <?= $order['status'] == $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" style="width: 100%; padding: 10px; background: var(--accent-cyan); border: none; font-weight: bold; cursor: pointer;">บันทึกสถานะ</button>
                </form>
            </div>
        </div>

        <h3>รายการสินค้า</h3>
        <table>
            <thead>
                <tr>
                    <th>สินค้า</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวน</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?= esc($item['product_name']) ?></td>
                    <td>฿<?= number_format($item['price'], 2) ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td>฿<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">ยอดรวมทั้งสิ้น:</td>
                    <td>฿<?= number_format($order['total_amount'], 2) ?></td>
                </tr>
            </tbody>
        </table>

        <a href="<?= site_url('admin/dashboard') ?>" class="btn-back">&larr; กลับหน้า Dashboard</a>
    </div>
</body>
</html>
