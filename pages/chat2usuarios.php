<?php
session_start();
include_once "../includes/conexion.php";

if (!isset($_SESSION['usuario']['id'])) {
    header("Location: login.php");
    exit;
}

$conexion = new Connection();
$db = $conexion->connect();

$mi_id = $_SESSION['usuario']['id'];

$sql = "
    SELECT u.id, u.nombre, u.foto_perfil,
           (SELECT mensaje FROM mensajes 
            WHERE (emisor_id = :mi_id AND receptor_id = u.id) 
               OR (emisor_id = u.id AND receptor_id = :mi_id)
            ORDER BY fecha_envio DESC LIMIT 1) as ultimo_mensaje
    FROM usuarios u
    WHERE u.id != :mi_id
";

$stmt = $db->prepare($sql);
$stmt->bindParam(":mi_id", $mi_id);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios para chatear</title>
    <link rel="stylesheet" href="../css/listado.css">
   
</head>
<body>
    <?php include_once "../includes/navbar.php"; ?>
    <h2>Elige un usuario para chatear</h2>
    <div class="lista-usuarios">
        <?php foreach ($usuarios as $usuario): ?>
            <a class="usuario" href="chat2.php?receptor_id=<?= $usuario['id'] ?>">
                <?php if (!empty($usuario['foto_perfil'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($usuario['foto_perfil']) ?>" alt="Perfil">
                <?php else: ?>
                    <img src="../img/default-avatar.png" alt="Perfil">
                <?php endif; ?>
                <div class="info">
                    <span class="nombre"><?= htmlspecialchars($usuario['nombre']) ?></span>
                    <span class="mensaje"><?= htmlspecialchars($usuario['ultimo_mensaje'] ?? 'Sin mensajes aún') ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
