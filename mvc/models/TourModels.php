<?php
require_once "./mvc/models/MyModels.php";
class TourModels extends MyModels {
    protected $table = 'tours';

    public function add($data = null) {
    
        // Xử lý ảnh thumbnail nếu có
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
            $thumbnailPath = $this->processThumbnail($_FILES['thumbnail']);
            if ($thumbnailPath) {
                $data['thumbnail'] = $thumbnailPath; // Gắn đường dẫn ảnh vào dữ liệu
            } else {
                return json_encode(
                    array(
                        'type'    => 'Fail',
                        'Message' => 'Failed to upload thumbnail',
                    )
                );
            }
        }

        // Gọi hàm add() từ lớp cha để thêm dữ liệu vào bảng tours
        $result = parent::add($data);
        $decodedResult = json_decode($result, true);

        // Nếu thêm thành công và có thumbnail, thêm ảnh vào bảng tour_images
        if ($decodedResult['type'] === 'Sucessfully' && isset($data['thumbnail'])) {
            $this->addThumbnailToImages($decodedResult['id'], $data['thumbnail']);
        }

        return $result;
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

        // Xử lý ảnh thumbnail nếu có
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
            $thumbnailPath = $this->processThumbnail($_FILES['thumbnail']);
            if ($thumbnailPath) {
                $data['thumbnail'] = $thumbnailPath; // Cập nhật đường dẫn ảnh vào dữ liệu
            } else {
                return json_encode(
                    array(
                        'type'    => 'Fail',
                        'Message' => 'Failed to upload thumbnail',
                    )
                );
            }
        }

        // Cập nhật dữ liệu vào bảng tours
        $result = parent::update($data, $where);
        // // Cập nhật ảnh thumbnail mới vào tour_images nếu có
        // if (isset($where['id'])) {
        //     $this->updateThumbnailInImages($where['id'], $data['thumbnail']);
        // } else {
        //     return json_encode(
        //         array(
        //             'type'    => 'Fail',
        //             'Message' => 'Tour ID not found in WHERE clause',
        //         )
        //     );
        // }
        return $result;
    }

    // Xử lý ảnh thumbnail
    private function processThumbnail($file) {
        $allowed_types = ['image/jpeg', 'image/png'];
        $file_type = $file['type'];

        if (in_array($file_type, $allowed_types)) {
            $upload_dir = "uploads/thumbnails/";
            $file_name = time() . "_" . basename($file['name']);
            $target_file = $upload_dir . $file_name;

            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return $target_file; // Trả về đường dẫn ảnh
            }
        }
        return false;
    }

    // Thêm ảnh vào bảng tour_images
    private function addThumbnailToImages($tourId, $thumbnailPath) {
        $sql = "INSERT INTO `tour_images` (`tour_id`, `image_url`) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tourId, $thumbnailPath]);
    }

    // Cập nhật ảnh trong bảng tour_images
    private function updateThumbnailInImages($tourId, $thumbnailPath) {
        $sqlCheck = "SELECT COUNT(*) FROM `tour_images` WHERE `tour_id` = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute([$tourId]);
        $count = $stmtCheck->fetchColumn();
    
        if ($count > 0) {
            $sql = "UPDATE `tour_images` SET `image_url` = ? WHERE `tour_id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$thumbnailPath, $tourId]);
        } else {
            // Nếu không có bản ghi, bạn có thể thêm mới
            $sqlInsert = "INSERT INTO `tour_images` (`tour_id`, `image_url`) VALUES (?, ?)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->execute([$tourId, $thumbnailPath]);
        }
    }
    

    // Ghi đè hook beforeDelete trong lớp con (nếu cần)
    protected function beforeDelete($where) {
        if (isset($where['id']) && $where['id'] == 1) {
            return 'Cannot delete record with id 1';
        }

        return true;
    }

    public function delete($where = null) {
        // Tự động xác định bảng cần thao tác từ phần route
        $table = 'tours';
    
        // Kiểm tra xem bảng có tồn tại không
        if ($table === null) {
            return json_encode([
                'type' => 'Error',
                'Message' => 'Invalid route or table not found'
            ]);
        }

        // Kiểm tra khóa ngoại và xử lý xóa mềm nếu có
        if (isset($where['id'])) {
            $column = 'id';
            $value = $where['id'];
            echo $column;

            // Kiểm tra khóa ngoại cho tham số hiện tại
            $isForeignKey = $this->isForeignKey($column);
            echo $isForeignKey;

            if ($isForeignKey) {
                // Kiểm tra nếu giá trị không có trong bảng orders, tiến hành xóa cứng
                $isReferenced = $this->checkForeignKeyExists($value);
                if ($isReferenced) {
                    // Nếu có khóa ngoại và giá trị tồn tại trong bảng orders, thực hiện xóa mềm
                    if ($this->table === 'tours') {
                        $result = $this->softDeleteTour($value);
                        return json_encode($result);
                    }
                } 
            } 
        }
    
        return parent::delete($where);
    }

    private function softDeleteTour($value) {
        try {
            // Kiểm tra trạng thái đơn hàng
            $statusQuery = $this->conn->prepare(
                "SELECT status FROM orders 
                 JOIN order_details ON orders.id = order_details.order_id 
                 WHERE order_details.tour_id = :tour_id"
            );            
            $statusQuery->execute([':tour_id' => $value]);
            $statusResult = $statusQuery->fetch(PDO::FETCH_ASSOC);
            if ($statusResult && $statusResult['status'] === 'pending') {
                return [
                    'type' => 'Fail',
                    'Message' => 'This tour has been pending!',
                ];
            }
    
            // Thực hiện xóa mềm tour
            $updateQuery = $this->conn->prepare(
                "UPDATE orders 
                 JOIN order_details ON orders.id = order_details.order_id
                 SET orders.active = 0
                 WHERE order_details.tour_id = :tour_id"
            );
            
            if ($updateQuery->execute([':tour_id' => $value])) {
                return [
                    'type' => 'Successfully',
                    'Message' => 'Tour soft-deleted successfully.',
                ];
            } else {
                return [
                    'type' => 'Fail',
                    'Message' => 'Failed to soft-delete the tour. Error: ' . implode(", ", $updateQuery->errorInfo()),
                ];
            }
        } catch (PDOException $e) {
            return [
                'type' => 'Error',
                'Message' => 'An error occurred: ' . $e->getMessage(),
            ];
        }
    }

    private function checkForeignKeyExists($value) {
        // Kiểm tra xem giá trị khóa ngoại có tồn tại trong bảng orders không
        $sql = "SELECT COUNT(*) FROM order_details WHERE tour_id = :tour_id";
        $query = $this->conn->prepare($sql);
        $query->execute([':tour_id' => $value]);
    
        $count = $query->fetchColumn();
    
        // Nếu số lượng là lớn hơn 0, nghĩa là khóa ngoại tồn tại trong bảng orders
        return $count > 0;
    }
    

    public function search($tour_id = null, $tour_name = null, $start_date = null) {

        // Tạo mảng điều kiện WHERE
        $where = [];
        if ($tour_id) {
            $where['id'] = $tour_id;
        }
        if ($tour_name) {
            $where['name'] = $tour_name;
        }
        if ($start_date) {
            $where['date_start'] = $start_date;
        }
    
        // Sử dụng phương thức select_row để trả về một bản ghi duy nhất
        $result = parent::select_row('*', $where);
    
        return $result;
    }

    public function searchToursWithFilters($tourId = null, $tourName = null, $startDate = null, $orderby = null, $limit = 10, $start = 0) {
        $where = [];
        if ($tourId) {
            $where['id'] = $tourId;
        }
        if ($tourName) {
            $where['name'] = $tourName;
        }
        if ($startDate) {
            $where['date_start'] = $startDate;
        }
    
        $tours = parent::select_array('*', $where, $orderby, $limit, $start);
    
        return $tours;
    }



    public function searchToursByKeyword($keyword, $searchFields = null, $orderby = null, $limit = 10, $start = 0) {
        // Nếu không có searchFields, gán mặc định
        if (!$searchFields) {
            $searchFields = ['name', 'price', 'destination', 'pick_up', 'duration', 'itinerary', 'date_start', 'description', 'category_id'];
        }
    
        // Kiểm tra xem trường tìm kiếm có nằm trong mảng searchFields không
        $filteredFields = [];
        foreach ($searchFields as $field) {
            if (in_array($field, ['name', 'price', 'destination', 'pick_up', 'duration', 'itinerary', 'date_start', 'description', 'category_id'])) {
                $filteredFields[] = $field;
            }
        }
    
        // Kiểm tra xem $orderby có hợp lệ không (có phải là trường tồn tại trong cơ sở dữ liệu)
        $validOrderByFields = ['name', 'price', 'destination', 'pick_up', 'duration', 'itinerary', 'date_start', 'description', 'category_id'];
        if ($orderby && !in_array($orderby, $validOrderByFields)) {
            $orderby = null; // Nếu không hợp lệ, bỏ qua sắp xếp
        }
    
        // Gọi phương thức tìm kiếm trong model cha
        $tours = parent::search_array('*', $filteredFields, $keyword, $orderby, $start, $limit);
        return $tours;
    }   

    public function search_tours($search_value = null, $orderby = null, $limit = null, $start = null) {
        // Chọn các cột cần truy vấn
        $data = "tours.id, tours.name, tours.price, tours.destination, tours.duration, tours.pick_up, tours.itinerary, tours.date_start, tours.thumbnail, tours.description, categories.id AS category_id";

        // Định nghĩa bảng cần join
        $table_join = "categories";
        $query_join = "tours.category_id = categories.id";
        $type_join = "INNER"; // INNER JOIN để kết hợp hai bảng
        
        // Các trường để tìm kiếm
        $search_fields = ["tours.name", "tours.price", "tours.id", "categories.name",]; // Tìm kiếm trong tên dịch vụ và tên danh mục
        
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
?>
