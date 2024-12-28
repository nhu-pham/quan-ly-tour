<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietcharm - Travel Agency</title>
    <!-- favicon -->
    <!-- <link rel="shortcut icon" href="./LOGO.svg" type="image/svg+xml"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="/quan-ly-tour/public/uploads/images/logo-blue.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/lienLac.css">

    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body id="top">
    <!-- header section  -->
    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background">
        <a href="/quan-ly-tour/">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo2"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px; ">
        </a>

        <div class="container">
            <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon" style="color: black;">&#9776;</span>
                </button>
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link change-color ">Trang
                            chủ</a></li>
                    <li class="nav-item"><a href="about/" class="navbar-link change-color">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="/quan-ly-tour/destination/index/2" class="navbar-link change-color desdrop dropdown-toggle"
                                id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">Điểm đến</a>
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
                    <li class="nav-item"><a href="/quan-ly-tour/contact"
                            class="navbar-link change-color active-header"style="color: rgb(0, 225, 255); font-weight: bold;">Liên
                            hệ</a></li>
                </div>
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
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <article>
            <div id="contact-container" class="contact-container">
                <h2 class="title">Thông tin liên hệ</h2>
                <p class="desc-contact">
                    Để có thể đáp ứng được các yêu cầu và đóng góp ý kiến của quý khách, xin vui lòng gửi thông tin hoặc
                    gọi đến hotline các chi nhánh bên dưới để liên hệ một cách nhanh chóng.
                </p>
                <div class="contact-content">

                    <div class="form-section">
                        <h3>Thông tin liên lạc</h3>
                        <form action="#">
                            <label for="contact-type">Loại thông tin <span style="color: red;">*</span></label>
                            <select id="contact-type" required>
                                <option value="">Chọn loại thông tin</option>
                                <option value="">Du lịch</option>
                                <option value="">Chăm sóc khách hàng</option>
                                <option value="">Liên hệ thông tin khác</option>
                            </select>

                            <label for="name">Họ tên <span style="color: red;">*</span></label>
                            <input type="text" id="name" placeholder="Nhập họ tên" required>

                            <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                            <input type="tel" id="phone" placeholder="Nhập số điện thoại" required>

                            <label for="address">Địa chỉ <span style="color: red;">*</span></label>
                            <input type="text" id="address" placeholder="Nhập địa chỉ" required>

                            <label for="title">Tiêu đề <span style="color: red;">*</span></label>
                            <input type="text" id="title" placeholder="Nhập tiêu đề" required>

                            <label for="message">Nội dung <span style="color: red;">*</span></label>
                            <textarea id="message" rows="5" placeholder="Nhập nội dung" required></textarea>

                            <button type="sent-btn">Gửi ngay</button>
                        </form>
                    </div>


                    <div class="branch-section">
                        <h3>Mạng lưới chi nhánh</h3>
                        <div class="parts">
                            <button class="part active">Miền Bắc</button>
                            <button class="part">Miền Trung</button>
                            <button class="part">Miền Nam</button>
                        </div>
                        <hr style="border-bottom: 1px solid black;">
                        <div class="info-branch">
                            <h4>CHI NHÁNH HÀ NỘI</h4>
                            <p><i class="fa-solid fa-location-dot"></i>03 Hai Bà Trưng, Hà Nội - Tel: 024. 3933 1978 |
                                VPDL
                                khách
                                đoàn: Tầng 7, tòa nhà Hồng Hà - Số 37 Ngô Quyền, Hà Nội </p>
                            <p><i class="fa-solid fa-envelope"></i>Email: hn1@vietcharm.com</p>
                            <p><i class="fa-solid fa-phone"></i>Hotline: (024) 3933 1978 | 0989 37 00 33</p>

                            <h4>CHI NHÁNH HẢI PHÒNG</h4>
                            <p><i class="fa-solid fa-location-dot"></i>04 Trần Hưng Đạo, P. Hoàng Văn Thụ, Q.Hồng Bàng,
                                TP.
                                Hải
                                Phòng</p>
                            <p><i class="fa-solid fa-envelope"></i>Email: hp2@vietcharm.com</p>
                            <p><i class="fa-solid fa-phone"></i>Hotline: (0225) 3842 888 | 0936 900 085</p>
                        </div>
                    </div>
                </div>
            </div>