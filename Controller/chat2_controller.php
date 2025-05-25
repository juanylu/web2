<?php
session_start();
require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario']['id'])) {
    http_response_code(401); // No autorizado
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$conexion = new Connection();
$db = $conexion->connect();
$emisor_id = $_SESSION['usuario']['id'];

// GUARDAR UN MENSAJE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receptor_id = $_POST['receptor_id'] ?? null;
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (!$receptor_id || $mensaje === '') {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(['error' => 'Datos incompletos']);
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO mensajes (emisor_id, receptor_id, mensaje, fecha_envio) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$emisor_id, $receptor_id, $mensaje]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500); // Error de servidor
        echo json_encode(['error' => 'Error al guardar mensaje']);
    }
    exit;
}

// OBTENER MENSAJES ENTRE DOS USUARIOS (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['receptor_id'])) {
    $receptor_id = $_GET['receptor_id'];

    try {
        $stmt = $db->prepare("
            SELECT emisor_id, receptor_id, mensaje, fecha_envio
            FROM mensajes
            WHERE (emisor_id = ? AND receptor_id = ?) OR (emisor_id = ? AND receptor_id = ?)
            ORDER BY fecha_envio ASC
        ");
        $stmt->execute([$emisor_id, $receptor_id, $receptor_id, $emisor_id]);
        $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($mensajes);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al obtener mensajes']);
    }
    exit;
}

// Si no se reconoce la solicitud
http_response_code(400);
echo json_encode(['error' => 'Solicitud no válida']);
