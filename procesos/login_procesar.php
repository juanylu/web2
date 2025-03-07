<?php
session_start();
include_once("../incluir/conexion.php");

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Usar la propiedad $conn de la clase Conexion para la conexión
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
            // Guardar datos en sesión
            $_SESSION["usuario"] = [
                "id" => $usuario["id"],
                "nombre" => $usuario["nombre"],
                "email" => $usuario["email"],
                "tipo_usuario" => $usuario["tipo_usuario"]
            ];

            // Redirigir con mensaje de bienvenida
            header("Location: ../pages/inicio.php?mensaje=" . urlencode("Bienvenido, " . $usuario["nombre"]));
        } else {
            // Redirigir con error en contraseña
            header("Location: ../pages/login.php?mensaje=" . urlencode("Contraseña incorrecta."));
        }
    } else {
        // Redirigir con error de usuario no encontrado
        header("Location: ../pages/login.php?mensaje=" . urlencode("Usuario no encontrado."));
    }
} else {
    header("Location: ../pages/login.php?mensaje=" . urlencode("Método no permitido."));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->cerrar();

?>
