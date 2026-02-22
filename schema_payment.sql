-- Add payment_method to orders table
ALTER TABLE orders ADD COLUMN payment_method VARCHAR(50) DEFAULT 'cod' AFTER total_amount;

-- Create payment_settings table
CREATE TABLE IF NOT EXISTS payment_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(100) NOT NULL,
    details TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default payment methods
INSERT INTO payment_settings (method_name, details, is_active) VALUES 
('Bank Transfer', 'Bank: Kasikorn Bank\nAccount: 123-456-7890\nName: Anti-Gravity Vinyl', 1),
('Cash on Delivery (COD)', 'Pay cash upon delivery.', 1);
