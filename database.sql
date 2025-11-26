CREATE DATABASE Inventory_and_Billing_System;
-- ==========================
-- 1. USER TABLE
-- ==========================
CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employee') NOT NULL
);

-- ==========================
-- 2. INVENTORY TABLE
-- ==========================
CREATE TABLE inventory (
    inv_id INT AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(150) NOT NULL,
    b_price DECIMAL(10,2) NOT NULL,
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
    customerphone VARCHAR(20)
);

-- ==========================
-- 4. SALES TABLE
-- ==========================
CREATE TABLE sales (
    s_id INT AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(150) NOT NULL,
    s_price DECIMAL(10,2) NOT NULL,
    s_quantity INT NOT NULL,
    s_category VARCHAR(100),
    discount DECIMAL(10,2) DEFAULT 0,
    salseon DATE NOT NULL,
    customername VARCHAR(150),

    -- Optional relation
    customer_id INT,
    FOREIGN KEY (customer_id) REFERENCES customer(c_id)
);
