
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sipinna</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <?php include("../layout/sipinna.php"); ?>


    <div class="div-al row">

        <div class="col-md-6">
            <h2 class="h2-titulo-canalizacion">Canalización de Casos de Posibles Afectaciones a los Derechos de los NNA</h2>
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
                        <h3></h3>
                    </div>
                    <div class="col-md-6" align="right">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearCanalizacion">
                            <i class="fas fa-plus"></i> Nueva canalización
                        </button>
                    </div>
                </div>

                <br>
           
                <table class="table table-hover" id="table" style="width: 100%;">
                    <thead class="tbl-estadisticas">
                        <tr align="center">
                            <th>Nombre Solicitante</th>
                            <th>Fecha</th>
                            <th>Via Recepción</th>
                            <th>Municipio</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-secondary" id="Crear">
                                    <i class="fas fa-file"></i> Avances
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarCanalizacion">
                                    <i class="fas fa-pen"></i> Editar
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelarCanalizacion">
                                    <i class="fas fa-trash"></i> Cancelar
                                </button>

                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <?php include("../vistas/canalizacion/modals-canalizacion.php"); ?>
    <?php include("../vistas/canalizacion/modals-avances.php"); ?>
    <script src="../js/funciones.js"></script>

    <?php include("../layout/footer.php"); ?>

</body>

</html>