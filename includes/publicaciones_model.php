<?php
include_once(dirname(__DIR__) . '/includes/conexion.php');

class Publicaciones extends Connection {

    public function CrearPublicacion($usuarioId, $contenido, $imagen, $categoriaId) {
        $conn = $this->connect();

        $query = "INSERT INTO publicaciones (usuario_id, contenido, imagen, categoria_id)
                  VALUES (:usuario_id, :contenido, :imagen, :categoria_id)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':usuario_id', $usuarioId);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        $stmt->bindParam(':categoria_id', $categoriaId);

        return $stmt->execute();
    }

    public function ObtenerPublicaciones() {
        $conn = $this->connect();

        $query = "SELECT p.*, u.nombre AS nombre_usuario, c.nombre AS nombre_categoria 
                  FROM publicaciones p
                  JOIN usuarios u ON p.usuario_id = u.id
                  JOIN categorias c ON p.categoria_id = c.id
                  ORDER BY p.fecha_publicacion DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
