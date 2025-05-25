<?php
require_once "../includes/conexion.php";

class Reacciones {
    private $db;

    public function __construct() {
        $conexion = new Connection();
        $this->db = $conexion->connect();
    }

    public function obtenerReaccionUsuario($publicacion_id, $usuario_id) {
        $stmt = $this->db->prepare("SELECT tipo FROM reacciones WHERE publicacion_id = ? AND usuario_id = ?");
        $stmt->execute([$publicacion_id, $usuario_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['tipo'] : null;
    }

    public function contarReacciones($publicacion_id, $tipo) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM reacciones WHERE publicacion_id = ? AND tipo = ?");
        $stmt->execute([$publicacion_id, $tipo]);
        return $stmt->fetchColumn();
    }

    public function registrarReaccion($publicacion_id, $usuario_id, $tipo) {
        $reaccionExistente = $this->obtenerReaccionUsuario($publicacion_id, $usuario_id);
        if ($reaccionExistente == $tipo) {
            $stmt = $this->db->prepare("DELETE FROM reacciones WHERE publicacion_id = ? AND usuario_id = ?");
            $stmt->execute([$publicacion_id, $usuario_id]);
            return null;
        } elseif ($reaccionExistente) {
            $stmt = $this->db->prepare("UPDATE reacciones SET tipo = ? WHERE publicacion_id = ? AND usuario_id = ?");
            $stmt->execute([$tipo, $publicacion_id, $usuario_id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO reacciones (publicacion_id, usuario_id, tipo) VALUES (?, ?, ?)");
            $stmt->execute([$publicacion_id, $usuario_id, $tipo]);
        }
        return $tipo;
    }
}
