<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Admin extends BaseController
{
    public function index()
    {
        return redirect()->to('admin/login');
    }

    public function login()
    {
        if (session()->get('is_admin')) {
            return redirect()->to('admin/dashboard');
        }
        return view('admin/login');
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Prototype: Hardcoded check or Simple DB check
        // For prototype speed, let's use a simple hardcoded check first or DB if prefered.
        // Let's use DB as per plan, but for now simple check to get it running fast.
        // Actually, let's stick to the plan: users table.
        
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $user = $builder->where('username', $username)->get()->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] !== 'admin') {
                return redirect()->back()->with('error', 'ไม่มีสิทธิ์เข้าถึง (Access Denied)');
            }
            session()->set([
                'is_admin'   => true,
                'admin_id'   => $user['id'],
                'admin_name' => $user['username'],
            ]);
            return redirect()->to('admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        }
    }

    public function dashboard()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('admin/login');
        }

        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $data['products'] = $productModel->findAll();
        $data['orders']   = $orderModel->orderBy('created_at', 'DESC')->findAll();

        // Dashboard Stats
        $data['total_products'] = $productModel->countAll();
        $data['total_orders']   = $orderModel->countAll();
        
        // Calculate Total Revenue (Completed/Paid orders only ideally, but for now all non-cancelled)
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SUM(total_amount) as total FROM orders WHERE status != 'cancelled'");
        $row = $query->getRow();
        $data['total_revenue'] = $row->total ?? 0;

        // Count pending orders
        $data['pending_orders'] = $orderModel->where('status', 'pending')->countAllResults();

        return view('admin/dashboard', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }

    public function orders()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $orderModel = new OrderModel();
        
        // Get all orders with customer info
        $data['orders'] = $orderModel->select('orders.*, users.name as customer_name, users.email as customer_email')
                                    ->join('users', 'users.id = orders.user_id', 'left')
                                    ->orderBy('orders.created_at', 'DESC')
                                    ->findAll();

        return view('admin/orders', $data);
    }

    public function customers()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $orderModel = new OrderModel();
        $db = \Config\Database::connect();
        
        $customers = [];
        
        try {
            // First, get registered customers from users table who have orders
            $builder = $db->table('orders');
            $registeredCustomers = $builder->select('
                    users.id as user_id,
                    users.name as customer_name,
                    users.email as customer_email,
                    users.phone as customer_phone,
                    users.address as customer_address,
                    COUNT(orders.id) as total_orders,
                    COALESCE(SUM(orders.total_amount), 0) as total_spent,
                    MAX(orders.created_at) as last_order_date
                ')
                ->join('users', 'users.id = orders.user_id', 'inner')
                ->groupBy('users.id, users.name, users.email, users.phone, users.address')
                ->orderBy('last_order_date', 'DESC')
                ->get()
                ->getResultArray();
            
            $customers = array_merge($customers, $registeredCustomers);
        } catch (\Exception $e) {
            // If the above query fails, try a simpler approach
            try {
                $builder = $db->table('orders');
                $simpleCustomers = $builder->select('
                        user_id,
                        COUNT(id) as total_orders,
                        COALESCE(SUM(total_amount), 0) as total_spent,
                        MAX(created_at) as last_order_date
                    ')
                    ->where('user_id IS NOT NULL')
                    ->groupBy('user_id')
                    ->orderBy('last_order_date', 'DESC')
                    ->get()
                    ->getResultArray();
                
                // Get user info separately
                foreach ($simpleCustomers as &$customer) {
                    $userBuilder = $db->table('users');
                    $userInfo = $userBuilder->where('id', $customer['user_id'])->get()->getRowArray();
                    if ($userInfo) {
                        $customer['customer_name'] = $userInfo['name'] ?? 'Unknown User';
                        $customer['customer_email'] = $userInfo['email'] ?? 'N/A';
                        $customer['customer_phone'] = $userInfo['phone'] ?? '-';
                        $customer['customer_address'] = $userInfo['address'] ?? '-';
                    } else {
                        $customer['customer_name'] = 'Unknown User';
                        $customer['customer_email'] = 'N/A';
                        $customer['customer_phone'] = '-';
                        $customer['customer_address'] = '-';
                    }
                }
                
                $customers = array_merge($customers, $simpleCustomers);
            } catch (\Exception $e2) {
                // If all else fails, return empty array
                $customers = [];
            }
        }
        
        // Try to get guest customers if customer_email column exists
        try {
            $query = $db->query("SHOW COLUMNS FROM orders LIKE 'customer_email'");
            $hasCustomerFields = $query->getNumRows() > 0;
            
            if ($hasCustomerFields) {
                $builder = $db->table('orders');
                $guestOrders = $builder->select('
                        NULL as user_id,
                        "Guest Customer" as customer_name,
                        customer_email as customer_email,
                        customer_phone as customer_phone,
                        customer_address as customer_address,
                        COUNT(id) as total_orders,
                        COALESCE(SUM(total_amount), 0) as total_spent,
                        MAX(created_at) as last_order_date
                    ')
                    ->where('user_id IS NULL')
                    ->where('customer_email IS NOT NULL')
                    ->groupBy('customer_email, customer_phone, customer_address')
                    ->orderBy('last_order_date', 'DESC')
                    ->get()
                    ->getResultArray();
                
                $customers = array_merge($customers, $guestOrders);
            }
        } catch (\Exception $e) {
            // Skip guest customers if there's an issue
        }

        $data['customers'] = $customers;
        return view('admin/customers', $data);
    }

    public function order($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // Join with users table to get customer info
        $data['order'] = $orderModel->select('orders.*, users.name as customer_name, users.email as customer_email, users.address as customer_address, users.phone as customer_phone')
                                    ->join('users', 'users.id = orders.user_id', 'left')
                                    ->find($id);

        $data['items'] = $orderItemModel->where('order_id', $id)->findAll();

        if (!$data['order']) {
            return redirect()->to('admin/dashboard')->with('error', 'ไม่พบออเดอร์');
        }

        return view('admin/order_detail', $data);
    }

    public function updateOrderStatus()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $orderId = $this->request->getPost('order_id');
        $status  = $this->request->getPost('status');

        if ($orderId && $status) {
            $orderModel = new OrderModel();
            $orderModel->update($orderId, ['status' => $status]);
            
            // Send email notification to customer about status update
            try {
                $emailService = new \App\Libraries\EmailService();
                $order = $orderModel->select('orders.*, users.email as customer_email')
                                    ->join('users', 'users.id = orders.user_id', 'left')
                                    ->find($orderId);
                
                if ($order) {
                    $orderItemModel = new \App\Models\OrderItemModel();
                    $items = $orderItemModel->where('order_id', $orderId)->findAll();
                    
                    // Get customer email from order or users table
                    $customerEmail = $order['customer_email'] ?? null;
                    
                    if ($customerEmail) {
                        $emailService->sendCustomerOrderStatusUpdate($order, $items, $customerEmail, $status);
                    }
                }
            } catch (\Exception $e) {
                log_message('error', 'Status update email failed: ' . $e->getMessage());
            }
            
            return redirect()->to('admin/order/' . $orderId)->with('success', 'อัปเดตสถานะเรียบร้อยแล้ว');
        }

        return redirect()->back()->with('error', 'เกิดข้อผิดพลาด');
    }
    
    // Setup for Phase 4
    public function setup_items()
    {
        $db = \Config\Database::connect();
        $db->query("CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            product_id INT NOT NULL,
            product_name VARCHAR(255) NOT NULL,
            quantity INT NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        )");
        return "Order Items table created. <a href='".site_url('admin/dashboard')."'>Back to Dashboard</a>";
    }

    // --- Product Management ---

    public function createProduct()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        return view('admin/product_form', ['title' => 'เพิ่มสินค้าใหม่']);
    }

    public function storeProduct()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $model = new ProductModel();
        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'image'       => $this->request->getPost('image'),
        ];

        $model->insert($data);
        return redirect()->to('admin/dashboard')->with('success', 'เพิ่มสินค้าเรียบร้อยแล้ว');
    }

    public function deleteProduct($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        
        $model = new ProductModel();
        $model->delete($id);
        return redirect()->to('admin/dashboard')->with('success', 'ลบสินค้าแล้ว');
    }

    // Temporary Setup Utility
    public function setup()
    {
        $db = \Config\Database::connect();
        
        // Create table if not exists
        $db->query("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role VARCHAR(20) DEFAULT 'admin',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Check if admin exists
        $builder = $db->table('users');
        $exists = $builder->where('username', 'admin')->countAllResults();

        if (!$exists) {
            $password = password_hash('admin123', PASSWORD_BCRYPT);
            $builder->insert([
                'username' => 'admin',
                'password' => $password,
                'role'     => 'admin'
            ]);
            return "Admin user created. Username: admin, Password: admin123. <a href='".site_url('admin/login')."'>Login Now</a>";
        } else {
            // Force reset password
            $password = password_hash('admin123', PASSWORD_BCRYPT);
            $builder->where('username', 'admin')->update(['password' => $password]);
            return "Admin password reset to 'admin123'. <a href='".site_url('admin/login')."'>Login Here</a>";
        }
    }

    public function paymentSettings()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        
        $model = new \App\Models\PaymentSettingModel();
        $data['settings'] = $model->findAll();
        
        return view('admin/payment_settings', $data);
    }

    public function updatePaymentSettings()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $model = new \App\Models\PaymentSettingModel();
        $id = $this->request->getPost('id');
        
        $data = [
            'details' => $this->request->getPost('details'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];
        
        $model->update($id, $data);
        return redirect()->to('admin/payment-settings')->with('success', 'บันทึกการตั้งค่าเรียบร้อยแล้ว');
    }

    public function emailSettings()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        
        $db = \Config\Database::connect();
        
        // Get email settings from database
        try {
            $builder = $db->table('settings');
            $settingsData = $builder->whereIn('key', [
                'smtp_host',
                'smtp_port',
                'smtp_user',
                'smtp_pass',
                'smtp_crypto',
                'from_email',
                'from_name',
                'admin_email'
            ])->get()->getResultArray();
            
            $data['settings'] = [];
            foreach ($settingsData as $setting) {
                $data['settings'][$setting['key']] = $setting['value'];
            }
        } catch (\Exception $e) {
            $data['settings'] = [];
        }
        
        return view('admin/email_settings', $data);
    }

    public function updateEmailSettings()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $db = \Config\Database::connect();
        
        try {
            // Create settings table if not exists
            $db->query("CREATE TABLE IF NOT EXISTS settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                `key` VARCHAR(100) NOT NULL UNIQUE,
                `value` TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
            
            $emailSettings = [
                'smtp_host' => $this->request->getPost('smtp_host'),
                'smtp_port' => $this->request->getPost('smtp_port'),
                'smtp_user' => $this->request->getPost('smtp_user'),
                'smtp_pass' => $this->request->getPost('smtp_pass'),
                'smtp_crypto' => $this->request->getPost('smtp_crypto'),
                'from_email' => $this->request->getPost('from_email'),
                'from_name' => $this->request->getPost('from_name'),
                'admin_email' => $this->request->getPost('admin_email')
            ];
            
            $builder = $db->table('settings');
            
            foreach ($emailSettings as $key => $value) {
                $exists = $builder->where('key', $key)->countAllResults();
                
                if ($exists > 0) {
                    $builder->where('key', $key)->update(['value' => $value]);
                } else {
                    $builder->insert(['key' => $key, 'value' => $value]);
                }
            }
            
            return redirect()->to('admin/email-settings')->with('success', 'บันทึกการตั้งค่าอีเมล์เรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            return redirect()->to('admin/email-settings')->with('error', 'เกิดข้อผิดพลาดในการบันทึก: ' . $e->getMessage());
        }
    }

    public function testEmail()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        try {
            $emailService = new \App\Libraries\EmailService();
            $testEmail = $this->request->getPost('test_email');
            
            if (!$testEmail) {
                return redirect()->back()->with('error', 'กรุณากรอกอีเมล์สำหรับทดสอบ');
            }
            
            $data = [
                'message' => '<h2>ทดสอบอีเมล์สำเร็จ!</h2><p>การตั้งค่าอีเมล์ของคุณทำงานได้ถูกต้อง</p><p>ระบบส่งอีเมล์ได้ปกติแล้ว คุณสามารถเริ่มใช้งานระบบแจ้งเตือนทางอีเมล์ได้</p>'
            ];
            
            $result = $emailService->send($testEmail, 'ทดสอบอีเมล์ - IBidSiam Vinyl Shop', 'test', $data);
            
            if ($result) {
                return redirect()->back()->with('success', 'ส่งอีเมล์ทดสอบไปยัง ' . $testEmail . ' เรียบร้อยแล้ว');
            } else {
                return redirect()->back()->with('error', 'ไม่สามารถส่งอีเมล์ทดสอบได้ กรุณาตรวจสอบการตั้งค่า SMTP');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function emailLogs()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $db = \Config\Database::connect();
        
        // Check if email_logs table exists
        if (!$db->tableExists('email_logs')) {
            return redirect()->to('admin/email-settings')->with('error', 'ตาราง email_logs ยังไม่ถูกสร้าง');
        }

        $builder = $db->table('email_logs');
        
        // Apply filters
        $filterStatus = $this->request->getGet('status');
        $filterDate = $this->request->getGet('date');
        
        if ($filterStatus) {
            $builder->where('status', $filterStatus);
        }
        
        if ($filterDate) {
            $builder->where('DATE(sent_at)', $filterDate);
        }
        
        // Get stats
        $stats = [
            'total' => $db->table('email_logs')->countAllResults(),
            'sent' => $db->table('email_logs')->where('status', 'sent')->countAllResults(),
            'failed' => $db->table('email_logs')->where('status', 'failed')->countAllResults()
        ];
        
        // Get logs with pagination
        $perPage = 20;
        $logs = $builder->orderBy('id', 'DESC')->paginate($perPage);
        $pager = $builder->pager;
        
        $data = [
            'logs' => $logs,
            'pager' => $pager,
            'stats' => $stats,
            'filter_status' => $filterStatus,
            'filter_date' => $filterDate
        ];
        
        return view('admin/email_logs', $data);
    }
}
