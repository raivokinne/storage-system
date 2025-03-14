CREATE DATABASE IF NOT EXISTS storage;
USE storage;

CREATE TABLE IF NOT EXISTS Users (
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('worker', 'admin') default 'worker',
    image VARCHAR(255),
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Suppliers (
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Products (
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    supplier_id INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (supplier_id) REFERENCES Suppliers(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Images (
    ID INT NOT NULL AUTO_INCREMENT,
    product_id INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (product_id) REFERENCES Products(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Categories (
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS ProductCategories (
    product_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (product_id, category_id),
    FOREIGN KEY (product_id) REFERENCES Products(ID) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES Categories(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Actions (
    ID INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    action ENUM('destroy', 'store', 'update', 'other') NOT NULL,
    model VARCHAR(50) NOT NULL,
    old_value JSON,
    new_value JSON,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID),
    FOREIGN KEY (user_id) REFERENCES Users(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Orders (
    ID INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (user_id) REFERENCES Users(ID) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Counts (
    ID INT NOT NULL AUTO_INCREMENT,
    product_id INT NOT NULL,
    in_storage INT NOT NULL DEFAULT 0,
    sold INT NOT NULL DEFAULT 0,
    PRIMARY KEY (ID),
    FOREIGN KEY (product_id) REFERENCES Products(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Shelves (
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS ShelfProducts (
    ID INT NOT NULL AUTO_INCREMENT,
    shelf_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (shelf_id) REFERENCES Shelves(ID) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(ID) ON DELETE CASCADE
);

