<?php
require_once "./mvc/models/MyModels.php";

class RevenueModel extends MyModels {
    protected $table = 'orders';

    function get_revenue_statistics($startDate, $endDate, $status = null, $orderby = null, $limit = null) {
        // Chọn các cột cần thiết từ bảng orders và order_details
        $data = "orders.id, orders.order_date, orders.total_money, SUM(order_details.total_money_service) as total_service_money";
        $groupBy = 'orders.id, orders.order_date, orders.total_money';
        // Các bảng cần JOIN
        $joinTable = [
            ['order_details', 'orders.id = order_details.order_id', 'LEFT']
        ];
    
        // Điều kiện WHERE
        $where = [];
        $values = [];
        
        if ($startDate && $endDate) {
            $where['orders.order_date >'] = $startDate;
            $where['orders.order_date <'] = $endDate;
        }
    
        if ($status) {
            $where['orders.status'] = $status;
        }
    
        // Sử dụng phương thức select_array_join_multi_table để thực hiện JOIN và truy vấn
        $result = $this->select_array_join_multi_table($data, $where, $groupBy, $orderby, 0, $limit, $joinTable);
    
        // Xử lý kết quả
        $totalRevenue = 0;
        foreach ($result as $row) {
            $totalRevenue += $row['total_money'] + $row['total_service_money'];
        }
    
        return $totalRevenue;
    }
    
    function get_monthly_revenue($startMonth, $endMonth) {
        // Dữ liệu cần truy vấn
        $data = "YEAR(orders.order_date) as year, MONTH(orders.order_date) as month, 
                 SUM(orders.total_money) as total_order_money, 
                 SUM(order_details.total_money_service) as total_service_money";
        $groupBy = 'year, month';
        // Các bảng cần JOIN
        $joinTable = [
            ['order_details', 'orders.id = order_details.order_id', 'LEFT']
        ];
    
        // Điều kiện WHERE
        $where = [];
        $values = [];
        
        if ($startMonth && $endMonth) {
            $where['MONTH(orders.order_date) >'] = $startMonth;
            $where['MONTH(orders.order_date) <'] = $endMonth;
        }
    
        // Sử dụng phương thức select_array_join_multi_table để thực hiện JOIN và truy vấn
        $result = $this->select_array_join_multi_table($data, $where, $groupBy, 'YEAR(orders.order_date), MONTH(orders.order_date)', 0, null, $joinTable);
    
        // Xử lý kết quả
        $revenueByMonth = [];
        foreach ($result as $row) {
            $yearMonth = $row['year'] . '-' . $row['month'];
            $revenueByMonth[$yearMonth] = $row['total_order_money'] + $row['total_service_money'];
        }
    
        return $revenueByMonth;
    }

    function getTotalTours() {
        $sql = "
            SELECT COUNT(*) AS total_tours
            FROM tours
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_tours'];
    } 
}
?>
