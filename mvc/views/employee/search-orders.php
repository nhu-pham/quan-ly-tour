<div id="tourlist-container" class="tourlist-container customer-container">
    <h1>Danh sách đơn đặt tour</h1>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Nhập thông tin đơn đặt tour">
    </div>
    <ul class="pagination">
        <?= $button_pagination ?>
    </ul>
    <div class="tour-list search-results" id="orders-list">

    <?php
        if (!empty($ordersData)) {
            $i = 0;
            foreach ($ordersData as $data) : ?>
                <div class="tour-item">
                    <img src="<?php echo '/quan-ly-tour/' . $data['toursImage'] ?>" alt="Avatar">
                    <div class="tour-info">
                        <p><strong>Tên tour:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
                        <p><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($data['fullname']); ?></p>
                    </div>
                    <div class="ngay-gia">
                        <p><strong>Ngày đặt:</strong> <?php echo htmlspecialchars($data['order_date']); ?></p>
                        <p><strong>Trạng thái:</strong> <?php 
                            $status = htmlspecialchars($data['status']);
                            if ($status === 'pending') {
                                echo 'Chờ xác nhận';
                            } elseif ($status === 'completed') {
                                echo 'Hoàn thành';
                            } elseif ($status === 'cancelled') {
                                echo 'Đã huỷ';
                            } else {
                                echo 'Không xác định';
                            }                        
                        ?></p>
                        <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;"><?php echo htmlspecialchars($data['total_money']); ?>VNĐ</label></p>
                    </div>
                    <a href="chiTietDonTour.html" class="update-btn chitiet-btn">Xem chi tiết</a>
                </div>
        <?php endforeach;
        } else {
            echo '<tr><td colspan="5">Không tìm thấy đơn hàng nào.</td></tr>';
        }
        ?>

    </div>

    <script>
    $(document).ready(function() {
        let data;
        let page = 1;
        $('.pagination li a.page-link').click(function() {
            page = $(this).attr('num-page')
            data = {
                page: page
            }
            callback('home/pagination_page', data);
        })

        function callback(url, data) {
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(response) {
                    $('#tourlist-container').html(response);
                },
            })
        }
    });

    document.getElementById('search-input').addEventListener('input', function() {
        let searchTerm = this.value.trim();
        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('tourlist-container').innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', '/quan-ly-tour/employee/home/searchOrders?search=' + encodeURIComponent(searchTerm), true);
        xhr.send();
    });
</script>