# Automobile Database (PHP & PDO)

A database-driven web application built to track automobile data (Make, Year, Mileage). This project demonstrates the use of **PHP Data Objects (PDO)** for secure database interactions, replacing older MySQLi methods.

## Overview
This application allows users to log in and add vehicles to a database. It features strict input validation, error handling, and security measures to prevent common web vulnerabilities like SQL Injection and XSS.

## Key Features
* **PDO Implementation:** Uses PHP Data Objects for database portability and security.
* **SQL Injection Protection:** Utilizes prepared statements (`$stmt->prepare`) for all database insertions.
* **Input Validation:** Enforces numeric checks for Year/Mileage and presence checks for required fields.
* **Secure Login:** Authenticates users via a Salted MD5 hash system.
* **Dynamic Rendering:** Displays entries from the MySQL database and conditionally renders links if a URL is provided.

## Technologies
* PHP (7.4+)
* MySQL / MariaDB
* Bootstrap Framework
* XAMPP (Apache Web Server)

## Setup & Configuration

### 1. Database Setup
You must create the database and table before running the app. Run this SQL in phpMyAdmin:

```sql
CREATE DATABASE misc;
USE misc;

CREATE TABLE autos (
   auto_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
   make VARCHAR(255),
   year INTEGER,
   mileage INTEGER,
   url VARCHAR(255),
   PRIMARY KEY (auto_id)
);