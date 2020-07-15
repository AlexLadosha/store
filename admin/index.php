<?php
// var_dump($_GET);

$db_dsn = 'mysql:host=localhost;dbname=site';
$db_username = 'root';
$db_password = '';

if(!empty($_COOKIE['product_deleted'])) {
    setcookie ("product_deleted", "", time() - 3600);
}

if(!empty($_COOKIE['category_deleted'])) {
    setcookie ("category_deleted", "", time() - 3600);
}
if($_GET['page'] !== 'delete_category' && $_GET['page'] !== 'delete_product') {
    include 'menu.php';
}

// CATEGORIES
include 'categories.php';
include 'create_category.php';
if ($_GET['page'] === 'edit_category') {
    include 'edit_category.php';
}
if ($_GET['page'] === 'delete_category') {
    include 'delete_category.php';
}
// PRODUCTS
include 'products.php';
include 'create_products.php';
if ($_GET['page'] === 'edit_product') {
    include 'edit_product.php';
}
if ($_GET['page'] === 'delete_product') {
    include 'delete_product.php';
}

