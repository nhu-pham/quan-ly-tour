<?php
require_once './mvc/models/RevenueModels.php';
require_once './mvc/models/TourModels.php';
require_once './mvc/models/ServiceModels.php';
require_once './mvc/models/ReviewModels.php';
require_once "./mvc/core/redirect.php";

class RevenueController extends Controller{
    
    protected $revenueModel;
    protected $tourModel;
    protected $serviceModel;
    protected $reviewModel;

    public function __construct() {
        // Khởi tạo các model
        $this->revenueModel = new RevenueModels();
        $this->tourModel = new TourModels();
        $this->serviceModel = new ServiceModels();
        $this->reviewModel = new ReviewModels();
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
        $this->Functions =  $this->helper('Functions');
    }

    // Thống kê tổng doanh thu trong khoảng thời gian
    public function getRevenueStatistics() {
        // if (isset($_SESSION['user']) && isset($_SESSION['admin'])) {
        //     $verify = $this->Jwtoken->decodeToken($_SESSION['user'], KEYS);
        //     if ($verify != NULL && $verify != 0) {
        //         $auth = $this->Authorzation->checkAuth($verify);
        //         if (!$auth) {
        //             $redirect = new redirect('auth/login');
        //         }
        //     }
        // } else {
        //     $redirect = new redirect('auth/login');
        // }

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

    public function getRevenue() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only POST method is allowed'
            ]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        
        $month = $data['month'] ?? null;
        $status = $data['status'] ?? null;
        $orderby = $data['orderby'] ?? null;
        $limit = $data['limit'] ?? null;

        // Gọi phương thức trong model để lấy doanh thu
        $revenue = $this->revenueModel->get_revenue($month, $status, $orderby, $limit);

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
        echo json_encode($monthlyRevenue);
    }


    public function getTotalTours1() {
        $result = $this->revenueModel->getTotalTours();
        echo json_encode([
            'type' => 'Success', 
            'data' => $result], 
            JSON_UNESCAPED_UNICODE
        );
    }

    public function index() {
        $revenue = $this->revenueModel->get_revenue();
        $tourAmount = $this->tourModel->countItems();
        $serviceAmount = $this->serviceModel->countItems();
        $reviewAmount = $this->reviewModel->countItems();  
        $this->view('admin/index', [
            'page' => 'statistic/trangchu',
            'tour_revenue' => $revenue,
            'tour_amount' => $tourAmount,
            'service_amount' => $serviceAmount,
            'review_amount' => $reviewAmount
        ]);
    }
}
?>