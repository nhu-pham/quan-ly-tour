document.addEventListener("DOMContentLoaded", () => {
    // Toàn bộ code của bạn ở đây
const pages = document.querySelectorAll(".page_MB");
const pageLinks = document.querySelectorAll(".page-link-MB");
const prevPage_MB = document.getElementById("prevpage_MB");
const nextPage_MB = document.getElementById("nextpage_MB");

// Khởi tạo trạng thái ban đầu
let currentPage = 1;


// Hàm hiển thị trang
function showPage_MB(pageNumber) {
    // Ẩn tất cả các trang
    pages.forEach((page, index) => {
        page.style.display = (index + 1 === pageNumber) ? "block" : "none";
    });

    // Cập nhật trạng thái active cho phân trang
    pageLinks.forEach(link => link.classList.remove("active"));
    pageLinks[pageNumber - 1].classList.add("active");

    // Cập nhật trạng thái nút prev và next
    prevPage_MB.style.pointerEvents = (pageNumber === 1) ? "none" : "auto";
    nextPage_MB.style.pointerEvents = (pageNumber === 2) ? "none" : "auto";
    prevPage_MB.classList.toggle("inactive", pageNumber === 1);
    nextPage_MB.classList.toggle("inactive", pageNumber === 2);
 
    // Lưu trạng thái trang hiện tại
    currentPage = pageNumber;
}

// Xử lý khi bấm vào các số trang
pageLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        showPage_MB(index + 1);
    });
});

// Xử lý khi bấm nút prev
prevPage_MB.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage > 1) {
        showPage_MB(currentPage - 1);
    }
});

// Xử lý khi bấm nút next
nextPage_MB.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage <2) {
        showPage_MB(currentPage + 1);
    }
});



// Hiển thị trang đầu tiên
showPage_MB(1);
});