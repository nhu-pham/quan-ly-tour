// Lấy dữ liệu từ API
fetch("http://localhost/quan-ly-tour/api/admin/revenue/getMonthlyRevenue") // Đường dẫn API của bạn
  .then((response) => response.json()) // Chuyển đổi dữ liệu trả về thành JSON
  .then((data) => {
    // Chuẩn bị mảng tháng và doanh thu từ dữ liệu API
    const months = [];
    const revenueValues = [];

    // Lặp qua dữ liệu API và chuyển đổi thành dạng tháng và doanh thu
    Object.keys(data).forEach((key) => {
      const month = key.split("-")[1]; // Lấy tháng từ "YYYY-MM"
      const revenue = data[key];

      months.push("Tháng " + month); // Thêm "Tháng X" vào mảng tháng
      revenueValues.push(revenue / 1000000); // Chia cho 1 triệu để hiển thị doanh thu theo triệu VNĐ
    });

    // Cập nhật biểu đồ
    const revenueCtx = document.getElementById("revenueChart").getContext("2d");
    new Chart(revenueCtx, {
      type: "bar",
      data: {
        labels: months, // Mảng tháng
        datasets: [
          {
            label: "Doanh thu (triệu VNĐ)",
            data: revenueValues, // Dữ liệu doanh thu từ API
            backgroundColor: [
              "rgba(54, 162, 235, 0.6)",
              "rgba(75, 192, 192, 0.6)",
              "rgba(255, 159, 64, 0.6)",
              "rgba(153, 102, 255, 0.6)",
              "rgba(201, 203, 207, 0.6)",
              "rgba(255, 99, 132, 0.6)",
              "rgba(54, 162, 235, 0.6)",
              "rgba(75, 192, 192, 0.6)",
              "rgba(255, 159, 64, 0.6)",
              "rgba(153, 102, 255, 0.6)",
              "rgba(201, 203, 207, 0.6)",
              "rgba(255, 99, 132, 0.6)",
            ],
            borderColor: [
              "rgba(54, 162, 235, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(255, 159, 64, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(201, 203, 207, 1)",
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(255, 159, 64, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(201, 203, 207, 1)",
              "rgba(255, 99, 132, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          title: {
            display: true,
            text: "Biểu đồ thống kê doanh thu theo tháng",
          },
        },
      },
    });
  })
  .catch((error) => {
    console.error("Lỗi khi tải dữ liệu từ API:", error);
  });
