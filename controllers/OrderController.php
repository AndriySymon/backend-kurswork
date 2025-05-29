<?php

namespace controllers;

use core\Controller;
use core\Template;
use core\DB;
use models\Instruments;
use services\MailService;

class OrderController extends Controller{
    public function actionAddToCart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = (int) $_POST['id'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        echo "OK";
        exit;
        }
        http_response_code(400);
        echo "Bad Request";
        exit;
    }
    public function actionMyOrders() {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /user/login");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $ordersModel = new \models\Orders();
        $orders = $ordersModel->getOrdersByUserId($userId);

        $template = new \core\Template("views/orders/my_orders.php", [
            'orders' => $orders
        ]);
        return [
        'Content' => $template->getHTML(),
        'Title' => 'Ваші замовлення'
        ];
    }
    public function actionCancelOrder($params){
        if (!isset($_SESSION['user']['id'])) {
        header("Location: /user/login");
        exit;
    }

        $orderId = $params[0] ?? null;
        $userId = $_SESSION['user']['id'];

        if (!$orderId || !is_numeric($orderId)) {
            header("Location: /orders/myOrders");
            exit;
        }

        $ordersModel = new \models\Orders();

        $order = $ordersModel->getOrderById($orderId);
        if (!$order || $order['user_id'] != $userId) {
            header("Location: /order/myOrders");
            exit;
        }

        if (in_array($order['status'], ['Обробляється', 'Підтверджено'])) {
            $ordersModel->cancelOrder($orderId);

            require_once 'vendor/autoload.php';
            $mailer = new \services\MailService();
            $fullName = $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
            $mailer->sendCancelOrderEmail($orderId, $_SESSION['user']['email'], $fullName);
        }

        header("Location: /order/myOrders");
        exit;
    }
}