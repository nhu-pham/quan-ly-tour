<?php
Routes::addRoute('/services/add', 'ServiceController/add');   // Route cho thêm Service
Routes::addRoute('/services/update/(:num)', 'ServiceController/update/$1'); // Route cho cập nhật Service, với tham số là ID
Routes::addRoute('/services/delete/(:num)', 'ServiceController/delete/$1'); // Route cho xóa Service, với tham số là ID
Routes::addRoute('/services/search', 'ServiceController/search'); // Route cho tìm kiếm Service
?>