<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "Database.php";
    $db = new Database();

    $product_id = (int)$_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    $product = $db->select("SELECT * FROM products WHERE product_id = $product_id")[0];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $product['product_id'],
            'product_name' => $product['product_name'],
            'price_id' => $product['price_id'],
            'image' => $product['image'],
            'quantity' => $quantity
        ];
    }

    header("Location: cart.php"); // 🔥 redirect để tránh reload POST
    exit();
}
