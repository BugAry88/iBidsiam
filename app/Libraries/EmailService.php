<?php

namespace App\Libraries;

use CodeIgniter\Email\Email;

class EmailService
{
    protected $email;
    protected $db;
    
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->db = \Config\Database::connect();
        
        // Load email settings from database
        $this->loadEmailSettings();
    }
    
    /**
     * Load email settings from database
     */
    protected function loadEmailSettings()
    {
        try {
            $builder = $this->db->table('settings');
            $settings = $builder->whereIn('key', [
                'smtp_host',
                'smtp_port',
                'smtp_user',
                'smtp_pass',
                'smtp_crypto',
                'from_email',
                'from_name',
                'admin_email'
            ])->get()->getResultArray();
            
            $config = [];
            foreach ($settings as $setting) {
                $config[$setting['key']] = $setting['value'];
            }
            
            // Update email configuration if settings exist
            if (!empty($config)) {
                if (isset($config['smtp_host'])) $this->email->SMTPHost = $config['smtp_host'];
                if (isset($config['smtp_port'])) $this->email->SMTPPort = (int)$config['smtp_port'];
                if (isset($config['smtp_user'])) $this->email->SMTPUser = $config['smtp_user'];
                if (isset($config['smtp_pass'])) $this->email->SMTPPass = $config['smtp_pass'];
                if (isset($config['smtp_crypto'])) $this->email->SMTPCrypto = $config['smtp_crypto'];
                if (isset($config['from_email'])) $this->email->setFrom($config['from_email'], $config['from_name'] ?? 'IBidSiam');
            }
        } catch (\Exception $e) {
            // If settings table doesn't exist or error, use default config
            log_message('error', 'Email settings load error: ' . $e->getMessage());
        }
    }
    
    /**
     * Send email with template
     */
    public function send($to, $subject, $template, $data = [])
    {
        try {
            $this->email->setTo($to);
            $this->email->setSubject($subject);
            
            // Load template
            $message = $this->loadTemplate($template, $data);
            $this->email->setMessage($message);
            
            $result = $this->email->send();
            
            // Log email
            $this->logEmail($to, $subject, $template, $result);
            
            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Email send error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Load email template
     */
    protected function loadTemplate($template, $data = [])
    {
        $templatePath = APPPATH . 'Views/emails/' . $template . '.php';
        
        if (!file_exists($templatePath)) {
            return $this->getDefaultTemplate($data);
        }
        
        // Extract data for template
        extract($data);
        
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }
    
    /**
     * Get default email template
     */
    protected function getDefaultTemplate($data)
    {
        $message = isset($data['message']) ? $data['message'] : 'No message content';
        
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
                .content { background: #f8f9fa; padding: 30px; }
                .footer { background: #2d3748; color: white; padding: 20px; text-align: center; font-size: 0.9rem; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>IBidSiam Vinyl Shop</h1>
                </div>
                <div class="content">
                    ' . $message . '
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' IBidSiam. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>';
    }
    
    /**
     * Log email to database
     */
    protected function logEmail($to, $subject, $template, $status)
    {
        try {
            $builder = $this->db->table('email_logs');
            $builder->insert([
                'to_email' => $to,
                'subject' => $subject,
                'template' => $template,
                'status' => $status ? 'sent' : 'failed',
                'sent_at' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            // If email_logs table doesn't exist, skip logging
            log_message('error', 'Email log error: ' . $e->getMessage());
        }
    }
    
    /**
     * Send new order notification to admin
     */
    public function sendNewOrderNotificationToAdmin($order)
    {
        try {
            // Get admin email from settings
            $builder = $this->db->table('settings');
            $adminEmailSetting = $builder->where('key', 'admin_email')->get()->getRowArray();
            $adminEmail = $adminEmailSetting['value'] ?? 'admin@ibidsiam.com';
            
            $subject = '🔔 New Order #' . str_pad($order['id'], 6, '0', STR_PAD_LEFT);
            
            $data = [
                'order' => $order,
                'order_id' => str_pad($order['id'], 6, '0', STR_PAD_LEFT),
                'total' => number_format($order['total_amount'], 2)
            ];
            
            return $this->send($adminEmail, $subject, 'admin/new_order', $data);
        } catch (\Exception $e) {
            log_message('error', 'Admin order notification error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send payment notification to admin
     */
    public function sendPaymentNotificationToAdmin($order, $payment)
    {
        try {
            $builder = $this->db->table('settings');
            $adminEmailSetting = $builder->where('key', 'admin_email')->get()->getRowArray();
            $adminEmail = $adminEmailSetting['value'] ?? 'admin@ibidsiam.com';
            
            $subject = '💳 Payment Received - Order #' . str_pad($order['id'], 6, '0', STR_PAD_LEFT);
            
            $data = [
                'order' => $order,
                'payment' => $payment,
                'order_id' => str_pad($order['id'], 6, '0', STR_PAD_LEFT),
                'amount' => number_format($payment['amount'], 2)
            ];
            
            return $this->send($adminEmail, $subject, 'admin/payment_received', $data);
        } catch (\Exception $e) {
            log_message('error', 'Admin payment notification error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send low stock alert to admin
     */
    public function sendLowStockAlert($product)
    {
        try {
            $builder = $this->db->table('settings');
            $adminEmailSetting = $builder->where('key', 'admin_email')->get()->getRowArray();
            $adminEmail = $adminEmailSetting['value'] ?? 'admin@ibidsiam.com';
            
            $subject = '⚠️ Low Stock Alert: ' . $product['name'];
            
            $data = [
                'product' => $product,
                'quantity' => $product['quantity']
            ];
            
            return $this->send($adminEmail, $subject, 'admin/low_stock', $data);
        } catch (\Exception $e) {
            log_message('error', 'Low stock alert error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send order confirmation to customer
     */
    public function sendOrderConfirmation($order, $items, $customerEmail)
    {
        try {
            $subject = 'Order Confirmation #' . str_pad($order['id'], 6, '0', STR_PAD_LEFT) . ' - IBidSiam';
            
            $data = [
                'order' => $order,
                'items' => $items,
                'order_id' => str_pad($order['id'], 6, '0', STR_PAD_LEFT),
                'total' => number_format($order['total_amount'], 2)
            ];
            
            return $this->send($customerEmail, $subject, 'customer/order_confirmation', $data);
        } catch (\Exception $e) {
            log_message('error', 'Order confirmation error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send order status update to customer
     */
    public function sendOrderStatusUpdate($order, $customerEmail, $newStatus)
    {
        try {
            $statusText = [
                'pending' => 'Pending',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled'
            ];
            
            $subject = 'Order Status Update #' . str_pad($order['id'], 6, '0', STR_PAD_LEFT) . ' - ' . ($statusText[$newStatus] ?? $newStatus);
            
            $data = [
                'order' => $order,
                'order_id' => str_pad($order['id'], 6, '0', STR_PAD_LEFT),
                'status' => $statusText[$newStatus] ?? $newStatus,
                'new_status' => $newStatus
            ];
            
            return $this->send($customerEmail, $subject, 'customer/order_status', $data);
        } catch (\Exception $e) {
            log_message('error', 'Order status update error: ' . $e->getMessage());
            return false;
        }
    }
}
