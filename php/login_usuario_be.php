<?php
session_start();
include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = hash('sha512', $_POST['contrasena']);

$query = "SELECT * FROM usuarios 
          WHERE correo='$correo' AND contrasena='$contrasena'";

$resultado = mysqli_query($conexion, $query);

if(mysqli_num_rows($resultado) > 0){
    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['usuario'] = $usuario['correo'];
    $_SESSION['rol'] = $usuario['rol'];

    if($usuario['rol'] === 'admin'){
        header("location: ../admin.php");
    } else {
        header("location: ../bienvenida.php");
    }
    exit();
} else {
    echo '
    <script>
        alert("Usuario o contraseña incorrectos");
        window.location = "../index.php";
    </script>
    ';
    exit();
}
?>
