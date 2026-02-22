-- Add address and phone to users table
ALTER TABLE users ADD COLUMN address TEXT NULL AFTER email;
ALTER TABLE users ADD COLUMN phone VARCHAR(20) NULL AFTER address;
