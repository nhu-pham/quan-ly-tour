<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VietCharm - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/header.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/sidebar.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/nhanxet.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/tour.css">
    <!-- <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/quanLyTour.css"> -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/trangchu.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/styles.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/employee/orders.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/employee/detail.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/admin/dichvu.css">

    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">

    <style>
        img {
            margin-top: 0px !important;
        }
        .tour-info p:first-child {
            margin-left: 2px !important;
            margin-bottom: 20px;
        }

        .tourlist-container, 
        .dontour-container {
            margin-top: 0px !important;
        }

        .tourlist-container .pagination {
            display: flex;
            text-align: justify;
            margin-left: 80%;
            margin-top: 20px;
        }

        .container1 {
            position: absolute;
            top: 100px;
            left: 230px;
            width: 81%; 
        }

        b, strong {
            font-weight: 700 !important;
        }

        .btn-warning {
            margin-bottom: 10px !important;
        }

    </style>
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
                                    <button id="user-name" class="dropdown-toggle-btn"><i class="fa-solid fa-caret-down"></i></button>
                                </div>
                                <div class="user-options" id="userOptions">
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
                        <li class="nav-item"><a href="/quan-ly-tour/auth/login " class="btn1 btn1-primary">Đăng nhập</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    require_once './mvc/views/manager/sidebar/index.php';
    ?>
    <main>
        <article>
        <div id="loadData">
            <?php
            require_once './mvc/views/manager/' . $page . '.php';
            ?>
            </div>
        </article>
    </main>

            <script src="/quan-ly-tour/public/assets/js/manager/trangchu.js"></script>
            <script src="/quan-ly-tour/public/assets/js/manager/sidebar.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                $(document).ready(function () {
                    const userOptions = $('#userOptions');
                    const toggleBtn = $('.user-account');

                    toggleBtn.on('click', function (e) {
                        e.stopPropagation(); 
                        userOptions.toggle(); 
                        $('#userOptions').css('z-index', 1050); // Đảm bảo menu nằm trên các thành phần khác
                        $('#userOptions').css('overflow', 'visible'); // Kiểm tra nếu bị cắt

                    });

                    $(document).on('click', function () {
                        userOptions.hide();
                    });
                });

            </script>