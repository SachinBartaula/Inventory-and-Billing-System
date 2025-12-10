CREATE DATABASE Inventory_and_Billing_System;
USE Inventory_and_Billing_System;

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
    s_id INT AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(150) NOT NULL,
    s_price DECIMAL(10,2) NOT NULL,
    s_quantity INT NOT NULL DEFAULT 0,
    s_category VARCHAR(100),
    discount DECIMAL(10,2) DEFAULT 0,
    salseon DATE NOT NULL,
    customername VARCHAR(150),
    totalamount DECIMAL(10,2),

);
-- ===========================
-- 5. category
-- ===========================
CREATE TABLE category (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    created_on DATE NOT NULL
);
