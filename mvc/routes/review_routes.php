<?php
require_once "./mvc/config/Routes.php";

$reviewRoutes = [
    'GET' => [
        '/api/review/searchReviews' => 'reviewController/searchReviews',
        '/api/review/fetchAll' => 'reviewController/fetchAll',
        '/api/review/search'=> '/reviewController/search';
    ],
    'POST' => [
        '/api/review/add' => 'reviewController/add',
    ],
    'POST' => [
        '/api/review/update/(:num)' => 'reviewController/update/$1',
    ],
    'DELETE' => [
        '/api/review/delete/(:num)' => 'reviewController/delete/$1',
    ],
];

// Khởi tạo đối tượng Routes đúng cách
$routes = new Routes();

// Thêm các route vào đối tượng Routes
if (isset($reviewRoutes)) {
    foreach ($reviewRoutes as $method => $routesArray) {
        foreach ($routesArray as $url => $controllerAction) {
            // Thêm từng route vào đối tượng Routes
            $routes->addRoute($url, $controllerAction);
        }
    }
}
?>
