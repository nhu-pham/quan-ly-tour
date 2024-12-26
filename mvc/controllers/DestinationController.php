<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class DestinationController extends Controller{
    public $TourModels;
    const limit = 5;
    function __construct(){
        $this->TourModels = $this->models('TourModels');
        $this->Functions =  $this->helper('Functions');
    }
    function index($id){
        $tour = $this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as tour_name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,NULL,NULL,'categories','category_id=categories.id','INNER');
        
        $limit=self::limit;
        $page =1;
        $total_row=count($tour);
        $total_page=ceil($total_row/$limit);
        $start=($page-1)*$limit;
        $datas = [];
        if($total_row>0){
            $datas =$this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as tour_name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,$start,$limit,'categories','category_id=categories.id','INNER');
        }
        $button_pagination=$this->Functions->pagination($total_page,$page);

        $data = [
            'page' => '/destination/index',
            'tour' => $datas,
            'row'=> $total_row,
            'cate_id'=>$id,
            'datas'=> $datas,
            'button_pagination' => $button_pagination
        ];

        $this->view('user/index', $data);
    }
    function pagination_page($id){
        $rows = $this->TourModels->select_row('*',['category_id'=>$id]);
        // 30 sản phẩm total_rows = 30
        // mỗi trang sẽ chứa 1 sản phẩm limit = 1
        // 30 / 1 => 30 trang total_rows / limit
        $limit = self::limit;
        $page = $_POST['page']?$_POST['page']:1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $datas = $this->TourModels->select_array('*',['category_id'=>$id],NULL,$start,$limit);
        }
        $button_pagination = $this->Functions->pagination($total_page,$page);
        $data = [
            'datas'             => $datas,
            'button_pagination' => $button_pagination
        ];
        $this->view('user/destination/loadData', $data);
    }
     

    public function search() 
    { 
        $destination = isset($_GET['destination']) ? $_GET['destination'] : ''; 
        $checkin = isset($_GET['checkin']) ? $_GET['checkin'] : ''; 
        $checkout = isset($_GET['checkout']) ? $_GET['checkout'] : ''; 
        // Tạo điều kiện truy vấn 
        $conditions = []; 
        if (!empty($destination)) {
             $conditions['destination LIKE'] = "%$destination%"; 
        } 
        if (!empty($checkin)) 
        { 
            $conditions['date_start >='] = $checkin; 
        } 
        if (!empty($checkout)) 
        { 
            $conditions['date_start <='] = $checkout; 
        }
        $tours = $this->TourModels->select_array('*', $conditions, NULL, NULL, NULL); 
        $limit=self::limit;
        $page =1;
        $total_row=count($tours);
        $total_page=ceil($total_row/$limit);
        $start=($page-1)*$limit;
        $datas = [];
        if($total_row>0){
            $datas =$tours = $this->TourModels->select_array('*', $conditions, NULL, $start, $limit); 
        }
        $button_pagination=$this->Functions->pagination($total_page,$page);
        $data = [ 
            'page' => 'destination_search/index', 
            'title' => 'Kết quả tìm kiếm', 
            'tour' => $tours ,
            'rows'=>$total_row,
            'button_pagination' => $button_pagination
        ]; 
        $this->view('user/index', $data);
    }

    
   
}