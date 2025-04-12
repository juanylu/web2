<?php
// Luego aquí podrías traer los datos reales del usuario y sus mensajes
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - PostClick</title>
    <link rel="stylesheet" href="../css/mensajes.css">
</head>
<body>
    <div class="contenedor-mensajes">
        
         <?php
         include_once "../includes/navbar.php";
         ?>

        <section class="chat">

            <!-- Mensaje del receptor -->
            <div class="mensaje-contenedor receptor">
                <img class="foto-usuario" src="../img/descarga.jpg" alt="Sebastian">
                <div class="mensaje">
                    <h4 class="nombre-usuario">Sebastian Gomez</h4>
                    <p>¡Hola! ¿Cómo estás?</p>
                    <span class="hora">10:15 AM</span>
                </div>
            </div>

            <!-- Mensaje del emisor -->
            <div class="mensaje-contenedor emisor">
                <img class="foto-usuario" src="../img/Matching snoopy pfp pt_1 _3.jpg" alt="Tú">
                <div class="mensaje">
                    <h4 class="nombre-usuario">Yo</h4>
                    <p>¡Hola! Muy bien, gracias. ¿Y tú?</p>
                    <span class="hora">10:16 AM</span>
                </div>
            </div>

            <!-- Más mensajes... -->

        </section>

        <form class="formulario-mensaje">
            <input type="text" placeholder="Escribe tu mensaje..." required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

