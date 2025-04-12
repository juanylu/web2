<?php
include_once(dirname(__DIR__).'/includes/conexion.php');

class Usuarios extends Connection {
    public function InsertarUsuario($nombre, $email, $password, $fechaNacimiento, $fotoPerfil) {
        $this->connect();

        $stmt = $this->dbh->prepare("CALL sp_insertar_usuario(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $password, PDO::PARAM_STR);
        $stmt->bindParam(4, $fechaNacimiento, PDO::PARAM_STR);
        $stmt->bindParam(5, $fotoPerfil, PDO::PARAM_STR);

        $stmt->execute();
        $this->disconnect();
    }

    public function ObtenerUsuarios() {
        $this->connect();

        $stmt = $this->dbh->prepare("CALL sp_select_usuarios()");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }

    public function ModificarUsuario($id, $nombre, $email, $password, $fechaNacimiento, $fotoPerfil) {
        $this->connect();
    
        // Tener los datos actuales del usuario
        $stmtSelect = $this->dbh->prepare("CALL sp_select_usuario_por_id(?)");
        $stmtSelect->bindParam(1, $id, PDO::PARAM_INT);
        $stmtSelect->execute();
        $usuarioActual = $stmtSelect->fetch(PDO::FETCH_ASSOC);
        $stmtSelect->closeCursor(); 
    
        // Si no se proporcionó nueva contraseña, mantener la actual
        if ($password === null || trim($password) === '') {
            $password = $usuarioActual['password'];
        }
    
        if ($fotoPerfil === null || empty($fotoPerfil)) {
            $fotoPerfil = $usuarioActual['foto_perfil'];
        }
    
        // Actualizar el usuario
        $stmtUpdate = $this->dbh->prepare("CALL sp_actualizar_usuario(?, ?, ?, ?, ?, ?)");
        $stmtUpdate->bindParam(1, $id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmtUpdate->bindParam(3, $email, PDO::PARAM_STR);
        $stmtUpdate->bindParam(4, $password, PDO::PARAM_STR);
        $stmtUpdate->bindParam(5, $fechaNacimiento, PDO::PARAM_STR);
        $stmtUpdate->bindParam(6, $fotoPerfil, PDO::PARAM_LOB); // Para imagen blob
    
        $stmtUpdate->execute();
    
        $this->disconnect();
    }
    

    public function EliminarUsuario($id) {
        $this->connect();

        $stmt = $this->dbh->prepare("CALL sp_eliminar_usuario(?)");
        $stmt->bindParam(1, $id);

        $stmt->execute();
        $this->disconnect();
    }

    public function ObtenerUsuarioPorId($id) {
        $this->connect();
    
        $stmt = $this->dbh->prepare("CALL sp_select_usuario_por_id(?)");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }

    public function IniciarSesion($email, $password) {
        $this->connect();

        $stmt = $this->dbh->prepare("CALL sp_iniciar_sesion(?, ?)");
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
   
}



    ?>