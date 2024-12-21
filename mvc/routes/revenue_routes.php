<?php
require_once "./mvc/config/Routes.php";

$revenueRoutes = [
    'GET' => [
        '/api/manager/revenue/searchrevenue' => 'RevenueController/getRevenueStatistics',
        '/api/manager/revenue/getMonthlyRevenue' => 'RevenueController/getMonthlyRevenue',
        '/api/manager/revenue/getRevenue'=> 'RevenueController/getRevenue'
    ],
    'POST' => [
        '/api/manager/revenue/searchrevenue' => 'RevenueController/getRevenueStatistics',
        '/api/manager/revenue/getMonthlyRevenue' => 'RevenueController/getMonthlyRevenue', //biểu đồ
        '/api/manager/revenue/getRevenue'=> 'RevenueController/getRevenue' // doanh thu
    ]
];

// Khởi tạo đối tượng Routes đúng cách
$routes = new Routes();

// Thêm các route vào đối tượng Routes
if (isset($revenueRoutes)) {
    foreach ($revenueRoutes as $method => $routesArray) {
        foreach ($routesArray as $url => $controllerAction) {
            // Thêm từng route vào đối tượng Routes
            $routes->addRoute($url, $controllerAction);
        }
    }
}
?>
