<?php 
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $data = isset($_POST['datas']) ? $_POST['datas'] : '';
    
    if ($category =='xemay') { ?>
<div id="xemay" class="product-grid">
    <?php foreach($data as $value) {
            if($value['service_category_id'] == 1) { ?>
    <div class="product-card">
        <img src="/quan-ly-tour/<?=$value['image_url']?>" alt="Xe máy" class="product-img">
        <div class="product-info">
            <p style="color: black;"><?=$value['name']?></p>
            <p><?= number_format($value['price'])?> VNĐ</p>
            <div class="product-controls">
                <button class="quantity-btn text decrease">-</button>
                <input type="text" value="0" class="quantity-input" name="data_post[qty]">
                <button class="quantity-btn text increase">+</button>
            </div>
            <button class="add-to-cart-btn" name-service=<?= $value['slug_service'] ?>>Thêm vào giỏ hàng</button>
        </div>
    </div>
    <?php } 
    } ?>
</div>
<?php }

else if ($category =='camtrai'){?>
<div class="product-grid">
    <?php foreach($data as $value) {?>
    <?php if($value['service_category_id'] == 3) { ?>
    <div class="product-card">
        <img src="/quan-ly-tour/<?=$value['image_url']?>" alt="Lều trại" class="product-img"
            style="width: 210px; height: 212px;">
        <div class="product-info">
            <p style="color: black;"><?=$value['name']?></p>
            <p><?= number_format($value['price'])?> VNĐ</p>
            <div class="product-controls">

                <button class="quantity-btn text decrease">-</button>
                <input type="text" value="0" class="quantity-input" name="data_post[qty]">
                <button class="quantity-btn text increase">+</button>

            </div>
            <button class="add-to-cart-btn" name-service=<?= $value['slug_service'] ?>>Thêm vào giỏ hàng</button>
        </div>
    </div>
    <?php } }?>
</div>
<?php }
else if ($category =='oto'){?>
<div class="product-grid">
    <?php foreach($data as $value) {?>
    <?php if($value['service_category_id'] == 2) { ?>
    <div class="product-card">
        <img src="/quan-ly-tour/<?=$value['image_url']?>" alt="Ô tô" class="product-img"
            style="width: 210px;height: 212px;">
        <div class="product-info">
            <p style="color: black;"><?=$value['name']?></p>
            <p><?= number_format($value['price'])?> VNĐ</p>
            <div class="product-controls">

                <button class="quantity-btn text decrease">-</button>
                <input type="text" value="0" class="quantity-input" name="data_post[qty]">
                <button class="quantity-btn text increase">+</button>

            </div>
            <button class="add-to-cart-btn" name-service=<?= $value['slug_service'] ?>>Thêm vào giỏ hàng</button>
        </div>

    </div>
    <?php }?>
    <?php }?>
</div>
<?php }?>
<script>
document.querySelectorAll(".add-to-cart-btn").forEach(button => {
    button.addEventListener('click', (e) => {
        const productCard = e.target.closest('.product-card');
        const qty = productCard.querySelector('input[name="data_post[qty]"]').value;
        const slug_service = e.target.getAttribute('name-service');

        // Kiểm tra giá trị qty
        if (qty > 0) {
            // Gửi yêu cầu AJAX để thêm vào giỏ hàng
            $.ajax({
                url: '/quan-ly-tour/cart/addCart', // Đường dẫn đến hàm addCart
                method: 'POST',
                data: {
                    slug_service: slug_service,
                    qty: qty
                },
                success: function(response) {
                    try {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            // Cập nhật số lượng giỏ hàng nếu cần
                            updateCartCount(res.cartCount);
                        } else {
                            console.error(res.message);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        console.log('Raw response:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi AJAX: ' + status + ' - ' + error);
                }
            });
        } else {
            alert("Vui lòng chọn số lượng hợp lệ.");
        }
    });
});

// Hàm cập nhật số lượng giỏ hàng 
function updateCartCount(count) {
    const cartCountElement = document.getElementById('quantity');
    cartCountElement.textContent = count;
    print_r(count);
}
</script>