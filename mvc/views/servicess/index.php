<?php 
require_once ('./mvc/views/user/include/header.php');
?>

<main>
    <article>
        <div id="dichVu" class="chitiet-tour">
            <h4>
                <label class="mienbac-chitiet">
                    <a href="/quan-ly-tour/destination/index/<?=$tour[0]['cate_id']?>"><?=$tour[0]['cate_name']?></a> >
                    <a href="/quan-ly-tour/product/detail/<?=$tour[0]['slug']?>"><?=$tour[0]['tour_name']?></a> >
                    <a href="thongTinDatTour.html">Đặt tour</a> >
                    <a href="dichVu.html"><strong>Dịch vụ</strong></a>
                </label>
            </h4>
            <div class="title-cart">
                <h3>Thuê dịch vụ du lịch</h3>
                <a href="/quan-ly-tour/cart/viewCart/<?=$tour[0]['slug']?>" class="cart-icon"><i
                        class="fa-solid fa-cart-shopping"></i></a>
                <label id="quantity"><?=$data['qty']?></label>
            </div>

            <label class="product-rent">
                <a href="#" data-category="xemay" class="load-category selected">Xe máy/</a>
                <a href="#" data-category="oto" class="load-category">Ô tô/</a>
                <a href="#" data-category="camtrai" class="load-category">Combo cắm trại</a>
            </label>
            <?php if(isset($data['service']) && $data != NULL) { ?>
            <div id="loadContent">
                <?php 
                $datas = json_encode($data['service']); // Chuyển đổi dữ liệu PHP thành JSON
                ?>
            </div>
            <?php }?>
            <div class="buttons dichvu-btn">
                <a href="thongTinDatTour.html" class="bt back">Quay lại</a>
                <a href="thongTinDatTour.html" class="bt pay cont">Tiếp tục</a>
            </div>
        </div>
    </article>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    var datas = <?php echo $datas; ?>; // Chuyển đổi JSON thành đối tượng JavaScript

    function loadData(category) {
        $.ajax({
            url: '/quan-ly-tour/mvc/views/servicess/loadData.php',
            method: 'POST',
            data: {
                category: category,
                datas: datas // Truyền biến dữ liệu
            },
            success: function(response) {
                $('#loadContent').html(response);
                attachEventHandlers(); // Gọi hàm để thêm sự kiện sau khi tải dữ liệu
            },
            error: function(xhr, status, error) {
                console.error('Lỗi AJAX: ' + status + ' - ' + error);
            }
        });
    }

    function attachEventHandlers() {
        $('.quantity-btn.decrease').click(function() {
            var input = $(this).siblings('.quantity-input');
            var currentValue = parseInt(input.val());
            if (!isNaN(currentValue) && currentValue > 0) {
                input.val(currentValue - 1);
            }
        });

        $('.quantity-btn.increase').click(function() {
            var input = $(this).siblings('.quantity-input');
            var currentValue = parseInt(input.val());
            if (!isNaN(currentValue) && currentValue < 10) { // Giới hạn tối đa là 10
                input.val(currentValue + 1);
            }
        });

        $('.quantity-input').on('input', function() {
            var value = parseInt($(this).val());
            if (isNaN(value) || value < 0) {
                $(this).val(0);
            } else if (value > 10) {
                $(this).val(10);
            }
        });
    }

    // Tải dữ liệu mặc định khi trang được tải
    loadData('xemay');

    // Xử lý sự kiện nhấp chuột vào các liên kết
    $('.load-category').click(function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        var category = $(this).data('category'); // Lấy giá trị từ thuộc tính data-category
        loadData(category); // Gọi hàm để tải dữ liệu

        // Xóa lớp selected khỏi tất cả các liên kết 
        $('.load-category').removeClass('selected');
        // Thêm lớp selected vào liên kết được nhấp 
        $(this).addClass('selected');
    });

    // Gắn sự kiện cho các nút sau khi tải dữ liệu lần đầu
    attachEventHandlers();
});
</script>