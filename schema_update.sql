-- Update Orders Table with missing columns
ALTER TABLE orders ADD COLUMN IF NOT EXISTS user_id INT NULL;
ALTER TABLE orders ADD COLUMN IF NOT EXISTS payment_method VARCHAR(50) NULL;
ALTER TABLE orders ADD COLUMN IF NOT EXISTS payment_proof VARCHAR(255) NULL;
ALTER TABLE orders ADD COLUMN IF NOT EXISTS payment_date DATETIME NULL;

-- Create Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- Create Payment Settings Table
CREATE TABLE IF NOT EXISTS payment_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(100) NOT NULL,
    details TEXT,
    is_active TINYINT(1) DEFAULT 1
);

-- Insert Default Payment Methods
INSERT INTO payment_settings (method_name, details, is_active) VALUES
('Bank Transfer', 'Bank: Galactic Bank\nAccount: 123-456-7890\nName: Anti-Gravity Shop', 1),
('COD', 'Cash on Delivery (Earth Sector Only)', 1);

-- Create Users Table (if not exists from schema_users.sql)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
