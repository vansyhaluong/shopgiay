<?php
require_once "Database.php";
$db = new Database();
$sql = "select * from products";
$products = $db->select($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm - Cửa Hàng Giày</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e40af;
            --accent: #f97316;
            --dark: #111827;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .btn-primary {
            background-color: #2563eb;
            /* blue-600 */
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            /* blue-700 */
        }

        .btn-secondary {
            background-color: #d1d5db;
            /* gray-300 */
            color: #111827;
            /* gray-900 */
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background-color: #9ca3af;
            /* gray-400 */
        }

        .btn-danger {
            background-color: #dc2626;
            /* red-600 */
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
            /* red-700 */
        }

        .btn-success {
            background-color: #16a34a;
            /* green-600 */
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background-color: #15803d;
            /* green-700 */
        }

        .input-field {
            width: 100%;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            /* gray-300 */
            border-radius: 8px;
        }

        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 2px #2563eb;
            /* ring-blue-600 */
        }

        .modal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* bg-opacity-50 */
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 8px;
            padding: 32px;
            max-width: 448px;
            /* max-w-md */
            width: 100%;
            margin: 0 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f3f4f6;
            /* gray-100 */
        }

        th,
        td {
            border: 1px solid #d1d5db;
            /* gray-300 */
            padding: 12px 24px;
            text-align: left;
        }

        th {
            font-weight: bold;
            color: #111827;
            /* gray-900 */
        }

        tbody tr:hover {
            background-color: #f9fafb;
            /* gray-50 */
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- HEADER -->
    <header class="bg-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="index.html" class="text-2xl font-bold text-blue-600">SHOE STORE</a>
                <nav class="hidden md:flex gap-8">
                    <a href="index.html" class="text-gray-600 hover:text-blue-600 transition">Trang Chủ</a>
                    <a href="admin.html" class="text-blue-600 font-semibold">Quản Lý</a>
                </nav>
                <a href="cart.html" class="text-2xl hover:text-blue-600 transition">🛒</a>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Quản Lý Sản Phẩm</h1>
            <button onclick="openAddModal()" class="btn-primary">+ Thêm Sản Phẩm</button>
        </div>

        <!-- PRODUCTS TABLE -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table>
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá (₫)</th>
                        <th>Hình ảnh</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody id="products-table">
                    <!-- Products will be loaded here by JavaScript -->
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <th><?= $p['product_id'] ?></th>
                            <th><?= $p['product_name'] ?></th>
                            <th><?= $p['price_id'] ?></th>
                            <th>
                                <img src="images/<?= $p['image'] ?>" width="80px" alt="">
                            </th>
                            <td>
                                <div class="flex gap-2">
                                    <a href="javascript:void(0)"
                                        onclick="openEditModal(
        <?= $p['product_id'] ?>,
        '<?= addslashes($p['product_name']) ?>',
        <?= $p['price_id'] ?>,
        '<?= addslashes($p['description']) ?>',
        '<?= $p['image'] ?>'
   )"
                                        class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition"
                                        title="Sửa">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                        href="deleteproduct.php?product_id=<?= $p['product_id'] ?>"
                                        class="p-2 rounded-lg bg-red-100 hover:bg-red-200 transition"
                                        title="Xóa">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- EMPTY STATE -->
        <div id="empty-state" class="text-center py-12 hidden">
            <p class="text-gray-600 text-lg">Chưa có sản phẩm nào. Hãy thêm sản phẩm đầu tiên!</p>
        </div>
    </main>

    <!-- ADD/EDIT MODAL -->
    <div id="product-modal" class="modal">
        <div class="modal-content">
            <h2 id="modal-title" class="text-2xl font-bold text-gray-900 mb-6">Thêm Sản Phẩm</h2>

            <form id="product-form" enctype="multipart/form-data" action="addproduct.php" class="space-y-4" method="POST">
                <div>
                    <input type="hidden" name="product_id" id="product_id">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tên Sản Phẩm *</label>
                    <input type="text" name="product_name" class="input-field" placeholder="VD: Giày Chạy Swift Pro" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Giá (₫) *</label>
                    <input type="number" name="product_price" class="input-field" placeholder="1290000" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Mô Tả</label>
                    <textarea name="description" class="input-field" rows="3" placeholder="Mô tả sản phẩm..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Hình Ảnh</label>
                    <input type="file" name="image" class="input-field" accept="image/*">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Ảnh hiện tại</label>
                    <img id="preview-image" src="" width="100" class="mb-2 rounded">
                </div>
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="btn-success flex-1">Lưu</button>
                    <button type="button" onclick="closeAddModal()" class="btn-secondary flex-1">Đóng</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        /* const STORAGE_KEY = 'shoe_products'; */

        // Default products
        /* const defaultProducts = [{
                id: 1,
                name: 'Giày Chạy Swift Pro',
                price: 1290000,
                originalPrice: 1850000,
                stock: 50,
                description: 'Giày chạy bộ hiệu suất cao với công nghệ đệm hơi tiên tiến',
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=400&fit=crop'
            },
            {
                id: 2,
                name: 'Giày Bóng Rổ Air Jump',
                price: 1890000,
                originalPrice: 2360000,
                stock: 30,
                description: 'Giày bóng rổ chuyên nghiệp với độ bám tốt',
                image: 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=300&h=400&fit=crop'
            },
            {
                id: 3,
                name: 'Giày Thời Trang Urban',
                price: 899000,
                originalPrice: 1500000,
                stock: 75,
                description: 'Giày thời trang đa năng cho mọi hoàn cảnh',
                image: 'https://images.unsplash.com/photo-1525966222134-fceba0dea025?w=300&h=400&fit=crop'
            },
            {
                id: 4,
                name: 'Giày Thể Thao Classic',
                price: 1590000,
                originalPrice: 1870000,
                stock: 45,
                description: 'Giày thể thao cơ bản nhưng thoải mái',
                image: 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300&h=400&fit=crop'
            }
        ]; */

        //let currentEditId = null;

        // Initialize
        /* function init() {
            let products = getProducts();
            if (products.length === 0) {
                products = defaultProducts;
                saveProducts(products);
            }
            renderProducts();
        } */

        // Get products from localStorage
        /* function getProducts() {
            const data = localStorage.getItem(STORAGE_KEY);
            return data ? JSON.parse(data) : [];
        } */

        // Save products to localStorage
        /* function saveProducts(products) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(products));
        } */

        // Render products table
        /* function renderProducts() {
            const products = getProducts();
            const tbody = document.getElementById('products-table');
            const emptyState = document.getElementById('empty-state');

            if (products.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            tbody.innerHTML = products.map(product => `
                <tr>
                    <td>#${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.price.toLocaleString('vi-VN')}</td>
                    <td>${product.originalPrice ? product.originalPrice.toLocaleString('vi-VN') : '-'}</td>
                    <td>${product.stock}</td>
                    <td>
                        <div class="flex gap-2">
                            <button onclick="editProduct(${product.id})" class="btn-secondary px-3 py-1 text-sm">Sửa</button>
                            <button onclick="deleteProduct(${product.id})" class="btn-danger px-3 py-1 text-sm">Xóa</button>
                        </div>
                    </td>
                </tr>
            `).join('');
        } */

        // Open add modal
        function openAddModal() {
            currentEditId = null;
            document.getElementById('modal-title').textContent = 'Thêm Sản Phẩm';
            document.getElementById('product-form').reset();
            document.getElementById('product-modal').classList.add('active');
        }

        // Close modal
        function closeAddModal() {
            document.getElementById('product-modal').classList.remove('active');
            currentEditId = null;
        }

        // Edit product
        function openEditModal(id, name, price, description, image) {
            document.getElementById("modal-title").innerText = "Sửa Sản Phẩm";
            document.getElementById("product-form").action = "edit_product.php";

            document.getElementById("product_id").value = id;
            document.querySelector("input[name='product_name']").value = name;
            document.querySelector("input[name='product_price']").value = price;
            document.querySelector("textarea[name='description']").value = description;
            // hiển thị ảnh cũ
            document.getElementById("preview-image").src = "images/" + image;

            // reset file input
            document.querySelector("input[name='image']").value = "";
            document.getElementById('product-modal').classList.add('active');
        }

        // Delete product
        /*   function deleteProduct(id) {
              if (confirm('Bạn chắc chắn muốn xóa sản phẩm này?')) {
                  let products = getProducts();
                  products = products.filter(p => p.id !== id);
                  saveProducts(products);
                  renderProducts();
              }
          } */

        // Save product
        /*         document.getElementById('product-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const name = document.getElementById('product-name').value;
                    const price = parseInt(document.getElementById('product-price').value);
                    const originalPrice = document.getElementById('product-original-price').value ?
                        parseInt(document.getElementById('product-original-price').value) : null;
                    const stock = parseInt(document.getElementById('product-stock').value);
                    const description = document.getElementById('product-description').value;
                    const image = document.getElementById('product-image').value;

                    let products = getProducts();

                    if (currentEditId) {
                        // Update existing product
                        const index = products.findIndex(p => p.id === currentEditId);
                        if (index !== -1) {
                            products[index] = {
                                id: currentEditId,
                                name,
                                price,
                                originalPrice,
                                stock,
                                description,
                                image
                            };
                        }
                    } else {
                        // Add new product
                        const newId = Math.max(...products.map(p => p.id), 0) + 1;
                        products.push({
                            id: newId,
                            name,
                            price,
                            originalPrice,
                            stock,
                            description,
                            image
                        });
                    }

                    saveProducts(products);
                    renderProducts();
                    closeAddModal();
                }); */

        // Close modal when clicking outside
        document.getElementById('product-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddModal();
            }
        });

        //init();
    </script>
</body>

</html>