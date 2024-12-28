
    <div class="container mt-4">
        <h1>Dịch Vụ</h1>
        <div class="search-container">
            <input type="text" id="search" class="form-control" placeholder="Tìm kiếm thông tin dịch vụ" >
            <button class="search-button" id="searchBtn">Tìm kiếm</button>
        </div>

        <div>
            <button class="btn btn-custom mt-2" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="fas fa-plus"></i> Tạo mới
            </button>
        </div>
      
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Mã dịch vụ</th>
                    <th>Loại dịch vụ</th>
                    <th>Tên dịch vụ</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="serviceList">
                
            </tbody>
        </table>
    </div>

    <!-- Modal thêm dịch vụ -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Tạo mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addServiceForm">
                        <div class="mb-3">
                            <label for="serviceType" class="form-label">Loại dịch vụ</label>
                            <select class="form-select" id="serviceType" required>
                                <option value="1">Xe máy</option>
                                <option value="2">Ô tô</option>
                                <option value="3">Combo cắm trại</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="serviceName" class="form-label">Tên dịch vụ</label>
                            <input type="text" class="form-control" id="serviceName" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="servicePrice" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="servicePrice" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="addService()">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa dịch vụ -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceLabel">Chỉnh sửa thông tin dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form id="editServiceForm">
    
                            <div class="mb-3">
                                <label for="editServiceType" class="form-label">Loại dịch vụ</label>
                                <select class="form-select" id="editServiceType" required>
                                    <option value="1">Xe máy</option>
                                    <option value="2">Xe ô tô</option>
                                    <option value="3">Combo cắm trại</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editServiceName" class="form-label">Tên dịch vụ</label>
                                <input type="text" class="form-control" id="editServiceName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editImage" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="editImage" accept="image/*">
                            </div>
                        
                            <div class="mb-3">
                                <label for="editServicePrice" class="form-label">Giá:</label>
                                <input type="number" class="form-control" id="editServicePrice" required>
                            </div>
                           
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="updateServiceBtn">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xóa dịch vụ -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Service details will be populated here -->
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
    <script src="http://localhost/quan-ly-tour/public/assets/js/manager/dichvu.js"></script>
