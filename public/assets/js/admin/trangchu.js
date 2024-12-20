// Biểu đồ thống kê doanh thu
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
  type: 'bar',
  data: {
    labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
    datasets: [{
      label: 'Doanh thu (triệu VNĐ)',
      data: [500, 800, 600, 900, 750, 950, 1100, 1050, 980, 870, 760, 890],
      backgroundColor: [
        'rgba(54, 162, 235, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(201, 203, 207, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(201, 203, 207, 0.6)',
        'rgba(255, 99, 132, 0.6)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(201, 203, 207, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(201, 203, 207, 1)',
        'rgba(255, 99, 132, 1)',
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Biểu đồ thống kê doanh thu 12 tháng'
      }
    }
  }
});

// Biểu đồ thống kê dịch vụ
const serviceCtx = document.getElementById('serviceChart').getContext('2d');
new Chart(serviceCtx, {
  type: 'doughnut',
  data: {
    labels: ['Xe máy', 'Xe ô tô', 'Combo cắm trại'],
    datasets: [{
      label: 'Dịch vụ',
      data: [35, 30, 35],
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false, // Disable aspect ratio
    plugins: {
      legend: {
        position: 'bottom',
      },
      title: {
        display: true,
        text: 'Biểu đồ thống kê dịch vụ'
      }
    }
  }
});
// Dữ liệu bảng thống kê tour nổi bật trong tháng
const tours = [
    { id: 'M01', name: 'Hà Nội - Hải Phòng', registrations: 88 },
    { id: 'M02', name: 'Điện Biên - Sơn La', registrations: 76 },
    { id: 'M03', name: 'Sài Gòn - Vũng Tàu', registrations: 65 },
    { id: 'M04', name: 'Đà Nẵng - Huế', registrations: 72 },
    { id: 'M05', name: 'Nha Trang - Đà Lạt', registrations: 90 },
    { id: 'M06', name: 'Cần Thơ - Phú Quốc', registrations: 85 },
  ];
  
  // Hàm render dữ liệu vào bảng
  function renderTourTable() {
    const tableBody = document.getElementById('tourTableBody');
    tableBody.innerHTML = ''; // Xóa dữ liệu cũ
  
    tours.forEach((tour, index) => {
      const row = `
        <tr>
          <td>${index + 1}</td>
          <td>${tour.id}</td>
          <td>${tour.name}</td>
          <td>${tour.registrations}</td>
        </tr>
      `;
      tableBody.insertAdjacentHTML('beforeend', row);
    });
  }
  
  // Gọi hàm render khi trang được load
  document.addEventListener('DOMContentLoaded', renderTourTable);
  
  const comparisonCards = document.querySelectorAll('.comparison-card small');
  comparisonCards.forEach(small => {
    if (small.innerText.includes('Tăng')) {
      small.classList.add('increase');
    }
  });
  