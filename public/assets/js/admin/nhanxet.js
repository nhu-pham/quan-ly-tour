document.addEventListener("DOMContentLoaded", reloadReviews);

// Function để mở modal xác nhận xóa
function deleteReview(reviewId) {
  const row = document.querySelector(`tr[data-id='${reviewId}']`);
  const reviewContent = row.querySelector(".review-content").innerText;

  // Điền thông tin xác nhận vào modal xóa
  const modalBody = document.querySelector("#confirmDeleteModal .modal-body");
  modalBody.innerHTML = `
        Bạn có chắc chắn muốn xóa nội dung <b>${reviewContent}</b> không?
    `;

  // Gán hàm xác nhận xóa cho nút "Xác nhận xóa"
  document.querySelector("#confirmDeleteBtn").onclick = function () {
    confirmDeleteReview(reviewId);
  };

  // Hiển thị modal
  const confirmDeleteModal = new bootstrap.Modal(
    document.getElementById("confirmDeleteModal"),
    { backdrop: false } // Tắt backdrop
  );
  confirmDeleteModal.show();
}

// Function xác nhận xóa dịch vụ
async function confirmDeleteReview(reviewId) {
  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/manager/review/delete/${reviewId}`,
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
    const row = document.querySelector(`tr[data-id='${reviewId}']`);
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
    console.error("Lỗi khi xóa nhận xét:", error);
    alert("Không thể xóa nhận xét. Vui lòng kiểm tra lại.");
  }
}

async function reloadReviews() {
  fetch(`http://localhost/quan-ly-tour/api/manager/review/searchReviews`)
    .then((response) => {
      console.log("Response từ server:", response);
      if (!response.ok) {
        throw new Error("Lỗi khi tải danh sách dịch vụ.");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Dữ liệu JSON nhận được:", data);

      // Sắp xếp dữ liệu theo review_id tăng dần
      const sortedData = data.sort((a, b) => a.review_id - b.review_id);

      const tableBody = document.querySelector("#reviewList");
      tableBody.innerHTML = "";

      sortedData.forEach((review) => {
        const { review_id, fullname, email, review_note } = review; // Giải nén đúng key JSON

        const row = `
          <tr data-id="${review_id}">
            <td>${review_id}</td>
            <td class="review-name">${fullname}</td>
            <td class="review-email">${email}</td>
            <td class="review-content">${review_note}</td>
            <td>
              <button class="btn btn-danger" onclick="deleteReview(${review_id})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
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

async function searchReview() {
  const input = document.querySelector("#search").value.trim().toLowerCase();

  const data = {
    keyword: input,
    start: "0",
    limit: "10",
  };

  console.log("JSON Body:", data);

  try {
    const response = await fetch(
      `http://localhost/quan-ly-tour/api/manager/review/search`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    );

    if (!response.ok) {
      throw new Error("Lỗi phản hồi từ server.");
    }

    const jsonResponse = await response.json();
    console.log("Response from server:", jsonResponse);

    if (!jsonResponse || jsonResponse.length === 0) {
      alert("Không tìm thấy kết quả phù hợp.");
      return;
    }

    // Lấy phần tử table body để chèn kết quả tìm kiếm
    const reviewList = document.querySelector("#reviewList");
    reviewList.innerHTML = ""; // Xóa nội dung cũ trước khi thêm mới

    // Tạo và chèn các hàng vào bảng
    jsonResponse.forEach((review) => {
      const { review_id, fullname, email, review_note } = review; // Giải nén key JSON

      // Tạo một hàng mới
      const newRow = document.createElement("tr");
      newRow.setAttribute("data-id", review_id);

      // Tạo nội dung HTML cho hàng
      newRow.innerHTML = `
        <td>${review_id}</td>
        <td class="review-name">${fullname}</td>
        <td class="review-email">${email}</td>
        <td class="review-content">${review_note}</td>
        <td>
          <button class="btn btn-danger" onclick="deleteReview(${review_id})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
            <i class="fas fa-trash"></i> Xóa
          </button>
        </td>
      `;

      // Thêm hàng mới vào bảng
      reviewList.appendChild(newRow);
    });
  } catch (error) {
    console.error("Error:", error);
    alert("Đã có lỗi xảy ra, vui lòng thử lại.");
  }
}

document.querySelector("#searchBtn").onclick = function () {
  searchReview();
};
