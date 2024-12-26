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
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/trangChu.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienBac.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienTrung.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/tourMienNam.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/responsiveTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body id="top">
    <!-- header section  -->


    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header">
        <a href="trangChu.html">
            <img src="assets/images/logo2-removebg-preview.png" alt="Logo" class="logo2"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px; display: none;">
            <img src="assets/images/LOGO-removebg-preview.png" alt="Logo" class="logo"
                style="width: 160px; margin-left: 60px; height: auto; margin-top: -20px;">
        </a>

        <div class="container">
            <div class="collapse navbar-header" id="navbarNav">
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link change-color">Trang chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link change-color">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="#destination"
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

        <main>
            <article>
                <!-- Trang Tour Miền Trung-->
                <section id="mienTrungModal">
                    <section class="page-Central" id="home">
                        <section class="content">

                            <h1>TOUR PHÙ HỢP VỚI BẠN</h1>
                        </section>
                    </section>

                    <div class="dstour">

                        <div class="filter">
                            <h2>Bộ lọc tìm kiếm</h2>
                            <hr style="width: 100%; border-top: 1px solid white; margin-bottom: 10px;">
                            <form>
                                <label for="budget">Ngân sách</label>
                                <div class="budget-options">
                                    <button type="button" class="budget-btn" data-value="under5">Dưới 5 triệu</button>
                                    <button type="button" class="budget-btn" data-value="5to10">Từ 5 - 10 triệu</button>
                                    <button type="button" class="budget-btn" data-value="10to20">Từ 10 - 20
                                        triệu</button>
                                    <button type="button" class="budget-btn" data-value="over20">Trên 20 triệu</button>
                                </div>

                                <label for="departure">Điểm khởi hành</label>
                                <input type="text" id="departure" placeholder="Nhập điểm khởi hành">

                                <label for="destination">Địa điểm</label>
                                <input type="text" id="destination" placeholder="Nhập địa điểm">

                                <div class="date-group">
                                    <label for="date">Ngày đi</label>
                                    <input type="date" id="date">
                                </div>

                                <button type="submit" class="filter-btn">Lọc</button>
                            </form>
                        </div>

                        <!-- Kết quả tìm kiếm -->
                        <div class="search-results page_MT">
                            <div class="page-header">
                                <label for="">Tìm thấy <?=$data['rows']?> kết quả</label>
                                <div><label for="" style="margin-right: 10px; margin-left: 100px; ">Sắp xếp
                                        theo:</label>
                                    <select id="combobox-sapxep">
                                        <option value="option1">Tất cả</option>
                                        <option value="option2">Giá từ cao đến thấp</option>
                                        <option value="option3">Giá từ thấp đến cao</option>
                                    </select>
                                </div>
                            </div>
                            <hr style="margin-top: 10px; margin-bottom: 20px;">
                            <section id="loadData">
                                <?php if(isset($data['tour']) && ($data['tour'])!=NULL){ ?>
                                <?php foreach(($data['tour']) as $value){?>
                                <div class="result-item">
                                    <img src="/quan-ly-tour/<?=$value['thumbnail']?>" alt="Cao Bằng"
                                        class="result-image">
                                    <div class="result-details">
                                        <h3><?=$value['name']?></h3>
                                        <div><i class="fa-solid fa-location-dot"></i>
                                            <p>Khởi hành: <?=$value['pick_up']?></p>
                                        </div>
                                        <?php
                                // Giả sử $details['date_start'] chứa ngày tháng ban đầu
                                $dateString = $value['date_start'];
                                $date = new DateTime($dateString);
                                $formattedDate = $date->format('d-m-Y');  // Định dạng ngày thành 'd-m-Y'
                                ?>
                                        <div><i class="fa-solid fa-calendar-days"></i>
                                            <p>Ngày khởi hành: <?= $formattedDate ?></p>
                                        </div>
                                        <div><i class="fa-solid fa-clock"></i>
                                            <p>Thời gian: <?=$value['duration']?></p>
                                        </div>
                                        <div class="price-and-button">
                                            <p class="price">Giá từ: <?=number_format($value['price'])?>VNĐ</p>
                                            <a href="/quan-ly-tour/product/detail/<?=$value['slug']?>"
                                                class="detail-btn">Xem
                                                chi tiết</a>
                                        </div>
                                    </div>
                                </div>

                                <?php }?>
                                <?php }?>
                            </section>
                            <ul class="pagination" style="display: flex">
                                <?=$data['button_pagination'];?>
                            </ul>
                            <script>
                            $(document).ready(function() {
                                let data;
                                let page = 1;
                                $('.pagination li a.page-link').click(function() {
                                    page = $(this).attr('num-page')
                                    data = {
                                        page: page
                                    }
                                    callback('/quan-ly-tour/destination/search', data);
                                })

                                function callback(url, data) {
                                    $.ajax({
                                        url: url,
                                        method: "POST",
                                        data: data,
                                        success: function(response) {
                                            $('#loadData').html(response);
                                        },
                                    })
                                }
                            });
                            </script>
                        </div>
                    </div>
                </section>