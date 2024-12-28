<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="/quan-ly-tour/public/uploads/images/logo-blue.png">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/chiTiet.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
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
        <a href="/quan-ly-tour/">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo2"
                style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px;">
        </a>

        <div class="container">
            <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon" style="color: black;">&#9776;</span>
                </button>
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link ">Trang chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link ">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="/quan-ly-tour/destination/index/2" class="navbar-link desdrop dropdown-toggle"
                                id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color: rgb(0, 225, 255); font-weight: bold;">Điểm đến <i
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
    </nav>

    <main>
        <article>
            <!-- Trang Tour Miền ...-->
            <div id="chitiet-tour">
                <div class="chitiet-tour">
                    <h4>
                        <label class="mienbac-chitiet">
                            <a
                                href="/quan-ly-tour/destination/index/<?=$category[0]['cate_id']?>"><?=$category[0]['name']?></a>
                            >
                            <a href=""><strong><?= $details['name']?></strong></a>
                        </label>
                    </h4>
                    <h3>Thông tin chi tiết về chuyến đi</h3>

                    <div class="chitiet-general">
                        <div>
                            <div class="slideshow-container">
                                <img src="/quan-ly-tour/<?=$details['thumbnail']?>" style="width:100%; height: 400px;">
                            </div>
                            <br>
                            <ul class="chuyendi-chitiet">
                                <?php
                                // Chuỗi ban đầu
                                $infoString = $details['description'];
                                
                                // Loại bỏ các từ khóa không cần thiết
                                $keywords = ["Ẩm thực: ", "Đối tượng thích hợp: ", "Thời gian lý tưởng: ", "Khuyến mãi: "];
                                foreach ($keywords as $keyword) {
                                    $infoString = str_replace($keyword, '', $infoString);
                                }
                                
                                // Tách chuỗi thành mảng bằng dấu phân cách ";"
                                $infoArray = explode(';', $infoString);
                                
                                // Lấy các chuỗi riêng lẻ từ mảng và loại bỏ khoảng trắng thừa
                                $amThuc = trim($infoArray[0]);  // "Đặc sản biển, Bánh canh"
                                $doiTuongThichHop = trim($infoArray[1]);  // "Gia đình, Cặp đôi, Bạn bè"
                                $thoiGianLyTuong = trim($infoArray[2]);  // "Mùa hè"
                                $khuyenMai = trim($infoArray[3]);  // "Giảm 15% cho nhóm từ 4 người trở lên"
                             ?>
                                <div class="column1">
                                    <li><strong>Ẩm thực</strong><?=$amThuc?></li>
                                    <li><strong>Đối tượng thích hợp</strong><?=$doiTuongThichHop?>
                                    </li>
                                </div>
                                <div class="column2">
                                    <li><strong>Thời gian lý tưởng</strong><?=$thoiGianLyTuong?></li>
                                    <li><strong>Khuyến mãi</strong><?=$khuyenMai?></li>
                                </div>
                            </ul>
                            <h3>Lịch trình</h3>
                            <?php
                        // Chuỗi mô tả lịch trình ban đầu
                        $itinerary =$details['itinerary'];

                        // Sử dụng preg_split để tách chuỗi thành các phần dựa trên cụm từ "Ngày" và giữ lại các cụm từ "Ngày"
                        $itineraryParts = preg_split("/(Ngày \d+:)/", $itinerary, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

                        // Tạo mảng để lưu trữ các ngày riêng biệt và tiêu đề
                        $days = [];
                        for ($i = 0; $i < count($itineraryParts); $i += 2) {
                            $dayTitle = trim($itineraryParts[$i]);
                            $dayContent = trim($itineraryParts[$i + 1]);

                            // Tách tiêu đề và nội dung
                            preg_match("/(.*?):(.*)/", $dayContent, $matches);
                            if (count($matches) > 2) {
                                $daySubtitle = trim($matches[1]);
                                $dayDetails = trim($matches[2]);
                                $days[] = [
                                    'title' => $dayTitle,
                                    'subtitle' => $daySubtitle,
                                    'details' => $dayDetails
                                ];
                            }
                        }
                        // Hiển thị kết quả
                        foreach ($days as $day) {
                        ?>

                            <div class="schedule">
                                <div class="day">
                                    <div class="day-header">
                                        <div>
                                            <strong><?=htmlspecialchars($day['title'])?></strong><strong><?=htmlspecialchars($day['subtitle'])?></strong>
                                        </div>
                                        <div><span class="dropdown-icon">▼</span></div>
                                    </div>
                                    <div class="day-content" style="display: none;">
                                        <p>
                                            <?=htmlspecialchars($day['details'])?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <h3>Đánh giá của khách hàng</h3>
                            <div class="review-section">
                                <!-- Đánh giá 1 -->
                                <?php 
                            foreach ($reviews as $value){
                            ?>
                                <div class="review">
                                    <div class="review-header">
                                        <div class="user-avatar"></div>
                                        <div class="user-info">
                                            <p class="username">anguyengiaba236</p>
                                            <?php
                                        // Hàm để hiển thị số lượng ngôi sao
                                        function displayStars($rating) {
                                            $stars = '';
                                            for ($i = 0; $i < $rating; $i++) {
                                                $stars .= '⭐';
                                            }
                                            return $stars;
                                        }
                                        ?>
                                            <div class="stars"><?=displayStars($value['rating']) ?></div>
                                        </div>
                                    </div>
                                    <div class="review-content">
                                        <p class="review-date" style="display: flex;">28/05/2024 09:29 | <span> Phân
                                                loại: Miền Bắc</span></p>
                                        <!--CHƯA XỬ LÝ-->
                                        <p class="review-service" style="display: flex;"><span>Dịch vụ:</span> Tốt</p>
                                        <p class="review-care" style="display: flex;"><span>Chăm sóc khách hàng:</span>
                                            Chu đáo và nhiệt tình</p>
                                        <p class="review-message"><?=$value['note']?></p>
                                    </div>
                                </div>
                                <?php }?>
                            </div>

                        </div>
                        <div class="right-section right-detail-tour">
                            <h3 style="text-align: left;margin-top: 20px;margin-left: 20px;margin-right: 10px;">
                                <?= $details['name']?></h3>
                            <div>
                                <li><i style="color: var(--bright-navy-blue);" class="fa-solid fa-location-dot"></i>Khởi
                                    hành: <?=$details['pick_up']?></li>
                                <?php
                            // Giả sử $details['date_start'] chứa ngày tháng ban đầu
                            $dateString = $details['date_start'];
                            $date = new DateTime($dateString);
                            $formattedDate = $date->format('d-m-Y');  // Định dạng ngày thành 'd-m-Y'
                            ?>
                                <li>
                                    <i style="color: var(--bright-navy-blue);"
                                        class="fa-solid fa-calendar-days"></i>Ngày
                                    khởi hành:
                                    <?= $formattedDate ?>
                                </li>
                                <li><i style="color: var(--bright-navy-blue);" class="fa-solid fa-clock"></i>Thời gian:
                                    <?=$details['duration']?></li>
                                <li class="price-from">Giá từ: <?=number_format($details['price'])?> VND / người</li>
                            </div>
                            <?php
                            if (isset($_SESSION['user'])) { ?>
                            <a href="/quan-ly-tour/product/buy/<?=$details['slug']?>" class="chi-tiet-btn xemngay"
                                style="margin-top: 45px;">ĐẶT NGAY</a>
                            <?php } else { ?>
                            <a href="/quan-ly-tour/auth/login/<?=$details['slug']?>" class="chi-tiet-btn xemngay"
                                style="margin-top: 45px;">ĐẶT NGAY</a>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các tiêu đề ngày
        var dayHeaders = document.querySelectorAll('.day-header');

        // Thêm sự kiện click cho mỗi tiêu đề
        dayHeaders.forEach(function(dayHeader) {
            dayHeader.addEventListener('click', function() {
                // Tìm nội dung ngày tương ứng
                var dayContent = this.nextElementSibling;

                // Kiểm tra và thay đổi trạng thái hiển thị
                if (dayContent.style.display === 'none' || dayContent.style.display === '') {
                    dayContent.style.display = 'block';
                    this.querySelector('.dropdown-icon').textContent =
                        '▲'; // Thay đổi biểu tượng
                } else {
                    dayContent.style.display = 'none';
                    this.querySelector('.dropdown-icon').textContent =
                        '▼'; // Thay đổi biểu tượng
                }
            });
        });
    });
    </script>

<script>
        const toggler = document.querySelector('.navbar-toggler'); 
        const navbarNav = document.querySelector('.navbar-collapse'); 
        toggler.addEventListener('click', function() { navbarNav.classList.toggle('show');}); 
    </script>