<?php
session_start();
include 'php/conexion_be.php'; // Necesitamos la conexión para leer los datos reales

if(!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin'){
    header("Location: index.php");
    exit();
}

// Obtener el ID desde la URL
$id = $_GET['id'] ?? null;

if(!$id){
    echo '<script>alert("Producto no válido"); window.location = "admin.php";</script>';
    die();
}

// --- EL CAMBIO CLAVE: Consultar los datos reales del producto ---
$query = "SELECT * FROM productos WHERE id = '$id'";
$resultado = mysqli_query($conexion, $query);
$producto = mysqli_fetch_assoc($resultado);

if(!$producto){
    echo '<script>alert("Producto no encontrado"); window.location = "admin.php";</script>';
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>

<div class="admin-topbar">
    <h2>Editar Producto</h2>

    <div class="topbar-botones">
        <a href="admin.php" class="btn-volver">← Volver</a>
        <a href="php/cerrar_sesion.php" class="btn-cerrar">Cerrar sesión</a>
    </div>
</div>

<div class="form-container">
    <form method="POST" action="php/actualizar_producto.php" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

        <label>Piezas:</label>
        <input type="number" name="piezas" value="<?php echo $producto['piezas']; ?>" required>

        <label>Precio:</label>
        <input type="text" name="precio" value="<?php echo $producto['precio']; ?>" required>

        <label>Imagen Actual:</label><br>
        <img src="assets/imagenes/<?php echo $producto['imagen']; ?>" width="80" style="margin-bottom: 10px; border-radius: 5px;">
        
        <label>Cambiar Imagen (opcional):</label>
        <input type="file" name="imagen">

        <button type="submit">Guardar Cambios</button>
    </form>
</div>

</body>
</html>