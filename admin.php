<?php
session_start();
include 'php/conexion_be.php';

// Protección de ruta
if(!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin'){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración | Tienda de Relojes</title>
    <link rel="stylesheet" href="assets/css/admin.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body style="background-color: #f4f4f4; font-family: sans-serif;">

<header style="background: #1a1a1a; color: white; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
    <h1 style="margin: 0; font-size: 24px;">Panel de Control</h1>
    <div>
        <a href="agregar_producto.php" style="background: white; color: black; padding: 10px 15px; text-decoration: none; font-weight: bold; border-radius: 4px; margin-right: 20px;">
            <i class="fa-solid fa-plus"></i> NUEVO PRODUCTO
        </a>
        <a href="php/cerrar_sesion.php" style="color: #ff4d4d; text-decoration: none; font-weight: bold;">
            <i class="fa-solid fa-right-from-bracket"></i> SALIR
        </a>
    </div>
</header>

<main style="padding: 40px;">
    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <thead style="background: #eee;">
            <tr>
                <th style="padding: 15px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Imagen</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Nombre</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Stock</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Precio</th>
                <th style="padding: 15px; border: 1px solid #ddd;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM productos ORDER BY id ASC";
            $resultado = mysqli_query($conexion, $query);

            while($fila = mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <td style="padding: 15px; border: 1px solid #ddd; text-align: center;"><?php echo $fila['id']; ?></td>
                    <td style="padding: 15px; border: 1px solid #ddd; text-align: center;">
                        <img src="assets/imagenes/<?php echo $fila['imagen']; ?>" width="50">
                    </td>
                    <td style="padding: 15px; border: 1px solid #ddd;"><strong><?php echo $fila['nombre']; ?></strong></td>
                    <td style="padding: 15px; border: 1px solid #ddd; text-align: center;"><?php echo $fila['piezas']; ?></td>
                    <td style="padding: 15px; border: 1px solid #ddd;">$<?php echo number_format($fila['precio'], 2); ?></td>
                    <td style="padding: 15px; border: 1px solid #ddd; text-align: center;">
                        <a href="editar_producto.php?id=<?php echo $fila['id']; ?>" style="background: #666; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 14px;">Editar</a>
                        <a href="php/eliminar_producto.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Eliminar?')" style="background: #333; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 14px; margin-left: 5px;">Eliminar</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</main>

</body>
</html>