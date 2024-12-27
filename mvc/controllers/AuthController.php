    <?php
    require_once "./mvc/controllers/MyController.php";
    require_once "./mvc/core/redirect.php";

    class AuthController extends Controller
    {
        public $template = 'AuthController';
        var $path_dir = 'public/uploads/images/user/';

        function __construct()
        {
            $this->UserModels = $this->models('UserModels');
            $this->OrderModels = $this->models('OrderModels');
            $this->TourModels = $this->models('TourModels');
            $this->ReviewModels = $this->models('ReviewModels');
            $this->MyController = new MyController();
            $this->TokenLoginModels = $this->models('TokenLoginModels');
            $this->Jwtoken = $this->helper('Jwtoken');
            $this->Authorzation = $this->helper('Authorzation');
            $this->uploads =  $this->helper('uploads');
            $this->SendMail =  $this->helper('SendMail');
        }
        function index()
        {
            'auth';
        }
        function register()
        {
            $errors = [];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (strlen($_POST['fullname']) < 5) {
                    $errors['fullname'] = 'Họ tên phải có ít nhất 5 ký tự';
                }
                if (strlen($_POST['password']) < 6) {
                    $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
                }
                if (($_POST['retype-password']) !== ($_POST['password'])) {
                    $errors['retype-password'] = 'Mật khẩu xác nhận không trùng khớp';
                }

                $counts = $this->UserModels->select_array('*', ['email' => trim($_POST['email'])]);
                if (count($counts) > 0) {
                    $errors['email'] = 'Email đã tồn tại';
                }

                if (empty($errors)) {
                    $activeToken = sha1(uniqid() . time());
                    $dataInsert = [
                        'fullname' => filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'phone_number' => filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                        'password' => password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS), PASSWORD_BCRYPT),
                        'activeToken' => $activeToken,
                        'created_at' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                        'role_id' => 1,
                        'username' => filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    ];

                    $result = $this->UserModels->add($dataInsert);
                    $return = json_decode($result, true);
                    if ($return) {
                        // Tạo link kích hoạt
                        $linkActive = base_url . 'auth/active?token=' . $activeToken;

                        // Thiết lập gửi mail
                        $subject = $dataInsert['fullname'] . ' vui lòng kích hoạt tài khoản!';
                        $content = 'Chào ' . $dataInsert['fullname'] . '!<br>';
                        $content .= 'Vui lòng click vào link bên dưới để kích hoạt tài khoản: <br>';
                        $content .= $linkActive . '<br>';
                        $content .= 'Trân trọng cảm ơn!';

                        // Tiến hành gửi mail
                        $sendMail = $this->SendMail->send($subject, $dataInsert['email'], $content);
                        if ($sendMail) {
                            $redirect = new redirect('auth/register');
                            $redirect->setFlash('sucess', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản!');
                        } else {
                            $redirect = new redirect('auth/register');
                            $redirect->setFlash('error', 'Hệ thống gặp sự cố, vui lòng thử lại sau!');
                        }
                    }
                } else {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['data'] = $_POST;
                    $redirect = new redirect('auth/register');
                    $redirect->setFlash('error', 'Đăng ký không thành công!');
                }
            }
            $this->view('user/register/index', [
                'title'         => 'Đăng ký'
            ]);
        }

        function active()
        {
            $activeToken = $_GET['token'];
            if (!empty($activeToken)) {
                $tokenQuery = $this->UserModels->select_row('*', ['activeToken' => trim($activeToken)]);
                if (!empty($tokenQuery)) {
                    $userId = $tokenQuery['id'];
                    $dataUpdate = [
                        'status' => 1,
                        'activeToken' => null
                    ];

                    $result = $this->UserModels->update($dataUpdate, ['id' => $userId]);
                    $decodeResults = json_decode($result, true);

                    if ($decodeResults['type'] === 'Sucessfully') {
                        $redirect = new redirect('auth/login');
                        $redirect->setFlash('sucess', 'Kích hoạt tài khoản thành công, bạn có thể đăng nhập ngay bây giờ!');
                    } else {
                        $redirect = new redirect('auth/login');
                        $redirect->setFlash('error', 'Kích hoạt tài khoản không thành công, vui lòng liên hệ quản trị viên!');
                    }
                } else {
                    $redirect = new redirect('auth/register');
                    $redirect->setFlash('error', 'Liên kết không tồn tại hoặc đã hết hạn');
                }
            } else {
                $redirect = new redirect('auth/register');
                $redirect->setFlash('error', 'Liên kết không tồn tại!');
            }
        }

        function login($slug=NULL)
        {
            
            if (isset($_SESSION['user'])) {
                $verify = $this->Jwtoken->decodeToken($_SESSION['user'], KEYS);
                if ($verify != NULL && $verify != 0) {
                    $auth = $this->Authorzation->checkAuth($verify);
                    if ($auth) {
                        $redirect = new redirect('/');
                    }
                }
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data_post = [
                    'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                    'password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                ];
                $data = $this->UserModels->select_row('*', [
                    'email' => trim($data_post['email']),
                    'status' => 1,
                ]);
                if ($data) {
                    if (password_verify($data_post['password'], $data['password'])) {
                        $array = [
                            'time'      => time() + 3600 * 24,
                            'keys'      => KEYS,
                            'info'      => [
                            'id'        => $data['id'],
                            'email'  => $data['email']
                            ]
                        ];
                        $jwt = $this->Jwtoken->CreateToken($array);
                        $dataInsert = [
                            'token' => $jwt,
                            'user_id' => $data['id'],
                            'created_at' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)
                        ];
                        $result = $this->TokenLoginModels->add($dataInsert);
                        if ($result) {
                            $_SESSION['user'] = $jwt;
                            switch ($data['role_id']) {
                                case 1:
                                    $_SESSION['customer'] = $jwt . 'customer';
                                    $redirect = new redirect('/');
                                    break;
                                case 2:
                                    $_SESSION['admin'] = $jwt . 'admin';
                                    $redirect = new redirect('admin/');
                                    break;
                                case 3:
                                    $_SESSION['employee'] = $jwt . 'employee';
                                    $redirect = new redirect('employee/');
                                    break;
                                case 4:
                                    $_SESSION['manager'] = $jwt . 'manager';
                                    $redirect = new redirect('manager/');
                                    break;
                                default:
                                    $redirect = new redirect('/');
                                    break;
                            }
                        } else {
                            $redirect = new redirect('auth/login');
                            $redirect->setFlash('error', 'Sai email hoặc mật khẩu!');
                        }
                    } else {
                        $redirect = new redirect('auth/login');
                        $redirect->setFlash('error', 'Sai email hoặc mật khẩu!');
                    }
                } else {
                    $redirect = new redirect('auth/login');
                    $redirect->setFlash('error', 'Tài khoản không tồn tại trong hệ thống!');
                }
            }

            $this->view('user/login/index', [
                'title'         => 'Đăng nhập'
            ]);
        }

        function logout()
        {
            if ($_SESSION['user']) {
                $token = $_SESSION['user'];
                $dataDelete = $this->TokenLoginModels->select_row('*', ['token' => $token]);
                $this->TokenLoginModels->delete(['token' => $dataDelete['token']]);
                unset($_SESSION['user']);
                unset($_SESSION['customer']);
                unset($_SESSION['employee']);
                unset($_SESSION['admin']);
                unset($_SESSION['manager']);
            }
            $redirect = new redirect('/');
        }

        function info()
        {
            if (isset($_SESSION['user'])) {
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Information handle
                $errors = [];
                if (strlen($_POST['username']) < 1) {
                    $errors['username'] = 'Tên tài khoản không được để trống';
                }

                $dataUpdate = [
                    'fullname' => trim(filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
                    'username' => trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
                    'phone_number' => filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)
                ];

                if ($_FILES['avatar']['name']) {
                    $path_dir = $this->path_dir;
                    $data_upload = $this->uploads->upload($_FILES['avatar'], $path_dir, uniqid());
                    if ($data_upload['result'] == "false") {
                        $redirect = new redirect($this->template . '/' . 'index');
                        $redirect->setFlash('flash', $data_upload['message']);
                    } else {
                        $image = $data_upload['image'];
                        $thumb = $data_upload['thumb'];
                        $dataUpdate['avatar_url'] = $image;
                    }
                }

                if (empty($errors)) {
                    $result = $this->UserModels->update($dataUpdate, ['id' => $verify['id']]);
                    $decodeResults = json_decode($result, true);
                    if ($decodeResults['type'] === 'Sucessfully') {
                        $redirect = new redirect('auth/info');
                        $redirect->setFlash('sucess', 'Cập nhật thông tin thành công!');
                    }
                } else {
                    $_SESSION['errors'] = $errors;
                    $redirect = new redirect('auth/info');
                    $redirect->setFlash('error', 'Cập nhật thông tin không thành công!');
                }
            }


            $data = $this->MyController->indexCustomers();
            $this->view('user/info/index', [
                'title'         => 'Thông tin cá nhân',
                'page'          => 'information',
                'data'    => $data,

            ]);
        }
        

        function change_password()
        {
            $data = $this->MyController->indexCustomers();
            if (isset($_SESSION['user'])) {
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $errors = [];
                $data_post = $_POST;
                if (strlen($_POST['password']) < 6) {
                    $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
                }
                if (strlen($_POST['newPassword']) < 6) {
                    $errors['newPassword'] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
                }
                if (($_POST['retype-newPassword']) !== ($_POST['newPassword'])) {
                    $errors['retype-newPassword'] = 'Mật khẩu xác nhận không trùng khớp';
                }
                $rows = $this->UserModels->select_row('*', ['id' => $data['user']['id']]);
                if (empty($errors)) {
                    if (password_verify($data_post['password'], $rows['password'])) {
                        $array = [
                            'password' => password_hash(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS)), PASSWORD_BCRYPT),
                            'updated_at' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)
                        ];
                        $result = $this->UserModels->update($array, ['id' => $data['user']['id']]);
                        $decodeResults = json_decode($result, true);
                        if ($decodeResults['type'] === 'Sucessfully') {
                            $redirect = new redirect('auth/change_password');
                            $redirect->setFlash('sucess', 'Cập nhật mật khẩu thành công!');
                        }
                    } else {
                        $_SESSION['errors'] = $errors;
                        $redirect = new redirect('auth/change_password');
                        $redirect->setFlash('error', 'Mật khẩu cũ không chính xác');
                    }
                } else {
                    $_SESSION['errors'] = $errors;
                    $redirect = new redirect('auth/change_password');
                    $redirect->setFlash('error', 'Cập nhật mật khẩu không thành công!');
                }
            }

            $this->view('user/info/index', [
                'title' => 'Đổi mật khẩu',
                'page'  => 'changePassword',
                'data'  => $data,
            ]);
        }

        function forgot()
        {
            if (isset($_SESSION['user'])) {
                $verify = $this->Jwtoken->decodeToken($_SESSION['user'], KEYS);
                if ($verify != NULL && $verify != 0) {
                    $auth = $this->Authorzation->checkAuth($verify);
                    if ($auth) {
                        $redirect = new redirect('/');
                    }
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = trim($_POST['email']);
                $user = $this->UserModels->select_row('*', ['email' => trim($email)]);
                if (!empty($user)) {
                    $userId = $user['id'];
                    // Tạo forgot token
                    $forgotToken = sha1(uniqid() . time());

                    $dataUpdate = [
                        'forgotToken' => $forgotToken,
                    ];

                    $result = $this->UserModels->update($dataUpdate, ['id' => $userId]);
                    $decodeResults = json_decode($result, true);

                    if ($decodeResults['type'] === 'Sucessfully') {
                        $linkReset = base_url . 'auth/reset?token=' . $forgotToken;

                        // Gửi email mã xác nhận
                        $subject = 'Khôi phục mật khẩu tài khoản';
                        $content = 'Chào bạn' . '<br>';
                        $content .= 'Bạn đã yêu cầu đặt lại mật khẩu tài khoản. 
                        Click vào link dưới đây để tiến hành reset mật khẩu: ' . '<br>';
                        $content .= $linkReset . '<br>';
                        $content .= 'Trân trọng cảm ơn!';

                        $sendEmail = $this->SendMail->send($subject, $email, $content);
                        if ($sendEmail) {
                            $redirect = new redirect('auth/forgot');
                            $redirect->setFlash('sucess', 'Vui lòng kiểm tra email để đặt lại mật khẩu của bạn.');
                        }
                    } else {
                        $redirect = new redirect('auth/forgot');
                        $redirect->setFlash('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                } else {
                    $redirect = new redirect('auth/forgot');
                    $redirect->setFlash('error', 'Email không tồn tại trong hệ thống.');
                }
            }

            $this->view('user/forgot/index', [
                'title' => 'Quên mật khẩu'
            ]);
        }

        function reset()
        {
            $forgotToken = $_GET['token'];
            if (!empty($forgotToken)) {
                $tokenQuery =  $this->UserModels->select_row('*', ['forgotToken' => trim($forgotToken)]);
                if (!empty($tokenQuery)) {
                    $userId = $tokenQuery['id'];

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $errors = [];
                        if (strlen($_POST['newPassword']) < 6) {
                            $errors['newPassword'] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
                        }
                        if (($_POST['retype-newPassword']) !== ($_POST['newPassword'])) {
                            $errors['retype-newPassword'] = 'Mật khẩu xác nhận không trùng khớp';
                        }

                        if (empty($errors)) {
                            $dataUpdate = [
                                'password' => password_hash(trim(filter_input(
                                    INPUT_POST,
                                    'newPassword',
                                    FILTER_SANITIZE_FULL_SPECIAL_CHARS
                                )), PASSWORD_BCRYPT),
                                'updated_at' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)
                            ];
                            $result = $this->UserModels->update($dataUpdate, ['id' => $userId]);
                            $decodeResults = json_decode($result, true);
                            if ($decodeResults['type'] === 'Sucessfully') {
                                $redirect = new redirect('auth/reset?&token=' . $forgotToken);
                                $redirect->setFlash('sucess', 'Thiết lập mật khẩu thành công!');
                            }
                        } else {
                            $_SESSION['errors'] = $errors;
                            $redirect = new redirect('auth/reset?&token=' . $forgotToken);
                            $redirect->setFlash('error', 'Thiết lập mật khẩu không thành công!');
                        }
                    }
                } else {
                    $redirect = new redirect('auth/forgot');
                    $redirect->setFlash('error', 'Liên kết không tồn tại!');
                }
            }
            $this->view('user/reset/index', [
                'title' => 'Thiết lập mật khẩu'
            ]);
        }

        function orders()
        {
            if (isset($_SESSION['user'])) {
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
            
            $data = $this->MyController->indexCustomers();
            $userId = $data['user']['id'];
            $ordersData = $this->OrderModels->select_array_join_table(
                'orders.*, tours.name as name, tours.thumbnail as toursImage',
                [
                    'active' => 1,
                    'user_id' => $userId
                ],
                'order_date desc',
                NULL,
                NULL,
                'tours',
                'orders.tour_id = tours.id',
                'LEFT'
            );

            $this->view('user/info/index', [
                'page' => 'ordersList',
                'data'    => $data,
                'ordersData' => $ordersData
            ]);
        }

        function getOrders()
        {
            $status = isset($_GET['status']) ? $_GET['status'] : 'all';
            $data = $this->MyController->indexCustomers();
            $userId = $data['user']['id'];
            if ($status === 'all') {
                $ordersData = $this->OrderModels->select_array_join_table(
                    'orders.*, tours.name as name, tours.thumbnail as toursImage',
                    [
                        'active' => 1,
                        'user_id' => $userId
                    ],
                    'order_date desc',
                    NULL,
                    NULL,
                    'tours',
                    'orders.tour_id = tours.id',
                    'LEFT'
                );
            } else {
                $ordersData = $this->OrderModels->select_array_join_table(
                    'orders.*, tours.name as name, tours.thumbnail as toursImage',
                    [
                        'status' => $status,
                        'active' => 1,
                        'user_id' => $userId
                    ],
                    'order_date desc',
                    NULL,
                    NULL,
                    'tours',
                    'orders.tour_id = tours.id',
                    'LEFT'
                );
            }

            if ($ordersData) {
                $htmlOutput = '';
                foreach ($ordersData as $order) {
                    $status = $order['status'];

                    $htmlOutput .= '
                    <div class="order-card">
                        <img src="/quan-ly-tour/' . htmlspecialchars($order['toursImage']) . '" alt="Tour Image" class="order-image">
                        <div class="order-details">
                            <div>
                                <h4>' . htmlspecialchars($order['name']) . '</h4>
                            </div>
                            <div><a href="detailOrder?id='. $order['id']. '" class="detail">Chi tiết đơn hàng</a></div>
                        </div>
                        <div class="order-summary">
                            <div class="waitforpay">
                                <i class="';
                    if ($status === 'pending') {
                        $htmlOutput .= 'bi bi-cash-stack';
                    } elseif ($status === 'completed') {
                        $htmlOutput .= 'fa-solid fa-check';
                    } elseif ($status === 'cancelled') {
                        $htmlOutput .= 'fa-solid fa-xmark';
                    }
                    $htmlOutput .= '"></i>
                                <span class="status" style="';
                    if ($status === 'pending') {
                        $htmlOutput .= 'color: #BFAB16;';
                    } elseif ($status === 'completed') {
                        $htmlOutput .= 'color: #18AB2E;';
                    } elseif ($status === 'cancelled') {
                        $htmlOutput .= 'color: #E80E0E;';
                    }
                    $htmlOutput .= '">';
                    if ($status === 'pending') {
                        $htmlOutput .= 'CHỜ THANH TOÁN';
                    } elseif ($status === 'completed') {
                        $htmlOutput .= 'HOÀN THÀNH';
                    } elseif ($status === 'cancelled') {
                        $htmlOutput .= 'ĐÃ HUỶ';
                    }
                    $htmlOutput .= '</span></div>
                            <p style="margin-left: 150px;">Tổng tiền: <span style="color: red; font-weight: bold;">'.$order['total_money']. 'VNĐ</span></p>';

                    if ($status === 'pending') {
                        $htmlOutput .= '<a href="thongTinDatTour.html" class="btngroup paytour-btn">Thanh toán</a>
                        <button id="cancel-button" class="btngroup cancelOrder-btn" data-id="' . $order['id'] . '">Huỷ</button>';
                    } elseif ($status === 'completed') {
                        $htmlOutput .= '<button id="delete-button" data-id="' . $order['id'] . '" class="btngroup cancel-btn" style="background-color: red; color: white; border: none;">Xóa</button>
                        <a href="thongTinDatTour.html" class="btngroup rebook-btn">Đặt lại</a>
                        <button class="btngroup review-btn" data-user-id="'.$data['user']['id'].'" data-tour-id="'. $order['tour_id'] .'">Đánh giá</button>
                        ';
                    } elseif ($status === 'cancelled') {
                        $htmlOutput .= '<button id="delete-button" data-id="' . $order['id'] . '" class="btngroup cancel-btn" style="background-color: red; color: white; border: none;">Xóa</button>
                        <a href="thongTinDatTour.html" class="btngroup rebook-btn">Đặt lại</a>';
                    }

                    $htmlOutput .= '</div>
                    </div>';
                }
                echo $htmlOutput;
            } else {
                echo '<p>Không có đơn hàng nào.</p>';
            }
        }

        function voucher()
        {
            if (isset($_SESSION['user'])) {
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

            $data = $this->MyController->indexCustomers();
            $this->view('user/info/index', [
                'page' => 'voucher',
                'data'    => $data
            ]);
        }

        function love()
        {
            if (isset($_SESSION['user'])) {
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
            
            $data = $this->MyController->indexCustomers();
            $lovedTour = $this->TourModels->select_array('*', ['is_love' => 1, 'loved_by' => $data['user']['id']]);

            $this->view('user/info/index', [
                'page' => 'love',
                'data'    => $data,
                'lovedTour' => $lovedTour
            ]);
        }

        function updateLove()
        {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['id']) && isset($data['is_love']) && isset($data['userId'])) {
                $tourId = $data['id'];
                $isLove = $data['is_love'];
                $isLoveBy = $data['userId'];

                $result = $this->TourModels->update(['is_love' => $isLove, 'loved_by' => $isLoveBy], ['id' => $tourId]);
                $decodeResults = json_decode($result, true);

                if ($decodeResults['type'] === 'Sucessfully') {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
            }
        }

        function cancelOrder()
        {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['id']) && isset($data['status'])) {
                $orderId = $data['id'];
                $status = $data['status'];

                $result = $this->OrderModels->update(['status' => $status], ['id' => $orderId]);
                $decodeResults = json_decode($result, true);

                if ($decodeResults['type'] === 'Sucessfully') {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
            }
        }

        function deleteOrder()
        {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['id'])) {
                $orderId = $data['id'];

                $result = $this->OrderModels->update(['active' => 0], ['id' => $orderId]);
                $decodeResults = json_decode($result, true);

                if ($decodeResults['type'] === 'Sucessfully') {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
            }
        }

        function detailOrder()
        {
            $groupOrderDetail = [];
            if (isset($_GET['id'])) {
                $orderId = (int)$_GET['id'];
                $orderDetail = $this->OrderModels->select_array_join_multi_table(
                    'orders.*, order_details.*, tours.name as tourName, tours.date_start as tourDateStart, tours.duration as tourDuration, tours.pick_up as tourPickUp, services.name as serviceName',
                    ['orders.id' => trim($orderId), 'active' => 1],
                    'order_details.id desc',
                    NULL,
                    NULL,
                    [
                        ['order_details', 'orders.id = order_details.order_id', 'LEFT'],
                        ['tours', 'tours.id = order_details.tour_id', 'LEFT'],
                        ['services', 'services.id = order_details.service_id', 'LEFT']
                    ]
                );
            }

            if ($orderDetail) {
                foreach ($orderDetail as $order) {
                    if (!isset($groupOrderDetail[$orderId])) {
                        $groupOrderDetail[$orderId] = [
                            'order_id' => $orderId,
                            'tour_id' => $order['tour_id'],
                            'order_date' => $order['order_date'],
                            'fullname' => $order['fullname'],
                            'phone_number' => $order['phone_number'],
                            'email' => $order['email'],
                            'status' => $order['status'],
                            'address' => $order['address'],
                            'tourName' => $order['tourName'],
                            'tourDateStart' => $order['tourDateStart'],
                            'tourDuration' => $order['tourDuration'],
                            'tourPickUp' => $order['tourPickUp'],
                            'number_of_people' => $order['number_of_people'],
                            'tour_price' => $order['tour_price'],
                            'total_money' => $order['total_money'],
                            'services' => [],
                        ];
                    }

                    $groupOrderDetail[$orderId]['services'][] = [
                        'serviceName' => $order['serviceName'],
                        'service_price' => $order['service_price'],
                        'number_of_services' => $order['number_of_services'],
                        'total_money_service' => $order['total_money_service'],
                    ];
                }
            }
            $data = $this->MyController->indexCustomers();
            $data = [
                'orderDetail' => $groupOrderDetail,
                'page' => 'orderDetail',
                'data' => $data
            ];
            $this->view('user/info/index', $data);
        }

        function rateOrder() {
            $data = json_decode(file_get_contents('php://input'), true);
            if (empty($data['user_id']) || empty($data['tour_id']) || empty($data['rating']) || empty($data['note'])) {
                echo json_encode(['success' => false, 'message' => 'Hãy điền đầy đủ nội dung.']);
                exit;
            }
        
            $user_id = $data['user_id'];
            $tour_id = $data['tour_id'];
            $rating = $data['rating'];
            $note = $data['note'];
        
    
            if ($rating < 1 || $rating > 5) {
                echo json_encode(['success' => false, 'message' => 'Đánh giá phải trong phạm vi từ 1 đến 5.']);
                exit;
            }
        
            $dataInsert = [
                'user_id' => $user_id,
                'tour_id' => $tour_id,
                'rating' => $rating,
                'note' => $note
            ];
        
            $result = $this->ReviewModels->add($dataInsert);
            $return = json_decode($result, true);
        
            if ($return['type'] === 'Sucessfully') {
                echo json_encode(['success' => true, 'message' => 'Đánh giá đã được lưu thành công.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không thể lưu đánh giá vào cơ sở dữ liệu.']);
            }
        }
    }