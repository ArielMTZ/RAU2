<?php
include("conexion.php");

// Verificar conexión
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$price = $_POST['price'];

// Sentencia preparada para insertar un nuevo vuelo
$stmt = $conexion->prepare("INSERT INTO Flights (origin, destination, departure_date, return_date, price) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssd", $origin, $destination, $departure_date, $return_date, $price);

// Ejecutar la consulta y verificar si se almacenó correctamente
if ($stmt->execute()) {
    echo "<script>alert('¡Vuelo registrado con éxito!'); window.location='register_flight_form.html';</script>";
} else {
    echo "<script>alert('Error al registrar el vuelo'); window.location='register_flight_form.html';</script>";
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>

