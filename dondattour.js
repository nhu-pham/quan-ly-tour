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

  let ID_booking = 0; // Initialize serial number

  const loadBookingsPage = () => {
      content.innerHTML = `
          <h2>Đơn đặt tour</h2>
          <input type="text" class="search-input" placeholder="Tìm kiếm thông tin đơn đặt tour">
          <button class="search-button">Tìm kiếm</button>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Mã tour</th>
                      <th>Tên tour</th>
                      <th>Thông tin khách hàng</th>
                      <th>Trạng thái</th>
                      <th><span id="cc">Hành động</span> 
                  </tr>
              </thead>
              <tbody id="bookingTableBody">
                  <tr>
                      <td>1</td>
                      <td>Hà Nội - Hải Phòng</td>
                      <td>
                          <p>Thảo Như</p>
                          <p>Nữ</p>
                          <p>22521055@gm.uit.edu.vn</p>
                          <p>0365396825</p>
                          <p>TPHCM</p>
                      </td>
                      <td><span class="badge bg-warning">Chờ xác nhận</span></td>
                      <td>
                          <button class="btn btn-success me-2 confirm-btn">
                              <i class="fas fa-check"></i> Xác nhận
                          </button>
                          <button class="btn btn-primary me-2 edit-btn" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                              <i class="fas fa-edit"></i> Chỉnh sửa
                          </button>
                          <button class="btn btn-secondary export-btn">
                              <i class="fas fa-file-export"></i> Xuất file
                          </button>
                      </td>
                  </tr>
              </tbody>
          </table>
          
          <!-- Modal Chỉnh Sửa -->
          <div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editOrderModalLabel">Chỉnh sửa đơn đặt tour</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="editTourName" class="form-label">Tên tour</label>
                              <input type="text" class="form-control" id="editTourName">
                          </div>
                          <div class="mb-3">
                              <label for="editCustomerInfo" class="form-label">Thông tin khách hàng</label>
                              <textarea class="form-control" id="editCustomerInfo" rows="4"></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                          <button type="button" class="btn btn-primary" id="saveChangesBtn">Lưu thay đổi</button>
                      </div>
                  </div>
              </div>
          </div>
      `;

      document.querySelectorAll('.confirm-btn').forEach(button => {
          button.addEventListener('click', function () {
              const row = this.closest('tr');
              const statusCell = row.querySelector('td:nth-child(4)');
              statusCell.innerHTML = '<span class="badge bg-success">Hoàn thành</span>';
          });
      });

      // Chỉnh sửa thông tin đơn đặt tour
      document.querySelectorAll('.edit-btn').forEach(button => {
          button.addEventListener('click', function () {
              const row = this.closest('tr');
              const tourName = row.children[1].innerText;
              const customerInfo = row.children[2].innerText;

              document.getElementById('editTourName').value = tourName;
              document.getElementById('editCustomerInfo').value = customerInfo;
              document.getElementById('editOrderModal').setAttribute('data-row-id', row.rowIndex); // Changed 'index' to 'rowIndex'
          });
      });

      // Lưu thay đổi từ modal chỉnh sửa
      document.getElementById('saveChangesBtn').addEventListener('click', function () {
          const modal = document.getElementById('editOrderModal');
          const tourName = document.getElementById('editTourName').value;
          const customerInfo = document.getElementById('editCustomerInfo').value;

          const rowId = modal.getAttribute('data-row-id');
          const row = document.getElementById('bookingTableBody').rows[rowId - 1]; // Adjust for zero-based index
          row.children[1].innerText = tourName;
          row.children[2].innerText = customerInfo;

          // Đóng modal
          const modalInstance = bootstrap.Modal.getInstance(modal);
          modalInstance.hide();
      });

      // Xuất file (giả lập chức năng xuất file)
      document.querySelectorAll('.export-btn').forEach(button => {
          button.addEventListener('click', function () {
              alert('Xuất file Excel hoặc PDF!');
          });
      });
  };

  switch (section) {
      case 'bookings':
          loadBookingsPage();
          break;
  }
}