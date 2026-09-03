# Fitness Supplement Store

A simple **Fitness Supplement Store web application** developed using **PHP, MySQL, HTML, and CSS**. The application allows users to browse fitness supplements, filter products by category, add products to a shopping cart, and submit an order.

## 📌 Project Overview

The Fitness Supplement Store is a dynamic e-commerce-style website designed for selling fitness and nutritional supplements.

Users can:

* View the home page
* Browse available fitness products
* Filter products by category
* Add products to the shopping cart
* Select product quantities
* View the cart and total price
* Submit an order
* View the order success page

## 🛠️ Technologies Used

* **Frontend:** HTML5, CSS3
* **Backend:** PHP
* **Database:** MySQL
* **Server:** Apache / XAMPP
* **Images:** JPG and PNG

## 📂 Project Structure

```text
fitness_store1/
│
├── index.php
├── products.php
├── cart.php
├── submit.php
├── db.php
├── style.css
│
└── assets/
    ├── whey1.jpg
    ├── whey2.jpg
    ├── whey3.jpg
    ├── creatine.jpg
    ├── multivitamin.jpg
    ├── preworkout.jpg
    ├── carnitine.jpg
    ├── fishoil.jpg
    └── banner.png
```

## 📄 Main Files

### `index.php`

The home page of the website.

It contains:

* Website title
* Navigation menu
* Hero section
* Product categories
* Shop Now button
* Footer

### `products.php`

Displays the available fitness supplements.

Features include:

* Product images
* Product names
* Product weights
* Current prices
* Old prices
* Offers
* Quantity selection
* Add to Cart
* Buy Now
* Product category filtering

### `cart.php`

Displays products added to the shopping cart.

It shows:

* Product name
* Product type
* Quantity
* Price
* Individual total
* Grand total
* Submit Order button

### `submit.php`

Processes the order submission.

After submitting the order, the application:

1. Calculates the total amount.
2. Clears the cart.
3. Displays an order confirmation message.
4. Shows the total amount.
5. Provides a link back to the home page.

### `db.php`

Connects the PHP application to the MySQL database.

Database used:

```text
fitness_store1
```

### `style.css`

Contains the styling for the entire website, including:

* Header
* Navigation bar
* Hero section
* Product cards
* Product grid
* Buttons
* Shopping cart table
* Success messages
* Footer

## 🗄️ Database

Create a MySQL database named:

```sql
CREATE DATABASE fitness_store1;
```

The project uses two main tables:

### Products Table

The `products` table stores product information such as:

* Product ID
* Product name
* Product type
* Weight
* Price
* Old price
* Offer
* Image filename

Example structure:

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    weight VARCHAR(100),
    price DECIMAL(10,2) NOT NULL,
    old_price DECIMAL(10,2),
    offer VARCHAR(100),
    image VARCHAR(255)
);
```

### Cart Table

The `cart` table stores products selected by the user.

```sql
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_type VARCHAR(100),
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL
);
```

## ⚙️ Installation

### Step 1: Install XAMPP

Install **XAMPP** with:

* Apache
* MySQL
* PHP

### Step 2: Copy the Project

Copy the `fitness_store1` folder into:

```text
xampp/htdocs/
```

The final location should be:

```text
xampp/htdocs/fitness_store1/
```

### Step 3: Start XAMPP

Open XAMPP Control Panel and start:

```text
Apache
MySQL
```

### Step 4: Create Database

Open phpMyAdmin and create:

```text
fitness_store1
```

### Step 5: Create Tables

Create the `products` and `cart` tables using the SQL commands provided above.

Add the required product information and image filenames to the `products` table.

### Step 6: Check Database Connection

The current `db.php` configuration uses:

```php
$conn = new mysqli("localhost", "root", "", "fitness_store1");
```

If your MySQL username or password is different, update these values.

### Step 7: Run the Website

Open your browser and visit:

```text
http://localhost/fitness_store1/
```

## 🛒 Product Categories

The store supports categories such as:

* Whey Protein
* Creatine
* Pre-Workout
* Liquid Carnitine
* Fish Oil
* Health Supplement

## 🔄 Website Workflow

```text
Home Page
    ↓
Products Page
    ↓
Select Product
    ↓
Choose Quantity
    ↓
Add to Cart
    ↓
View Cart
    ↓
Submit Order
    ↓
Order Confirmation
```

## ✨ Features

* Responsive product layout
* Category-based product filtering
* Product images
* Product pricing
* Discount/offer display
* Quantity selection
* Shopping cart
* Automatic total calculation
* Order submission
* Order confirmation page
* MySQL database integration
* PHP backend

## 🎯 Project Objective

The main objective of this project is to develop a simple online fitness supplement shopping system that demonstrates the use of **PHP, MySQL, HTML, and CSS** for creating a dynamic web application.

## 🚀 Future Enhancements

The project can be further improved by adding:

* User registration and login
* Admin dashboard
* Product search functionality
* Product deletion from cart
* Product quantity update
* Online payment integration
* Order history
* Customer profile
* Stock management
* Product reviews and ratings
* Secure database queries
* Responsive mobile design

## 👨‍💻 Author

**Fitness Supplement Store Project**

Developed as a web development project using PHP and MySQL.

## 📜 License

This project is intended for educational and academic purposes.
