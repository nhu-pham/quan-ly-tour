<?php
Routes::addRoute('/reviews/search', 'ReviewController/searchReviews');
Routes::addRoute('/reviews/add', 'ReviewController/add'); 
Routes::addRoute('/reviews/update/(:num)', 'ReviewController/update/$1'); 
Routes::addRoute('/reviews/delete/(:num)', 'ReviewController/delete/$1'); 
?>