-- ============================================
-- KAPITOL CAFE - Database Setup
-- Import this in phpMyAdmin or MySQL CLI
-- ============================================

CREATE DATABASE IF NOT EXISTS kapitol_cafe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kapitol_cafe;

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    icon VARCHAR(50) DEFAULT '☕',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menu Items Table
CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255) DEFAULT '',
    is_available TINYINT(1) DEFAULT 1,
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(20) UNIQUE NOT NULL,
    table_number VARCHAR(10) DEFAULT 'N/A',
    customer_name VARCHAR(100) DEFAULT 'Guest',
    status ENUM('pending','confirmed','preparing','ready','served','paid','cancelled') DEFAULT 'pending',
    total_amount DECIMAL(10,2) DEFAULT 0.00,
    payment_method ENUM('cash','gcash','maya','card') DEFAULT 'cash',
    payment_status ENUM('unpaid','paid') DEFAULT 'unpaid',
    order_type ENUM('dine_in','takeout') DEFAULT 'dine_in',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    menu_item_id INT NOT NULL,
    quantity INT DEFAULT 1,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    special_request TEXT,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

-- Tables/QR mapping
CREATE TABLE IF NOT EXISTS cafe_tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_number VARCHAR(10) UNIQUE NOT NULL,
    qr_token VARCHAR(64) UNIQUE NOT NULL,
    seats INT DEFAULT 4,
    is_active TINYINT(1) DEFAULT 1,
    status ENUM('available','occupied') DEFAULT 'available',
    label VARCHAR(50) DEFAULT ''
);

-- Admin Users
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','cashier','kitchen') DEFAULT 'cashier',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- SEED DATA
-- ============================================

INSERT INTO categories (name, icon, sort_order) VALUES
('Hot Coffee', '☕', 1),
('Iced Coffee', '🧊', 2),
('Non-Coffee', '🧋', 3),
('Pastries', '🥐', 4),
('Rice Meals', '🍱', 5),
('Snacks', '🍟', 6);

INSERT INTO menu_items (category_id, name, description, price, image_url, is_featured) VALUES
(1, 'Kapitol Espresso', 'Rich double-shot espresso, bold and smooth', 79.00, 'images/Kapitol_Espresso.jpg', 1),
(1, 'Americano', 'Espresso diluted with hot water, clean finish', 89.00, 'images/Americano.jpeg', 0),
(1, 'Cappuccino', 'Espresso with steamed milk and thick foam', 99.00, 'images/Cappuccino.jpg', 1),
(1, 'Café Latte', 'Smooth espresso with velvety steamed milk', 110.00, 'images/Cafe_Latte.jpg', 0),
(1, 'Caramel Macchiato', 'Vanilla, steamed milk, espresso, caramel drizzle', 125.00, 'images/Caramel_Macchiato.jpg', 1),
(1, 'White Mocha', 'White chocolate sauce with espresso and milk', 120.00, 'images/White_Mocha.jpg', 0),
(2, 'Iced Latte', 'Chilled espresso with fresh milk over ice', 115.00, 'images/Cafe_Latte.jpg', 1),
(2, 'Iced Caramel', 'Sweet caramel espresso chilled to perfection', 130.00, '', 0),
(2, 'Cold Brew', 'Slow-steeped cold brew, 12-hour brew', 140.00, '', 1),
(2, 'Iced Mocha', 'Chocolate espresso bliss over crushed ice', 125.00, '', 0),
(3, 'Matcha Latte', 'Premium Japanese matcha with oat milk', 130.00, '', 1),
(3, 'Strawberry Milk', 'Fresh strawberry blend with creamy milk', 110.00, '', 0),
(3, 'Chocolate Frost', 'Rich dark chocolate drink, hot or cold', 115.00, '', 0),
(3, 'Mango Sago', 'Tropical mango with tapioca pearls', 120.00, '', 1),
(4, 'Butter Croissant', 'Flaky, golden butter croissant', 65.00, '', 1),
(4, 'Blueberry Muffin', 'Moist muffin bursting with blueberries', 75.00, '', 0),
(4, 'Cheese Danish', 'Cream cheese filled flaky pastry', 80.00, '', 0),
(5, 'Kapitol Rice Bowl', 'Chicken teriyaki with steamed rice & salad', 185.00, '', 1),
(5, 'Silog Meal', 'Garlic rice, egg, choice of meat', 155.00, '', 0),
(5, 'Club Sandwich Meal', 'Triple-decker with fries and drink', 210.00, '', 1),
(6, 'Waffle Fries', 'Crispy waffle-cut fries with dip', 95.00, '', 0),
(6, 'Nachos Supreme', 'Loaded nachos with cheese and salsa', 120.00, '', 1);

-- If upgrading existing DB, run this first:
-- ALTER TABLE cafe_tables ADD COLUMN IF NOT EXISTS status ENUM('available','occupied') DEFAULT 'available';
-- ALTER TABLE cafe_tables ADD COLUMN IF NOT EXISTS label VARCHAR(50) DEFAULT '';
-- ALTER TABLE orders ADD COLUMN IF NOT EXISTS order_type ENUM('dine_in','takeout') DEFAULT 'dine_in';

INSERT INTO cafe_tables (table_number, qr_token, seats, status, label) VALUES
('T01', 'table_t01_k4pit0l_2024', 4, 'available', 'Table 1'),
('T02', 'table_t02_k4pit0l_2024', 4, 'available', 'Table 2'),
('T03', 'table_t03_k4pit0l_2024', 6, 'available', 'Table 3'),
('T04', 'table_t04_k4pit0l_2024', 2, 'available', 'Table 4'),
('T05', 'table_t05_k4pit0l_2024', 8, 'available', 'Table 5'),
('BAR', 'table_bar_k4pit0l_2024', 3, 'available', 'Bar Counter');

-- Default admin password: admin123 (bcrypt hash)
INSERT INTO admin_users (username, password, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('cashier1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cashier'),
('kitchen1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kitchen');

-- Default password for all users: password
