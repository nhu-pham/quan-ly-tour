<?php
class Controller
{
    function view($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require_once "./mvc/views/" . $view . ".php";
    }

    function models($models)
    {
        require_once "./mvc/models/" . $models . ".php";
        return new $models;
    }
    function helper($helper)
    {
        require_once "./mvc/helper/" . $helper . ".php";
        return new $helper;
    }

    function cart($array)
    { // Hàm để tạo và cập nhật giỏ hàng.
        if (isset($array['id']) && !empty($array['id'])) {
            $id = $array['id'];
            if (isset($_SESSION['cart'])) { // Kiểm tra giỏ hàng đã tồn tại hay chưa.
                if (array_key_exists($id, $_SESSION['cart'])) {
                    $_SESSION['cart'][$id]['qty'] += $array['qty']; // Tăng số lượng sản phẩm nếu đã tồn tại trong giỏ hàng.
                } else {
                    $_SESSION['cart'][$id] = $array; // Thêm sản phẩm mới vào giỏ hàng.
                }
            } else { // Khởi tạo giỏ hàng nếu chưa tồn tại.
                $_SESSION['cart'] = [];
                $_SESSION['cart'][$id] = $array;
            }

            // Kiểm tra và xóa sản phẩm nếu số lượng <= 0
            if ($_SESSION['cart'][$id]['qty'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }

        // Trả về giỏ hàng sau khi cập nhật, chỉ giữ lại các mục hợp lệ
        return array_filter($_SESSION['cart'], function ($item) {
            return isset($item['id']) && !empty($item['id']);
        });
    }
}
