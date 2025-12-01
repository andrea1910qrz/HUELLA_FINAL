<?php
// productos.php

// Conexión
$conexion = new mysqli("localhost", "root", "", "zapateria_bd");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener búsqueda (GET) y limpiar
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

// Si quieres que la búsqueda no distinga mayúsculas/minúsculas en MySQL,
// asegúrate de que la collation de la columna sea case-insensitive (ej. utf8_general_ci).
// Aquí usamos prepared statements para mayor seguridad.
$productos = [];

if ($busqueda !== "") {
    // Preparamos la consulta con LIKE — agregamos los wildcards aquí
    $param = "%{$busqueda}%";
    $stmt = $conexion->prepare("SELECT id_producto, nombre, descripcion, precio, stock, imagen FROM productos WHERE nombre LIKE ? OR descripcion LIKE ?");
    $stmt->bind_param("ss", $param, $param);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $productos[] = $row;
    }
    $stmt->close();
} else {
    // Sin búsqueda: traemos todos
    $res = $conexion->query("SELECT id_producto, nombre, descripcion, precio, stock, imagen FROM productos");
    while ($row = $res->fetch_assoc()) {
        $productos[] = $row;
    }
    $res->free();
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
      <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap" rel="stylesheet">   
<meta charset="utf-8">
<title>Huella | Catalogo</title>
<style>
    body { background-color: #f5f5e3; font-family: 'Inter', sans-serif; margin: 0; padding: 0 30px; }
    .titulo_coleccion { font-size: 28px; color: #ea6230; font-weight: 300; margin: 20px 0; display:block; }
    .buscador { margin-bottom: 20px; }
    .buscador input[type="text"]{ padding:8px 10px; width:300px; border-radius:6px; border:1px solid #ccc; }
    .buscador button{ padding:8px 12px; background:#e65411; color:#fff; border:none; border-radius:6px; cursor:pointer; margin-left:8px; }
    .grid { display: flex; flex-wrap: wrap; gap: 30px; }
    .producto { width: 360px; background: #fff; border-radius:12px; padding:12px; box-shadow:0 4px 10px rgba(0,0,0,0.08); }
    .producto img { width:180%; height:300px; object-fit:cover; border-radius:8px; }
    .texto { font-size:22px; color:#e65411; margin-top:10px; }
    .precios { font-size:18px; color:#000; margin-top:6px; }
    .descripcion { color:#666; font-size:14px; margin-top:8px; min-height:40px; }
    .btn_coleccion { margin-top:10px; background-color:#e65411; color:white; padding:10px 14px; border:none; border-radius:8px; cursor:pointer; }
    .btn_coleccion:hover {background-color: #e0a96b; transform: scale(1.05); box-shadow: 0 8px 16px rgba(0,0,0,0.3); /* sombra más intensa */}
    .no-result { color:#666; margin-top:20px; }
    .buscador_contenedor{position: absolute; top: 100px; left: 900px}

</style>
</head>

<body>
<link rel="stylesheet" href="estilos.css">
   
<!-- Navbar principal -->
      <header class="navbar">
     <div class="logo">
        <a href="index.html" class="imagen-link">
        <img src="imagenes/logo.png" alt="Logo Huella"></a>
     </div>
     <nav class="nav-links">
      <a href="catalogo.php">Catalogo</a>
      <a href="Nosotros.html">Sobre Nosotros</a>
     </nav>
     
     <div class="icons">

    <div class="usuario-container">
        <i class="ri-user-line" id="userIcon"></i>

        <div class="menu-usuario" id="menuUsuario">
            <a href="iniciar_sesion.html">Cerrar sesión</a>
        </div>
    </div>
    <a href="carrito.php">
    <i class="ri-shopping-bag-line"></i> </a>
    </div>
   

    <script>
    document.getElementById("userIcon").addEventListener("click", function(){
    let menu = document.getElementById("menuUsuario");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
    });

    // Cierra el menú si haces clic fuera de él
    document.addEventListener("click", function(e){
    let menu = document.getElementById("menuUsuario");
    let icon = document.getElementById("userIcon");

    if(!icon.contains(e.target) && !menu.contains(e.target)){
        menu.style.display = "none";
    }
    });
    </script>
      </header>

<i class="titulo_coleccion">Mira nuestra selección en la colección de tacones para ti...</i>

<!-- Buscador -->
 <div class="buscador_contenedor">
<form class="buscador" action="catalogo.php" method="GET" autocomplete="off">
    <input type="text" name="buscar" placeholder="Buscar producto..." value="<?php echo htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit">Buscar</button>
    <?php if($busqueda !== ""): ?>
        <a href="catalogo.php" style="margin-left:12px; color:#e65411; text-decoration:none;">Limpiar</a>
    <?php endif; ?>
</form>
    </div>

<!-- Resultados -->
<div class="grid">
<?php if (count($productos) > 0): ?>
    <?php foreach ($productos as $p): ?>
        <?php
            $imagenCampo = trim($p['imagen']);
        
            
               $imgSrc = $p['imagen'];  // ya incluye imagenes_prod/


            
        ?>
        <div class="producto">
            <img src="<?php echo htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="texto"><?php echo htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="precios">$<?php echo number_format($p['precio'], 2, '.', ','); ?> mx</div>
            <div class="descripcion"><?php echo htmlspecialchars($p['descripcion'], ENT_QUOTES, 'UTF-8'); ?></div>

            <form action="agregar_carrito.php" method="POST">
    <input type="hidden" name="id_producto" value="<?php echo $p['id_producto']; ?>">
    <button type="submit" class="btn_coleccion">Comprar ahora</button>
</form>


        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="no-result">No se encontraron productos<?php echo $busqueda !== "" ? " para \"".htmlspecialchars($busqueda, ENT_QUOTES,'UTF-8')."\"" : ""; ?>.</p>
<?php endif; ?>
</div>

</body>
</html>


