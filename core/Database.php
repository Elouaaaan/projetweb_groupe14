<?php

namespace Core;

use PDO;
use PDOException;


class Database
{
    private static $instance = null;
    private $connection = null;

    private function __construct()
    {
        if ($this->connection === null) {
            $this->connect();
        }
    }

    private function connect()
    {
        $conn = getenv('DB_CONNECTION');
        $host = getenv('DB_HOST');
        $name = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];
        
        try {
            $this->connection = new PDO("$conn:host=$host;dbname=$name", $user, $pass, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
