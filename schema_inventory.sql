
ALTER TABLE products 
ADD COLUMN quantity INT DEFAULT 0,
ADD COLUMN status ENUM('in_stock', 'out_of_stock', 'pre_order', 'available_order') DEFAULT 'in_stock';
