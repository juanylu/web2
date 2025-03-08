<?php

include_once("../incluir/conexion.php");

$conexion = new Conexion();
$conn = $conexion->conn;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    $foto_perfil = null;
    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["tmp_name"] != "") {
        $foto_perfil = addslashes(file_get_contents($_FILES["foto_perfil"]["tmp_name"]));
    }

    $sql = "INSERT INTO usuarios (nombre, email, password, fecha_nacimiento, foto_perfil)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $email, $password, $fecha_nacimiento, $foto_perfil);

    if ($stmt->execute()) {
  
        header("Location: ../pages/login.php?mensaje=" . urlencode("Registro exitoso. Inicia sesión."));
    } else {
        
        header("Location: ../pages/registro.php?mensaje=" . urlencode("Error al registrar: " . $stmt->error));
    }
}

$stmt->close();
$conexion->cerrar();

?>
