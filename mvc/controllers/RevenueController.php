<?php
require_once './mvc/models/RevenueModel.php';


class RevenueController extends Controller{
    
    protected $revenueModel;

    public function __construct() {
        // Giả sử model được gọi là RevenueModel hoặc tương tự
        $this->revenueModel = new RevenueModel();
    }

    // Thống kê tổng doanh thu trong khoảng thời gian
    public function getRevenueStatistics() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only GET method is allowed'
            ]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        
        $startDate = $data['startDate'] ?? null;
        $endDate = $data['endDate'] ?? null;
        $status = $data['status'] ?? null;
        $orderby = $data['orderby'] ?? null;
        $limit = $data['limit'] ?? null;

        // Gọi phương thức trong model để lấy doanh thu
        $revenue = $this->revenueModel->get_revenue_statistics($startDate, $endDate, $status, $orderby, $limit);

        // Trả kết quả dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode(['totalRevenue' => $revenue]);
    }

    // Thống kê doanh thu theo tháng
    public function getMonthlyRevenue() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only GET method is allowed'
            ]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        
        $startMonth = $data['startMonth'] ?? null;
        $endMonth = $data['endMonth'] ?? null;

        // Gọi phương thức trong model để lấy doanh thu theo tháng
        $monthlyRevenue = $this->revenueModel->get_monthly_revenue($startMonth, $endMonth);

        // Trả kết quả dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode(['monthlyRevenue' => $monthlyRevenue]);
    }
}

?>