<?php

include 'conexion.php'; 
if (!isset($_GET['id'])) {
    die("Error: No se recibió ningún ID");
}

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id_producto = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    die("Producto no encontrado");
}

$producto = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eliminar | Huella</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap" rel="stylesheet">    
       <link rel="stylesheet" href="estilos.css">
       <!-- Iconos (remixicon o fontawesome) -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <style>
        body{
          background-color: #1e4b26;
          background-image: url("imagenes/eliminar_prod.jpg");
          background-size: 40%;
          background-repeat: no-repeat;
          height: 100vh;    
        }
        .btn_eliminar{
         position: absolute;
        top: 300px;
        left: 50px;
        background-color: #ea6230;
         color: white;
         border: none;
        padding: 12px 32px;
         border-radius: 30px;
         font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;

         }
     /* Efecto al pasar el mouse */
         .btn_editar:hover {
         background-color: #e0a96b;
         transform: scale(1.05); /* crece un poco */
        box-shadow: 0 8px 16px rgba(0,0,0,0.3); /* sombra más intensa */
            }
    .texto {
    font-family: 'Inter', sans-serif;
    font-weight: 30;
    color: white;
    font-size: 30px;
    line-height: 0.9;
    margin: 0;
}

/* Contenedor para alinear texto + inputs */
.form_row {
    display: flex;
    align-items: center;
    gap: 10px; /* separación entre label y input */
    margin-bottom: 25px;
}

/* Ajustar el ancho del label */
.form_row h4 {
    width: 150px; /* ajusta este valor según lo que necesites */
}

/* Inputs y textarea */
.form_row input,
.form_row textarea {
    flex: 1; /* se expande hacia la derecha */
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-family: 'Inter', sans-serif;
}

        
      </style>

      <link rel="stylesheet" href="estilos.css">
   
<!-- Navbar principal -->
      <header class="navbar">
     <div class="logo">
        <a href="index_admin.html" class="imagen-link">
        <img src="imagenes/logo.png" alt="Logo Huella"></a>
     </div>
     <nav class="nav-links">
      <a href="catalogo_admin.php">Catalogo</a>
      <a href="Nosotros.html">Sobre Nosotros</a>
      <a href="registro_admin.html">Registrar Admin</a>
     </nav>
     <div class="icons">

    <div class="usuario-container">
        <i class="ri-user-line" id="userIcon"></i>

        <div class="menu-usuario" id="menuUsuario">
            <a href="iniciar_sesion.html">Cerrar sesión</a>
        </div>
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

  <div class="contenedor_registro">
  <h1 class="titulo"> Eliminar</h1>
  <h1 class="titulo"> Productos </h1>
  
  </div>

<div class="contenedor_formulario">
   <form action="eliminar.php" method="POST">

    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

    <div class="form_row">
        <h4 class="texto">Nombre:</h4>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>">
    </div>

    <div class="form_row">
        <h4 class="texto">Descripción:</h4>
        <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
    </div>

    <div class="form_row">
        <h4 class="texto">Precio:</h4>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>">
    </div>

    <div class="form_row">
        <h4 class="texto">Stock:</h4>
        <input type="number" name="stock" value="<?php echo $producto['stock']; ?>">
    </div>

    <div class="form_row">
        <h4 class="texto">Imagen:</h4>
        <input type="text" name="imagen" value="<?php echo $producto['imagen']; ?>">
    </div>

    <button class="btn_eliminar" type="submit">Eliminar producto</button>

   </form>
</div>


</body>
</html>
