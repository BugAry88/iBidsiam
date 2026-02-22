<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Anti-Gravity Vinyl</title>
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
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: var(--accent-cyan);
            border-bottom: 2px solid var(--accent-magenta);
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .welcome-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 1px solid #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }
        th {
            color: var(--accent-magenta);
            text-transform: uppercase;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .badge-pending { background: #ffaa00; color: #000; }
        .badge-completed { background: #00ffaa; color: #000; }
        .btn-shop {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: var(--accent-cyan);
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>COMMAND CENTER</h1>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div style="background: rgba(0,255,0,0.2); border: 1px solid #0f0; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="welcome-box" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Welcome back, <?= esc(session()->get('user_name')) ?></h2>
                <p>Here is the log of your intergalactic acquisitions.</p>
            </div>
            <a href="<?= site_url('user/profile') ?>" style="padding: 10px 20px; background: transparent; border: 1px solid var(--accent-cyan); color: var(--accent-cyan); text-decoration: none; border-radius: 5px; transition: 0.3s;">EDIT PROFILE</a>
        </div>

        <h3>Order History</h3>
        <?php if(empty($orders)): ?>
            <p style="color: #777;">No orders found in this quadrant.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td>
                                <a href="<?= site_url('user/order/'.$order['id']) ?>" style="color: var(--accent-cyan); text-decoration: none; font-weight: bold;">
                                    #<?= $order['id'] ?>
                                </a>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                            <td style="color: var(--accent-cyan);">฿<?= number_format($order['total_amount'], 2) ?></td>
                            <td>
                                <span class="badge badge-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="<?= site_url('shop') ?>" class="btn-shop">RETURN TO SHOP</a>
        <a href="<?= site_url('logout') ?>" style="color: #ff4444; margin-left: 20px; text-decoration: none;">LOGOUT</a>
    </div>
</body>
</html>
