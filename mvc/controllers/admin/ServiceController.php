<?php
require_once './mvc/models/ServiceModels.php';
require_once "./mvc/core/redirect.php";

class ServiceController extends Controller
{
    protected $serviceModel;
    public $Jwtoken;

    public function __construct()
    {
        $this->serviceModel = new ServiceModels();
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
        $this->Functions =  $this->helper('Functions');
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
        $responseArray = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Error processing update response'
            ]);
            return;
        }
        echo json_encode($responseArray);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only PUT method is allowed'
            ]);
            return;
        }
        if (empty($id) || !is_numeric($id)) {
            echo json_encode([
                'type' => 'Fail',
                'message' => 'Invalid ID provided'
            ]);
            return;
        }
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !is_array($data)) {
            http_response_code(400); // Bad Request
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Invalid input data'
            ]);
            return;
        }
        $where = ['id' => $id];
        $response = $this->serviceModel->update($data, $where);
        $responseArray = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Error processing update response'
            ]);
            return;
        }
        echo json_encode($responseArray);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only DELETE method is allowed'
            ]);
            return;
        }
        $response = $this->serviceModel->delete(['id' => $id]);
        $responseArray = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Error processing update response'
            ]);
            return;
        }
        echo json_encode($responseArray);
    }

    public function search() {
        
        $data = json_decode(file_get_contents("php://input"), true);

        $keyword = $data['keyword'] ?? null;
        $start = isset($data['start']) ? (int)$data['start'] : 0;
        $limit = isset($data['limit']) ? (int)$data['limit'] : 10;
        $orderby = isset($data['orderby']) ? $data['orderby'] : null;

        $response = $this->serviceModel->search_services($keyword, $orderby, $limit, $start);

        if ($response === false) {
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Error fetching data from the database'
            ]);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }



    public function searchByKeyword() {
        // Lấy dữ liệu từ body JSON
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Kiểm tra và gán giá trị cho $searchField và $searchFields
        $searchField = isset($data['searchField']) ? $data['searchField'] : ''; // Lấy trường cần tìm
        $searchFields = isset($data['searchField']) ? [$searchField] : null; // Nếu có searchField, truyền vào mảng
    
        $keyword = isset($data['keyword']) ? $data['keyword'] : '';
        
        // Kiểm tra và gán giá trị cho $orderby
        $orderby = isset($data['orderby']) ? $data['orderby'] : null;
    
        // Kiểm tra và gán giá trị cho $limit và $start
        $limit = isset($data['limit']) ? (int)$data['limit'] : 10;
        $start = isset($data['start']) ? (int)$data['start'] : 0;
    
        // Lấy các trường mặc định (tất cả các trường) nếu không có searchField
        if (!$searchFields) {
            $searchFields = ['name', 'price', 'service_category_id'];
        }
        // Kiểm tra xem có searchField hay không, nếu có thì chỉ tìm kiếm trong trường đó
        $result = $this->serviceModel->searchByKeyword($keyword, $searchFields, $orderby, $limit, $start);
        // Trả về kết quả dưới dạng JSON
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    
    public function fetchAll() {
        if (isset($_SESSION['user']) && isset($_SESSION['admin'])) {
            $verify = $this->Jwtoken->decodeToken($_SESSION['user'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if (!$auth) {
                    $redirect = new redirect('auth/login');
                }
            }
        } else {
            $redirect = new redirect('auth/login');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only GET method is allowed'
            ]);
            return;
        }
        $data = $this->serviceModel->fetchAll();
        header('Content-Type: application/json');
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            http_response_code(404); // Not Found
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'No data found'
            ]);
        }
    }

    public function index()
    {
        $this->view('admin/index', [
            'page' => 'service/index'
        ]);
    }

    public function count() {
        // Lấy số lượng bản ghi từ model
        $amount = $this->serviceModel->countItems();
        
        // Định dạng và trả về dữ liệu JSON
        header('Content-Type: application/json'); // Đặt header Content-Type là JSON
        echo json_encode(['amount' => $amount]); // Trả về JSON
    }
    
}
