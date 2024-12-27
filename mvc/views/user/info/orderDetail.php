<div id="dontour-container" class="dontour-container">

    <h2>Thông tin đơn đặt tour</h2>
    <?php
    if (!empty($orderDetail)) {
        foreach ($orderDetail as $data) : ?>
            <?php
            $totalMoneyServices = array_sum(array_column($data['services'], 'total_money_service'));
            ?>
            <div class="hoadon-header" style="display: flex;
                            justify-content: space-between;">
                <div class="matour">
                    <label for="tourCode" style="width:150px;margin-left: 40px;
                                                        color: var(--bright-navy-blue);
                                                        padding: 10px;
                                                        border: 1px solid var(--black);
                                                        margin-bottom: 30px;">
                        <strong>Mã đơn:</strong> <?php echo htmlspecialchars($data['order_id']); ?> - <strong><?php $status = htmlspecialchars($data['status']);
                                                                                                                if ($status === 'pending') {
                                                                                                                    echo 'Chờ xác nhận';
                                                                                                                } elseif ($status === 'completed') {
                                                                                                                    echo 'Hoàn thành';
                                                                                                                } elseif ($status === 'cancelled') {
                                                                                                                    echo 'Đã huỷ';
                                                                                                                } else {
                                                                                                                    echo 'Không xác định';
                                                                                                                } ?></strong></label>
                </div>

                <div class="ngaydat">
                    <i class="fa-solid fa-calendar-days"></i>
                    <label>Ngày đặt: <?php echo htmlspecialchars($data['order_date']); ?></label>
                </div>
            </div>
            <div class="booking-info">
                <div class="left-section">
                    <div class="form-group">
                        <label for="customerCode"><strong>Tên khách hàng</strong></label>
                        <input type="text" id="customerCode" name="fullname" value="<?php echo htmlspecialchars($data['fullname']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contactInfo"><strong>Thông tin liên hệ</strong></label>
                        <div style="width: 100%;">
                            <input type="text" id="contactInfo" name="phone_number" value="<?php echo htmlspecialchars($data['phone_number']); ?>">
                            <input type="text" id="emailInfo" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                            <input type="text" id="locationInfo" name="address" value="<?php echo htmlspecialchars($data['address']); ?>">
                        </div>
                    </div>
                    <div class="ds-dv chitiet-dsdv">
                        <label style="width: 100%;"><strong>Dịch vụ đã thuê</strong></label>
                        <table class="tablechititiet">
                            <thead>
                                <tr>
                                    <th>Tên dịch vụ</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['services'] as $service): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($service['serviceName']); ?></td>
                                        <td><?php echo htmlspecialchars($service['number_of_services']); ?></td>
                                        <td class="gia"><?php echo htmlspecialchars($service['service_price']); ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <div class="tong-tien" style="width: 300px; display: flex;">
                                            <strong>Tổng tiền</strong>
                                            <span class="tong-gia" style="margin-left: 100px;"><?php
                                                                                                echo htmlspecialchars($totalMoneyServices);
                                                                                                ?>VNĐ</span>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="sokhach">
                        <strong>Số khách</strong> <input type="number" value="<?php echo htmlspecialchars($data['number_of_people']); ?>">
                    </div>
                    <div>
                        <div class="tongtien" style="display: flex;"><strong>Tổng hóa đơn</strong><label style="color: red; font-weight: bold; font-size: 25px; margin-left: 75px;">
                                <?php echo htmlspecialchars($data['total_money']); ?>VNĐ
                            </label></div>
                    </div>
                </div>

                <div class="right-section">
                    <div class="group-info">
                        <h3><?php echo htmlspecialchars($data['tourName']); ?></h3>
                        <ul>
                            <li><i style="color: var(--bright-navy-blue);" class="fa-solid fa-code"></i>Mã Tour: <?php echo htmlspecialchars($data['tour_id']); ?></li>
                            <li><i style="color: var(--bright-navy-blue);" class="fa-solid fa-location-dot"></i>Khởi hành: <?php echo htmlspecialchars($data['tourPickUp']); ?></li>
                            <li><i style="color: var(--bright-navy-blue);" class="fa-solid fa-calendar-days"></i>Ngày khởi hành: <?php echo htmlspecialchars($data['tourDateStart']); ?></li>
                            <li><i style="color: var(--bright-navy-blue);" class="fa-solid fa-clock"></i>Thời gian: <?php echo htmlspecialchars($data['tourDuration']); ?></li>
                            <li style=" margin-left: 15px; color: red; font-weight: bold;">Giá: <?php echo htmlspecialchars($data['tour_price']); ?>VNĐ / người</li>
                        </ul>
                    </div>
                    <button id="back-button" class="quaylai">Quay lại</button>
                </div>
            </div>
    <?php endforeach;
    } else {
        echo '<tr><td colspan="5">Không tìm thấy chi tiết đơn đặt tour.</td></tr>';
    }
    ?>
</div>

<script>
    document.getElementById('back-button').addEventListener('click', function () {
    window.history.back(); 
});
</script>