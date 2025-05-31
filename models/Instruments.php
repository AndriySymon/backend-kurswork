<?php

namespace models;

use core\DB;
use PDO;

class Instruments{
    public $id;
    public $name;
    public $text;
    public $short_text;
    protected $db;
    public function __construct(){
        $this->db = DB::getConnection();
    }
    public static function getById($id) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM instruments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getAttributes($instrumentId) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT id, attribute_name, attribute_value FROM instrument_attributes WHERE instrument_id = ?");
        $stmt->execute([$instrumentId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getReviews($instrumentId) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM reviews WHERE instrument_id = ? ORDER BY created_at DESC");
        $stmt->execute([$instrumentId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function addReview($instrumentId, $author, $city, $content) {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO reviews (instrument_id, author, city, content) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$instrumentId, $author, $city, $content]);
    }
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM instruments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $short_text, $price, $text, $image, $category_id) {
        $stmt = $this->db->prepare("UPDATE instruments SET name = ?, text = ?, short_text = ?, image=?, category_id = ?, price = ? WHERE id = ?");
        return $stmt->execute([$name, $text, $short_text, $image, $category_id, $price, $id]);
    }
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM instruments WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function add($name, $short_text, $price, $text, $image, $category_id){
        $stmt = $this->db->prepare("INSERT INTO instruments (name, text, short_text, image, category_id, price) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $text, $short_text, $image, $category_id, $price]);
    }

    public static function getAll(){
        $db = DB::getConnection();
        $stmt = $db->query("SELECT * FROM instruments");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public static function getAllSorted($order = ''){
        $db = DB::getConnection();

        $order = strtolower($order);
        if ($order === 'desc') {
        $sql = "SELECT * FROM instruments ORDER BY price DESC";
        } else if ($order === 'asc') {
            $sql = "SELECT * FROM instruments ORDER BY price ASC";
        } else {
            $sql = "SELECT * FROM instruments";
        }

        $stmt = $db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}