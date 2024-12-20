<div id="donMua" class="order-container">
    <div class="tabs">
        <a href="all" class="tab active_bill" onclick="loadOrders(event, 'all')">Tất cả</a>
        <a href="wait" class="tab" onclick="loadOrders(event, 'pending')">Chờ thanh toán</a>
        <a href="finish" class="tab" onclick="loadOrders(event, 'completed')">Hoàn thành</a>
        <a href="cancel" class="tab" onclick="loadOrders(event, 'cancelled')">Đã hủy</a>
    </div>

    <div class="search-bar">
        <input id="searchInput" type="text" placeholder="Tìm kiếm đơn hàng của bạn tại đây">
    </div>

    <div id="all-order">
        <?php 
        if (!empty($ordersData)) {
        foreach ($ordersData as $order):
            $status = $order['status']; ?>
            <div class="order-card">
                <img src="/quan-ly-tour/<?= $order['toursImage'] ?>" alt="Tour Image" class="order-image">
                <div class="order-details">
                    <div>
                        <h4><?= $order['name'] ?></h4>
                    </div>
                    <div><a href="detailOrder?id=<?php echo $order['id'] ?>" class="detail">Chi tiết đơn hàng</a></div>
                </div>
                <div class="order-summary">
                    <div class="waitforpay"><i class="<?php
                                                        if ($status === 'pending') {
                                                            echo 'bi bi-cash-stack';
                                                        } elseif ($status === 'completed') {
                                                            echo 'fa-solid fa-check';
                                                        } elseif ($status === 'cancelled') {
                                                            echo 'fa-solid fa-xmark';
                                                        } ?>"></i><span class="status" style="<?php
                                                                                                if ($status === 'pending') {
                                                                                                    echo 'color: #BFAB16';
                                                                                                } elseif ($status === 'completed') {
                                                                                                    echo 'color: #18AB2E;';
                                                                                                } elseif ($status === 'cancelled') {
                                                                                                    echo 'color: #E80E0E;';
                                                                                                } ?>"> <?php
                                                                                                        if ($status === 'pending') {
                                                                                                            echo 'CHỜ THANH TOÁN';
                                                                                                        } elseif ($status === 'completed') {
                                                                                                            echo 'HOÀN THÀNH';
                                                                                                        } elseif ($status === 'cancelled') {
                                                                                                            echo 'ĐÃ HUỶ';
                                                                                                        } ?>
                        </span></div>
                    <p style="margin-left: 150px;">Tổng tiền: <span style="color: red; font-weight: bold;"><?=$order['total_money']?>VNĐ</span></p>
                    <?php
                    if ($status === 'pending') {
                        echo '
                        <a href="thongTinDatTour.html" class="btngroup paytour-btn">Thanh toán</a>
                        <button id="cancel-button" class="btngroup cancelOrder-btn" data-id="'. $order['id']. '">Huỷ</button>
                        ';
                    } elseif ($status === 'completed') {
                        echo '
                        <button id="delete-button" data-id="' . $order['id'] . '" class="btngroup cancel-btn" style="background-color: red; color: white; border: none;">Xóa</button>
                        <a href="thongTinDatTour.html" class="btngroup rebook-btn">Đặt lại</a>
                        <button class="btngroup review-btn" data-user-id="'.$data['user']['id'].'" data-tour-id="'. $order['tour_id'] .'">Đánh giá</button>
                        ';
                    } elseif ($status === 'cancelled') {
                        echo '
                        <button id="delete-button" data-id="' . $order['tour_id'] . '" class="btngroup cancel-btn" style="background-color: red; color: white; border: none;">Xóa</button>
                        <a href="thongTinDatTour.html" class="btngroup rebook-btn">Đặt lại</a>';
                    } ?>
                </div>
            </div>
            <?php endforeach;
            } else {
                echo '<tr><td colspan="5">Không có đơn hàng nào.</td></tr>';
            }
            ?>
    </div>

    <!-- Popup xác nhận hủy tour -->
    <div id="popup-cancel" class="popup" style="display: none;">
        <div class="popup-content popup-cancel">
            <div class="popup-header">
                <h3>Thông báo</h3>
                <span id="close-btn-tour" class="close-btn">&times;</span>
            </div>
            <div class="popup-body">
                <div class="icon-warning" style="color: red; font-size: 30px;">
                    &#9888;
                </div>
                <p>Bạn có muốn hủy tour không?</p>
            </div>
            <div class="popup-footer">
                <div class="review-actions">
                    <button id="huy-tour" class="cancel-btn">Hủy</button>
                    <button id="confirm" class="cancel-btn" style="background-color: var(--bright-navy-blue); color: white;">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup thông báo hủy tour thành công -->
    <div id="canceltour" class="popup">
        <div class="popup-content canceltour">
            <div class="popup-header">
                <h3>Thông báo</h3>
            </div>
            <div class="popup-body">
                <div class="icon-success" style="color: white; font-size: 30px;">
                    &#10004;
                </div>
                <p>Đã hủy tour thành công!</p>
            </div>
        </div>
    </div>

    <!-- Xoá đơn tour -->
    <div id="popup-delete" class="popup" style="display: none;">
        <div class="popup-content popup-cancel">
            <div class="popup-header">
                <h3>Thông báo</h3>
                <span id="close-delbtn-tour" class="close-btn">&times;</span>
            </div>
            <div class="popup-body">
                <div class="icon-warning" style="color: red; font-size: 30px;">
                    &#9888;
                </div>
                <p>Bạn có chắc muốn xoá đơn tour không?</p>
            </div>
            <div class="popup-footer">
                <div class="review-actions">
                    <button id="huy-deltour" class="cancel-btn">Hủy</button>
                    <button id="confirmDel" class="cancel-btn" style="background-color: var(--bright-navy-blue); color: white;">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup thông báo xoá tour thành công -->
    <div id="deleteTour" class="popup" style="display:none">
        <div class="popup-content canceltour">
            <div class="popup-header">
                <h3>Thông báo</h3>
            </div>
            <div class="popup-body">
                <div class="icon-success" style="color: white; font-size: 30px;">
                    &#10004;
                </div>
                <p>Đã xoá đơn tour thành công!</p>
            </div>
        </div>
    </div>

    <!-- Modal đánh giá -->
    <div id="review-modal" class="review-container">
        <div class="review-modal">
            <button class="close-btn-review" id="close-btn-review">&times;</button>
            <div class="review-header">
                <h2>Đánh giá về trải nghiệm của quý khách</h2>
            </div>
            <div class="review-content">
                <div class="stars">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>
                <textarea placeholder="Chia sẻ trải nghiệm của bạn về chuyến đi..."></textarea>
                <div class="review-actions">
                    <button class="cancel-btn huy-review">Hủy</button>
                    <button class="submit-btn">Gửi</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Thông báo cảm ơn đánh giá -->
    <div id="popup-thankyou" class="popup" style="display: none">
        <div class="popup-content">
            <div class="popup-header">
                <h3>Thông báo</h3>
            </div>
            <div class="popup-body">
                <div class="icon-success">
                    &#10004;
                </div>
                <p>Cảm ơn đánh giá của bạn!</p>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    
    function loadOrders(event, status) {
        event.preventDefault();

        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('active_bill');
        });

        event.target.classList.add('active_bill');

        fetch(`/quan-ly-tour/auth/getOrders?status=${status}`)
            .then(response => {
                if (!response.ok) throw new Error('Không thể tải dữ liệu');
                return response.text();
            })
            .then(html => {
                document.getElementById('all-order').innerHTML = html;
            })
            .catch(error => {
                console.error('Lỗi:', error);
                document.getElementById('order-list').innerHTML = '<p>Đã xảy ra lỗi khi tải dữ liệu.</p>';
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
    // Tìm kiếm đơn hàng
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const orders = document.querySelectorAll('#all-order .order-card');

        orders.forEach(order => {
            const content = order.innerText.toLowerCase();
            if (content.includes(keyword)) {
                order.style.display = '';
            } else {
                order.style.display = 'none';
            }
        });
    });

    document.body.addEventListener('click', function (event) {
        // Hủy đơn hàng
        if (event.target && event.target.classList.contains('cancelOrder-btn')) {
            const tourId = event.target.getAttribute('data-id');
            const popup = document.getElementById('popup-cancel');
            popup.style.display = 'block';
            popup.setAttribute('data-tour-id', tourId);
        }

        if (event.target && event.target.id === 'close-btn-tour') {
            const popup = document.getElementById('popup-cancel');
            popup.style.display = 'none';
        }

        if (event.target && event.target.id === 'huy-tour') {
            const popup = document.getElementById('popup-cancel');
            popup.style.display = 'none';
        }

        if (event.target && event.target.id === 'confirm') {
            const popup = document.getElementById('popup-cancel');
            const tourId = popup.getAttribute('data-tour-id');

            fetch('/quan-ly-tour/auth/cancelOrder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: tourId,
                        status: 'cancelled'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        popup.style.display = 'none';
                        const cancelPopup = document.getElementById('canceltour');
                        cancelPopup.style.display = 'block';

                        setTimeout(() => {
                            cancelPopup.style.display = 'none';
                            location.reload();
                        }, 3000);
                    } else {
                        alert('Đã xảy ra lỗi khi cập nhật trạng thái tour.');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Không thể hủy tour. Vui lòng thử lại.');
                });
        }

        // Xóa đơn hàng
        if (event.target && event.target.id === 'delete-button') {
            const tourId = event.target.getAttribute('data-id');
            const popup = document.getElementById('popup-delete');
            popup.style.display = 'block';
            popup.setAttribute('datadel-tour-id', tourId);
        }

        if (event.target && event.target.id === 'close-delbtn-tour') {
            const popup = document.getElementById('popup-delete');
            popup.style.display = 'none';
        }

        if (event.target && event.target.id === 'huy-deltour') {
            const popup = document.getElementById('popup-delete');
            popup.style.display = 'none';
        }

        if (event.target && event.target.id === 'confirmDel') {
            const popup = document.getElementById('popup-delete');
            const tourId = popup.getAttribute('datadel-tour-id');

            fetch('/quan-ly-tour/auth/deleteOrder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: tourId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        popup.style.display = 'none';
                        const deletePopup = document.getElementById('deleteTour');
                        deletePopup.style.display = 'block';

                        setTimeout(() => {
                            deletePopup.style.display = 'none';
                            location.reload();
                        }, 3000);
                    } else {
                        alert('Đã xảy ra lỗi khi xoá đơn tour.');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Không thể xoá tour. Vui lòng thử lại.');
                });
        }

        // Đánh giá đơn hàng
        if (event.target && event.target.classList.contains('review-btn')) {
            const reviewModal = document.getElementById('review-modal');
            const tourId = event.target.getAttribute('data-tour-id'); 
            const userId = event.target.getAttribute('data-user-id'); 
            reviewModal.style.display = 'flex'; 
            reviewModal.setAttribute('data-tour-id', tourId);
            reviewModal.setAttribute('data-user-id', userId);
        }
    });

    const reviewModal = document.getElementById('review-modal');
    const reviewStars = document.querySelectorAll('.review-container .star');
    const reviewTextarea = document.querySelector('.review-container textarea');
    const reviewSubmitBtn = document.querySelector('.review-container .submit-btn');
    const reviewCancelBtn = document.querySelector('.review-container .cancel-btn');
    const reviewCloseBtn = document.querySelector('.review-container .close-btn-review');
    const reviewThankYouPopup = document.getElementById('popup-thankyou');
    let selectedRating = 0;

    reviewStars.forEach(star => {
        star.addEventListener('click', function () {
            selectedRating = parseInt(this.getAttribute('data-value'));
            reviewStars.forEach(s => {
                s.style.color = s.getAttribute('data-value') <= selectedRating ? 'gold' : '#ccc';
            });
        });
    });

    reviewSubmitBtn.addEventListener('click', function () {

        const tourId = reviewModal.getAttribute('data-tour-id');
        const userId = reviewModal.getAttribute('data-user-id');
        const note = reviewTextarea.value.trim();

        fetch('/quan-ly-tour/auth/rateOrder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                user_id: userId, 
                tour_id: tourId,
                rating: selectedRating,
                note: note
            })
        })
            .then(response => response.json())
            .then(data => {  
                if (data.success) {
                    reviewModal.style.display = 'none';
                    reviewThankYouPopup.style.display = 'flex';

                    setTimeout(() => {
                        reviewThankYouPopup.style.display = 'none';
                        location.reload(); 
                    }, 3000);

                    resetReviewModal();
                } else {
                    alert(data.message || 'Đã xảy ra lỗi khi gửi đánh giá.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Không thể gửi đánh giá. Vui lòng thử lại sau.');
            });
    });

    reviewCancelBtn.addEventListener('click', function () {
        reviewModal.style.display = 'none';
        resetReviewModal();
    });

    reviewCloseBtn.addEventListener('click', function () {
        reviewModal.style.display = 'none';
        resetReviewModal();
    });

    function resetReviewModal() {
        selectedRating = 0;
        reviewTextarea.value = '';
        reviewStars.forEach(star => {
            star.style.color = '#ccc';
        });
    }
});

</script>