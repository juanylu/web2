<?php

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

            <div class="formulario-mensaje">
            <input type="text" id="inputNombre" placeholder="Escribe el usuario con el que quieras hablar..." required>
            <button onclick="buscarUsuarioPorNombre()">Buscar</button>
            </div> 
            <br>
        <section class="chat" >

            <!-- CAMBIOS VALERIA CHAT -->
        
            <div id="mensajes" ></div>
        
        

           
            <!-- Más mensajes... -->

        </section>

        <div class="formulario-mensaje">
            <input type="text" id="inputMensaje" placeholder="Escribe tu mensaje..." required>
            <button onclick="insertarMensaje()">Enviar</button>
        </div>

        
    </div>
<script>
    const idUsuarioActual = <?= $_SESSION['usuario']['id'] ?>;
</script>

</body>
<script src="../pages/Chat_Prueba/chat.js"></script>
</html>

