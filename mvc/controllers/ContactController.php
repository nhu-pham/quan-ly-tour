<?php
require_once 'MyController.php';
require_once "./mvc/core/redirect.php";
class ContactController extends Controller{
   function __construct(){
    $this->MyController = new MyController();
    }

    function index(){
        $data=[
            'page'=>'user/contact/index'
        ];
        $this->view('user/index',$data);
    }
}