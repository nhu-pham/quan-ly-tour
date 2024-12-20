<?php
require_once './mvc/models/TourModels.php';
require_once "./mvc/core/redirect.php";
//header('Content-Type: application/json; charset=UTF-8');

class TourController extends Controller
{
    protected $tourModel;
    public $Jwtoken;

    public function __construct()
    {
        $this->tourModel = new TourModels();
        $this->Jwtoken =  $this->helper('Jwtoken');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); 
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only POST method is allowed'
            ]);
            return;
        }
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !is_array($data)) {
            http_response_code(400);
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Invalid input data'
            ]);
            return;
        }

        $response = $this->tourModel->add($data);
        echo $response;
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only POST method is allowed'
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

        // Kiểm tra điều kiện WHERE để xác định bản ghi cần cập nhật (thường là ID)
        // if (!isset($data['id']) || empty($data['id'])) {
        //     http_response_code(400); // Bad Request
        //     echo json_encode([
        //         'type'    => 'Fail',
        //         'message' => 'ID is required for update'
        //     ]);
        //     return;
        // } // test vs URL ko truyền ID, mà lấy ID từ boy JSON

        // Chuyển ID thành mảng điều kiện
        $where = ['id' => $id];

        // Gọi model update
        $response = $this->tourModel->update($data, $where);
        echo $response;

        // Gọi phương thức update từ TourModel
        // $response = $this->tourModel->update($data, ['id' => $data['id']]);
        // echo $response;
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $response = $this->tourModel->delete(['id' => $id]);
            echo $response;
        } else {
            echo json_encode([
                'type' => 'Fail',
                'message' => 'Invalid request method'
            ]);
        }
    }

    public function searchTours()
    {
        // Lấy các tham số tìm kiếm từ query string
        // $tourCode = isset($_GET['tour_code']) ? $_GET['tour_code'] : null;
        // $tourName = isset($_GET['tour_name']) ? $_GET['tour_name'] : null;
        // $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;

        $data = json_decode(file_get_contents('php://input'), true);
        $tourCode = isset($data['id']) ? $data['id'] : null;
        $tourName = isset($data['name']) ? $data['name'] : null;
        $startDate = isset($data['date_start']) ? $data['date_start'] : null;

        // Gọi phương thức search từ TourModel để tìm kiếm một bản ghi duy nhất
        $tour = $this->tourModel->search($tourCode, $tourName, $startDate);

        // Kiểm tra kết quả trả về
        if ($tour) {
            echo json_encode([
                'type'    => 'Success',
                'message' => 'Tour found',
                'data'    => $tour // Trả về dữ liệu của tour
            ], JSON_UNESCAPED_UNICODE); // Để giữ ký tự tiếng Việt
        } else {
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'No tour found matching your criteria'
            ]);
        }
    }

    public function search() {
        
        $data = json_decode(file_get_contents("php://input"), true);

        $keyword = $data['keyword'] ?? null;
        $start = isset($data['start']) ? (int)$data['start'] : 0;
        $limit = isset($data['limit']) ? (int)$data['limit'] : 10;
        $orderby = isset($data['orderby']) ? $data['orderby'] : null;

        $response = $this->tourModel->search_tours($keyword, $orderby, $limit, $start);

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


    public function searchWithFilters() {

        $data = json_decode(file_get_contents("php://input"), true);
        
        // Lấy các tham số tìm kiếm từ dữ liệu JSON
        $tourId = isset($data['tour_id']) ? $data['tour_id'] : null;
        $tourName = isset($data['tour_name']) ? $data['tour_name'] : null;
        $startDate = isset($data['start_date']) ? $data['start_date'] : null;
        $orderby = isset($data['orderby']) ? $data['orderby'] : null;
        $limit = isset($data['limit']) ? $data['limit'] : 10;
        $start = isset($data['start']) ? $data['start'] : 0;
        
        $tours = $this->tourModel->searchToursWithFilters($tourId, $tourName, $startDate, $orderby, $limit, $start);
        
        echo json_encode(['type' => 'Success', 'data' => $tours], JSON_UNESCAPED_UNICODE);
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
            $searchFields = ['name', 'price', 'destination', 'pick_up', 'duration', 'itinerary', 'date_start', 'description', 'category_id'];
        }
        // Kiểm tra xem có searchField hay không, nếu có thì chỉ tìm kiếm trong trường đó
        $tours = $this->tourModel->searchToursByKeyword($keyword, $searchFields, $orderby, $limit, $start);
        // Trả về kết quả dưới dạng JSON
        echo json_encode($tours, JSON_UNESCAPED_UNICODE);
    }

    public function index()
    {
        $this->view('manager/index', [
            'page' => 'tour/index'
        ]);
    }

    public function fetchAll() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only GET method is allowed'
            ]);
            return;
        }
        $data = $this->tourModel->fetchAll();
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
    
}
