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

if (isset($_GET['categoria']) || isset($_GET['orden']) || isset($_GET['busqueda'])) {
    include_once "../includes/filtros_model.php";
    $modelo = new Publicaciones();

    $categoria = $_GET['categoria'] ?? null;
    $orden = $_GET['orden'] ?? 'reciente';
    $busqueda = $_GET['busqueda'] ?? null;

    $publicaciones = $modelo->FiltrarPublicaciones($categoria, $orden, $busqueda);

    // Convertir imagen y foto_perfil a base64
    foreach ($publicaciones as &$pub) {
        if (!empty($pub['imagen'])) {
            $pub['imagen'] = base64_encode($pub['imagen']);
        }
        if (!empty($pub['foto_perfil'])) {
            $pub['foto_perfil'] = base64_encode($pub['foto_perfil']);
        }
        $pub['fecha_publicacion'] = date('d/m/Y', strtotime($pub['fecha_publicacion']));
    }

    header('Content-Type: application/json');
    echo json_encode($publicaciones);
    exit;
}


?>