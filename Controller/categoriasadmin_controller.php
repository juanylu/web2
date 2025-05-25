<?php
require_once '../includes/conexion.php';

$conexion = new Connection();
$db = $conexion->connect();

$mensaje = "";

// Crear categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        $stmt = $db->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nombre);

        $mensaje = $stmt->execute()
            ? "✅ Categoría creada correctamente."
            : "❌ Error al crear la categoría.";
    } else {
        $mensaje = "⚠️ El nombre no puede estar vacío.";
    }
}

// Obtener categorías
$categorias = [];
$stmt = $db->query("SELECT * FROM categorias ORDER BY fecha_creacion DESC");
if ($stmt) {
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
