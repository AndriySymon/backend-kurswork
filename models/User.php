<?php

namespace models;

use core\DB;
use PDO;

class User{
    protected $db;

    public function __construct() {
        $this->db = DB::getConnection();
    }
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($firstName, $lastName, $email, $phone, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?,?,?,?,?)");
        return $stmt->execute([$firstName, $lastName, $email, $phone, $hashedPassword]);
    }
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $firstName, $lastName, $email, $phone)
    {
        $stmt = $this->db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$firstName, $lastName, $email, $phone, $id]);
    }
    public function deleteById($id){
        $stmt = $this->db->prepare("DELETE FROM users WHERE id= ?");
        return $stmt->execute([$id]);
    }   
}