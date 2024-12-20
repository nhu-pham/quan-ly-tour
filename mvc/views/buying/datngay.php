<?php 
require_once ('./mvc/views/user/include/header.php');
?>

<main>
    <article>
        <div id="chitiet-dattour" class="chitiet-tour">
            <h4>
                <label class="mienbac-chitiet">
                    <a href="/quan-ly-tour/destination/index/<?=$category[0]['cate_id']?>"><?=$category[0]['name']?></a>
                    >
                    <a href="/quan-ly-tour/product/detail/<?= $slug?>"><?= $details['name']?></a> >
                    <a href=""><strong>Đặt tour</strong></a>
                </label>
            </h4>
            <h3>Thông tin đặt tour</h3>

            <div class="booking-form">
                <div class="gender">
                    <label><input type="radio" name="gender" value="male"> Nam</label>
                    <label><input type="radio" name="gender" value="female"> Nữ</label>
                    <label><input type="radio" name="gender" value="other"> Khác</label>
                </div>

                <div class="form-row1">
                    <div class="form-group">
                        <label for="name"><strong>Họ và tên</strong></label>
                        <input type="text" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="date"><strong>Ngày sinh</strong></label>
                        <input type="date" id="date" class="form-control">
                    </div>
                </div>
                <div class="form-row2">
                    <div class="form-group">
                        <label for="phone"><strong>Số điện thoại</strong></label>
                        <input type="text" id="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" id="email" class="form-control">
                    </div>
                </div>

                <script>
                function updatePrice() {
                    // Lấy số lượng từ input
                    var quantity = document.getElementById('soluong').value;

                    // Lấy giá tour ban đầu
                    var basePrice = <?= $details['price'] ?>;

                    // Tính toán giá mới
                    var newPrice = basePrice * quantity;

                    // Cập nhật giá hiển thị theo tên
                    var calculatedPriceElements = document.getElementsByName('calculated-price');
                    if (calculatedPriceElements.length > 0) {
                        calculatedPriceElements[0].innerText = new Intl.NumberFormat().format(newPrice) + ' VNĐ';
                    }
                }

                window.onload = function() {
                    // Đặt sự kiện thay đổi cho input số lượng
                    document.getElementById('soluong').addEventListener('input', updatePrice);

                    // Gọi hàm updatePrice để cập nhật giá ngay khi trang được tải
                    updatePrice();
                }
                </script>

                <div class="form-row3">
                    <div>
                        <label for="address"><strong>Nơi ở hiện tại</strong></label>
                        <input type="text" id="address" class="form-control">
                    </div>
                    <div>
                        <label for="quantity"><strong>Số lượng:</strong></label>
                        <input id="soluong" type="number" min="1" max="10" step="1" value="1">
                    </div>
                </div>

                <div class="form-row1">
                    <h3 style="color: black;">Thông tin tour</h3>
                    <a href="/quan-ly-tour/service/loadData/<?= $slug?>" class="btn-dichvu">Dịch vụ khác
                        <div class="icon-container">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <div class="soluong-dv">0</div>
                        </div>
                    </a>
                </div>

                <div class="tour-info">
                    <p><b><?= $details['name'] ?></b></p>
                    <p class="tttour">Giá tour: <span class="price tour-price"
                            name="calculated-price"><?= number_format($details['price']) ?> VNĐ</span>
                    </p>
                    <div class="tttour">
                        <div>Dịch vụ khác:</div>
                        <div>
                            <select class="service-dropdown">
                                <option value="0">Các dịch vụ đã thuê</option>
                                <option value="50000">Dịch vụ A - 50,000 VNĐ</option>
                                <option value="100000">Dịch vụ B - 100,000 VNĐ</option>
                                <option value="150000">Dịch vụ C - 150,000 VNĐ</option>
                            </select>
                        </div>
                        <div><span class="price-service">0 VNĐ</span></div>
                    </div>
                </div>

                <div class="total">
                    <p style="color: white" class="tttour"><strong>Tổng tiền: </strong><span class="price total-price">0
                            VNĐ</span></p>
                </div>

                <div class="buttons">
                    <a href="chiTietTour.html" class="bt back" style="text-align: center; height: 45px;">Quay lại</a>
                    <a href="thanhToan.html" class="bt pay" style="text-align: center; height: 45px;">Thanh toán</a>
                </div>
            </div>
        </div>
    </article>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.getElementById('soluong');
    var tourPriceElement = document.querySelector('.tour-price');
    var serviceDropdown = document.querySelector('.service-dropdown');
    var servicePriceElement = document.querySelector('.price-service');
    var totalPriceElement = document.querySelector('.total-price');

    // Hàm để cập nhật giá tiền
    function updatePrices() {
        var quantity = parseInt(quantityInput.value) || 0;
        var tourPrice = parseFloat(<?= $details['price'] ?>) * quantity || 0;
        var servicePrice = parseFloat(serviceDropdown.value) || 0;
        var totalPrice = tourPrice + servicePrice;

        // Cập nhật giá tour
        tourPriceElement.innerText = tourPrice.toLocaleString() + ' VNĐ';
        // Cập nhật giá dịch vụ
        servicePriceElement.textContent = servicePrice.toLocaleString() + ' VNĐ';
        // Cập nhật tổng giá
        totalPriceElement.textContent = totalPrice.toLocaleString() + ' VNĐ';
    }

    // Lắng nghe thay đổi trong input số lượng và dropdown dịch vụ
    quantityInput.addEventListener('input', updatePrices);
    serviceDropdown.addEventListener('change', updatePrices);

    // Khởi tạo cập nhật giá lần đầu tiên
    updatePrices();
});
</script>