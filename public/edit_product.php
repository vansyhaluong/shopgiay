<?php
require_once "Database.php";
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['description'];

    // Lấy ảnh cũ
    $sql = "SELECT image FROM products WHERE product_id = ?";
    $old = $db->select($sql, "i", [$id]);

    $oldImage = "";
    if (!empty($old)) {
        $oldImage = $old[0]['image'];
    }

    $newImage = $oldImage; // mặc định giữ ảnh cũ

    // Nếu có upload ảnh mới
    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {

        $imageName = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "images/" . $imageName);

        // Xóa ảnh cũ
        if ($oldImage && file_exists("images/" . $oldImage)) {
            unlink("images/" . $oldImage);
        }

        $newImage = $imageName;
    }

    // Update DB
    $sql_update = "UPDATE products 
                   SET product_name = ?, price_id = ?, description = ?, image = ?
                   WHERE product_id = ?";

    $result = $db->execute($sql_update, "sissi", [
        $name,
        $price,
        $description,
        $newImage,
        $id
    ]);

    if ($result) {
        header("Location: productmanagement.php");
        exit();
    } else {
        echo "Cập nhật thất bại!";
    }
} else {
    echo "Request không hợp lệ!";
}
