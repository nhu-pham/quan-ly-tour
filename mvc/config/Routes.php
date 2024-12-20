<?php
require_once './mvc/routes/service_routes.php';  // Bao gồm file chứa route API dịch vụ

class Routes {
    var $array = [];
    var $Routes = [];

    // Phương thức để thêm route
    public function addRoute($url, $controllerAction) {
        $this->Routes[] = ['url' => $url, 'controllerAction' => $controllerAction];
    }

    // Hàm xử lý URL cho API và các route khác
    public function handleUrl($url) {
        $returnUrl = ltrim($url, '/');
        
        // Kiểm tra nếu URL bắt đầu với 'api/' để xử lý API
        if (strpos($returnUrl, 'api/') === 0) {
            // Duyệt qua các API routes
            foreach ($this->Routes as $key => $val) {
                if (preg_match('~' . $val['url'] . '~is', $returnUrl)) {
                    return $val['controllerAction'];  // Trả về controllerAction cho API
                }
            }
        } else {
            // Nếu không phải API, xử lý cho các route web
            foreach ($this->Routes as $key => $val) {
                if (preg_match('~' . $val['url'] . '~is', $returnUrl)) {
                    return $val['controllerAction'];  // Trả về controllerAction cho web routes
                }
            }
        }
        
        return $returnUrl;  // Trả về URL gốc nếu không tìm thấy route nào phù hợp
    }

    // Kiểm tra xem URL có tồn tại trong các controller không
    public function checkUrl($url, $folder = NULL) {
        $trim = ltrim($url, '/');
        $countArray = explode('/', $trim);
        $counts = 0;
        $urlString = '';
        foreach ($folder as $key => $value) {
            foreach ($countArray as $val) {
                $urlString .= $val . '/';
                $filecheck = trim($urlString, '/');
                if (file_exists('mvc/controllers/' . $filecheck . '.php')) {
                    $counts = 1;
                    break;
                }
            }
        }
        return $counts;
    }

    // Chuyển đổi các tham số động trong URL thành regex
    public function convertRegex($string) {
        // Xử lý các tham số trong URL động như :any
        if (preg_match('(:any)', $string)) {
            return '/([A-Za-z0-9]+)/'; // Dùng cho tham số bất kỳ
        } else if (preg_match('(:num)', $string)) {
            return  '/([0-9]+)/'; // Dùng cho tham số kiểu số
        }
    }

    // Đọc các thư mục controller và trả về danh sách các controller
    public function readFolder($folder_ = NULL) {
        if (is_dir($folder_)) {
            $folder = glob($folder_ . '/*');
            foreach ($folder as $value) {
                if (is_dir($value)) {
                    $this->readFolder($value);
                } else {
                    array_push($this->array, explode('.', $value)[0]);
                }
            }
        }
        return $this->array;
    }
}
