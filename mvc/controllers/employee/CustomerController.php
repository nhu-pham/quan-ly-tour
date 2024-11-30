<?php
require_once "./mvc/controllers/MyController.php";
require_once "./mvc/core/redirect.php";

class CustomerController extends Controller
{
    const limit = 4;
    function __construct()
    {
        
        $this->MyController = new MyController();
        $this->OrderModels = $this->models('OrderModels');
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
        $this->Functions =  $this->helper('Functions');
    }

    public function index() 
    {
        $ordersData = [];
        $searchTerm = "";
        
        $rows = $this->OrderModels->select_array('*');
        $limit = self::limit;
        $page = 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $ordersData = $this->OrderModels->select_array('*',NULL, 'order_date desc',
            $start,$limit
        );
    }
        $button_pagination = $this->Functions->pagination($total_page,$page);   
           
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $searchTerm = trim($_GET['search']);
            $ordersData = $this->OrderModels->search_array('*', ['fullname', 'email', 'phone_number'], $searchTerm, NULL, $start,$limit);
        } else {
            $ordersData = $this->OrderModels->select_array('*',NULL, 'order_date desc',
            $start,$limit
        );
        }   

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $order_id = $_POST['update'];    
            print_r($_POST);
            
            $dataUpdate = [
                'fullname' => trim($_POST['fullname'][$order_id-1]),
                'phone_number' => trim($_POST['phone_number'][$order_id-1]),
                'email' => trim($_POST['email'][$order_id-1]),
            ];     
            
            if (empty($dataUpdate['fullname']) || empty($dataUpdate['phone_number']) || empty($dataUpdate['email'])) {
                $errors[] = "Vui lòng nhập đầy đủ thông tin.";
            }

            if (empty($errors)) {
                $result = $this->OrderModels->update($dataUpdate, ['id' => $order_id]);
                $decodeResults = json_decode($result, true);

                if ($decodeResults['type'] === 'Successfully') {
                    $redirect =  new redirect('employee/customer');
                    $redirect->setFlash('success', 'Cập nhật thông tin thành công!');
                } else {
                    $redirect = new redirect('employee/customer');
                    $redirect->setFlash('error', 'Có lỗi xảy ra khi cập nhật thông tin.');
                }
            } else {
                // Lưu lỗi vào session để hiển thị lại
                $_SESSION['errors'] = $errors;
                $redirect = new redirect('employee/customer');;
                $redirect->setFlash('error', implode(', ', $errors));
            }
        }

        // Lấy dữ liệu khách hàng để hiển thị trên view
        $data = [
            'page' => 'customer',
            'title' => 'Danh sách khách hàng',
            'ordersData' => $ordersData,
            'button_pagination' => $button_pagination,
            'searchTerm' => $searchTerm
        ];
        $this->view('employee/index', $data);
    }

    function pagination_page(){
        $rows = $this->OrderModels->select_array('*');
        $limit = self::limit;
        $page = $_POST['page']?$_POST['page']:1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $ordersData = $this->OrderModels->select_array('*',NULL, 'order_date desc',
            $start,$limit
           );
        }
        $button_pagination = $this->Functions->pagination($total_page,$page); 
        $data = [
            'page' => 'customer',
            'title' => 'Danh sách khách hàng',
            'ordersData' => $ordersData,
            'button_pagination' => $button_pagination,
        ];
        $this->view('employee/customer', $data);
    }
}
