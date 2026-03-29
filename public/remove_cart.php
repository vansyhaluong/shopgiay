<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]); // 🔥 xóa item
            break;
        }
    }

    // reset lại index mảng (không bắt buộc nhưng nên có)
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// redirect lại giỏ hàng
header("Location: cart.php");
exit();
