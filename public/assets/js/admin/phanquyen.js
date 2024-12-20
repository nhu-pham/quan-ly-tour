// Function to populate "Chỉnh sửa" modal
function editPermission(permissionId) {
    // Lấy thông tin từ hàng chứa phân quyền tương ứng
    const row = document.querySelector(`tr[data-id='${permissionId}']`);
    const permissionName = row.querySelector('.permission-name').innerText;
    const permissionPosition = row.querySelector('.permission-position').innerText;

    

    // Điền thông tin vào modal chỉnh sửa
    document.querySelector('#editPermissionModal .modal-body').innerHTML = `
         <div class="form-group">
            <label for="editPermissionName">Họ và tên</label>
            <input type="text" class="form-control" id="editPermissionName" value="${permissionName}">
        </div>
        <div class="form-group">
            <label for="editPermissionPosition">Vai trò</label>
            <select class="form-select" id="editPermissionPosition">
                <option value="Quản lý Miền Bắc" ${permissionPosition === 'Quản lý Miền Bắc' ? 'selected' : ''}>Quản lý Miền Bắc</option>
                <option value="Quản lý Miền Trung" ${permissionPosition === 'Quản lý Miền Trung' ? 'selected' : ''}>Quản lý Miền Trung</option>
                <option value="Quản lý Miền Nam" ${permissionPosition === 'Quản lý Miền Nam' ? 'selected' : ''}>Quản lý Miền Nam</option>
                   <option value="Nhân viên" ${permissionPosition === 'Nhân viên' ? 'selected' : ''}>Nhân viên</option>
            </select>
        </div>
       
       
    `;

    // Xử lý nút cập nhật
    document.querySelector('#updatePermissionBtn').onclick = function () {
        updatePermission(permissionId);
    };
}

// Function để cập nhật thông tin dịch vụ
function updatePermission(permissionId) {
    const updatedPermissionName = document.querySelector('#editPermissionName').value;
    const updatedPermissionPosition = document.querySelector('#editPermissionPosition').value;
 

    // Cập nhật thông tin trên bảng
    const row = document.querySelector(`tr[data-id='${permissionId}']`);
    row.querySelector('.permission-name').innerText = updatedPermissionName;
    row.querySelector('.permission-position').innerText = updatedPermissionPosition;
 


    // Đóng modal
    $('#editPermissionModal').modal('hide');
}

// Function để mở modal xác nhận xóa
function deletePermission(permissionId) {
    const row = document.querySelector(`tr[data-id='${permissionId}']`);
    const permissionName = row.querySelector('.permission-name').innerText;

    // Điền thông tin xác nhận vào modal xóa
    document.querySelector('#confirmDeleteModal .modal-body').innerHTML = `
        Bạn có chắc chắn muốn xóa nhân viên <b>${permissionName}</b> không?
    `;

    // Gán hàm xác nhận xóa cho nút "Xác nhận xóa"
    document.querySelector('#confirmDeleteBtn').onclick = function () {
        confirmDeletePermission(permissionId);
    };
}

// Function xác nhận xóa dịch vụ
function confirmDeletePermission(permissionId) {
    const row = document.querySelector(`tr[data-id='${permissionId}']`);
    row.remove();

    // Đóng modal
    $('#confirmDeleteModal').modal('hide');
}

function addPermission() {
    const permissionName = document.querySelector('#permissionName').value.trim();
    const permissionPosition = document.querySelector('#permissionPosition').value;

    if (!permissionName || !permissionPosition) {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return;
    }

    const newId = Date.now(); // Tạo ID duy nhất
    const newRow = document.createElement('tr');
    newRow.setAttribute('data-id', newId);

    newRow.innerHTML = `
        <td>${newId}</td>
        <td class="permission-position">${permissionPosition}</td>
        <td class="permission-name">${permissionName}</td>
        <td>
            <button class="btn btn-warning" onclick="editPermission(${newId})" data-bs-toggle="modal" data-bs-target="#editPermissionModal">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </button>
            <button class="btn btn-danger" onclick="deletePermission(${newId})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                <i class="fas fa-trash"></i> Xóa
            </button>
        </td>
    `;

    document.querySelector('#permissionList').appendChild(newRow);

    // Đóng modal
    $('#addPermissionModal').modal('hide');

    // Reset form
    document.querySelector('#permissionName').value = '';
    document.querySelector('#permissionPosition').value = '';
}
