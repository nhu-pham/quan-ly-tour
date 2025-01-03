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
            <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon">&#9776;</span>
                </button>
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link change-color active-header">Trang
                            chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link change-color">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="#destination" class="navbar-link change-color desdrop dropdown-toggle"
                                id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">Điểm đến <i class="fa-solid fa-caret-down"></i></a>
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
                    </div>
                    <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <div id="user-profile" class="user-profile">
                            <div style="cursor: pointer" class="user-account"><img src="<?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>" alt="Avatar" class="user-image">
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
                                    <div class="province"><?= $value['destination'] ?></div><br>
                                    <div class="dest"><?= $value['name']?></div><br>
                                    <div class="price"><i class="fa fa-dollar"></i><label><?= number_format($value['price'])?> VNĐ</label>
                                    </div><br>
                                    <div class="date"><i class="fa-solid fa-calendar-days"></i><?= $value['duration']?>
                                    </div>
                                </div>
                                <a target="" href="product/detail/<?=$value['slug']?>">
                                        <button class="xem-chi-tiet-btn">Xem chi tiết</button>
                                    </a>
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
                                <?php if (isset($_SESSION['user'])) { ?>
                                <button class="waitforpay love-btn <?php echo $value_db['is_love'] ? 'loved' : ''; ?>"
                                    data-id="<?php echo $value_db['id']; ?>"
                                    user-id="<?php echo $data['user']['id']; ?>"
                                    >
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                                <?php } else {?> 
                                    <button class="waitforpay">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                                <?php } ?>
    
                            <div class="price-tag-db">Giá từ:<?= number_format($value_db['price'])?> VNĐ</div>
                            <div class="desc-special">
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





            <script src="/quan-ly-tour/public/assets/js/header.js"></script>
            <script>
               document.querySelectorAll('.love-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const tourId = this.getAttribute('data-id');
                    const userId = this.getAttribute('user-id');
                    const isLoved = this.classList.contains('loved') ? 0 : 1;
                    const parentElement = this.closest('.gallery2');

                    // Thay đổi giao diện trước
                    this.classList.toggle('loved', isLoved === 1);

                    fetch('/quan-ly-tour/auth/updateLove', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: tourId,
                            is_love: isLoved,
                            userId: userId,
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            // Nếu có lỗi, hoàn tác thay đổi giao diện
                            alert('Cập nhật trạng thái thất bại!');
                            this.classList.toggle('loved', isLoved === 0);
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                        alert('Có lỗi xảy ra khi kết nối tới server!');
                        // Hoàn tác thay đổi giao diện nếu lỗi
                        this.classList.toggle('loved', isLoved === 0);
                    });
                });
            });

            </script>