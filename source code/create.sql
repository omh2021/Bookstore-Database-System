-- Create a new database named 'bookstore'
CREATE DATABASE bookstore;

-- Select the 'bookstore' database for use
USE bookstore;

-- Create the 'User' table
CREATE TABLE User (
    user_id         int     NOT NULL,
    user_password       varchar(20),
    name            varchar(30),
    email           varchar(50),
    CONSTRAINT UserPK PRIMARY KEY(user_id)
);

-- Create the 'Customer' table
CREATE TABLE Customer (
    user_id int NOT NULL,
    owned_books varchar(255) NULL,
    address varchar(100),
    CONSTRAINT CustomerPK PRIMARY KEY (user_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
);

-- Create the 'Employee' table
CREATE TABLE Employee (
    user_id int NOT NULL,
    salary int,
    CONSTRAINT EmployeePK PRIMARY KEY (user_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
);

-- Create the 'Book' table
CREATE TABLE Book (
    book_id         int     NOT NULL,
    price           int,
    age_rating      int,
    genre           varchar(20),
    quantity_available  int,
    title           varchar(100),
    CONSTRAINT BookPK PRIMARY KEY(book_id)
);

-- Create the 'Orders' table
CREATE TABLE Orders (
    order_id int NOT NULL,
    customer_id int,
    book_id int,
    quantity int,
    order_date DATE,
    CONSTRAINT OrderPK PRIMARY KEY (order_id),
    FOREIGN KEY (customer_id) REFERENCES Customer(user_id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (book_id) REFERENCES Book(book_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create the 'Supplier' table
CREATE TABLE Supplier (
    supplier_id int NOT NULL,
    book_id int,
    price double,
    quantity int,
    CONSTRAINT SupplierPK PRIMARY KEY (supplier_id),
    FOREIGN KEY (book_id) REFERENCES Book(book_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create the 'Author' table
CREATE TABLE Author(
    book_id     int NOT NULL,
    author_id   int NOT NULL,
    CONSTRAINT AuthorPK PRIMARY KEY (author_id),
    FOREIGN KEY (book_id) REFERENCES Book(book_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Create the 'Owned_By' relation table
CREATE TABLE Owned_By(
    book_id     int NOT NULL,
    user_id     int NOT NULL,
    CONSTRAINT OwnedByPK PRIMARY KEY (book_id, user_id),
    FOREIGN KEY (book_id) REFERENCES Book(book_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE RESTRICT ON UPDATE CASCADE
);
