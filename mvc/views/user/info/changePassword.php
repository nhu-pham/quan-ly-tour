<div class="container">
    <div class="form">
        <h3 class="form-title">Đổi mật khẩu</h3>
        <form action="" method="post" class="password-form">
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu cũ</label>
                <input type="password" name="password" class="form-control" required="">
                <?php if (isset($_SESSION['error'])) { ?>
                    <p class="error-text"><?= $redirect->setFlash('error');  ?></p>
                <?php } ?>
                <p class="error-text"><?= !empty($errors['password']) ? $errors['password'] : ''; ?></p>
            </div>
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
            
            <div class="button-group">
                <div class="button-submit">
                    <button type="submit" class="btn-submit">Cập nhật</button>
                </div>
                <a href="../" class="btn-link home-link">Quay lại</a>
            </div>
        </form>
    </div>
</div>
