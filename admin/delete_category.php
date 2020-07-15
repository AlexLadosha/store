<?php

$pdo = new PDO($db_dsn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("DELETE FROM categories_products WHERE category_id = :category_id");
$data = [
    ':category_id' => $_GET['category_id'],
];
$stmt->execute($data);

$stmt = $pdo->prepare("DELETE FROM categories WHERE id = :category_id");
$data = [
    ':category' => $_GET['category_id'],
];
$stmt->execute($data);

setcookie("category_deleted", 1);

// Redirect
header('Location: index.php?page=categories');
exit;

function redirect($url)
{
    header('Location: ' . $url);
    exit;

}
