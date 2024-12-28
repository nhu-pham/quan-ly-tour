
    <div class="container mt-4">
        <h1>Tour</h1>
        <div class="search-container">
            <input type="text" id="search" class="form-control" placeholder="Tìm kiếm thông tin tour" ">
            <button class="search-button" id="searchBtn">Tìm kiếm</button>
        </div>
        <div style="display: flex; align-items: center;">
            <div>
                <button class="btn btn-custom mt-2" data-bs-toggle="modal" data-bs-target="#addTourModal">
                    <i class="fas fa-plus"></i> Tạo mới
                </button>
            </div>
            <div style="margin-left: 10px;">
                <select class="form-select" id="regionSelect" required>
                    <option value="Chọn Miền">Chọn miền</option>
                    <option value="Miền Bắc">Miền Bắc</option>
                    <option value="Miền Trung">Miền Trung</option>
                    <option value="Miền Nam">Miền Nam</option>
                </select>
            </div>
        </div>
      
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Mã tour</th>
                    <th>Tên tour</th>
                    <th>Miền</th>
                    <th>Hình ảnh</th>
                    <th>Thông tin chi tiết</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="tourList">
                <tr data-id="1">
                    <td>1</td>
                    <td class="tour-name">Tour Hà Nội</td>
                    <td class="tour-region">Miền Bắc</td>
                    <td><img src="image.jpg" alt="Hà Nội" class="tour-image"></td>
                    <td class="tour-details">
                        Khởi hành: Hà Nội<br>Ngày khởi hành: 2024-12-01<br>Giá tour: 5.000.000 VNĐ<br>Chi tiết tour: Sapa-Lào Cai
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick="editTour(1)" data-bs-toggle="modal" data-bs-target="#editTourModal">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </button>
                        <button class="btn btn-danger" onclick="deleteTour(1)" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal thêm tour -->
    <div class="modal fade" id="addTourModal" tabindex="-1" aria-labelledby="addTourModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTourModalLabel">Tạo mới tour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTourForm">
                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tourName" class="form-label">Tên tour</label>
                                    <input type="text" class="form-control" id="tourName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="region" class="form-label">Miền</label>
                                    <select class="form-select" id="region" required>
                                        <option value="1">Miền Bắc</option>
                                        <option value="2">Miền Trung</option>
                                        <option value="3">Miền Nam</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" id="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="tourDeparturePlace" class="form-label">Khởi hành:</label>
                                    <input type="text" class="form-control" id="tourDeparturePlace" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tourDate" class="form-label">Ngày khởi hành:</label>
                                    <input type="date" class="form-control" id="tourDate" required>
                                </div>
                            </div>
                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tourPrice" class="form-label">Giá:</label>
                                    <input type="number" class="form-control" id="tourPrice" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tourTime" class="form-label">Thời gian:</label>
                                    <input type="text" class="form-control" id="tourTime" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tourDestination" class="form-label">Điểm đến:</label>
                                    <input type="text" class="form-control" id="tourDestination" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tourItinerary" class="form-label">Lịch trình:</label>
                                    <input type="text" class="form-control" id="tourItinerary" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tourDetail" class="form-label">Chi tiết:</label>
                                    <input type="text" class="form-control" id="tourDetail" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="addTour()">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal chỉnh sửa tour -->
<div class="modal fade" id="editTourModal" tabindex="-1" aria-labelledby="editTourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTourLabel">Chỉnh sửa thông tin tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTourForm">
                    <div class="mb-3">
                        <label for="editTourName" class="form-label">Tên tour</label>
                        <input type="text" class="form-control" id="editTourName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRegion" class="form-label">Miền</label>
                        <select class="form-select" id="editRegion" required>
                            <option value="1">Miền Bắc</option>
                            <option value="2">Miền Trung</option>
                            <option value="3">Miền Nam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="editImage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="editTourDeparturePlace" class="form-label">Khởi hành:</label>
                        <input type="text" class="form-control" id="editTourDeparturePlace" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTourDate" class="form-label">Ngày khởi hành:</label>
                        <input type="date" class="form-control" id="editTourDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTourPrice" class="form-label">Giá:</label>
                        <input type="number" class="form-control" id="editTourPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTourTime" class="form-label">Thời gian:</label>
                        <input type="text" class="form-control" id="editTourTime" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="updateTourBtn">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal xóa tour -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa tour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tour details will be populated here -->
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
    <script src="http://localhost/quan-ly-tour/public/assets/js/admin/tour.js"></script>
