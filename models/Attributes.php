<?php

namespace models;

use core\DB;
use PDO;

class Attributes{
    public static function addAttribute($instrumentId, $name, $value)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO instrument_attributes (instrument_id, attribute_name, attribute_value) VALUES (?, ?, ?)");
        return $stmt->execute([$instrumentId, $name, $value]);
    }

    public static function getById($id)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM instrument_attributes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function updateAttribute($id, $name, $value)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("UPDATE instrument_attributes SET attribute_name = ?, attribute_value = ? WHERE id = ?");
        return $stmt->execute([$name, $value, $id]);
    }

    public static function deleteAttribute($id)
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("DELETE FROM instrument_attributes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}