
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
</head>

<body class="home-body">
    <div class="home-container">
        <h1 class="home-title">Welcome to VietCharm!</h1>
        <div class="home-links">
            <?php if (isset($_SESSION['user'])) { ?>
                <p class="home-greeting">Chào <span class="username"><?= $data_index['user']['username'] ?></span>!</p>
                <div class="avatar">
                    <div class="images">
                        <img src="<?php echo isset($data_index['user']['avatar_url']) ? '/quan-ly-tour/'.$data_index['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>" alt="Avatar" class="avatar-image">
                    </div>
                    <div class="info-management">
                        <div><a href="auth/info" class="info-link">Thông tin tài khoản</a></div>
                        <div><a href="auth/change_password" class="info-link">Đổi mật khẩu</a></div>
                        <div><a href="auth/logout" class="info-link logout-link">Đăng xuất</a></div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="auth-links">
                    <a href="auth/login" class="home-link">Đăng nhập</a>
                    <a href="auth/register" class="home-link">Đăng ký</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
