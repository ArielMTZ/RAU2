<?php
include("conexion.php");

// Verificar conexión
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$user_id = $_POST['user_id'];
$flight_id = $_POST['flight_id'];

// Sentencia preparada para insertar una nueva reserva
$stmt = $conexion->prepare("INSERT INTO Reservations (user_id, flight_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $flight_id);

// Ejecutar la consulta y verificar si se almacenó correctamente
if ($stmt->execute()) {
    echo "<script>alert('¡Reserva registrada con éxito!'); window.location='register_reservation_form.html';</script>";
} else {
    echo "<script>alert('Error al registrar la reserva'); window.location='register_reservation_form.html';</script>";
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>


