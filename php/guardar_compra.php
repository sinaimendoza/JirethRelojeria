<?php
session_start();
require_once "conexion_be.php";

header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["success" => false, "msg" => "No autenticado"]);
    exit;
}

$correo = $_SESSION['usuario'];
$queryUsuario = "SELECT id FROM usuarios WHERE correo = '$correo'";
$resultUsuario = mysqli_query($conexion, $queryUsuario);
$usuario = mysqli_fetch_assoc($resultUsuario);
$id_usuario = $usuario['id'];

$data = json_decode(file_get_contents("php://input"), true);
$metodo_pago = $data['metodo_pago'];
$productos = $data['productos'];

// VALIDACIÓN DE STOCK REAL
foreach ($productos as $p) {
    $nombre_prod = $p['nombre'];
    $cantidad_comprada = (int)$p['cantidad'];

    $checkStock = mysqli_query($conexion, "SELECT piezas FROM productos WHERE nombre = '$nombre_prod'");
    $filaStock = mysqli_fetch_assoc($checkStock);

    if (!$filaStock || $filaStock['piezas'] < $cantidad_comprada) {
        echo json_encode(["success" => false, "msg" => "Stock insuficiente para: $nombre_prod"]);
        exit;
    }
}

// INSERTAR COMPRA
$queryCompra = "INSERT INTO compras (id_usuario, metodo_pago) VALUES ($id_usuario, '$metodo_pago')";
mysqli_query($conexion, $queryCompra);
$id_compra = mysqli_insert_id($conexion);

// PROCESAR PRODUCTOS Y DESCONTAR STOCK
foreach ($productos as $p) {
    $nombre_prod = $p['nombre'];
    $precio = $p['precio'];
    $cantidad_comprada = (int)$p['cantidad'];
    $imagen = $p['imagen'];

    // 1. Detalle de compra
    mysqli_query($conexion, "INSERT INTO detalle_compra (id_compra, producto, precio, cantidad, imagen) VALUES ($id_compra, '$nombre_prod', $precio, $cantidad_comprada, '$imagen')");

    // 2. DESCUENTO DE STOCK EN LA BASE DE DATOS
    mysqli_query($conexion, "UPDATE productos SET piezas = piezas - $cantidad_comprada WHERE nombre = '$nombre_prod'");
}

echo json_encode(["success" => true]);
?>