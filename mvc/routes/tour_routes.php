<?php
// Định nghĩa các route cho Tour
Routes::addRoute('/tours/add', 'TourController/add');   // Route cho thêm tour
Routes::addRoute('/tours/update/(:num)', 'TourController/update/$1'); // Route cho cập nhật tour, với tham số là ID
Routes::addRoute('/tours/delete/(:num)', 'TourController/delete/$1'); // Route cho xóa tour, với tham số là ID
Routes::addRoute('/tours/search', 'TourController/search'); // Route cho tìm kiếm tour
// Route cho tìm kiếm tour với bộ lọc
Routes::addRoute('/tours/search/filters', 'TourController/searchWithFilters'); // Dùng POST
// Route cho tìm kiếm tour theo từ khóa
Routes::addRoute('/tours/search/keyword', 'TourController/searchByKeyword'); // Dùng POST




// {
//     "name" : "Du Lịch Sapa", 
//     "price" : "17000", 
//     "destination": "Cao Bằng", 
//     "pick_up" : "TP. Hồ Chí Minh", 
//     "duration": "7 ngày 7 đêm", 
//     "itinerary" : "Hít mây sương khói sapa", 
//     "date_start" : "2024-12-09",
//     "thumbnail" : "sapa87.png",
//     "description" : "lặng lẽ sapa",
//     "category_id" : "1"
// }






?>


