<?php
session_start();
include "Database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$db = new Database();
$user_id = $_SESSION['user_id'];

/*
Lấy tất cả orders của user
*/
$sqlOrders = "SELECT * FROM orders 
              WHERE user_id = ?
              ORDER BY created_at DESC";

$orders = $db->select($sqlOrders, "i", [$user_id]);

function getStatusInfo($status)
{
    switch ($status) {
        case 'pending':
            return ['Chờ gửi hàng', 'bg-yellow-100 text-yellow-700'];
        case 'completed':
            return ['Hoàn tất', 'bg-green-100 text-green-700'];
        case 'cancelled':
            return ['Đã hủy', 'bg-red-100 text-red-700'];
        default:
            return [$status, 'bg-gray-100 text-gray-700'];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đơn Mua Của Tôi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto py-8 px-4">

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">📦 Đơn Mua Của Tôi</h1>
            <p class="text-gray-500 mt-1">Theo dõi và quản lý đơn hàng của bạn</p>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-xl shadow-sm mb-6">
            <div class="flex border-b overflow-x-auto">
                <button onclick="filterOrders('all', event)" class="tab-btn px-6 py-4 text-orange-500 border-b-2 border-orange-500 font-medium">
                    Tất cả
                </button>
                <button onclick="filterOrders('pending', event)" class="tab-btn px-6 py-4 text-gray-500 font-medium">
                    Chờ gửi hàng
                </button>
                <button onclick="filterOrders('completed', event)" class="tab-btn px-6 py-4 text-gray-500 font-medium">
                    Hoàn tất
                </button>
                <button onclick="filterOrders('cancelled', event)" class="tab-btn px-6 py-4 text-gray-500 font-medium">
                    Đã hủy
                </button>
            </div>
        </div>

        <div id="ordersContainer" class="space-y-4">

            <?php if (empty($orders)): ?>
                <div class="bg-white rounded-xl p-10 text-center shadow-sm">
                    <p class="text-gray-500 text-lg">Bạn chưa có đơn hàng nào.</p>
                </div>
            <?php endif; ?>

            <?php foreach ($orders as $order): ?>
                <?php
                $statusInfo = getStatusInfo($order['status']);

                $sqlItems = "
                SELECT oi.*, p.product_name, p.image
                FROM order_items oi
                JOIN products p ON oi.product_id = p.product_id
                WHERE oi.order_id = ?
            ";

                $items = $db->select($sqlItems, "i", [$order['order_id']]);
                ?>

                <div class="order-card bg-white rounded-xl shadow-sm p-5"
                    data-status="<?= $order['status'] ?>">

                    <!-- Header -->
                    <div class="flex justify-between items-center border-b pb-3 mb-4">
                        <div>
                            <span class="font-semibold text-gray-800">
                                Đơn hàng #<?= $order['order_id'] ?>
                            </span>
                            <p class="text-sm text-gray-400">
                                <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                            </p>
                        </div>

                        <span class="text-sm px-3 py-1 rounded-full font-medium <?= $statusInfo[1] ?>">
                            <?= $statusInfo[0] ?>
                        </span>
                    </div>

                    <!-- Items -->
                    <div class="space-y-4">
                        <?php foreach ($items as $item): ?>
                            <div class="flex items-center gap-4">
                                <img src="images/<?= $item['image'] ?>"
                                    class="w-20 h-20 rounded-lg object-cover border">

                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">
                                        <?= $item['product_name'] ?>
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Số lượng: <?= $item['quantity'] ?>
                                    </p>
                                </div>

                                <span class="font-bold text-orange-500">
                                    <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>₫
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Footer -->
                    <div class="border-t mt-4 pt-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">
                            Tổng tiền:
                            <span class="text-xl text-orange-500">
                                <?= number_format($order['total_amount'], 0, ',', '.') ?>₫
                            </span>
                        </span>

                        <?php if ($order['status'] == 'pending'): ?>
                            <form action="cancel_order.php" method="POST">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg font-medium transition">
                                    Hủy Đơn
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    </div>

    <script>
        function filterOrders(status, event) {
            const cards = document.querySelectorAll('.order-card');
            const tabs = document.querySelectorAll('.tab-btn');

            tabs.forEach(tab => {
                tab.classList.remove('text-orange-500', 'border-b-2', 'border-orange-500');
                tab.classList.add('text-gray-500');
            });

            event.target.classList.add('text-orange-500', 'border-b-2', 'border-orange-500');

            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>