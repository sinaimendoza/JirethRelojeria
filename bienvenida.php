<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
    echo '
    <script>
        alert("Acceso no autorizado");
        window.location = "index.php";
    </script>
    ';
    session_destroy();
    die();
}

include 'php/conexion_be.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Relojes | Bienvenido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/estilos_carrito.css">
</head>

<body>
<header class="header-carrusel">
    <div class="video-container">
        <video autoplay muted loop class="video-item active">
            <source src="assets/videos/video1.mp4" type="video/mp4">
        </video>
        <video autoplay muted loop class="video-item">
            <source src="assets/videos/video2.mp4" type="video/mp4">
        </video>
        <video autoplay muted loop class="video-item">
            <source src="assets/videos/video3.mp4" type="video/mp4">
        </video>
        
        <div class="overlay"></div>
    </div>

    <h1>Tienda de Relojes</h1>
    <a href="php/cerrar_sesion.php" class="btn-cerrar">Cerrar sesión</a>
</header>

<section class="contenedor">
    <div class="contenedor-items">

    <?php
    $query = "SELECT * FROM productos WHERE piezas > 0";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="item">
                <span class="titulo-item"><?php echo htmlspecialchars($fila['nombre']); ?></span>
                <img src="assets/imagenes/<?php echo htmlspecialchars($fila['imagen']); ?>" class="img-item">
                <span class="precio-item">$<?php echo number_format($fila['precio'], 0, '', '.'); ?></span>
                
                <p style="font-size: 12px; color: #666; text-align: center;">Disponibles: <?php echo $fila['piezas']; ?></p>
                <button type="button" class="boton-item" data-stock="<?php echo $fila['piezas']; ?>">Agregar al Carrito</button>
            </div>
            <?php
        }
    } else {
        echo "<p style='color:white;'>No hay productos con stock disponible.</p>";
    }
    ?>

    </div>

    <div class="carrito" id="carrito">
        <div class="header-carrito">
            <h2>Tu Carrito</h2>
        </div>
        <div class="carrito-items"></div>
        <div class="carrito-total">
            <div class="fila">
                <strong>Tu Total</strong>
                <span class="carrito-precio-total">$0,00</span>
            </div>
            <div class="metodo-pago">
                <h4>Método de pago</h4>
                <label><input type="radio" name="metodoPago" value="Tarjeta"> Tarjeta</label><br>
                <label><input type="radio" name="metodoPago" value="Efectivo"> Efectivo</label>
            </div>
            <a href="javascript:void(0);" class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i></a>
        </div>
    </div>
</section>

<div id="modalPago" class="modal" style="display:none;">
    <div class="modal-contenido">
        <h2>Su pago ha sido completado</h2>
        <p>Gracias por su compra. El stock se ha actualizado.</p>
        <button type="button" id="cerrarModal">Cerrar</button>
    </div>
</div>

<script src="assets/js/app_carrito.js"></script>
</body>
</html>