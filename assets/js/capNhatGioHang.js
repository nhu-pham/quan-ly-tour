document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Tìm input trong cùng container
            const input = this.parentNode.querySelector('.quantity-input');
            let value = parseInt(input.value);

            // Tăng hoặc giảm giá trị
            if (this.textContent.trim() === '+') {
                value++;
            } else if (this.textContent.trim() === '-' && value > 0) {
                value--;
            }

            input.value = value; // Cập nhật giá trị input
        });
    });
});