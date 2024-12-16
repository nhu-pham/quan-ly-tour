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

  let tourCode = 0; // Initialize serial number

  const loadToursPage = () => {
      content.innerHTML = `
          <h2>Tour</h2>
          <input type="text" class="search-input" placeholder="Tìm kiếm thông tin tour">
          <button class="search-button">Tìm kiếm</button>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Mã tour</th>
                      <th>Tên tour</th>
                      <th>Miền</th>
                      <th>Hình ảnh</th>
                      <th>Thông tin chi tiết</th>
                      <th><span id="cc">Hành động</span> 
                      <button class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#actionModal" id="add-0">
                      <i class="fas fa-plus"></i></button></th>
                  </tr>
              </thead>
              <tbody id="tourTableBody">
                  <tr>
                      <td>1</td>
                      <td>Tour Hà Nội</td>
                      <td>Miền Bắc</td>
                      <td><img src="img/mocchau.jpg" alt="Mộc Châu" width="50"></td>
                      <td>
                          <p>Khởi hành: Hà Nội</p>
                          <p>Ngày khởi hành: 2024-12-01</p>
                          <p>Giá tour: 5,000,000 VND</p>
                          <p>Thời gian: 3 ngày 2 đêm</p>
                          <p>Chi tiết tour: Đồi chè Mộc Châu - Thác Dải - Đỉnh Pha Luông</p>
                      </td>
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
          <h1 class="modal-title fs-5" id="actionLabel">Tạo mới tour</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="tourCode" class="form-label">Mã tour</label>
            <input type="text" class="form-control" id="tourCode" disabled>
          </div>
          <div class="mb-3">
            <label for="tourName" class="form-label">Tên tour</label>
            <input type="text" class="form-control" id="tourName">
          </div>
          <div class="mb-3">
            <label for="tourRegion" class="form-label">Miền</label>
            <select id="tourRegion" class="form-select">
              <option value="Miền Bắc">Miền Bắc</option>
              <option value="Miền Trung">Miền Trung</option>
              <option value="Miền Nam">Miền Nam</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tourImage" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="tourImage">
          </div>
          <div class="mb-3">
            <label for="tourDetail" class="form-label">Thông tin chi tiết</label>
            <textarea class="form-control" id="tourDetail" rows="3"></textarea>
          </div>
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
      const tourCode = row.children[0].innerText;
      const tourName = row.children[1].innerText;
      const tourRegion = row.children[2].innerText;
      const tourDetail = row.children[4].innerText;

      document.getElementById('tourCode').value = tourCode;
      document.getElementById('tourName').value = tourName;
      document.getElementById('tourRegion').value = tourRegion;
      document.getElementById('tourDetail').value = tourDetail;

      document.getElementById('actionLabel').innerText = 'Chỉnh sửa thông tin tour';
      document.getElementById('actionBtn').innerText = 'Cập nhật';
      document.getElementById('actionBtn').classList.remove('btn-danger');
      document.getElementById('actionBtn').classList.add('btn-primary');
  };

  const handleDelete = (event) => {
      const row = event.target.closest('tr');
      const tourCode = row.children[0].innerText;
      const tourName = row.children[1].innerText;
      const tourRegion = row.children[2].innerText;
      const tourDetail = row.children[4].innerText;

      document.getElementById('tourCode').value = tourCode;
      document.getElementById('tourName').value = tourName;
      document.getElementById('tourRegion').value = tourRegion;
      document.getElementById('tourDetail').value = tourDetail;

      document.getElementById('actionLabel').innerText = 'Xóa thông tin tour';
      document.getElementById('actionBtn').innerText = 'Xác nhận xóa';
      document.getElementById('actionBtn').classList.remove('btn-primary');
      document.getElementById('actionBtn').classList.add('btn-danger');
  };

  const AddSingleRecord = (tourCode, tourName, tourRegion, tourImage, tourDetail) => {
      let trow = document.createElement('tr');
      let td1 = document.createElement('td');
      let td2 = document.createElement('td');
      let td3 = document.createElement('td');
      let td4 = document.createElement('td');
      let td5 = document.createElement('td');
      let td6 = document.createElement('td');

      td1.innerHTML = ++tourCode;
      td2.innerHTML = tourName;
      td3.innerHTML = tourRegion;
      td4.innerHTML = tourImage;
      td5.innerHTML = tourDetail;

      let EditButton = document.createElement('button');
      let DelButton = document.createElement('button');

      EditButton.id = 'edit-' + tourCode;
      EditButton.className = 'btn btn-primary me-2 edit-btn';
      EditButton.innerHTML = '<i class="fas fa-edit"></i>';
      EditButton.setAttribute("data-bs-toggle", 'modal');
      EditButton.setAttribute("data-bs-target", '#actionModal');

      DelButton.id = 'del-' + tourCode;
      DelButton.className = 'btn btn-danger me-2 delete-btn';
      DelButton.innerHTML = '<i class="fas fa-trash"></i>';
      DelButton.setAttribute("data-bs-toggle", 'modal');
      DelButton.setAttribute("data-bs-target", '#actionModal');

      td6.append(EditButton, DelButton);
      trow.append(td1, td2, td3, td4, td5, td6);
      document.getElementById('tourTableBody').append(trow);
  };

  switch (section) {
      case 'tours':
          loadToursPage();
          break;
  }
}
