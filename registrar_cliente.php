<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena']; 

$sql = "INSERT INTO clientes (nombre, telefono, direccion, correo, contrasena)
        VALUES ('$nombre', '$telefono', '$direccion', '$correo', '$contrasena')";

if ($conn->query($sql) === TRUE) {
     echo "<script>alert('Registo exitoso'); window.location='iniciar_sesion.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
