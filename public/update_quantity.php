<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$newQuantity = 1;

if (isset($_POST['product_id']) && isset($_POST['change'])) {
    $product_id = $_POST['product_id'];
    $change = (int)$_POST['change'];

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $change;

            if ($item['quantity'] < 1) {
                $item['quantity'] = 1;
            }

            $newQuantity = $item['quantity'];
            break;
        }
    }
}

echo json_encode([
    'quantity' => $newQuantity
]);

exit;
