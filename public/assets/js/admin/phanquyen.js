// Function to populate "Chỉnh sửa" modal
function editPermission(permissionId) {
  // Lấy thông tin từ hàng chứa phân quyền tương ứng
  const row = document.querySelector(`tr[data-id='${permissionId}']`);
  const permissionName = row.querySelector(".permission-name").innerText;
  const permissionPosition = row.querySelector(
    ".permission-position"
  ).innerText;

  // Điền thông tin vào modal chỉnh sửa
  document.querySelector("#editPermissionModal .modal-body").innerHTML = `
         <div class="form-group">
            <label for="editPermissionName">Họ và tên</label>
            <input type="text" class="form-control" id="editPermissionName" value="${permissionName}">
        </div>
        <div class="form-group">
            <label for="editPermissionPosition">Vai trò</label>
            <select class="form-select" id="editPermissionPosition">
                <option value="Quản lý" ${
                  permissionPosition === "Quản lý" ? "selected" : ""
                }>Quản lý</option>
                <option value="Khách hàng" ${
                  permissionPosition === "Khách hàng" ? "selected" : ""
                }>Khách hàng</option>
                <option value="Nhân viên" ${
                  permissionPosition === "Nhân viên" ? "selected" : ""
                }>Nhân viên</option>
                <option value="Admin" ${
                  permissionPosition === "Admin" ? "selected" : ""
                }>Admin</option>
            </select>
        </div>
       
       
    `;

  // Xử lý nút cập nhật
  document.querySelector("#updatePermissionBtn").onclick = function () {
    updatePermission(permissionId);
  };
}

// Function để cập nhật thông tin dịch vụ
function updatePermission(permissionId) {
  const updatedPermissionName = document.querySelector(
    "#editPermissionName"
  ).value;
  const updatedPermissionPosition = document.querySelector(
    "#editPermissionPosition"
  ).value;

  const fullname = updatedPermissionName;
  const position = updatedPermissionPosition;
  fetch("/quan-ly-tour/admin/role/update", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: permissionId,
      fullname: fullname,
      position: position,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log(data);
        const row = document.querySelector(`tr[data-id='${permissionId}']`);
        row.querySelector(".permission-name").innerText = updatedPermissionName;
        row.querySelector(".permission-position").innerText =
          updatedPermissionPosition;
        $("#editPermissionModal").modal("hide");
      } else {
        alert("Có lỗi xảy ra khi phân quyền.");
      }
    })
    .catch((error) => console.error("Lỗi:", error));
}

// Function để mở modal xác nhận xóa
function deletePermission(permissionId) {
  const row = document.querySelector(`tr[data-id='${permissionId}']`);
  const permissionName = row.querySelector(".permission-name").innerText;

  // Điền thông tin xác nhận vào modal xóa
  document.querySelector("#confirmDeleteModal .modal-body").innerHTML = `
        Bạn có chắc chắn muốn xóa nhân viên <b>${permissionName}</b> không?
    `;

  // Gán hàm xác nhận xóa cho nút "Xác nhận xóa"
  document.querySelector("#confirmDeleteBtn").onclick = function () {
    confirmDeletePermission(permissionId);
  };
}

// Function xác nhận xóa dịch vụ
function confirmDeletePermission(permissionId) {
  fetch("/quan-ly-tour/admin/role/delete", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: permissionId,
    }),
  })
  .then(response => response.text())
  .then(data => {
      console.log(data);
      const row = document.querySelector(`tr[data-id='${permissionId}']`);
      row.remove();
      $("#confirmDeleteModal").modal("hide");
  })
  .catch(error => console.error("Error:", error));
}

function addPermission() {
  const permissionName = document.querySelector("#permissionName").value.trim();
  const permissionPosition = document.querySelector(
    "#permissionPosition"
  ).value;

  if (!permissionName || !permissionPosition) {
    alert("Vui lòng nhập đầy đủ thông tin!");
    return;
  }

  const fullname = permissionName;
  const position = permissionPosition;
  fetch("/quan-ly-tour/admin/role/add", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      fullname: fullname,
      position: position,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        location.reload();
        $("#addPermissionModal").modal("hide");
      } else {
        alert("Có lỗi xảy ra khi phân quyền.");
      }
    })
    .catch((error) => console.error("Lỗi:", error));
}

function searchPhanquyen(event) {
  event.preventDefault(); // Ngăn form submit mặc định

  const query = document.getElementById("search").value.trim();

  if (query.length === 0) {
    document.getElementById("permissionList").innerHTML =
      "<tr><td colspan='4'>Vui lòng nhập từ khóa tìm kiếm.</td></tr>";
    return;
  }

  fetch("/quan-ly-tour/admin/role/search", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      searchQuery: query,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      let results = "";

      if (Array.isArray(data) && data.length > 0) {
        data.forEach((user) => {
          let roleName;
          switch (user.role_id) {
            case "1":
              roleName = "Khách hàng";
              break;
            case "2":
              roleName = "Admin";
              break;
            case "3":
              roleName = "Nhân viên";
              break;
            case "4":
              roleName = "Quản lý";
              break;
            default:
              roleName = "Không xác định";
          }

          results += `
            <tr data-id="${user.id}">
              <td>${user.id}</td>
              <td>${user.fullname}</td>
              <td>${roleName}</td>
              <td>
                <button class="btn btn-warning" onclick="editPermission(${user.id})" data-bs-toggle="modal" data-bs-target="#editPermissionModal">
                  <i class="fas fa-edit"></i> Chỉnh sửa
                </button>
                <button class="btn btn-danger" onclick="deletePermission(${user.id})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                  <i class="fas fa-trash"></i> Xóa
                </button>
              </td>
            </tr>
          `;
        });
      } else {
        results = "<tr><td colspan='4'>Không tìm thấy kết quả</td></tr>";
      }

      // Cập nhật bảng HTML
      document.getElementById("permissionList").innerHTML = results;
    })
    .catch((error) => {
      console.error("Error:", error);
      document.getElementById("permissionList").innerHTML =
        "<tr><td colspan='4'>Đã xảy ra lỗi khi tìm kiếm.</td></tr>";
    });
}


