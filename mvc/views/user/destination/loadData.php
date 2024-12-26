<?php 
    if(isset($data['datas']) && $data['datas']!= NULL){?>
<?php foreach($data['datas'] as $value){?>
<div class="result-item">
    <img src="/quan-ly-tour/<?=$value['thumbnail']?>" alt="Cao Bằng" class="result-image">
    <div class="result-details">
        <h3><?=$value['tour_name']?></h3>
        <div><i class="fa-solid fa-location-dot"></i>
            <p>Khởi hành: <?=$value['pick_up']?></p>
        </div>
        <?php
            // Giả sử $details['date_start'] chứa ngày tháng ban đầu
            $dateString = $value['date_start'];
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d-m-Y');  // Định dạng ngày thành 'd-m-Y'
            ?>
        <div><i class="fa-solid fa-calendar-days"></i>
            <p>Ngày khởi hành: <?= $formattedDate ?></p>
        </div>
        <div><i class="fa-solid fa-clock"></i>
            <p>Thời gian: <?=$value['duration']?></p>
        </div>
        <div class="price-and-button">
            <p class="price">Giá từ: <?=number_format($value['price'])?>VNĐ</p>
            <a href="/quan-ly-tour/product/detail/<?=$value['slug']?>" class="detail-btn">Xem chi tiết</a>
        </div>
    </div>
</div>
<?php }?>
<?php }?>

<ul class="pagination" style="display: flex">
    <?= $data['button_pagination']; ?>
</ul>

<script>
$(document).ready(function() {
    let page = 1;

    $('.pagination').on('click', 'li a.page-link', function(event) {
        //event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        page = $(this).attr('num-page');
        alert("Đã nhấp vào phân trang, trang: " + page);
        let data = {
            page: page
        };
        callback('destination/pagination_page/<?=$cate_id?>', data);
    });

    function callback(url, data) {
        $.ajax({
            url: url,
            method: "post",
            data: data,
            success: function(response) {
                $('#loadData').html(response);
            }
        });
    }
});
</script>