<?php
session_start();
require_once "../includes/conexion.php";

$conexion = new Connection();
$db = $conexion->connect();

// GET: obtener publicación y comentarios
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['publicacion_id'])) {
    $publicacion_id = $_GET['publicacion_id'];

    $stmt = $db->prepare("SELECT p.*, u.nombre AS usuario FROM publicaciones p JOIN usuarios u ON p.usuario_id = u.id WHERE p.id = ?");
    $stmt->execute([$publicacion_id]);
    $publicacion = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($publicacion && $publicacion['imagen']) {
        $publicacion['imagen'] = base64_encode($publicacion['imagen']);
    }

    $stmt = $db->prepare("SELECT c.*, u.nombre AS usuario FROM comentarios c JOIN usuarios u ON c.usuario_id = u.id WHERE c.publicacion_id = ? ORDER BY c.fecha_comentario ASC");
    $stmt->execute([$publicacion_id]);
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "publicacion" => $publicacion,
        "comentarios" => $comentarios
    ]);
    exit;
}

// POST: crear nuevo comentario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario']['id'])) {
        echo json_encode(["success" => false, "message" => "Usuario no autenticado"]);
        exit;
    }

    $contenido = $_POST['contenido'] ?? '';
    $publicacion_id = $_POST['publicacion_id'] ?? '';

    if (trim($contenido) === '' || !$publicacion_id) {
        echo json_encode(["success" => false, "message" => "Campos incompletos"]);
        exit;
    }

    $usuario_id = $_SESSION['usuario']['id'];

    try {
        $stmt = $db->prepare("INSERT INTO comentarios (contenido, usuario_id, publicacion_id, fecha_comentario) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$contenido, $usuario_id, $publicacion_id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error al insertar comentario."]);
    }

    exit;
}
