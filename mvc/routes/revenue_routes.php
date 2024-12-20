<?php
Routes::addRoute('/revenues/statistic', 'RevenueController/getRevenueStatistics'); 
Routes::addRoute('/revenues/statistic/monthly', 'RevenueController/getMonthlyRevenue'); 
Routes::addRoute('/revenues/statistic/tour', 'RevenueController/getTotalTours'); 

?>