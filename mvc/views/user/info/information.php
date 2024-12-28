<div id="thongTinTK" class="account-info">
    <h2>Thông tin tài khoản</h2>
    <?php if (isset($_SESSION['sucess'])) { ?>
        <!-- Thông báo lưu thông tin thành công -->
        <div id="popup-update-save" class="popup">
            <div class="popup-content">
                <div class="popup-header">
                    <h3>Thông báo</h3>
                </div>
                <div class="popup-body">
                    <div class="icon-success">
                        &#10004;
                    </div>
                    <p>Cập nhật thông tin thành công!</p>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                const popup = document.getElementById("popup-update-save");
                popup.classList.add("fade-out"); 

                setTimeout(() => {
                    popup.style.display = "none";
                }, 1000); 
            }, 1000); 
        </script>
    <?php }
    unset($_SESSION['sucess']) ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="message error">
            <p class="error-message"><?= $redirect->setFlash('error');  ?></p>
        </div>
    <?php } ?>

    <form action="" method="post" class="account-form" enctype="multipart/form-data">
        <div class="form-tt">
            <label for="fullname" class="form-label">Họ tên</label>
            <input type="text" id="fullname" name="fullname" value="<?= $data['user']['fullname'] ?>"
                class="form-control form-input" readonly>

            <label for="username" class="form-label">Tên đăng nhập</label>
            <input type="text" id="username" name="username" value="<?= $data['user']['username'] ?>"
                class="form-control form-input">
            <p class="error-text"><?= !empty($errors['username']) ? $errors['username'] : ''; ?></p>

            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" name="email" class="form-control form-input" required=""
                pattern="[^@\s]+@[^@\s]+\.[^@\s]+" value="<?= $data['user']['email'] ?>" readonly>

            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control form-input"
                required="" pattern="[0]{1}[0-9]{9}" value="<?= $data['user']['phone_number'] ?>">

            <button type="submit" id="save-btn" class="save-btn">Lưu</button>
        </div>
        <div class="form-group">
            <img id="imagePreview" src="<?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>" alt="Ảnh đại diện" class="avatar-large1">
            <label for="avatar" class="form-avt" style="width:100px">Chọn ảnh</label>
            <input type="file" id="avatar" name="avatar" accept="image/png,image/jpeg,image/jpg" class="form-control form-input" onchange="previewImage(event)">
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            var image = document.getElementById('imagePreview');
            image.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>