<?php
class Connection {
    protected $dbname = 'postclickuni';
    protected $user = 'root';
    protected $password = '';
    protected $host = 'localhost';

    protected $dbh;

    public function connect() {
        try {
            $connection_string = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->dbh = new PDO($connection_string, $this->user, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbh; //Retorna la conexión
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null; //Por si la conexión falla
        }
    }

    public function disconnect() {
        $this->dbh = null;
    }
}
?>
