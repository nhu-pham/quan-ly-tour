<?php
require_once "./mvc/config/Routes.php";

$tourRoutes = [
    'GET' => [
        '/api/tour/search' => 'TourController/search',
        '/api/tour/fetch' => 'TourController/fetchAll',

    ],
    'POST' => [
        '/api/tour/add' => 'TourController/add',
        '/api/tour/search/filters' => 'TourController/searchWithFilters',
        '/tours/search/keyword' => 'TourController/searchByKeyword'
    ],
    'POST' => [
        '/api/tour/update/(:num)' => 'TourController/update/$1',
    ],
    'DELETE' => [
        '/api/tour/delete/(:num)' => 'TourController/delete/$1',
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