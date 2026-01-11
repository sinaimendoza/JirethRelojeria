<?php
session_start();

if(!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin'){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="assets/css/admin.css"> </head>
<body>

<div class="admin-header-box">
    <h2>Agregar Nuevo Producto</h2>
    <div class="topbar-botones">
        <a href="admin.php" class="btn-volver">← Volver al Panel</a>
    </div>
</div>

<div class="form-container">
    <form method="POST" action="php/guardar_producto.php" enctype="multipart/form-data">
        <label>Nombre del Reloj:</label>
        <input type="text" name="nombre" placeholder="Ej. Rolex Gold" required>

        <label>Cantidad en Stock (Piezas):</label>
        <input type="number" name="piezas" placeholder="0" required>

        <label>Precio (Sin puntos ni comas):</label>
        <input type="text" name="precio" placeholder="Ej. 15000" required>

        <label>Imagen del Producto:</label>
        <input type="file" name="imagen" accept="image/*" required>

        <button type="submit" class="btn-guardar">GUARDAR PRODUCTO</button>
    </form>
</div>

</body>
</html>
