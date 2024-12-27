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
        $tour = $this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,NULL,NULL,'categories','category_id=categories.id','INNER');
        $limit=self::limit;
        $page =1;
        $total_row=count($tour);
        $total_page=ceil($total_row/$limit);
        $start=($page-1)*$limit;
        $datas = [];
        if($total_row>0){
            $datas =$this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,$start,$limit,'categories','category_id=categories.id','INNER');
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
        $rows = $this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,NULL,NULL,'categories','category_id=categories.id','INNER');
        $limit = self::limit;
        $page = $_POST['page'] ? $_POST['page'] : 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $datas =$this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,$start,$limit,'categories','category_id=categories.id','INNER');
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
        $destination = isset($_POST['destination']) ? $_POST['destination'] : ''; 
        $departure = isset($_POST['departure']) ? $_POST['departure'] : ''; 
        $date = isset($_POST['date']) ? $_POST['date'] : ''; 
        $budget = isset($_POST['budget']) ? $_POST['budget'] : '';  // Lọc ngân sách
    
        $conditions = []; 
        
        if (!empty($destination)) {
            $conditions['destination LIKE'] = "%$destination%"; 
        }
    
        if (!empty($departure)) {
            $conditions['pick_up LIKE'] = "%$departure%"; 
        }
    
        if (!empty($date)) {
            $conditions['date_start >='] = $date; 
        }
    
        if ($budget == 'under5') {
            $conditions['price <'] = 5000000;  
        } elseif ($budget == '5to10') {
            $conditions['price BETWEEN'] = [5000000, 10000000];
        } elseif ($budget == '10to20') {
            $conditions['price BETWEEN'] = [10000000, 20000000]; 
        } elseif ($budget == 'over20') {
            $conditions['price >'] = 20000000; 
        }
    
        $tours = $this->TourModels->select_array('*', $conditions, NULL, NULL, NULL); 
    
        $limit = self::limit;
        $page = 1;
        $total_row = count($tours);
        $total_page = ceil($total_row / $limit);
        $start = ($page - 1) * $limit;
    
        $datas = [];
        if ($total_row > 0) {
            $datas = $this->TourModels->select_array('*', $conditions, NULL, $start, $limit); 
        }
    
        $button_pagination = $this->Functions->pagination($total_page, $page);
    
        $data = [ 
            'page' => 'destination_search/index', 
            'title' => 'Kết quả tìm kiếm', 
            'tour' => $tours,
            'rows' => $total_row,
            'button_pagination' => $button_pagination
        ];
    
        $this->view('user/index', $data);
    }


    public function sort_tours($id)
    {
        $sort = $_POST['sort'];
        $cate_id = $id;

        $order_by = '';
        if ($sort == 'price-desc') {
            $order_by = 'price DESC';
        } elseif ($sort == 'price-asc') {
            $order_by = 'price ASC';
        }

        $rows = $this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id', ['category_id' => $id], NULL, NULL, NULL, 'categories', 'category_id=categories.id', 'INNER');
        $limit = self::limit;
        $page = 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $datas = $this->TourModels->select_array_join_table(
                'categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',
                ['category_id' => $cate_id],
                $order_by,
                $start,
                $limit,
                'categories',
                'category_id=categories.id',
                'INNER'
            );
        }
        $button_pagination = $this->Functions->pagination($total_page, $page);

        $data = [
            'datas' => $datas,
            'button_pagination' => $button_pagination
        ];

        $this->view('user/destination/loadData', $data);
    }
    
    function pagination_page_sort($id){
        $sort = $_POST['sort'];
        $cate_id = $id;

        $order_by = '';
        if ($sort == 'price-desc') {
            $order_by = 'price DESC';
        } elseif ($sort == 'price-asc') {
            $order_by = 'price ASC';
        }

        $rows = $this->TourModels->select_array_join_table('categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',['category_id'=>$id],NULL,NULL,NULL,'categories','category_id=categories.id','INNER');
        $limit = self::limit;
        $page = $_POST['page'] ? $_POST['page'] : 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $datas = $this->TourModels->select_array_join_table(
                'categories.describe as des,categories.name as cate_name,tours.id AS id_tour,tours.name as name,slug,price,destination,pick_up,duration,itinerary,date_start,thumbnail,description,created_at,updated_at,category_id',
                ['category_id' => $cate_id],
                $order_by,
                $start,
                $limit,
                'categories',
                'category_id=categories.id',
                'INNER'
            );
        }
        $button_pagination = $this->Functions->pagination($total_page,$page);
        $data = [
            'datas'             => $datas,
            'button_pagination' => $button_pagination
        ];
        $this->view('user/destination/loadData', $data);
    }
    
   
}