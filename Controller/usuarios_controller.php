<?php
ob_start(); // Previene salida inesperada
session_start();

error_reporting(0); // Silencia errores visibles
ini_set('display_errors', 0);

header('Access-Control-Allow-Origin: *'); // Opcional: útil si usas peticiones desde otros dominios

include_once(dirname(__DIR__).'/includes/usuarios_model.php');

if (isset($_POST['obtenerUsuarios'])) {
    $usuario = new Usuarios();
    $result = $usuario->ObtenerUsuarios();

    $arrUsuarios = [];

    foreach ($result as $row) {
        $obj = [
            "Nombre" => $row['nombre'],
            "Email" => $row['email'],
            "Password" => $row['password'],
            "FechaNacimiento" => $row['fecha_nacimiento'],
            "FotoPerfil" => base64_encode($row['foto_perfil'])
        ];
        $arrUsuarios[] = $obj;
    }

    header('Content-Type: application/json');
    echo json_encode($arrUsuarios);
    exit;
}

if (isset($_POST['insertarUsuarios'])) {
    $usuario = new Usuarios();

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $fotoPerfil = file_get_contents($_FILES['foto_perfil']['tmp_name']);

    $usuario->InsertarUsuario($nombre, $email, $password, $fechaNacimiento, $fotoPerfil);
    exit;
}

if (isset($_POST['modificarUsuario'])) {
    $usuario = new Usuarios();

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'] ?? null;
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $fotoPerfil = isset($_FILES['foto_perfil']) ? file_get_contents($_FILES['foto_perfil']['tmp_name']) : null;

    $usuario->ModificarUsuario($id, $nombre, $email, $password, $fechaNacimiento, $fotoPerfil);
    exit;
}

if (isset($_POST['eliminarUsuario'])) {
    $usuario = new Usuarios();
    $id = $_POST['id'];
    $usuario->EliminarUsuario($id);
    exit;
}

if (isset($_POST['obtenerUsuarioPorId'])) {
    $usuario = new Usuarios();
    $id = $_POST['id'];
    $result = $usuario->ObtenerUsuarioPorId($id);

    $arrUsuarios = [];

    foreach ($result as $row) {
        $obj = [
            "Nombre" => $row['nombre'],
            "Email" => $row['email'],
            "Password" => $row['password'],
            "FechaNacimiento" => $row['fecha_nacimiento'],
            "FotoPerfil" => base64_encode($row['foto_perfil'])
        ];
        $arrUsuarios[] = $obj;
    }

    header('Content-Type: application/json');
    echo json_encode($arrUsuarios);
    exit;
}


if (isset($_POST['iniciarSesion'])) {
    $usuario = new Usuarios();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $usuario->IniciarSesion($email, $password);

   
    header('Content-Type: application/json');

    // 🔍 DEBUG: imprimimos todo lo que devuelve la consulta
    error_log(print_r($result, true)); // también puedes usar var_dump o echo si lo pruebas en navegador

    if (count($result) > 0) {
          $_SESSION['usuario'] = [
        'id' => $result[0]['id'],
        'nombre' => $result[0]['nombre'],
        'email' => $result[0]['email'],
        'tipo' => $result[0]['tipo_usuario']
          ];

        echo json_encode([
            "success" => true,
            "id" => $result[0]['id'],
            
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "mensaje" => "Credenciales inválidas"
        ]);
    }

    exit;
}

//PARA CHAT CAMBIOS VALERIA

if(isset($_POST['obtenerUsuarioPorNombre'])) {
    $usuario = new Usuarios();

    $nombre = $_POST['nombre'];

    $result = $usuario->ObtenerUsuarioPorNombre($nombre);

    $arrUsuarios = array();

    foreach($result as $row) {
        $obj = array(
            "Id" => $row['id'],
            "Nombre" => $row['nombre'],
            "Email" => $row['email'],
            "Password" => $row['password'],
            "FechaNacimiento" => $row['fecha_nacimiento'],
            "FotoPerfil" => base64_encode($row['foto_perfil'])
        );
        array_push($arrUsuarios, $obj);
    }

    $jsonUsuarios = json_encode($arrUsuarios);
    echo $jsonUsuarios;
    
}

?>
