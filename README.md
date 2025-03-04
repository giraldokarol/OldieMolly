![Oldie Molly Logo](/api/img/logo.png)

## API : Oldie Molly Project
Oldie Molly is a personal project designed to practice and/or learn how to build an API and integrate it into a web project using various frameworks.
In this phase of the project, a purely **PHP-based application** is deployed, leveraging the JWT library for authentication implementation. 

### :page_facing_up: Project Structue
```txt
api/
│── config/
│   ├── core.php                👈 Variables for jwt connection
|   ├── database.php            👈 Specify your own database credentials
│
│── libs/
│   ├── php-jwt-master          👈 Library Resources
│
│── img/                        👈 Images
│
│── objects/                    👈 Each .PHP file is a class that implements functions and queries.
│   ├── category.php         
│   ├── user.php
|   ├── order.php
|   ├── product.php
│
│── category/
│   ├── read_category.php       // Shows each product by category. 
|   ├── read_one.php           // Shows details of each category by id. 
|   ├── read.php               // Show all categories
|
|── order/
|   ├── create.php             // Create a new order.
|   ├── delete.php            // Delete an order.
|   ├── read_buyer            // Shows an order according to the buyer.
│
|── product/
|   ├── create.php            // Create a new product.
|   ├── delete.php            // Delete a product.
|   ├── read_one.php         // Shows product details by id.
|   ├── read.php             // Shows all the products.
|
|── user/
|   ├── create_user.php      // Create a new user
|   ├── read_all.php         // Shows all the users.
|   ├── read_one.php         // Shows products linked to the user.
|   ├── read_order.php       // Shows user-related commands.
|   ├── read_user.php        // Valid if email exists.
|   ├── login.php            // Validates if the user exists.
|   ├── validate_token.php   // Validates whether the token created corresponds to the same user.
|
│── index.php
│── main.js

```
