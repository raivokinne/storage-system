CREATE DATABASE storage;
USE storage;

CREATE TABLE Users (
    ID int NOT NULL AUTO_INCREMENT,
    name varchar(50),
    email varchar(255),
    password varchar(255),
    PRIMARY KEY (ID)
);

CREATE TABLE Suppliers (
    ID int NOT NULL AUTO_INCREMENT,
    name varchar(50),
    PRIMARY KEY (ID)
);

CREATE TABLE Products (
    ID int NOT NULL AUTO_INCREMENT,
    name varchar(50),
    description varchar(255),
    price int,
    supplier_id int,
    PRIMARY KEY (ID),
    FOREIGN KEY (supplier_id) REFERENCES Suppliers(ID)
);

CREATE TABLE Images (
    ID int NOT NULL AUTO_INCREMENT,
    product_id int,
    image varchar(255),
    PRIMARY KEY (ID),
    FOREIGN KEY (product_id) REFERENCES Products(ID)
);

CREATE TABLE Categories (
    ID int NOT NULL AUTO_INCREMENT,
    name varchar(50),
    PRIMARY KEY (ID)
);

CREATE TABLE ProductCategories (
    product_id int,
    category_id int,
    PRIMARY KEY (product_id, category_id),
    FOREIGN KEY (product_id) REFERENCES Products(ID),
    FOREIGN KEY (category_id) REFERENCES Categories(ID)
);

CREATE TABLE Actions (
    ID int NOT NULL AUTO_INCREMENT,
    user_id int,
    action ENUM('view', 'like', 'comment', 'share'),
    model varchar(50),
    old_value varchar(255),
    new_value varchar(255),
    PRIMARY KEY (ID),
    FOREIGN KEY (user_id) REFERENCES Users(ID)
);

CREATE TABLE Orders (
    ID int NOT NULL AUTO_INCREMENT,
    user_id int,
    status ENUM('pending', 'completed', 'cancelled'),
    product_id int,
    quantity int,
    PRIMARY KEY (ID),
    FOREIGN KEY (user_id) REFERENCES Users(ID),
    FOREIGN KEY (product_id) REFERENCES Products(ID)
);

CREATE TABLE Counts (
    ID int NOT NULL AUTO_INCREMENT,
    product_id int,
    in_storage int,
    sold int,
    PRIMARY KEY (ID),
    FOREIGN KEY (product_id) REFERENCES Products(ID)
);

CREATE TABLE Shelves (
    ID int NOT NULL AUTO_INCREMENT,
    name varchar(50),
    PRIMARY KEY (ID)
);

CREATE TABLE ShelfProducts (
    ID int NOT NULL AUTO_INCREMENT,
    shelf_id int,
    product_id int,
    PRIMARY KEY (ID),
    FOREIGN KEY (shelf_id) REFERENCES Shelves(ID),
    FOREIGN KEY (product_id) REFERENCES Products(ID)
);