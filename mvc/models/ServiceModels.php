<?php 
require_once "./mvc/models/MyModels.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

class ServiceModels extends MyModels {
    protected $table = 'services';

    public function add($data = null) {
        return parent::add($data);
    }

    public function update($data = null, $where = null) {
        if (empty($data) || empty($where)) {
            return json_encode(
                array(
                    'type'    => 'Fail',
                    'Message' => 'Data and Where clause cannot be empty',
                )
            );
        }
        return parent::update($data, $where);
    }

    public function delete($where = null) { 
        return parent::delete($where);
    }


    // Hàm tìm kiếm các dịch vụ
    public function search_services($search_value = null, $orderby = null, $limit = null, $start = null) {
        // Chọn các cột cần truy vấn
        $data = "services.id AS service_id, services.name AS service_name, services.image_url, services.price, service_categories.name AS category_name";

        // Định nghĩa bảng cần join
        $table_join = "service_categories";
        $query_join = "services.service_category_id = service_categories.id";
        $type_join = "INNER"; // INNER JOIN để kết hợp hai bảng
        
        // Các trường để tìm kiếm
        $search_fields = ["services.name", "services.price", "services.id", "service_categories.name",]; // Tìm kiếm trong tên dịch vụ và tên danh mục
        
        // Gọi phương thức search_array_join_table từ lớp cha
        return parent::search_array_join_table(
            $data,              // Cột cần truy vấn
            $search_fields,     // Các trường cần tìm kiếm
            $search_value,      // Giá trị tìm kiếm
            null,                // Không có điều kiện WHERE đặc biệt
            $orderby,            // Sắp xếp theo cột (nếu có)
            $start,              // Vị trí bắt đầu cho phân trang
            $limit,              // Số lượng bản ghi
            $table_join,         // Bảng cần join
            $query_join,         // Điều kiện join
            $type_join           // Loại join
        );
    }

    public function searchByKeyword($keyword, $searchFields = null, $orderby = null, $limit = 10, $start = 0) {
        // Nếu không có searchFields, gán mặc định
        if (!$searchFields) {
            $searchFields = ['name', 'price', 'service_category_id'];
        }
    
        // Lọc các trường tìm kiếm hợp lệ
        $allowedFields = ['name', 'price', 'service_category_id'];
        $filteredFields = array_intersect($searchFields, $allowedFields);
    
        if (empty($filteredFields)) {
            throw new InvalidArgumentException('No valid search fields provided.');
        }
    
        // Kiểm tra xem $orderby có hợp lệ không
        if ($orderby && !in_array($orderby, $allowedFields)) {
            $orderby = null; // Nếu không hợp lệ, bỏ qua sắp xếp
        }
    
        // Gọi hàm tìm kiếm
        return parent::search_array('*', $filteredFields, $keyword, $orderby, $start, $limit);
    }
    

    // Trong model (e.g., ServiceModel.php)
    public function fetchAll($table = null) {
        // Gọi phương thức fetchAll từ lớp cha
        $data = parent::fetchAll($this->table);

        // Trả về dữ liệu dưới dạng JSON hoặc mảng rỗng
        return $data ? $data : [];
    }

    public function countItems($table = null){
        return parent::countItems($this->table);
    }
    
}