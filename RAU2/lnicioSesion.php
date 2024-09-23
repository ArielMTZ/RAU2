<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
include("conexion.php");

if (isset($_POST['ini'])) {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Preparar la consulta para buscar el usuario por nombre de usuario
    $query = "SELECT * FROM Users WHERE username = ?";
    $stmt = mysqli_prepare($conexion, $query);
    
    if ($stmt) {
        // Enlazar el parámetro y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        // Verificar si se encontró el usuario
        if ($user = mysqli_fetch_assoc($result)) {
            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                // Iniciar sesión y redirigir al usuario
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['username']; // Cambié 'user' a 'username'
                
                echo "<script>alert('¡Inicio de sesión exitoso!'); window.location='reservations.html';</script>";
            } else {
                echo "<script>alert('Contraseña incorrecta'); window.location='principal.html';</script>";
            }
        } else {
            echo "<script>alert('El nombre de usuario no está registrado'); window.location='principal.html';</script>";
        }
        
        // Cerrar el statement
        mysqli_stmt_close($stmt);
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>

