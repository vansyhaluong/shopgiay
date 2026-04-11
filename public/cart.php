<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : "";
include "Database.php";
$db = new Database();
$sql = "SELECT * FROM products WHERE product_id = '$product_id'";
$product = $db->select($sql);
if (!empty($product)) {
    $p = $product[0];
}

if ($product) {
    $found = false;

    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $quantity; // ✅ đúng
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $p['product_id'],
            'product_name' => $p['product_name'],
            'price_id' => $p['price_id'],
            'image' => $p['image'],
            'quantity' => $quantity
        ];
    }
} */

$total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price_id'] * $item['quantity'];
    }
}
$subtotal = $total;
$shipping = ($subtotal >= 5000000) ? 0 : 30000;
$finalTotal = $subtotal + $shipping;
$totalQuantity = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalQuantity += $item['quantity'];
    }
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng - Shoe Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --secondary: #6b7280;
            --accent: #f97316;
            --accent-light: #fed7aa;
            --dark: #111827;
        }

        .btn-primary {
            background-color: #2563eb;
            /* blue-600 */
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            /* blue-700 */
        }

        .btn-secondary {
            background-color: #e5e7eb;
            /* gray-200 */
            color: #111827;
            /* gray-900 */
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
            /* gray-300 */
        }

        .btn-danger {
            background-color: #ef4444;
            /* red-500 */
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            /* red-600 */
        }

        .hover-lift {
            transition: all 0.3s;
        }

        .hover-lift:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .cart-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid #f3f4f6;
            /* gray-100 */
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #d1d5db;
            /* gray-300 */
            border-radius: 8px;
            width: fit-content;
        }

        .quantity-btn {
            padding: 4px 12px;
            font-size: 18px;
            color: #4b5563;
            /* gray-600 */
            transition: all 0.3s;
            cursor: pointer;
        }

        .quantity-btn:hover {
            color: #2563eb;
            /* blue-600 */
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- HEADER -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="index.html" class="text-2xl font-bold text-blue-600">👟 ShoeStore</a>
                <nav class="hidden md:flex gap-6">
                    <a href="index.html" class="text-gray-700 hover:text-blue-600 transition">Trang Chủ</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Sản Phẩm</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Về Chúng Tôi</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Liên Hệ</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <a href="cart.php" class="relative text-gray-700 hover:text-blue-600 transition text-2xl">
                    🛒
                    <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                        <?= $totalQuantity ?>
                    </span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Giỏ Hàng của Bạn</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Cart Item 1 -->
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                        <img src="images/<?= $item['image'] ?>" alt="" class="w-24 h-24 object-cover rounded-lg">

                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-900"><?= $item['product_name'] ?></h3>
                            <!-- <p class="text-gray-600 text-sm mb-2">Size: 40 | Màu: Xanh dương</p> -->
                            <p class="price text-blue-600 font-bold text-lg">
                                <?= number_format($item['price_id'], 0, ',', '.') ?>₫
                            </p>
                        </div>

                        <div class="flex items-center gap-4">

                            <div class="quantity-control flex items-center">

                                <button type="button" class="quantity-btn"
                                    onclick="updateQuantity(this, -1)">−</button>

                                <span class="text-lg font-semibold w-8 text-center quantity">
                                    <?= $item['quantity'] ?>
                                </span>

                                <button type="button" class="quantity-btn"
                                    onclick="updateQuantity(this, 1)">+</button>

                            </div>

                            <form method="POST" action="remove_cart.php" class="flex items-center">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button class="btn-danger h-10 px-4 flex items-center justify-center">
                                    Xóa
                                </button>
                            </form>

                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Continue Shopping -->
                <div class="mt-8">
                    <a href="index.php" class="inline-block btn-secondary">← Tiếp Tục Mua Sắm</a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Tóm Tắt Đơn Hàng</h2>

                    <div class="space-y-4 mb-6 border-b border-gray-200 pb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Tạm tính (<?= count($_SESSION['cart']) ?> sản phẩm):</span>
                            <span id="subtotal" class="font-semibold">
                                <?= number_format($subtotal, 0, ',', '.') ?>₫
                            </span>
                        </div>

                        <div class="flex justify-between text-gray-700">
                            <span>Phí vận chuyển:</span>
                            <span class="font-semibold" id="shipping">
                                <?= number_format($shipping, 0, ',', '.') ?>₫
                            </span>
                        </div>
                        <!-- <div class="flex justify-between text-gray-700">
                            <span>Giảm giá:</span>
                            <span class="font-semibold text-green-600">-200.000₫</span>
                        </div> -->
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-bold text-gray-900">Tổng cộng:</span>
                        <span class="text-2xl font-bold text-blue-600" id="total">
                            <?= number_format($finalTotal, 0, ',', '.') ?>₫
                        </span>
                    </div>

                    <a href="checkout.php"
                        class="block w-full text-center bg-blue-500 text-white py-3 rounded-lg text-lg mb-3 hover:bg-blue-600 transition">
                        Thanh Toán
                    </a>
                    <!-- <button class="w-full btn-secondary" onclick="applyCoupon()">Áp Dụng Mã Giảm Giá</button> -->

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-700">
                            <strong>✓ Miễn phí vận chuyển</strong> cho đơn hàng từ 5.000.000₫
                        </p>
                        <p class="text-sm text-gray-700 mt-2">
                            <strong>✓ Bảo hành</strong> 12 tháng cho tất cả sản phẩm
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty Cart Message (hidden by default) -->
        <div id="empty-cart" class="hidden text-center py-16">
            <p class="text-5xl mb-4">🛒</p>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Giỏ hàng của bạn đang trống</h2>
            <p class="text-gray-600 mb-8">Hãy bắt đầu mua sắm những chiếc giày tuyệt vời!</p>
            <a href="index.html" class="inline-block btn-primary">Quay lại trang chủ</a>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">👟 ShoeStore</h3>
                    <p class="text-gray-400">Cửa hàng giày uy tín hàng đầu với sản phẩm chất lượng cao.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Cửa Hàng</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Trang Chủ</a></li>
                        <li><a href="#" class="hover:text-white transition">Sản Phẩm</a></li>
                        <li><a href="#" class="hover:text-white transition">Khuyến Mãi</a></li>
                        <li><a href="#" class="hover:text-white transition">Liên Hệ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Hỗ Trợ</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Chính Sách Bảo Hành</a></li>
                        <li><a href="#" class="hover:text-white transition">Hướng Dẫn Đổi Trả</a></li>
                        <li><a href="#" class="hover:text-white transition">Câu Hỏi Thường Gặp</a></li>
                        <li><a href="#" class="hover:text-white transition">Điều Khoản Sử Dụng</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Liên Hệ</h4>
                    <p class="text-gray-400">📞 1900-1234</p>
                    <p class="text-gray-400">📧 support@shoestore.vn</p>
                    <p class="text-gray-400">📍 123 Đường ABC, HCM</p>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>&copy; 2026 ShoeStore. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        /*  function updateQuantity(btn, change) {
            const quantitySpan = btn.parentElement.querySelector('.quantity');
            let quantity = parseInt(quantitySpan.textContent);
            quantity = Math.max(1, quantity + change);
            quantitySpan.textContent = quantity;
            updateTotal();
        } */

        /* function removeItem(btn) {
            const cartItem = btn.closest('.cart-item');
            cartItem.remove();
            updateTotal();

            // Check if cart is empty
            const remainingItems = document.querySelectorAll('.cart-item').length;
            if (remainingItems === 0) {
                document.getElementById('empty-cart').classList.remove('hidden');
            }
        } */
        // gọi json từ file update_quantity
        function updateQuantity(btn, change) {
            const cartItem = btn.closest('.cart-item');
            const productId = cartItem.querySelector('input[name="product_id"]').value;

            fetch('update_quantity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `product_id=${productId}&change=${change}`
                })
                .then(response => response.json())
                .then(data => {
                    // update số lượng
                    cartItem.querySelector('.quantity').textContent = data.quantity;

                    // 👉 gọi lại hàm tính tổng
                    updateTotal();
                });
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const price = parseInt(item.querySelector('.price').textContent.replace(/\D/g, ''));
                const quantity = parseInt(item.querySelector('.quantity').textContent);
                total += price * quantity;
            });

            const shipping = 0;
            const discount = 0;
            const subtotal = total;
            const finalTotal = subtotal + shipping - discount;

            document.getElementById('subtotal').textContent = subtotal.toLocaleString('vi-VN') + '₫';
            document.getElementById('shipping').textContent = shipping.toLocaleString('vi-VN') + '₫';
            document.getElementById('total').textContent = finalTotal.toLocaleString('vi-VN') + '₫';
        }

        function checkout() {
            alert('Cảm ơn bạn! Bạn sẽ được chuyển đến trang thanh toán.');
        }

        function applyCoupon() {
            const code = prompt('Nhập mã giảm giá của bạn:');
            if (code) {
                alert('Mã "' + code + '" đã được áp dụng!');
            }
        }


        // Initialize
        updateTotal();
    </script>
</body>

</html>