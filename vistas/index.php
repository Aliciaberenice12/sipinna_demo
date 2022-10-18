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
            <h2 class="h2-titulo">Index</h2>
        </div>

        <div class="col-md-6">
            <img src="../images/imagen.png" class="img-log" align="right">
        </div>

    </div>

</head>

<body>
    <input type="hidden" id="hoy" value="<?php echo date('Y-m-d'); ?>">
    <div class="container-fluid">
        <div class="col-md-3">

            <button type="button" class="btn btn-primary  hint--bottom" aria-label="Catalogo Delitos" onclick="catalogo_delitos();">
                Catálogo Delitos
            </button>
        </div>
        <br>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary  hint--bottom" aria-label="Catalogo Municipio" onclick="catalogo_municipio();">
                Catálogo Municipios
            </button>
        </div>
        <br>
        <div class="col-md-3">
            <a href="../vistas/catalogo_parentesco.php">
                <button type="button" class="btn btn-primary">Catálogo Parentesco</button>
            </a>
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
    <script src="../js/funciones.js"></script>
    <script src="../js/fun_catalogos.js"></script>

</body>


</html>