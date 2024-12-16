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


    let ID_Service = 0; // Initialize serial number


    const loadServicesPage = () => {
        content.innerHTML = `
            <h2>Dịch vụ</h2>
            <input type="text" class="search-input" placeholder="Tìm kiếm thông tin dịch vụ">
            <button class="search-button">Tìm kiếm</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã dịch vụ</th>
                        <th>Loại dịch vụ</th>
                        <th>Tên dịch vụ</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th><span id="cc">Hành động</span>
                        <button class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#actionModal" id="add-0">
                        <i class="fas fa-plus"></i></button></th>
                    </tr>
                </thead>
                <tbody id="serviceTableBody">
                    <tr>
                        <td>1</td>
                        <td>Xe máy</td>
                        <td>SH MODE</td>
                        <td><img src="img/mocchau.jpg" alt="Mộc Châu" width="50"></td>
                        <td>2.000.000VND</td>
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
            <h1 class="modal-title fs-5" id="actionLabel">Tạo mới dịch vụ</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="ID_Service" class="form-label">Mã dịch vụ</label>
              <input type="text" class="form-control" id="ID_Service" disabled>
            </div>
            <div class="mb-3">
              <label for="Type_Service" class="form-label">Loại dịch vụ</label>
              <select id="Type_Service" class="form-select">
                <option value="Xe máy">Xe máy</option>
                <option value="Ô tô">Ô tô</option>
                <option value="Combo cắm trại">Combo cắm trại</option>
              </select>
            </div>
   
            <div class="mb-3">
              <label for="Name_Service" class="form-label">Tên dịch vụ</label>
              <input type="text" class="form-control" id="Name_Service">
            </div>
            <div class="mb-3">
              <label for="Image_Service" class="form-label">Hình ảnh</label>
              <input type="file" class="form-control" id="Image_Service">
            </div>
            <div class="mb-3">
              <label for="Price_Service" class="form-label">Giá</label>
              <input type="number" class="form-control" id="Price_Service">
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
        const ID_Service = row.children[0].innerText;
        const Type_Service = row.children[1].innerText;
        const Name_Service = row.children[2].innerText;
        const Price_Service = row.children[4].innerText;




        document.getElementById('ID_Service').value = ID_Service;
        document.getElementById('Type_Service').value = Type_Service;
        document.getElementById('Name_Service').value = Name_Service;
        document.getElementById('Price_Service').value = Price_Service;


        document.getElementById('actionLabel').innerText = 'Chỉnh sửa thông tin dịch vụ';
        document.getElementById('actionBtn').innerText = 'Cập nhật';
        document.getElementById('actionBtn').classList.remove('btn-danger');
        document.getElementById('actionBtn').classList.add('btn-primary');
    };


    const handleDelete = (event) => {
        const row = event.target.closest('tr');
        const ID_Service = row.children[0].innerText;
        const Type_Service = row.children[1].innerText;
        const Name_Service = row.children[2].innerText;
        const Price_Service = row.children[4].innerText;


        document.getElementById('ID_Service').value = ID_Service;
        document.getElementById('Type_Service').value = Type_Service;
        document.getElementById('Name_Service').value = Name_Service;
        document.getElementById('Price_Service').value = Price_Service;




        document.getElementById('actionLabel').innerText = 'Xóa thông tin dịch vụ';
        document.getElementById('actionBtn').innerText = 'Xác nhận xóa';
        document.getElementById('actionBtn').classList.remove('btn-primary');
        document.getElementById('actionBtn').classList.add('btn-danger');
    };


    const AddSingleRecord = (ID_Service, Type_Service, Name_Service, Image_Service, Price_Service) => {
        let trow = document.createElement('tr');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');
        let td6 = document.createElement('td');


        td1.innerHTML = ++ID_Service;
        td2.innerHTML = Type_Service;
        td3.innerHTML = Name_Service;
        td4.innerHTML = Image_Service;
        td5.innerHTML = Price_Service;


        let EditButton = document.createElement('button');
        let DelButton = document.createElement('button');


        EditButton.id = 'edit-' + ID_Service;
        EditButton.className = 'btn btn-primary me-2 edit-btn';
        EditButton.innerHTML = '<i class="fas fa-edit"></i>';
        EditButton.setAttribute("data-bs-toggle", 'modal');
        EditButton.setAttribute("data-bs-target", '#actionModal');


        DelButton.id = 'del-' + ID_Service;
        DelButton.className = 'btn btn-danger me-2 delete-btn';
        DelButton.innerHTML = '<i class="fas fa-trash"></i>';
        DelButton.setAttribute("data-bs-toggle", 'modal');
        DelButton.setAttribute("data-bs-target", '#actionModal');


        td6.append(EditButton, DelButton);
        trow.append(td1, td2, td3, td4, td5, td6);
        document.getElementById('tourTableBody').append(trow);
    };


    switch (section) {
        case 'services':
            loadServicesPage();
            break;
    }
}





