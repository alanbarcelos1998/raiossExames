<?php

namespace App\Configuration;

use PDO;
use PDOException;

abstract class Connection
{
    private static $conn;

    public static function Connectdb()
    {
        try {
            if (self::$conn == null) {
                self::$conn  = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
            }

            return self::$conn;
        } catch (PDOException $e) {
            echo "Error! " . $e->getMessage();
            die();
        }
    }
}
