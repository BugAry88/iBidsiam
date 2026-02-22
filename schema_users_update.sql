-- Add missing columns for customers to the existing users table
-- We use IGNORE or check schema first, but simple ALTER should work if columns don't exist.
-- To be safe, we'll try to add them. If they exist, it will fail, which is fine.

ALTER TABLE users ADD COLUMN name VARCHAR(100) NULL AFTER id;
ALTER TABLE users ADD COLUMN email VARCHAR(100) NULL UNIQUE AFTER name;
ALTER TABLE users MODIFY COLUMN username VARCHAR(50) NULL; -- Make username nullable as customers use email
