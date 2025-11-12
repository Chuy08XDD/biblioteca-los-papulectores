<?php
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $base_datos = "biblioteca";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->usuario, $this->password, $this->base_datos);
            $this->conn->set_charset("utf8");
            
            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error de base de datos: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>