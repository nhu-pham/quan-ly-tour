<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class ContactController extends Controller{
   function __construct(){
    $this->MyController = new MyController();
    }

    function index(){
        $data= $this->MyController->indexCustomers();
        $data=[
            'page'=>'/contact/index',
            'data' => $data
        ];
        $this->view('user/index',$data);
    }
}