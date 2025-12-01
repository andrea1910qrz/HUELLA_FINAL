<?php
if (!isset($_POST['correo']) || !isset($_POST['contrasena'])) {
    echo "<script>alert('Acceso inválido'); window.location='Iniarsesion.html';</script>";
    exit;
}

// --- CONEXIÓN A LA BASE DE DATOS ---
$conexion = new mysqli("localhost", "root", "", "zapateria_bd");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error al conectar: " . $conexion->connect_error);
}

// --- OBTENER DATOS DEL FORMULARIO ---
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// --- BUSCAR EN TABLA CLIENTES ---
$sqlCliente = "SELECT * FROM clientes WHERE correo = '$correo' AND contrasena = '$contrasena'";
$resultCliente = $conexion->query($sqlCliente);

// --- BUSCAR EN TABLA ADMINISTRACION ---
$sqlAdmin = "SELECT * FROM administracion WHERE correo = '$correo' AND contrasena = '$contrasena'";
$resultAdmin = $conexion->query($sqlAdmin);

// --- VERIFICAR RESULTADOS ---
if ($resultCliente->num_rows > 0) {
    // Usuario cliente encontrado
    echo "<script>alert('Inicio de sesión exitoso como CLIENTE'); window.location='index.html';</script>";
} 
else if ($resultAdmin->num_rows > 0) {
    // Usuario admin encontrado
echo "<script>alert('Inicio de sesión exitoso como ADMIN'); window.location='index_admin.html';</script>";

} 
else {
    // No coincide
    echo "<script>alert('Correo o contraseña incorrectos'); window.history.back();</script>";
}

// Cerrar conexión
$conexion->close();
?>