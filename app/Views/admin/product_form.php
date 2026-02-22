<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Mission Control</title>
    <style>
        :root {
            --bg-color: #0b0b0b;
            --text-color: #e0e0e0;
            --cyan: #00ffcc;
            --magenta: #ff00cc;
            --panel-bg: #111;
        }
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-panel {
            background: var(--panel-bg);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            border: 1px solid #333;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
            position: relative;
        }
        .form-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--cyan), var(--magenta));
        }
        h2 { margin-top: 0; color: #fff; text-transform: uppercase; letter-spacing: 1px; }
        label { display: block; margin-bottom: 8px; color: var(--cyan); font-size: 0.9rem; font-weight: bold; }
        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            background: #000;
            border: 1px solid #333;
            color: #fff;
            box-sizing: border-box;
            font-family: inherit;
        }
        input:focus, textarea:focus { border-color: var(--cyan); outline: none; }
        .btn {
            width: 100%;
            padding: 15px;
            background: var(--cyan);
            color: #000;
            border: none;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { background: #fff; box-shadow: 0 0 20px var(--cyan); }
        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #777;
            text-decoration: none;
        }
        .btn-cancel:hover { color: #fff; }
        .errors {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff4444;
            padding: 10px;
            margin-bottom: 20px;
            color: #ff4444;
            list-style: none;
        }
        .current-img { margin-bottom: 20px; text-align: center; }
        .current-img img { max-width: 150px; border: 1px solid #333; }
    </style>
</head>
<body>
    <div class="form-panel">
        <h2><?= esc($title) ?></h2>
        
        <?php if(session()->has('errors')): ?>
            <ul class="errors">
                <?php foreach(session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>

        <form action="<?= site_url('admin/products/' . $action) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <label>Product Name</label>
            <input type="text" name="name" value="<?= old('name', $product['name'] ?? '') ?>" required>

            <label>Price (THB)</label>
            <input type="number" name="price" step="0.01" value="<?= old('price', $product['price'] ?? '') ?>" required>

            <div style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="<?= old('quantity', $product['quantity'] ?? 0) ?>" required>
                </div>
                <div style="flex: 1;">
                    <label>Status</label>
                    <select name="status" style="width: 100%; padding: 12px; background: #000; border: 1px solid #333; color: #fff;">
                        <?php 
                            $status = old('status', $product['status'] ?? 'in_stock');
                            $options = [
                                'in_stock'       => 'In Stock',
                                'out_of_stock'   => 'Out of Stock',
                                'pre_order'      => 'Pre-Order',
                                'available_order'=> 'Available to Order'
                            ];
                        ?>
                        <?php foreach($options as $val => $label): ?>
                            <option value="<?= $val ?>" <?= $status == $val ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">หมวดหมู่ / แนวเพลง (Category)</label>
                <input type="text" class="form-control" name="genre" list="genreList" value="<?= old('genre', $product['genre'] ?? '') ?>" placeholder="ระบุหรือเลือกหมวดหมู่" style="background: #222; border: 1px solid #444; color: #fff;">
                <datalist id="genreList">
                    <?php if(isset($genres)): foreach($genres as $g): ?>
                        <option value="<?= esc($g) ?>">
                    <?php endforeach; endif; ?>
                </datalist>
            </div>

            <div class="mb-3">
                <label for="brand" class="form-label">ยี่ห้อ / แบรนด์ (Brand)</label>
                <input type="text" class="form-control" name="brand" list="brandList" value="<?= old('brand', $product['brand'] ?? '') ?>" placeholder="ระบุหรือเลือกยี่ห้อ" style="background: #222; border: 1px solid #444; color: #fff;">
                <datalist id="brandList">
                    <?php if(isset($brands)): foreach($brands as $b): ?>
                        <option value="<?= esc($b) ?>">
                    <?php endforeach; endif; ?>
                </datalist>
            </div>

            <label>Description</label>
            <textarea name="description" rows="4"><?= old('description', $product['description'] ?? '') ?></textarea>

            <label>Cover Image</label>
            <?php if(isset($product['image']) && $product['image']): ?>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="<?= site_url('admin/dashboard') ?>">Overview</a></li>
                    <li class="nav-item"><a href="<?= site_url('admin/products') ?>" class="active">Products Management</a></li>
                    <li class="nav-item"><a href="<?= site_url('admin/orders') ?>">Orders Management</a></li>
                    <li class="nav-item"><a href="<?= site_url('admin/customers') ?>">Customers Management</a></li>
                    <li class="nav-item"><a href="<?= site_url('admin/payment-settings') ?>">Payment Settings</a></li>
                    <li class="nav-item"><a href="<?= site_url('admin/email-settings') ?>">Email Settings</a></li>
                    <li class="nav-item"><a href="<?= site_url('shop') ?>" target="_blank">View Storefront</a></li>
                </ul>
            <?php endif; ?>
            <?php if(isset($product) && !$product['image']): ?>
                <small style="display:block; margin-top:-15px; margin-bottom:15px; color: #555;">(Optional if updating text only)</small>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*">

            <button type="submit" class="btn">Save Record</button>
            <a href="<?= site_url('admin/products') ?>" class="btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
