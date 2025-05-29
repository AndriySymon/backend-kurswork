<?php

namespace core;
use PDO;
use PDOException;

class DB{
    public $pdo;
    public function __contruct($host, $name, $login, $password){
        $this->pdo = new \PDO("mysql:host={$host};dbname={$name}", $login, $password);
    }
     private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO("mysql:host=localhost;dbname=music_shop;charset=utf8", "root", "");
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("DB connection error: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}