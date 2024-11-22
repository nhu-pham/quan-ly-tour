<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$data = isset($_SESSION['data']) ? $_SESSION['data'] : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/register.css">
</head>

<body>
    <div class="form-container">
        <div class="form-box">
            <h2 class="form-title"><?= $title ?></h2>

            <?php if (isset($_SESSION['sucess'])) { ?>
                <p class="success-message"><?= $redirect->setFlash('sucess'); ?></p>
            <?php } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                <p class="error-message"><?= $redirect->setFlash('error'); ?></p>
            <?php } ?>

            <form action="register" method="post">
                <div class="form-group">
                    <label for="fullname">Họ tên</label>
                    <input name="fullname" type="text" class="form-input" placeholder="Họ tên"
                        value="<?php
                                echo !empty($data['fullname']) ? $data['fullname'] : '';
                                ?>"
                        required>
                    <p class="error-text"><?= !empty($errors['fullname']) ? $errors['fullname'] : ''; ?></p>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-input" placeholder="Địa chỉ email" 
                    value="<?php
                                echo !empty($data['email']) ? $data['email'] : '';
                            ?>"
                    required>
                    <p class="error-text"><?= !empty($errors['email']) ? $errors['email'] : ''; ?></p>
                </div>

                <div class="form-group">
                    <label for="phone_number">Số điện thoại</label>
                    <input name="phone_number" type="tel" class="form-input" pattern="[0]{1}[0-9]{9}" placeholder="Số điện thoại" 
                    value="<?php
                                echo !empty($data['phone_number']) ? $data['phone_number'] : '';
                            ?>"
                    required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input name="password" type="password" class="form-input" placeholder="Mật khẩu" required>
                    <p class="error-text"><?= !empty($errors['password']) ? $errors['password'] : ''; ?></p>
                </div>

                <div class="form-group">
                    <label for="retype-password">Nhập lại mật khẩu</label>
                    <input name="retype-password" type="password" class="form-input" placeholder="Nhập lại mật khẩu" required>
                    <p class="error-text"><?= !empty($errors['retype-password']) ? $errors['retype-password'] : ''; ?></p>
                </div>

                <button type="submit" class="form-button">Đăng ký</button>
                <hr>
                <p class="form-link"><a href="login">Đăng nhập</a></p>
            </form>
        </div>
    </div>
</body>

</html>


<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
?>