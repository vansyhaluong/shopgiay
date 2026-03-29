<?php
require_once "Database.php";
$db = new Database();

if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];

    $sql = "SELECT image FROM products WHERE product_id = ?";
    $employees = $db->select($sql, "i", [$id]);

    if (!empty($employees)) {
        $image = $employees[0]['image'];

        if (file_exists("images/" . $image)) {
            unlink("images/" . $image);
        }
    }
    $sql_delete = "DELETE FROM products WHERE product_id = ?";
    $delete = $db->execute($sql_delete, "i", [$id]);

    if ($delete) {
        header("Location: productmanagement.php");
        exit();
    } else {
        echo "Xóa không thành công!";
    }
} else {
    echo "Không có mã sản phẩm!";
}
