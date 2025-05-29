<?php

namespace models;

use core\DB;
use PDO;
use core\Core;

class Orders{
    private $db;
    public function __construct() {
        $this->db = DB::getConnection();
    }
    public function createOrder($userId, $totalPrice, $address, $city){

        $stmt = $this->db->prepare("
            INSERT INTO orders (user_id, total_price, address, city)
            VALUES (:user_id, :total_price, :address, :city)
        ");

        $stmt->execute([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'address' => $address,
            'city' => $city
        ]);

        return $this->db->lastInsertId();
    }

    public function addOrderItem($orderId, $productId, $quantity, $price){
        $pdo = Core::get()->db->pdo;

        $stmt = $this->db->prepare("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (:order_id, :product_id, :quantity, :price)
        ");

        $stmt->execute([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }
    public function getOrdersByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT o.*, oi.product_id, oi.quantity, oi.price, i.name AS product_name
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            LEFT JOIN instruments i ON i.id = oi.product_id
            WHERE o.user_id = :user_id
            ORDER BY o.created_at DESC
        ");
        $stmt->execute(['user_id' => $userId]);

        $rawResults = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($rawResults as $row) {
            $orderId = $row['id'];
            if (!isset($orders[$orderId])) {
                $orders[$orderId] = [
                    'id' => $orderId,
                    'total_price' => $row['total_price'],
                    'address' => $row['address'],
                    'city' => $row['city'],
                    'status' => $row['status'],
                    'created_at' => $row['created_at'],
                    'items' => []
                ];
            }
            if ($row['product_id']) {
                $orders[$orderId]['items'][] = [
                    'product_name' => $row['product_name'],
                    'quantity' => $row['quantity'],
                    'price' => $row['price']
                ];
            }
        }

        return $orders;
    }
    public function getOrderById($orderId){
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $orderId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function cancelOrder($orderId) {
        $stmt = $this->db->prepare("UPDATE orders SET status = 'Скасовано' WHERE id = :id");
        $stmt->execute(['id' => $orderId]);
    }
}