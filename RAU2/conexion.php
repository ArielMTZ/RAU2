<?php
    $conexion = mysqli_connect("localhost", "root", "6565877295", "flight_reservation");
    if (!$conexion) {
        die("Error en la conexión: " . mysqli_connect_error());
    }
?>
