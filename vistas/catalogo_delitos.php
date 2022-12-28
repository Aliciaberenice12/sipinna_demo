<?php
if(session_status() == PHP_SESSION_NONE){session_start();}

if(isset($_SESSION['nombre'])){
    $user = $_SESSION['nombre'];
}else{
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
    <link rel="stylesheet" type="text/css" href="../lib/toastr/toastr.css">
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../lib/sweetalert2/dist/sweetalert2.css" />

    <?php include("../layout/sipinna.php"); ?>

    <div class="div-al row">

        <div class="col-md-6">
            <h2 class="h2-titulo">Catálogo Delitos</h2>
        </div>

        <div class="col-md-6">
            <img src="../images/imagen.png" class="img-log" align="right">
        </div>

    </div>

</head>

<body>

    <!--Head-->
    <input type="hidden" id="hoy" value="<?php echo date('Y-m-d'); ?>">
    <div class="container-fluid">
        <div class="row">
            <!--Agresiones -->
            <div class="table-responsive col-md-12">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <h3>Delitos</h3>
                    </div>
                    <div class="col-md-6" align="right">
                        <button type="button" class="btn btn-success" onclick="mod_cat_delitos(1,0);">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                        <button type="button" class="btn btn-primary hint--top" aria-label="Actualizar" onclick="fn_listar_delitos();">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                    <div id="ver_lista_delitos"></div>
                </div>
                <br>
            </div>

        </div>
        <!--Modal Crear-->
        <div class="modal fade" id="mod_cat_delitos" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title" id="tit_mod_delitos" style="color:white"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_del_cat" id="id_del_cat" value="0">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="delito" value="" id="delito" placeholder="delito *" maxlength="100">
                                    <label for="delito">Delito *</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_d" class="btn btn-dark" onclick="fn_guardar_delito();">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>2022 &reg; Algunos derechos reservados</p>
    </footer>
    <!--script-->
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../lib/toastr/toastr.min.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../lib/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="../js/fun_catalogos.js?x=<?php echo time(); ?>"></script>


</body>


</html>