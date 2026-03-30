<form method="POST" action="cart.php">
    <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
    <input type="hidden" name="product_name" value="<?= $p['product_name'] ?>">
    <input type="hidden" name="price" value="<?= $p['price_id'] ?>">
    <input type="hidden" name="image" value="<?= $p['image'] ?>">
    <div>
        <div class="mb-4 bg-gray-100 rounded-2xl overflow-hidden">

            <img src="images/<?= $p['image'] ?>" alt="Giày chi tiết" class="w-full h-96 object-cover">

        </div>
    </div>

    <!-- Product Details -->
    <div>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2"><?= $p['product_name'] ?></h1>

        <!-- <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Giày Chạy Swift Pro 2026</h1> -->

        <div class="flex items-center gap-3 mb-4">
            <span class="text-2xl text-yellow-500">★★★★★</span>
            <span class="text-gray-600">(128 đánh giá)</span>
        </div>

        <div class="flex items-center gap-4 mb-6">

            <span class="text-4xl font-bold text-primary"><?= $p['price_id'] ?></span>
            <!--  <span class="text-4xl font-bold text-primary">1.290.000₫</span>
                        <span class="text-xl line-through text-gray-500">1.850.000₫</span> -->

            <span class="bg-accent text-white px-3 py-1 rounded-lg font-semibold">-30%</span>
        </div>

        <p class="text-gray-600 mb-6 leading-relaxed">

            <?= $p['description'] ?>
        </p>

        <!-- Size Selection -->
        <!--   <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Chọn Size:</label>
                        <div class="flex flex-wrap gap-3">
                            <button class="size-btn selected" onclick="this.classList.toggle('selected')">38</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">39</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">40</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">41</button>
                            <button class="size-btn" onclick="this.classList.toggle('selected')">42</button>
                        </div>
                    </div> -->

        <!-- Color Selection -->
        <!--     <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Chọn Màu:</label>
                        <div class="flex gap-4">
                            <div class="color-dot selected" style="background-color: #1e40af;" onclick="this.classList.toggle('selected')"></div>
                            <div class="color-dot" style="background-color: #dc2626;" onclick="this.classList.toggle('selected')"></div>
                            <div class="color-dot" style="background-color: #16a34a;" onclick="this.classList.toggle('selected')"></div>
                        </div>
                    </div> -->

        <!-- Quantity -->
        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-900 mb-3">Số Lượng:</label>

            <div class="flex items-center gap-4 border border-gray-300 rounded-lg w-fit">
                <button type="button" id="minusBtn"
                    class="px-4 py-2 text-xl text-gray-600 hover:text-primary transition">−</button>

                <input type="number" id="quantity" name="quantity"
                    value="1" min="1"
                    class="text-lg font-semibold w-12 text-center outline-none">

                <button type="button" id="plusBtn"
                    class="px-4 py-2 text-xl text-gray-600 hover:text-primary transition">+</button>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <button type="submit" class="btn-primary flex-1 text-lg">Thêm vào Giỏ Hàng</button>
            <button class="btn-accent flex-1 text-lg">Mua Ngay</button>
        </div>
    </div>
</form>