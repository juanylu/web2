<?php
include_once("../includes/conexion.php");

if (isset($_POST['crear_publicacion'])) {
    $contenido = $_POST['contenido'];
    $categoria_id = $_POST['categoria_id'];
    $usuario_id = $_POST['usuario_id'];

    if (empty($contenido) || empty($categoria_id) || empty($usuario_id)) {
        echo "Faltan datos";
        exit;
    }

    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name'] != '') {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    $conexion = new Connection();
    $db = $conexion->connect();

    try {
        $sql = "INSERT INTO publicaciones (usuario_id, contenido, imagen, categoria_id)
                VALUES (:usuario_id, :contenido, :imagen, :categoria_id)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->execute();

        header("Location: ../pages/publicaciones.php");
        exit;
    } catch (PDOException $e) {
        echo "Error al insertar publicación: " . $e->getMessage();
    }
}

if (isset($_GET['obtener_publicaciones'])) {
    $conexion = new Connection();
    $db = $conexion->connect();

    try {
        $sql = "SELECT 
                    p.id,
                    p.contenido,
                    p.imagen,
                    p.fecha_publicacion,
                    u.nombre AS usuario,
                    u.foto_perfil,
                    c.nombre AS categoria
                FROM publicaciones p
                JOIN usuarios u ON p.usuario_id = u.id
                JOIN categorias c ON p.categoria_id = c.id
                ORDER BY p.fecha_publicacion DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $publicaciones = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $publicaciones[] = [
                'id' => $row['id'],
                'usuario' => $row['usuario'],
                'contenido' => $row['contenido'],
                'imagen' => $row['imagen'] ? base64_encode($row['imagen']) : null,
                'fecha_publicacion' => date('d/m/Y', strtotime($row['fecha_publicacion'])),
                'categoria' => $row['categoria'],
                'foto_perfil' => $row['foto_perfil'] ? base64_encode($row['foto_perfil']) : null
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($publicaciones);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
