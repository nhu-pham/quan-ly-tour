
<?php
require_once './mvc/controllers/manager/RevenueController.php';
require_once "./mvc/core/redirect.php";

class HomeController extends Controller
{
    function __construct()
    {
            
        $this->RevenueController = new RevenueController();
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
    }

    public function index()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['admin'])) {
            $verify = $this->Jwtoken->decodeToken($_SESSION['user'], KEYS);
            if ($verify != NULL && $verify != 0) {
                $auth = $this->Authorzation->checkAuth($verify);
                if (!$auth) {
                    $redirect = new redirect('auth/login');
                }
            }
        } else {
            $redirect = new redirect('auth/login');
        }
        $data= $this->RevenueController->index();
        $data = [
            'page' => 'statistic/trangchu',
            'title' => 'Trang chủ',
            'data' => $data

        ];
        $this->view('admin/index', $data);
    }
}

