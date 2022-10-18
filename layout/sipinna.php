<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!--css-->

    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <link href="../lib/bootstrap-5.2.1-dist/css/bootstrap.min.css" rel='stylesheet'>
    <script type='text/javascript' src='../lib/jquery.min.js'></script>
    <link type="text/css" href="../css/sipinna.css" rel="stylesheet" />

</head>

<body class='snippet-body'>
    <div class="button-bars">
        <span class="fas fa-bars"></span>
    </div>
    <nav class="sidebar">
        <div class="sidebar" align="center">
            <ul>
                <li>
                    <img src="../images/sipinna.png" class="img-perfil">
                    <div class="name"><strong>Jose Perez Garcia<br>Departamento Tecnologias</strong></div>
                </li>
                <li>

                    <a href="../vistas/canalizacion-index.php">
                        <button type="button" class="btn btn-nav1">Canalización de Casos de Posibles Afectaciones a los Derechos NNA</button>
                    </a>
                </li>
                <li>
                    <a href="../vistas/casos-c4.php">
                        <button type="button" class="btn btn-nav ">Casos turnados por C4</button>
                    </a>
                </li>
                <li>
                    <a href="../vistas/estadistica.php">
                        <button type="button" class="btn btn-nav ">Estadísticas</button>

                    </a>
                </li>
                <li>
                    <a href="../vistas/administracion.php">
                        <button type="button" class="btn btn-nav">Administración</button>

                    </a>
                </li>
                <li></li>
                <li>
                    <a href="../index.php">
                        <button type="button" id="salir" class="btn btn-nav2 ">Salir</button>
                        <a>
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


</body>

</html>