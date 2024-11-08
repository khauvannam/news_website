<?php

class model
{
    protected ?PDO $conn = null;

    function __construct()
    {
        try {
            $str = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
            $this->conn = new PDO($str, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die("Lỗi kết nối db: " . $e->getMessage());
        }
    }

    function query($sql)
    {
        try {
            return $this->conn->query($sql);
        } catch (Exception $e) {
            die("Lỗi truy vấn data: " . $e->getMessage() . "<br>" . $sql);
        }
    }

    function queryOne($sql)
    {
        try {
            $result = $this->conn->query($sql);
            return $result->fetch();
        } catch (Exception $e) {
            die("Lỗi lấy record: " . $e->getMessage() . "<br>" . $sql);
        }
    }


}