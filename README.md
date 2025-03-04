![Oldie Molly Logo](/api/img/logo.png)

## API : Oldie Molly Project
Oldie Molly is a personal project designed to practice and/or learn how to build an API and integrate it into a web project using various frameworks.
In this phase of the project, a purely **PHP-based application** is deployed, leveraging the JWT library for authentication implementation. 

### :page_facing_up: Project Structure
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
---

### :triangular_flag_on_post: Database structure : API calls
**Where I can find the API :** [Base API's URL](http://oldiemolly.mooo.com/api/index.php)

The following features can be proven on Postman through the url indicated.

👤 **User object features**

**1. Account creation :** POST request.
url : http://oldiemolly.mooo.com/api/user/create_user.php
```json
{
  "email" : "",
  "userName" : "",
  "password" : "",
  "userLastname" : "",
  "address" : ""
}
```
**2. Login :** POST request.
url : http://oldiemolly.mooo.com/api/user/login.php
```json
{
  "email" : "",
  "password" : ""
}
```
**3. Know products by user id :** GET request
url: http://oldiemolly.mooo.com/api/user/read_one.php?id=3 (id="" -> you have to change it with your value)

**4. Know orders by user email :** GET request
url: http://oldiemolly.mooo.com/api/user/read_order.php?email=ab.es@outlook.com (email="" -> you have to change it with your value).



📋 **Order object features**

**1. Order creation :** POST request
url : http://oldiemolly.mooo.com/api/order/create.php
```json
{
  "email" : "",
  "userName" : "",
  "password" : "",
  "userLastname" : "",
  "address" : ""
}
```

**2. Delete order :** POST request
url: http://oldiemolly.mooo.com/api/order/delete.php
```json
{
  "id" : "1",
}
```

**3. Know the orders of a specific buyer :** GET request
url: http://oldiemolly.mooo.com/api/order/read_buyer.php?buyer=? (Replace ? for the real value)



📑 **Category object features**

**1. Show all categories :** GET request
url: http://oldiemolly.mooo.com/api/category/read.php

**2. Show products by category :** GET request
url : http://oldiemolly.mooo.com/api/category/read_one.php?id=1

**3. Show category by id :** GET request
url : http://oldiemolly.mooo.com/api/category/read_category.php?id=1

🍼: **Product object features**

**1. Product creation :** POST request
url: http://oldiemolly.mooo.com/api/product/create.php
```json
{
  "prodName" : "",
  "price" : "",
  "quantity" : "",
  "type" : "",
  "description" : "",
  "image" : "",
  "image2" : "",
  "image3" : "",
  "idCategory" : "",
  "idUser" : ""
}
```

**2. Delete a product :** POST request
url : http://oldiemolly.mooo.com/api/product/delete.php
```json
{
  "id" : ""
}
```

**3. Show all the products :** GET request
url : http://oldiemolly.mooo.com/api/product/read.php

**4. Show details of one product :** GET request
ulr:  http://oldiemolly.mooo.com/api/product/read_one.php?id=1 (id="" replace it with the real value)


