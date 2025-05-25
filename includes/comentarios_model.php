<?php
require_once "../includes/conexion.php";

class Comentarios {
    private $db;

    public function __construct() {
        $conexion = new Connection();
        $this->db = $conexion->connect();
    }

    public function obtenerComentarios($publicacion_id) {
        $stmt = $this->db->prepare("SELECT c.*, u.nombre FROM comentarios c JOIN usuarios u ON c.usuario_id = u.id WHERE c.publicacion_id = ? ORDER BY c.fecha ASC");
        $stmt->execute([$publicacion_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarComentario($publicacion_id, $usuario_id, $comentario) {
        $stmt = $this->db->prepare("INSERT INTO comentarios (publicacion_id, usuario_id, comentario) VALUES (?, ?, ?)");
        return $stmt->execute([$publicacion_id, $usuario_id, $comentario]);
    }
}
