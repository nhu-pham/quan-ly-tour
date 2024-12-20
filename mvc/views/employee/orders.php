<div id="tourlist-container" class="tourlist-container customer-container">
    <h1>Danh sách đơn đặt tour</h1>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Nhập thông tin đơn đặt tour">
    </div>
    <div id="search-result">
        <ul class="pagination">
            <?= $button_pagination ?>
        </ul>
        <div class="tour-list search-results" id="orders-list">
            <?php
            if (!empty($ordersData)) {
                foreach ($ordersData as $data) : ?>
                    <div class="tour-item">
                        <img src="<?php echo '/quan-ly-tour/' . $data['toursImage'] ?>" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Tên tour:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
                            <p><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($data['fullname']); ?></p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> <?php echo htmlspecialchars($data['order_date']); ?></p>
                            <div class="trangthai-gia">
                                <p><strong>Trạng thái:</strong> <label class="
                                <?php
                                $status = htmlspecialchars($data['status']);
                                if ($status === 'pending') {
                                    echo 'choxacnhan';
                                } elseif ($status === 'completed') {
                                    echo 'hoanthanh';
                                } elseif ($status === 'cancelled') {
                                    echo 'dahuy';
                                }
                                ?>">
                                        <?php
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
                                        ?></label></p>
                                <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;"><?php echo htmlspecialchars($data['total_money']); ?>VNĐ</label></p>
                            </div>
                        </div>
                        <a href="home/detail" class="update-btn chitiet-btn" data-id="<?php echo $data['id']; ?>">Xem chi tiết</a>
                    </div>
            <?php endforeach;
            } else {
                echo '<tr><td colspan="5">Không tìm thấy đơn hàng nào.</td></tr>';
            }
            ?>
        </div>
    </div>

</div>



<script>
    const toggler = document.querySelector('.navbar-toggler');
    const navbarNav = document.querySelector('.navbar-collapse');
    toggler.addEventListener('click', function() {
        navbarNav.classList.toggle('show');
    });

    $(document).ready(function() {
        let page = 1;

        $(document).on('click', '.pagination li a.page-link', function(e) {
            e.preventDefault();
            page = $(this).attr('num-page');
            let search = $('#search-input').val();
            let data = {
                page: page,
                search: search
            };
            callback('home/pagination_page', data);
        });

        function callback(url, data) {
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(response) {
                    $('#loadData').html(response);
                },
            });
        }
    });

    document.getElementById('search-input').addEventListener('input', function() {
        let searchTerm = this.value.trim();
        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('search-result').innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', '/quan-ly-tour/employee/home/searchOrders?search=' + encodeURIComponent(searchTerm), true);
        xhr.send();
    });

    $(document).on('click', '.chitiet-btn', function(e) {
        e.preventDefault();

        let orderId = $(this).data('id');
        window.location.href = '/quan-ly-tour/employee/home/detail?id=' + orderId;
    });
</script>