<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "zapateria_bd"; // nombre de tu base de datos

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
}
// echo "Conexión exitosa"; // solo para probar
?>