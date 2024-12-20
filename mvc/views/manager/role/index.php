<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/quan-ly-tour/public/assets/css/admin/phanquyen.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Phân Quyền</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Phân Quyền</h1>
        <div class="search-container">
            <input type="text" id="search" class="form-control" placeholder="Tìm kiếm thông tin nhân viên" onkeyup="searchPhanquyen()">
            <button class="search-button">Tìm kiếm</button>
        </div>

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
                <tr data-id="1">
                    <td>1</td>
                    <td class="permission-name">Nguyễn Văn A</td>
                    <td class="permission-position">Quản lý Miền Bắc</td>
                    <td>
                        <button class="btn btn-warning" onclick="editPermission(1)" data-bs-toggle="modal" data-bs-target="#editPermissionModal">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </button>
                        <button class="btn btn-danger" onclick="deletePermission(1)" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
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
                      <option value="Quản lý Miền Bắc">Quản lý Miền Bắc</option>
                      <option value="Quản lý Miền Trung">Quản lý Miền Trung</option>
                      <option value="Quản lý Miền Nam">Quản lý Miền Nam</option>
                      <option value="Nhân viên">Nhân viên</option>
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
                    <!-- Service details will be populated here -->
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
    <script src="http://localhost/quan-ly-tour/public/assets/js/admin/phanquyen.js"></script>
</body>
</html>