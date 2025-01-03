<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" href="/quan-ly-tour/public/uploads/images/logo-blue.png">
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
    <style>
        .navbar-link:hover {
            color: var(--bright-navy-blue);
        }
    </style>
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body id="top">
    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background">
        <a href="/quan-ly-tour/">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo" style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px;">
        </a>

        <div class="container">
        <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon" style="color: black;">&#9776;</span>
                </button>
            
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link">Trang chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about" class="navbar-link">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="#destination" class="navbar-link desdrop dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">Điểm đến <i class="fa-solid fa-caret-down"></i></a>
                            <ul class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/2">Miền Bắc</a></li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/3">Miền Trung</a></li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/1">Miền Nam</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/product/tours" class="navbar-link">Tour</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/contact" class="navbar-link">Liên hệ</a></li>
                    </div>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <div id="user-profile" class="user-profile">
                                <div class="user-account">
                                    <?php $avatar = isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>
                                    
                                    <img src="<?= $avatar ?>"
                                        alt="Avatar" class="user-image">
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
                        <li class="nav-item"><a href="login " class="btn btn-primary">Đăng nhập</a></li>
                    <?php } ?>
                    </li>
                </ul>
            
        </div>
    </nav>

    <main>
        <article>


        <script> 
    const toggler = document.querySelector('.navbar-toggler'); 
        const navbarNav = document.querySelector('.navbar-collapse'); 
        toggler.addEventListener('click', function() { navbarNav.classList.toggle('show');}); 
        
        function togglePassword(id, button) {
            const input = document.getElementById(id); // Lấy input tương ứng
            const eyeIcon = button.querySelector('.fa-regular'); // Lấy biểu tượng mắt trong button được bấm
        
            if (input.type === 'password') {
                input.type = 'text'; // Hiển thị mật khẩu
                eyeIcon.classList.remove('fa-eye-slash'); // Xóa icon mắt có dấu gạch chéo
                eyeIcon.classList.add('fa-eye'); // Thêm icon mắt mở
            } else {
                input.type = 'password'; // Ẩn mật khẩu
                eyeIcon.classList.remove('fa-eye'); // Xóa icon mắt mở
                eyeIcon.classList.add('fa-eye-slash'); // Thêm icon mắt có dấu gạch chéo
            }
        }
        document.querySelector('[href="#doimatkhau"]').addEventListener("click", function () {
        document.getElementById("popup").style.display = "flex";
        });
        document.getElementById("close-btn").addEventListener("click", function () {
        document.getElementById("popup").style.display = "none";
        window.location.href = "dangNhap.html";
        });
    
        document.getElementById("confirm-btn").addEventListener("click", function () {
        document.getElementById("popup").style.display = "none";
        window.location.href = "dangNhap.html";
        });
    
        </script>