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
  <link rel="stylesheet" href="http://localhost:8088/quan-ly-tour/public/assets/css/admin/trangchu.css">
</head>
<body>
    <div class="container mt-4">
         <!-- Top Summary Section -->
  <div class="summary">
    <div class="card green">
      <h2>Doanh Thu</h2>
      <p><span>750 triệu</span><br>Trong tháng này</p>
    </div>
    <div class="card yellow">
      <h2>Số lượng tour</h2>
      <p><span>150</span><br>Trong tháng này</p>
    </div>
    <div class="card blue">
      <h2>Nhận xét</h2>
      <p><span>888</span><br>Trong tháng này</p>
    </div>
    <div class="card lime">
      <h2>Dịch vụ thuê</h2>
      <p><span>585</span><br>Trong tháng này</p>
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
      
    <div class="chart">
        <h3 style="color: #ffc107;">Thống kê dịch vụ</h3> <!-- Màu vàng -->
        <canvas id="serviceChart" width="100" height="100"></canvas>
      </div>
    </div>
      


   


  

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Custom JS -->
  <script src="http://localhost:8088/quan-ly-tour/public/assets/js/admin/trangchu.js"></script>
</body>
</html>
