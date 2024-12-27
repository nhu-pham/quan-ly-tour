// Ensure the page is loaded before executing functions
document.addEventListener("DOMContentLoaded", reloadTours);

function editTour(tourId) {
  const row = document.querySelector(`tr[data-id='${tourId}']`);
  if (!row) {
    console.error("Không tìm thấy hàng với tourId:", tourId);
    return;
  }

  const tourName = row.querySelector(".tour-name").innerText.trim();
  const region = row.querySelector(".tour-region").innerText.trim();
  const tourDetails = row.querySelector(".tour-details").innerHTML.trim();

  console.log({ tourName, region, tourDetails });

  const detailsArray = tourDetails.split("<br>");
  const departurePlace = detailsArray[0].split(": ")[1].trim();
  const departureDate = detailsArray[1].split(": ")[1].split(" ")[0].trim();
  const price = detailsArray[2]
    .split(": ")[1]
    .replace(" VNĐ", "")
    .replaceAll(",", "")
    .trim();
  const time = detailsArray[3].split(": ")[1].trim();

  document.querySelector("#editTourModal .modal-body").innerHTML = `
    <div class="form-group">
      <label for="editTourName">Tên tour</label>
      <input type="text" class="form-control" id="editTourName" value="${tourName}">
    </div>
    <div class="form-group">
      <label for="editRegion">Miền</label>
      <select class="form-select" id="editRegion">
          <option value="1" ${
            region === "Miền Bắc" ? "selected" : ""
          }>Miền Bắc</option>
          <option value="2" ${
            region === "Miền Trung" ? "selected" : ""
          }>Miền Trung</option>
          <option value="3" ${
            region === "Miền Nam" ? "selected" : ""
          }>Miền Nam</option>
      </select>
    </div>
    <div class="form-group">
      <label for="editTourDeparturePlace">Khởi hành</label>
      <input type="text" class="form-control" id="editTourDeparturePlace" value="${departurePlace}">
    </div>
    <div class="form-group">
      <label for="editTourDate">Ngày khởi hành</label>
      <input type="date" class="form-control" id="editTourDate" value="${departureDate}">
    </div>
    <div class="form-group">
      <label for="editTourPrice">Giá</label>
      <input type="number" class="form-control" id="editTourPrice" value="${price}">
    </div>
    <div class="form-group">
      <label for="editTourTime">Thời gian</label>
      <input type="text" class="form-control" id="editTourTime" value="${time}">
    </div>`;

  document.querySelector("#editTourModal").setAttribute("data-id", tourId);

  document.querySelector("#updateTourBtn").onclick = function () {
    const tourId = document
      .querySelector("#editTourModal")
      .getAttribute("data-id");
    updateTour(tourId);
  };
}

function deleteTour(tourId) {
  const row = document.querySelector(`tr[data-id='${tourId}']`);
  const tourName = row.querySelector(".tour-name").innerText;

  document.querySelector("#confirmDeleteModal .modal-body").innerHTML = `
    Bạn có chắc chắn muốn xóa tour <b>${tourName}</b> không?`;

  document.querySelector("#confirmDeleteBtn").onclick = function () {
    confirmDeleteTour(tourId);
  };
}

async function confirmDeleteTour(tourId) {
  document.querySelector(`tr[data-id='${tourId}']`).remove();
  $("#confirmDeleteModal").modal("hide");
  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/manager/tour/delete/${tourId}`, // URL đúng
      {
        method: "DELETE", // Sửa lỗi chính tả
        headers: {
          "Content-Type": "application/json",
        },
      }
    );

    if (!response.ok) {
      throw new Error("Lỗi khi xóa dịch vụ. Vui lòng thử lại sau.");
    }

    const row = document.querySelector(`tr[data-id='${tourId}']`);
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
    console.error("Lỗi khi xóa tour:", error);
    alert("Không thể xóa tour. Vui lòng kiểm tra lại.");
  }
}

function getRegionTypeName(categoryId) {
  const regionTypeMap = {
    1: "Miền Bắc",
    2: "Miền Trung",
    3: "Miền Nam",
    4: "Đặc biệt",
  };

  return regionTypeMap[categoryId] || "Không xác định";
}

function createTourRow(data) {}

async function updateTour(tourId) {
  const updatedName = document.getElementById("editTourName").value;
  const updatedRegion = document.getElementById("editRegion").value;
  const updatedDeparturePlace = document.getElementById(
    "editTourDeparturePlace"
  ).value;
  const updatedDepartureDate = document.getElementById("editTourDate").value;
  const updatedPrice = document.getElementById("editTourPrice").value;
  const updatedTime = document.getElementById("editTourTime").value;

  const data = {
    name: updatedName,
    price: updatedPrice,
    pick_up: updatedDeparturePlace,
    duration: updatedTime,
    date_start: updatedDepartureDate,
    category_id: updatedRegion,
  };

  console.log("Sending update request for serviceId:", tourId);
  console.log("Request data:", data);

  const response = await fetch(
    `http://localhost/quan-ly-tour/api/manager/tour/update/${tourId}`,
    {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    }
  );
  try {
    if (!response.ok) {
      throw new Error("Lỗi khi cập nhật dịch vụ.");
    }

    const result = await response.json();
    console.log("Tour updated successfully:", result);
    if (result && result.type === "Successfully") {
      reloadTours();
      // Đóng modal với Bootstrap 4
      $("#editTourModal").modal("hide");
      alert("Cập nhật tour thành công!");

      // Xóa các lớp modal-backdrop
      document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
      document.body.classList.remove("modal-open");
      window.location.reload();
    }
  } catch (error) {
    console.error("Lỗi:", error);
    alert("Lỗi: " + error.message);
  }
}

// Khi modal được hiển thị
$("#editTourModal").on("shown.bs.modal", function () {
  $(this).removeAttr("aria-hidden"); // Xóa bỏ nếu tồn tại thuộc tính không cần thiết
  $("#editTourName").focus(); // Đưa focus vào input đầu tiên
});

// Khi modal bị ẩn
$("#editTourModal").on("hidden.bs.modal", function () {
  $(this).attr("aria-hidden", "true"); // Đặt lại nếu cần
});

// Khi modal được hiển thị
$("#editTourModal").on("shown.bs.modal", function () {
  $(this).removeAttr("aria-hidden"); // Xóa bỏ nếu tồn tại thuộc tính không cần thiết
  $("#editTourName").focus(); // Đưa focus vào input đầu tiên
});

// Khi modal bị ẩn
$("#editTourModal").on("hidden.bs.modal", function () {
  $(this).attr("aria-hidden", "true"); // Đặt lại nếu cần
});

async function addTour() {
  const tourName = document.getElementById("tourName").value.trim();
  const region = document.getElementById("region").value;
  const tourImage = document.getElementById("image").value;
  const tourDeparturePlace = document
    .getElementById("tourDeparturePlace")
    .value.trim();
  const tourDate = document.getElementById("tourDate").value;
  const tourPrice = document.getElementById("tourPrice").value.trim();
  const tourTime = document.getElementById("tourTime").value.trim();
  const tourDestination = document
    .getElementById("tourDestination")
    .value.trim();
  const tourItinerary = document.getElementById("tourItinerary").value.trim();
  const tourDetail = document.getElementById("tourDetail").value.trim();

  // Nếu có đường dẫn của image, cắt bỏ phần đầu (C:\\fakepath\\) và chỉ lấy tên file
  let image = "";
  if (tourImage !== "") {
    const imageName = tourImage.split("\\").pop(); // Tách chuỗi và lấy phần cuối cùng (tên file)
    image = "public/uploads/images/tours/" + imageName;
  }

  if (
    !tourName ||
    !region ||
    !tourDeparturePlace ||
    !tourDate ||
    !tourPrice ||
    !tourTime
  ) {
    alert("Vui lòng điền đầy đủ thông tin.");
    return;
  }

  const data = {
    name: tourName,
    category_id: region,
    pick_up: tourDeparturePlace,
    date_start: tourDate,
    price: parseFloat(tourPrice),
    duration: tourTime,
    destination: tourDestination,
    itinerary: tourItinerary,
    description: tourDetail,
    thumbnail: image,
  };

  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/manager/tour/add`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    );

    if (!response.ok) {
      throw new Error("Lỗi khi thêm tour");
    }

    const result = await response.json();
    console.log("Add response:", result);

    console.log("Tour thêm thành công:", result);

    // Tạo hàng mới trong bảng
    const newRow = document.createElement("tr");
    newRow.setAttribute("data-id", result.id);
    newRow.innerHTML = `
        <td>${result.id}</td>
        <td class="tour-name">${tourName}</td>
        <td class="region">${getRegionTypeName(region)}</td>
        <td><img src="/quan-ly-tour/public/uploads/images/tours/${image}" alt="${tourName}" class="tour-image"></td>
        <td class="tour-details">
            Khởi hành: ${tourDeparturePlace}<br>
            Ngày khởi hành: ${tourDate}<br>
            Giá tour: ${parseInt(tourPrice).toLocaleString()} VNĐ<br>
            Thời gian: ${tourTime}<br>
            Điểm đến: ${tourDestination}<br>
            Lịch trình: ${tourItinerary}<br>
            Chi tiết: ${tourDetail}
        </td>
        <td>
          <button class="btn btn-warning" onclick="edittour(${
            result.id
          })" data-bs-toggle="modal" data-bs-target="#edittourModal">
              <i class="fas fa-edit"></i> Chỉnh sửa
          </button>
          <button class="btn btn-danger" onclick="deletetour(${
            result.id
          })" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
              <i class="fas fa-trash"></i> Xóa
          </button>
        </td>
      `;

    // Thêm dòng mới vào bảng
    document.querySelector("#tourList").appendChild(newRow);
    if (result && result.type === "Successfully") {
      //reloadTours();
      // Đóng modal với Bootstrap 4
      $("#addTourModal").modal("hide");
      //alert("Cập nhật tour thành công!");

      // Xóa các lớp modal-backdrop
      document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
      document.body.classList.remove("modal-open");
      window.location.reload();
    }
  } catch (error) {
    console.error(error);
    alert("Đã xảy ra lỗi khi thêm tour.");
  }
}

async function search() {
  const input = document.querySelector("#regionSelect").value;

  let region;
  if (input === "Miền Bắc") {
    region = 1;
  } else if (input === "Miền Trung") {
    region = 2;
  } else if (input === "Miền Nam") {
    region = 3;
  }

  const data = {
    keyword: region,
    searchField: "category_id",
    start: "0",
    limit: "10",
  };

  console.log("JSON Body:", data);

  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/manager/tour/searchByKeyword`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    );
    const jsonResponse = await response.json();
    if (!jsonResponse || jsonResponse.length === 0) {
      alert("Không tìm thấy kết quả phù hợp.");
      return;
    }

    console.log(jsonResponse);

    const tourList = document.querySelector("#tourList");
    tourList.innerHTML = "";

    jsonResponse.forEach((tour) => {
      const row = renderTourRow(tour);
      console.log(tour);
      tourList.insertAdjacentHTML("beforeend", row);
    });
  } catch (error) {
    console.error("Error:", error);
    alert("Đã có lỗi xảy ra, vui lòng thử lại.");
  }
}

// Thêm sự kiện click vào nút "search-button"
document.querySelector("#regionSelect").onclick = function () {
  search();
};

function renderTourRow(tour) {
  const {
    id,
    name,
    price,
    destination,
    itinerary,
    pick_up,
    duration,
    date_start,
    thumbnail,
    description,
    category_id,
  } = tour;

  const region = getRegionTypeName(category_id);

  return `
    <tr data-id="${id}">
      <td>${id}</td>
      <td class="tour-name">${name}</td>
      <td class="tour-region">${region}</td>
      <td>
        <img src="/quan-ly-tour/${thumbnail}" alt="${name}" class="tour-image" style="width: 50px; height: auto;" />
      </td>
      <td class="tour-details" style="text-align: left; word-break: break-word; white-space: normal; padding: 10px; line-height: 1.6;">
        Khởi hành: ${pick_up}<br>
        Ngày khởi hành: ${date_start}<br>
        Giá tour: ${parseInt(price).toLocaleString()} VNĐ<br>
        Thời gian: ${duration}<br>
        Điểm đến: ${destination}<br>
        Lịch Trình: ${itinerary}<br>
        Chi tiết: ${description}
      </td>
      <td>
        <button class="btn btn-warning" onclick="editTour(${id})" data-bs-toggle="modal" data-bs-target="#editTourModal">
          <i class="fas fa-edit"></i> Chỉnh sửa
        </button>
        <button class="btn btn-danger" onclick="deleteTour(${id})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
          <i class="fas fa-trash"></i> Xóa
        </button>
      </td>
    </tr>`;
}

function reloadTours() {
  fetch("http://localhost/quan-ly-tour/api/manager/tour/fetchAll")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Lỗi khi tải danh sách tour.");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Dữ liệu JSON nhận được:", data);
      const tableBody = document.querySelector("#tourList");
      tableBody.innerHTML = "";

      data.forEach((tour) => {
        const row = renderTourRow(tour);
        console.log("HTML của hàng:", row);
        tableBody.insertAdjacentHTML("beforeend", row);
      });
    })
    .catch((error) => {
      console.error("Lỗi khi tải danh sách tour:", error);
      alert("Không thể tải danh sách tour: " + error.message);
    });
}

async function searchTour() {
  const input = document.querySelector("#search").value.trim().toLowerCase();
  const data = {
    keyword: input,
    start: "0",
    limit: "10",
  };
  console.log(data);
  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/manager/tour/search`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      }
    );

    const jsonResponse = await response.json();
    if (!jsonResponse || jsonResponse.length === 0) {
      alert("Không tìm thấy kết quả phù hợp.");
      return;
    }

    console.log(jsonResponse);

    const tourList = document.querySelector("#tourList");
    tourList.innerHTML = "";

    jsonResponse.forEach((tour) => {
      const row = renderTourRow(tour);
      console.log(tour);
      tourList.insertAdjacentHTML("beforeend", row);
    });
  } catch (error) {
    console.error("Error:", error);
    alert("Đã có lỗi xảy ra, vui lòng thử lại.");
  }
}
document.querySelector("#searchBtn").onclick = function () {
  searchTour();
};

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các liên kết trong menu
  const links = document.querySelectorAll(".nav-link");

  links.forEach((link) => {
    // Lắng nghe sự kiện click
    link.addEventListener("click", function () {
      // Loại bỏ lớp active khỏi tất cả các liên kết
      links.forEach((item) => item.classList.remove("active"));

      // Thêm lớp active vào mục đã click
      link.classList.add("active");
    });
  });
});
