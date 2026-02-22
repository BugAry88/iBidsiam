-- Database: antigravity_shop
CREATE DATABASE IF NOT EXISTS antigravity_shop;
USE antigravity_shop;

-- Table: products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantity INT DEFAULT 0,
    status ENUM('in_stock', 'out_of_stock', 'pre_order', 'available_order') DEFAULT 'in_stock'
);

-- Table: orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dummy Data: Products (Vinyl Records)
INSERT INTO products (name, price, description, image) VALUES 
('คลื่นเสียงคอสมิก (Cosmic Vibrations)', 990.00, 'ด่ำดิ่งสู่เสียงแห่งเนบิวลา แผ่นไวนิลสีฟ้าโปร่งแสง', 'https://via.placeholder.com/300/00FFFF/000000?text=Cosmic+Vibrations'),
('นักท่องความว่างเปล่า (Void Walker)', 1200.00, 'เสียงบรรยากาศมืดมนสำหรับนักเดินทางข้ามดวงดาว พื้นผิวด้านสีดำ', 'https://via.placeholder.com/300/800080/FFFFFF?text=Void+Walker'),
('ขอบฟ้าไฟนีออน (Neon Horizon)', 850.00, 'เพลง Synthwave รีมาสเตอร์สำหรับสภาวะไร้น้ำหนัก ลายสาดสีชมพูนีออน', 'https://via.placeholder.com/300/FF00FF/FFFFFF?text=Neon+Horizon');