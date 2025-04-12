<?php
class Connection {
    protected $dbname = 'ponclick';
    protected $user = 'root';
    protected $password = '';

    protected $dbh;

    public function connect(){
        try{
            $connection_string = "mysql:host=localhost;dbname=$this->dbname";
            $this->dbh = new PDO($connection_string, $this->user, $this->password);

            

        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function disconnect(){
        $this->dbh = null;
    }
}

?>
