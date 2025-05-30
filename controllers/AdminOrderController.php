<?php

namespace controllers;

use core\Controller;
use core\Template;
use core\Core;
use models\Orders;
use core\DB;

class AdminOrderController extends Controller
{
    protected $ordersModel;

    public function __construct()
    {
        $this->ordersModel = new Orders();
    }

    public function actionIndex()
    {
        $orders = $this->ordersModel->getAllOrdersWithItems();
        return $this->render(['orders' => $orders], 'admin/allorders');
    }

    public function actionEdit($params)
    {
        $id = $params[0] ?? null;

        if (!$id) {
            $this->redirect('/adminorder');
        }

        $order = $this->ordersModel->getOrderById($id);
        if (!$order) {
            $this->redirect('/adminorder');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            $address = $_POST['address'] ?? '';
            $city = $_POST['city'] ?? '';
            $totalPrice = $_POST['total_price'] ?? 0;
            $items = $_POST['items'] ?? [];

            if (!empty($status) && !empty($address) && !empty($city)) {
                $this->ordersModel->updateOrder($id, $status, $address, $city, $totalPrice);
            }

            $this->redirect('/adminorder');
        }

        return $this->render(['order' => $order], 'admin/editorder');
    }

    public function actionDelete($params)
    {
        $id = $params[0] ?? null;

        if ($id) {
            $order = $this->ordersModel->getOrderById($id);
            if ($order) {
                $this->ordersModel->deleteOrder($id);
            }
        }

        $this->redirect('/adminorder');
    }
}
