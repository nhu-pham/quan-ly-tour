<?php
require_once './mvc/routes/service_routes.php'; // Bao gồm file chứa route API dịch vụ

class Routes {
    var $array = [];
    var $Routes = [];

    // Phương thức để thêm route
    public function addRoute($url, $controllerAction) {
        $this->Routes[] = ['url' => $url, 'controllerAction' => $controllerAction];
    }

    // Hàm xử lý URL cho API và các route khác
    public function handleUrl($url) {
        global $Routes;
        $returnUrl = ltrim($url, '/');

        // Kiểm tra nếu URL bắt đầu với 'api/' để xử lý API
        if (strpos($returnUrl, 'api/') === 0) {
            foreach ($this->Routes as $route) {
                if (preg_match('~' . $route['url'] . '~is', $returnUrl)) {
                    return $route['controllerAction'];
                }
            }
        } else {
            // Xử lý cho các route web
            if (isset($Routes)) {
                $folder = $this->readFolder('mvc/controllers');
                $strpos = $this->checkUrl($returnUrl, $folder);

                foreach ($Routes as $key => $val) {
                    $paramer = explode('/', $val);
                    $explode_url_arr = explode('.', $returnUrl);

                    if ($strpos === 0 && $url !== '/' && !isset($explode_url_arr[1])) {
                        $regex = $this->convertRegex($key);
                        if (!empty($regex)) {
                            if (preg_match($regex, $returnUrl)) {
                                unset($paramer[count($paramer) - 1]);
                                $explode_url = explode('/', $returnUrl);
                                $returnUrl = preg_replace('~' . $regex . '~is', $val, $explode_url[count($explode_url) - 1]);
                                $strip = '';
                                foreach ($paramer as $value) {
                                    $strip .= $value . '/';
                                }
                                $strip = trim($strip, '/') . '/' . $returnUrl;
                                $returnUrl = $strip;
                            }
                        }
                    } else {
                        if (preg_match('~' . $key . '~is', $url)) {
                            $returnUrl = preg_replace('~' . $key . '~is', $url, $val);
                        }
                    }
                }
            }

            // Kiểm tra các route được thêm thủ công
            foreach ($this->Routes as $route) {
                if (preg_match('~' . $route['url'] . '~is', $returnUrl)) {
                    return $route['controllerAction'];
                }
            }
        }

        return $returnUrl; // Trả về URL gốc nếu không tìm thấy route nào phù hợp
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
        if (strpos($string, ':any') !== false) {
            return '/([A-Za-z0-9]+)/';
        } elseif (strpos($string, ':num') !== false) {
            return '/([0-9]+)/';
        }
        return '';
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
