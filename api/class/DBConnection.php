<?php

class DBConnection
{
    private $db_host = "127.0.0.1";
    private $db_name = "database_api";
    private $db_user = "root";
    private $db_pass = "";
    private $db_conn;

    public function __construct()
    {
        try {
            $this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8", $this->db_user, $this->db_pass);
            $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->db_conn;
    }
}