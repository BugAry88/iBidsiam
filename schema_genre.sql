ALTER TABLE products ADD COLUMN genre VARCHAR(50) DEFAULT 'Uncategorized';

-- Update existing dummy data with genres
UPDATE products SET genre = 'Ambient' WHERE name LIKE '%Cosmic%';
UPDATE products SET genre = 'Dark Ambient' WHERE name LIKE '%Void%';
UPDATE products SET genre = 'Synthwave' WHERE name LIKE '%Neon%';
