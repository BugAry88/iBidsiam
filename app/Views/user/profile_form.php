<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Anti-Gravity Vinyl</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #050510;
            --accent-cyan: #00f3ff;
            --accent-magenta: #bc13fe;
        }
        body {
            background-color: var(--bg-deep);
            color: #fff;
            font-family: 'Rajdhani', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 15px;
            border: 1px solid rgba(0, 243, 255, 0.3);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.15);
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
        }
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: var(--accent-cyan);
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #ccc; }
        input, textarea {
            width: 100%;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid #444;
            color: #fff;
            border-radius: 5px;
            font-family: 'Rajdhani', sans-serif;
        }
        input:focus, textarea:focus { outline: none; border-color: var(--accent-cyan); }
        .btn-save {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, var(--accent-cyan), #00aaff);
            border: none;
            color: #000;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-save:hover { transform: scale(1.02); box-shadow: 0 0 20px rgba(0, 243, 255, 0.5); }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #777; text-decoration: none; }
        .text-error { color: #ff5555; font-size: 0.8rem; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>UPDATE PROFILE</h1>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div style="background: rgba(0,255,0,0.2); border: 1px solid #0f0; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('user/update') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= esc($user['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= esc($user['email']) ?>" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" value="<?= esc($user['phone'] ?? '') ?>" placeholder="081-234-5678">
            </div>

            <div class="form-group">
                <label>Shipping Address</label>
                <textarea name="address" rows="4" placeholder="123/45 Cosmic Rd..."><?= esc($user['address'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn-save">SAVE CHANGES</button>
        </form>
        
        <a href="<?= site_url('user') ?>" class="back-link">Cancel & Return to Dashboard</a>
    </div>
</body>
</html>
