<?php
session_start();
require_once "../includes/reacciones_model.php";

if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode(["success" => false, "error" => "No autenticado"]);
    exit;
}

if (isset($_POST['publicacion_id']) && isset($_POST['tipo'])) {
    $publicacion_id = $_POST['publicacion_id'];
    $tipo = $_POST['tipo'];
    $usuario_id = $_SESSION['usuario']['id'];
    $reaccion = new Reacciones();
    $nuevaReaccion = $reaccion->registrarReaccion($publicacion_id, $usuario_id, $tipo);

    echo json_encode([
        "success" => true,
        "reaccion_usuario" => $reaccion->obtenerReaccionUsuario($publicacion_id, $usuario_id),
        "likes" => $reaccion->contarReacciones($publicacion_id, 'like'),
        "dislikes" => $reaccion->contarReacciones($publicacion_id, 'dislike')
    ]);
    exit;
}

echo json_encode(["success" => false, "error" => "Parámetros inválidos"]);
