<?php
require_once "Database.php";
$db = new Database();

$product_id = $_POST['product_id'] ?? 0;
$content = trim($_POST['content'] ?? '');

if ($product_id && $content) {
    // Thêm comment vào DB
    $sql = "INSERT INTO Comments (product_id, Content, CreatedAt) VALUES (?, ?, NOW())";
    $db->execute($sql, "is", [$product_id, $content]);

    // Lấy comment vừa insert
    $sql = "SELECT * FROM Comments WHERE CommentId = LAST_INSERT_ID()";
    $comment = $db->select($sql);

    header('Content-Type: application/json');
    echo json_encode($comment[0]);
    exit;
}
