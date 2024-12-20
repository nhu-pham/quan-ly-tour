<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class ProductController extends Controller{

    public $MyModels;
    public $TourModels;
    public $CategoryModels;

    function __construct()
    {
        $this->MyModels = $this->models('MyModels');
        $this->TourModels = $this->models('TourModels');
        $this->CategoryModels=$this->models('CategoryModels');
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
        $data=[
            'page'=>'buying/datngay',
            'slug'=>$slug,
            'details'=>$detail_tour,
            'reviews'=>$review_tour,
            'category'=>$category
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

    
}