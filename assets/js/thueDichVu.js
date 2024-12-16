
document.addEventListener("DOMContentLoaded", function() {
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
});