<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";

class HomeController extends Controller
{

    function __construct()
        {
            
            $this->MyController = new MyController();
        }
    public function index()
    {
        $data_index = $this->MyController->indexCustomers();
        $data = [
            'page' => 'home/index',
            'title' => 'Trang chủ',
            'data_index' => $data_index
        ];
        $this->view('user/index', $data);
    }
}
