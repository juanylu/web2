<?php
session_start();
include_once("../incluir/conexion.php");

$conexion = new Conexion();
$conn = $conexion->conn;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Buscar el usuario
    $sql = "SELECT id, nombre, email, password, tipo_usuario FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {
          
            $_SESSION["usuario"] = [
                "id" => $usuario["id"],
                "nombre" => $usuario["nombre"],
                "email" => $usuario["email"],
                "tipo_usuario" => $usuario["tipo_usuario"]
            ];

           
            header("Location: ../pages/inicio.php?mensaje=" . urlencode("Bienvenido, " . $usuario["nombre"]));
        } else {
            
            header("Location: ../pages/login.php?mensaje=" . urlencode("Contraseña incorrecta."));
        }
    } else {
        
        header("Location: ../pages/login.php?mensaje=" . urlencode("Usuario no encontrado."));
    }
} else {
    header("Location: ../pages/login.php?mensaje=" . urlencode("Método no permitido."));
}

$stmt->close();
$conexion->cerrar();

?>
