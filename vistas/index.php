<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../lib/sweetalert2/dist/sweetalert2.css" />

    <?php include("../layout/sipinna.php"); ?>

    <div class="div-al row">

        <div class="col-md-6">
            <h2 class="h2-titulo">Catálogos</h2>
        </div>

        <div class="col-md-6">
            <img src="../images/imagen.png" class="img-log" align="right">
        </div>

    </div>

</head>

<body>
    <input type="hidden" id="hoy" value="<?php echo date('Y-m-d'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="padding-top:5em;">
                <!--
                <button type="button" class="btn btn-catalogo  hint--bottom" aria-label="Catalogo Delitos" onclick="catalogo_delitos();">
                    Catálogo Delitos
                </button>
                -->
                <!--
                <button type="button" class="btn btn-catalogo  hint--bottom" aria-label="Catalogo Municipio" onclick="catalogo_municipio();">
                    Catálogo Municipios
                </button>
                <a href="../vistas/catalogo_parentesco.php">
                    <button type="button" class="btn btn-catalogo">Catálogo Parentesco</button>
                </a>
                -->
                <button type="button" class="btn btn-catalogo  hint--bottom" aria-label="Catalogo Municipio" name="tbl_municipio" id="tbl_municipio" onclick="mostrar_tablas(1);">
                    Catálogo Municipios
                </button>
                <div><br></div>
                <button type="button" class="btn btn-catalogo  hint--bottom" aria-label="Catalogo Delitos" name="tbl_delitos" id="tbl_delitos" onclick="mostrar_tablas(2);">
                    Catálogo Delitos o Faltas
                </button>
                <div><br></div>

                <button type="button" class="btn btn-catalogo  hint--bottom" aria-label="Catalogo Delitos" name="tbl_parentesco" id="tbl_parentesco" onclick="mostrar_tablas(3);">
                    Catálogo Parentescos
                </button>
                <div><br></div>

            </div>
            <div class="col-md-9">
                <div id="ver_lista_delitos"></div>
                <div id="ver_lista_municipios"></div>
                <div id="ver_lista_parentescos"></div>
                <br>
                <br>
            </div>
        </div>


    </div>

    <footer>
        <p>2022 &reg; Algunos derechos reservados</p>
    </footer>
    <!--Modal Parentesco-->
    <div class="modal fade" id="mod_cat_parentescos" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="tit_mod_par" style="color:white;"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_par_cat" id="id_par_cat" value="0">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="parentesco" id="parentesco" placeholder="Parentesco *" maxlength="300">
                                <label for="parentesco">Parentesco *</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_par" class="btn btn-dark" onclick="fn_guardar_parentesco();">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Municipio-->
    <div class="modal fade" id="mod_cat_municipios" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="tit_mod_mun" style="color:white"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_mun_cat" id="id_mun_cat" value="0">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio *" maxlength="100">
                                <label for="municipio">Municipio *</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_mun" class="btn btn-dark" onclick="fn_guardar_municipio();">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Delitos-->
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
    <!--script-->
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../js/fun_catalogos.js?x=<?php echo time(); ?>"></script>
    <script src="../lib/sweetalert2/dist/sweetalert2.min.js"></script>


</body>


</html>