<?php
require_once "./mvc/core/redirect.php";
require "./mvc/views/user/include/header.php";
$redirect = new redirect();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

$currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
$currentPage = basename($currentPage); 


?>
<style>
        .navbar-link:hover { color: var(--bright-navy-blue); }
        .stars {
            font-size: 2rem;
            cursor: pointer;
        }

        .star {
            color: gray;
            transition: color 0.3s ease;
            color: rgb(252, 252, 111)
        }
        
    </style>
<main>
    <article>
        <div id="account-information" class="account-container">
            <!-- Sidebar -->
            <div class="info-sidebar">
                <div class="header-info">
                    <img src="<?php echo isset($data['user']['avatar_url']) ? '/quan-ly-tour/' . $data['user']['avatar_url'] : '/quan-ly-tour/public/uploads/images/user/avt-default.png' ?>" alt="User Avatar" class="avatar-large">
                    <h3><?=$data['user']['username']?></h3>
                </div>
                <ul class="menu">
                    <li><a href="info" class="<?= $currentPage === 'info' ? 'active_tt' : '' ?>">Quản lý thông tin</a></li>
                    <li><a href="change_password" class="<?= $currentPage === 'change_password' ? 'active_tt' : '' ?>">Đổi mật khẩu</a></li>
                    <li><a href="orders" class="<?= $currentPage === 'orders' || $currentPage === 'detailOrder' ? 'active_tt' : '' ?>">Đơn mua</a></li>
                    <li><a href="voucher" class="<?= $currentPage === 'voucher' ? 'active_tt' : '' ?>">Khuyến mãi</a></li>
                    <li><a href="love" class="<?= $currentPage === 'love' ? 'active_tt' : '' ?>">Yêu thích</a></li>
                </ul>
            </div>

            <div class="info-content">
                <?php require_once './mvc/views/user/info/' . $page . '.php'; ?>
            </div>
    </article>
</main>
    
<!-- Hiệu ứng đánh giá sao -->
<script>
    const stars = document.querySelectorAll('.star');
    const reviewModal = document.querySelector('.review-modal');

    let currentRating = 0;
    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            highlightStars(index + 1);
        });
        star.addEventListener('mouseout', () => {
            highlightStars(currentRating);
        });

        star.addEventListener('click', () => {
            currentRating = index + 1;
            highlightStars(currentRating);
        });
    });


    function highlightStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.style.color = 'rgb(252, 215, 30)';
            } else {
                star.style.color = 'gray';
            }
        });
    }
</script>
</body>

</html>

<?php unset($_SESSION['errors']);
require "./mvc/views/user/include/footer.php";
?>