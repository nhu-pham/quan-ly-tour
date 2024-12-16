document.addEventListener("DOMContentLoaded", () => {
    const days = document.querySelectorAll(".day");

    days.forEach(day => {
        const header = day.querySelector(".day-header");
        const content = day.querySelector(".day-content");

        header.addEventListener("click", () => {
            // Đóng các dropdown khác
            document.querySelectorAll(".day-content").forEach(otherContent => {
                if (otherContent !== content) {
                    otherContent.style.display = "none";
                }
            });

            // Hiển thị hoặc ẩn nội dung
            content.style.display = (content.style.display === "block") ? "none" : "block";
        });
    });
});