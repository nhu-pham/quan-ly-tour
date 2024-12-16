document.addEventListener("DOMContentLoaded", () => {
    // Toàn bộ code của bạn ở đây
const pages = document.querySelectorAll(".slider-popular");
const prevPage_NB = document.getElementById("prevButton");
const nextPage_NB = document.getElementById("nextButton");

// Khởi tạo trạng thái ban đầu
let currentPage = 1;


// Hàm hiển thị trang
function showPage_NB(pageNumber) {
    // Ẩn tất cả các trang
    pages.forEach((page, index) => {
        page.style.display = (index + 1 === pageNumber) ? "block" : "none";
        if (index + 1 === pageNumber) {
            page.classList.add("active-p"); // Hiển thị trang hiện tại
        } else {
            page.classList.remove("active-p"); // Ẩn các trang khác
        }
    });

    // Cập nhật trạng thái nút prev và next
    prevPage_NB.style.pointerEvents = (pageNumber === 1) ? "none" : "auto";
    nextPage_NB.style.pointerEvents = (pageNumber === 2) ? "none" : "auto";
    prevPage_NB.classList.toggle("inactive", pageNumber === 1);
    nextPage_NB.classList.toggle("inactive", pageNumber === 2);
 
    // Lưu trạng thái trang hiện tại
    currentPage = pageNumber;
}

// Xử lý khi bấm nút prev
prevPage_NB.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage > 1) {
        showPage_NB(currentPage - 1);
    }
});

// Xử lý khi bấm nút next
nextPage_NB.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage < 2) {
        showPage_NB(currentPage + 1);
    }
});



// Hiển thị trang đầu tiên
showPage_NB(1);
});