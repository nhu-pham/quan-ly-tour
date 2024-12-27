<?php

class App
{
    protected $controller = "HomeController";
    protected $action = "index";
    protected $params = [];
    protected $Routes__;

    function __construct()
    {
        //echo "Khởi tạo App<br>";

        $array = $this->urlProcess(); // Chuyển URL thành mảng
        //echo "URL sau khi xử lý: ";
        //print_r($array);
        //echo "<br>";

        $subFolder = ''; // Thư mục con
        $controllerName = ''; // Tên controller
        $actionName = ''; // Tên action

        // Bước 1: Xử lý thư mục con
        if (isset($array[0]) && is_dir("./mvc/controllers/" . $array[0])) {
            $subFolder = $array[0]; // Lấy tên thư mục con
            //echo "Thư mục con: $subFolder<br>";
            unset($array[0]); // Xóa phần tử khỏi mảng URL
            $array = array_values($array); // Reset mảng URL
        }

        // Bước 2: Xử lý controller
        if (isset($array[0])) {
            $controllerName = $this->toCamelCase($array[0]); // Lấy tên controller
            //echo "Tên controller: $controllerName<br>";
            unset($array[0]); // Xóa phần tử khỏi mảng URL
            $array = array_values($array); // Reset mảng URL
        } else {
            $controllerName = $this->controller; // Controller mặc định
            //echo "Tên controller mặc định: $controllerName<br>";
        }

        // Đường dẫn file controller
        $controllerPath = !empty($subFolder)
            ? "./mvc/controllers/$subFolder/" . $controllerName . ".php"
            : "./mvc/controllers/" . $controllerName . ".php";

        //echo "Đường dẫn controller: $controllerPath<br>";

        // Bước 3: Kiểm tra và load controller
        if (file_exists($controllerPath)) {
            //echo "Tìm thấy file controller: $controllerPath<br>";
            require_once $controllerPath;
            if (class_exists($controllerName)) {
                //echo "Tìm thấy class controller: $controllerName<br>";
                $this->controller = new $controllerName();
            } else {
                die("Controller class `$controllerName` không tồn tại.<br>");
            }
        } else {
            die("File controller `$controllerPath` không tồn tại.<br>");
        }

        // Bước 4: Xử lý action
        if (isset($array[0])) {
            $actionName = $array[0]; // Lấy tên action
            //echo "Tên action: $actionName<br>";
            unset($array[0]); // Xóa phần tử khỏi mảng URL
            $array = array_values($array); // Reset mảng URL
        } else {
            $actionName = $this->action; // Action mặc định
            //echo "Tên action mặc định: $actionName<br>";
        }

        // Kiểm tra action
        if (method_exists($this->controller, $actionName)) {
            //echo "Tìm thấy action: $actionName<br>";
            $this->action = $actionName;
        } else {
            die("Action `$actionName` không tồn tại trong controller `$controllerName`.<br>");
        }

        // Bước 5: Gán params
        $this->params = $array;
        //echo "Params: ";
        //print_r($this->params);
        //echo "<br>";

        // Bước 6: Gọi controller, action và truyền params
        //echo "Gọi action `$this->action` từ controller `$controllerName` với params: ";
        //print_r($this->params);
        //echo "<br>";

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    function getUrl()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        //echo "URL gốc: $url<br>";
        return $url;
    }

    // function urlProcess()
    // {
    //     $this->Routes__ = new Routes();
    //     $returnUrl = $this->Routes__->handleUrl($this->getUrl());
    //     echo "URL đã xử lý qua Routes: $returnUrl<br>";
    //     return explode("/", filter_var(trim($returnUrl, "/")));
    // }

    function urlProcess()
    {
    $this->Routes__ = new Routes();
    $returnUrl = $this->Routes__->handleUrl($this->getUrl()); // Xử lý qua Routes
    //echo "URL đã xử lý qua Routes: $returnUrl<br>";

    // Nếu URL bắt đầu với /api thì loại bỏ phần api/ để lấy tên controller chính xác
    $array = explode("/", filter_var(trim($returnUrl, "/")));
    if (isset($array[0]) && $array[0] == 'api') {
        // Nếu là API, chuyển thành /services hoặc controller phù hợp
        array_shift($array);  // Xóa phần "api" trong URL
    }

    return $array;
    }


    function toCamelCase($string)
    {
        $string = strtolower($string);
        $result = ucfirst($string) . "Controller";
        //echo "Chuỗi chuyển sang CamelCase: $result<br>";
        return $result;
    }
}