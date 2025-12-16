CREATE DATABASE Inventory_and_Billing_System;
USE Inventory_and_Billing_System;

-- ==========================
-- 1. USER TABLE
-- ==========================
CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date DATE DEFAULT CURRENT_DATE,
    role ENUM('admin', 'employee') NOT NULL
);

-- ==========================
-- 2. INVENTORY TABLE
-- ==========================
CREATE TABLE inventory (
    inv_id INT AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(150) NOT NULL,
    inv_price DECIMAL(10,2) NOT NULL,
    inv_quantity INT NOT NULL,
    inv_category VARCHAR(100),
    purchasedon DATE NOT NULL
);

-- ==========================
-- 3. CUSTOMER TABLE
-- ==========================
CREATE TABLE customer (
    c_id INT AUTO_INCREMENT PRIMARY KEY,
    customername VARCHAR(150) NOT NULL,
    customerphone VARCHAR(20),
    customeraddress VARCHAR(100),
    created_on DATE NOT NULL

);

-- ==========================
-- 4. SALES TABLE
-- ==========================
CREATE TABLE sales (
    sale_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    tax DECIMAL(10,2) NOT NULL,
    final_total DECIMAL(10,2) NOT NULL,
    sale_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sales_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,

    -- Relationship
    FOREIGN KEY (sale_id) REFERENCES sales(sale_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- ===========================
-- 5. category
-- ===========================
CREATE TABLE category (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    created_on DATE NOT NULL
);
