<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "zapateria_bd");

if (isset($_POST['id_producto'])) {
    $id = $_POST['id_producto'];

    // Obtener datos del producto
    $consulta = $conexion->prepare("SELECT id_producto, nombre, precio, imagen FROM productos WHERE id_producto = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();

    if (!$resultado) { exit("Producto no encontrado"); }

    // Si la sesión no existe la creamos
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si ya existe, sumar cantidad
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] += 1;
    } else {
        // Agregar con todos los datos
        $_SESSION['carrito'][$id] = [
            'id' => $resultado['id_producto'],
            'nombre' => $resultado['nombre'],
            'precio' => $resultado['precio'],
            'imagen' => $resultado['imagen'],
            'cantidad' => 1
        ];
    }

    header("Location: carrito.php");
    exit();
}
?>
