<?php
include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

//ENCRIPTAR LA CONTRASEÑA
$contrasena = hash('sha512', $contrasena);

$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena,rol) 
          VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena','cliente')";

//Verificar que el correo no se repita en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
    <script>
        alert("Este correo ya está registrado, intenta con otro diferente");
        window.location = "../index.php";
    </script>
    ';
    exit();
}

//Verificar que el nombre de usuario no se repita en la base de datos
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

if(mysqli_num_rows($verificar_usuario) > 0){
    echo '
    <script>
        alert("Este usuario ya está registrado, intenta con otro diferente");
        window.location = "../index.php";
    </script>
    ';
    exit();
}
$ejecutar = mysqli_query($conexion, $query);
if($ejecutar){
    echo '
    <script>
        alert("USUARIO REGISTRADO EXITOSAMENTE");
        window.location = "../index.php";
        </script>
        ';
}else{
    echo '
     <script>
        alert("USUARIO NO ALMACENADO, INTENTELO NUEVAMENTE");
        window.location = "../index.php";
        </script>
        ';
}
mysqli_close($conexion);

?>
