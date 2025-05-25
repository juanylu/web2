<?php
include_once(dirname(__DIR__).'/includes/conexion.php');

class Reportes extends Connection {
    
    public function ContarUsuarios() {
        $this->connect();
    
        $stmt = $this->dbh->prepare("CALL sp_contar_usuarios_simple()");
        $stmt->execute();
    
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->disconnect();
        return $result; 
    }
    
    public function ContarPublicaciones() {
        $this->connect();
    
        $stmt = $this->dbh->prepare("CALL sp_contar_publicaciones_simple()");
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->disconnect();
        return $result; 
    }

    public function ContarPublicacionesPorNombre($nombreUsuario) {
        $this->connect();
    
        $stmt = $this->dbh->prepare("CALL sp_contar_publicaciones_usuario(?)");
        $stmt->bindParam(1, $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->disconnect();
        return $result; 
    }
    
    

}

?>