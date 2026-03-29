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

// tính tổng
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price_id'] * $item['quantity'];
}

$shipping = ($total >= 5000000) ? 0 : 30000;
$finalTotal = $total + $shipping;

echo json_encode([
    'quantity' => $newQuantity,
    'total' => number_format($finalTotal, 0, ',', '.') . '₫'
]);

exit;
