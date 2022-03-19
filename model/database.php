<?php

namespace App;

use PDO, PDOException;

class Database
{
    private function db_connect()
    {
        try {
            $conn = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "", DB_USER, DB_PASS);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

            // TODO:
            // show error page db connection error
        }
    }

    public function read($query, $args = [])
    {
        $con = $this->db_connect();
    }

    public function write($query, $args = [])
    {
        $con = $this->db_connect();
    }
}
