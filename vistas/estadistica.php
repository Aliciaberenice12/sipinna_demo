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
    <link rel="stylesheet" href="../lib/swetalert/sweetalert2.min.css">
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
                <div class="row">
                    <div class="col-md-2">
                        <h6><strong>Generar Reporte de:</strong> </h6>

                        <select class="form-select" name="gen_reporte" id="gen_reporte">
                            <option value="0" selected disabled>Seleccione</option>
                            <option value="1">Canalización</option>
                            <option value="2">Casos c4</option>
                     
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="id_reporte">Reporte a consultar:</label>
                        <select class="form-select" id="id_reporte" name="id_reporte">
                            <option value="0" selected disabled>Seleccione</option>
                            <option value="1">Reporte por municipios</option>
                            <option value="2">Reporte por General(Sin Municipios)</option>
                            <option value="3">Reporte por General Total</option>     
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="desde_fecha">Fecha Desde:</label>
                        <input type="date" class="form-control" placeholder="Start" name="desde_fecha" id="desde_fecha" />
                    </div>
                    <div class="col-md-2">
                        <label for="hasta_fecha">Fecha hasta:</label>
                        <input type="date" class="form-control" placeholder="End" name="hasta_fecha" id="hasta_fecha" />
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button type="button" class="btn btn-success" onclick="consulta()">consultar</button>

                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div id="div_reportes_canalizacion">
                        <!-- <div id="consulta_sexo_municipio"></div> -->
                       
                        <h5> Se muestran los datos de Canalización</h5>
                        <div class="col-md-12" align="center">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" id="numero_casos"></div>
                            <div class="col-md-4"></div>

                        </div>
                        <div id="div_consulta_general">
                            <h5 align="center"><strong>Todos los Reportes(Sin Municipios)</strong></h5>
                        </div>
                        <div id="div_consulta_mes_num_casos_can">
                            <h5 align="center"><strong>Total de casos agrupados por mes </strong></h5>
                            <div id="consulta_meses_num_casos_can"></div>
                        </div>
                        <div id="div_cunsulta_genero_can">
                            <h5 align="center"><strong>Total de victimas por genero de todos los casos</strong></h5>
                            <div id="consulta_genero">
                            </div>
                        </div>
                        <div id="div_consulta_edad_can">
                            <h5 align="center"><strong>Total de victimas por edades de todos los casos</strong></h5>
                        
                            <div id="consulta_edad_can"></div>
                            <div id="consulta_edad_mayores_can"></div>
                            <div id="consulta_per_vul_can"></div>
                        </div>                  
                        <div id="div_consulta_num_delitos_casos_can">
                            <h5 align="center"><strong>Total de delitos hacia victimas todos los casos</strong></h5>
                            <div id="consulta_delitos_todos_casos_can"></div>
                        </div>
                  
                        <div id="div_consulta_casos_por_municipio_can">
                            <h5 align="center"><strong>Total de casos en cada municipio</strong></h5>
                            <div id="consulta_casos_por_municipio_veracruz_can"></div>
                        </div>
                       

                    </div>
                    <div id="div_reportes_casos_c4">
                        <h5> Se muestran los datos de Casos C4</h5>
                        <div class="col-md-12" align="center">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" id="numero_casos_c4"></div>
                            <div class="col-md-4"></div>

                        </div>
                        <div id="div_consulta_mes_num_casos_c4">
                            <h5 align="center"><strong>Total de casos agrupados por mes </strong></h5>
                            <div id="consulta_meses_num_casos_c4"></div>
                        </div>
                        
                        <div id="div_cunsulta_genero_c4">
                            <h5 align="center"><strong>Total de victimas por genero todos los casos</strong></h5>
                            <div id="consulta_genero_c4"></div>
                        </div>
                        <div id="div_consulta_edad_c4">
                            <h5 align="center"><strong>Total de todas victimas por edades casos</strong></h5>
                           
                            <div id="consulta_edad_c4"></div>
                            <div id="consulta_edad_mayores_c4"></div>
                            <div id="consulta_suma_datos_per_vul_c4"></div>
                        </div>
                        
                        <div id="div_consulta_num_delitos_casos_c4">
                            <h5 align="center"><strong>Total de delitos hacia victimas todos los casos</strong></h5>
                            
                            <div id="consulta_delitos_todos_casos_c4"></div>
                        </div>
                        <div id="div_consulta_casos_por_municipio_c4">
                            
                            <h5 align="center"><strong>Total casos en cada municipio</strong></h5>
                            <div id="consulta_casos_por_municipio_veracruz_c4"></div>
                        </div>
                        
                    </div>
                  

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
        <script src="../lib/swetalert/sweetalert2.min.js"></script>
        <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="../lib/jquery.min.js"></script>
        <script src="../js/funciones.js"></script>
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
<script src="../lib/datatables/jquery.dataTables.min.js"></script>


</html>