<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="http://localhost:8088/quan-ly-tour/public/assets/css/admin/trangChu.css">
    <link rel="stylesheet" href="http://localhost:8088/quan-ly-tour/public/assets/css/admin/quanLyTour.css">
    <link rel="stylesheet" href="http://localhost:8088/quan-ly-tour/public/assets/css/admin/footer.css">
    <style>
        .navbar-link:hover { color: var(--bright-navy-blue); }
    </style>
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" 
        rel="stylesheet">
</head>

<body id="top">
    <!-- header section  -->
    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background">
        <a href="trangChu.html">
            <img src="assets/images/logo2-removebg-preview.png" alt="Logo" class="logo2" style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px;">
        </a>
    
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-header" id="navbarNav">
                <ul class="navbar-nav ms-auto navbar-list">
                    
                    <li class="nav-item"><a href="dangNhap.html" class="btn btn-primary">Đăng nhập</a></li>
                    <li class="nav-item" style="display: none;">
                        <!-- <a href="dangNhap.html" class="btn btn-primary" id="dangnhap-btn" data-nav-link>Đăng nhập</a> -->
                        <div id="user-profile" class="user-profile">
                            <div class="user-account"><img src="assets/images/anh3.jpg" alt="Avatar" class="user-image">
                            <button id="user-name"><i class="fa-solid fa-caret-down"></i></button></div> 
                            <div class="user-options">
                                <a href="quanLyThongTin.html">
                                    <i class="fas fa-cog"></i>
                                    Quản lý thông tin
                                </a>
                                <a href="quanLyThongTin.html">
                                    <i class="fa-solid fa-key"></i>
                                    Đổi mật khẩu
                                </a>
<a href="#qlThongTin">
                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                    Đơn mua
                                </a>
                                <a href="#dangxuat">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </div>    
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <article>
            <div id="tourlist-container" class="tourlist-container customer-container">
                <h1>Danh sách đơn đặt tour</h1>
                <div class="search-bar">
                    <input type="text" placeholder="Nhập thông tin tour">
                </div>
                <div id="pagination_DB" class="pagination" style="margin-left: 80%;">
                    <a id="prevpage_DB" class="inactive" href="#">&laquo;</a>
                    <a class="page-link-DB active" href="#">1</a>
                    <a class="page-link-DB" href="#">2</a>
                    <a id="nextpage_DB" class="inactive" href="#">&raquo;</a>
                </div>
                <div class="tour-list search-results">
                    <div class="tour-item">
                        <img src="assets/images/notes-65.png" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Mã tour:</strong> MTOUR01</p>
                            <p><strong>Tên khách hàng:</strong> Nguyễn Văn Anh Tuấn Khang</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> 30/10/2024</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">4.000.000VND</label></p>
                        </div>
                        <a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>
                    <div class="tour-item">
                        <img src="assets/images/notes-65.png" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Mã tour:</strong> MTOUR02</p>
                            <p><strong>Mã khách hàng:</strong> KH02</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> 30/10/2024</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">4.000.000VND</label></p>
                        </div>
                        <a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>
                    <div class="tour-item">
<img src="assets/images/notes-65.png" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Mã tour:</strong> MTOUR03</p>
                            <p><strong>Mã khách hàng:</strong> KH03</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> 30/10/2024</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">4.000.000VND</label></p>
                        </div>
                        <a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>
                    <div class="tour-item">
                        <img src="assets/images/notes-65.png" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Mã tour:</strong> MTOUR04</p>
                            <p><strong>Mã khách hàng:</strong> KH04</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> 30/10/2024</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">4.000.000VND</label></p>
                        </div>
                        <a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>
                    <div class="tour-item">
                        <img src="assets/images/notes-65.png" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Mã tour:</strong> MTOUR05</p>
                            <p><strong>Mã khách hàng:</strong> KH05</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> 30/10/2024</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">4.000.000VND</label></p>
                        </div>
                        <a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>
                    <div class="tour-item last-tour-item">
                        <img src="assets/images/notes-65.png" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Mã tour:</strong> MTOUR06</p>
                            <p><strong>Mã khách hàng:</strong> KH06</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> 30/10/2024</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">4.000.000VND</label></p>
                        </div>
<a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>
                </div>
               
            </div>
            
        </div>
            
    <!-- Footer  -->
    <footer class="footer"> 
        <div class="container"> 
                <div class="newsletter"> 
                    <h3>ĐĂNG KÝ NHẬN BẢN TIN MỚI NHẤT</h3>
                    <div class="nhapemail">
                    <input type="email" placeholder="Nhập email của bạn ở đây!"> 
                    <button>Gửi</button>  
                    </div> 
                    <h3>CHẤP NHẬN THANH TOÁN</h3>
                    <div class="payment-methods"> 
                        <div><img src="assets/images/vimomo.png" alt="MoMo"></div>
                        <div><img src="assets/images/zalopay.png" alt="Zalo Pay"></div> 
                        <div><img src="assets/images/vnpay.png" alt="VNPay"></div> 
                        <div><img src="assets/images/thevisa.png" alt="VISA"></div> 
                    </div> 
                </div> 
                <div class="links"> 
                    <h3>ĐIỂM ĐẾN</h3> 
                    <a href="mienBac.html">Miền Bắc</a> 
                    <a href="mienTrung.html">Miền Trung</a> 
                    <a href="mienNam.html">Miền Nam</a> 
                </div> 
                <div class="links">
                    <h3>TOUR</h3> 
                    <a href="tourDacBiet.html">Tour đặc biệt</a> 
                    <a href="mienBac.html">Miền Bắc</a> 
                    <a href="mienTrung.html">Miền Trung</a> 
                    <a href="mienNam.html">Miền Nam</a> 
                </div> 
                <div class="links"> 
                        <h3>THÔNG TIN</h3> 
                        <a href="gioiThieu.html">Về chúng tôi</a> 
                        <a href="lienHe.html">Liên hệ</a> 
                </div> 
        </div>
        <hr class="footer-line">
        <div class="below">
                <div class="logo"> 
                    <img src="assets/images/LOGO-removebg-preview.png" alt="VietCharm Logo"> 
                    <h3>VietCharm</h3> 
                </div> 
                
                <div class="contact-info"> 
                    <p> <i class="fa-solid fa-location-dot"></i>  Đường Tạ Quang Bửu, Khu phố 6, phường Linh Trung, Thành phố Thủ Đức, Hồ Chí Minh</p> 
                    <div id="email-phone-fax">
                    <p><i class="fa-regular fa-envelope"></i>  Email: vietcham.contact@gmail.com</p> 
                    <p><i class="fa-solid fa-phone"></i>  Phone: 0324561235</p> 
                    <p><i class="fa-solid fa-fax"></i>  Fax: 19006067</p> 
                </div>
        </div>         
        </div>
            
            </footer>
        </article>
    </main>



    <!-- custom js link  -->
<script src="./assets/js/phanTrangDB.js"></script>

    <!-- ionicon link  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>