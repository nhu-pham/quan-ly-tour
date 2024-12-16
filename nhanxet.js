function showSection(section) {
    const content = document.getElementById('content');
    if (!content) {
        console.error("Content element not found");
        return;
    }
    content.innerHTML = ''; // Clear old content

    // Remove 'active' class from all links and add to the selected link
    document.querySelectorAll('.sidebar nav ul li a').forEach(link => {
        link.classList.remove('active');
    });
    const activeLink = document.querySelector(`.sidebar nav ul li a[onclick="showSection('${section}')"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }

    let currentRow = null; // Biến tạm lưu trữ hàng cần xóa

    // Hàm tạo modal xác nhận
    const createDeleteModal = () => {
        return `
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Căn giữa modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center"> <!-- Canh giữa nội dung -->
                        Bạn có muốn xóa bình luận này không?
                    </div>
                    <div class="modal-footer d-flex justify-content-center"> <!-- Canh giữa nút -->
                        <button type="button" id="confirmDelete" class="btn btn-primary px-4">Có</button>
                        <button type="button" class="btn btn-outline-primary px-4" data-bs-dismiss="modal">Không</button>
                    </div>
                </div>
            </div>
        </div>`;
    };

    const loadReviewsPage = () => {
        content.innerHTML = `
            <h2>Dịch vụ</h2>
            <input type="text" class="search-input" placeholder="Tìm kiếm nhận xét">
            <button class="search-button">Tìm kiếm</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="TableBody">
                    <tr>
                        <td>1</td>
                        <td>Phạm Thụy Thảo Như</td>
                        <td>22521055@gm.uit.edu.vn</td>
                        <td>Hà Giang rất đẹp</td>
                        <td>
                            <button class="btn btn-danger me-2 delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            ${createDeleteModal()} <!-- Thêm modal vào trang -->
        `;

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Khởi tạo modal

        // Gán sự kiện cho nút xóa
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                currentRow = event.target.closest('tr'); // Lưu trữ hàng cần xóa
                deleteModal.show(); // Hiển thị modal
            });
        });

        // Gán sự kiện cho nút xác nhận "Có" trong modal
        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (currentRow) {
                currentRow.remove(); // Xóa hàng đã chọn
                currentRow = null; // Reset biến tạm
                deleteModal.hide(); // Ẩn modal
            }
        });
    };

    const loadHomePage = () => {
        content.innerHTML = `
            <h2>Trang chủ</h2>
            <p>Chào mừng bạn đến với trang quản lý của chúng tôi!</p>
        `;
    };

    const loadAboutPage = () => {
        content.innerHTML = `
            <h2>Giới thiệu</h2>
            <p>Đây là trang giới thiệu về chúng tôi.</p>
        `;
    };

    const loadContactPage = () => {
        content.innerHTML = `
            <h2>Liên hệ</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Tin nhắn</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="Nhập tin nhắn"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        `;
    };

    switch (section) {
        case 'reviews':
            loadReviewsPage();
            break;
    }
}
