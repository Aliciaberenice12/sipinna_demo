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
            <div class="table-responsive col-md-12">
                <br>
                <h3>Suma Por Género</h3>
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-file-export"></i>
                    exportar
                </button>
                <table class="table table-hover" id="tabla_genero" style="width:100%">
                    <thead class="tbl-estadisticas">
                        <tr align="center">
                            <th>Municipio</th>
                            <th>Suma Masculino</th>
                            <th>Suma Femenino</th>
                            <th>Dirigido</th>
                            <th>Numero Delitos</th>
                            <th>Suma De Casos</th>
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
                        </tr>
                    </tbody>
                </table>
                <h3>Suma Por tipo de Violencia</h3>
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-file-export"></i>
                    exportar
                </button>
                <table class="table table-hover" id="tabla_tp_violencia" style="width:100%">
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

</body>


</html>