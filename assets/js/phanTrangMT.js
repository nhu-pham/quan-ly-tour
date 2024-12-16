document.addEventListener("DOMContentLoaded", () => {
    // Toàn bộ code của bạn ở đây
const pages = document.querySelectorAll(".page_MT");
const pageLinks = document.querySelectorAll(".page-link-MT");
const prevPage_MT = document.getElementById("prevpage_MT");
const nextPage_MT = document.getElementById("nextpage_MT");

let currentPage_MT = 1;

// Hàm hiển thị trang
function showPage_MT(pageNumber) {
    // Ẩn tất cả các trang
    pages.forEach((page, index) => {
        page.style.display = (index + 1 === pageNumber) ? "block" : "none";
    });

    // Cập nhật trạng thái active cho phân trang
    pageLinks.forEach(link => link.classList.remove("active"));
    pageLinks[pageNumber - 1].classList.add("active");

    // Cập nhật trạng thái nút prev và next
    prevPage_MT.style.pointerEvents = (pageNumber === 1) ? "none" : "auto";
    nextPage_MT.style.pointerEvents = (pageNumber === 2) ? "none" : "auto";
    prevPage_MT.classList.toggle("inactive", pageNumber === 1);
    nextPage_MT.classList.toggle("inactive", pageNumber === 2);

    currentPage_MT = pageNumber;
}

pageLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        showPage_MT(index + 1);
    });
});
prevPage_MT.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage_MT > 1) {
        showPage_MT(currentPage_MT - 1);
    }
});

nextPage_MT.addEventListener("click", (e) => {
    e.preventDefault();
    if (currentPage_MT < 2) {
        showPage_MT(currentPage_MT + 1);
    }
});

showPage_MT(1);
});