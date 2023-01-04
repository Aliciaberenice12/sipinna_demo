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
    <script type='text/javascript' src='../lib/jquery.min.js'></script>
    <link rel="stylesheet" href="../lib/swetalert/sweetalert2.min.css">

    <?php include("../layout/sipinna.php"); ?>

    <div class="div-al row col-md-12">

        <div class="col-md-8">
            <h2 class="h2-titulo-index">Index
            </h2>
        </div>

        <div class="col-md-4">
            <img src="../images/imagen.png" class="img-log" align="right">
        </div>

    </div>

</head>

<body>

    <!--Head-->
    <input type="hidden" id="hoy" value="<?php echo date('Y-m-d'); ?>">
    <!--Container -->
    <div class="container-fluid">
       
    </div>
    <?php include("../layout/footer.php"); ?>

    <?php include("../vistas/canalizacion/modals-canalizacion.php"); ?>

    <script src="../js/fun_canalizacion.js?x=<?php echo time(); ?>"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../lib/swetalert/sweetalert2.min.js"></script>


</body>


</html>