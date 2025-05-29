<?php

namespace models;

use core\DB;
use PDO;

class Instruments{
    public $id;
    public $name;
    public $text;
    public $short_text;
    public function __construct(){
        
    }
    public static function getById($id) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM instruments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getAttributes($instrumentId) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT attribute_name, attribute_value FROM instrument_attributes WHERE instrument_id = ?");
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
}