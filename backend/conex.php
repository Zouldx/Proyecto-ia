<?php

class DBConfig {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "";

    public function getConnection() {
        $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
?>