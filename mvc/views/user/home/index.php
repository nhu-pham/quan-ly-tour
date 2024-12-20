<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietcharm - Travel Agency</title>
    <!-- favicon -->
    <!-- <link rel="shortcut icon" href="./LOGO.svg" type="image/svg+xml"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/demo/tourDacBiet.css" />
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body id="top">
    <!-- header section  -->
    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header">
        <a href="/quan-ly-tour/">
            <img src="/quan-ly-tour/public/uploads/images/logo-white.png" alt="Logo" class="logo"
                style="width: 160px; margin-left: 60px; height: auto; margin-top: -20px;">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo2"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px; display: none;">
        </a>

        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-header" id="navbarNav">
                <ul class="navbar-nav ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link change-color active-header">Trang
                            chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link change-color">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="#destination" class="navbar-link change-color desdrop dropdown-toggle"
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
                    <li class="nav-item"><a href="/quan-ly-tour/contact" class="navbar-link change-color">Liên hệ</a>
                    </li>
                    <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <div id="user-profile" class="user-profile">
                            <div class="user-account"><img src="
                                <?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>
                                " alt="Avatar" class="user-image">
                                <button id="user-name"><i class="fa-solid fa-caret-down"></i></button>
                            </div>
                            <div class="user-options">
                                <a href="auth/info">
                                    <i class="fas fa-cog"></i>
                                    Quản lý thông tin
                                </a>
                                <a href="auth/change_password">
                                    <i class="fa-solid fa-key"></i>
                                    Đổi mật khẩu
                                </a>
                                <a href="auth/orders">
                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                    Đơn mua
                                </a>
                                <a href="auth/logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item"><a href="auth/login" class="btn btn-primary">Đăng nhập</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        <article>

            <div class="main-container">

                <section id="trangchu">
                    <section class="hero" id="home" id="login-modal">
                        <div class="container text-center">

                            <h2 class="h1 hero-title">
                                Khám phá những địa điểm mới
                            </h2>

                        </div>
                    </section>
                    <section class="tour-search py-4" style="max-width: 850px;">
                        <div class="container">
                            <form action="destination/search/" method="GET"
                                class="tour-search-form row gx-3 gy-2 justify-content-center align-items-center">
                                <div class="col-12 col-md-4">
                                    <div class="input-wrapper ">
                                        <label for="destination" class="input-label des">Địa điểm </label>

                                        <input type="text" name="destination" id="destination" required
                                            placeholder="Nhập địa điểm" class="input-field form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="input-wrapper">
                                        <label for="checkin" class="input-label">Từ ngày</label>

                                        <input type="date" name="checkin" id="checkin" required
                                            class="input-field form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="input-wrapper">
                                        <label for="checkin" class="input-label">Đến ngày </label>

                                        <input type="date" name="checkout" id="checkout" required
                                            class="input-field form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 text-center">
                                    <a target="" href="/quan-ly-tour/destination/search/">
                                        <button type="submit" class="btn btn-secondary w-100">Tìm Kiếm</button>
                                    </a>

                                </div>
                            </form>
                        </div>
                    </section>
                </section>
                <!-- popular -->
                <section class="tournoibat">
                    <div class="header-popular">
                        <h2 class="popular_title">Điểm đến nổi bật trong tháng</h2>
                        <div class="icon-group">
                            <button id="prevButton"><i class="fa-solid fa-chevron-left"></i></button>
                            <button id="nextButton"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <?php if(isset($tours) && $tours!=NULL){ ?>
                    <div class="slider-popular slider1 active-p">
                        <?php foreach($tours as $value){?>
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                </a>
                                <div class="desc">
                                    <div id="province"><?= $value['destination'] ?></div><br>
                                    <div id="dest"><?= $value['name']?></div><br>
                                    <div id="price"><i class="fa fa-dollar"></i><?= number_format($value['price'])?> VNĐ
                                    </div><br>
                                    <div id="date"><i class="fa-solid fa-calendar-days"></i><?= $value['duration']?>
                                    </div>
                                    <a target="" href="product/detail/<?=$value['slug']?>">
                                        <button class="xem-chi-tiet-btn">Xem chi tiết</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <?php }?>
                </section>

                <!-- package  -->
                <section class="tourdacbiet">
                    <h2 class="tour-list">Các gói tour đặc biệt</h2>
                    <?php if(isset($tours_db) && $tours_db!=NULL){ ?>
                    <div class="gallery-container">
                        <?php foreach($tours_db as $value_db){?>
                        <div class="gallery2">
                            <img class="picture" src="/quan-ly-tour/<?=$value_db['thumbnail']?>"
                                alt="Hà Nội - Hải Phòng - Nghệ An" />
                            <i class="fa-solid fa-heart"></i>
                            <div class="price-tag-db">Giá từ:<?= number_format($value_db['price'])?> VNĐ</div>
                            <div class="desc">
                                <div style="font-weight: bold">
                                    <?= $value_db['name']?>
                                </div>
                                <div>Thời gian: <?= $value_db['duration']?></div>
                                <a href="product/detail/<?=$value_db['slug']?>" class="chi-tiet-btn">XEM NGAY</a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <?php }?>
                    <div class="see-more">
                        <a href="/quan-ly-tour/destination/index/4" id="xemthem">Xem thêm</a>
                    </div>
                </section>
                <!--Các đánh giá -->
                <section class="danhgia">
                    <h2 style="text-align: center; margin-bottom: 50px;">Đánh giá</h2>
                    <div class="tour-container">
                        <div class="tour-card">
                            <div class="tour-info">
                                <div class="tour-header">
                                    <button class="tour-details">Cao Bằng - 3 ngày/2 đêm - 3.000.000 VND</button>
                                </div>
                                <img src="/quan-ly-tour/public/uploads/images/tours/homestay-.jpg" alt="Cao Bằng"
                                    class="tour-image">
                                <div class="tour-review">
                                    <img src="/quan-ly-tour/public/uploads/images/tours/anh1.jpg" alt="Lý Sang Hiếc"
                                        class="tour-avatar">
                                    <div>
                                        <strong>Lý Sang Hiếc</strong><br>
                                    </div>
                                </div>
                                <h3 class="tour-evaluate">Chỗ ở rất đẹp, tôi có thể nhìn ngắm cảnh núi rừng hùng vĩ. Nếu
                                    có cơ hội tôi nhất định sẽ đặt lại tour du lịch này.</h3><br>
                                <hr style="width: 60%;">
                            </div>
                        </div>

                        <div class="tour-card">
                            <div class="tour-info">
                                <div class="tour-header">
                                    <button class="tour-details">Huế - Vũng Tàu</button>
                                </div>
                                <img src="/quan-ly-tour/public/uploads/images/tours/monan.jpg" alt="Huế - Vũng Tàu"
                                    class="tour-image">
                                <div class="tour-review">
                                    <img src="/quan-ly-tour/public/uploads/images/tours/anh2.jpg" alt="Nguyễn Minh Tuấn"
                                        class="tour-avatar">
                                    <div>
                                        <strong>Nguyễn Minh Tuấn</strong><br>
                                    </div>
                                </div>
                                <h3 class="tour-evaluate">Đây là tour tuyệt vời nhất mà tôi từng được đi. Món ăn ở Huế
                                    rất tuyệt vời.</h3><br>
                                <hr style="width: 60%;">
                            </div>
                        </div>

                        <div class="tour-card">
                            <div class="tour-info">
                                <div class="tour-header">
                                    <button class="tour-details">Hà Nội - Nghệ An</button>
                                </div>
                                <img src="/quan-ly-tour/public/uploads/images/tours/ho-hoan-kiem-7185.jpg"
                                    alt="Hà Nội - Nghệ An" class="tour-image">
                                <div class="tour-review">
                                    <img src="/quan-ly-tour/public/uploads/images/tours/anh3.jpg" alt="Lê Phúc Kiệt"
                                        class="tour-avatar">
                                    <div>
                                        <strong>Lê Phúc Kiệt</strong><br>
                                    </div>
                                </div>
                                <h3 class="tour-evaluate"> Buổi đêm ở đây rất tuyệt vời.</h3><br>
                                <hr style="width: 60%;">
                            </div>
                        </div>
                    </div>
                </section>
            </div>