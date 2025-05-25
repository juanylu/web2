<?php
session_start();
if (!isset($_GET['publicacion_id'])) {
    header("Location: publicaciones.php");
    exit;
}
$publicacionId = isset($_GET['publicacion_id']) ? intval($_GET['publicacion_id']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios - PostClick</title>
    <link rel="stylesheet" href="../css/comentarios.css">
</head>
<body>
    <?php include_once "../includes/navbar.php"; ?>

    <div class="contenedor-comentarios">
        <div id="contenido-publicacion"></div>

        <h3>Comentarios</h3>
        <div id="lista-comentarios"></div>

       
        <form id="form-comentario">
            <input type="hidden" name="publicacion_id" value="<?php echo $publicacionId; ?>">
            <textarea name="contenido" placeholder="Escribe tu comentario..." required></textarea>
            <button type="submit">Comentar</button>
        </form>
    </div>

    <script>
        window.publicacionId = <?php echo $publicacionId; ?>;
    </script>
    <script src="../js/comentarios.js"></script>
</body>
</html>
