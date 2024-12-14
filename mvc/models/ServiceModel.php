<?php 
require_once "./mvc/models/MyModels.php";
class ServiceModel extends MyModels {
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

    // cần fix
    // function search($service_id = null , $service_name = null, $category = null, $orderby = null, $limit = null) {
    //     // Chọn các cột cần thiết từ bảng services và service_categories
    //     //$data = "services.id, services.name, service_categories.name";
    //     $groupBy = 'services.id, services.name, service_categories.name';
    //     // Các bảng cần JOIN
    //     $joinTable = [
    //         ['service_categories', 'services.service_category_id = service_categories.id', 'LEFT']
    //     ];
    
    //     // Điều kiện WHERE
    //     $where = [];
    //     $values = [];
        
    //     if ($service_id && $service_name) {
    //         $where['services.id '] = $service_id;
    //         $where['services.name '] = $service_name;
    //     }

    //     if ($category) {
    //         $where['service_categories.name '] = $category;
    //     }

    //     // Sử dụng phương thức select_array_join_multi_table để thực hiện JOIN và truy vấn
    //     $result = $this->select_array_join_multi_table($data = "*", $where, $groupBy, $orderby, 0, $limit, $joinTable);

    //     return $result;
    // }

    function search_services($service_id = null, $service_name = null, $category_name = null, $orderby = null, $limit = null, $start = 0) {
        $data = "services.id AS service_id, services.name AS service_name, services.image_url, services.price, service_categories.name AS category_name";
        
        // Điều kiện JOIN
        $table_join = "service_categories";
        $query_join = "services.service_category_id = service_categories.id";
        $type_join = "INNER"; // INNER JOIN để kết hợp hai bảng
    
        // Điều kiện WHERE
        $where = [];
        if (!empty($service_id)) {
            $where['services.id'] = $service_id; // Tìm theo id
        }
        
        // Điều kiện tìm kiếm với LIKE
        $search_fields = [];
        $search_value = '';
        if (!empty($service_name)) {
            $search_fields[] = "services.name"; // Tìm theo tên service
            $search_value = $service_name;
        }
        if (!empty($category_name)) {
            $search_fields[] = "service_categories.name"; // Tìm theo tên danh mục
            $search_value = $category_name;
        }

    
        // Gọi phương thức cha
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
    
}