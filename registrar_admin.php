<?php
include("conexion.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
 

$sql = "INSERT INTO administracion (correo, contrasena)
        VALUES ('$correo', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registo exitoso'); window.location='registro_admin.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
