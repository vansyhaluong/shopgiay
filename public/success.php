<?php
$order_id = $_GET['order_id'] ?? '---';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt Hàng Thành Công</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg text-center w-full max-w-md">

        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="bg-green-100 rounded-full p-4">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="3"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            🎉 Đặt hàng thành công!
        </h1>

        <p class="text-gray-600 mb-4">
            Cảm ơn bạn đã mua hàng tại cửa hàng.
        </p>

        <!-- Order info -->
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <!-- <p class="text-sm text-gray-500">Mã đơn hàng</p>
            <p class="text-lg font-semibold text-blue-600">
                #<?= $order_id ?>
            </p> -->
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-3">

            <a href="index.php"
                class="bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition">
                🛍 Tiếp tục mua sắm
            </a>

            <a href="my_orders.php"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-lg font-semibold transition">
                📦 Xem đơn hàng
            </a>

        </div>

    </div>

</body>

</html>