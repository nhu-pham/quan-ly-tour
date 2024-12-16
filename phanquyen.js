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

    let ID_People = 0; // Initialize serial number

    const loadPermissionsPage = () => {
        content.innerHTML = `
            <h2>Phân Quyền</h2>
            <input type="text" class="search-input" placeholder="Tìm kiếm thông tin nhân sự">
            <button class="search-button">Tìm kiếm</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã nhân sự</th>
                        <th>Họ và tên </th>
                        <th>Vai trò</th>
                        <th><span id="cc">Hành động</span> 
                        <button class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#actionModal" id="add-0">
                        <i class="fas fa-plus"></i></button></th>
                    </tr>
                </thead>
                <tbody id="permissionTableBody">
                    <tr>
                        <td>1</td>
                        <td>Huỳnh Ngọc Diễm Phúc</td>
                        <td>Chi nhánh Miền Bắc</td>
                        <td>
                            <button class="btn btn-primary me-2 edit-btn" data-bs-toggle="modal" data-bs-target="#actionModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger me-2 delete-btn" data-bs-toggle="modal" data-bs-target="#actionModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        `;

        // Add event listeners to the edit and delete buttons
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', handleEdit);
        });
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', handleDelete);
        });
    };

    const modalHTML = `
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="actionLabel">Tạo mới phân quyền</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="ID_People" class="form-label">Mã nhân sự</label>
              <input type="text" class="form-control" id="ID_People" disabled>
            </div>
            <div class="mb-3">
              <label for="Name" class="form-label">Họ và Tên</label>
              <input type="text" class="form-control" id="Name">
            </div>
            <div class="mb-3">
              <label for="Position" class="form-label">Vai trò</label>
              <select id="Position" class="form-select">
                <option value="Quản lý chi nhánh Miền Bắc">Quản lý chi nhánh Miền Bắc</option>
                <option value="Quản lý chi nhánh Miền Trung">Quản lý chi nhánh Miền Trung</option>
                <option value="Quản lý chi nhánh Miền Nam">Quản lý chi nhánh Miền Nam</option>
                <option value="Nhân viên">Nhân viên</option>
              </select>
            </div>

          <div class="modal-footer">
            <button type="button" id="actionBtn" class="btn btn-primary">Lưu</button>
          </div>
        </div>
      </div>
    </div>
    `;

    if (!document.getElementById('actionModal')) {
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    const handleEdit = (event) => {
        const row = event.target.closest('tr');
        const ID_People = row.children[0].innerText;
        const Name = row.children[1].innerText;
        const Position = row.children[2].innerText;

        document.getElementById('ID_People').value = ID_People;
        document.getElementById('Name').value = Name;
        document.getElementById('Position').value = Position;

        document.getElementById('actionLabel').innerText = 'Chỉnh sửa thông tin nhân sự';
        document.getElementById('actionBtn').innerText = 'Cập nhật';
        document.getElementById('actionBtn').classList.remove('btn-danger');
        document.getElementById('actionBtn').classList.add('btn-primary');
    };

    const handleDelete = (event) => {
        const row = event.target.closest('tr');
        const ID_People = row.children[0].innerText;
        const Name = row.children[1].innerText;
        const Position = row.children[2].innerText;

        document.getElementById('ID_People').value = ID_People;
        document.getElementById('Name').value = Name;
        document.getElementById('Position').value = Position;

        document.getElementById('actionLabel').innerText = 'Xóa thông tin nhân sự';
        document.getElementById('actionBtn').innerText = 'Xác nhận xóa';
        document.getElementById('actionBtn').classList.remove('btn-primary');
        document.getElementById('actionBtn').classList.add('btn-danger');
    };

    const AddSingleRecord = (ID_People, Name, Position) => {
        let trow = document.createElement('tr');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');

        td1.innerHTML = ++ID_People;
        td2.innerHTML = Name;
        td3.innerHTML = Position;

        let EditButton = document.createElement('button');
        let DelButton = document.createElement('button');

        EditButton.id = 'edit-' + ID_People;
        EditButton.className = 'btn btn-primary me-2 edit-btn';
        EditButton.innerHTML = '<i class="fas fa-edit"></i>';
        EditButton.setAttribute("data-bs-toggle", 'modal');
        EditButton.setAttribute("data-bs-target", '#actionModal');

        DelButton.id = 'del-' + ID_People;
        DelButton.className = 'btn btn-danger me-2 delete-btn';
        DelButton.innerHTML = '<i class="fas fa-trash"></i>';
        DelButton.setAttribute("data-bs-toggle", 'modal');
        DelButton.setAttribute("data-bs-target", '#actionModal');

        td4.append(EditButton, DelButton);
        trow.append(td1, td2, td3, td4);
        document.getElementById('tourTableBody').append(trow);
    };

    switch (section) {
        case 'permissions':
            loadPermissionsPage();
            break;
    }
}