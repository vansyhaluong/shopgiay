<?php
session_start();
include "Database.php";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
    exit;
}

$db = new Database();

// Lấy dữ liệu form
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$ward = $_POST['ward'];
$district = $_POST['district'];
$city = $_POST['city'];
$payment = $_POST['payment'];

// Ghép địa chỉ
$fullAddress = $address . ', ' . $ward . ', ' . $district . ', ' . $city;

// user_id nếu có
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Tính tổng tiền
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price_id'] * $item['quantity'];
}


$total = $subtotal;
$status = 'paid';
// 1. Insert orders
$sqlOrder = "INSERT INTO orders (user_id, fullname, phone, address, total_amount, payment_method)
             VALUES (?, ?, ?, ?, ?, ?)";

$order_id = $db->execute($sqlOrder, "isssis", [
    $user_id,
    $fullname,
    $phone,
    $fullAddress,
    $total,
    $payment
]);

// 2. Insert order_items
$sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)";

foreach ($_SESSION['cart'] as $item) {
    $db->execute($sqlItem, "iiii", [
        $order_id,
        $item['product_id'],
        $item['quantity'],
        $item['price_id']
    ]);
}

// 3. Xóa giỏ hàng
unset($_SESSION['cart']);

// 4. Chuyển trang
header("Location: success.php");
exit;
