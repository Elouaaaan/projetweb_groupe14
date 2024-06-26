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
        $db_config = require_once(__DIR__ . '/../config/database.php');
        $conn = $db_config['conn'];
        $host = $db_config['host'];
        $name = $db_config['name'];
        $user = $db_config['user'];
        $pass = $db_config['pass'];

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
