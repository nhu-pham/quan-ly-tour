

<?php
require_once "./mvc/core/redirect.php";

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'page' => 'statistic/trangchu',
            'title' => 'Trang chủ',

        ];
        $this->view('manager/index', $data);
    }
}

