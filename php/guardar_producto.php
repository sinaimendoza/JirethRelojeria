<?php
session_start();
include 'conexion_be.php'; //

if(!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin'){
    header("Location: ../index.php");
    exit();
}

// 1. Recibimos los datos (Sin el ID)
$nombre = $_POST['nombre'];
$piezas = $_POST['piezas'];

// Limpiamos el precio por si el usuario puso puntos por error
$precio = str_replace(['.', ','], '', $_POST['precio']); 

$nombre_imagen = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];

// 2. Movemos la imagen a la carpeta correcta
$carpeta_destino = "../assets/imagenes/" . $nombre_imagen;
move_uploaded_file($ruta_temporal, $carpeta_destino);

// 3. INSERTAMOS EN LA BD - Omitimos la columna 'id' para que use AUTO_INCREMENT
$query = "INSERT INTO productos (nombre, piezas, precio, imagen) 
          VALUES ('$nombre', '$piezas', '$precio', '$nombre_imagen')";

$ejecutar = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4; font-family: sans-serif;">

    <div class="form-container" style="text-align: center; border: 2px solid #1a1a1a; padding: 30px; background: white; border-radius: 8px;">
        <?php if($ejecutar): ?>
            <h2 style="color: #1a1a1a;">¡PRODUCTO REGISTRADO!</h2>
            <hr style="margin: 20px 0;">
            <p>El producto <strong><?php echo $nombre; ?></strong> se guardó con éxito.</p>
            <p>El sistema le asignó un ID automático.</p>
        <?php else: ?>
            <h2 style="color: red;">ERROR AL GUARDAR</h2>
            <p><?php echo mysqli_error($conexion); ?></p>
        <?php endif; ?>
        
        <br>
        <a href="../admin.php" style="display: inline-block; width: 100%; background: #1a1a1a; color: white; padding: 12px; text-decoration: none; font-weight: bold; border-radius: 4px;">
            VOLVER AL PANEL
        </a>
    </div>

</body>
</html>