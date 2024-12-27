<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/login.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/register.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/about.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/info.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/orderDetail.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/thanhToan.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienBac.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/chiTiet.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/ttDatTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/thanhToan.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/thueDichVu.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/lienLac.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/qlKhachHang.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/qlHoaDonTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourDacBiet.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/danhSachTour.css">
    <style>
    .navbar-link:hover {
        color: var(--bright-navy-blue);
    }
    </style>
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body id="top">
    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background">
        <a href="/quan-ly-tour/">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px;">
        </a>

        <div class="container">
            <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon" style="color: black;">&#9776;</span>
                </button>
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link">Trang chủ</a></li>
                    <li class="nav-item"><a href="../about" class="navbar-link">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="#destination" class="navbar-link desdrop dropdown-toggle" id="navbarDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(0, 225, 255); font-weight: bold;">Điểm đến <i class="fa-solid fa-caret-down"></i></a>
                            <ul class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="mienBac.html">Miền Bắc</a></li>
                                <li><a class="dropdown-item" href="mienTrung.html">Miền Trung</a></li>
                                <li><a class="dropdown-item" href="mienNam.html">Miền Nam</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="tour.html" class="navbar-link">Tour</a></li>
                    <li class="nav-item"><a href="lienHe.html" class="navbar-link">Liên hệ</a></li>
        </div>
                    <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <div id="user-profile" class="user-profile">
                            <div class="user-account">
                                <?php $avatar = isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>

                                <img src="<?= $avatar ?>" alt="Avatar" class="user-image">
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
                        <?php } else { ?>
                    <li class="nav-item"><a href="login " class="btn1 btn-primary">Đăng nhập</a></li>
                    <?php } ?>
                    </li>
                </ul>
            
        </div>
    </nav>
    <main>
        <article>
            <div id="dichVu" class="chitiet-tour pay-section">
                <h4>
                    <label class="mienbac-chitiet">
                        <a href="/quan-ly-tour/destination/index/<?=$date['category_id']?>"><?=$data['cate_name']?></a>
                        >
                        <a href="/quan-ly-tour/product/detail/<?=$data['slug']?>"><?=$data['tour_name']?></a> >
                        <a href="/quan-ly-tour/product/buy/<?=$data['slug']?>">Đặt tour</a> >
                        <a href=""><strong>Thanh toán</strong></a>
                    </label>
                </h4>
                <h3>Thanh toán</h3>
                <div class="payment-container">

                    <div class="right-payment">
                        <label style="color: black; font-weight: bold; margin-bottom: 10px;">Chọn phương thức thanh
                            toán</label>
                        <div class="payment-option">
                            <input type="radio" name="payment" id="momo" value="momo">
                            <img src="\quan-ly-tour\public\uploads\images\vimomo.png" alt="Momo">
                            <label for="momo">
                                Momo
                                <span style="font-weight: normal; color: red;">Nhập mã VCMOMO11 nhận combo voucher cho
                                    bạn
                                    mới</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment" id="shopee" value="shopee">
                            <img src="\quan-ly-tour\public\uploads\images\shopeepay.png" alt="Momo">
                            <label for="shopee">
                                Shopee Pay
                                <span style="font-weight: normal; color: red;">Nhập mã VIETCHARM - nhận ngay ưu đãi nhận
                                    dịp
                                    Tết Ất Tỵ</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment" id="zalopay" value="zalopay">
                            <img src="\quan-ly-tour\public\uploads\images\zalopay.png" alt="Visa">
                            <label for="zalopay">
                                Zalo Pay
                                <span style="font-weight: normal; color: red;">Nhập mã GIAMSAU - giảm tối đa 20% cho bạn
                                    mới</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" name="payment" id="vnpay" value="vnpay">
                            <img src="\quan-ly-tour\public\uploads\images\vnpay.png" alt="Mastercard">
                            <label for="mastercard">

                                VN Pay
                                <span style="font-weight: normal; color: red;">Nhập mã VCVNPAY - giảm tối đa 15% khi
                                    thanh
                                    toán cho bạn mới</span>
                            </label>
                        </div>
                        <hr>
                        <div class="payment-option pay-card">
                            <img src="\quan-ly-tour\public\uploads\images\thenoidia.png" alt="Visa">
                            <label for="zalopay">
                                Thẻ nội địa
                            </label>
                        </div>
                        <div class="payment-option pay-card">
                            <img src="\quan-ly-tour\public\uploads\images\thevisa.png" alt="Mastercard">
                            <label for="mastercard">
                                Thẻ Visa
                            </label>
                        </div>
                    </div>
                    <div class="left-payment">
                        <div class="total" style="text-align: center;">
                            <p>Tổng thanh toán: <span
                                    style="color: #06960D; font-size: 48px; font-weight: normal;"><?=number_format($data['total_money'])?>
                                    VNĐ</span>
                            </p>

                        </div>
                        <div class="qr-code">
                            <img src="\quan-ly-tour\public\uploads\images\qr.png" alt="qr">
                        </div>
                    </div>
                </div>
                <div class="payment-guide">
                    <h3 style="color: #084804; font-size: 30px;">Hướng dẫn thanh toán bằng Momo</h3>
                    <ol class="custom-list">
                        <li>Mở ứng dụng momo trên điện thoại</li>
                        <li>Dùng biểu tượng ... để quét mã QR</li>
                        <li>Quét mã ở trang này và thanh toán</li>
                    </ol>
                </div>
            </div>



            <script>
        const toggler = document.querySelector('.navbar-toggler'); 
        const navbarNav = document.querySelector('.navbar-collapse'); 
        toggler.addEventListener('click', function() { navbarNav.classList.toggle('show');}); 
    </script>