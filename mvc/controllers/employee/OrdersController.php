<?php
require_once "./mvc/controllers/MyController.php";
require_once "./mvc/core/redirect.php";

class OrdersController extends Controller
{
    public $ordersData;
    var $template = 'employee/orders';
    const limit = 1;
    const type = 1;
    function __construct()
    {
        $this->MyController = new MyController();
        $this->OrderModels = $this->models('OrderModels');
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
        $this->Functions =  $this->helper('Functions');
        $this->SendMail            =  $this->helper('SendMail');

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
            $ordersData = $this->OrderModels->select_array_join_table('orders.*, tours.name as name',NULL,'order_date desc',
            $start,$limit,
            'tours','orders.tour_id = tours.id', 'LEFT'
        );
    }
        $button_pagination = $this->Functions->pagination($total_page,$page);   

        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $searchTerm = trim($_GET['search']);
            $ordersData = $this->OrderModels->search_array_join_table('*, tours.name as name', ['id','tours.name', 'status', 'fullname', 'email', 'phone_number'], $searchTerm, NULL, 'order_date desc',
            $start,$limit,
            'tours','orders.tour_id = tours.id', 'LEFT'
        );
        } else {
            $ordersData = $this->OrderModels->select_array_join_table('orders.*, tours.name as name',NULL,'order_date desc',
            $start,$limit,
            'tours','orders.tour_id = tours.id', 'LEFT'
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $order_id = $_POST['edit'];
            
            $dataUpdate = [
                'fullname' => trim($_POST['fullname'][$order_id-1]),
                'phone_number' => trim($_POST['phone_number'][$order_id-1]),
                'email' => trim($_POST['email'][$order_id-1]),
                'gender' => trim($_POST['gender'][$order_id-1]),
                'address' => trim($_POST['address'][$order_id-1]),
                'number_of_adults' => trim($_POST['number_of_adults'][$order_id-1]),
                'number_of_children' => trim($_POST['number_of_children'][$order_id-1]),
            ];
            
            if (empty($dataUpdate['fullname']) || empty($dataUpdate['phone_number']) || empty($dataUpdate['email']
            || empty($dataUpdate['gender']) || empty($dataUpdate['address'])
            || empty($dataUpdate['number_of_adults']) || empty($dataUpdate['number_of_children']))) {
                $errors[] = "Vui lòng nhập đầy đủ thông tin.";
            }

            if (empty($errors)) {
                $result = $this->OrderModels->update($dataUpdate, ['id' => $order_id]);
                $decodeResults = json_decode($result, true);

                if ($decodeResults['type'] === 'Successfully') {
                    $redirect =  new redirect('employee/orders');
                    $redirect->setFlash('success', 'Cập nhật thông tin thành công!');
                } else {
                    $redirect = new redirect('employee/orders');
                    $redirect->setFlash('error', 'Có lỗi xảy ra khi cập nhật thông tin.');
                }
            } else {
                // Lưu lỗi vào session để hiển thị lại
                $_SESSION['errors'] = $errors;
                $redirect = new redirect('employee/orders');
                $redirect->setFlash('error', implode(', ', $errors));
            }
        } 
        }          
        $data = [
            'page' => 'orders',
            'title' => 'Danh sách đơn hàng', 
            'ordersData' => $ordersData,
            'button_pagination' => $button_pagination,
            'searchTerm' => $searchTerm
            // 'checkStatus' => $this->Functions
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
            $ordersData = $this->OrderModels->select_array_join_table('orders.*, tours.name as name',NULL,'order_date desc',
            $start,$limit,
            'tours','orders.tour_id = tours.id', 'LEFT'
           );
        }
        $button_pagination = $this->Functions->pagination($total_page,$page); 
        $data = [
            'page' => 'customer',
            'title' => 'Danh sách đơn hàng',
            'ordersData' => $ordersData,
            'button_pagination' => $button_pagination,
        ];
        $this->view('employee/orders', $data);
    }

    function confirm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $updated = $this->OrderModels->update(['status' => 'completed'], ['id' => $id]);
                $decodeResults = json_decode($updated, true);
    
                if ($decodeResults['type'] === 'Sucessfully') {
                    $subject = 'Xác nhận đơn hàng';
                    $content = 'Chào bạn'.'<br>';
                    $content .= 'Bạn đã đặt tour thành công '.'<br>';
                    $content .= 'Trân trọng cảm ơn!';

                    $sendEmail = $this->SendMail->send($subject, $email, $content);
                    if($sendEmail) {
                        echo json_encode(['success' => false]);
                    } 
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
            }
        }
    }
    
}
