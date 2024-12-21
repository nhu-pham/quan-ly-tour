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
            'category'=>$category
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
        ];
        $this->view("user/index", $data);
    }

    function payment($slug){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nhận dữ liệu thô từ PHP input
            $rawData = file_get_contents('php://input',true);
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
            $tourPrice= $orderData['tourPriceValue'];

            $tour_id= $this->TourModels->select_row('id', ['slug' => $slug]);
            
            $price=0;
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
            } else {
                $cart = [];
            }
            foreach ($cart as $item) {
                $price +=$item['price']*$item['qty'];
            }

            $arrayOrders = [
                'user_id'       => $this->MyController->getUsers()['id'],
                'tour_id'       =>$tour_id['id'],
                'fullname'       => $name,
                'gender'         => $gender,
                'birthday'       => $date,
                'email'          => $email,
                'phone_number'   => $phone,
                'address'         => $address,
                'number_of_people'         => $quantity,
                'order_date'    => gmdate('Y-m-d H:i:s', time() + 7*3600),
                'status'         => 'pending',
                'total_money'         => $tourPrice+$price,
                'active'=>'1'
            ];
            $orderAdd = $this->OrderModels->add($arrayOrders);
            $resultsOrders = json_decode($orderAdd, true);
            if($resultsOrders['type'] ==='Sucessfully'){
                if($cart!=NULL){
                    $arrayOrderDetail = [];
                    foreach ($cart as $value) {
                        array_push($arrayOrderDetail, [
                            'order_id'   => $resultsOrders['id'],
                            'tour_id'   =>$tour_id['id'],
                            'service_id'=>$value['id'],
                            'service_price'     => $value['price'],
                            'number_of_services' => $value['qty'],
                            'total_money_service'=>$price
                        ]);
                    }
                    $this->OrderDetailModels->addMultiple($arrayOrderDetail);
                    unset($_SESSION['cart']);
                }
                
            }

            $total_money=$tourPrice+$price;
            $data=[
                'price'=>$total_money,
                'page'=>'buying/payment'
            ];
            $this->view("user/index", $data);
        }
        
    }
}