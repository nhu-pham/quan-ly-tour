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
            'page' => 'destination/index',
            'tour' => $datas,
            'row'=> $total_row,
            'button_pagination' => $button_pagination
        ];

        $this->view('user/index', $data);
    }
    function pagination_page($id = NULL) {
        $conditions = [];
        if ($id != NULL) {
            $conditions['category_id'] = $id;
        }
    
        // Số lượng sản phẩm hiển thị mỗi trang
        $limit = self::limit;
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $sort = isset($_POST['sort']) ? $_POST['sort'] : 'all';
    
        // Xử lý sắp xếp
        $orderby = 'id desc'; // Mặc định sắp xếp theo ID giảm dần
        if ($sort === 'price-asc') {
            $orderby = 'price asc';
        } else if ($sort === 'price-desc') {
            $orderby = 'price desc';
        }
    
        // Truy vấn tổng số lượng sản phẩm
        $total_rows = count($this->TourModels->select_row('*', $conditions));
    
        // Tổng số trang
        $total_page = ceil($total_rows / $limit);
    
        // Vị trí bắt đầu của trang hiện tại
        $start = ($page - 1) * $limit;
    
        // Truy vấn dữ liệu phân trang
        $datas = [];
        if ($total_rows > 0) {
            $datas = $this->TourModels->select_row('*', $conditions, $orderby, $start, $limit);
        }
    
        // Tạo các nút phân trang
        $button_pagination = $this->Functions->pagination($total_page, $page);
    
        // Truyền dữ liệu vào view
        $data = [
            'tour'             => $datas,
            'button_pagination' => $button_pagination
        ];
    
        // Trả về kết quả cho AJAX
        $this->view('destination/loadData', $data);
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