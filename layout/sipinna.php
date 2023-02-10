<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!--css-->
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap_icons_1_8_0/bootstrap-icons.css">
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
   
    <link href="../lib/bootstrap-5.2.1-dist/css/bootstrap.min.css" rel='stylesheet'>
    <script type='text/javascript' src='../lib/jquery.min.js'></script>
    <link type="text/css" href="../css/sipinna.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../lib/toastr/toastr.min.css">
    <link rel="stylesheet" href="../lib/swetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="../lib/datatables/jquery.dataTables.min.css">
    


</head>

<body class='snippet-body'>
    <div class="button-bars">
        <span class="fas fa-bars"></span>
    </div>
    <nav class="sidebar">
        <div class="sidebar" align="center">
            <ul>
                <li class="imgUser"><br>
                    <?php
                    if (isset($_SESSION['imagen'])) {
                        $imagen = $_SESSION['imagen'];
                    } else {
                    }

                    echo '<img src="../vistas/usuario/imgUser/' . $imagen . ' " alt="">';
                    ?>
                    <div class="name"><strong><?php echo $_SESSION["nombre"] . ' ' . $_SESSION["apellidos"] ?><br><?php echo $_SESSION["departamento"] ?></strong></div>
                </li>


                <li>

                    <a href="../vistas/canalizacion-index.php">
                        <button type="button" class="btn btn-nav1">Canalización de Casos de Posibles Afectaciones a los Derechos NNA</button>
                    </a>
                </li>
                <li>
                    <a href="../vistas/casos-c4.php">
                        <button type="button" class="btn btn-nav" id="caso_turnado">Casos turnados por C4</button>
                    </a>
                </li>
                <li>
                    <a href="../vistas/estadistica.php">
                        <button type="button" class="btn btn-nav ">Estadísticas</button>

                    </a>
                </li>
                <li>
                    <?php 
                    if(($_SESSION['rol_id']) and $_SESSION['rol_id']=='1'){?>
                      
                        <li><a href="../vistas/administracion.php">
                        <button type="button" class="btn btn-nav">Administración</button></a>
                        </li>
                        <li>
                        <a href="../vistas/catalogos.php">
                        <button type="button" class="btn btn-nav">Catálogos</button> </a>
                        </li>
                       
                    <?php }
                    ?>
                   
                </li>
               
                <li>
                    <button type="button" id="salir" class="btn btn-nav2" onclick="close_sesion()">Salir</button>


                </li>
            </ul>
        </div>

    </nav>

    <script>
        $('.button-bars').click(function() {
            $(this).toggleClass("click");
            $('.sidebar').toggleClass("show");
        });


        $('.sidebar ul li a').click(function() {
            var id = $(this).attr('id');
            $('nav ul li ul.item-show-' + id).toggleClass("show");
            $('nav ul li #' + id + ' span').toggleClass("rotate");

        });

        $('nav ul li').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>
    <script src="../js/login.js"></script>
    <script src="../lib/swetalert/sweetalert2.min.js"></script>
    <script src="../lib/toastr/toastr.min.js"></script>
    <script src="../lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <!-- <script src="../js/fun_canalizacion.js?x=<?php echo time(); ?>"></script> -->



</body>

</html>