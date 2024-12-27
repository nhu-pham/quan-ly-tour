<?php
require_once "./mvc/config/Routes.php";

$reviewRoutes = [
    'GET' => [
        '/api/manager/review/searchReviews' => 'reviewController/searchReviews',
        '/api/manager/review/fetchAll' => 'reviewController/fetchAll',
        '/api/manager/review/search'=> 'reviewController/search',
        '/api/manager/review/count' => 'ReviewController/count',
        '/api/admin/review/searchReviews' => 'reviewController/searchReviews',
        '/api/admin/review/fetchAll' => 'reviewController/fetchAll',
        '/api/admin/review/search'=> 'reviewController/search',
        '/api/admin/review/count' => 'ReviewController/count'
    ],
    'POST' => [
        '/api/manager/review/add' => 'reviewController/add',
        '/api/admin/review/add' => 'reviewController/add',
    ],
    'POST' => [
        '/api/manager/review/update/(:num)' => 'reviewController/update/$1',
        '/api/admin/review/update/(:num)' => 'reviewController/update/$1',
    ],
    'DELETE' => [
        '/api/manager/review/delete/(:num)' => 'reviewController/delete/$1',
        '/api/admin/review/delete/(:num)' => 'reviewController/delete/$1',
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
