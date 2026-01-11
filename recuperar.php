<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - RELOJERIA</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera" style="justify-content: center; height: 300px;">
                <div style="text-align: center; margin-top: 50px;">
                    <h3>Restablecer Acceso</h3>
                    <p>Sigue los pasos para actualizar tu clave.</p>
                </div>
            </div>

            <div class="contenedor__login-register posicion__recuperar">
                <form action="php/recuperar_be.php" method="POST" class="formulario__login">
                <h2>Nueva Clave</h2> <p class="texto__informativo">
                    Ingresa tu correo registrado y la nueva contraseña que deseas usar.
                </p> <input type="email" placeholder="Correo Electrónico" name="correo" required>
                <input type="password" placeholder="Nueva Contraseña" name="nueva_contrasena" required>

                <button type="submit">ACTUALIZAR DATOS</button>
                 <a href="index.php" class="link__recuperar">← Volver al inicio</a>
            </form>
            </div>
        </div>
    </main>
</body>
</html>