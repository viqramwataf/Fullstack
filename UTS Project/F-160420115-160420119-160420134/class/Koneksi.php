<?php
class Koneksi 
{
    private $conn;
    public function __construct($ip = "localhost", $username = "ken", $password = "ken", $database = "perkuliahan")
    // ini dirubah saja kalo pengen pake ip, username, password, dan database yang kamu sudah set kalo memang beda
    {
        
        $this->conn = new mysqli($ip, $username, $password, $database);
        if ($this->conn->connect_error) {
            exit("Connection failed: $this->conn->connect_error");
        }
    }

    public function prepare($sql)
    {
        # code...
        return $this->conn->prepare($sql);
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * Get the value of conn
     */ 
    public function getConn()
    {
        return $this->conn;
    }
}
