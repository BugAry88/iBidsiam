<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Settings - Admin</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <style>
        .settings-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .settings-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .settings-card h3 {
            margin-top: 0;
            color: #2d3748;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #4a5568;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .form-group small {
            display: block;
            margin-top: 5px;
            color: #718096;
            font-size: 12px;
        }
        .btn-save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 16px;
            transition: transform 0.2s;
        }
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        .btn-test {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }
        .btn-test:hover {
            background: #218838;
        }
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .info-box h4 {
            margin: 0 0 10px 0;
            color: #1976d2;
        }
        .test-email-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <h1>CONTROL DECK</h1>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="<?= site_url('admin/dashboard') ?>">Overview</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/products') ?>">Products Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/orders') ?>">Orders Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/customers') ?>">Customers Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/payment-settings') ?>">Payment Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/email-settings') ?>" class="active">Email Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('shop') ?>" target="_blank">View Storefront</a></li>
        </ul>
        <div style="margin-top: auto; padding: 20px;">
             <p style="color: #adb5bd; font-size: 0.8rem;">Logged in as: <strong><?= session('user_name') ?? 'Admin' ?></strong></p>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h2>📧 Email Settings</h2>
            <div>
                <a href="<?= site_url('admin/dashboard') ?>" class="btn-action">&larr; Dashboard</a>
            </div>
        </div>

        <div class="settings-container">
            <?php if (session()->get('success')): ?>
                <div class="alert alert-success">
                    ✅ <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('error')): ?>
                <div class="alert alert-error">
                    ❌ <?= session()->get('error') ?>
                </div>
            <?php endif; ?>

            <div class="info-box">
                <h4>📌 คู่มือการตั้งค่าอีเมล์</h4>
                <p style="margin: 5px 0;">ตั้งค่า SMTP เพื่อเปิดใช้งานการแจ้งเตือนทางอีเมล์สำหรับออเดอร์ การชำระเงิน และการสื่อสารกับลูกค้า</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>ใช้ข้อมูล SMTP server ของ hosting ของคุณ</li>
                    <li>Port 587 แนะนำสำหรับการเข้ารหัส TLS</li>
                    <li>Port 465 สำหรับการเข้ารหัส SSL</li>
                    <li>ทดสอบการตั้งค่าก่อนเปิดใช้งานจริง</li>
                </ul>
            </div>

            <form action="<?= site_url('admin/email-settings/update') ?>" method="post">
                
                <!-- SMTP Configuration -->
                <div class="settings-card">
                    <h3>🔧 การตั้งค่า SMTP Server</h3>
                    
                    <div class="form-group">
                        <label for="smtp_host">SMTP Host (โฮสต์) *</label>
                        <input type="text" id="smtp_host" name="smtp_host" 
                               value="<?= $settings['smtp_host'] ?? 'mail.yourdomain.com' ?>" 
                               placeholder="mail.yourdomain.com" required>
                        <small>ที่อยู่ SMTP server ของ hosting (เช่น mail.yourdomain.com)</small>
                    </div>

                    <div class="form-group">
                        <label for="smtp_port">SMTP Port (พอร์ต) *</label>
                        <input type="number" id="smtp_port" name="smtp_port" 
                               value="<?= $settings['smtp_port'] ?? '587' ?>" 
                               placeholder="587" required>
                        <small>พอร์ตที่ใช้บ่อย: 587 (TLS), 465 (SSL), 25 (ไม่เข้ารหัส)</small>
                    </div>

                    <div class="form-group">
                        <label for="smtp_crypto">วิธีการเข้ารหัส *</label>
                        <select id="smtp_crypto" name="smtp_crypto" required>
                            <option value="tls" <?= ($settings['smtp_crypto'] ?? 'tls') == 'tls' ? 'selected' : '' ?>>TLS (แนะนำ)</option>
                            <option value="ssl" <?= ($settings['smtp_crypto'] ?? '') == 'ssl' ? 'selected' : '' ?>>SSL</option>
                            <option value="" <?= ($settings['smtp_crypto'] ?? '') == '' ? 'selected' : '' ?>>ไม่มี</option>
                        </select>
                        <small>แนะนำ TLS สำหรับพอร์ต 587, SSL สำหรับพอร์ต 465</small>
                    </div>

                    <div class="form-group">
                        <label for="smtp_user">SMTP Username (ชื่อผู้ใช้) *</label>
                        <input type="text" id="smtp_user" name="smtp_user" 
                               value="<?= $settings['smtp_user'] ?? 'noreply@ibidsiam.com' ?>" 
                               placeholder="noreply@yourdomain.com" required>
                        <small>ที่อยู่อีเมล์สำหรับยืนยันตัวตน SMTP</small>
                    </div>

                    <div class="form-group">
                        <label for="smtp_pass">SMTP Password (รหัสผ่าน) *</label>
                        <input type="password" id="smtp_pass" name="smtp_pass" 
                               value="<?= $settings['smtp_pass'] ?? '' ?>" 
                               placeholder="กรอกรหัสผ่าน SMTP">
                        <small>รหัสผ่านบัญชีอีเมล์ของคุณ</small>
                    </div>
                </div>

                <!-- Email Sender Configuration -->
                <div class="settings-card">
                    <h3>📨 ข้อมูลผู้ส่งอีเมล์</h3>
                    
                    <div class="form-group">
                        <label for="from_email">อีเมล์ผู้ส่ง *</label>
                        <input type="email" id="from_email" name="from_email" 
                               value="<?= $settings['from_email'] ?? 'noreply@ibidsiam.com' ?>" 
                               placeholder="noreply@ibidsiam.com" required>
                        <small>ที่อยู่อีเมล์ที่จะแสดงเป็นผู้ส่ง</small>
                    </div>

                    <div class="form-group">
                        <label for="from_name">ชื่อผู้ส่ง *</label>
                        <input type="text" id="from_name" name="from_name" 
                               value="<?= $settings['from_name'] ?? 'IBidSiam Vinyl Shop' ?>" 
                               placeholder="IBidSiam Vinyl Shop" required>
                        <small>ชื่อที่จะแสดงเป็นผู้ส่ง</small>
                    </div>

                    <div class="form-group">
                        <label for="admin_email">อีเมล์แอดมิน *</label>
                        <input type="email" id="admin_email" name="admin_email" 
                               value="<?= $settings['admin_email'] ?? 'admin@ibidsiam.com' ?>" 
                               placeholder="admin@ibidsiam.com" required>
                        <small>อีเมล์สำหรับรับการแจ้งเตือนแอดมิน (ออเดอร์ใหม่, การชำระเงิน, ฯลฯ)</small>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <button type="submit" class="btn-save">💾 บันทึกการตั้งค่าอีเมล์</button>
                </div>
            </form>

            <!-- Test Email Section -->
            <div class="settings-card">
                <h3>🧪 ทดสอบการตั้งค่าอีเมล์</h3>
                <p>ส่งอีเมล์ทดสอบเพื่อตรวจสอบว่าการตั้งค่า SMTP ทำงานได้ถูกต้อง</p>
                
                <form action="<?= site_url('admin/email-settings/test') ?>" method="post" class="test-email-section">
                    <div class="form-group">
                        <label for="test_email">อีเมล์สำหรับทดสอบ</label>
                        <input type="email" id="test_email" name="test_email" 
                               placeholder="your-email@example.com" required>
                        <small>กรอกอีเมล์ที่ต้องการรับอีเมล์ทดสอบ</small>
                    </div>
                    <button type="submit" class="btn-test">📧 ส่งอีเมล์ทดสอบ</button>
                </form>
            </div>

            <!-- Email Templates Info -->
            <div class="settings-card">
                <h3>📄 เทมเพลตอีเมล์</h3>
                <p>เทมเพลตอีเมล์ที่ตั้งค่าไว้:</p>
                <ul style="line-height: 2;">
                    <li><strong>การแจ้งเตือนแอดมิน:</strong>
                        <ul style="margin-left: 20px;">
                            <li>✅ แจ้งเตือนออเดอร์ใหม่</li>
                            <li>✅ แจ้งเตือนรับชำระเงิน</li>
                            <li>✅ แจ้งเตือนสต็อกต่ำ</li>
                        </ul>
                    </li>
                    <li><strong>การแจ้งเตือนลูกค้า:</strong>
                        <ul style="margin-left: 20px;">
                            <li>✅ ยืนยันการสั่งซื้อ</li>
                            <li>✅ อัพเดทสถานะออเดอร์</li>
                            <li>✅ แจ้งเตือนการจัดส่ง</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </main>

</body>
</html>
