document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu a");
    const contentDiv = document.getElementById("content");

    // Lấy đường dẫn hiện tại của URL
    const currentPath = window.location.pathname;

    // Lặp qua tất cả các menu item và so sánh href với currentPath
    menuItems.forEach(function (item) {
        // Nếu href của menu item khớp với URL hiện tại, thêm class active_tt vào item đó
        if (currentPath.includes(item.getAttribute("href"))) {
            item.classList.add("active_tt");

            // Tải nội dung vào phần #content mà không reload trang
            fetch(item.getAttribute("href"))
                .then(response => response.text()) // Lấy nội dung HTML của file
                .then(data => {
                    contentDiv.innerHTML = data; // Gán nội dung vào phần #content
                })
                .catch(error => {
                    console.error("Error loading content:", error);
                });
        }
    });

    // Đảm bảo vẫn có sự kiện click cho việc thay đổi tab
    menuItems.forEach(function (item) {
        item.addEventListener("click", function (event) {
            event.preventDefault(); // Ngăn chặn reload trang

            // Xóa class active_tt khỏi tất cả các menu item
            menuItems.forEach(function (el) {
                el.classList.remove("active_tt");
            });

            // Thêm class active_tt vào item đang được click
            this.classList.add("active_tt");

            // Tải nội dung vào phần #content mà không reload trang
            fetch(item.getAttribute("href"))
                .then(response => response.text()) // Lấy nội dung HTML của file
                .then(data => {
                    contentDiv.innerHTML = data; // Gán nội dung vào phần #content
                })
                .catch(error => {
                    console.error("Error loading content:", error);
                });
        });
    });
});
