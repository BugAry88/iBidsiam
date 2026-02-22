-- Change default role to 'customer'
ALTER TABLE users ALTER COLUMN role SET DEFAULT 'customer';

-- Update existing users (excluding the main admin) to be customers
UPDATE users SET role = 'customer' WHERE username IS NULL OR username != 'admin';
