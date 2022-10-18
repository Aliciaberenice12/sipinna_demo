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
            <div class="table-responsive col-md-12">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <h3></h3>
                    </div>
                    <div class="col-md-6" align="right">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearCaso-c4">
                            <i class="fas fa-plus"></i> Nuevo Caso
                        </button>
                    </div>
                </div>

                <br>
                <table class="table table-hover" id="table" style="width:100%">
                    <thead class="tbl-estadisticas">
                        <tr align="center">
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Número</th>
                            <th>Dirigido</th>
                            <th>Tipo Violencia</th>
                            <th>Nombre Sujeto(Victima)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td>01</td>
                            <td>27/08/2022</td>
                            <td>DG</td>
                            <td></td>
                            <td>AMENAZA</td>
                            <td>JOSE PEREZ GARCIA </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarCaso-c4">
                                    <i class="fas fa-pen"></i> Editar Caso
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelarCaso-c4">
                                    <i class="fas fa-trash"></i> Cancelar Caso
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
        <br></br>
        <br></br>

    </div>
    <?php include("../layout/footer.php"); ?>

    <?php include("../vistas/casos-c4/modals-casos-c4.php"); ?>

    <!--script-->
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/jquery.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../js/funciones.js"></script>
    
</body>


</html>