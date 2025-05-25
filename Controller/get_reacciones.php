<?php
session_start();
require_once "../includes/reacciones_model.php";

if (!isset($_GET['publicacion_id'])) {
    echo json_encode(["success" => false, "error" => "ID no proporcionado"]);
    exit;
}

$publicacion_id = $_GET['publicacion_id'];
$usuario_id = $_SESSION['usuario']['id'] ?? null;

$reacciones = new Reacciones();
$likes = $reacciones->contarReacciones($publicacion_id, 'like');
$dislikes = $reacciones->contarReacciones($publicacion_id, 'dislike');
$reaccionUsuario = $usuario_id ? $reacciones->obtenerReaccionUsuario($publicacion_id, $usuario_id) : null;

echo json_encode([
    "success" => true,
    "likes" => $likes,
    "dislikes" => $dislikes,
    "reaccionUsuario" => $reaccionUsuario
]);
