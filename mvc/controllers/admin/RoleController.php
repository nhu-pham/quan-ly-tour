
<?php
require_once "./mvc/core/redirect.php";

class RoleController extends Controller
{
    function __construct()
    {
        $this->UserModels = $this->models('UserModels');
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
    }

    public function index()
    {
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
        $data = $this->UserModels->select_array('*');

        $data = [
            'page' => 'role/index',
            'data' => $data,

        ];
        $this->view('admin/index', $data);
    }

    public function add()
    {
        header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            $fullname = $data["fullname"];
            $role = $data["position"];
            if ($role == "Quản lý") {
                $role_id = 4;
            } elseif ($role == "Nhân viên") {
                $role_id = 3;
            } elseif ($role == "Admin") {
                $role_id = 2;
            } else {
                $role_id = 1;
            }

            $dataInsert = [
                'fullname' => $fullname,
                'role_id' => $role_id,
            ];

            $result = $this->UserModels->add($dataInsert);
            $decodeResults = json_decode($result, true);
            if ($decodeResults['type'] === 'Sucessfully') {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false]);
            }
        }
    }

    public function update()
    {
        header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            $userId = $data["id"];
            $fullname = $data["fullname"];
            $role = $data["position"];

            if ($role == "Quản lý") {
                $role_id = 4;
            } elseif ($role == "Nhân viên") {
                $role_id = 3;
            } elseif ($role == "Admin") {
                $role_id = 2;
            } else {
                $role_id = 1;
            }

            $user = $this->UserModels->select_row('*', ['id' => $userId]);
            if ($user) {
                $dataUpdate = [
                    'fullname' => $fullname,
                    'role_id' => $role_id,
                ];
                $result = $this->UserModels->update($dataUpdate, ['id' => $userId]);
            }
            $decodeResults = json_decode($result, true);
            if ($decodeResults['type'] === 'Sucessfully') {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false]);
            }
        }
    }

    public function delete()
    {
        header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            $userId = $data["id"];
            $user = $this->UserModels->select_row('*', ['id' => $userId]);
            if ($user) {
                $result = $this->UserModels->delete(['id' => $userId]);
            }

            $decodeResults = json_decode($result, true);
            if ($decodeResults['type'] === 'Sucessfully') {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false]);
            }
        }
    }

    public function search() {
    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchQuery"])) {
        $searchTerm = trim($_POST["searchQuery"]);
        $searchFields = ['fullname', 'role_id'];
        $data = $this->UserModels->search_array('*', $searchFields, $searchTerm);

        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
}
}
