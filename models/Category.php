<?php
namespace models;

use core\DB;
use PDO;

require_once realpath(__DIR__ . '/../config/database.php');

class Category {
    public static function getAll() {
        $db = DB::getConnection();
        $stmt = $db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getInstrumentsByCategory($categoryId) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM instruments WHERE category_id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCategoryName($categoryId) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT name FROM categories WHERE id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }

    public static function getById($id){
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $name, $short_text, $image){
        $db = DB::getConnection();
        $stmt = $db->prepare("UPDATE categories SET name = ?, short_text = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $short_text, $image, $id]);
    }

    public static function delete($id){
        $db = DB::getConnection();
        $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function add($name, $short_text, $image){
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO categories (name, short_text, image) VALUES (?,?,?)");
        $stmt->execute([$name, $short_text, $image]);
    }
}
