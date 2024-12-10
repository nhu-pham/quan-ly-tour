<?php
require_once "./mvc/models/MyModels.php";

class ReviewModel extends MyModels {
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
    
}
?>