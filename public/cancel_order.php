<?php
session_start();
include "Database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['order_id'])) {
    header("Location: order_history.php");
    exit;
}

$db = new Database();

$order_id = $_POST['order_id'];
$user_id = $_SESSION['user_id'];

/*
Chỉ cho phép user hủy đơn của chính họ + chỉ khi pending
*/
$sql = "UPDATE orders 
        SET status = 'cancelled'
        WHERE order_id = ? AND user_id = ? AND status = 'pending'";

$db->execute($sql, "ii", [$order_id, $user_id]);

header("Location: my_orders.php");
exit;
