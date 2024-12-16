let charts = {}; // Lưu trữ các instance của biểu đồ

function destroyChart(chartId) {
    if (charts[chartId]) {
        charts[chartId].destroy(); // Hủy biểu đồ cũ nếu đã tồn tại
    }
}

function renderCharts() {
    // Cấu hình chung cho biểu đồ
    const chartOptions = {
        responsive: true,
        plugins: {
            legend: { display: true, position: 'top' },
            datalabels: {
                color: 'black',
                anchor: 'end',
                align: 'top',
                formatter: value => value // Hiển thị giá trị trên cột
            },
            title: {
                display: true,
                font: { size: 18, weight: 'bold' },
                color: 'black'
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    };

    // Hủy các biểu đồ cũ trước khi render
    destroyChart('revenueChart');
    destroyChart('reviewsChart');
    destroyChart('toursChart');
    destroyChart('servicesChart');

    // Biểu đồ Doanh thu (12 tháng)
    const revenueData = {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
            label: 'Doanh thu (triệu VND)',
            data: [120, 150, 180, 200, 170, 190, 210, 230, 250, 270, 290, 310],
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 3,
            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            pointRadius: 5,
            fill: false,
            tension: 0.3
        }]
    };
    charts['revenueChart'] = new Chart(document.getElementById('revenueChart'), { 
        type: 'line', 
        data: revenueData, 
        options: { ...chartOptions, plugins: { ...chartOptions.plugins, title: { ...chartOptions.plugins.title, text: 'Thống kê Doanh thu' } } } 
    });

    // Biểu đồ Nhận xét tour
    const reviewsData = {
        labels: ['Tour A', 'Tour B', 'Tour C'],
        datasets: [{
            label: 'Nhận xét',
            data: [4.5, 4.0, 3.8],
            backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(255, 206, 86, 0.8)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 206, 86, 1)'],
            borderWidth: 3
        }]
    };
    charts['reviewsChart'] = new Chart(document.getElementById('reviewsChart'), { 
        type: 'bar', 
        data: reviewsData, 
        options: { ...chartOptions, plugins: { ...chartOptions.plugins, title: { ...chartOptions.plugins.title, text: 'Thống kê Nhận xét tour' } } } 
    });

    // Biểu đồ Số lượng tour (theo miền)
    const toursData = {
        labels: ['Miền Bắc', 'Miền Trung', 'Miền Nam'],
        datasets: [{
            label: 'Số lượng Tour',
            data: [10, 15, 8],
            backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
            borderWidth: 3
        }]
    };
    charts['toursChart'] = new Chart(document.getElementById('toursChart'), { 
        type: 'bar', 
        data: toursData, 
        options: { ...chartOptions, plugins: { ...chartOptions.plugins, title: { ...chartOptions.plugins.title, text: 'Thống kê Số lượng tour du lịch' } } } 
    });

    // Biểu đồ Dịch vụ (biểu đồ tròn)
    const servicesData = {
        labels: ['Xe máy', 'Ô tô', 'Combo cắm trại'],
        datasets: [{
            label: 'Số lượng Dịch vụ',
            data: [5, 7, 9],
            backgroundColor: ['rgba(255, 159, 64, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)'],
            borderColor: 'white',
            borderWidth: 3
        }]
    };
    charts['servicesChart'] = new Chart(document.getElementById('servicesChart'), { 
        type: 'pie', 
        data: servicesData, 
        options: { ...chartOptions, plugins: { ...chartOptions.plugins, title: { ...chartOptions.plugins.title, text: 'Thống kê Dịch vụ' } } } 
    });
}

// Điều khiển hiển thị từng phần
function showSection(sectionId) {
    // Ẩn tất cả các phần
    document.querySelectorAll('.content > div').forEach(div => div.style.display = 'none');
    // Hiển thị phần được chọn
    document.getElementById(sectionId).style.display = 'block';

    // Render biểu đồ khi vào phần thống kê
    if (sectionId === 'statistics') {
        renderCharts();
    }
}

// Gọi hàm khi DOM được tải
document.addEventListener('DOMContentLoaded', function() {
    showSection('tours'); // Hiển thị mặc định phần "Tours"
});