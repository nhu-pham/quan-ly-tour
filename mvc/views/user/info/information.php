<div class="container form-container">
 
        <h3 class="form-title">Thông tin tài khoản</h3>
        <form action="" method="post" class="account-form" enctype="multipart/form-data">
            <div class="form-content">
                <!-- Cột bên trái (form fields) -->
                <div class="form-left">
                    <div class="form-group">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" id="fullname" name="fullname" value="<?= $data['user']['fullname'] ?>"
                            class="form-control form-input" readonly>
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="<?= $data['user']['username'] ?>"
                            class="form-control form-input">
                        <p class="error-text"><?= !empty($errors['username']) ? $errors['username'] : ''; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control form-input" required=""
                            pattern="[^@\s]+@[^@\s]+\.[^@\s]+" value="<?= $data['user']['email'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Số điện thoại</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control form-input"
                            required="" pattern="[0]{1}[0-9]{9}" value="<?= $data['user']['phone_number'] ?>">
                    </div>
                </div>
                
                <!-- Cột bên phải (avatar) -->
                <div class="form-right">
                    <div class="avatar">
                        <img id="imagePreview" src="<?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/'.$data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>" alt="Ảnh đại diện" class="avatar-img" >
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="form-avt">Chọn ảnh</label>
                        <input type="file" id="avatar" name="avatar" accept="image/png,image/jpeg,image/jpg" class="form-control form-input" onchange="previewImage(event)">
                    </div>
                </div>
            </div>
            <div class="button-group">
                <input type="submit" class="btn-submit" value="Cập nhật">
                <a href="../" class="btn-link home-link">Quay lại</a>
            </div>
        </form>
    </div>
</div>


