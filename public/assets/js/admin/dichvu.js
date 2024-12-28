// Gọi reloadServices khi tài liệu HTML đã được tải
document.addEventListener("DOMContentLoaded", reloadServices);

function editService(serviceId) {
  // Lấy thông tin từ hàng chứa dịch vụ tương ứng
  const row = document.querySelector(`tr[data-id='${serviceId}']`);
  const serviceType = row.querySelector(".service-type").innerText;
  const serviceName = row.querySelector(".service-name").innerText;
  const servicePrice = row.querySelector(".service-price").innerText;
  const serviceImageSrc = row.querySelector(".service-image").src; // Lấy đường dẫn hình ảnh

  // Điền thông tin vào modal chỉnh sửa
  document.querySelector("#editServiceModal .modal-body").innerHTML = `
      <div class="form-group">
          <label for="editServiceType">Loại dịch vụ</label>
          <select class="form-select" id="editServiceType">
              <option value="1" ${
                serviceType === "Xe máy" ? "selected" : ""
              }>Xe máy</option>
              <option value="2" ${
                serviceType === "Ô tô" ? "selected" : ""
              }>Ô tô</option>
              <option value="3" ${
                serviceType === "Combo cắm trại" ? "selected" : ""
              }>Combo cắm trại</option>
          </select>
      </div>
      <div class="form-group">
          <label for="editServiceName">Tên dịch vụ</label>
          <input type="text" class="form-control" id="editServiceName" value="${serviceName}">
      </div>
      <div class="form-group">
          <label for="editImage">Chọn hình ảnh mới</label>
          <input type="file" class="form-control" id="editImage" accept="image/*" value="${serviceImageSrc}">
      </div>
      <div class="form-group">
          <label for="editServicePrice">Giá dịch vụ</label>
          <input type="text" class="form-control" id="editServicePrice" value="${servicePrice}">
      </div>
  `;
  // Trong hàm `editService`, chỉ cần lưu `serviceId` vào modal
  document
    .querySelector("#editServiceModal")
    .setAttribute("data-id", serviceId);

  document.querySelector("#updateServiceBtn").onclick = function () {
    const serviceId = document
      .querySelector("#editServiceModal")
      .getAttribute("data-id");
    update(serviceId);
  };
}

// Function để mở modal xác nhận xóa
function deleteService(serviceId) {
  const row = document.querySelector(`tr[data-id='${serviceId}']`);
  const serviceName = row.querySelector(".service-name").innerText;

  document.querySelector("#confirmDeleteModal .modal-body").innerHTML = `
          Bạn có chắc chắn muốn xóa dịch vụ <b>${serviceName}</b> không?
      `;

  document.querySelector("#confirmDeleteBtn").onclick = function () {
    confirmDeleteService(serviceId);
  };
}

// Function xác nhận xóa dịch vụ
async function confirmDeleteService(serviceId) {
  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/admin/service/delete/${serviceId}`,
      {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
    if (!response.ok) {
      throw new Error("Lỗi khi xóa dịch vụ. Vui lòng thử lại sau.");
    }
    // Nếu API trả về thành công, xóa dòng khỏi giao diện
    const row = document.querySelector(`tr[data-id='${serviceId}']`);
    if (row) {
      row.remove();
    }

    // Đóng modal với Bootstrap 4
    $("#confirmDeleteModal").modal("hide"); // Cách này dùng cho Bootstrap 4

    // Xóa các lớp modal-backdrop
    document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
    document.body.classList.remove("modal-open");
    window.location.reload();
  } catch (error) {
    console.error("Lỗi khi xóa dịch vụ:", error);
    alert("Không thể xóa dịch vụ. Vui lòng kiểm tra lại.");
  }
}

async function update(serviceId) {
  const serviceName = document.getElementById("editServiceName").value;
  const servicePrice = document.getElementById("editServicePrice").value;
  const serviceCategoryId = document.getElementById("editServiceType").value;
  const serviceImageUrl = document.getElementById("editImage").value;

  // Nếu có đường dẫn của image, cắt bỏ phần đầu (C:\\fakepath\\) và chỉ lấy tên file
  let image = "";
  if (serviceImageUrl !== "") {
    const imageName = serviceImageUrl.split("\\").pop(); // Tách chuỗi và lấy phần cuối cùng (tên file)
    image = "public/uploads/images/services/" + imageName;
  }

  // Gán giá trị `data` theo điều kiện
  if (image === "") {
    data = {
      name: serviceName,
      price: servicePrice,
      service_category_id: serviceCategoryId,
    };
  } else {
    data = {
      name: serviceName,
      image_url: image,
      price: servicePrice,
      service_category_id: serviceCategoryId,
    };
  }

  console.log("Sending update request for serviceId:", serviceId);
  console.log("Request data:", data);
  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/admin/service/update/${serviceId}`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      }
    );
    if (!response.ok) {
      throw new Error("Lỗi khi cập nhật dịch vụ.");
    }
    const jsonResponse = await response.json();
    console.log("Update response:", jsonResponse);
    reloadServices();

    if (jsonResponse && jsonResponse.type === "Successfully") {
      $("#editServiceModal").modal("hide");
      document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
      document.body.classList.remove("modal-open");
    }
    window.location.reload();
  } catch (error) {
    console.error("Lỗi:", error);
    alert("Lỗi: " + error.message);
  }
}

function getServiceTypeName(serviceCategoryId) {
  const serviceTypeMap = {
    1: "Xe Máy",
    2: "Ô tô",
    3: "Combo cắm trại",
  };
  return serviceTypeMap[serviceCategoryId] || "Không xác định";
}

function reloadServices() {
  fetch(`http://localhost/quan-ly-tour/api/admin/service/fetchAll`)
    .then((response) => {
      console.log("Response từ server:", response);
      if (!response.ok) {
        throw new Error("Lỗi khi tải danh sách dịch vụ.");
      }
      return response.json(); // Parse JSON trả về
    })
    .then((data) => {
      console.log("Dữ liệu JSON nhận được:", data);
      const tableBody = document.querySelector("#serviceList");
      console.log("Table body element:", tableBody);
      tableBody.innerHTML = "";

      // Duyệt qua từng object trong mảng JSON
      data.forEach((service, index) => {
        console.log(`Dịch vụ ${index}:`, service);
        const { id, service_category_id, name, price, image_url } = service;
        const serviceTypeName = getServiceTypeName(service_category_id);
        console.log("Giá trị giải nén:", {
          id,
          serviceType: service_category_id,
          name,
          price,
          image_url,
        }); // Log các giá trị đã giải nén
        console.log("Tên loại dịch vụ:", serviceTypeName);

        const row = `
            <tr data-id="${id}">
              <td>${id}</td>
              <td class="service-type">${serviceTypeName}</td>
              <td class="service-name">${name}</td>
              <td>
                <img src="/quan-ly-tour/${image_url}" alt="${name}" class="service-image" style="width: 50px; height: auto;" />
              </td>
              <td class="service-price">${price}</td>
              <td>
                <button class="btn btn-warning" onclick="editService(${id})" data-bs-toggle="modal" data-bs-target="#editServiceModal">
                  <i class="fas fa-edit"></i> Chỉnh sửa
                </button>
                <button class="btn btn-danger" onclick="deleteService(${id})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                  <i class="fas fa-trash"></i> Xóa
                </button>
              </td>
            </tr>`;
        console.log("HTML của hàng:", row);
        tableBody.insertAdjacentHTML("beforeend", row);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Lỗi khi tải danh sách dịch vụ: " + error.message);
    });
}

async function addService() {
  const serviceName = document.querySelector("#serviceName").value;
  const servicePrice = document.querySelector("#servicePrice").value;
  const serviceImageUrl = document.querySelector("#image").value;
  const serviceType = document.querySelector("#serviceType").value;

  // Nếu có đường dẫn của image, cắt bỏ phần đầu (C:\\fakepath\\) và chỉ lấy tên file
  let image = "";
  if (serviceImageUrl !== "") {
    const imageName = serviceImageUrl.split("\\").pop(); // Tách chuỗi và lấy phần cuối cùng (tên file)
    image = "public/uploads/images/services/" + imageName;
  }

  const data = {
    name: serviceName,
    price: servicePrice,
    image_url: image,
    service_category_id: serviceType,
  };

  console.log("Request data:", data);

  try {
    const response = await fetch(
      "http://localhost/quan-ly-tour/api/admin/service/add",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      }
    );

    if (!response.ok) {
      throw new Error(`Lỗi khi thêm dịch vụ. Status: ${response.status}`);
    }

    const jsonResponse = await response.json();
    console.log("Add response:", jsonResponse);

    console.log("Dịch vụ thêm thành công:", jsonResponse);

    // Tạo hàng mới trong bảng
    const newRow = document.createElement("tr");
    newRow.setAttribute("data-id", jsonResponse.id);
    newRow.innerHTML = `
          <td>${jsonResponse.id}</td>
          <td class="service-type">${getServiceTypeName(serviceType)}</td>
          <td class="service-name">${serviceName}</td>
          <td><img src="${image}" alt="${serviceName}" class="service-image"></td>
          <td class="service-price">${servicePrice}</td>
          <td>
            <button class="btn btn-warning" onclick="editService(${
              jsonResponse.id
            })" data-bs-toggle="modal" data-bs-target="#editServiceModal">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </button>
            <button class="btn btn-danger" onclick="deleteService(${
              jsonResponse.id
            })" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                <i class="fas fa-trash"></i> Xóa
            </button>
          </td>
        `;

    document.querySelector("#serviceList").appendChild(newRow);

    if (jsonResponse && jsonResponse.type === "Successfully") {
      //reloadTours();
      $("#addServiceModal").modal("hide");

      // Xóa các lớp modal-backdrop
      document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
      document.body.classList.remove("modal-open");
    }
    window.location.reload();
  } catch (error) {
    console.error("Lỗi khi thêm dịch vụ:", error);
    alert("Lỗi: " + error.message);
  }
}

async function searchDichVu() {
  const input = document.querySelector("#search").value.trim().toLowerCase();
  const data = {
    keyword: input,
    start: "0",
    limit: "10",
  };
  console.log("JSON Body:", data);
  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/admin/service/search`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    );
    const jsonResponse = await response.json();
    console.log("Response from server:", jsonResponse);
    if (!jsonResponse || jsonResponse.length === 0) {
      alert("Không tìm thấy kết quả phù hợp.");
      return;
    }
    const serviceList = document.querySelector("#serviceList");
    serviceList.innerHTML = "";
    jsonResponse.forEach((service) => {
      const newRow = document.createElement("tr");
      newRow.setAttribute("data-id", service.service_id);
      newRow.innerHTML = `
        <td>${service.service_id}</td>
        <td class="service-type">${service.category_name}</td>
        <td class="service-name">${service.service_name}</td>
        <td><img src="/quan-ly-tour/${service.image_url}" alt="${service.name}" class="service-image"></td>
        <td class="service-price">${service.price}</td>
        <td>
          <button class="btn btn-warning" onclick="editService(${service.id})" data-bs-toggle="modal" data-bs-target="#editServiceModal">
              <i class="fas fa-edit"></i> Chỉnh sửa
          </button>
          <button class="btn btn-danger" onclick="deleteService(${service.id})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
              <i class="fas fa-trash"></i> Xóa
          </button>
        </td>
      `;
      serviceList.appendChild(newRow);
    });
    $("#addServiceModal").modal("hide");
  } catch (error) {
    console.error("Error:", error);
    alert("Đã có lỗi xảy ra, vui lòng thử lại.");
  }
}
document.querySelector("#searchBtn").onclick = function () {
  searchDichVu();
};
