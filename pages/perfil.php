<?php
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

        <section class="perfil">
            <form id="formPerfil" enctype="multipart/form-data">
                <div class="foto-perfil">
                    <img id="fotoPreview" src="../img/default.jpg" alt="Foto de perfil">
                    <input type="file" name="foto_perfil" accept="image/*" onchange="mostrarVistaPrevia(event)">
                </div>

                <label style="display:block; margin-top:10px;">Nombre(s):</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>

                <label style="display:block; margin-top:10px;">Correo:</label>
                <input type="email" name="email" id="email" placeholder="Correo" required>

                <label style="display:block; margin-top:10px;">Tu contrasena:</label>
                <input type="password" name="password" id="password" placeholder="Nueva contraseña">

                <label style="display:block; margin-top:10px;">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>

                <button type="button" onclick="actualizarPerfil()">Guardar Cambios</button>
            </form>
        </section>
    </div>

    
    <script src="../js/perfil.js"></script>
</body>
</html>
