<?php
require_once "./mvc/models/ReviewModels.php";
require_once "./mvc/core/redirect.php";

class ReviewController extends Controller {
    protected $reviewModel;

    public function __construct() {
        $this->reviewModel = new ReviewModels();
    }

     // Phương thức tìm kiếm đánh giá theo tên và email khách hàng
    public function searchReviews() {
        header('Content-Type: application/json; charset=UTF-8');
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode([
                'type'    => 'Fail',
                'message' => 'Only GET method is allowed'
            ]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        $fullname = isset($data['fullname']) ? $data['fullname'] : null;
        $email = isset($data['email']) ? $data['email'] : null;

        $reviews = $this->reviewModel->searchReviewsByCustomer($fullname, $email);

        if ($reviews) {
            echo json_encode($reviews
            , JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'status' => 'fail',
                'message' => 'No reviews found'
            ]);
        }
    }

    public function search() {
        
        $data = json_decode(file_get_contents("php://input"), true);

        $keyword = $data['keyword'] ?? null;
        $start = isset($data['start']) ? (int)$data['start'] : 0;
        $limit = isset($data['limit']) ? (int)$data['limit'] : 10;
        $orderby = isset($data['orderby']) ? $data['orderby'] : null;

        $response = $this->reviewModel->search_reviews($keyword, $orderby, $limit, $start);

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

        $response = $this->reviewModel->add($data);
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
        $response = $this->reviewModel->update($data, $where);
        echo $response;

        // Gọi phương thức update từ reviewModel
        // $response = $this->reviewModel->update($data, ['id' => $data['id']]);
        // echo $response;
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $response = $this->reviewModel->delete(['id' => $id]);
            echo $response;
        } else {
            echo json_encode([
                'type' => 'Fail',
                'message' => 'Invalid request method'
            ]);
        }
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
        $data = $this->reviewModel->fetchAll();
        header('Content-Type: application/json');
        if (!empty($data)) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
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
        $this->view('manager/index', [
            'page' => 'review/index'
        ]);
    }

    public function count() {
        // Lấy số lượng bản ghi từ model
        $amount = $this->reviewModel->countItems();
        
        // Định dạng và trả về dữ liệu JSON
        header('Content-Type: application/json'); // Đặt header Content-Type là JSON
        echo json_encode(['amount' => $amount]); // Trả về JSON
    }
}
?>