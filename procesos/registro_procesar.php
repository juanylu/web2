<?php

// Incluir el archivo de conexión
include_once("../incluir/conexion.php");

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Usar la propiedad $conn de la clase Conexion para la conexión
$conn = $conexion->conn;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    // Procesar foto de perfil
    $foto_perfil = null;
    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["tmp_name"] != "") {
        $foto_perfil = addslashes(file_get_contents($_FILES["foto_perfil"]["tmp_name"]));
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, password, fecha_nacimiento, foto_perfil)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $email, $password, $fecha_nacimiento, $foto_perfil);

    if ($stmt->execute()) {
        // Redirigir con mensaje de éxito
        header("Location: ../pages/login.php?mensaje=" . urlencode("Registro exitoso. Inicia sesión."));
    } else {
        // Redirigir con mensaje de error
        header("Location: ../pages/registro.php?mensaje=" . urlencode("Error al registrar: " . $stmt->error));
    }
} else {
    header("Location: ../pages/registro.php?mensaje=" . urlencode("Método no permitido."));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->cerrar();

?>
