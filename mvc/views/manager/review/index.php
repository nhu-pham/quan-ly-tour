
    <div class="container mt-4">
        <h1>Nhận xét</h1>
        <div class="search-container">
            <input type="text" id="search" class="form-control" placeholder="Tìm kiếm thông tin nhận xét" onkeyup="searchDichvu()">
            <button class="search-button" id="searchBtn">Tìm kiếm</button>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="reviewList">
                <tr data-id="1">
                    <td>1</td>
                    <td class="review-name">Họ Và Tên</td>
                    <td class="review-email">vietcharm123@gmail.com</td>
                    <td class="review-content">Hà Giang thật đẹp</td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteReview(1)" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Modal xóa dịch vụ -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Review details will be populated here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Xác nhận xóa</button>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="http://localhost/quan-ly-tour/public/assets/js/admin/nhanxet.js"></script>
