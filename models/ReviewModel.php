<?php

namespace models;

use core\DB;
use PDO;

class ReviewModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getLatestReviews($limit = 4) {
        $stmt = $this->db->prepare("SELECT * FROM reviews ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
