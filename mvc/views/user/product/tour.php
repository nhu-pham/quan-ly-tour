<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body id="top">


    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header">
        <a href="trangChu.html">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo2"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px; display: none;">
            <img src="/quan-ly-tour/public/uploads/images/logo-white.png" alt="Logo" class="logo"
                style="width: 160px; margin-left: 60px; height: auto; margin-top: -20px;">
        </a>

        <div class="container">
            <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon">&#9776;</span>
                </button>
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link change-color">Trang chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link change-color">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="/quan-ly-tour/destination/index/2"
                                class="navbar-link change-color desdrop dropdown-toggle" id="navbarDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">Điểm đến <i
                                    class="fa-solid fa-caret-down"></i></a>
                            <ul class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/2">Miền Bắc</a></li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/3">Miền Trung</a>
                                </li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/1">Miền Nam</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/product/tours"
                            class="navbar-link change-color active-header">Tour</a>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/contact" class="navbar-link change-color">Liên hệ</a>
                    </li>
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
            </div>

            </ul>
        </div>
    </nav>

    <main>
        <article>
            <!-- Trang Tour Miền Bắc -->
            <section id="tourModel">
                <section class="page-tour" id="home">
                    <section class="content">
                        <h1>Khám phá thế giới, chỉ một cú click
                            Đặt tour, mở ra hành trình!</h1>
                    </section>
                </section>

                <div class="specialtour-container">
                    <section class="special-tours">
                        <h2>Gói tour đặc biệt</h2>
                        <div class="slider-popular-ds">
                            <?php if(isset($tours_db) && $tours_db!=NULL){ ?>
                            <?php foreach($tours_db as $value){?>
                            <div class="responsive">
                                <div class="gallery">
                                    <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                        <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    </a>
                                    <div class="price-tag"><?=number_format($value['price'])?> VNĐ</div>
                                    <div class="desc">
                                        <div class="province"><?=$value['destination']?></div>
                                        <div class="dest"><?=$value['name']?></div>
                                        <div class="price" style="width: 180px;"><i class="fa fa-dollar"></i>Bao gồm chi phí dịch vụ, ăn uống,
                                            ...</div>
                                        <div class="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                        </div>
                                        <a target="" class="xem-chi-tiet-btn" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <?php }?>
                        </div>
                    </section>
                    <a href="/quan-ly-tour/destination/index/4" class="view-more">Xem thêm</a>
                </div>
                <div class="specialtour-container">
                    <section class="special-tours">
                        <h2>Tour miền bắc</h2>
                        <div class="slider-popular-ds">
                            <?php if(isset($tours_mb) && $tours_mb!=NULL){ ?>
                            <?php foreach($tours_mb as $value){?>
                            <div class="responsive">
                                <div class="gallery">
                                    <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                        <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    </a>
                                    <div class="desc">
                                        <div class="province"><?=$value['destination']?></div>
                                        <div class="dest"><?=$value['name']?></div>
                                        <div class="price"><i class="fa fa-dollar"></i><label style="color: red;"><?=number_format($value['price'])?>
                                            VNĐ</label></div>
                                        <div class="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                        </div>
                                        <a target="" class="xem-chi-tiet-btn" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                             Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <?php }?>
                        </div>
                    </section>
                    <a href="/quan-ly-tour/destination/index/2" class="view-more">Xem thêm</a>
                </div>
                <div class="specialtour-container">
                    <section class="special-tours">
                        <h2>Tour miền trung</h2>
                        <div class="slider-popular-ds">
                            <?php if(isset($tours_mt) && $tours_mt!=NULL){ ?>
                            <?php foreach($tours_mt as $value){?>
                            <div class="responsive">
                                <div class="gallery">
                                    <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                        <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    </a>
                                    <div class="desc">
                                        <div class="province"><?=$value['destination']?></div>
                                        <div class="dest"><?=$value['name']?></div>
                                        <div class="price"><i class="fa fa-dollar"></i><label style="color: red;"><?=number_format($value['price'])?>
                                            VNĐ</label></div>
                                        <div class="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                        </div>
                                        <a target="" class="xem-chi-tiet-btn" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <?php }?>
                        </div>
                    </section>
                    <a href="/quan-ly-tour/destination/index/3" class="view-more">Xem thêm</a>
                </div>
                <div class="specialtour-container">
                    <section class="special-tours">
                        <h2>Tour miền nam</h2>
                        <div class="slider-popular-ds">
                            <?php if(isset($tours_mn) && $tours_mn!=NULL){ ?>
                            <?php foreach($tours_mn as $value){?>
                            <div class="responsive">
                                <div class="gallery">
                                    <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                        <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    </a>
                                    <div class="desc">
                                        <div class="province"><?=$value['destination']?></div>
                                        <div class="dest"><?=$value['name']?></div>
                                        <div class="price"><i class="fa fa-dollar"></i><label style="color: red;"><?=number_format($value['price'])?>
                                            VNĐ</label>
                                        </div>
                                        <div class="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                        </div>
                                        <a class="xem-chi-tiet-btn" target="" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <?php }?>
                        </div>
                    </section>
                    <a href="/quan-ly-tour/destination/index/1" class="view-more">Xem thêm</a>
                </div>
            </section>
        </article>
    </main>


    <script src="/quan-ly-tour/public/assets/js/header.js"></script>