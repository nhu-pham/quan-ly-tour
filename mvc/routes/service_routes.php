<?php
// service_routes.php

require_once "./mvc/config/Routes.php";

$ServiceRoutes = [
    'GET' => [
        '/api/manager/service/searchByKeyword' => 'ServiceController/searchByKeyword',
        '/api/manager/service/fetchAll' => 'ServiceController/fetchAll',
        '/api/manager/service/search' => 'ServiceController/search',
        '/api/manager/service/count' => 'ServiceController/count'
    ],
    'POST' => [
        '/api/manager/service/add' => 'ServiceController/add',
    ],
    'POST' => [
        '/api/manager/service/update/(:num)' => 'ServiceController/update/$1',
    ],
    'DELETE' => [
        '/api/manager/service/delete/(:num)' => 'ServiceController/delete/$1',
    ],
];

// Khởi tạo đối tượng Routes đúng cách
$routes = new Routes();

// Thêm các route vào đối tượng Routes
if (isset($ServiceRoutes)) {
    foreach ($ServiceRoutes as $method => $routesArray) {
        foreach ($routesArray as $url => $controllerAction) {
            // Thêm từng route vào đối tượng Routes
            $routes->addRoute($url, $controllerAction);
        }
    }
}
?>
