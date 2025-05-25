<?php
session_start();
include_once "../includes/conexion.php"; 

$conexion = new Connection();
$db = $conexion->connect(); 

if (!isset($_SESSION['usuario']['id'])) {
    header("Location: login.php");
    exit;
}

// Obtener datos del usuario en sesión
$usuario_id = $_SESSION['usuario']['id'];
$stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - PostClick</title>
    <link rel="stylesheet" href="../css/perfil.css">
</head>

<body>




    <div class="contenedor-perfil">
        <?php include_once "../includes/navbar.php"; ?>
        <?php include '../pages/musica.php'; ?>

        <section class="perfil">
            <form id="formPerfil" enctype="multipart/form-data">
                <div class="foto-perfil">
                    <img id="fotoPreview" src="data:image/jpeg;base64,<?= base64_encode($usuario['foto_perfil']) ?>" alt="Foto de perfil">
                    <input type="file" name="foto_perfil" accept="image/*" onchange="mostrarVistaPrevia(event)">
                </div>

                <label style="display:block; margin-top:10px;">Nombre(s):</label>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

                <label style="display:block; margin-top:10px;">Correo:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

                <label style="display:block; margin-top:10px;">Tu contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Nueva contraseña">

                <label style="display:block; margin-top:10px;">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>" required>

                <!-- Puedes agregar un campo oculto para el ID -->
                <input type="hidden" name="id" id="id" value="<?= $usuario['id'] ?>">

                <button type="button" onclick="actualizarPerfil()">Guardar Cambios</button>
            </form>
        </section>
    </div>

    <script src="../js/perfil.js"></script>
</body>
</html>
