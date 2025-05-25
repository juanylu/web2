<?php
include_once "../includes/conexion.php";
$conexion = new Connection();
$db = $conexion->connect();

$stmt = $db->query("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($categorias);
