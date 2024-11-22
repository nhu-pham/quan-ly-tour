<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/login.css"> 

<body class="login-body">
    <div class="login-container">
        <h2 class="login-title">Đăng nhập</h2>

        <?php if (isset($_SESSION['sucess'])) { ?>
            <p class="login-flash"><?= $redirect->setFlash('sucess'); ?></p>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <p class="login-errors"><?= $redirect->setFlash('error'); ?></p>
        <?php } ?>

        <form action="" method="post" class="login-form">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input name="email" id="email" type="email" class="form-input" placeholder="Địa chỉ email" required="">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input name="password" id="password" type="password" class="form-input" placeholder="Mật khẩu" required="">
            </div>

            <button type="submit" class="btn btn-submit">Đăng nhập</button>
            <hr class="divider">

            <p class="login-link">
                <a href="forgot" class="link">Quên mật khẩu</a>
            </p>
            <p class="login-link">
                <a href="register" class="link">Đăng ký tài khoản</a>
            </p>
        </form>
    </div>
</body>

</html>
