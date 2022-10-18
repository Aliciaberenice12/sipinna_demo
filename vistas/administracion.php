<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sipinna</title>
    <!--CSS-->
    <link type="text/css" href="../css/sipinna.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap-5.2.1-dist/css/bootstrap.min.css">

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

<body>

    <!--Head-->
    <input type="hidden" id="hoy" value="<?php echo date('Y-m-d'); ?>">
    <!--Container -->
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive col-md-12">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <h3>Usuarios</h3>
                    </div>
                    <div class="col-md-6" align="right">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearUsuario-modal">
                            <i class="fas fa-plus"></i> Agregar Usuario
                        </button>
                    </div>
                </div>
                <br>
                <table class="table table-hover" id="table" style="width: 100%;">
                    <thead class="tbl-estadisticas">
                        <tr align="center">
                            <th>Fotografia</th>
                            <th>Nombre Usuario</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td><img src="../images/sipinna.png" class="img-user"></td>
                            <td>Usuario 1</td>
                            <td>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal">
                                    <i class="fas fa-pen"></i>Editar
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarUsuarioModal">
                                    <i class="fas fa-trash"></i>Eliminar
                                </button>

                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
        <!--Modal Crear-->
        <div class="modal fade" id="crearUsuario-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" style="color:white;">Agregar Usuario</h5>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Imagen:</label><br>
                                    <img src="../images/sipinna.png" height="50%">
                                    <br></br>
                                    <input class="form-control" type="file" name="" id="">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nombre:</label>

                                    <input class="form-control" type="text" name="" id="">
                                    <label for="">Apellidos:</label>
                                    <input class="form-control" type="text" name="" id="">
                                    <label for="">Departamento:</label>
                                    <input class="form-control" type="text" name="" id="">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Usuario:</label>
                                    <input class="form-control" type="text" name="" id="">

                                    <label for="">Contraseña</label>
                                    <input class="form-control" type="password" name="" id="">

                                    <label for="">Repite Contraseña</label>
                                    <input class="form-control" type="password" name="" id="">
                                </div>

                                <div class="col-md-12">
                                    <label for="">Correo Electronico:</label>
                                    <input class="form-control" type="text" name="" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </div>

                </div>
            </div>
        </div>
        <br></br>
        <br></br>
    </div>

    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>

    </script>
    <script src="../js/funciones.js"></script>
    <?php include('../layout/footer.php'); ?>

    <!--modal-->
    <?php include('../vistas/usuario/modals-usuario.php'); ?>




</body>
<!--footer-->

</html>