<?php
session_start();

if (!isset($_SESSION['usuario']['id'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['receptor_id'])) {
    echo "Falta el receptor_id.";
    exit;
}

$receptor_id = $_GET['receptor_id'];
$emisor_id = $_SESSION['usuario']['id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/chat2.css">
</head>
<body data-receptor-id="<?= htmlspecialchars($receptor_id) ?>" data-emisor-id="<?= htmlspecialchars($emisor_id) ?>">
    <?php include_once "../includes/navbar.php"; ?>
    
    <div id="chat">
        <div id="mensajes"></div>
        <form id="formMensaje">
            <input type="text" id="mensaje" placeholder="Escribe un mensaje..." autocomplete="off">
            <button type="submit">Enviar</button>
        </form>
        <button type="button" id="btnUbicacion">📍 Enviar mi ubicación</button>
        <button type="button" id="btnGato">😺 Enviar gato</button>
    </div>

    <!-- Scripts externos -->
    
    <script src="../js/adicional.js"></script>
</body>
</html>
