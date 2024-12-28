<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VietCharm - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" href="/quan-ly-tour/public/uploads/images/logo-blue.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienBac.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienTrung.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourDacBiet.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienNam.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/responsiveTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body id="top">
    <!-- header section  -->


    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header">
        <a href="/quan-ly-tour/">
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
                                class="navbar-link change-color desdrop dropdown-toggle active-header"
                                id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">Điểm đến <i
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
                    <li class="nav-item"><a href="/quan-ly-tour/contact" class="navbar-link change-color">Liên hệ</a>
                    </li>
                </div>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <div id="user-profile" class="user-profile">
                                <div class="user-account"><img src="
                                <?php echo isset($datass['user']['avatar_url']) ? '/quan-ly-tour/' . $datass['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>
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
    </nav>

    <main>
        <article>
            <section id="mienTrungModal">
                <section class="page-Central" id="home" style=' <?php 
                $cate_id = $data['cate_id']; 
                if ($cate_id == 1) {
                    echo 'background-image: url("/quan-ly-tour/public/uploads/images/Mien-Nam.png");';
                } else if ($cate_id == 2) {
                    echo 'background-image: url("/quan-ly-tour/public/uploads/images/Mien-Bac.jpg");';
                } else {
                    echo 'background-image: url("/quan-ly-tour/public/uploads/images/Mien-Trung.png");';
                }           
                ?>
                '>
                    <section class="content">
                        <h1><?= $tour[0]['cate_name'] ?></h1>
                        <p><?= $tour[0]['des'] ?></p>
                    </section>
                </section>

                <div class="dstour">
                    <button class="filter-toggler">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    <div class="filter">
                        <h2>Bộ lọc tìm kiếm</h2>
                        <hr style="width: 100%; border-top: 1px solid white; margin-bottom: 10px;">
                        <form id="filter-form">
                            <label for="budget">Ngân sách</label>
                            <div class="budget-options ">
                                <button type="button" class="budget-btn" data-value="under5">Dưới 5 triệu</button>
                                <button type="button" class="budget-btn" data-value="5to10">Từ 5 - 10 triệu</button>
                                <button type="button" class="budget-btn" data-value="10to20">Từ 10 - 20
                                    triệu</button>
                                <button type="button" class="budget-btn" data-value="over20">Trên 20 triệu</button>
                            </div>
                            <style>
                                /* Thêm lớp .selected để chỉ ra nút được chọn */
                                .budget-btn.selected {
                                    background-color: rgba(43, 110, 182, 0.68);
                                    color: white;
                                }
                            </style>
                             <label for="departure">Điểm khởi hành</label>
                                <input type="text" id="departure" name="departure" placeholder="Nhập điểm khởi hành">

                                <label for="destination">Địa điểm</label>
                                <input type="text" id="destination" name="destination" placeholder="Nhập địa điểm">

                                <div class="date-group">
                                    <label for="date">Ngày đi</label>
                                    <input type="date" id="date" name="date">
                                </div>

                                <button type="submit" class="filter-btn">Lọc</button>
                        </form>
                    </div>

                    <!-- Kết quả tìm kiếm -->
                    <div class="search-results page_MT">
                        <div class="page-header">
                            <label for="">Tìm thấy <?= $data['row'] ?> kết quả</label>
                            <div><label class="sapxeptheo" for="" style="margin-right: 10px; margin-left: 100px; ">Sắp xếp
                                    theo:</label>
                                <select id="combobox-sapxep">
                                    <option value="all">Tất cả</option>
                                    <option value="price-desc">Giá từ cao đến thấp</option>
                                    <option value="price-asc">Giá từ thấp đến cao</option>
                                </select>
                            </div>
                        </div>

                        <?php $cate_id = $data['cate_id']; ?>
                        <div id="loadData" class="result-item-list">
                            <?php

                            require_once "./mvc/views/user/destination/loadData.php"
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
    
                    document.body.addEventListener('click', function (event) {
                        if (event.target.classList.contains('budget-btn')) {
                            const buttons = document.querySelectorAll('.budget-btn');
                            buttons.forEach(btn => btn.classList.remove('selected'));
                            event.target.classList.add('selected');
                        }
                    });

                    document.getElementById('filter-form').addEventListener('submit', function (event) {
                        event.preventDefault();

                        const formData = new FormData(this);

                        const departure = formData.get('departure');
                        const destination = formData.get('destination');
                        const date = formData.get('date');

                        const selectedBudget = document.querySelector('.budget-btn.selected')
                            ? document.querySelector('.budget-btn.selected').getAttribute('data-value')
                            : '';

                        if (selectedBudget) {
                            formData.append('budget', selectedBudget);
                        }

                        $.ajax({
                            url: '/quan-ly-tour/destination/search',
                            method: 'POST',
                            data: Object.fromEntries(formData),
                            success: function (response) {
                                $('html').html(response);
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });
                    });
                });

                $(document).on('change', '#combobox-sapxep', function () {
                    var selectedOption = $(this).val();

                    var data = {
                        sort: selectedOption
                    };

                    $.ajax({
                        url: '/quan-ly-tour/destination/sort_tours/<?php echo $cate_id ?>',
                        method: 'POST',
                        data: data,
                        success: function (response) {
                            $('#loadData').html(response);
                        },
                        error: function () {
                            alert('Có lỗi xảy ra khi lọc dữ liệu!');
                        }
                    });
                });

            </script>
            <script src="/quan-ly-tour/public/assets/js/header.js"></script>