<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - PonClick!</title>
    <link rel="stylesheet" href="../css/inicio.css">
</head>
<body>
    <div class="contenedor-feed">
        
            
         <?php
         include_once "../includes/navbar.php";
         ?>
        

        <section class="publicaciones">
            <!-- Publicación 1 -->
        <div class="publicacion">
        <div class="usuario">
        <img src="../img/descarga.jpg" alt="Usuario">
        <span>Sebastian Gomez</span>
        </div>
    <p>¡Hola mundo! Esta es mi primera publicación.</p>
    <img src="../img/descarga.jpg" alt="Imagen de la publicación">
    <div class="fecha">Publicado el 03/03/2025</div>

    <!-- Reacciones -->
    <div class="reacciones">
        <button class="icono"><span>👍</span></button>
        <button class="icono"><span>👎</span></button>
        <button class="comentar-btn">Comentar</button>
    </div>
    </div>

            <!-- Publicación 1 -->
        <div class="publicacion">
        <div class="usuario">
        <img src="../img/kitti.jpg" alt="Usuario">
        <span>Wawa Martinez</span>
        </div>
    <p>Nueva cuenta amigos, quiero hablar de mi juego favorito</p>
    <img src="../img/Ejemplo publi BG3.jpg" alt="Imagen de la publicación">
    <div class="fecha">Publicado el 03/03/2025</div>

    <!-- Reacciones -->
    <div class="reacciones">
        <button class="icono"><span>👍</span></button>
        <button class="icono"><span>👎</span></button>
        <button class="comentar-btn">Comentar</button>
    </div>
    </div>

            <!-- Publicación 3 -->
        <div class="publicacion">
        <div class="usuario">
        <img src="../img/descarga.jpg" alt="Usuario">
        <span>Sebastian Gomez</span>
        </div>
    <p>Pongan categorias xD</p>
    <img src="../img/CategoriaOk.jpg" alt="Imagen de la publicación">
    <div class="fecha">Publicado el 03/03/2025</div>

    <!-- Reacciones -->
    <div class="reacciones">
        <button class="icono"><span>👍</span></button>
        <button class="icono"><span>👎</span></button>
        <button class="comentar-btn">Comentar</button>
    </div>
    </div>

        </section>
    </div>
</body>
</html>
