<?php 
require_once ('./mvc/views/user/include/header.php')
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<main>
    <article>
        <!-- Trang Tour Miền Trung-->
        <section id="mienTrungModal">
            <section class="page-Central" id="home">
                <section class="content">

                    <h1><?=$tour[0]['cate_name']?></h1>
                    <p><?=$tour[0]['des']?></p>
                </section>
            </section>

            <div class="dstour">

                <div class="filter">
                    <h2>Bộ lọc tìm kiếm</h2>
                    <hr style="width: 100%; border-top: 1px solid white; margin-bottom: 10px;">
                    <form>
                        <label for="budget">Ngân sách</label>
                        <div class="budget-options">
                            <button type="button" class="budget-btn" data-value="under5">Dưới 5 triệu</button>
                            <button type="button" class="budget-btn" data-value="5to10">Từ 5 - 10 triệu</button>
                            <button type="button" class="budget-btn" data-value="10to20">Từ 10 - 20 triệu</button>
                            <button type="button" class="budget-btn" data-value="over20">Trên 20 triệu</button>
                        </div>

                        <label for="departure">Điểm khởi hành</label>
                        <input type="text" id="departure" placeholder="Nhập điểm khởi hành">

                        <label for="destination">Địa điểm</label>
                        <input type="text" id="destination" placeholder="Nhập địa điểm">

                        <div class="date-group">
                            <label for="date">Ngày đi</label>
                            <input type="date" id="date">
                        </div>

                        <button type="submit" class="filter-btn">Lọc</button>
                    </form>
                </div>

                <!-- Kết quả tìm kiếm -->
                <div class="search-results page_MT">
                    <div class="page-header">
                        <label for="">Chúng tôi tìm thấy</label>
                        <p type="text" id="number-tour" style="width: 40px; text-align: center; "><?=$data['row']?></p>
                        <label for="">cho
                            quý khách</label>
                        <div><label for="" style="margin-right: 10px; margin-left: 100px; ">Sắp xếp theo:</label>
                            <select id="combobox-sapxep">
                                <option value="option1">Tất cả</option>
                                <option value="option2">Giá từ cao đến thấp</option>
                                <option value="option3">Giá từ thấp đến cao</option>
                            </select>
                        </div>
                    </div>
                    <hr style="margin-top: 10px; margin-bottom: 20px;">
                    <div id="loadData">
                        <?php $cate_id=$tour[0]['category_id'];
                        print_r($cate_id);
                        require_once "./mvc/views/destination/loadData.php" ?>
                    </div>
                </div>
            </div>
        </section>