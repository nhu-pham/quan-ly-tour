<?php
require_once "./mvc/core/redirect.php";

$redirect = new redirect();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VietCharm - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/employee/orders.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/employee/detail.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
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
    <!-- header section  -->
    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 4px 8px 0px !important;">
        <a href="/quan-ly-tour">
            <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo" style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px;">
        </a>

        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-header" id="navbarNav">
                <ul class="navbar-nav ms-auto navbar-list">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <div id="user-profile" class="user-profile" style="position: relative;">
                                <div class="user-account">
                                    <?php $avatar = isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>

                                    <img src="<?= $avatar ?>"
                                        alt="Avatar" class="user-image">
                                    <button id="user-name"><i class="fa-solid fa-caret-down"></i></button>
                                </div>
                                  <div class="user-options" style="top: -40px; left: 0px;">
                                    <a href="/quan-ly-tour/auth/info">
                                        <i class="fas fa-cog"></i>
                                        Quản lý thông tin
                                    </a>
                                    <a href="/quan-ly-tour/auth/change_password">
                                        <i class="fa-solid fa-key"></i>
                                        Đổi mật khẩu
                                    </a>
                                    <a href="/quan-ly-tour/auth/logout">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Đăng xuất
                                    </a>
                                </div>
                            </div>
                        <?php } else { ?>
                        <li class="nav-item"><a href="/quan-ly-tour/auth/login " class="btn btn-primary">Đăng nhập</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>
    <article>
        <div id="loadData">
        <?php
    require_once './mvc/views/employee/' . $page . '.php';
    ?>
    </div>


    <?php
    require "./mvc/views/user/include/footer.php"
    ?>
