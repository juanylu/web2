<?php
require_once "../includes/conexion.php";

header('Content-Type: application/json');

try {
    $conexion = new Connection();
    $db = $conexion->connect();

    $stmt = $db->prepare("SELECT id, nombre FROM categorias");
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "categorias" => $categorias]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
