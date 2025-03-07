<?php
class Conexion {
    private $servidor = "127.0.0.1";
    private $usuario = "root";
    private $password = "root";
    private $base_datos = "DBponclick";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->servidor,
            $this->usuario,
            $this->password,
            $this->base_datos
        );

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }
    public function cerrar() {
        $this->conn->close();
    }
}
?>