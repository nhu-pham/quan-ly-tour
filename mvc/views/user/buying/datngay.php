<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- favicon -->
    <link rel="shortcut icon" href="/quan-ly-tour/public/uploads/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/trangChu.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/ttDatTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">

    <style>
    .navbar-link:hover {
        color: var(--bright-navy-blue);
    }
    </style>
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body id="top">
    <!-- header section  -->




    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background">
        <a href="trangChu.html">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo2"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px;">
        </a>

        <div class="container">
            <div class="collapse navbar-header" id="navbarNav">
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link ">Trang chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link ">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="/quan-ly-tour/destination/index/2" class="navbar-link desdrop dropdown-toggle"
                                id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color:  rgb(0, 225, 255); font-weight: bold;">Điểm đến <i
                                    class="fa-solid fa-caret-down"></i></a>
                            <ul class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/2">Miền Bắc</a></li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/3">Miền Trung</a>
                                </li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/1">Miền Nam</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/product/tours" class="navbar-link change-color">Tour</a>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/contact" class="navbar-link change-color"
                            class="navbar-link change-color">Liên hệ</a></li>
                    <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <div id="user-profile" class="user-profile">
                            <div class="user-account"><img src="
                                <?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>
                                " alt="Avatar" class="user-image">
                                <button id="user-name"><i class="fa-solid fa-caret-down"></i></button>
                            </div>
                            <div class="user-options">
                                <a href="/quan-ly-tour/auth/info">
                                    <i class="fas fa-cog"></i>
                                    Quản lý thông tin
                                </a>
                                <a href="/quan-ly-tour/auth/change_password">
                                    <i class="fa-solid fa-key"></i>
                                    Đổi mật khẩu
                                </a>
                                <a href="/quan-ly-tour/auth/orders">
                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                    Đơn mua
                                </a>
                                <a href="/quan-ly-tour/auth/logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item"><a href="/quan-ly-tour/auth/login" class="btn btn-primary">Đăng nhập</a></li>
                    <?php } ?>
            </div>
            </ul>
        </div>
    </nav>


    <main>
        <article>
            <div id="chitiet-dattour" class="chitiet-tour">
                <h4>
                    <label class="mienbac-chitiet">
                        <a
                            href="/quan-ly-tour/destination/index/<?=$category[0]['cate_id']?>"><?=$category[0]['name']?></a>
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
                        <p style="color: white" class="tttour"><strong>Tổng tiền: </strong><span
                                class="price total-price" name="calculated-price"
                                id="tongTien"><?= number_format($details['price']+$data['price_service']) ?>VNĐ</span>
                        </p>
                    </div>

                    <div class="buttons">
                        <a href="/quan-ly-tour/product/detail/<?= $slug?>" class="bt back"
                            style="text-align: center; height: 45px;">Quay lại</a>
                        <a href="/quan-ly-tour/product/detailPayment" class="bt pay"
                            style="text-align: center; height: 45px;">Thanh
                            toán</a>
                    </div>
                </div>
            </div>
        </article>
    </main>

    <script>
    function updatePrice() {
        // Lấy số lượng từ input
        var quantity = document.getElementById('soluong').value;

        // Lấy giá tour ban đầu
        var basePrice = <?= $details['price'] ?>;
        var servicePrice = <?= $data['price_service'] ?>;

        // Tính toán giá mới
        var newPrice = (basePrice * quantity) + servicePrice;

        // Cập nhật giá hiển thị 
        var calculatedPriceElement = document.getElementById('tongTien');
        if (calculatedPriceElement) {
            calculatedPriceElement.innerText = new Intl.NumberFormat().format(newPrice) + ' VNĐ';
        }
    }

    window.onload = function() {
        // Đặt sự kiện thay đổi cho input số lượng
        document.getElementById('soluong').addEventListener('input', updatePrice);

        // Gọi hàm updatePrice để cập nhật giá ngay khi trang được tải
        updatePrice();
    }
    </script>

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
    });

    // Xử lý sự kiện khi nhấp vào nút "Thanh toán"
    document.querySelector('.bt.pay').addEventListener('click', function(event) {
        //event.preventDefault();

        // Lấy giá trị từ Local Storage
        var quantity = localStorage.getItem('quantity');
        var name = localStorage.getItem('name');
        var date = localStorage.getItem('date');
        var phone = localStorage.getItem('phone');
        var email = localStorage.getItem('email');
        var address = localStorage.getItem('address');
        var gender = localStorage.getItem('gender');

        var totalPriceElement = document.getElementById('tongTien');
        var totalPriceText = totalPriceElement.textContent;
        var totalPriceValue = parseInt(totalPriceText.replace(/[^\d]/g, ''));



        var orderData = {
            name: name,
            date: date,
            phone: phone,
            email: email,
            address: address,
            gender: gender,
            quantity: quantity,
            totalPrice: totalPriceValue,
            tourPrice: <?= $details['price'] ?>
        };

        console.log(orderData);

        $.ajax({
            url: '/quan-ly-tour/product/payment/<?=$slug?>',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(orderData),
            success: function(response) {
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        console.log(res.message);
                        alert('Đặt hàng thành công');
                    } else {
                        console.error('Phản hồi lỗi từ server:', res.message);
                        alert('Đặt hàng thất bại');
                    }
                } catch (error) {
                    console.error('Lỗi khi phân tích JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi AJAX:', status, error); // Log lỗi AJAX
                alert('Đặt hàng thất bại');
            }
        });
    });
    </script>