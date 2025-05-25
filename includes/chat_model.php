<?php
include_once(dirname(__DIR__).'/includes/conexion.php');

class Chat extends Connection {
    public function InsertarMensaje($mensaje, $idPrimerUsuario, $idSegundoUsuario, $idUsuarioMensaje) {
        $this->connect();

        $stmt = $this->dbh->prepare("CALL sp_insertar_mensaje(?, ?, ?, ?)");
        $stmt->bindParam(1, $mensaje, PDO::PARAM_STR);
        $stmt->bindParam(2, $idPrimerUsuario, PDO::PARAM_INT);
        $stmt->bindParam(3, $idSegundoUsuario, PDO::PARAM_INT);
        $stmt->bindParam(4, $idUsuarioMensaje, PDO::PARAM_INT);

        $stmt->execute();
        $this->disconnect();
    }

    public function ObtenerMensajes($idPrimerUsuario, $idSegundoUsuario) {
        $this->connect();

        $stmt = $this->dbh->prepare("CALL sp_obtener_mensajes(?, ?)");
        $stmt->bindParam(1, $idPrimerUsuario);
        $stmt->bindParam(2, $idSegundoUsuario);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }

}
?>