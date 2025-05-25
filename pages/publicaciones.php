<?php
session_start();
include_once "../includes/conexion.php"; 
include_once "../includes/reacciones_model.php";



$conexion = new Connection();
$db = $conexion->connect(); 
if (!isset($_SESSION['usuario']['id'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones - PostClick</title>
    <link rel="stylesheet" href="../css/publicaciones.css">
</head>
<body>
    <div class="contenedor-publicaciones">

        <?php include_once "../includes/navbar.php"; ?>

        <section class="nueva-publicacion">
            <form action="../Controller/publicaciones_controller.php" method="POST" enctype="multipart/form-data">
                <textarea name="contenido" placeholder="¿Qué estás pensando?" required></textarea>

                <select name="categoria_id" id="select-categorias" required>
    <option value="">Selecciona una categoría</option>
</select>


                <input type="file" name="imagen" accept="image/*">
              <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario']['id']; ?>">

                <button type="submit" name="crear_publicacion">Publicar</button>
            </form>

            <section id="publicaciones" class="publicaciones">
                <!-- Aquí se cargarán las publicaciones -->
            </section>
        </section>

    </div>

    <script src="../js/categorias.js"></script>
    <script src="../js/cargarpublis.js"></script>
    <script src="../js/comentarios.js"></script>
    <script src="../js/reacciones.js"></script>
</body>
</html>
