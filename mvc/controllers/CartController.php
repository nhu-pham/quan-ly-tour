<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class CartController extends Controller {
    public $ServiceModels;
    public $TourModels;
    function __construct() {
        $this->MyController = new MyController();
        $this->ServiceModels = $this->models('ServiceModels');
        $this->TourModels = $this->models('TourModels');
    }

    function addCart() {
        $array = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug_service = isset($_POST['slug_service']) ? $_POST['slug_service'] : '';
            $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 0;
    
            // Lấy thông tin dịch vụ từ model
            $service = $this->ServiceModels->select_row('*', ['slug_service' => $slug_service]);
    
            if ($service) {
                // Chuẩn bị dữ liệu để thêm vào giỏ hàng
                $cartItem = [
                    'id' => $service['id'],
                    'slug_service' => $slug_service,
                    'name' => $service['name'],
                    'price' => $service['price'],
                    'image_url'=>$service['image_url'],
                    'qty' => $qty
                ];
    
                // Cập nhật giỏ hàng
                $array = $this->cart($cartItem);

                $cartCount = $this->getCartCount();
                // Trả về kết quả cho AJAX
                echo json_encode(['status' => 'success', 'message' => 'Đã thêm vào giỏ hàng', 'cart' => $array,'cartCount'=>$cartCount]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Dịch vụ không tồn tại']);
            }
        }
    }

    
    // Phương thức cập nhật giỏ hàng
    function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Giải mã dữ liệu giỏ hàng từ JSON
            $rawData = file_get_contents('php://input');
            $cartData = json_decode($rawData, true)['cart'];

            // Xóa giỏ hàng cũ
            $_SESSION['cart'] = [];

            // Thực hiện cập nhật giỏ hàng
            foreach ($cartData as $item) {
                $slug = $item['slug']; 
                $service = $this->ServiceModels->select_row('*', ['slug_service' => $slug]);
                $qty = intval($item['qty']);
    
                if ($service) {
                    // Chuẩn bị dữ liệu để thêm vào giỏ hàng
                    $cartItem = [
                        'id' => $service['id'],
                        'slug_service' => $slug,
                        'name' => $service['name'],
                        'price' => $service['price'],
                        'image_url' => $service['image_url'],
                        'qty' => $qty
                    ];
        
                    // Cập nhật giỏ hàng
                    $_SESSION['cart'][$slug] = $cartItem;
                } else {
                    // Nếu dịch vụ không tồn tại, trả về lỗi
                    echo json_encode(['status' => 'error', 'message' => 'Dịch vụ không tồn tại']);
                    return;
                }
            }

            // Trả về kết quả cho AJAX 
            header('Content-Type: application/json'); 
            echo json_encode(['status' => 'success', 'message' => 'Cập nhật giỏ hàng thành công', 'cart' => $_SESSION['cart']]); 
        }
    }
    
    

    function viewCart($slug) 
    { 
        if (isset($_SESSION['cart'])) 
        { 
            $cart = $_SESSION['cart']; 
        } 
        else 
        { 
            $cart = []; 
        }

        $tour=$this->TourModels->select_array_join_table('categories.name as cate_name, categories.id as cate_id,tours.name as tour_name,slug',['slug'=>$slug],NULL,NULL,NULL,'categories','tours.category_id=categories.id','INNER');

        $data=[
            'page'=>"carts/index",
            'cart'=>$cart,
            'tour'=>$tour,
        ];
        $this->view('user/index',$data);
    }

    function searchService($value){
        if (isset($_SESSION['cart'])) 
        { 
            $cart = $_SESSION['cart']; 
        } 
        else 
        { 
            $cart = []; 
        }
        foreach ($cart as $item){
            
        }
    }

    
}