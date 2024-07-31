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
    <title>SIPINNA</title>
    <?php include("../layout/sipinna.php"); ?>
    <div class="div-al row">
        <div class="col-md-6">
            <h2 class="h2-titulo">Estadísticas</h2>
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
        <div class="card">
            <div class="card-header">
                <h4>Generar Reporte</h4>
                <div class="row col-12">
                    <div class="col-2">
                        <h6>Origen:</h6>
                        <select class="form-select" name="gen_reporte" id="gen_reporte" >
                            <option value="0" selected disabled>Seleccione...</option>
                            <option value="1">Canalización</option>
                            <option value="2">Casos c4</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="id_reporte">Tipo:</label>
                        <select class="form-select" id="id_reporte" name="id_reporte">
                            <option value="0" selected disabled>Seleccione...</option>
                            <option value="1">Reporte por municipios</option>
                            <option value="2">Reporte por General(Sin Municipios)</option>
                            <option value="3">Reporte por General Total</option>
                        </select>
                    </div>
                    <div class="col-2" style="display:none;" id="div_estatus">
                        <label for="estatus">Estatus:</label>
                        <select class="form-select" id="estatus" name="estatus">
                            <option value="0" selected disabled>Seleccione...</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Concluido">Concluido</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="desde_fecha">Fecha desde:</label>
                        <input type="date" class="form-control" placeholder="Start" name="desde_fecha" id="desde_fecha" />
                    </div>
                    <div class="col-2">
                        <label for="hasta_fecha">Fecha hasta:</label>
                        <input type="date" class="form-control" placeholder="End" name="hasta_fecha" id="hasta_fecha" />
                    </div>
                    <div class="col-1">
                        <br>
                        <button type="button" class="btn btn-success" onclick="consulta()">consultar</button>

                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <h4 align="center" id="tituloReporte"></h4>
                    <div id="div_reportes"></div>
                </div>
                <div class="card-footer">
                    <br>
                    <p align="center">*NOTA: Cabe hacer mención que los casos involucran a más de una niña, niño o adolescente</p>
                    <br>
                </div>
            </div>
        </div>
        <?php include("../layout/footer.php"); ?>


        <!--script-->
        <script src="../js/estadisticas.js?x=<?php echo time(); ?>"></script>

</body>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modal_pdf" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="tit_modal_pdf" style="color:white;">pdf</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="col-md-12">

                <span class="" id="reporte"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


</html>