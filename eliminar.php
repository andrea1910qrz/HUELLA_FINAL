<?php
include 'conexion.php';

$id = $_POST['id_producto'];

$sql = $conn->prepare("DELETE FROM productos WHERE id_producto=?");
$sql->bind_param("i", $id);

if ($sql->execute()) {
    echo "<script>
            alert('Producto eliminado exitosamente');
            window.location='catalogo_admin.php';
          </script>";
} else {
    echo "Error al eliminar: " . $conn->error;
}
?>
