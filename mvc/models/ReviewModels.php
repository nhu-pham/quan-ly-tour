<?php
require_once "./mvc/models/MyModels.php";

class ReviewModels extends MyModels {
    protected $table = 'reviews';
    
    public function searchReviewsByCustomer($fullname = '', $email = '') {
        // Các cột cần lấy dữ liệu
        $data = 'reviews.id AS review_id, users.id AS user_id, users.fullname, users.email, reviews.note AS review_note'; 

        // Không sử dụng LIKE nên để trống search_fields và search_value
        $search_fields = [];
        $search_value = ''; 
    
        // Điều kiện WHERE
        $where = [];
    
        // Kiểm tra fullname và email, thêm điều kiện vào mảng WHERE nếu có giá trị
        if (!empty($fullname)) {
            $where['users.fullname'] = $fullname; // Thêm tiền tố bảng 'users.'
        }
        if (!empty($email)) {
            $where['users.email'] = $email; // Thêm tiền tố bảng 'users.'
        }
    
        // Các tham số khác
        $orderby = 'reviews.id DESC'; // Sắp xếp bản ghi mới nhất
        $start = 0; // Vị trí bắt đầu
        $limit = 10; // Giới hạn số bản ghi trả về
    
        // Thông tin JOIN
        $table_join = 'users'; // Bảng cần JOIN
        $query_join = 'reviews.user_id = users.id'; // Điều kiện JOIN
        $type_join = 'INNER'; // Loại JOIN
    
        // Gọi hàm search_array_join_table từ lớp cha
        return $this->search_array_join_table(
            $data,
            $search_fields,
            $search_value,
            $where,
            $orderby,
            $start,
            $limit,
            $table_join,
            $query_join,
            $type_join
        );
    }

    // Hàm tìm kiếm các dịch vụ
    public function search_reviews($search_value = null, $orderby = null, $limit = null, $start = null) {
        // Chọn các cột cần truy vấn
        $data = 'reviews.id AS review_id, users.id AS user_id, users.fullname, users.email, reviews.note AS review_note'; 

        // Định nghĩa bảng cần join
        $table_join = "users";
        $query_join = "reviews.user_id = users.id";
        $type_join = "INNER"; // INNER JOIN để kết hợp hai bảng
        
        // Các trường để tìm kiếm
        $search_fields = ["reviews.id", "users.id", "users.fullname", "users.email","reviews.note", "users.username", "users.phone_number"]; // Tìm kiếm trong tên dịch vụ và tên danh mục
        
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
    
    public function fetchAll($table = null) {
        $data = parent::fetchAll($this->table);
        return $data ? $data : [];
    }


}
?>