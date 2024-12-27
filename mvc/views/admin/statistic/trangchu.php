
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
      

