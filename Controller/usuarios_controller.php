<?php
include_once(dirname(__DIR__).'/includes/usuarios_model.php');

if(isset($_POST['obtenerUsuarios'])) {
    $usuario = new Usuarios();

    // filas de base de datos
    $result = $usuario->ObtenerUsuarios();

    $arrUsuarios = array();

    // los pasa a un arreglo de php
    foreach($result as $row) {
        $obj = array(
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

if(isset($_POST['insertarUsuarios'])) {
    $usuario = new Usuarios();

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $fotoPerfil = file_get_contents($_FILES['foto_perfil']['tmp_name']);

    $usuario->InsertarUsuario($nombre, $email, $password, $fechaNacimiento, $fotoPerfil);
}

if(isset($_POST['modificarUsuario'])) {
    $usuario = new Usuarios();

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $fotoPerfil = isset($_FILES['foto_perfil']) ? file_get_contents($_FILES['foto_perfil']['tmp_name']) : null;

    $usuario->ModificarUsuario($id, $nombre, $email, $password, $fechaNacimiento, $fotoPerfil);
}



if(isset($_POST['eliminarUsuario'])) {
    $usuario = new Usuarios();

    $id = $_POST['id'];

    $usuario->EliminarUsuario($id);
}

if(isset($_POST['obtenerUsuarioPorId'])) {
    $usuario = new Usuarios();

    $id = $_POST['id'];

    $result = $usuario->ObtenerUsuarioPorId($id);

    $arrUsuarios = array();

    foreach($result as $row) {
        $obj = array(
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

if(isset($_POST['iniciarSesion'])) {
    $usuario = new Usuarios();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $usuario->IniciarSesion($email, $password);

    $arrUsuarios = array();

    foreach($result as $row) {
        $obj = array(
            "Id" => $row['id']
        );
        array_push($arrUsuarios, $obj);
    }

    $jsonUsuarios = json_encode($arrUsuarios);
    echo $jsonUsuarios;
}

?>