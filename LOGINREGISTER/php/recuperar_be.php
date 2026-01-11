<?php
include 'conexion_be.php';

// Recibir datos del formulario
$correo = $_POST['correo'];
$nueva_contrasena = $_POST['nueva_contrasena'];

// Encriptar la nueva contraseña con el mismo método usado en el registro (SHA512)
$nueva_contrasena_enc = hash('sha512', $nueva_contrasena);

// 1. Verificamos si el usuario existe en la base de datos
$verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

if(mysqli_num_rows($verificar) > 0){
    // 2. Actualizamos la contraseña del usuario encontrado
    $query = "UPDATE usuarios SET contrasena = '$nueva_contrasena_enc' WHERE correo = '$correo'";
    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Contraseña actualizada exitosamente. Ya puedes iniciar sesión.");
                window.location = "../index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Error al actualizar. Inténtalo de nuevo.");
                window.location = "../recuperar.php";
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("El correo ingresado no coincide con ninguna cuenta activa.");
            window.location = "../recuperar.php";
        </script>
    ';
}

mysqli_close($conexion);
?>