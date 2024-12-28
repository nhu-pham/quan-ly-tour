<div id="yeuThich" class="account-info">
    <h2>Danh sách tour yêu thích</h2>
    <div class="search-bar">
        <input type="text"  id="searchInput" placeholder="Tìm kiếm tour yêu thích của bạn tại đây">
    </div>
    <div id="tourList">
        <?php
        if(!empty($lovedTour)) {
        foreach ($lovedTour as $tour) :
        ?>
            <div class="order-card">
                <img src="/quan-ly-tour/<?= $tour['thumbnail'] ?>" alt="Tour Image" class="order-image fav-image">
                <div class="order-details">
                    <div>
                        <h4><?= $tour['name'] ?></h4>
                    </div>
                    <div><i class="fa-solid fa-location-dot"></i>
                        <p>Khởi hành: <?= $tour['pick_up'] ?></p>
                    </div>
                    <div><i class="fa-solid fa-calendar-days"></i>
                        <p>Ngày khởi hành: <?= $tour['date_start'] ?></p>
                    </div>
                    <div><i class="fa-solid fa-clock"></i>
                        <p>Thời gian: <?= $tour['duration'] ?></p>
                    </div>
                    <p class="giatu">Giá: <?= $tour['price'] ?>VNĐ</p>
                </div>
                <div class="order-summary">
                    <button class="waitforpay love-btn <?php echo $tour['is_love'] ? 'loved' : ''; ?>"
                        data-id="<?php echo $tour['id']; ?>"
                        user-id="<?php echo $data['user']['id']; ?>"
                        >
                        <i class="fa-solid fa-heart"></i>
                    </button>
                    <a href="/quan-ly-tour/product/detail/<?= $tour['slug']?>" class="btngroup pay-btn xemct">Xem chi tiết</a>
                </div>
            </div>
            <?php endforeach;
            } else {
                echo '<tr><td colspan="5">Không tìm thấy tour yêu thích nào.</td></tr>';
            }
            ?>
    </div>
</div>

<script>
    document.querySelectorAll('.love-btn').forEach(button => {
        button.addEventListener('click', function() {
            const tourId = this.getAttribute('data-id');
            const userId = this.getAttribute('user-id');
            const isLoved = this.classList.contains('loved') ? 0 : 1; 
            const parentElement = this.closest('.order-card'); 
            
            fetch('/quan-ly-tour/auth/updateLove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: tourId,
                        is_love: isLoved,
                        userId: userId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (parentElement) {
                            parentElement.remove();
                        }
                    } else {
                        alert('Cập nhật trạng thái thất bại!');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        });
    });

    document.getElementById('searchInput').addEventListener('input', function () {
    const keyword = this.value.toLowerCase().trim(); 
    const tours = document.querySelectorAll('#tourList .order-card');

    tours.forEach(tour => {
        const content = tour.innerText.toLowerCase(); 
        if (content.includes(keyword)) {
            tour.style.display = ''; 
        } else {
            tour.style.display = 'none'; 
        }
    });
});

</script>