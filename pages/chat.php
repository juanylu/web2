<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/chat.css">
</head>
<body>
<?php include_once("../incluir/navbar.php"); ?>  

    <div class="chat-contenedor">

        <!-- Lista de contactos -->
        <div class="chat-contactos">
            <h2>Habla con usuarios</h2>
            <ul>
                <li>Juan Juanin</li>
                <li>Ana Belen</li>
                <li>Juany Guerra</li>
                <li>Laura Ana</li>
            </ul>
        </div>

        <!-- Área de chat -->
        <div class="chat-mensajes">
            <div class="mensajes">
                <div class="mensaje recibido">¡Hola! ¿Cómo estás?</div>
                <div class="mensaje enviado">Muy bien, gracias. ¿Y tú?</div>
                <div class="mensaje recibido">Todo bien tambien </div>
                <div class="mensaje enviado">Bueno. Oye vi tu publicacion mas reciente y coincido</div>
            </div>

            <!-- Input para escribir -->
            <form class="chat-input">
                <input type="text" placeholder="Escribe tu mensaje...">
                <button type="submit">Enviar</button>
            </form>
        </div>

    </div>
</body>
</html>
