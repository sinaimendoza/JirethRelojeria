<?php
include 'conexion_be.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$piezas = $_POST['piezas'];

// LIMPIEZA DE PRECIO: Quitamos puntos y comas antes de guardar
$precio = str_replace(['.', ','], '', $_POST['precio']); 

$query = "UPDATE productos SET 
          nombre = '$nombre', 
          piezas = '$piezas', 
          precio = '$precio' 
          WHERE id = '$id'";

$ejecutar = mysqli_query($conexion, $query);

// 4. Lógica para la imagen (solo si el usuario subió una nueva)
if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != ""){
    $nombre_img = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    
    // La ruta debe subir un nivel para llegar a assets
    $ruta_destino = "../assets/imagenes/" . $nombre_img;
    
    if(move_uploaded_file($ruta_temporal, $ruta_destino)){
        // Actualizamos el nombre de la imagen en la BD
        $query_img = "UPDATE productos SET imagen = '$nombre_img' WHERE id = '$id'";
        mysqli_query($conexion, $query_img);
    }
}

// 5. Verificación y redirección
if($ejecutar){
    echo '
        <script>
            alert("Producto actualizado exitosamente");
            window.location = "../admin.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Error al intentar actualizar. Inténtalo de nuevo");
            window.location = "../admin.php";
        </script>
    ';
}

mysqli_close($conexion);
?>