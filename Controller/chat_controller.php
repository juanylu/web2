<?php
session_start();
include_once(dirname(__DIR__).'/includes/chat_model.php');

// Validar si hay sesión iniciada
if (!isset($_SESSION['usuario']['id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Acceso no autorizado']);
    exit;
}

$idUsuarioSesion = $_SESSION['usuario']['id'];

if(isset($_POST['insertarMensaje'])) {
    $chat = new Chat();

    $mensaje = $_POST['mensaje'];
    $idSegundoUsuario = $_POST['idSegundoUsuario']; 

    $chat->InsertarMensaje($mensaje, $idUsuarioSesion, $idSegundoUsuario, $idUsuarioSesion);
}

if(isset($_POST['obtenerMensajes'])) {
    $chat = new Chat();

    $idSegundoUsuario = $_POST['idSegundoUsuario']; 

    $result = $chat->ObtenerMensajes($idUsuarioSesion, $idSegundoUsuario);

    $arrMensajes = array();

    foreach($result as $row) {
        $obj = array(
            "Mensaje" => $row['Mensaje'],
            "Nombre" => $row['nombre'],
            "Id" => $row['id'],
            "FotoPerfil" => base64_encode($row['foto_perfil'])
        );
        array_push($arrMensajes, $obj);
    }

    echo json_encode($arrMensajes);
}
?>
