<?php
require_once ('./mvc/views/user/include/header.php')
?>
<main>
    <article>
        <!-- Trang Tour Miền Bắc -->
        <section id="tourModel">
            <section class="page-tour" id="home">
                <section class="content">
                    <h1>Khám phá thế giới, chỉ một cú click
                        Đặt tour, mở ra hành trình!</h1>
                </section>
            </section>

            <div class="specialtour-container">
                <section class="special-tours">
                    <h2>Gói tour đặc biệt</h2>
                    <div class="slider-popular-ds">
                        <?php if(isset($tours_db) && $tours_db!=NULL){ ?>
                        <?php foreach($tours_db as $value){?>
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                </a>
                                <div class="price-tag"><?=number_format($value['price'])?> VNĐ</div>
                                <div class="desc">
                                    <div id="province"><?=$value['destination']?></div>
                                    <div id="dest"><?=$value['name']?></div>
                                    <div id="price"><i class="fa fa-dollar"></i>Bao gồm chi phí dịch vụ, ăn uống,
                                        khách sạn,...</div>
                                    <div id="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                    </div>
                                    <a target="" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                        <button class="xem-chi-tiet-btn">Xem chi tiết</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php }?>
                    </div>
                </section>
                <a href="/quan-ly-tour/destination/index/4" class="view-more">Xem thêm</a>
            </div>
            <div class="specialtour-container">
                <section class="special-tours">
                    <h2>Tour miền bắc</h2>
                    <div class="slider-popular-ds">
                        <?php if(isset($tours_mb) && $tours_mb!=NULL){ ?>
                        <?php foreach($tours_mb as $value){?>
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                </a>
                                <div class="desc">
                                    <div id="province"><?=$value['destination']?></div>
                                    <div id="dest"><?=$value['name']?></div>
                                    <div id="price"><i class="fa fa-dollar"></i><?=number_format($value['price'])?>
                                        VNĐ</div>
                                    <div id="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                    </div>
                                    <a target="" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                        <button class="xem-chi-tiet-btn">Xem chi tiết</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php }?>
                    </div>
                </section>
                <a href="/quan-ly-tour/destination/index/2" class="view-more">Xem thêm</a>
            </div>
            <div class="specialtour-container">
                <section class="special-tours">
                    <h2>Tour miền trung</h2>
                    <div class="slider-popular-ds">
                        <?php if(isset($tours_mt) && $tours_mt!=NULL){ ?>
                        <?php foreach($tours_mt as $value){?>
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                </a>
                                <div class="desc">
                                    <div id="province"><?=$value['destination']?></div>
                                    <div id="dest"><?=$value['name']?></div>
                                    <div id="price"><i class="fa fa-dollar"></i><?=number_format($value['price'])?>
                                        VNĐ</div>
                                    <div id="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                    </div>
                                    <a target="" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                        <button class="xem-chi-tiet-btn">Xem chi tiết</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php }?>
                    </div>
                </section>
                <a href="/quan-ly-tour/destination/index/3" class="view-more">Xem thêm</a>
            </div>
            <div class="specialtour-container">
                <section class="special-tours">
                    <h2>Tour miền nam</h2>
                    <div class="slider-popular-ds">
                        <?php if(isset($tours_mn) && $tours_mn!=NULL){ ?>
                        <?php foreach($tours_mn as $value){?>
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank" href="/quan-ly-tour/<?=$value['thumbnail']?>">
                                    <img src="/quan-ly-tour/<?=$value['thumbnail']?>">
                                </a>
                                <div class="desc">
                                    <div id="province"><?=$value['destination']?></div>
                                    <div id="dest"><?=$value['name']?></div>
                                    <div id="price"><i class="fa fa-dollar"></i><?=number_format($value['price'])?>
                                        VNĐ
                                    </div>
                                    <div id="date"><i class="fa-solid fa-calendar-days"></i><?=$value['duration']?>
                                    </div>
                                    <a target="" href="/quan-ly-tour/product/detail/<?=$value['slug']?>">
                                        <button class="xem-chi-tiet-btn">Xem chi tiết</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php }?>
                    </div>
                </section>
                <a href="/quan-ly-tour/destination/index/1" class="view-more">Xem thêm</a>
            </div>
        </section>
    </article>
</main>