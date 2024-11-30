
    <!-- Bảng dữ liệu khách hàng -->
    <form action="" method="POST">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Mã KH</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>SDT</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($ordersData)) {
                    $i = 0;
                    foreach ($ordersData as $data) : ?>
                        <tr>
                            <td><input type="text" name="customer_id[]" value="<?php echo 'MAKH' . ++$i; ?>" readonly></td>
                            <td><input name="fullname[]" type="text" value="<?php echo htmlspecialchars($data['fullname']); ?>"></td>
                            <td><input name="email[]" type="text" value="<?php echo htmlspecialchars($data['email']); ?>"></td>
                            <td><input name="phone_number[]" type="text" value="<?php echo htmlspecialchars($data['phone_number']); ?>"></td>
                            <td class="actions">
                                <button type="submit" name="update" value="<?php echo $data['id']; ?>" class="btn-edit">Chỉnh sửa</button>
                            </td>
                        </tr>
                    <?php endforeach; 
                } else {
                    echo '<tr><td colspan="5">Không tìm thấy khách hàng nào.</td></tr>';
                }
                ?>
            </tbody>
            </table>
        
    </form>
    <ul class="pagination" style="justify-content:flex-end">
        <?= $button_pagination ?>
    </ul>

    <script>
    $(document).ready(function() {
        let data;
        let page = 1;
        $('.pagination li a.page-link').click(function() {
            page = $(this).attr('num-page')
            data = {
                page: page
            }
            callback('customer/pagination_page', data);
        })

        function callback(url, data) {
            $.ajax({
                url: url,
                method: "post",
                data: data,
                success: function(response) {
                    $('#loadData').html(response);
                },
            })
        }
    });
</script>

