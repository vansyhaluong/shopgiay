<?php

require_once "Database.php";

$db = new Database();

$p = null;

if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];

    $sql = "SELECT * FROM products WHERE product_id = ?";
    $product = $db->select($sql, "i", [$id]);

    if (!empty($product)) {
        $p = $product[0];
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        accent: '#f97316',
                        dark: '#1f2937',
                    }
                }
            }
        }
    </script>
    <style>
        * {
            scroll-behavior: smooth;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            padding: 12px 24px;
            background-color: #2563eb;
            /* blue-600 */
            color: white;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            /* blue-700 */
        }

        .btn-primary:active {
            transform: scale(0.95);
        }

        .btn-secondary {
            padding: 12px 24px;
            background: white;
            color: #2563eb;
            border: 2px solid #2563eb;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #eff6ff;
            /* blue-50 */
        }

        .btn-accent {
            padding: 12px 24px;
            /* px-6 py-3 */
            background-color: #f97316;
            /* orange-500 (giả sử accent là cam) */
            color: white;
            border-radius: 8px;
            /* rounded-lg */
            font-weight: 600;
            /* font-semibold */
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-accent:hover {
            background-color: #ea580c;
            /* orange-600 */
        }

        .btn-accent:active {
            transform: scale(0.95);
        }

        .tab-button {
            padding: 0 16px 12px 16px;
            /* px-4 pb-3 */
            border-bottom: 2px solid #e5e7eb;
            /* gray-200 */
            color: #4b5563;
            /* gray-600 */
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            background: none;
        }

        .tab-button.active {
            border-bottom: 2px solid #2563eb;
            /* primary (blue-600) */
            color: #2563eb;
        }

        .size-btn {
            width: 48px;
            height: 48px;
            border: 2px solid #d1d5db;
            /* gray-300 */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .size-btn:hover {
            border-color: #2563eb;
        }

        .size-btn.selected {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .color-dot {
            width: 32px;
            /* w-8 */
            height: 32px;
            /* h-8 */
            border-radius: 9999px;
            /* rounded-full */
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            /* border-2 border-transparent */
        }

        .color-dot:hover {
            border-color: #9ca3af;
            /* gray-400 */
        }

        .color-dot.selected {
            border-color: #2563eb;
            /* primary (blue-600) */
        }
    </style>
</head>

<body>
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between gap-8">
                <!-- Logo -->
                <div class="text-2xl font-bold text-primary">
                    👟 SNEAKER STORE
                </div>

                <!-- Menu Desktop -->
                <nav class="hidden md:flex items-center gap-8 flex-1 justify-center">
                    <a href="#home" class="text-gray-700 font-medium hover:text-primary transition">Trang chủ</a>
                    <a href="#products" class="text-gray-700 font-medium hover:text-primary transition">Sản phẩm</a>
                    <a href="#collections" class="text-gray-700 font-medium hover:text-primary transition">Bộ sưu tập</a>
                    <a href="#promo" class="text-gray-700 font-medium hover:text-primary transition">Khuyến mãi</a>
                    <a href="#contact" class="text-gray-700 font-medium hover:text-primary transition">Liên hệ</a>
                </nav>

                <!-- Search & Cart -->
                <div class="flex items-center gap-4 ml-auto">
                    <div class="hidden sm:flex items-center bg-gray-100 rounded-lg px-3 py-2">
                        <input type="text" placeholder="Tìm kiếm..." class="bg-transparent outline-none text-sm w-40 placeholder-gray-500">
                        <span class="text-gray-400">🔍</span>
                    </div>
                    <button class="text-2xl hover:text-primary transition">🛒</button>
                    <button class="md:hidden text-2xl">☰</button>
                </div>
            </div>
        </div>
    </header>
    <section id="product-detail" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-12 text-gray-900">Chi Tiết Sản Phẩm</h2>

            <div class="flex flex-col lg:flex-row gap-10">

                <!-- 🖼️ ẢNH -->
                <div class="w-full lg:w-1/2">
                    <div class="mb-4 bg-gray-100 rounded-2xl overflow-hidden">
                        <img src="images/<?= $p['image'] ?>"
                            alt="Giày chi tiết"
                            class="w-full h-96 object-cover">
                    </div>
                </div>

                <!-- 📝 THÔNG TIN + FORM -->
                <div class="w-full lg:w-1/2">
                    <form method="POST" action="cart.php">

                        <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $p['product_name'] ?>">
                        <input type="hidden" name="price" value="<?= $p['price_id'] ?>">
                        <input type="hidden" name="image" value="<?= $p['image'] ?>">

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                            <?= $p['product_name'] ?>
                        </h1>

                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-2xl text-yellow-500">★★★★★</span>
                            <span class="text-gray-600">(128 đánh giá)</span>
                        </div>

                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-4xl font-bold text-primary">
                                <?= $p['price_id'] ?>
                            </span>
                            <span class="bg-accent text-white px-3 py-1 rounded-lg font-semibold">
                                -30%
                            </span>
                        </div>

                        <p class="text-gray-600 mb-6 leading-relaxed">
                            <?= $p['description'] ?>
                        </p>

                        <!-- Quantity -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-900 mb-3">
                                Số Lượng:
                            </label>

                            <div class="flex items-center gap-4 border border-gray-300 rounded-lg w-fit">
                                <button type="button" id="minusBtn"
                                    class="px-4 py-2 text-xl text-gray-600 hover:text-primary transition">−</button>

                                <input type="number" name="quantity"
                                    value="1" min="1"
                                    class="text-lg font-semibold w-12 text-center outline-none">

                                <button type="button" id="plusBtn"
                                    class="px-4 py-2 text-xl text-gray-600 hover:text-primary transition">+</button>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="btn-primary flex-1 text-lg">
                                Thêm vào Giỏ Hàng
                            </button>
                            <button class="btn-accent flex-1 text-lg">
                                Mua Ngay
                            </button>
                        </div>

                    </form>
                </div>

            </div>

            <!-- Product Tabs -->
            <div class="border-b border-gray-200 mb-8">
                <div class="flex gap-8">
                    <button class="tab-button active" onclick="showTab(event, 'description')">Mô Tả</button>
                    <button class="tab-button" onclick="showTab(event, 'specs')">Thông Số Kỹ Thuật</button>
                    <button class="tab-button" onclick="showTab(event, 'reviews')">Đánh Giá</button>
                </div>
            </div>

            <!-- Tab Contents -->
            <div id="description" class="tab-content mb-12">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Mô Tả Chi Tiết</h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Giày Chạy Swift Pro 2026 là sản phẩm tối tân nhất của chúng tôi, được thiết kế dành riêng cho những người yêu thích chạy bộ. Với công nghệ đệm hơi AeroMax, giày cung cấp sự thoải mái tuyệt vời cho mỗi bước chân.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Chất liệu vải mesh thoáng khí giúp chân luôn khô ráo, trong khi đó lớp đệm đàn hồi hỗ trợ vòm bàn chân hoàn hảo. Giày này phù hợp cho cả huấn luyện hàng ngày lẫn các cuộc thi chạy chuyên nghiệp.
                </p>
            </div>

            <div id="specs" class="tab-content mb-12 hidden">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Thông Số Kỹ Thuật</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4 font-semibold text-gray-900 bg-gray-50">Trọng lượng</td>
                            <td class="py-3 px-4 text-gray-600">230g (một đôi)</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4 font-semibold text-gray-900 bg-gray-50">Chất liệu</td>
                            <td class="py-3 px-4 text-gray-600">Mesh/Vải tổng hợp</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4 font-semibold text-gray-900 bg-gray-50">Đế</td>
                            <td class="py-3 px-4 text-gray-600">Cao su chống trơn</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4 font-semibold text-gray-900 bg-gray-50">Độ cao gót</td>
                            <td class="py-3 px-4 text-gray-600">18mm</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 font-semibold text-gray-900 bg-gray-50">Bảo hành</td>
                            <td class="py-3 px-4 text-gray-600">12 tháng</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="reviews" class="tab-content mb-12 hidden">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Đánh Giá Từ Khách Hàng</h3>
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-900">Nguyễn Văn A</span>
                            <span class="text-yellow-500">★★★★★</span>
                        </div>
                        <p class="text-gray-600">"Giày rất thoải mái, tôi chạy được 10km mà không cảm thấy chân mệt. Chất lượng tuyệt vời!"</p>
                    </div>
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-900">Trần Thị B</span>
                            <span class="text-yellow-500">★★★★☆</span>
                        </div>
                        <p class="text-gray-600">"Giày rất đẹp, nhưng mất một chút thời gian để quen. Giá cả hợp lý cho chất lượng này."</p>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Sản Phẩm Liên Quan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=300&h=300&fit=crop" alt="Giày liên quan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-2">Giày Bóng Rổ Air Jump</h4>
                            <p class="text-2xl font-bold text-primary">1.890.000₫</p>
                        </div>
                    </div>

                    <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1525966222134-fceba0dea025?w=300&h=300&fit=crop" alt="Giày liên quan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-2">Giày Thời Trang Urban</h4>
                            <p class="text-2xl font-bold text-primary">899.000₫</p>
                        </div>
                    </div>

                    <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300&h=300&fit=crop" alt="Giày liên quan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-2">Giày Thể Thao Classic</h4>
                            <p class="text-2xl font-bold text-primary">1.590.000₫</p>
                        </div>
                    </div>

                    <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop" alt="Giày liên quan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-2">Giày Chạy Swift Pro</h4>
                            <p class="text-2xl font-bold text-primary">1.290.000₫</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>
<script>
    const qty = document.getElementById("quantity");
    const plus = document.getElementById("plusBtn");
    const minus = document.getElementById("minusBtn");

    plus.onclick = () => {
        qty.value = parseInt(qty.value) + 1;
    };

    minus.onclick = () => {
        if (qty.value > 1) {
            qty.value = parseInt(qty.value) - 1;
        }
    };
</script>

</html>