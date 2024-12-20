document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav-link");

  // Lấy đường dẫn hiện tại của trang
  const currentPath = window.location.pathname;

  // Gán class active dựa trên URL hiện tại
  navLinks.forEach((link) => {
    if (link.getAttribute("href") === currentPath) {
      link.classList.add("active");
    }
  });

  // Thêm sự kiện click để gỡ bỏ class active khỏi các mục khác (không cần thiết nếu trang tải lại)
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      navLinks.forEach((nav) => nav.classList.remove("active"));
      this.classList.add("active");
    });
  });
});
