<?php 
require_once ('./mvc/views/user/include/header.php');
?>
<main>
    <article>
        <div class="chitiet-tour giohang-section">
            <h4>
                <label class="mienbac-chitiet">
                    <a href="mienBac.html">Miền Bắc</a> >
                    <a href="chiTietTour.html">Cao Bằng - Lạng Sơn (Chùa Phật Tích Trúc Lâm, Làng đá cổ Khuổi Kỵ, Thác
                        Bản Giốc)</a> >
                    <a href="thongTinDatTour.html">Đặt tour</a> >
                    <a href="thanhToan.html">Thanh toán</a> >
                    <a href="dichVu.html">Dịch vụ</a> >
                    <a href="gioHang.html"><strong>Dịch vụ</strong></a>
                </label>
            </h4>

            <h3>Giỏ hàng</h3>
            <div class="cart-container">
                <div class="search-bar">
                    <input type="text" placeholder="Tìm kiếm dịch vụ...">
                    <i class="fa fa-search"></i>
                </div>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Dịch vụ</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dịch vụ 1 -->
                        <tr class="row">
                            <td>
                                <img src="assets/images/camtrai.jpg" alt="Dịch vụ 1">
                                <span>Combo 2 lều, 1 lò nướng (đã bao gồm dụng cụ ăn uống)</span>
                            </td>
                            <td class="price-dv">1.550.000 VND</td>
                            <td class="button-dv">
                                <button class="quantity-btn">-</button>
                                <input type="text" value="1" class="quantity-input">
                                <button class="quantity-btn">+</button>
                            </td>
                            <td class="price-dv">1.550.000 VND</td>
                            <td><button class="delete-btn">Xóa</button></td>
                        </tr>

                        <!-- Dịch vụ 2 -->

                        <tr class="row">
                            <td>
                                <img src="assets/images/oto.jpg" alt="Dịch vụ 2">
                                <span>Vinfast</span>
                            </td>
                            <td class="price-dv">1.550.000 VND</td>
                            <td class="button-dv">
                                <button class="quantity-btn">-</button>
                                <input type="text" value="1" class="quantity-input">
                                <button class="quantity-btn">+</button>
                            </td>
                            <td class="price-dv">1.550.000 VND</td>
                            <td><button class="delete-btn">Xóa</button></td>
                        </tr>

                        <!-- Dịch vụ 3 -->

                        <tr class="row">
                            <td>
                                <img src="assets/images/xemay.jpg" alt="Dịch vụ 3">
                                <span>Vespa</span>
                            </td>
                            <td class="price-dv">1.550.000 VND</td>
                            <td class="button-dv">
                                <button class="quantity-btn">-</button>
                                <input type="text" value="1" class="quantity-input">
                                <button class="quantity-btn">+</button>
                            </td>
                            <td class="price-dv">1.550.000 VND</td>
                            <td><button class="delete-btn">Xóa</button></td>
                        </tr>

                    </tbody>
                </table>
                <a href="dichVu.html" class="add-service-btn"><i class="fa fa-plus"></i> Thêm dịch vụ khác</a>
                <div class="cart-actions">
                    <a href="thongTinDatTour.html" class="confirm-btn">Xác nhận</a>
                </div>
            </div>
        </div>
        <!-- Thông báo -->
        <div id="popup" class="popup popup-delete">
            <div class="popup-content">
                <div class="popup-header">
                    <h3>Thông báo</h3>
                    <span id="close-btn" class="close-btn">&times;</span>
                </div>
                <div class="popup-body">
                    <i class="fa-solid fa-triangle-exclamation" style="color: red; margin-right: 10px;"></i>
                    <p>Bạn có chắc chắn muốn xóa?</p>
                </div>
                <div class="popup-footer">
                    <button id="yes-btn" class="yes-btn">Có</button>
                </div>
            </div>
        </div>