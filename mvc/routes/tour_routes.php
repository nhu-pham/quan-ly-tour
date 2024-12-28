<?php
require_once "./mvc/config/Routes.php";

$tourRoutes = [
    'GET' => [
        '/api/manager/tour/search' => 'TourController/search',
        '/api/manager/tour/fetch' => 'TourController/fetchAll',
        '/api/manager/tour/count' => 'TourController/count',
        '/api/admin/tour/search' => 'TourController/search',
        '/api/admin/tour/fetch' => 'TourController/fetchAll',
        '/api/admin/tour/count' => 'TourController/count',
    ],
    'POST' => [
        '/api/manager/tour/add' => 'TourController/add',
        '/api/manager/tour/search/filters' => 'TourController/searchWithFilters',
        '/api/manager/tour/search/keyword' => 'TourController/searchByKeyword',
        '/api/admin/tour/add' => 'TourController/add',
        '/api/admin/tour/search/filters' => 'TourController/searchWithFilters',
        '/api/admin/tour/search/keyword' => 'TourController/searchByKeyword'
    ],
    'POST' => [
        '/api/manager/tour/update/(:num)' => 'TourController/update/$1',
        '/api/admin/tour/update/(:num)' => 'TourController/update/$1',
    ],
    'DELETE' => [
        '/api/manager/tour/delete/(:num)' => 'TourController/delete/$1',
        '/api/admin/tour/delete/(:num)' => 'TourController/delete/$1',
    ],
];

// Khởi tạo đối tượng Routes đúng cách
$routes = new Routes();

// Thêm các route vào đối tượng Routes
if (isset($tourRoutes)) {
    foreach ($tourRoutes as $method => $routesArray) {
        foreach ($routesArray as $url => $controllerAction) {
            // Thêm từng route vào đối tượng Routes
            $routes->addRoute($url, $controllerAction);
        }
    }
}
?>