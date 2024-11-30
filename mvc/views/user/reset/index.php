<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
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
    <title><?= $title?></title>
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/reset.css"> 

<body>
    <div class="reset-container">
        <h2 class="fogot-title">Đặt lại mật khẩu</h2>

        <?php if (isset($_SESSION['sucess'])) { ?>
            <p class="reset-sucess"><?= $redirect->setFlash('sucess'); ?></p>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <p class="reset-error"><?= $redirect->setFlash('error'); ?></p>
        <?php } ?>

        <form action="" method="post" class="reset-form">
            <div class="form-group">
                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                <input type="password" name="newPassword" class="form-control" required="">
                <p class="error-text"><?= !empty($errors['newPassword']) ? $errors['newPassword'] : ''; ?></p>
            </div>
            <div class="form-group">
                <label for="retype-newPassword" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="retype-newPassword" class="form-control" required="">
                <p class="error-text"><?= !empty($errors['retype-newPassword']) ? $errors['retype-newPassword'] : ''; ?></p>
            </div>
            <button type="submit" class="btn btn-submit">Lưu</button>
            <p class="reset-link">
                <a href="login" class="link">Đăng nhập</a>
            </p>
            <p class="reset-link">
                <a href="register" class="link">Đăng ký</a>
            </p>
        </form>
    </div>
</body>

</html>

<?php unset($_SESSION['errors']) ?>