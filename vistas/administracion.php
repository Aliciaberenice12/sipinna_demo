<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['nombre'])) {
    $user = $_SESSION['nombre'];
} else {
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sipinna</title>

    <!--CSS-->
    <link rel="stylesheet" href="../css/sipinna.css" />
    <link rel="stylesheet" href="../lib/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <link rel="stylesheet" href="../lib/swetalert/sweetalert2.min.css">

    <?php include("../layout/sipinna.php"); ?>

    <div class="div-al row">

        <div class="col-md-6">
            <h2 class="h2-titulo">Administración</h2>
        </div>

        <div class="col-md-6">
            <img src="../images/imagen.png" class="img-log" align="right">
        </div>

    </div>

</head>

<body style="margin-bottom: 45px;">

    <!--Head-->
    <input type="hidden" id="hoy" value="<?php echo date('Y-m-d'); ?>">
    <!--Container -->
    <div class="container">
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalUsuario" id="btnAgregar">
                        <i class="bi bi-plus-circle-fill"></i> Crear Usuario
                    </button>
                </div>
            </div>
        </div><br>

        <div class="table-responsive">
            <table id="datos_usuario" class="table table-sm">
                <thead class="tbl-estadisticas">
                    <tr>
                        <th>Id</th>
                        <th>Nombre </th>
                        <th>Apellidos</th>
                        <th>Departamento</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Imagen</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:white;">Crear Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="formulario" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="imagen_usuario">Selecciona una imagen</label>
                                    <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control" accept="image*/"><br>
                                    <div>
                                        <span class="img_formUser" id="imagen_subida"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Completa el campo..."><br>
                                    <label for="usuario">Usuario</label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Completa el campo..."><br>
                                    <label for="rol" class="form-label">Rol: </label>
                                    <select name="rol_usuario" id="rol_usuario" class="form-select" required>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Completa el campo..."><br>
                                    <label for="departamento">Departamento</label>
                                    <input type="text" name="departamento" id="departamento" class="form-control" placeholder="Completa el campo..."><br>
                                    <label for="email">Correo</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Completa el campo..."><br>
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-8">
                                    <label for="contrasena">Contraseña</label>
                                    <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Completa el campo..."><br>
                                    <label for="contrasena"> Repite Contraseña</label>
                                    <input type="password" name="contrasena" id="d_contrasena" class="form-control" placeholder="Completa el campo..."><br>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_usuario" id="id_usuario">
                            <input type="hidden" name="operacion" id="operacion">
                            <input type="hidden" name="img_user" id="img_user">
                            <input type="hidden" name="idRow" id="idRow">
                            <input name="action" id="action" class="btn btn-success" value="Crear">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../lib/swetalert/sweetalert2.min.js"></script>

    <script src="../js/usuarios.js"></script>

    <?php include('../layout/footer.php'); ?>





</body>

</html>