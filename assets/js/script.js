// 'use strict';

// // navbar toggle 
// const overlay = document.querySelector("[data-overlay]")
// const navOpenBtn = document.querySelector("[ data-nav-open-btn]")
// const navbar = document.querySelector("[data-navbar]")
// const navCloseBtn = document.querySelector("[data-nav-close-btn]")
// const navLinks = document.querySelectorAll("[data-nav-link]")

// const navElemArr = [navOpenBtn, navCloseBtn, overlay];

// const navToggleEvent = function(elem) {
//     for(let i = 0; i < elem.length; i++) {
//         elem[i].addEventListener("click", function() {
//             navbar.classList.toggle("active");
//             overlay.classList.toggle("active");
//         });
//     }
// }

// navToggleEvent(navElemArr);
// navToggleEvent(navLinks);


// // header sticky 
// const header = document.querySelector("[data-header]");
// const goTopBtn = document.querySelector("[data-go-top]");

// window.addEventListener("scroll", function() {
//     if(this.window.scrollY >= 200) {
//         header.classList.add("active");
//         goTopBtn.classList.add("active");
//     } else {
//         header.classList.remove("active");
//         goTopBtn.classList.remove("active");
//     }
// });

document.addEventListener("DOMContentLoaded", function() {

    //CHUYỂN ĐỔI GIỮA CÁC SECTION//
    const header = document.querySelector("header"); // Lấy phần tử header
    let originalHeaderColor = getComputedStyle(header).backgroundColor; // Lấy màu gốc của header  
    let isLienHeVisible = false; // Biến cờ kiểm tra nếu đang ở trong "Chi tiết tour"
    let isThongTinVisible = false; 
    let isChiTietVisible = false;
    let isChiTietDTVisible = false;
    let isThanhToanVisible = false;


    // Function to scroll smoothly to a section
    function scrollToSection(id) {
        const section = document.querySelector(id);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Trang chủ
    const homeLink = document.querySelector('[href="#home"]');
    homeLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        scrollToSection('#home'); // Scroll to the home section
    });

    // Điểm đến
    //const destinationLink = document.querySelector('[href="#destination"]');


    // Tour
    //const tourLink = document.querySelector('[href="#package"]');


    // Đánh giá
    //const reviewLink = document.querySelector('[href="#review"]');

    
    // Liên hệ
    const contactLink = document.querySelector('[href="#contact"]');


    ////////////////////////////////////////////////////////////////////////////

    const aboutusLink = document.querySelector('[href="#aboutus"]');
    const trangChuSection = document.getElementById("trangchu");
    const aboutSection = document.getElementById("about");

    const userProfile = document.getElementById('user-profile'); // Phần user profile
    const loginButton = document.getElementById('login-btn'); // Modal đăng nhập

    const mienBacLink = document.querySelector('[href="#mienbac"]');
    const mienBacSection = document.getElementById('mienBacModal');


    const mienTrungLink = document.querySelector('[href="#mientrung"]');
    const mienTrungSection = document.getElementById('mienTrungModal');


    const mienNamLink = document.querySelector('[href="#miennam"]');
    const mienNamSection = document.getElementById('mienNamModal');


    const chitietSection = document.getElementById('chitiet-tour');
    const xemchitiet = document.querySelector('.detail-btn');


    const chitietdtSection = document.getElementById('chitiet-dattour');
    const datTourButton = document.getElementById('bt');

    const dichVuSection = document.getElementById('dichVu');
    const dichVuKhac = document.querySelector('.dv');

    const thanhToanSection = document.getElementById('thanhtoanTour');
    const tratien = document.querySelector('.pay');

    const qlThongTin = document.querySelector('[href="#qlThongTin"]');
    const qlThongTinSection = document.getElementById('account-information');

    const loginModal = document.getElementById('login-modal');
    const openLoginBtn = document.getElementById('btn-dn');
    const closeLoginBtn = document.querySelector('.close-btn');
    const headerSection = document.getElementById("header");

    const lienLacSection = document.getElementById('contact-container');

    const tabThongTin = document.querySelector('[href="#tabTT"]');
    const tabMK = document.querySelector('[href="#tabMK"]');
    const tabDM = document.querySelector('[href="#tabDM"]');
    const tabKM = document.querySelector('[href="#tabKM"]');
        const tabDM_wait = document.querySelector('[href="#wait"]');
        const tabDM_all = document.querySelector('[href="#all"]');
        const tabDM_finish = document.querySelector('[href="#finish"]');
        const tabDM_cancel = document.querySelector('[href="#cancel"]');
    const thongTinTKSection = document.getElementById("thongTinTK");
    const doiMKSection = document.getElementById("doiMK");
    const donMuaSection = document.getElementById("donMua");
        const allOrderSection = document.getElementById("all-order");
        const waitPaySection = document.getElementById("waitforpay");
        const finishSection = document.getElementById("finish-order");
        const cancelSection = document.getElementById("cancel-order");
    const khuyenMaiSection = document.getElementById("khuyenMai");

    const sections = [
        trangChuSection,
        dichVuSection,
        thanhToanSection,
        chitietdtSection,
        mienBacSection,
        mienTrungSection,
        mienNamSection,
        aboutSection,
        chitietSection,
        loginModal,
        qlThongTinSection,
        lienLacSection

    ];

    function resetVisibility() {
        isChiTietDTVisible = false;
        isThanhToanVisible = false;
        isThongTinVisible = false;
        isLienHeVisible = false;
        isChiTietVisible = false;
    }

    function showSection(activeSection) {
        // Ẩn tất cả các sections
        sections.forEach(section => {
            section.style.display = 'none';
        });
    
        // Hiển thị section được chọn
        activeSection.style.display = 'block';
    }
    // SECTION GIỚI THIỆU//

    aboutusLink.addEventListener("click", function (){
        showSection(aboutSection);
        resetVisibility();
    });
    homeLink.addEventListener("click", function (){
        showSection(trangChuSection);
        resetVisibility();
    });
    
    //MỞ ĐĂNG NHẬP//


    openLoginBtn.addEventListener('click', function() {
        
        //trangChuSection.style.display = "none";
        sections.forEach(section => {
            section.style.display = 'none';
        });
        loginModal.style.display = 'flex'; // Hiển thị modal
        headerSection.style.display = "none";
    });

    // Khi nhấn nút đóng form đăng nhập
    closeLoginBtn.addEventListener('click', function() {
        loginModal.style.display = 'none'; // Ẩn modal
        trangChuSection.style.display = "block";
        headerSection.style.display = "flex";
    });

    // Khi nhấn ra ngoài modal thì đóng modal
    window.addEventListener('click', function(event) {
        if (event.target === loginModal) {
            loginModal.style.display = 'none';
            trangChuSection.style.display = "block";
            headerSection.style.display = "flex";
        }
    });


    //Tài khoản người dùng
    const userNameButton = document.getElementById('user-name');
    const userOptions = document.querySelector('.user-options');

    userNameButton.addEventListener('click', function() {
        if (userOptions.style.display === "block") {
            userOptions.style.display = "none";
        } else {
            userOptions.style.display = "block";
        }
    });


    //LIÊN LẠC//

    contactLink.addEventListener("click", function (){
        showSection(lienLacSection);
        isLienHeVisible = true;
    });


    //ĐĂNG NHẬP//
    
    loginButton.addEventListener('click', function() {
        headerSection.style.display = 'flex';
        openLoginBtn.style.display = 'none';
        loginModal.style.display = 'none';
        userProfile.style.display = 'block';
        trangChuSection.style.display = 'block';
        header.style.backgroundColor = originalHeaderColor;
    });


    //ĐĂNG KÝ//
    const closeSignupBtn = document.getElementById("close-register-modal");
    const signupButton = document.querySelector('[href="#dangky"]');// Modal đăng nhập
    const signupModal = document.getElementById('dang-ky');
        // Bắt sự kiện click vào nút "Đăng nhập"
    signupButton.addEventListener('click', function() {
        signupModal.style.display = 'flex';
        loginModal.style.display = 'none';

    });

    closeSignupBtn.addEventListener('click', function() {
        loginModal.style.display = 'flex'; // Ẩn modal
        signupModal.style.display = 'none';
    });



    //SECTION MIỀN BẮC//
    
    mienBacLink.addEventListener("click", function (){
        showSection(mienBacSection);
        resetVisibility();
    });

    //SECTION MIỀN TRUNG//
    
    mienTrungLink.addEventListener("click", function (){
        showSection(mienTrungSection);
        resetVisibility();
    });
    //SECTION MIỀN NAM//
    
    mienNamLink.addEventListener("click", function (){
        showSection(mienNamSection);
        resetVisibility();
    });



    //QUÊN MẬT KHẨU
    const forgetPassLink = document.querySelector('[href="#forget-pass"]');
    const forgetSection = document.getElementById('forget-model');
    const confirmSection = document.getElementById('confirm-modal');
    const newpassSection = document.getElementById('newpass-modal');
    const notificationSection = document.getElementById('notification-modal');
    const next1Button = document.getElementById('next1');
    const next2Button = document.getElementById('next2');
    const changepassSection = document.getElementById('change-pass');
    const contentnewpassSection = document.getElementById('newpass-content');

    forgetPassLink.addEventListener('click', function() {
        forgetSection.style.display = 'flex';
        loginModal.style.display = 'none';
    });
    next1Button.addEventListener('click', function() {
        forgetSection.style.display = 'none';
        confirmSection.style.display = 'flex';
    });
    next2Button.addEventListener('click', function() {
        confirmSection.style.display = 'none';
        newpassSection.style.display = 'flex';
    });
    changepassSection.addEventListener('click', function() {
        notificationSection.style.display = 'flex';
        contentnewpassSection.style.display = 'none';
    });



    //CHI TIẾT TOUR//
    
    xemchitiet.addEventListener('click', function() {
        showSection(chitietSection);
        isChiTietVisible = true;
    });




    //CHI TIẾT ĐẶT TOUR//
    
    datTourButton.addEventListener('click', function() {
        showSection(chitietdtSection);
        isChiTietDTVisible = true;
        header.style.backgroundColor = 'hsla(193.073, 85%, 41%, 0.8)';
    });



    //THANH TOÁN//
    
    tratien.addEventListener('click', function() {
        showSection(thanhToanSection);
        isThanhToanVisible = true;
    });
    //Tiếp tục đặt tour
    const ttdat = document.querySelector('.cont');
    const dvbutton = document.querySelector('.dichvu-btn');
    ttdat.addEventListener('click', function() {
        chitietdtSection.style.display ='block';
        dichVuSection.style.display = 'none';
        dvbutton.style.display = 'none';
    });




    //HEADER DỊCH VỤ/THANH TOÁN/THÔNG TIN TOUR
    const mienBac = document.querySelector('[href="#mienbac"]');
    const caobang_langson = document.querySelector('[href="#caobang-langson"]');
    const dat_tour = document.querySelector('[href="#dattour"]');
    const thanhToan = document.querySelector('[href="#thanhtoan"]');
    const dichVu = document.querySelector('[href="#dichvu"]');


    function changeSectionHeader(selectedLink, selectedSection) {

        mienBac.innerHTML = mienBac.innerHTML.replace('<strong>', '').replace('</strong>', '');
        caobang_langson.innerHTML = caobang_langson.innerHTML.replace('<strong>', '').replace('</strong>', '');
        dat_tour.innerHTML = dat_tour.innerHTML.replace('<strong>', '').replace('</strong>', '');
        thanhToan.innerHTML = thanhToan.innerHTML.replace('<strong>', '').replace('</strong>', '');
        dichVu.innerHTML = dichVu.innerHTML.replace('<strong>', '').replace('</strong>', '');
        // Thêm độ đậm cho link được chọn
        selectedLink.innerHTML = `<strong>${selectedLink.textContent}</strong>`;
    
        mienBacSection.style.display = 'none';
        chitietSection.style.display = 'none';
        chitietdtSection.style.display = 'none';
        dichVuSection.style.display = 'none';
        thanhToanSection.style.display = 'none';
    
        // Hiển thị danh sách sản phẩm được chọn
        selectedSection.style.display = 'block';
    }
    mienBac.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chuyển hướng trang
        changeSectionHeader(mienBac, mienBacSection);
    });
    caobang_langson.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chuyển hướng trang
        changeSectionHeader(caobang_langson, chitietSection);
    });
    dat_tour.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chuyển hướng trang
        changeSectionHeader(dat_tour, chitietdtSection);
    });
    dichVu.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chuyển hướng trang
        changeSectionHeader(dichVu, dichVuSection);
    });
    thanhToan.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chuyển hướng trang
        changeSectionHeader(thanhToan, thanhToanSection);
    });
    
    


    //THUÊ DỊCH VỤ//
    
    dichVuKhac.addEventListener('click', function() {
        
        dvbutton.style.display = 'block';
        showSection(dichVuSection);
        isDichVuVisible = true;
       
    });


    // QUẢN LÝ THÔNG TIN CÁ NHÂN

    qlThongTin.addEventListener('click', function() {
        showSection(qlThongTinSection);
        isThongTinVisible = true;
    });

    tabThongTin.addEventListener('click', function(){
        tabThongTin.classList.add('active'); // Thêm class "active" cho tab được chọn
        tabMK.classList.remove('active'); 
        tabDM.classList.remove('active');
        tabKM.classList.remove('active');
        thongTinTKSection.style.display = 'block';
        doiMKSection.style.display = 'none';
        donMuaSection.style.display = 'none';
        khuyenMaiSection.style.display = 'none';
    })
    tabMK.addEventListener('click', function(){
        tabMK.classList.add('active'); // Thêm class "active" cho tab được chọn
        tabThongTin.classList.remove('active'); 
        tabDM.classList.remove('active');
        tabKM.classList.remove('active');
        doiMKSection.style.display = 'block';
        thongTinTKSection.style.display = 'none';
        donMuaSection.style.display = 'none';
        khuyenMaiSection.style.display = 'none';
    })
    tabDM.addEventListener('click', function(){
        tabDM.classList.add('active'); // Thêm class "active" cho tab được chọn
        tabThongTin.classList.remove('active'); 
        tabMK.classList.remove('active');
        tabKM.classList.remove('active');
        donMuaSection.style.display = 'block';
        doiMKSection.style.display = 'none';
        thongTinTKSection.style.display = 'none';
        khuyenMaiSection.style.display = 'none';
    })
    tabKM.addEventListener('click', function(){
        tabKM.classList.add('active');
        tabDM.classList.remove('active'); // Thêm class "active" cho tab được chọn
        tabThongTin.classList.remove('active'); 
        tabMK.classList.remove('active');
        khuyenMaiSection.style.display = 'block';
        donMuaSection.style.display = 'none';
        doiMKSection.style.display = 'none';
        thongTinTKSection.style.display = 'none';
    })
    const tabs = [tabDM_all, tabDM_wait, tabDM_finish, tabDM_cancel];
    const tabsections = [allOrderSection, waitPaySection, finishSection, cancelSection];
        
    function activateTab(index) {
        tabs.forEach((tab, i) => {
            if (i === index) {
                tab.classList.add('active');
                tabsections[i].style.display = 'block';
            } else {
                tab.classList.remove('active');
                tabsections[i].style.display = 'none';
            }
        });
    }
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => activateTab(index));
    });

    // DANH SÁCH CÁC SẢN PHẨM THUÊ
    const xemayLink = document.querySelector('[href="#xemay"]');
    const otoLink = document.querySelector('[href="#oto"]');
    const camtraiLink = document.querySelector('[href="#camtrai"]');
    const xemayList = document.getElementById('xemay');
    const otoList = document.getElementById('oto');
    const camtraiList = document.getElementById('camtrai');
    
    function changeCategory(selectedLink, selectedList) {
        // Xóa độ đậm của tất cả các link
        xemayLink.innerHTML = xemayLink.innerHTML.replace('<strong>', '').replace('</strong>', '');
        otoLink.innerHTML = otoLink.innerHTML.replace('<strong>', '').replace('</strong>', '');
        camtraiLink.innerHTML = camtraiLink.innerHTML.replace('<strong>', '').replace('</strong>', '');
    
        // Thêm độ đậm cho link được chọn
        selectedLink.innerHTML = `<strong>${selectedLink.textContent}</strong>`;
    
        // Ẩn tất cả danh sách sản phẩm
        xemayList.style.display = 'none';
        otoList.style.display = 'none';
        camtraiList.style.display = 'none';
    
        // Hiển thị danh sách sản phẩm được chọn
        selectedList.style.display = 'grid';
    }
    
    // Thêm sự kiện click cho từng liên kết
    xemayLink.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chuyển hướng trang
        changeCategory(xemayLink, xemayList);
    });
    
    otoLink.addEventListener('click', function(event) {
        event.preventDefault();
        changeCategory(otoLink, otoList);
    });
    
    camtraiLink.addEventListener('click', function(event) {
        event.preventDefault();
        changeCategory(camtraiLink, camtraiList);
    });

    //Thêm/giảm số lượng sản phẩm
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('.quantity-input'); 
            let value = parseInt(input.value); 
    
            if (this.textContent === '+') {
                value++; 
            } else if (this.textContent === '-' && value > 0) {
                value--; 
            }
    
            input.value = value; 
        });
    });
    //Thêm vào giỏ hàng
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Tìm phần tử input trong cùng product-card
            const input = this.parentNode.querySelector('.quantity-input');
            
            // Lấy giá trị của input
            const quantityValue = parseInt(input.value);
            // Lấy giá trị hiện tại của quantity ở biểu tượng giỏ hàng và chuyển thành số nguyên
            const currentQuantity = parseInt(document.getElementById('quantity').textContent);

            // Cộng giá trị mới vào giá trị hiện tại
            const newQuantity = currentQuantity + quantityValue;
    
            // Cập nhật giá trị quantity bên cạnh biểu tượng giỏ hàng
            document.getElementById('quantity').textContent = newQuantity;
        });
    });

    window.addEventListener("scroll", function() {
        if (window.scrollY > 100) {
            header.classList.add("sticky"); // Thêm lớp "sticky" khi cuộn
            header.style.backgroundColor = 'hsla(193.073, 85%, 41%, 0.8)';
        } else {
            header.style.backgroundColor = originalHeaderColor;
            header.classList.remove("sticky"); // Gỡ bỏ lớp "sticky" khi trở lại trên đầu trang
        }
        if (isChiTietDTVisible||isThanhToanVisible||isThongTinVisible||isLienHeVisible||isChiTietVisible)
        {
            header.style.backgroundColor = 'hsla(193.073, 85%, 41%, 0.8)';
        }
    });
     

    //PHÂN TRANG
    /*const pages = [
        { link: document.querySelector('[href="#1"]'), content: document.getElementById('page1') },
        { link: document.querySelector('[href="#2"]'), content: document.getElementById('page2') },
        { link: document.querySelector('[href="#3"]'), content: document.getElementById('page3') },
        { link: document.querySelector('[href="#4"]'), content: document.getElementById('page4') },
        { link: document.querySelector('[href="#5"]'), content: document.getElementById('page5') }
    ];
    
    // Lặp qua từng trang và gán sự kiện
    pages.forEach((page, index) => {
        page.link.addEventListener('click', function() {
            // Ẩn tất cả các trang và xóa lớp 'activate' khỏi tất cả các liên kết
            pages.forEach(p => {
                p.content.style.display = 'none';
                p.link.classList.remove('activate');
            });
    
            // Hiển thị trang được chọn và thêm lớp 'activate' cho liên kết tương ứng
            page.content.style.display = 'block';
            page.link.classList.add('activate');
        });
    });
    const p1 = document.querySelector('[href="#1"]');
    const p2 = document.querySelector('[href="#2"]');
    const page1 = document.getElementById('page1');
    const page2 = document.getElementById('page2');
    const page3 = document.getElementById('page3');
    const page4 = document.getElementById('page4');
    const page5 = document.getElementById('page5');

    p1.addEventListener('click', function() {
        page1.style.display = 'block';
        page2.style.display = 'none';
        page3.style.display = 'none';
        page4.style.display = 'none';
        page5.style.display = 'none';
    
        // Thêm và loại bỏ lớp active
        p1.classList.add('activate');
        p2.classList.remove('activate');
        p3.classList.remove('activate');
        p4.classList.remove('activate');
        p5.classList.remove('activate');

    });
    
    p2.addEventListener('click', function() {
        page2.style.display = 'block';
        page1.style.display = 'none';
        page3.style.display = 'none';
        page4.style.display = 'none'
        page5.style.display = 'none';
    
        // Thêm và loại bỏ lớp active
        p2.classList.add('activate');
        p1.classList.remove('activate');
        p3.classList.remove('activate');
        p4.classList.remove('activate');
        p5.classList.remove('activate');

    });
    p3.addEventListener('click', function() {
        page3.style.display = 'block';
        page1.style.display = 'none';
        page2.style.display = 'none';
        page4.style.display = 'none';
        page5.style.display = 'none';
    
        // Thêm và loại bỏ lớp active
        p3.classList.add('activate');
        p1.classList.remove('activate');
        p2.classList.remove('activate');
        p4.classList.remove('activate');
        p5.classList.remove('activate');
    });
    
    p4.addEventListener('click', function() {
        page4.style.display = 'block';
        page1.style.display = 'none';
        page2.style.display = 'none';
        page3.style.display = 'none';
        page5.style.display = 'none';

    
        // Thêm và loại bỏ lớp active
        p4.classList.add('activate');
        p1.classList.remove('activate');
        p2.classList.remove('activate');
        p3.classList.remove('activate');
        p5.classList.remove('activate');
    });
    p5.addEventListener('click', function() {
        page5.style.display = 'block';
        page1.style.display = 'none';
        page2.style.display = 'none';
        page3.style.display = 'none';
        page4.style.display = 'none';

    
        // Thêm và loại bỏ lớp active
        p5.classList.add('activate');
        p1.classList.remove('activate');
        p2.classList.remove('activate');
        p3.classList.remove('activate');
        p4.classList.remove('activate');
    });*/

    /*SLIDER-POPULAR
    const slider1 = document.querySelector('.slider1');
    const slider2 = document.querySelector('.slider2');
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');

    // Bắt sự kiện click cho nút Next
    nextButton.addEventListener('click', () => {
        slider1.classList.remove('active-p');
        slider2.classList.add('active-p');
    });

    // Bắt sự kiện click cho nút Prev
    prevButton.addEventListener('click', () => {
        slider2.classList.remove('active-p');
        slider1.classList.add('active-p');
    });*/
});
    /*SLIDER*/
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("Slide");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) 
    {
            slideIndex = 1
    }    
    if (n < 1) 
    {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) 
    {
        slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) 
    {
        dots[i].className = dots[i].className.replace("active-slide", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active-slide";
    }

    
