<?php
require_once './mvc/models/ServiceModel.php';
class ServiceController extends Controller
{
    protected $serviceModel;
    public $Jwtoken;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->Jwtoken             =  $this->helper('Jwtoken');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only POST method is allowed'
            ]);
            return;
        }

        // Đọc dữ liệu từ body của request
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !is_array($data)) {
            http_response_code(400); // Bad Request
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Invalid input data'
            ]);
            return;
        }

        $response = $this->serviceModel->add($data);
        echo $response;
    }

    
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only PUT or PATCH method is allowed'
            ]);
            return;
        }

        // Kiểm tra ID hợp lệ
        if (empty($id) || !is_numeric($id)) {
            echo json_encode([
                'type' => 'Fail',
                'message' => 'Invalid ID provided'
            ]);
            return;
        }

        // Đọc dữ liệu từ body của request
        $data = json_decode(file_get_contents("php://input"), true);

        // Kiểm tra dữ liệu đầu vào
        if (!$data || !is_array($data)) {
            http_response_code(400); // Bad Request
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Invalid input data'
            ]);
            return;
        }

        // Chuyển ID thành mảng điều kiện
        $where = ['id' => $id];

        // Gọi model update
        $response = $this->serviceModel->update($data, $where);
        echo $response;

    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $response = $this->serviceModel->delete(['id' => $id]);
            echo $response;
        } else {
            echo json_encode([
                'type' => 'Fail',
                'message' => 'Invalid request method'
            ]);
        }
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only GET method is allowed'
            ]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        
        $service_id = $data['id'] ?? null;
        $service_name = $data['name'] ?? null;
        $category = $data['service_categories.name'] ?? null;
        $orderby = $data['orderby'] ?? null;
        $limit = $data['limit'] ?? null;

        // Gọi phương thức trong model để lấy doanh thu
        $Service = $this->serviceModel->search_services($service_id, $service_name, $category, $orderby, $limit);

        
        // Trả kết quả dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode(['totalService' => $Service]);
    }

}
?>


