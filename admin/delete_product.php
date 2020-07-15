<?php
$pdo = new PDO($db_dsn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("DELETE FROM categories_products WHERE product_id = :product_id");
$data = [
    ':product_id' => $_GET['product_id'],
];
$stmt->execute($data);

$stmt = $pdo->prepare("DELETE FROM products WHERE id = :product_id");
$data = [
    ':product_id' => $_GET['product_id'],
];
$stmt->execute($data);

setcookie("product_deleted", 1);

// Redirect
header('Location: index.php?page=products');
exit;

function redirect($url) {
    header('Location: '.$url);
    exit;

}