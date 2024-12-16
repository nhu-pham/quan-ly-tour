document.addEventListener("DOMContentLoaded", () => {
    // Toàn bộ code của bạn ở đây
const pages = document.querySelectorAll(".page_MN");
const pageLinks = document.querySelectorAll(".page-link-MN");
const prevPage_MN = document.getElementById("prevpage_MN");
const nextPage_MN = document.getElementById("nextpage_MN");

let currentPage_MN = 1;
function showPage_MN(pageNumber) {
    // Ẩn tất cả các trang
    pages.forEach((page, index) => {
        page.style.display = (index + 1 === pageNumber) ? "block" : "none";
    });

    // Cập nhật trạng thái active cho phân trang
    pageLinks.forEach(link => link.classList.remove("active"));
    pageLinks[pageNumber - 1].classList.add("active");

    prevPage_MN.style.pointerEvents = (pageNumber === 1) ? "none" : "auto";
    nextPage_MN.style.pointerEvents = (pageNumber === 2) ? "none" : "auto";
    prevPage_MN.classList.toggle("inactive", pageNumber === 1);
    nextPage_MN.classList.toggle("inactive", pageNumber === 2);
    // Lưu trạng thái trang hiện tại
    currentPage_MN = pageNumber;
}
pageLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        showPage_MN(index + 1);
    });
});

prevPage_MN.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage_MN > 1) {
        showPage_MN(currentPage_MN - 1);
    }
});

nextPage_MN.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage_MN < 2) {
        showPage_MN(currentPage_MN + 1);
    }
});

// Hiển thị trang đầu tiên
showPage_MN(1);
});