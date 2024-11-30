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
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/forgot.css"> 

<body>
    <div class="forgot-container">
        <h2 class="fogot-title">Quên mật khẩu</h2>

        <?php if (isset($_SESSION['sucess'])) { ?>
            <p class="forgot-sucess"><?= $redirect->setFlash('sucess'); ?></p>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <p class="forgot-error"><?= $redirect->setFlash('error'); ?></p>
        <?php } ?>

        <form action="" method="post" class="forgot-form">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input name="email" id="email" type="email" class="form-input" placeholder="Địa chỉ email" required="">
            </div>
            <button type="submit" class="btn btn-submit">Gửi</button>
            <p class="forgot-link">
                <a href="login" class="link">Đăng nhập</a>
            </p>
            <p class="forgot-link">
                <a href="register" class="link">Đăng ký</a>
            </p>
        </form>
    </div>
</body>

</html>