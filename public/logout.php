<?php
session_start();

// Xóa tất cả session
$_SESSION = [];

// Hủy session
session_destroy();

// Quay về trang chủ
header("Location: index.php");
exit();
