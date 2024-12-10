<?php 
class MyModels extends Database {
    function select_array($data = '*',
    $where = NULL,
    $orderby = NULL,
    $start = NULL,
    $limit = NULL,
    $fields_in = NULL,
    $array_where_in = NULL,
    $fields_not_in = NULL,
    $array_where_not_in = NULL
    ) {
        $sql ="SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("", $fields);
            $values = array_values($where);
            $isFields = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
            for ($i=0; $i < count($fields); $i++) { 
                preg_match('/<=|>=|<|>|!=/',$fields[$i],$matches,PREG_OFFSET_CAPTURE);
                if ($matches != null) {
                   $string_Caculator = $matches[0][0];
                }
                if (!$isFields) {
                  $sql .= " and ";
                  $stringWhere = '';
                }
               $isFields = false;
               $sql .= "  ".$stringWhere." ".preg_replace('/<=|>=|<|>|!=/','',$fields[$i])." ".$string_Caculator." ? ";
            }
            if ($fields_in != NULL && $array_where_in != NULL) {
                $sql .= ' '.$this->where_in($fields_in,$array_where_in,true).' ';
            }
            if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                $sql .= ' '.$this->where_not_in($fields_not_in,$array_where_not_in,true).' ';
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        }
        else{
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkDuplicate($data) {
        // Kiểm tra nếu không có dữ liệu
        if (empty($data)) {
            return json_encode(
                array(
                    'type'    => 'Fail',
                    'Message' => 'No data provided',
                )
            );
        }
    
        // Lấy tất cả các cột trong bảng
        $columns = $this->getTableColumns();
    
        // Câu lệnh SQL để kiểm tra trùng lặp cho tất cả các cột
        $whereClauses = [];
        $params = [];
        
        // Xây dựng các điều kiện WHERE cho tất cả các cột
        foreach ($columns as $column) {
            if (isset($data[$column])) {
                $whereClauses[] = "$column = ?";
                $params[] = $data[$column];
            }
        }
    
        // Nếu không có cột nào để kiểm tra, trả về lỗi
        if (empty($whereClauses)) {
            return json_encode(
                array(
                    'type'    => 'Fail',
                    'Message' => 'No matching columns to check',
                )
            );
        }
    
        // Tạo câu lệnh WHERE
        $whereSql = implode(" AND ", $whereClauses);
    
        // Câu lệnh SQL kiểm tra trùng lặp
        $check_query = "SELECT COUNT(*) as count FROM ".$this->table." WHERE ".$whereSql;
        $stmt = $this->conn->prepare($check_query);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Nếu có bản ghi trùng lặp, trả về lỗi
        if ($row && $row['count'] > 0) {
            return json_encode(
                array(
                    'type'    => 'Fail',
                    'Message' => 'Data already exists for the provided values',
                )
            );
        }
    
        return null;  // Nếu không có lỗi, trả về null
    }    
    
    public function getTableColumns() {
        // Lấy tất cả các cột trong bảng bằng câu lệnh DESCRIBE
        $sql = "DESCRIBE ".$this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Chỉ lấy tên các cột
        return array_map(function($column) {
            return $column['Field'];
        }, $columns);
    }
    
    function add($data = NULL){
        if ($data === NULL) {
            return json_encode(
                array(
                    'type'    => 'Fail',
                    'Message' => 'No data provided',
                )
            );
        }

       // Kiểm tra trùng lặp trước khi thêm dữ liệu
        $duplicateCheckResult = $this->checkDuplicate($data);
        if ($duplicateCheckResult) {
            return $duplicateCheckResult;
        }
        
        // Chuyển đổi các trường dữ liệu thành danh sách và các giá trị
        $fields = array_keys($data);
        $fields_list = implode(",",$fields);
        $values = array_values($data);
        $qr = str_repeat("?,", count($fields) - 1) . "?"; 
        $sql = "INSERT INTO `".$this->table."`(".$fields_list.") VALUES ($qr)";
        $query = $this->conn->prepare($sql);
        if ($query->execute($values)) {
            return json_encode(
                array(
                    'type'      => 'Sucessfully',
                    'Message'   => 'Insert data sucessfully',
                    'id'        => $this->conn->lastInsertId()
                )
            );
        }
        else{
            return json_encode(
                array(
                    'type'      => 'Fail',
                    'Message'   => 'Insert data fail',
                )
            );
        }
    }

    function update($data = NULL,$where = NULL){
        if ($data != NULL && $where != NULL) {
            // Kiểm tra đầu vào
            if ($data === NULL || $where === NULL) {
                return json_encode([
                    'type' => 'Error',
                    'Message' => 'Data and Where clause cannot be NULL'
                ]);
            }

            if (!is_array($data) || !is_array($where)) {
                return json_encode([
                    'type' => 'Error',
                    'Message' => 'Data or Where clause must be an array'
                ]);
            }

            if (empty($data) || empty($where)) {
                return json_encode([
                    'type' => 'Error',
                    'Message' => 'Data or Where clause cannot be empty'
                ]);
            }
            $fields = array_keys($data);
            $values = array_values($data);
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $sql ="UPDATE $this->table SET ";
            $isFields = true;
            $isFields_where = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
            for ($i=0; $i < count($fields); $i++) { 
                if (!$isFields) {
                    $sql .= ", ";
                }
                $isFields = false;
                $sql .= "".$fields[$i]." =?";
            }
            for ($i=0; $i < count($where_array); $i++) {
                preg_match('/<=|>=|<|>/',$where_array[$i],$matches,PREG_OFFSET_CAPTURE);
                if ($matches != null) {
                    $string_Caculator = $matches[0][0];
                   
                } 
                if (!$isFields_where) {
                  $sql .= " and ";
                  $stringWhere = '';
                }
               $isFields_where = false;
               $sql .= "  ".$stringWhere." ".preg_replace('/<=|>=|<|>/','',$where_array[$i])." ".$string_Caculator." '".$value_where[$i]."'";
            }

            // Tự động thêm updated_at
            if (in_array('updated_at', $fields)) {
                $sql .= ", updated_at = NOW()";
            }

            $query = $this->conn->prepare($sql);
            if ($query->execute($values)) {
                return json_encode(
                    array(
                        'type'      => 'Sucessfully',
                        'Message'   => 'Update data sucessfully',
                    )
                );
            }
            else{
                return json_encode(
                    array(
                        'type'      => 'Fail',
                        'Message'   => 'Update data fail',
                    )
                );
            }
        }
    }

    function delete($where = NULL) {
        // validate dữ liệu
        if ($where === NULL) {
            return json_encode(
                array(
                    'type'      => 'Fail',
                    'Message'   => 'No data provided',
                )
            );
        }
        // xóa cứng bình thường
        $sql = "DELETE FROM $this->table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            $string_Caculator = '=';
    
            for ($i=0; $i < count($where_array); $i++) { 
                preg_match('/<=|>=|<|>/',$where_array[$i],$matches,PREG_OFFSET_CAPTURE);
                if ($matches != null) {
                    $string_Caculator = $matches[0][0];
                }
                
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= " ".$stringWhere." ".preg_replace('/<=|>=|<|>/','',$where_array[$i])." ".$string_Caculator." ?";
            }
    
            $query = $this->conn->prepare($sql);
            if ($query->execute($value_where)) {
                return json_encode(
                    array(
                        'type'      => 'Sucessfully',
                        'Message'   => 'Delete data sucessfully',
                    )
                );
            }
            else{
                return json_encode(
                    array(
                        'type'      => 'Fail',
                        'Message'   => 'Delete data fail',
                    )
                );
            }
        }
    }
    protected function isForeignKey($column) {
        // Lấy danh sách tất cả các khóa ngoại tham chiếu tới bảng hiện tại
        $sql = "SELECT table_name, column_name 
                FROM information_schema.key_column_usage 
                WHERE table_schema = :database
                  AND referenced_table_name = :referenced_table
                  AND referenced_column_name = :column";
        $query = $this->conn->prepare($sql);
        $query->execute([
            ':database' => $this->conn->query("SELECT DATABASE()")->fetchColumn(),
            ':referenced_table' => $this->table,
            ':column' => $column
        ]);
        
        $foreignKeys = $query->fetchAll(PDO::FETCH_ASSOC);
    
        // Nếu tìm thấy khóa ngoại
        if (!empty($foreignKeys)) {
            echo "Foreign keys referencing '{$this->table}({$column})':\n";
            print_r($foreignKeys);
            return true;
        }
        return false;
    }
    
    function search_array($data = '*', 
    $searchFields = [], 
    $searchTerm = '', 
    $orderby = NULL, 
    $start = NULL, 
    $limit = NULL) {
        $sql = "SELECT $data FROM $this->table";
        $values = [];

        
        if (!empty($searchTerm) && !empty($searchFields)) {
            $conditions = [];
            foreach ($searchFields as $field) {
                $conditions[] = "$field LIKE ?";
                $values[] = '%' . $searchTerm . '%'; 
            }
            $sql .= " WHERE " . implode(' OR ', $conditions);
        }
    
        if ($orderby != NULL) {
            $sql .= " ORDER BY $orderby";
        }
        if ($limit != NULL) {
            $sql .= " LIMIT $start, $limit";
        }
    
        // $query = $this->conn->prepare($sql); 
        // $query->execute($values);
        // return $query->fetchAll(PDO::FETCH_ASSOC);
        // Chuẩn bị và thực thi câu lệnh SQL
        try {
            $query = $this->conn->prepare($sql); 
            $query->execute($values);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    
    

    function select_row($data='*',$where){
        $sql ="SELECT $data FROM $this->table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            for ($i=0; $i < count($where_array); $i++) { 
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "" .$stringWhere." ".$where_array[$i]." = ?";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($value_where);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }
    function select_max_fields($data = '',$where = NULL){
       if ($data != '') {
           $sql = "SELECT MAX(".$data.") as sort FROM $this->table ";
       }
       if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'where';
            for ($i=0; $i < count($where_array); $i++) { 
                if (!$isFields_where) {
                    $sql .= " and ";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "" .$stringWhere." ".$where_array[$i]." = ?";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($value_where);
        }
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    function query($query){
        $sql = $query;
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function select_array_where_not_in($data = '*',$where = NULL,$fields_not_in = NULL,$array_where_not_in = NULL,$orderby = NULL,$start = NULL,$limit = NULL){
        $sql ="SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("",$fields);
            $values = array_values($where);
            $isFields = true;
            $stringWhere = 'where';
            for ($i=0; $i < count($fields); $i++) { 
                if (!$isFields) {
                  $sql .= " and ";
                  $stringWhere = '';
                }
               $isFields = false;
               $sql .= "  ".$stringWhere." ".$fields[$i]." = ? ";
            }
            if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                $sql .= ' '.$this->where_not_in($fields_not_in,$array_where_not_in,true).' ';
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        }
        else{
            if ($fields_not_in != NULL && $array_where_not_in != NULL) {
                $sql .= ' '.$this->where_not_in($fields_not_in,$array_where_not_in).' ';
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // JOIN TABLE
    function select_array_join_table($data = '*',
        $where = NULL,
        $orderby = NULL,
        $start = NULL,
        $limit = NULL,
        $table_join = NULL,
        $query_join = NULL,
        $type_join  = NULL 
        ){
        $sql ="SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("",$fields);
            $values = array_values($where);
            $isFields = true;
            if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
                $sql .= ' '.$this->join_table($table_join,$query_join,$type_join).' ';
            }
            $stringWhere = 'where';
            for ($i=0; $i < count($fields); $i++) { 
                if (!$isFields) {
                  $sql .= " and ";
                  $stringWhere = '';
                }
               $isFields = false;
               $sql .= "  ".$stringWhere." ".$fields[$i]." = ? ";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        }
        else{
            if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
                $sql .= ' '.$this->join_table($table_join,$query_join,$type_join).' ';
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function search_array_join_table(
        $data = '*',
        $search_fields = [], 
        $search_value = '', 
        $where = NULL,
        $orderby = NULL,
        $start = NULL,
        $limit = NULL,
        $table_join = NULL,
        $query_join = NULL,
        $type_join = NULL
    ) {
        $sql = "SELECT $data FROM $this->table";
    
        // Thêm JOIN nếu có
        if ($table_join != NULL && $query_join != NULL && $type_join != NULL) {
            $sql .= ' ' . $this->join_table($table_join, $query_join, $type_join) . ' ';
        }
    
        $conditions = [];
        $values = [];
    
        // Nếu có điều kiện `WHERE`
        if ($where != NULL) {
            foreach ($where as $field => $value) {
                // Kiểm tra xem cột đã có tiền tố hay chưa
                if (strpos($field, '.') !== false) {
                    // Nếu có tiền tố, giữ nguyên
                    $conditions[] = "$field = ?";
                } else {
                    // Nếu không, thêm tiền tố bảng chính
                    $conditions[] = "{$this->table}.$field = ?";
                }
                $values[] = $value;
            }
        }
    
        // Thêm điều kiện tìm kiếm với tên bảng khác (ví dụ: tours.name)
        if (!empty($search_fields) && $search_value !== '') {
            $search_conditions = [];
            foreach ($search_fields as $field) {
                // Kiểm tra xem cột tìm kiếm có thuộc bảng khác không 
                if (strpos($field, '.') !== false) {
                    // Nếu có, giữ nguyên tên bảng và cột 
                    $search_conditions[] = "$field LIKE ?";
                } else {
                    // Nếu không, mặc định tìm kiếm trong bảng chính
                    $search_conditions[] = "{$this->table}.$field LIKE ?";
                }
                $values[] = "%$search_value%";
            }
            // Kết hợp các điều kiện tìm kiếm bằng OR
            $conditions[] = '(' . implode(' OR ', $search_conditions) . ')';
        }
    
        // Kết hợp các điều kiện WHERE
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        // Thêm ORDER BY nếu có
        if ($orderby != '' && $orderby != NULL) {
            $sql .= " ORDER BY $orderby";
        }
    
        // Thêm LIMIT nếu có (phân trang)
        if ($limit != NULL) {
            $sql .= " LIMIT $start, $limit";
        }
        // Chuẩn bị và thực thi câu lệnh
        $query = $this->conn->prepare($sql);
        $query->execute($values);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function select_array_join_multi_table($data = '*',
        $where = NULL,
        $groupBy = NULL,
        $orderby = NULL,
        $start = NULL,
        $limit = NULL,
        $joinTable = []
        ){
      
        $sql ="SELECT $data FROM $this->table";
        if (isset($where) && $where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("",$fields);
            $values = array_values($where);
            $isFields = true;
            foreach ($joinTable as $key => $value) {
               $sql .= ' '.$this->join_table(trim($value[0]),trim($value[1]),trim($value[2])).' ';
            }
            $stringWhere = 'where';
            for ($i=0; $i < count($fields); $i++) { 
                if (!$isFields) {
                  $sql .= " and ";
                  $stringWhere = '';
                }
               $isFields = false;
               $sql .= "  ".$stringWhere." ".$fields[$i]."= ? ";
            }
            if (isset($groupBy) && $groupBy != '') {
                $sql .= " GROUP BY " . $groupBy;
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        }
        else{
             foreach ($joinTable as $key => $value) {
               $sql .= ' '.$this->join_table(trim($value[0]),trim($value[1]),trim($value[2])).' ';
            }
            if ($orderby !='' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
            }
            if ($limit != NULL) {
                $sql .= " LIMIT ".$start." , ".$limit."";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}