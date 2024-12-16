document.addEventListener("DOMContentLoaded", () => {
    // Toàn bộ code của bạn ở đây
const pages = document.querySelectorAll(".page_DB");
const pageLinks = document.querySelectorAll(".page-link-DB");
const prevPage_DB = document.getElementById("prevpage_DB");
const nextPage_DB = document.getElementById("nextpage_DB");

// Khởi tạo trạng thái ban đầu
let currentPage = 1;


// Hàm hiển thị trang
function showPage_DB(pageNumber) {
    // Ẩn tất cả các trang
    pages.forEach((page, index) => {
        page.style.display = (index + 1 === pageNumber) ? "block" : "none";
    });

    // Cập nhật trạng thái active cho phân trang
    pageLinks.forEach(link => link.classList.remove("active"));
    pageLinks[pageNumber - 1].classList.add("active");

    // Cập nhật trạng thái nút prev và next
    prevPage_DB.style.pointerEvents = (pageNumber === 1) ? "none" : "auto";
    nextPage_DB.style.pointerEvents = (pageNumber === 2) ? "none" : "auto";
    prevPage_DB.classList.toggle("inactive", pageNumber === 1);
    nextPage_DB.classList.toggle("inactive", pageNumber === 2);
 
    // Lưu trạng thái trang hiện tại
    currentPage = pageNumber;
}

// Xử lý khi bấm vào các số trang
pageLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        showPage_DB(index + 1);
    });
});

// Xử lý khi bấm nút prev
prevPage_DB.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage > 1) {
        showPage_DB(currentPage - 1);
    }
});

// Xử lý khi bấm nút next
nextPage_DB.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage < 2) {
        showPage_DB(currentPage + 1);
    }
});



// Hiển thị trang đầu tiên
showPage_DB(1);
});