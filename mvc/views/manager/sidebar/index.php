
<?php
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
    $redirect = new redirect();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="http://localhost/quan-ly-tour/public/assets/css/admin/sidebar.css">
</head>

<body style="display:flex">

    <!-- Sidebar -->
    <div class="d-flex flex-column align-items-center bg-light sidebar p-3">
        <ul class="nav flex-column w-100">
            <li class="nav-item mb-2">
                <a href="/quan-ly-tour/manager/revenue/" class="nav-link text-dark fw-bold" id="homeLink">Trang chủ</a>
            </li>
            <li class="nav-item mb-2">
                <a href="/quan-ly-tour/manager/tour/" class="nav-link text-dark fw-bold" id="tourLink">Tour</a>
            </li>
            <li class="nav-item mb-2">

                <a href="/quan-ly-tour/manager/order/" class="nav-link text-dark fw-bold" id="orderLink" style="display: none;">Đơn đặt tour</a>

                <a href="/quan-ly-tour/manager/orders" class="nav-link text-dark fw-bold" id="orderLink"
                    style="display: none;">Đơn đặt tour</a>

            </li>
            <li class="nav-item mb-2">
                <a href="/quan-ly-tour/manager/service/" class="nav-link text-dark fw-bold" id="serviceLink">Dịch vụ</a>
            </li>

            <li class="nav-item mb-2">
                <a href="/quan-ly-tour/manager/review/" class="nav-link text-dark fw-bold" id="reviewLink">Nhận xét</a>

            <a href="/quan-ly-tour/manager/review/" class="nav-link text-dark fw-bold" id="reviewLink">Nhận xét</a>

            </li>
            <li class="nav-item mb-2">
                <a href="/quan-ly-tour/manager/role/" class="nav-link text-dark fw-bold" id="roleLink"
                    style="display: none;">Phân quyền</a>
            </li>
        </ul>
    </div>

    <!-- Bootstrap JS -->
    <script src="http://localhost/quan-ly-tour/public/assets/js/admin/sidebar.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

