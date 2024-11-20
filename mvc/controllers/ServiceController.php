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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);

            if ($data) {
                //var_dump($data);
                $response = $this->serviceModel->add($data, 'name');
                echo $response;
                // // Redirect to avoid duplicate POST requests
                // header("Location: /success-page");
                // exit();
            } else {
                echo json_encode([
                    'type' => 'Fail',
                    'message' => 'Invalid input data'
                ]);
            }
        }
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $services = $this->serviceModel->select_row('name', ['id' => 3]);
            echo json_encode($services, JSON_UNESCAPED_UNICODE);
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // Kiểm tra ID hợp lệ
            if (empty($id) || !is_numeric($id)) {
                echo json_encode([
                    'type' => 'Fail',
                    'message' => 'Invalid ID provided'
                ]);
                return;
            }

            // Lấy dữ liệu JSON từ body
            $data = json_decode(file_get_contents("php://input"), true);

            // Kiểm tra dữ liệu JSON hợp lệ
            if (!$data || !is_array($data)) {
                echo json_encode([
                    'type' => 'Fail',
                    'message' => 'Invalid input data'
                ]);
                return;
            }

            // Chuyển ID thành mảng điều kiện
            $where = ['id' => $id];

            // Gọi model update
            $response = $this->serviceModel->update($data, $where);
            echo $response;
        } else {
            echo json_encode([
                'type' => 'Fail',
                'message' => 'Invalid request method'
            ]);
        }
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

}
?>


