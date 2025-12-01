<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

if (isset($_POST['accion'], $_POST['id_producto'])) {
    $id = $_POST['id_producto'];

    switch ($_POST['accion']) {

        case "sumar":
            $_SESSION['carrito'][$id]['cantidad'] += 1;
            break;

        case "restar":
            $_SESSION['carrito'][$id]['cantidad'] -= 1;
            if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id]); 
            }
            break;

        case "eliminar":
            unset($_SESSION['carrito'][$id]);
            break;
    }
}

header("Location: carrito.php");
exit();
?>
