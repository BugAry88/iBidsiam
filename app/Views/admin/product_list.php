<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <h1>CONTROL DECK</h1>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="<?= site_url('admin/dashboard') ?>">Overview</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/products') ?>" class="active">Products Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/orders') ?>">Orders Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/customers') ?>">Customers Management</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/payment-settings') ?>">Payment Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/email-settings') ?>">Email Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('shop') ?>" target="_blank">View Storefront</a></li>
        </ul>
        <div style="margin-top: auto; padding: 20px;">
             <p style="color: #adb5bd; font-size: 0.8rem;">Logged in as: <strong><?= session('user_name') ?? 'Admin' ?></strong></p>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h2>Product Inventory</h2>
            <div>
                <a href="<?= site_url('admin/dashboard') ?>" class="btn-action" style="margin-right: 10px;">&larr; Dashboard</a>
                <button onclick="document.getElementById('csvModal').style.display='flex'" class="btn-action" style="margin-right: 10px; background: #28a745; color: #fff; border: 1px solid #28a745; cursor: pointer;">📄 Import CSV</button>
                <a href="<?= site_url('admin/products/create') ?>" class="btn-primary">+ New Product</a>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Genre</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($products)): ?>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td>#<?= esc($product['id']) ?></td>
                            <td>
                                <?php if($product['image']): ?>
                                    <img src="<?= esc($product['image']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                <?php else: ?>
                                    <span style="color: #999;">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong style="display: block; color: var(--admin-blue);"><?= esc($product['name']) ?></strong>
                                <small style="color: #777;"><?= character_limiter(esc($product['description']), 50) ?></small>
                            </td>
                            <td style="font-weight: bold;">฿<?= number_format($product['price'], 2) ?></td>
                            <td><?= $product['quantity'] ?></td>
                            <td>
                                <?php if($product['status'] == 'in_stock'): ?>
                                    <span class="status-badge status-paid">In Stock</span>
                                <?php elseif($product['status'] == 'out_of_stock'): ?>
                                    <span class="status-badge status-cancelled">Out of Stock</span>
                                <?php elseif($product['status'] == 'pre_order'): ?>
                                    <span class="status-badge status-pending">Pre-Order</span>
                                <?php else: ?>
                                    <span class="status-badge status-shipped">Order</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($product['genre'] ?? '-') ?></td>
                            <td><?= esc($product['brand'] ?? '-') ?></td>
                            <td>
                                <a href="<?= site_url('admin/products/edit/'.$product['id']) ?>" class="btn-warning">Edit</a>
                                <a href="<?= site_url('admin/products/delete/'.$product['id']) ?>" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9">No products found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- CSV Import Modal -->
    <div id="csvModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: #fff; border-radius: 12px; padding: 35px; width: 520px; max-width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative;">
            <!-- Close Button -->
            <button onclick="document.getElementById('csvModal').style.display='none'" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999;">&times;</button>
            
            <h2 style="margin: 0 0 5px 0; color: #333; font-size: 1.3rem;">📄 Import Products from CSV</h2>
            <p style="margin: 0 0 25px 0; color: #999; font-size: 0.85rem;">Upload a CSV file to bulk-add products to your inventory.</p>

            <form action="<?= site_url('admin/products/import-csv') ?>" method="post" enctype="multipart/form-data" id="csvForm">
                <?= csrf_field() ?>
                
                <!-- Drop Zone -->
                <div id="dropZone" style="border: 2px dashed #007bff; border-radius: 8px; padding: 40px 20px; text-align: center; margin-bottom: 20px; cursor: pointer; transition: 0.2s; background: #f8f9ff;">
                    <div id="dropText">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">📁</div>
                        <p style="margin: 0; color: #333; font-weight: 600;">Drag & Drop CSV file here</p>
                        <p style="margin: 5px 0 0 0; color: #999; font-size: 0.8rem;">or click to browse files</p>
                    </div>
                    <div id="fileInfo" style="display: none;">
                        <div style="font-size: 2rem; margin-bottom: 10px;">✅</div>
                        <p id="fileName" style="margin: 0; color: #28a745; font-weight: 600;"></p>
                        <p id="fileSize" style="margin: 5px 0 0 0; color: #999; font-size: 0.8rem;"></p>
                    </div>
                    <input type="file" name="csv_file" id="csvFileInput" accept=".csv,.txt" style="display: none;" required>
                </div>

                <!-- Column Format Reference -->
                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px; margin-bottom: 20px;">
                    <h4 style="margin: 0 0 10px 0; color: #333; font-size: 0.85rem;">📋 CSV Column Format</h4>
                    <table style="width: 100%; font-size: 0.75rem; border-collapse: collapse;">
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 4px 8px; font-weight: bold; color: #495057;">name *</td>
                            <td style="padding: 4px 8px; color: #6c757d;">Product name</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 4px 8px; font-weight: bold; color: #495057;">price *</td>
                            <td style="padding: 4px 8px; color: #6c757d;">Price (number)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 4px 8px; color: #495057;">description</td>
                            <td style="padding: 4px 8px; color: #6c757d;">Product description</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 4px 8px; color: #495057;">image</td>
                            <td style="padding: 4px 8px; color: #6c757d;">Image URL</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 4px 8px; color: #495057;">quantity</td>
                            <td style="padding: 4px 8px; color: #6c757d;">Stock quantity (default: 0)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 4px 8px; color: #495057;">status</td>
                            <td style="padding: 4px 8px; color: #6c757d;">in_stock / out_of_stock / pre_order</td>
                        </tr>
                        <tr>
                            <td style="padding: 4px 8px; color: #495057;">genre</td>
                            <td style="padding: 4px 8px; color: #6c757d;">Genre category</td>
                        </tr>
                    </table>
                    <p style="margin: 10px 0 0 0; font-size: 0.75rem; color: #999;">* = required column</p>
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="submit" id="importBtn" style="flex: 1; background: #007bff; color: #fff; border: none; padding: 12px; border-radius: 6px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: 0.2s;" disabled>Import Products</button>
                    <a href="<?= site_url('admin/products/sample-csv') ?>" style="color: #007bff; font-size: 0.8rem; white-space: nowrap; text-decoration: none;" title="Download sample">⬇️ Sample CSV</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Drag & Drop + File Select
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('csvFileInput');
    const dropText = document.getElementById('dropText');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const importBtn = document.getElementById('importBtn');

    dropZone.addEventListener('click', () => fileInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#28a745';
        dropZone.style.background = '#f0fff0';
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.style.borderColor = '#007bff';
        dropZone.style.background = '#f8f9ff';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#28a745';
        dropZone.style.background = '#f0fff0';
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            showFileInfo(e.dataTransfer.files[0]);
        }
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length) {
            showFileInfo(fileInput.files[0]);
        }
    });

    function showFileInfo(file) {
        dropText.style.display = 'none';
        fileInfo.style.display = 'block';
        fileName.textContent = file.name;
        fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
        importBtn.disabled = false;
        importBtn.style.background = '#28a745';
    }
    </script>

</body>
</html>
