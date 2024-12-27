<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourly - Travel agancy</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- custom css link  -->
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/ttDatTour.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/gioHang.css">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/home.css">
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
                            <a href="auth/info">
                                <i class="fas fa-cog"></i>
                                Quản lý thông tin
                            </a>
                            <a href="auth/change_password">
                                <i class="fa-solid fa-key"></i>
                                Đổi mật khẩu
                            </a>
                            <a href="auth/orders">
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
            
            </ul>
        </div>
    </nav>
    <main>
        <article>
            <div class="chitiet-tour giohang-section">
                <h4>
                    <label class="mienbac-chitiet">
                        <a
                            href="/quan-ly-tour/destination/index/<?=$tour[0]['cate_id']?>"><?=$tour[0]['cate_name']?></a>
                        >
                        <a href="/quan-ly-tour/product/detail/<?=$tour[0]['slug']?>"><?=$tour[0]['tour_name']?></a> >
                        <a href="/quan-ly-tour/product/buy/<?=$tour[0]['slug']?>">Đặt tour</a> >
                        <a href="/quan-ly-tour/service/loadData/<?=$tour[0]['slug']?>">Dịch vụ</a> >
                        <a href=""><strong>Giỏ hàng</strong></a>
                    </label>
                </h4>

                <h3>Giỏ hàng</h3>
                <div class="cart-container">
                    <div class="search-bar">
                        <input id="search-input" type="text" placeholder="Tìm kiếm dịch vụ...">
                        <i id="search-icon" class="fa fa-search"></i>
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
                        <tbody id="cart-body">
                            <?php if(isset($data['cart']) && $data['cart']!=NULL){ 
                            foreach($data['cart'] as $value){?>
                            <tr class="row" data-id="<?=$value['slug_service']?>">
                                <td>
                                    <img src=" /quan-ly-tour/<?=$value['image_url']?>">
                                    <span><?=$value['name']?></span>
                                </td>
                                <td class="price-dv"><?= number_format($value['price'])?> VNĐ</td>
                                <td class="button-dv">
                                    <button class="quantity-btn decrease">-</button>
                                    <input type="text" value="<?=$value['qty']?>" class="quantity-input">
                                    <button class="quantity-btn increase">+</button>
                                </td>
                                <td class="price-dv total-price"><?= number_format($value['price'] * $value['qty'])?>
                                    VNĐ
                                </td>
                                <td><button class="delete-btn">Xóa</button></td>
                            </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                    <a href="/quan-ly-tour/service/loadData/<?=$tour[0]['slug']?>" class="add-service-btn"
                        id="back-button"><i class="fa fa-plus"></i> Thêm dịch vụ khác</a>
                    <div class="cart-actions">
                        <a href="/quan-ly-tour/product/buy/<?=$tour[0]['slug']?>" class="confirm-btn">Xác nhận</a>
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
                        <i class="fa-solid fa-triangle-exclamation" style="color: red; margin-right: 10px"></i>
                        <p>Bạn có chắc chắn muốn xóa?</p>
                    </div>
                    <div class="popup-footer">
                        <button id="yes-btn" class="yes-btn">Có</button>
                        <button id="no-btn" class="no-btn">Không</button>
                    </div>
                </div>
            </div>
        </article>
    </main>

    <script>
    document.getElementById('search-icon').addEventListener('click', function() {
        performSearch();
    });
    document.getElementById('search-input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            performSearch();
        }
    });

    function performSearch() {
        var searchValue = document.getElementById('search-input').value.toLowerCase();
        var rows = document.querySelectorAll('#cart-body .row');
        rows.forEach(function(row) {
            var serviceName = row.querySelector('td span').textContent.toLowerCase();
            if (serviceName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            var isIncrease = this.classList.contains('increase');
            var input = this.parentElement.querySelector('.quantity-input');
            var priceElement = this.closest('tr').querySelector('.price-dv');
            var totalPriceElement = this.closest('tr').querySelector('.total-price');
            var price = parseInt(priceElement.textContent.replace(/[^0-9]/g, ''));
            var qty = parseInt(input.value);

            if (isIncrease) {
                qty++;
            } else {
                qty = qty > 1 ? qty - 1 : 1;
            }

            input.value = qty;
            totalPriceElement.textContent = new Intl.NumberFormat('vi-VN').format(price * qty) + ' VNĐ';
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            var row = this.closest('tr');
            var popup = document.getElementById('popup');
            var yesBtn = document.getElementById('yes-btn');
            var noBtn = document.getElementById('no-btn');

            popup.style.display = 'block';

            yesBtn.onclick = function() {
                row.remove();
                popup.style.display = 'none';
            };

            noBtn.onclick = function() {
                popup.style.display = 'none';
            };

            document.getElementById('close-btn').onclick = function() {
                popup.style.display = 'none';
            };
        });
    });

    document.querySelector('.confirm-btn').addEventListener('click', function() {
        var cart = [];
        document.querySelectorAll('#cart-body .row').forEach(function(row) {
            var slug = row.getAttribute('data-id');
            var qty = row.querySelector('.quantity-input').value;
            cart.push({
                slug: slug,
                qty: qty
            });
        });

        $.ajax({
            url: '/quan-ly-tour/cart/updateCart', // Đường dẫn đến hàm updateCart 
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ // Chuyển đổi dữ liệu thành JSON
                cart: cart
            }),
            success: function(response) {
                try {
                    const res = JSON.parse(response); // Chuyển đổi phản hồi thành JSON
                    if (res.status === 'success') {
                        console.log(res.message);
                        alert('Giỏ hàng đã được cập nhật');
                    } else {
                        console.error(res.message);
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi AJAX: ' + status + ' - ' + error);
            }
        });
    });
    </script>

<script>
        const toggler = document.querySelector('.navbar-toggler'); 
        const navbarNav = document.querySelector('.navbar-collapse'); 
        toggler.addEventListener('click', function() { navbarNav.classList.toggle('show');}); 

        document.querySelectorAll('.delete-btn').forEach(function (element) {
        element.addEventListener("click", function () {
    document.getElementById("popup").style.display = "block";
    });});
        document.getElementById("close-btn").addEventListener("click", function () {
            document.getElementById("popup").style.display = "none";
        });

        document.getElementById("yes-btn").addEventListener("click", function () {
            document.getElementById("popup").style.display = "none";
        });
    </script>