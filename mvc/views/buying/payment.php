<?php 
require_once ('./mvc/views/user/include/header.php');
?>
<main>
    <article>
        <div id="dichVu" class="chitiet-tour pay-section">
            <h4>
                <label class="mienbac-chitiet">
                    <a href="mienBac.html">Miền Bắc</a> >
                    <a href="chiTietTour.html">Cao Bằng - Lạng Sơn (Chùa Phật Tích Trúc Lâm, Làng đá cổ Khuổi Kỵ, Thác
                        Bản Giốc)</a> >
                    <a href="thongTinDatTour.html">Đặt tour</a> >
                    <a href="thanhToan.html"><strong>Thanh toán</strong></a>
                </label>
            </h4>
            <h3>Thanh toán</h3>
            <div class="payment-container">

                <div class="right-payment">
                    <label style="color: black; font-weight: bold; margin-bottom: 10px;">Chọn phương thức thanh
                        toán</label>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="momo" value="momo">
                        <img src="./public/uploads/images/vimomo.png" alt="Momo">
                        <label for="momo">
                            Momo
                            <span style="font-weight: normal; color: red;">Nhập mã VCMOMO11 nhận combo voucher cho bạn
                                mới</span>
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="shopee" value="shopee">
                        <img src="./public/uploads/images/shopeepay.png" alt="Momo">
                        <label for="shopee">
                            Shopee Pay
                            <span style="font-weight: normal; color: red;">Nhập mã VIETCHARM - nhận ngay ưu đãi nhận dịp
                                Tết Ất Tỵ</span>
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="zalopay" value="zalopay">
                        <img src="./public/uploads/images/zalopay.png" alt="Visa">
                        <label for="zalopay">
                            Zalo Pay
                            <span style="font-weight: normal; color: red;">Nhập mã GIAMSAU - giảm tối đa 20% cho bạn
                                mới</span>
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="vnpay" value="vnpay">
                        <img src="./public/uploads/images/vnpay.png" alt="Mastercard">
                        <label for="mastercard">

                            VN Pay
                            <span style="font-weight: normal; color: red;">Nhập mã VCVNPAY - giảm tối đa 15% khi thanh
                                toán cho bạn mới</span>
                        </label>
                    </div>
                    <hr>
                    <div class="payment-option pay-card">
                        <img src="./public/uploads/images/thenoidia.png" alt="Visa">
                        <label for="zalopay">
                            Thẻ nội địa
                        </label>
                    </div>
                    <div class="payment-option pay-card">
                        <img src="./public/uploads/images/thevisa.png" alt="Mastercard">
                        <label for="mastercard">
                            Thẻ Visa
                        </label>
                    </div>
                </div>
                <div class="left-payment">
                    <div class="total" style="text-align: center;">
                        <p>Tổng thanh toán: <span
                                style="color: #06960D; font-size: 48px; font-weight: normal;">5.990.000 VND</span></p>
                        <p style="color:#1E5C6D">Thời gian còn lại để thanh toán: 09:10</p>
                    </div>
                    <div class="qr-code">
                        <img src="./public/uploads/images/qr.png" alt="qr">
                    </div>
                </div>
            </div>
            <div class="payment-guide">
                <h3 style="color: #084804; font-size: 30px;">Hướng dẫn thanh toán bằng Momo</h3>
                <ol class="custom-list">
                    <li>Mở ứng dụng momo trên điện thoại</li>
                    <li>Dùng biểu tượng ... để quét mã QR</li>
                    <li>Quét mã ở trang này và thanh toán</li>
                </ol>
            </div>
        </div>