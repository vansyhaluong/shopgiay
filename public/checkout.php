<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
    exit;
}

// tính tiền
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price_id'] * $item['quantity'];
}

$total = $subtotal;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background-color: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        header nav {
            display: flex;
            gap: 20px;
        }

        header a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .checkout-form {
            background-color: white;
            padding: 25px;
            border: 1px solid #ddd;
        }

        .form-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .form-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #1e40af;
            box-shadow: 0 0 0 2px rgba(30, 64, 175, 0.1);
        }

        .payment-method {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }

        .payment-option input[type="radio"] {
            cursor: pointer;
            width: auto;
            border: none;
        }

        .payment-option:hover {
            background-color: #f5f5f5;
        }

        .order-summary {
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
            height: fit-content;
        }

        .order-summary h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .order-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-name {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .item-qty {
            font-size: 12px;
            color: #666;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-total {
            font-weight: bold;
            font-size: 18px;
            color: #1e40af;
            padding-top: 10px;
            margin-top: 10px;
            border-top: 2px solid #1e40af;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            width: 100%;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #1e40af;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1e3a8a;
        }

        .btn-secondary {
            background-color: #ddd;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #ccc;
        }

        .success-message {
            display: none;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .success-message.show {
            display: block;
        }

        @media (max-width: 768px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: white;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="index.html">Trang Chủ</a>
            <a href="cart.html">Giỏ Hàng</a>
            <a href="checkout.html">Thanh Toán</a>
        </nav>
    </header>

    <div class="container">
        <h1>Thanh Toán</h1>

        <div id="successMessage" class="success-message">
            ✓ Đơn hàng của bạn đã được tạo thành công!
        </div>

        <div class="checkout-layout">
            <!-- Checkout Form -->
            <form id="checkoutForm" class="checkout-form" method="post" action="place_order.php">
                <!-- Customer Info -->
                <div class="form-section">
                    <h2>Thông Tin Khách Hàng</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Họ và Tên *</label>
                            <input type="text" name="fullname" required>
                        </div>

                        <div class="form-group">
                            <label>Số Điện Thoại *</label>
                            <input type="tel" name="phone" required>
                        </div>
                    </div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email">
                        </div>
                    </div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label>Địa Chỉ *</label>
                            <input type="text" name="address" placeholder="VD: 123 Đường ABC" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tỉnh/Thành Phố *</label>
                            <select id="city" name="city" required>
                                <option value="">-- Chọn Tỉnh/TP --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Quận/Huyện *</label>
                            <select id="district" name="district" required disabled>
                                <option value="">-- Chọn Quận/Huyện --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Phường/Xã *</label>
                            <select id="ward" name="ward" required disabled>
                                <option value="">-- Chọn Phường/Xã --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <!-- <div class="form-section">
                    <h2>Phương Thức Thanh Toán</h2>
                    <div class="payment-method">
                        <label class="payment-option">
                            <input type="radio" name="payment" value="cod" checked>
                            <span>Thanh Toán Khi Nhận Hàng</span>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment" value="bank">
                            <span>Chuyển Khoản Ngân Hàng</span>
                        </label>
                    </div>
                </div> -->

                <button type="submit" class="btn btn-primary">Đặt hàng</button>
                <a href="cart.php" style="display: block; margin-top: 10px;">
                    <button type="button" class="btn btn-secondary">Quay Lại Giỏ Hàng</button>
                </a>
            </form>

            <!-- Order Summary -->
            <div class="order-summary">
                <h2>Tóm Tắt Đơn Hàng</h2>
                <div>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="order-item">
                            <div class="item-name">
                                <span><?= $item['product_name'] ?></span>
                                <span>
                                    <?= number_format($item['price_id'] * $item['quantity'], 0, ',', '.') ?>₫
                                </span>
                            </div>
                            <div class="item-qty">
                                Số lượng: <?= $item['quantity'] ?> x <?= number_format($item['price_id'], 0, ',', '.') ?>₫
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!--  <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span id="subtotal">0₫</span>
                </div> -->

                <div class="summary-row summary-total">
                    <span>Tổng cộng:</span>
                    <span id="total"><?= number_format($total, 0, ',', '.') ?>₫</span>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Shoe Store. All rights reserved.</p>
    </footer>

    <script>
        const citySelect = document.getElementById('city');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        // load tỉnh
        fetch('https://provinces.open-api.vn/api/p/')
            .then(res => res.json())
            .then(data => {
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.name}" data-code="${city.code}">${city.name}</option>`;
                });
            });

        // khi chọn tỉnh
        citySelect.addEventListener('change', function() {
            const code = this.options[this.selectedIndex].dataset.code;

            districtSelect.innerHTML = '<option>-- Đang tải... --</option>';
            districtSelect.disabled = true;

            fetch(`https://provinces.open-api.vn/api/p/${code}?depth=2`)
                .then(res => res.json())
                .then(data => {
                    districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
                    data.districts.forEach(d => {
                        districtSelect.innerHTML += `<option value="${d.name}" data-code="${d.code}">${d.name}</option>`;
                    });
                    districtSelect.disabled = false;
                });
        });

        // khi chọn quận
        districtSelect.addEventListener('change', function() {
            const code = this.options[this.selectedIndex].dataset.code;

            wardSelect.innerHTML = '<option>-- Đang tải... --</option>';
            wardSelect.disabled = true;

            fetch(`https://provinces.open-api.vn/api/d/${code}?depth=2`)
                .then(res => res.json())
                .then(data => {
                    wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                    data.wards.forEach(w => {
                        wardSelect.innerHTML += `<option value="${w.name}">${w.name}</option>`;
                    });
                    wardSelect.disabled = false;
                });
        });
    </script>
</body>

</html>