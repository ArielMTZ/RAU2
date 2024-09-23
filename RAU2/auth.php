<?php
include("conexion.php");

session_start();

// Registro de usuario
if (isset($_POST['regis'])) {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $sql = "INSERT INTO Users (username, password, email) VALUES ('$user', '$pass', '$email')";
    if ($conexion->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $conexion->error;
    }
}



$conexion->close();
?>