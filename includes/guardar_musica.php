<?php
session_start();
require_once '../includes/conexion.php';
$conn = new Connection();
$dbh = $conn->connect();

$usuario_id = $_SESSION['usuario']['id'];
$cancion = $_POST['cancion'] ?? '';

if ($cancion) {
    $stmt = $dbh->prepare("SELECT id FROM musica_usuario WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    if ($stmt->rowCount() > 0) {
        $stmt = $dbh->prepare("UPDATE musica_usuario SET cancion = ? WHERE usuario_id = ?");
        $stmt->execute([$cancion, $usuario_id]);
    } else {
        $stmt = $dbh->prepare("INSERT INTO musica_usuario (usuario_id, cancion) VALUES (?, ?)");
        $stmt->execute([$usuario_id, $cancion]);
    }
}
