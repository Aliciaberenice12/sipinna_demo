<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPINNA</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./lib/swetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="./lib/toastr/toastr.css">
</head>

<body>
    <main id="division">
        <div class="logos">
            <div><img src="./images/logo_corto.png" alt=""></div>
        </div>
        <div class="formulario">
            <form action="" class="form" id="form" method="POST">

                <h1>Iniciar sesión</h1><br />
                <input type="text" name="usuario" id="usuario" placeholder="Usuario"><br /><br />
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña"><br /><br />
                <div class="log">
                    <button type="button" class="btn" id="boton" onclick="login_roles()">Entrar</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>2022 &reg; Algunos derechos reservados</p>
    </footer>
    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/toastr/toastr.min.js"></script>
    <script src="./lib/swetalert/sweetalert2.min.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>