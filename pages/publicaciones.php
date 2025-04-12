<?php
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
    
         <?php
         include_once "../includes/navbar.php";
         ?>

        <section class="nueva-publicacion">
            <form>
                <textarea placeholder="¿Qué estás pensando?" required></textarea>
                <input type="file" accept="image/*">
                <button type="submit">Publicar</button>
            </form>
        </section>

        <section class="publicaciones">


        </section>
    </div>
</body>
</html>
