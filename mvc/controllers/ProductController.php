<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class ProductController extends Controller{

    public $MyModels;
    public $TourModels;
    public $CategoryModels;
    public $OrderModels;
    public $OrderDetailModels;


    function __construct()
    {
        $this->MyModels = $this->models('MyModels');
        $this->TourModels = $this->models('TourModels');
        $this->CategoryModels=$this->models('CategoryModels');
        $this->OrderModels=$this->models('OrderModels');
        $this->OrderDetailModels=$this->models('OrderDetailModels');
        $this->MyController = new MyController();
    }
    function detail($slug){
        // Sử dụng select_row thay vì select_array để lấy một hàng
        $data= $this->MyController->indexCustomers();
        $detail_tour = $this->TourModels->select_row('*', ['slug' => $slug]);
        $review_tour=$this->TourModels->select_array_join_table('reviews.rating, reviews.note',['slug'=>$slug],NULL,NULL,NULL,'reviews','reviews.tour_id=tours.id','INNER');
        $category=$this->TourModels->select_array_join_table('categories.name, categories.id as cate_id',['slug'=>$slug],NULL,NULL,NULL,'categories','tours.category_id=categories.id','INNER');
        $data=[
            'page'=>'product/detail',
            'details'=>$detail_tour,
            'reviews'=>$review_tour,
            'category'=>$category,
            'data' => $data
        ];
        $this->view('user/index', $data);
    }

    function buy($slug){
        
        // Sử dụng select_row thay vì select_array để lấy một hàng
        $detail_tour = $this->TourModels->select_row('*', ['slug' => $slug]);
        $review_tour=$this->TourModels->select_array_join_table('reviews.rating, reviews.note',['slug'=>$slug],NULL,NULL,NULL,'reviews','reviews.tour_id=tours.id','INNER');
        $category=$this->TourModels->select_array_join_table('categories.name, categories.id as cate_id',['slug'=>$slug],NULL,NULL,NULL,'categories','tours.category_id=categories.id','INNER');
        
        $qty = 0;
        $price=0;
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = [];
        }
        foreach ($cart as $item) {
            $qty += $item['qty'];
            $price +=$item['price']*$item['qty'];
        }

        $data=[
            'page'=>'buying/datngay',
            'slug'=>$slug,
            'details'=>$detail_tour,
            'reviews'=>$review_tour,
            'category'=>$category,
            'price_service'=>$price,
            'qty'=>$qty
        ];
        $this->view('user/index', $data);
    }
    function tours(){
        $data= $this->MyController->indexCustomers();
        $this->MyController = new MyController();
        $tours_db = $this->TourModels->select_array('*', ['category_id'=>4], NULL, NULL, 4);
        $tours_mn = $this->TourModels->select_array('*', ['category_id'=>1], NULL, NULL, 4);
        $tours_mb = $this->TourModels->select_array('*', ['category_id'=>2], NULL, NULL, 4);
        $tours_mt = $this->TourModels->select_array('*', ['category_id'=>3], NULL, NULL, 4);
        $data = [
            'page' => 'product/tour',
            'tours_db' => $tours_db,
            'tours_mn' => $tours_mn,
            'tours_mb' => $tours_mb,
            'tours_mt' => $tours_mt,
            'data' => $data
        ];
        $this->view("user/index", $data);
    }

    function payment($slug){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nhận dữ liệu thô từ PHP input
            $rawData = file_get_contents('php://input');
            // Giải mã dữ liệu JSON thành mảng
            $orderData = json_decode($rawData, true);
    
            // Lưu trữ dữ liệu vào cơ sở dữ liệu
            $name = $orderData['name'];
            $date = $orderData['date'];
            $phone = $orderData['phone'];
            $email = $orderData['email'];
            $address = $orderData['address'];
            $gender = $orderData['gender'];
            $quantity = $orderData['quantity'];
            $tourPrice= $orderData['tourPrice'];
            $totalPrice=$orderData['totalPrice'];
    
            $tour_id = $this->TourModels->select_row('id', ['slug' => $slug]);
    
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    
            $arrayOrders = [
                'user_id'           => $this->MyController->getUsers()['id'],
                'tour_id'           => $tour_id['id'],
                'fullname'          => $name,
                'gender'            => $gender,
                'birthday'          => $date,
                'email'             => $email,
                'phone_number'      => $phone,
                'address'           => $address,
                'number_of_people'  => $quantity,
                'order_date'        => gmdate('Y-m-d H:i:s', time() + 7*3600),
                'status'            => 'pending',
                'total_money'       => $totalPrice,
                'active'            => '1'
            ];
    
            $find = $this->OrderModels->select_row('id', [
                'user_id'           => $this->MyController->getUsers()['id'],
                'tour_id'           => $tour_id['id'],
                'fullname'          => $name,
                'gender'            => $gender,
                'birthday'          => $date,
                'email'             => $email,
                'phone_number'      => $phone,
                'address'           => $address,
                'number_of_people'  => $quantity,
                'status'            => 'pending',
                'total_money'       => $totalPrice
            ]);
    
            if($find['id'] == NULL){
                $orderAdd = $this->OrderModels->add($arrayOrders);
                $resultsOrders = json_decode($orderAdd, true);
                if($resultsOrders['type'] === 'Sucessfully'){
                    $arrayOrderDetail = [];
                    // Thêm chi tiết đơn hàng từ giỏ hàng nếu có
                    foreach ($cart as $value) {
                        array_push($arrayOrderDetail, [
                            'order_id'           => $resultsOrders['id'],
                            'tour_id'            => $tour_id['id'],
                            'tour_price'         => $tourPrice,
                            'number_of_people'   => $quantity,
                            'total_money_tour'   => $totalPrice,
                            'service_id'         => $value['id'],
                            'service_price'      => $value['price'],
                            'number_of_services' => $value['qty'],
                            'total_money_service'=> $value['price'] * $value['qty']
                        ]);
                    }
    
                    // Thêm chi tiết đơn hàng mặc định nếu giỏ hàng trống
                    if (empty($arrayOrderDetail)) {
                        array_push($arrayOrderDetail, [
                            'order_id'           => $resultsOrders['id'],
                            'tour_id'            => $tour_id['id'],
                            'tour_price'         => $tourPrice,
                            'number_of_people'   => $quantity,
                            'total_money_tour'   => $totalPrice
                        ]);
                    }
                    $this->OrderDetailModels->addMultiple($arrayOrderDetail);
                    unset($_SESSION['cart']);
    
                    print_r("Đặt hàng thành công!");
                }
            }
        }
    }
    

    function detailPayment(){
        $user_id= $this->MyController->getUsers()['id']; //Lấy ra id user
       
        $order = $this->OrderModels->select_max_fields('id',['user_id'=>$user_id]); //Lấy ra id của order
       
        $order_value=$this->OrderModels->select_array_join_table('total_money,tours.name as tour_name, category_id, slug',['orders.id'=>$order['sort']],NULL,NULL,NULL,'tours','tours.id=orders.tour_id','INNER');
       
        $category=$this->CategoryModels->select_row('name',['id'=>$order_value[0]['category_id']]);
      
        $data=[
            'page' => 'buying/payment',
            'total_money'=>$order_value[0]['total_money'],
            'tour_name'=>$order_value[0]['tour_name'],
            'category_id'=>$order_value[0]['category_id'],
            'cate_name'=>$category['name'],
            'slug'=>$order_value[0]['slug'],
            
        ];
        $this->view("user/index", $data);

    }
}