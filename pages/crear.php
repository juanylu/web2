<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Publicación</title>
    <link rel="stylesheet" href="../css/crear.css">
</head>
<body>
<?php include_once("../incluir/navbar.php"); ?> 

    <div class="contenedor-publicacion">
        <div class="formulario-publicacion">
            <h2>Escribe lo que tu quieras...</h2>
            <form action="../procesos/publicacion_procesar.php" method="POST">

                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Escribe un título" required>

                <label for="contenido">Contenido:</label>
                <textarea name="contenido" id="contenido" placeholder="Comparte lo que quieras..." rows="5" required></textarea>

                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <option value="Animacion">Animacion</option>
                    <option value="Horror">Horror</option>
                    <option value="Videojuegos">Videojuegos</option>
                    <option value="Tecnología">Tecnología</option>
                    <option value="Noticias">Noticias</option>
                </select>

                <button type="submit" class="btn btn-warning">Subir</button>

            </form>
        </div>
    </div>
</body>
</html>
