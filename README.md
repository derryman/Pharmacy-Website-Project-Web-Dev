README.md for Pharmacy Website Project
Project Overview
This Pharmacy Website project is a simulated online pharmacy storefront, designed as an educational tool to demonstrate web development techniques including session handling, user authentication, and basic e-commerce functionalities like managing a shopping cart and processing orders.

Features
User Authentication: Supports user registration, login, and logout.
Product Catalog: Displays a list of products that users can browse.
Shopping Cart: Users can add products to their cart and manage them.
Order Processing: Allows users to complete purchases, which moves items from the cart to an order history.
Responsive Design: The site is designed to be responsive and accessible on various devices.
Tech Stack
Frontend: HTML, CSS
Backend: PHP, MySQL
Database: MySQL
Server: Apache (via XAMPP)
Setup Instructions
Install XAMPP: Download and install XAMPP from Apache Friends.
Clone Repository: Clone the code repository to your local machine or download the zip file and extract it into the htdocs folder of your XAMPP installation.
Configure MySQL:
Launch XAMPP and start the Apache and MySQL services.
Access phpMyAdmin by visiting http://localhost/phpmyadmin in your web browser.
Create a new database named pharmacy_db.
Import the provided SQL file (pharmacy_db.sql) to set up your database schema and initial data.
Configuration File: Ensure the config.php file contains the correct database connection settings.
Start the Server: Open your web browser and go to http://localhost/[project-folder-name]/ to view the project.
Usage
Register / Login: Start by registering as a new user or logging in.
Browse Products: Visit the product catalog to add items to your cart.
Manage Cart: View your cart to add more items, remove them, or adjust quantities.
Checkout: Complete the purchase through the checkout page to see how orders are processed.
