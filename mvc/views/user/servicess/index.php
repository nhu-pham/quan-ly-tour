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
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/trangChu.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/ttDatTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/thueDichVu.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/footer.css">
    <style>
    .navbar-link:hover {
        color: var(--bright-navy-blue);
    }
    </style>
    <!-- google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body id="top">
    <!-- header section  -->


    <nav id="header" class="navbar navbar-expand-lg navbar-light bg-light header-background">
        <a href="trangChu.html">
        <img src="/quan-ly-tour/public/uploads/images/logo-blue.png" alt="Logo" class="logo2"
        style="width: 160px; height: auto; margin-left: 60px; margin-top: -20px; ">
        </a>

        <div class="container">
        <div class="collapse navbar-header" id="navbarNav">
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon" style="color: black;">&#9776;</span>
                </button>
                <ul class="navbar-nav navbar-collapse ms-auto navbar-list">
                    <li class="nav-item"><a href="/quan-ly-tour/" class="navbar-link ">Trang chủ</a></li>
                    <li class="nav-item"><a href="/quan-ly-tour/about/" class="navbar-link ">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-des">
                            <a href="/quan-ly-tour/destination/index/2" class="navbar-link desdrop dropdown-toggle"
                                id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color: rgb(0, 225, 255); font-weight: bold;">Điểm đến <i
                                    class="fa-solid fa-caret-down"></i></a>
                            <ul class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/2">Miền Bắc</a></li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/3">Miền Trung</a>
                                </li>
                                <li><a class="dropdown-item" href="/quan-ly-tour/destination/index/1">Miền Nam</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/product/tours" class="navbar-link change-color">Tour</a>
                    </li>
                    <li class="nav-item"><a href="/quan-ly-tour/contact" class="navbar-link change-color"
                            class="navbar-link change-color">Liên hệ</a></li>
                    </div>
                    <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <div id="user-profile" class="user-profile">
                            <div class="user-account"><img src="
                                <?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>
                                " alt="Avatar" class="user-image">
                                <button id="user-name"><i class="fa-solid fa-caret-down"></i></button>
                            </div>
                            <div class="user-options">
                                <a href="/quan-ly-tour/auth/info">
                                    <i class="fas fa-cog"></i>
                                    Quản lý thông tin
                                </a>
                                <a href="/quan-ly-tour/auth/change_password">
                                    <i class="fa-solid fa-key"></i>
                                    Đổi mật khẩu
                                </a>
                                <a href="/quan-ly-tour/auth/orders">
                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                    Đơn mua
                                </a>
                                <a href="/quan-ly-tour/auth/logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item"><a href="/quan-ly-tour/auth/login" class="btn btn-primary">Đăng nhập</a></li>
                    <?php } ?>
            </div>
            </ul>
        </div>
    </nav>

    <main>
        <article>
            <div id="dichVu" class="chitiet-tour">
                <h4>
                    <label class="mienbac-chitiet">
                        <a
                            href="/quan-ly-tour/destination/index/<?=$tour[0]['cate_id']?>"><?=$tour[0]['cate_name']?></a>
                        >
                        <a href="/quan-ly-tour/product/detail/<?=$tour[0]['slug']?>"><?=$tour[0]['tour_name']?></a> >
                        <a href="/quan-ly-tour/product/buy/<?=$tour[0]['slug']?>">Đặt tour</a> >
                        <a href="dichVu.html"><strong>Dịch vụ</strong></a>
                    </label>
                </h4>
                <div class="title-cart">
                    <h3>Thuê dịch vụ du lịch</h3>
                    <a href="/quan-ly-tour/cart/viewCart/<?=$tour[0]['slug']?>" class="cart-icon"><i
                            class="fa-solid fa-cart-shopping"></i></a>
                    <label id="quantity"><?=$data['qty']?></label>
                </div>

                <label class="product-rent">
                    <a href="#" data-category="xemay" class="load-category selected">Xe máy/</a>
                    <a href="#" data-category="oto" class="load-category">Ô tô/</a>
                    <a href="#" data-category="camtrai" class="load-category">Combo cắm trại</a>
                </label>
                <?php if(isset($data['service']) && $data != NULL) { ?>
                <div id="loadContent">
                    <?php 
                $datas = json_encode($data['service']); // Chuyển đổi dữ liệu PHP thành JSON
                ?>
                </div>
                <?php }?>
                <div class="buttons dichvu-btn">
                    <a href="/quan-ly-tour/product/buy/<?=$tour[0]['slug']?>" class="bt pay cont">Tiếp tục</a>
                </div>
            </div>
        </article>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        var datas = <?php echo $datas; ?>; // Chuyển đổi JSON thành đối tượng JavaScript

        function loadData(category) {
            $.ajax({
                url: '/quan-ly-tour/mvc/views/user/servicess/loadData.php',
                method: 'POST',
                data: {
                    category: category,
                    datas: datas // Truyền biến dữ liệu
                },
                success: function(response) {
                    $('#loadContent').html(response);
                    attachEventHandlers(); // Gọi hàm để thêm sự kiện sau khi tải dữ liệu
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi AJAX: ' + status + ' - ' + error);
                }
            });
        }

        function attachEventHandlers() {
            $('.quantity-btn.decrease').click(function() {
                var input = $(this).siblings('.quantity-input');
                var currentValue = parseInt(input.val());
                if (!isNaN(currentValue) && currentValue > 0) {
                    input.val(currentValue - 1);
                }
            });

            $('.quantity-btn.increase').click(function() {
                var input = $(this).siblings('.quantity-input');
                var currentValue = parseInt(input.val());
                if (!isNaN(currentValue) && currentValue < 10) { // Giới hạn tối đa là 10
                    input.val(currentValue + 1);
                }
            });

            $('.quantity-input').on('input', function() {
                var value = parseInt($(this).val());
                if (isNaN(value) || value < 0) {
                    $(this).val(0);
                } else if (value > 10) {
                    $(this).val(10);
                }
            });
        }

        // Tải dữ liệu mặc định khi trang được tải
        loadData('xemay');

        // Xử lý sự kiện nhấp chuột vào các liên kết
        $('.load-category').click(function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
            var category = $(this).data('category'); // Lấy giá trị từ thuộc tính data-category
            loadData(category); // Gọi hàm để tải dữ liệu

            // Xóa lớp selected khỏi tất cả các liên kết 
            $('.load-category').removeClass('selected');
            // Thêm lớp selected vào liên kết được nhấp 
            $(this).addClass('selected');
        });

        // Gắn sự kiện cho các nút sau khi tải dữ liệu lần đầu
        attachEventHandlers();
    });
    </script>

    <script>
        const toggler = document.querySelector('.navbar-toggler'); 
        const navbarNav = document.querySelector('.navbar-collapse'); 
        toggler.addEventListener('click', function() { navbarNav.classList.toggle('show');}); 
    </script>