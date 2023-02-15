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
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <?php include("../layout/sipinna.php"); ?>
    <link rel="stylesheet" type="text/css" href="../lib/toastr/toastr.css">
    <div class="div-al row">


        <div class="col-md-6">
            <h2 class="h2-titulo">Casos turnados por C4</h2>
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
            <div>
                <div class="row col-md-12">
                   
                    <div class="col-md-4" align="left">

                        <button type="button" class="btn btn-success" onclick="mod_caso_c4(1,0);">
                            <i class="bi bi-plus-circle"></i> Crear Caso
                        </button>
                        <button type="button" class="btn btn-success hint--top" aria-label="actualizar_listado" id="actualizar_listado" onclick="fn_listar_casos_c4();">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                    <?php
                    if (($_SESSION['rol_id']) and $_SESSION['rol_id'] == '1') { ?>
                        <div class="col-md-8" align="right">
                            <label>Mostrando Expedientes:</label>
                            <input class="btn btn-recepcion" type="button" id="myBtn_c4" value="Activos" onclick="tgl();">
                        </div>
                    <?php }
                    ?>
                </div>
                <br>
                <div id="canalizaciones_inactivas_c4">
                    <h5 align="center">Mostrando datos de expedientes <strong>Inactivos</strong></h5>
                    <div id="ver_lista_canalizaciones_inactivas_c4"></div>
                </div>
                <div id="canalizaciones_activas_c4">
                    <h5 align="center">Mostrando Expedientes de Canalización <strong>Activos</strong> </h5>
                    <div id="ver_lista_casos_c4"></div>

                </div>
                <br>

            </div>
        </div>
        <br>
    </div>
    <?php include("../layout/footer.php"); ?>
    <!--Scripts-->
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <?php include("../vistas/casos-c4/modals-c4.php"); ?>
    <script src="../js/fun_caso_c4.js?x=<?php echo time(); ?>"></script>
    <script src="../js/fun_carrito.js?x=<?php echo time(); ?>"></script>




</body>

</html>