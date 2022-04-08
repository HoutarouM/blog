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

            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

            include './view/error.php';
        }
    }

    public function read($query, $args = [])
    {
        $con = $this->db_connect();

        $stmt = $con->prepare($query);

        for ($i = 1; $i <= count($args); $i++) {
            $stmt->bindValue($i, $args[$i - 1]);

            // echo $args[$i - 1] . "<br/>";
        }

        $stmt->execute();

        $con = null;

        return $stmt;
    }

    public function write($query, $args = [])
    {
        $con = $this->db_connect();

        $stmt = $con->prepare($query);

        for ($i = 1; $i <= count($args); $i++) {
            $stmt->bindValue($i, $args[$i - 1]);
        }

        $stmt->execute();

        $con = null;
    }
}
