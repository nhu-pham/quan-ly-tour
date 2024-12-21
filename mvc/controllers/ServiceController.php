<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class ServiceController extends Controller{

    public $MyModels;
    public $ServiceModels;
    public $CategoryModels;
    public $TourModels;

    function __construct()
    {
        $this->MyModels = $this->models('MyModels');
        $this->ServiceModels = $this->models('ServiceModels');
        $this->CategoryModels=$this->models('CategoryModels');
        $this->TourModels=$this->models('TourModels');
        $this->MyController = new MyController();
    }
    
    function loadData($slug){
        $data= $this->MyController->indexCustomers();
        $service = $this->ServiceModels->select_array('*');
        $tour=$this->TourModels->select_array_join_table('categories.name as cate_name, categories.id as cate_id,tours.name as tour_name,slug',['slug'=>$slug],NULL,NULL,NULL,'categories','tours.category_id=categories.id','INNER');

        $qty = 0;
        $price=0;
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = [];
        }
        foreach ($cart as $item) {
            $qty += $item['qty'];
            
        }
        $data=[
            'page'=>'servicess/index',
            'service'=>$service,
            'tour'=>$tour,
            'qty'=>$qty,
            'slug'=>$slug
        ];
        $this->view('user/index', $data);
    }
    
}