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
    <link rel="stylesheet" type="text/css" href="../lib/sweetalert2/dist/sweetalert2.css" />
    <link rel="stylesheet" type="text/css" href="../lib/toastr/toastr.css">
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
            <div >
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <h3></h3>
                    </div>
                    <div class="col-md-6" align="right">

                        <button type="button" class="btn btn-success" onclick="mod_canalizacion(1,0);">
                            <i class="bi bi-plus-circle"></i> Crear Canalización
                        </button>
                        <button type="button" class="btn btn-success hint--top" aria-label="Actualizar listado" onclick="fn_listar_canalizaciones();">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div id="ver_lista_canalizaciones"></div>
                </div>
                <br>

            </div>
        </div>
        <br>
    </div>
    <?php include("../layout/footer.php"); ?>

    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <?php include("../vistas/canalizacion/modals-canalizacion.php"); ?>
    <?php include("../vistas/canalizacion/modals-avances.php"); ?>
    <script src="../js/funciones.js"></script>
    <script src="../js/fun_canalizacion.js?x=<?php echo time(); ?>"></script>
    <script src="../lib/toastr/toastr.min.js"></script>
    <script src="../lib/sweetalert2/dist/sweetalert2.min.js"></script>



</body>

</html>