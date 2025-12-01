<?php
session_start();
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
     <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap" rel="stylesheet">    
       <link rel="stylesheet" href="estilos.css">
       <!-- Iconos (remixicon o fontawesome) -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
<meta charset="utf-8">
<title>Carrito | Huella</title>

<style>
    body { background:#f5f5e3; font-family:'Inter', sans-serif; padding:0 30px; }
    h2 { color:#ea6230; margin:20px 0; }

    .grid { display:flex; flex-wrap:wrap; gap:30px; }
    .producto { width:360px; background:#fff; border-radius:12px; padding:12px;
                box-shadow:0 4px 10px rgba(0,0,0,0.08); }

    .producto img { width:100%; height:300px; object-fit:cover; border-radius:8px; }

    .nombre { font-size:22px; color:#e65411; margin-top:10px; }
    .precio { font-size:18px; color:#000; margin-top:6px; }
    .cantidad { font-size:15px; color:#444; margin-top:4px; }

    .subtotal { font-size:18px; color:#333; font-weight:bold; margin-top:10px; }

    .btn { background:#e65411; color:white; padding:8px 14px;
           border:none; border-radius:8px; cursor:pointer; margin:5px; }

    .btn:hover { background:#d45715; }

    /* Botones pequeños + -  */
    .btn-small {
        padding:6px 10px;
        font-size:14px;
        border-radius:6px;
    }

    .total {
        font-size:24px;
        margin-top:20px;
        color:#000;
        font-weight:bold;
    }

    .volver {
        display:inline-block;
        margin-top:20px;
        text-decoration:none;
        background:#e65411;
        color:white;
        padding:12px 18px;
        border-radius:10px;
    }

     

  

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
<?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío.</p>
    <a href="catalogo.php" class="volver">Volver al catálogo</a>
<?php else: ?>

<div class="grid">
    <?php 
        $totalGeneral = 0;

        foreach ($carrito as $item):
            $subtotal = $item['cantidad'] * $item['precio'];
            $totalGeneral += $subtotal;
    ?>

        <div class="producto">
            <img src="<?php echo $item['imagen']; ?>" alt="">

            <div class="nombre"><?php echo $item['nombre']; ?></div>
            <div class="precio">$<?php echo number_format($item['precio'], 2); ?> MXN</div>

            <div class="cantidad">
                Cantidad:

                <!-- Botón restar -->
                <form method="POST" action="actualizar_carrito.php" style="display:inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $item['id']; ?>">
                    <input type="hidden" name="accion" value="restar">
                    <button class="btn-small">-</button>
                </form>

                <strong><?php echo $item['cantidad']; ?></strong>

                <!-- Botón sumar -->
                <form method="POST" action="actualizar_carrito.php" style="display:inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $item['id']; ?>">
                    <input type="hidden" name="accion" value="sumar">
                    <button class="btn-small">+</button>
                </form>
            </div>

            <div class="subtotal">
                Subtotal: $<?php echo number_format($subtotal, 2); ?> MXN
            </div>

            <!-- Botón eliminar -->
            <form method="POST" action="actualizar_carrito.php">
                <input type="hidden" name="id_producto" value="<?php echo $item['id']; ?>">
                <input type="hidden" name="accion" value="eliminar">
                <button class="btn">Eliminar</button>
            </form>
        </div>

    <?php endforeach; ?>
</div>

<div class="total">
    Total a pagar: $<?php echo number_format($totalGeneral, 2); ?> MXN
</div>

<a href="catalogo.php" class="volver">Seguir comprando</a>

<?php endif; ?>

</body>
</html>
