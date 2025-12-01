<?php
include 'conexion.php';

$id = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_POST['imagen'];

$sql = "UPDATE productos SET 
        nombre='$nombre',
        descripcion='$descripcion',
        precio='$precio',
        stock='$stock',
        imagen='$imagen'
        WHERE id_producto=$id";

if ($conn->query($sql)) {
    echo "<script>alert('Actualizacion exitosa'); window.location='editar_coleccion.php';</script>";
    header("Location: catalogo_admin.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>
