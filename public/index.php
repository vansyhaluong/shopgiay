<?php
require_once "./public/Database.php";
$db = new Database();
$sql = "select * from products";
$products = $db->select($sql);
var_dump($products);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKER STORE - Cửa hàng giày hiện đại</title>
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

<body class="bg-white text-gray-900">

    <!-- HEADER -->
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

    <!-- HERO SECTION -->
    <section id="home" class="bg-gradient-to-br from-blue-50 to-gray-50 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text Content -->
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                        Bộ Sưu Tập Giày Mới 2026
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Khám phá những đôi giày hiện đại, chất lượng cao với thiết kế độc đáo. Giảm giá đặc biệt cho các sản phẩm mới.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn-primary">Mua ngay</button>
                        <button class="btn-secondary">Xem sản phẩm</button>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="flex justify-center">
                    <img src="/images/<?= $products[0]['image'] ?>" alt="Giày thể thao mới" class="w-full max-w-sm rounded-2xl shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT CATEGORIES -->
    <section id="collections" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Danh Mục Sản Phẩm</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md cursor-pointer">
                    <div class="h-48 bg-blue-100 flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop" alt="Giày thể thao" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-bold text-lg text-gray-900">Giày Thể Thao</h3>
                        <p class="text-sm text-gray-600">Thoải mái & Bền</p>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md cursor-pointer">
                    <div class="h-48 bg-orange-100 flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop" alt="Giày chạy bộ" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-bold text-lg text-gray-900">Giày Chạy Bộ</h3>
                        <p class="text-sm text-gray-600">Nhẹ nhàng & Nhanh</p>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md cursor-pointer">
                    <div class="h-48 bg-green-100 flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop" alt="Giày bóng rổ" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-bold text-lg text-gray-900">Giày Bóng Rổ</h3>
                        <p class="text-sm text-gray-600">Hỗ trợ & Ổn định</p>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md cursor-pointer">
                    <div class="h-48 bg-purple-100 flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop" alt="Giày thời trang" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-bold text-lg text-gray-900">Giày Thời Trang</h3>
                        <p class="text-sm text-gray-600">Phong cách & Hiện đại</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section id="products" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Sản Phẩm Nổi Bật</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                    <div class="relative h-64 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=400&fit=crop" alt="Giày thể thao" class="w-full h-full object-cover">
                        <span class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-lg text-sm font-semibold">-30%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900">Giày Chạy Swift Pro</h3>
                        <div class="flex items-center gap-2 my-2">
                            <span class="text-yellow-500">★★★★★</span>
                            <span class="text-sm text-gray-600">(128)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-primary">1.290.000₫</span>
                            <span class="text-sm line-through text-gray-500">1.850.000₫</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 btn-secondary text-sm py-2">Chi tiết</button>
                            <button class="flex-1 btn-primary text-sm py-2">Thêm giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                    <div class="relative h-64 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=300&h=400&fit=crop" alt="Giày thể thao" class="w-full h-full object-cover">
                        <span class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-lg text-sm font-semibold">-20%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900">Giày Bóng Rổ Air Jump</h3>
                        <div class="flex items-center gap-2 my-2">
                            <span class="text-yellow-500">★★★★☆</span>
                            <span class="text-sm text-gray-600">(95)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-primary">1.890.000₫</span>
                            <span class="text-sm line-through text-gray-500">2.360.000₫</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 btn-secondary text-sm py-2">Chi tiết</button>
                            <button class="flex-1 btn-primary text-sm py-2">Thêm giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                    <div class="relative h-64 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1525966222134-fceba0dea025?w=300&h=400&fit=crop" alt="Giày thể thao" class="w-full h-full object-cover">
                        <span class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-lg text-sm font-semibold">-40%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900">Giày Thời Trang Urban</h3>
                        <div class="flex items-center gap-2 my-2">
                            <span class="text-yellow-500">★★★★★</span>
                            <span class="text-sm text-gray-600">(156)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-primary">899.000₫</span>
                            <span class="text-sm line-through text-gray-500">1.500.000₫</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 btn-secondary text-sm py-2">Chi tiết</button>
                            <button class="flex-1 btn-primary text-sm py-2">Thêm giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="hover-lift bg-white rounded-2xl overflow-hidden shadow-md">
                    <div class="relative h-64 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300&h=400&fit=crop" alt="Giày thể thao" class="w-full h-full object-cover">
                        <span class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-lg text-sm font-semibold">-15%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900">Giày Thể Thao Classic</h3>
                        <div class="flex items-center gap-2 my-2">
                            <span class="text-yellow-500">★★★★☆</span>
                            <span class="text-sm text-gray-600">(83)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-primary">1.590.000₫</span>
                            <span class="text-sm line-through text-gray-500">1.870.000₫</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 btn-secondary text-sm py-2">Chi tiết</button>
                            <button class="flex-1 btn-primary text-sm py-2">Thêm giỏ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROMOTIONAL BANNER -->
    <section id="promo" class="py-16 bg-gradient-to-r from-accent to-orange-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Giảm giá lên đến 50%</h2>
            <p class="text-lg text-orange-50 mb-8">Chỉ áp dụng cho các sản phẩm được chọn. Thời gian còn hạn!</p>
            <button class="btn-secondary">Mua ngay</button>
        </div>
    </section>

    <!-- PRODUCT DETAIL SECTION -->
    <section id="product-detail" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-12 text-gray-900">Chi Tiết Sản Phẩm</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                <!-- Product Images -->
                <div>
                    <div class="mb-4 bg-gray-100 rounded-2xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=600&fit=crop" alt="Giày chi tiết" class="w-full h-96 object-cover">
                    </div>
                    <div class="grid grid-cols-4 gap-3">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&h=150&fit=crop" alt="Thumb 1" class="w-full rounded-lg cursor-pointer hover:opacity-80 transition border-2 border-primary">
                        <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=150&h=150&fit=crop" alt="Thumb 2" class="w-full rounded-lg cursor-pointer hover:opacity-80 transition border-2 border-gray-200">
                        <img src="https://images.unsplash.com/photo-1525966222134-fceba0dea025?w=150&h=150&fit=crop" alt="Thumb 3" class="w-full rounded-lg cursor-pointer hover:opacity-80 transition border-2 border-gray-200">
                        <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=150&h=150&fit=crop" alt="Thumb 4" class="w-full rounded-lg cursor-pointer hover:opacity-80 transition border-2 border-gray-200">
                    </div>
                </div>

                <!-- Product Details -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Giày Chạy Swift Pro 2026</h1>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl text-yellow-500">★★★★★</span>
                        <span class="text-gray-600">(128 đánh giá)</span>
                    </div>

                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-4xl font-bold text-primary">1.290.000₫</span>
                        <span class="text-xl line-through text-gray-500">1.850.000₫</span>
                        <span class="bg-accent text-white px-3 py-1 rounded-lg font-semibold">-30%</span>
                    </div>

                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Giày chạy bộ hiệu suất cao với công nghệ đệm hơi tiên tiến, giúp giảm chấn thương khi tập luyện. Thiết kế ergonomic phù hợp với mọi hình dáng bàn chân.
                    </p>

                    <!-- Size Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Chọn Size:</label>
                        <div class="flex flex-wrap gap-3">
                            <button class="size-btn selected" onclick="this.classList.toggle('selected')">38</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">39</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">40</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">41</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">42</button>
                        </div>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Chọn Màu:</label>
                        <div class="flex gap-4">
                            <div class="color-dot selected" style="background-color: #1e40af;" onclick="this.classList.toggle('selected')"></div>
                            <div class="color-dot" style="background-color: #dc2626;" onclick="this.classList.toggle('selected')"></div>
                            <div class="color-dot" style="background-color: #16a34a;" onclick="this.classList.toggle('selected')"></div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Số Lượng:</label>
                        <div class="flex items-center gap-4 border border-gray-300 rounded-lg w-fit">
                            <button class="px-4 py-2 text-xl text-gray-600 hover:text-primary transition">−</button>
                            <span class="text-lg font-semibold w-8 text-center">1</span>
                            <button class="px-4 py-2 text-xl text-gray-600 hover:text-primary transition">+</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn-primary flex-1 text-lg">Thêm vào Giỏ Hàng</button>
                        <button class="btn-accent flex-1 text-lg">Mua Ngay</button>
                    </div>
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

    <!-- FOOTER -->
    <footer id="contact" class="bg-dark text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h4 class="text-lg font-bold mb-4">👟 SNEAKER STORE</h4>
                    <p class="text-gray-400 text-sm">Cung cấp những đôi giày chất lượng cao cho mọi lứa tuổi.</p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Liên Kết Nhanh</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary transition">Về Chúng Tôi</a></li>
                        <li><a href="#" class="hover:text-primary transition">Sản Phẩm</a></li>
                        <li><a href="#" class="hover:text-primary transition">Blog</a></li>
                        <li><a href="#" class="hover:text-primary transition">Hỗ Trợ</a></li>
                    </ul>
                </div>

                <!-- Policies -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Chính Sách</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary transition">Chính Sách Bảo Mật</a></li>
                        <li><a href="#" class="hover:text-primary transition">Điều Khoản Dịch Vụ</a></li>
                        <li><a href="#" class="hover:text-primary transition">Đổi Trả Hàng</a></li>
                        <li><a href="#" class="hover:text-primary transition">Vận Chuyển</a></li>
                    </ul>
                </div>

                <!-- Social -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Kết Nối Với Chúng Tôi</h4>
                    <div class="flex gap-4 text-2xl">
                        <a href="#" class="hover:text-primary transition">📘</a>
                        <a href="#" class="hover:text-primary transition">📷</a>
                        <a href="#" class="hover:text-primary transition">🐦</a>
                        <a href="#" class="hover:text-primary transition">▶️</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2026 SNEAKER STORE. Bảo lưu mọi quyền. Thiết kế hiện đại bằng HTML5 & Tailwind CSS.</p>
            </div>
        </div>
    </footer>

    <script>
        // Tab functionality
        function showTab(event, tabName) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Show selected tab and mark button active
            document.getElementById(tabName).classList.remove('hidden');
            event.target.classList.add('active');
        }

        // Mobile menu toggle
        document.querySelector('button.md\\:hidden').addEventListener('click', function() {
            const nav = document.querySelector('nav');
            nav.classList.toggle('hidden');
        });
    </script>
</body>

</html>