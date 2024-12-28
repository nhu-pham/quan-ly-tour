<?php
require_once "./mvc/controllers/MyController.php";
require_once "./mvc/core/redirect.php";
require_once './mvc/helper/pdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class HomeController extends Controller
{
    public $ordersData;
    const limit = 6;
    const type = 1;
    function __construct()
    {
        $this->MyController = new MyController();
        $this->OrderModels = $this->models('OrderModels');
        $this->Jwtoken = $this->helper('Jwtoken');
        $this->Authorzation = $this->helper('Authorzation');
        $this->Functions =  $this->helper('Functions');
        $this->SendMail            =  $this->helper('SendMail');
    }

    public function index()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['employee'])) {
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
        $ordersData = [];
        $searchTerm = "";

        $rows = $this->OrderModels->select_array('*');
        $limit = self::limit;
        $page = 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $ordersData = $this->OrderModels->select_array_join_table(
                'orders.*, tours.name as name, tours.thumbnail as toursImage',
                ['orders.active' => 1],
                'order_date desc',
                $start,
                $limit,
                'tours',
                'orders.tour_id = tours.id',
                'LEFT'
            );
        }
        $button_pagination = $this->Functions->pagination($total_page, $page);
        $data = [
            'page' => 'orders',
            'title' => 'Danh sách đơn hàng',
            'ordersData' => $ordersData,
            'button_pagination' => $button_pagination,
            'searchTerm' => $searchTerm
        ];
        $this->view('employee/index', $data);
    }

    public function searchOrders()
    {
        $ordersData = [];
        $searchTerm = "";
        $limit = self::limit;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = 1;
        $start = ($page - 1) * $limit;

        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $searchTerm = trim($_GET['search']);

            $ordersData = $this->OrderModels->search_array_join_table(
                'orders.*, tours.name as name, tours.thumbnail as toursImage',
                ['id', 'tours.name', 'status', 'fullname', 'email', 'phone_number'],
                $searchTerm,
                ['active' => 1],
                'order_date desc',
                $start,
                $limit,
                'tours',
                'orders.tour_id = tours.id',
                'LEFT'
            );
            $total_rows = count($ordersData);
        } else {
            $total_rows = count($this->OrderModels->select_array('*'));
            $ordersData = $this->OrderModels->select_array_join_table(
                'orders.*, tours.name as name, tours.thumbnail as toursImage',
                ['active' => 1],
                'order_date desc',
                $start,
                $limit,
                'tours',
                'orders.tour_id = tours.id',
                'LEFT'
            );
        }

        $total_page = ceil($total_rows / $limit);
        $button_pagination = $this->Functions->pagination($total_page, $page);

        $html = '';
        if (!empty($ordersData)) {
            foreach ($ordersData as $data) {
                $status = htmlspecialchars($data['status']);
                $statusText = ($status === 'pending') ? 'Chờ xác nhận' : (($status === 'completed') ? 'Hoàn thành' : (($status === 'cancelled') ? 'Đã huỷ' : 'Không xác định'));

                $html .= '<div class="tour-item">
                        <img src="/quan-ly-tour/' . htmlspecialchars($data['toursImage']) . '" alt="Avatar">
                        <div class="tour-info">
                            <p><strong>Tên tour:</strong> ' . htmlspecialchars($data['name']) . '</p>
                            <p><strong>Tên khách hàng:</strong> ' . htmlspecialchars($data['fullname']) . '</p>
                        </div>
                        <div class="ngay-gia">
                            <p><strong>Ngày đặt:</strong> ' . htmlspecialchars($data['order_date']) . '</p>
                            <div style="display: flex;
                            flex-direction: column;
                            gap: 10px;">
                            <p><strong>Trạng thái:</strong> ' . $statusText . '</p>
                            <p class="price-row"><strong>Giá:</strong> <label style="color: red; font-weight: bold;">' . htmlspecialchars($data['total_money']) . ' VNĐ</label></p>
                        </div>
                        </div>
                        <a href="home/detail" data-id="'.$data['id'].'" class="update-btn chitiet-btn">Xem chi tiết</a>
                    </div>';
            }
        } else {
            $html .= '<div>Không tìm thấy đơn hàng nào.</div>';
        }
        echo '<ul class="pagination">' . $button_pagination . '</ul>';
        echo '<div class="tour-list search-results" id="orders-list">' . $html . '</div>';
        exit;
    }

    function pagination_page()
    {
        $rows = $this->OrderModels->select_array('*');
        $limit = self::limit;
        $page = $_POST['page'] ? $_POST['page'] : 1;
        $total_rows = count($rows);
        $total_page = ceil($total_rows / $limit);
        $start = ($page - 1) * $limit;
        if ($total_rows > 0) {
            $ordersData = $this->OrderModels->select_array_join_table(
                'orders.*, tours.name as name, tours.thumbnail as toursImage',
                ['active' => 1],
                'order_date desc',
                $start,
                $limit,
                'tours',
                'orders.tour_id = tours.id',
                'LEFT'
            );
        }
        $button_pagination = $this->Functions->pagination($total_page, $page);
        $data = [
            'ordersData' => $ordersData,
            'button_pagination' => $button_pagination,
        ];
        $this->view('employee/orders', $data);
    }

    function detail()
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

        $data = [
            'orderDetail' => $groupOrderDetail,
            'page' => 'detail',
        ];
        $this->view('employee/index', $data);
    }

    function cancel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $orderId = $data['id'] ?? null;

            if ($orderId) {
                $updateResult = $this->OrderModels->update(
                    ['status' => 'cancelled'],
                    ['id' => $orderId]
                );

                $decodeResults = json_decode($updateResult, true);
                if ($decodeResults['type'] === 'Sucessfully') {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Không thể cập nhật trạng thái.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID không hợp lệ.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
        }
        exit;
    }

    function confirm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $emailUpdate = $_POST['email'];
            $orderId = $_POST['confirm'] ?? '';
            if ($orderId) {
                $data = $this->OrderModels->select_row('*', ['id' => trim($orderId)]);
                $updated = $this->OrderModels->update(
                    [
                        'status' => 'completed',
                        'phone_number' => $_POST['phone_number'],
                        'email' => $_POST['email'],
                        'address' => $_POST['address'],
                    ],
                    ['id' => $orderId]
                );
                $decodeResults = json_decode($updated, true);


                if ($decodeResults['type'] === 'Sucessfully') {
                    $link = base_url . 'employee/home/invoice?invoice_id=' . $orderId;

                    $subject = 'Xác nhận đơn hàng';
                    $content = 'Kính gửi quý khách hàng,' . '<br>';
                    $content = 'VietCharm xin trân trọng cảm ơn Quý khách hàng đã tin dùng dịch vụ của chúng tôi.' . '<br>';
                    $content = 'VietCharm xin gửi hoá đơn đến quý khách với thông tin chi tiết như sau:' . '<br>';
                    $content .= 'Số hoá đơn: ' . $orderId . '<br>';
                    $content .= 'Tổng tiền: ' . $data['total_money'] . '<br>';
                    $content .= 'Quý khách vui lòng truy cập link bên dưới để xem và kiểm tra hoá đơn gốc:' . '<br>';
                    $content .= $link . '<br>';
                    $content .= 'Chúc quý khách có một chuyến đi đáng nhớ!' . '<br>';
                    $content .= 'Trân trọng cảm ơn!';

                    $sendEmail = $this->SendMail->send($subject, $emailUpdate, $content);
                    if ($sendEmail) {
                        $redirect = new redirect('employee/home/detail?id=' . $orderId);
                        $redirect->setFlash('sucess', 'Xác nhận thành công !');
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Lỗi gửi mail']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Lỗi cập nhật']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
            }
        }
    }

    function invoice()
    {
        $invoiceId = $_GET['invoice_id'] ?? null;
        if ($invoiceId) {
            $invoiceData = $this->OrderModels->select_array_join_multi_table(
                'orders.*, order_details.*, tours.name as tourName, tours.date_start as tourDateStart, tours.pick_up as tourPickUp, tours.duration as tourDuration, services.name as serviceName',
                ['orders.id' => trim($invoiceId), 'active' => 1],
                'order_details.id desc',
                NULL,
                NULL,
                [
                    ['order_details', 'orders.id = order_details.order_id', 'LEFT'],
                    ['tours', 'tours.id = order_details.tour_id', 'LEFT'],
                    ['services', 'services.id = order_details.service_id', 'LEFT']
                ]
            );

            if ($invoiceData) {
                foreach ($invoiceData as $invoice) {
                    if (!isset($groupInvoiceData[$invoiceId])) {
                        $groupInvoiceData[$invoiceId] = [
                            'order_id' => $invoiceId,
                            'tour_id' => $invoice['tour_id'],
                            'order_date' => $invoice['order_date'],
                            'fullname' => $invoice['fullname'],
                            'phone_number' => $invoice['phone_number'],
                            'email' => $invoice['email'],
                            'address' => $invoice['address'],
                            'tourName' => $invoice['tourName'],
                            'tourDateStart' => $invoice['tourDateStart'],
                            'tourDuration' => $invoice['tourDuration'],
                            'tourPickUp' => $invoice['tourPickUp'],
                            'number_of_people' => $invoice['number_of_people'],
                            'tour_price' => $invoice['tour_price'],
                            'total_money_tour' => $invoice['total_money_tour'],
                            'total_money' => $invoice['total_money'],
                            'services' => [],
                        ];
                    }

                    $groupInvoiceData[$invoiceId]['services'][] = [
                        'serviceName' => $invoice['serviceName'],
                        'service_price' => $invoice['service_price'],
                        'number_of_services' => $invoice['number_of_services'],
                        'total_money_service' => $invoice['total_money_service'],
                    ];
                }
            }
        } else {
            $redirect = new redirect('/employee');
        }
        $data = [
            'groupInvoiceData' => $groupInvoiceData,
            'title' => 'Hoá đơn đặt tour',
        ];
        $this->view('employee/invoice', $data);
    }

    function exportPDF()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $invoiceId = $data['id'] ?? null;
            if ($invoiceId) {
                $invoiceData = $this->OrderModels->select_array_join_multi_table(
                    'orders.*, order_details.*, tours.name as tourName, tours.date_start as tourDateStart, tours.pick_up as tourPickUp, tours.duration as tourDuration, services.name as serviceName',
                    ['orders.id' => trim($invoiceId), 'active' => 1],
                    'order_details.id desc',
                    NULL,
                    NULL,
                    [
                        ['order_details', 'orders.id = order_details.order_id', 'LEFT'],
                        ['tours', 'tours.id = order_details.tour_id', 'LEFT'],
                        ['services', 'services.id = order_details.service_id', 'LEFT']
                    ]
                );

                if ($invoiceData) {
                    $groupInvoiceData = [];
                    foreach ($invoiceData as $invoice) {
                        if (!isset($groupInvoiceData[$invoiceId])) {
                            $groupInvoiceData[$invoiceId] = [
                                'order_id' => $invoiceId,
                                'tour_id' => $invoice['tour_id'],
                                'order_date' => $invoice['order_date'],
                                'fullname' => $invoice['fullname'],
                                'phone_number' => $invoice['phone_number'],
                                'email' => $invoice['email'],
                                'address' => $invoice['address'],
                                'tourName' => $invoice['tourName'],
                                'tourDateStart' => $invoice['tourDateStart'],
                                'tourDuration' => $invoice['tourDuration'],
                                'tourPickUp' => $invoice['tourPickUp'],
                                'number_of_people' => $invoice['number_of_people'],
                                'tour_price' => $invoice['tour_price'],
                                'total_money_tour' => $invoice['total_money_tour'],
                                'total_money' => $invoice['total_money'],
                                'services' => [],
                            ];
                        }

                        $groupInvoiceData[$invoiceId]['services'][] = [
                            'serviceName' => $invoice['serviceName'],
                            'service_price' => $invoice['service_price'],
                            'number_of_services' => $invoice['number_of_services'],
                            'total_money_service' => $invoice['total_money_service'],
                        ];
                    }

                    $now = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
                    $currentTime = $now->format("d-m-Y H:i:s");

                    $html = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Hoá đơn đặt tour</title>
                    </head>

                    <body style="font-family: DejaVu Sans, sans-serif;">

                    <header style="text-align: center; margin-bottom: 20px;">
                        <h1 style="font-size: 24px; margin-bottom: 5px;">HÓA ĐƠN ĐẶT TOUR DU LỊCH</h1>
                        <p style="color: #555; font-size: 14px;">Ngày lập hóa đơn: <span>'. $currentTime. '</span></p>
                    </header>
                    ';

                    if ($groupInvoiceData) {
                        foreach ($groupInvoiceData as $invoice) {
                            $html .= '
                            <section style="margin-bottom: 20px;">
                                <h2 style="font-size: 20px; margin-bottom: 10px; color: #333;
                                border-bottom: 1px solid #ddd; padding-bottom: 5px;">Thông Tin Khách Hàng</h2>
                                <p style="margin: 5px 0;"><strong>Tên khách hàng:</strong> ' . $invoice['fullname'] . '</p>
                                <p style="margin: 5px 0;"><strong>Số điện thoại:</strong> ' . $invoice['phone_number'] . '</p>
                                <p style="margin: 5px 0;"><strong>Email:</strong> ' . $invoice['email'] . '</p>
                                <p style="margin: 5px 0;"><strong>Địa chỉ:</strong> ' . $invoice['address'] . '</p>
                            </section>

                            <section style="margin-bottom: 20px;"">
                                <h2 style="font-size: 20px; margin-bottom: 10px; color: #333;
                                border-bottom: 1px solid #ddd; padding-bottom: 5px;">Thông Tin Tour</h2>
                                <p style="margin: 5px 0;"><strong>Tên Tour:</strong> ' . $invoice['tourName'] . '</p>
                                <p style="margin: 5px 0;"><strong>Ngày khởi hành:</strong> ' . $invoice['tourDateStart'] . '</p>
                                <p style="margin: 5px 0;"><strong>Số ngày:</strong> ' . $invoice['tourDuration'] . '</p>
                                <p style="margin: 5px 0;"><strong>Số người:</strong> ' . $invoice['number_of_people'] . ' người</p>
                                <p style="margin: 5px 0;"><strong>Giá tour:</strong> ' . $invoice['tour_price'] . ' VNĐ / người</p>
                                <p style="margin: 5px 0;"><strong>Thành tiền:</strong> ' . $invoice['total_money_tour'] . ' VNĐ</p>
                            </section>

                            <section style="margin-bottom: 20px;">
                                <h2 style="font-size: 20px; margin-bottom: 10px; color: #333;
                                border-bottom: 1px solid #ddd; padding-bottom: 5px;">Dịch Vụ Thuê Thêm</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #ddd; text-align: left; padding: 8px;">Dịch Vụ</th>
                                            <th style="border: 1px solid #ddd; text-align: left; padding: 8px;">Đơn Giá (VNĐ)</th>
                                            <th style="border: 1px solid #ddd; text-align: left; padding: 8px;">Số Lượng</th>
                                            <th style="border: 1px solid #ddd; text-align: left; padding: 8px;">Thành Tiền (VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            ';

                            foreach ($invoice['services'] as $invoiceService) {
                                $html .= '
                                <tr>
                                    <td style="border: 1px solid #ddd; text-align: left; padding: 8px;">' . $invoiceService['serviceName'] . '</td>
                                    <td style="border: 1px solid #ddd; text-align: left; padding: 8px;">' . $invoiceService['service_price'] . '</td>
                                    <td style="border: 1px solid #ddd; text-align: left; padding: 8px;">' . $invoiceService['number_of_services'] . '</td>
                                    <td style="border: 1px solid #ddd; text-align: left; padding: 8px;">' . $invoiceService['total_money_service'] . '</td>
                                </tr>
                                ';
                            }

                            $html .= '
                                    </tbody>
                                </table>
                            </section>

                            <footer style="text-align: right; margin-top: 20px; font-size: 16px; color: #333;">
                                <p style="color: red; font-size: 20px;">Tổng cộng: <strong>' . $invoice['total_money'] . '</strong></p>
                                <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>
                            </footer>
                            </div>
                            </body>
                            </html>
                            ';
                            
                        }

                        // Xuất PDF 
                        $options = new Options();

                        $options->set('isHtml5ParserEnabled', true); 
                        $options->set('isRemoteEnabled', true); 
                        $options->set('defaultFont', 'DejaVu Sans'); 
                        
                        $dompdf = new Dompdf($options);
                        $dompdf->loadHtml($html); 
                        $dompdf->setPaper('A4', 'portrait');
                        $dompdf->render();

                        $pdfFile = 'Hoa_don'.$invoiceId. '.pdf';
                        $filePath = "././././public/invoice/". $pdfFile;
                        file_put_contents($filePath, $dompdf->output());
                        echo json_encode(['success' => true, 'message' => 'Xuất PDF thành công', 'pdf_url' => "http://localhost/quan-ly-tour/public/invoice/".$pdfFile]); exit();
                    } 
                    
                } else {
                    echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dữ liệu đầu vào không hợp lệ']);
            }
            

            
        }
    }

}