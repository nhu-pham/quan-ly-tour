<div class="container mt-4">
    <h1>Phân Quyền</h1>
    <form id="searchForm" class="search-container" onsubmit="searchPhanquyen(event)">
        <input type="text" name="searchQuery" id="search" placeholder="Nhập từ khóa tìm kiếm" />
        <button class="search-button" type="submit">Tìm kiếm</button>
    </form>


    <div>
        <button class="btn btn-custom mt-2" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
            <i class="fas fa-plus"></i> Tạo mới
        </button>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Mã nhân viên</th>
                <th>Họ và tên</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="permissionList">
            <?php foreach ($data as $data) { ?>
                <tr data-id="<?= $data['id'] ?>">
                    <td><?= $data['id'] ?></td>
                    <td class="permission-name"><?= $data['fullname'] ?></td>
                    <td class="permission-position"><?php
                                                    $role = htmlspecialchars($data['role_id']);
                                                    if ($role === '1') {
                                                        echo 'Khách hàng';
                                                    } elseif ($role === '2') {
                                                        echo 'Admin';
                                                    } elseif ($role === '3') {
                                                        echo 'Nhân viên';
                                                    } elseif ($role === '4') {
                                                        echo 'Quản lý';
                                                    } else {
                                                        echo 'Không xác định';
                                                    }
                                                    ?>
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick="editPermission(<?= $data['id'] ?>)" data-bs-toggle="modal" data-bs-target="#editPermissionModal">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </button>
                        <button style="margin-bottom: 10px" class="btn btn-danger" onclick="deletePermission(<?= $data['id'] ?>)" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal thêm  -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPermissionLabel">Thêm Phân Quyền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="permissionName">Họ và tên</label>
                    <input type="text" class="form-control" id="permissionName" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group mb-3">
                    <label for="permissionPosition">Vai trò</label>
                    <select class="form-select" id="permissionPosition">
                        <option value="Quản lý">Quản lý</option>
                        <option value="Khách hàng">Khách hàng</option>
                        <option value="Nhân viên">Nhân viên</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="addPermission()">Thêm mới</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal chỉnh sửa phân quyền -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionLabel">Chỉnh sửa thông tin phân quyền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Role details will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="updatePermissionBtn">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal xóa dịch vụ -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa phân quyền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Role details will be populated here -->
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
<script src="http://localhost/quan-ly-tour/public/assets/js/admin/phanquyen.js"></script>