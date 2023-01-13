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
        <div class="row">
            <div class="col-md-3">
                <label for="id_reporte">Reporte a consultar:</label>
                <select class="form-select"name="select" id="id_reporte" name="id_reporte">
                    <option value="0" selected>Seleccione</option>
                    <option value="1">Suma por Genero</option>
                    <option value="2">Suma por tipo de Violencia</option>
                    <option value="3">Suma por Agresión Extraordinaria</option>
                    <option value="4">Suma por Edades de victimas</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="desde_fecha">Fecha Desde:</label>
                <input type="date" class="form-control" placeholder="Start" name="desde_fecha" id="desde_fecha"  />
            </div>
            <div class="col-md-4">
                <label for="hasta_fecha">Fecha hasta:</label>
                <input type="date" class="form-control" placeholder="End" name="hasta_fecha" id="hasta_fecha" />
            </div>
            <div class="col-md-1">
                <br>
                <button type="button" class="btn btn-success" onclick="consulta()">consultar</button>

            </div>

            <div class="col-md-12">
                <p></p>
            </div>
    
            <div class="card" id="suma_genero">
                <div class="card-body">

                    <h3>Suma Por Género</h3>
                    
                    <div id="consulta_sexo_municipio"></div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3>Suma Por tipo de Violencia</h3>
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-file-export"></i>
                        exportar
                    </button>
                    <table class="table table-responsive" id="tabla_tp_violencia" style="width:100%">
                        <thead class="tbl-estadisticas">
                            <tr align="center">
                                <th>Municipio</th>
                                <th>violencia familiar</th>
                                <th>Omisión de cuidado</th>
                                <th>Abuso sexual contra menores</th>
                                <th>Amenazas</th>
                                <th>Maltrato a persona incapaz</th>
                                <th>Corrupción de menores</th>
                                <th>Trata de personas</th>
                                <th>Narco menudeo</th>
                                <th>Violación</th>
                                <th>Arma de fuego</th>
                                <th>Estupro</th>
                                <th>Pederastia</th>
                                <th>Robo</th>
                                <th>Contra el medio ambiente</th>
                                <th>Suman número de delitos</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr align="center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                        </tbody>

                    </table>


                </div>

            </div>
            <div class="table-responsive col-md-12">
                <br>


                <h3>Suma Por ....</h3>
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-file-export"></i>
                    exportar
                </button>
                <table class="table table-hover" id="" style="width:100%">
                    <thead class="tbl-estadisticas">
                        <tr align="center">
                            <th>Municipio</th>
                            <th>Suma Violencia Contra la mujer</th>
                            <th>Suma de Persona con alguna discapacidad</th>
                            <th>Suma de Otros (personas de la tercera edad)</th>
                            <th>Suma de Se desconoce</th>



                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>

                    </tbody>

                </table>
                <h3>Suma Por ....</h3>
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-file-export"></i>
                    exportar
                </button>
                <table class="table table-hover" id="" style="width:100%">
                    <thead class="tbl-estadisticas">
                        <tr align="center">
                            <th>Municipio</th>
                            <th>Cuenta de Edad victima 1</th>
                            <th>Cuenta de Edad victima 2</th>
                            <th>Cuenta de Edad victima 3</th>
                            <th>Cuenta de Edad victima 4</th>
                            <th>Cuenta de Se desconoce</th>
                            <th>Suma de Número de victimas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>

                    </tbody>

                </table>

            </div>
        </div>
        <br></br>
        <br></br>

    </div>
    <?php include("../layout/footer.php"); ?>


    <!--script-->
    <script src="../lib/swetalert/sweetalert2.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../js/estadisticas.js?x=<?php echo time(); ?>"></script>


</body>


</html>