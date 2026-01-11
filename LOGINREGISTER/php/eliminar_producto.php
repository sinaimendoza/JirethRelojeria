<?php
session_start();
include 'conexion_be.php';

// Verificación de seguridad
if(!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin'){
    header("Location: ../index.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // 1. Obtener imagen para borrarla del servidor
    $query_img = "SELECT imagen FROM productos WHERE id = '$id'";
    $res_img = mysqli_query($conexion, $query_img);
    $data_img = mysqli_fetch_assoc($res_img);
    
    if($data_img && $data_img['imagen'] != ""){
        $ruta_imagen = "../assets/imagenes/" . $data_img['imagen'];
        if(file_exists($ruta_imagen)){
            unlink($ruta_imagen); 
        }
    }

    // 2. Borrar de la base de datos
    $query_delete = "DELETE FROM productos WHERE id = '$id'";
    $ejecutar = mysqli_query($conexion, $query_delete);

    if($ejecutar){
        echo '
            <script>
                alert("Producto eliminado y archivo borrado con éxito");
                window.location = "../admin.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Error al intentar eliminar");
                window.location = "../admin.php";
            </script>
        ';
    }
} else {
    header("Location: ../admin.php");
}
exit();
?>