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
                    <label><input type="radio" name="gender" value="male" checked> Nam</label>
                    <label><input type="radio" name="gender" value="female"> Nữ</label>
                    <label><input type="radio" name="gender" value="other"> Khác</label>
                </div>

                <div class="form-row1">
                    <div class="form-group">
                        <label for="name"><strong>Họ và tên</strong></label>
                        <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên">
                    </div>

                    <div class="form-group">
                        <label for="date"><strong>Ngày sinh</strong></label>
                        <input type="date" id="date" class="form-control">
                    </div>
                </div>
                <div class="form-row2">
                    <div class="form-group">
                        <label for="phone"><strong>Số điện thoại</strong></label>
                        <input type="text" id="phone" class="form-control" placeholder="Nhập số điện thoại">
                    </div>

                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" id="email" class="form-control" placeholder="Nhập email">
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
                        <input type="text" id="address" class="form-control" placeholder="Nhập nơi ở hiện tại">
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
                            <div class="soluong-dv"><?=$data['qty']?></div>
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
                        <div><span class="price-service"><?=number_format($data['price_service'])?> VNĐ</span></div>
                    </div>
                </div>

                <div class="total">
                    <p style="color: white" class="tttour"><strong>Tổng tiền: </strong><span class="price total-price">
                            VNĐ</span></p>
                </div>

                <div class="buttons">
                    <a href="/quan-ly-tour/product/detail/<?= $slug?>" class="bt back"
                        style="text-align: center; height: 45px;">Quay lại</a>
                    <a href="/quan-ly-tour/product/payment/<?= $slug?>" class="bt pay"
                        style="text-align: center; height: 45px;">Thanh toán</a>
                </div>
            </div>
        </div>
    </article>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.getElementById('soluong');
    var nameInput = document.getElementById('name');
    var dateInput = document.getElementById('date');
    var phoneInput = document.getElementById('phone');
    var emailInput = document.getElementById('email');
    var addressInput = document.getElementById('address');
    var genderInputs = document.querySelectorAll('input[name="gender"]');

    // Hàm để lưu giá trị vào Local Storage
    function saveToLocalStorage() {
        localStorage.setItem('quantity', quantityInput.value);
        localStorage.setItem('name', nameInput.value);
        localStorage.setItem('date', dateInput.value);
        localStorage.setItem('phone', phoneInput.value);
        localStorage.setItem('email', emailInput.value);
        localStorage.setItem('address', addressInput.value);
        genderInputs.forEach(gender => {
            if (gender.checked) {
                localStorage.setItem('gender', gender.value);
            }
        });
    }

    // Hàm để tải giá trị từ Local Storage
    function loadFromLocalStorage() {
        if (localStorage.getItem('quantity')) {
            quantityInput.value = localStorage.getItem('quantity');
        }
        if (localStorage.getItem('name')) {
            nameInput.value = localStorage.getItem('name');
        }
        if (localStorage.getItem('date')) {
            dateInput.value = localStorage.getItem('date');
        }
        if (localStorage.getItem('phone')) {
            phoneInput.value = localStorage.getItem('phone');
        }
        if (localStorage.getItem('email')) {
            emailInput.value = localStorage.getItem('email');
        }
        if (localStorage.getItem('address')) {
            addressInput.value = localStorage.getItem('address');
        }
        if (localStorage.getItem('gender')) {
            var gender = localStorage.getItem('gender');
            document.querySelector('input[name="gender"][value="' + gender + '"]').checked = true;
        }
    }

    // Lắng nghe sự kiện thay đổi và lưu giá trị
    quantityInput.addEventListener('input', saveToLocalStorage);
    nameInput.addEventListener('input', saveToLocalStorage);
    dateInput.addEventListener('input', saveToLocalStorage);
    phoneInput.addEventListener('input', saveToLocalStorage);
    emailInput.addEventListener('input', saveToLocalStorage);
    addressInput.addEventListener('input', saveToLocalStorage);
    genderInputs.forEach(gender => {
        gender.addEventListener('change', saveToLocalStorage);
    });

    // Khởi tạo cập nhật giá lần đầu tiên
    loadFromLocalStorage();

    // Xử lý sự kiện khi nhấp vào nút "Thanh toán"
    document.querySelector('.bt.pay').addEventListener('click', function(event) {
        event.preventDefault();

        var tourPriceElement = document.querySelector('.tour-price');
        var tourPriceText = tourPriceElement.textContent;
        var tourPriceValue = parseInt(tourPriceText.replace(/[^\d]/g, ''));

        var orderData = {
            name: nameInput.value,
            date: dateInput.value,
            phone: phoneInput.value,
            email: emailInput.value,
            address: addressInput.value,
            gender: document.querySelector('input[name="gender"]:checked').value,
            quantity: quantityInput.value,
            tourPriceValue: tourPriceValue
        };

        $.ajax({
            url: '/quan-ly-tour/mvc/controllers/ProductController/payment/<?=$slug?>',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                orderData: orderData
            }),
            success: function(response) {
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        console.log(res.message);
                        alert('Đặt hàng thành công');
                        window.location.href =
                            '/success/page/url'; // Chuyển hướng sau khi thành công
                    } else {
                        console.error(res.message);
                        alert('Đặt hàng thất bại');
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi AJAX: ' + status + ' - ' + error);
                alert('Đặt hàng thất bại');
            }
        });
    });
});
</script>