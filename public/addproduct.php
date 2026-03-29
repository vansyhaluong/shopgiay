<?php
include "Database.php";
$db = new Database();
$name = $_POST['product_name'];
$price = $_POST['product_price'];
$description = $_POST['description'];

// xử lý upload ảnh
$imagePath = "";

if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

    $imageName = time() . "_" . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // lưu vào thư mục images
    move_uploaded_file($tmp, "images/" . $imageName);

    // chỉ lưu tên vào DB
    $imagePath = $imageName;
}

// lưu DB
$sql = "INSERT INTO products (product_name, price_id, description, image)
        VALUES ('$name', '$price', '$description', '$imagePath')";

if ($db->execute($sql) === TRUE) {
    header("location: productmanagement.php");
    exit();
} else {
    echo "Lỗi: ";
}
