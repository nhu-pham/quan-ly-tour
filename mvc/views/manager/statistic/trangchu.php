<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="http://localhost/quan-ly-tour/public/assets/css/admin/trangchu.css">
</head>
<body>
<div class="container mt-4">
    <!-- Top Summary Section -->
    <div class="summary">
      <div class="card green">
        <h2>Doanh Thu</h2>
        <p><span id="doanh-thu">
        <?php 
            // Chuyển đổi doanh thu từ đơn vị VNĐ sang triệu VNĐ
            $revenue_in_million = $tour_revenue / 1000000;  // Chuyển từ VNĐ sang triệu VNĐ
            echo number_format($revenue_in_million, 0, '.', ',') . ' triệu VNĐ'; 
        ?>
    </span><br>Trong tháng này</p>
      </div>
      <div class="card yellow">
        <h2>Số lượng tour</h2>
        <!-- Hiển thị giá trị từ PHP -->
        <p><span id="so-luong-tour"><?php echo $tour_amount; ?></span><br>Trong tháng này</p>
      </div>
      <div class="card blue">
        <h2>Nhận xét</h2>
        <!-- Hiển thị giá trị từ PHP -->
        <p><span id="nhan-xet"><?php echo $review_amount; ?></span><br>Trong tháng này</p>
      </div>
      <div class="card lime">
        <h2>Dịch vụ thuê</h2>
        <!-- Hiển thị giá trị từ PHP -->
        <p><span id="dich-vu-thue"><?php echo $service_amount; ?></span><br>Trong tháng này</p>
      </div>
    </div>
      

    <!-- Charts Section -->
    <div class="row justify-content-center mb-5">
        <!-- Biểu đồ doanh thu -->
        <div class="col-md-10 chart-container">
          <h5 class="text-primary text-center mb-3">Thống Kê Doanh Thu</h5>
          <canvas id="revenueChart"></canvas>
        </div>
    </div>
      




  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Custom JS -->
  <script src="http://localhost/quan-ly-tour/public/assets/js/manager/trangchu.js"></script>
</body>
</html>
