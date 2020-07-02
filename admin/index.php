<a href="index.php?page=categories">Categories</a>
<a href="index.php?page=products">Products</a>
<a href="index.php?page=orders">Orders</a>
<a href="index.php?page=customers">Сustomers</a>

<?php
// var_dump($_GET);

$db_dsn = 'mysql:host=localhost;dbname=site';
$db_username = 'root';
$db_password = '';

// CATEGORIES
include 'categories.php';
include 'create_category.php';
// PRODUCTS
include 'products.php';
include 'create_products.php';
