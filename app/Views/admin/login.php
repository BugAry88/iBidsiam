<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบจัดการร้าน - Admin Login</title>
    <style>
        body {
            background-color: #050505;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: #111;
            padding: 40px;
            border: 1px solid #333;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 { color: #00ffff; margin-bottom: 30px; text-transform: uppercase; }
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            background: #222;
            border: 1px solid #444;
            color: #fff;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #bc13fe;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }
        button:hover { background: #d049ff; }
        .error { color: #ff4444; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Access</h2>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= site_url('admin/auth') ?>" method="post">
            <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
            <input type="password" name="password" placeholder="รหัสผ่าน" required>
            <button type="submit">เข้าสู่ระบบ</button>
        </form>
        <p style="margin-top: 20px; font-size: 0.8rem; color: #666;">
            <a href="<?= site_url('shop') ?>" style="color: #666; text-decoration: none;">&larr; กลับไปหน้าร้านค้า</a>
        </p>
    </div>
</body>
</html>
