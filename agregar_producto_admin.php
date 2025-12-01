<?php
include("conexion.php");


$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_POST['imagen'];

$sql = "INSERT INTO productos ( nombre, descripcion,  precio, stock, imagen)
        VALUES ( '$nombre', '$descripcion', '$precio', '$stock', '$imagen')";

if ($conn->query($sql) === TRUE) {
     echo "<script>alert('Producto agregado'); window.location='agregar_producto.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
