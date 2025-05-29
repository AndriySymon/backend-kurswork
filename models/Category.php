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
}
