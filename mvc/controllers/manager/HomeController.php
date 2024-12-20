
<?php
require_once './mvc/controllers/manager/RevenueController.php';
require_once "./mvc/core/redirect.php";

class HomeController extends Controller
{
    function __construct()
    {
            
        $this->RevenueController = new RevenueController();
    }

    public function index()
    {
        $data= $this->RevenueController->index();
        $data = [
            'page' => 'statistic/trangchu',
            'title' => 'Trang chủ',
            'data' => $data

        ];
        $this->view('manager/index', $data);
    }
}

