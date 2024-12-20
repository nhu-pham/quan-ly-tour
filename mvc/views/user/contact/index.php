<?php 
require_once ('./mvc/views/user/include/header.php');
?>
<main>
    <article>
        <div id="contact-container" class="contact-container">
            <h2 class="title">Thông tin liên hệ</h2>
            <p class="desc">
                Để có thể đáp ứng được các yêu cầu và đóng góp ý kiến của quý khách, xin vui lòng gửi thông tin hoặc
                gọi đến hotline các chi nhánh bên dưới để liên hệ một cách nhanh chóng.
            </p>
            <div class="contact-content">

                <div class="form-section">
                    <h3>Thông tin liên lạc</h3>
                    <form action="#">
                        <label for="contact-type">Loại thông tin <span style="color: red;">*</span></label>
                        <select id="contact-type" required>
                            <option value="">Chọn loại thông tin</option>
                            <option value="">Du lịch</option>
                            <option value="">Chăm sóc khách hàng</option>
                            <option value="">Liên hệ thông tin khác</option>
                        </select>

                        <label for="name">Họ tên <span style="color: red;">*</span></label>
                        <input type="text" id="name" placeholder="Nhập họ tên" required>

                        <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                        <input type="tel" id="phone" placeholder="Nhập số điện thoại" required>

                        <label for="address">Địa chỉ <span style="color: red;">*</span></label>
                        <input type="text" id="address" placeholder="Nhập địa chỉ" required>

                        <label for="title">Tiêu đề <span style="color: red;">*</span></label>
                        <input type="text" id="title" placeholder="Nhập tiêu đề" required>

                        <label for="message">Nội dung <span style="color: red;">*</span></label>
                        <textarea id="message" rows="5" placeholder="Nhập nội dung" required></textarea>

                        <button type="sent-btn">Gửi ngay</button>
                    </form>
                </div>


                <div class="branch-section">
                    <h3>Mạng lưới chi nhánh</h3>
                    <div class="parts">
                        <button class="part active">Miền Bắc</button>
                        <button class="part">Miền Trung</button>
                        <button class="part">Miền Nam</button>
                    </div>
                    <hr style="border-bottom: 1px solid black;">
                    <div class="info-branch">
                        <h4>CHI NHÁNH HÀ NỘI</h4>
                        <p><i class="fa-solid fa-location-dot"></i>03 Hai Bà Trưng, Hà Nội - Tel: 024. 3933 1978 | VPDL
                            khách
                            đoàn: Tầng 7, tòa nhà Hồng Hà - Số 37 Ngô Quyền, Hà Nội </p>
                        <p><i class="fa-solid fa-envelope"></i>Email: hn1@vietcharm.com</p>
                        <p><i class="fa-solid fa-phone"></i>Hotline: (024) 3933 1978 | 0989 37 00 33</p>

                        <h4>CHI NHÁNH HẢI PHÒNG</h4>
                        <p><i class="fa-solid fa-location-dot"></i>04 Trần Hưng Đạo, P. Hoàng Văn Thụ, Q.Hồng Bàng, TP.
                            Hải
                            Phòng</p>
                        <p><i class="fa-solid fa-envelope"></i>Email: hp2@vietcharm.com</p>
                        <p><i class="fa-solid fa-phone"></i>Hotline: (0225) 3842 888 | 0936 900 085</p>
                    </div>
                </div>
            </div>
        </div>