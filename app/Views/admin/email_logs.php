<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Logs - Admin</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <style>
        .logs-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .logs-table {
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logs-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .logs-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        .logs-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        .logs-table tr:hover {
            background: #f8f9fa;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-sent {
            background: #d4edda;
            color: #155724;
        }
        .status-failed {
            background: #f8d7da;
            color: #721c24;
        }
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .filter-section select,
        .filter-section input {
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            margin-right: 10px;
        }
        .btn-filter {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-filter:hover {
            background: #5568d3;
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
            <li class="nav-item"><a href="<?= site_url('admin/email-settings') ?>">Email Settings</a></li>
            <li class="nav-item"><a href="<?= site_url('admin/email-logs') ?>" class="active">Email Logs</a></li>
            <li class="nav-item"><a href="<?= site_url('shop') ?>" target="_blank">View Storefront</a></li>
        </ul>
        <div style="margin-top: auto; padding: 20px;">
             <p style="color: #adb5bd; font-size: 0.8rem;">Logged in as: <strong><?= session('user_name') ?? 'Admin' ?></strong></p>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h2>📧 ประวัติการส่งอีเมล์</h2>
            <div>
                <a href="<?= site_url('admin/email-settings') ?>" class="btn-action">⚙️ Email Settings</a>
            </div>
        </div>

        <div class="logs-container">
            <!-- Filter Section -->
            <div class="filter-section">
                <form method="get" action="<?= site_url('admin/email-logs') ?>">
                    <select name="status">
                        <option value="">ทั้งหมด</option>
                        <option value="sent" <?= ($filter_status ?? '') == 'sent' ? 'selected' : '' ?>>ส่งสำเร็จ</option>
                        <option value="failed" <?= ($filter_status ?? '') == 'failed' ? 'selected' : '' ?>>ส่งไม่สำเร็จ</option>
                    </select>
                    <input type="date" name="date" value="<?= $filter_date ?? '' ?>" placeholder="เลือกวันที่">
                    <button type="submit" class="btn-filter">🔍 กรอง</button>
                    <a href="<?= site_url('admin/email-logs') ?>" class="btn-filter" style="background: #6c757d; text-decoration: none;">รีเซ็ต</a>
                </form>
            </div>

            <!-- Stats -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4 style="margin: 0 0 10px 0; color: #64748b;">ทั้งหมด</h4>
                    <p style="font-size: 2rem; font-weight: bold; margin: 0; color: #667eea;"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4 style="margin: 0 0 10px 0; color: #64748b;">ส่งสำเร็จ</h4>
                    <p style="font-size: 2rem; font-weight: bold; margin: 0; color: #28a745;"><?= $stats['sent'] ?? 0 ?></p>
                </div>
                <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4 style="margin: 0 0 10px 0; color: #64748b;">ส่งไม่สำเร็จ</h4>
                    <p style="font-size: 2rem; font-weight: bold; margin: 0; color: #dc3545;"><?= $stats['failed'] ?? 0 ?></p>
                </div>
            </div>

            <!-- Logs Table -->
            <div class="logs-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ผู้รับ</th>
                            <th>หัวข้อ</th>
                            <th>เทมเพลต</th>
                            <th>สถานะ</th>
                            <th>วันที่ส่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td>#<?= $log['id'] ?></td>
                                    <td><?= esc($log['recipient']) ?></td>
                                    <td><?= esc($log['subject']) ?></td>
                                    <td><code><?= esc($log['template']) ?></code></td>
                                    <td>
                                        <span class="status-badge status-<?= $log['status'] ?>">
                                            <?= $log['status'] == 'sent' ? '✅ ส่งสำเร็จ' : '❌ ส่งไม่สำเร็จ' ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($log['sent_at'] ?? $log['created_at'])) ?></td>
                                </tr>
                                <?php if ($log['status'] == 'failed' && !empty($log['error_message'])): ?>
                                    <tr>
                                        <td colspan="6" style="background: #fff3cd; padding: 10px;">
                                            <strong>ข้อผิดพลาด:</strong> <?= esc($log['error_message']) ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                    ไม่มีประวัติการส่งอีเมล์
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (isset($pager)): ?>
                <div style="margin-top: 20px; text-align: center;">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
