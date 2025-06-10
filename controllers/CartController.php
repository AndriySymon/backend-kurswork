<?php
namespace controllers;

use core\Controller;
use core\Template;
use models\Category;
use core\Core;
use models\Instruments;
use services\MailService;

class CartController extends Controller{
    public function actionIndex(){
        $cartItems = [];

        if (!empty($_SESSION['cart'])) {
            $instrumentModel = new Instruments();
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $instrument = $instrumentModel->getById($id);
                if ($instrument) {
                    $instrument['quantity'] = $quantity;
                    $cartItems[] = $instrument;
                }
            }
        }

        return $this->render(['items' => $cartItems]);
    }

     public function actionAdd($params) {
        $id = $params[0];
        if (!isset($_SESSION['cart'][$id]))
            $_SESSION['cart'][$id] = 0;
        $_SESSION['cart'][$id]++;

        $quantity = $_SESSION['cart'][$id];
        $total = $this->getTotal();

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'quantity' => $quantity, 'total' => $total]);
        exit;
    }

    public function actionRemove($params) {
        $id = $params[0];
        unset($_SESSION['cart'][$id]);

        $total = $this->getTotal();

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'removeItem' => true, 'total' => $total]);
        exit;
    }
    public function actionDecrease($params) {
        $id = $params[0];
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]--;
            if ($_SESSION['cart'][$id] <= 0) {
                unset($_SESSION['cart'][$id]);
                $removeItem = true;
            } else {
                $removeItem = false;
            }
    }
    $quantity = $_SESSION['cart'][$id] ?? 0;
    $total = $this->getTotal();

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'quantity' => $quantity, 'removeItem' => $removeItem, 'total' => $total]);
    exit;
    }
    private function getTotal() {
        $total = 0;
        if (!empty($_SESSION['cart'])) {
            $instrumentModel = new \models\Instruments();
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $instrument = $instrumentModel->getById($id);
                if ($instrument) {
                    $total += $instrument['price'] * $quantity;
                }
            }
        }
        return $total;
    }
    public function actionCheckout(){
        if (empty($_SESSION['cart'])) {
            $this->redirect('/cart');
        }
        $cartItems = [];
        $missingItems = [];

        if(!empty($_SESSION['cart'])){
            $instrumentModel = new \models\Instruments();
            foreach ($_SESSION['cart'] as $id => $quantity){
                $instrument = $instrumentModel->getById($id);
                if ($instrument){
                    $instrument['quantity'] = $quantity;
                    $cartItems[] = $instrument;
                } else {
                    $missingItems[] = $id;
                    unset($_SESSION['cart'][$id]);
                }
            }
        }
        if (!empty($missingItems)) {
            return $this->render([
                'items' => $cartItems,
                'missing' => true,
                'message' => 'Деякі товари були видалені або недоступні. Вони були прибрані з вашого кошика.'
            ]);
        }
        return $this->render(['items' => $cartItems]);
    }

    public function actionSubmitOrder(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(empty($_SESSION['user'])){
                $this->redirect('/account/login');
            }

            $userId = $_SESSION['user']['id'];
            
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $postOffice = $_POST['post_office'];
            $address = "Нова Пошта, відділення №{$postOffice}";
            
            $instrumentModel = new \models\Instruments();
            $orderModel = new \models\Orders();

            $items = [];
            $totalPrice = 0;
            
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                $this->redirect('/cart');
            }

            foreach ($_SESSION['cart'] as $id => $quantity){
                $instrument = $instrumentModel->getById($id);
                if($instrument){
                    $instrument['quantity'] = $quantity;
                    $instrument['total'] = $instrument['price'] * $quantity;
                    $totalPrice += $instrument['total'];
                    $items[] = $instrument;
                }
            }

            $orderId = $orderModel->createOrder($userId, $totalPrice, $address, $city, '', $phone);

            foreach ($items as $item){
                $orderModel->addOrderItem($orderId, $item['id'], $item['quantity'], $item['price']);
            }
            require_once 'vendor/autoload.php';
            $mailer = new MailService();
            $mailer->sendOrderEmail($firstName, $lastName, $email, $phone, $city, $address, $items, $totalPrice);

            unset($_SESSION['cart']);

            return $this->render(['order' =>[
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'city' => $city,
                'items' => $items,
                'total_price' => $totalPrice
            ]], 'cart/confirmation');
        }
        $this->error(405);
    }

}