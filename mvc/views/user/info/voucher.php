<div id="khuyenMai" class="promotional-info">
    <h2>Khuyến mãi của bạn</h2>
    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Tìm kiếm đơn hàng của bạn tại đây">
    </div>
    <div class="pcard" id="voucher">
        <div class="promotional-card">
            <img src="/quan-ly-tour/public/uploads/images/khuyenmai.png" alt="Tour Image" class="order-image">
            <div class="promotional-details">
                <div>
                    <h3>Giảm 10% Đơn Tối Thiểu ₫2tr</h3>
                </div>
                <div>
                    <h4 style="font-weight: normal; color: red;">Áp dụng cho hình thức chuyển khoản</h4>
                </div>
                <button class="apply">Áp dụng ngay</button>
            </div>
        </div>
        <div class="promotional-card">
            <img src="/quan-ly-tour/public/uploads/images/khuyenmai.png" alt="Tour Image" class="order-image">
            <div class="promotional-details">
                <div>
                    <h3>Giảm 10% Đơn Tối Thiểu ₫1tr5</h3>
                </div>
                <div>
                    <h4 style="font-weight: normal; color: red;">Áp dụng cho hình thức chuyển khoản</h4>
                </div>
                <button class="apply">Áp dụng ngay</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
                const keyword = this.value.toLowerCase().trim();
                const vouchers = document.querySelectorAll('#voucher .promotional-card');

                vouchers.forEach(voucher => {
                    const content = voucher.innerText.toLowerCase();
                    if (content.includes(keyword)) {
                        voucher.style.display = '';
                    } else {
                        voucher.style.display = 'none';
                    }
                });
            });
</script>