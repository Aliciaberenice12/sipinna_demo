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
            <div class="col-md-12">
                <label>Rellene los siguientes campos</label>
                <br><br>
            </div>

            <div class="col-md-2">
                <label>Código:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Número:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Número Oficio:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Fecha:</label>
                <input type="date" class="form-control" placeholder="Fecha" id="fecha" name="fecha">
            </div>
            <div class="col-md-2">
                <label>Dirigido:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Dirección General:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-4">
                <label>Municipo:</label>
                <select name="via_recepcion" class="form-select">
                    <option value="" selected>Seleccione...</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Tipo de violencia:</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione...</option>
                    <option value="1">Violencia</option>
                    <option value="2">familiar</option>
                    <option value="3">Omisión de cuidado</option>
                    <option value="">Abuso Sexual contra menores</option>
                    <option value="">Amenazas</option>
                    <option value="">Maltrato a persona incapaz</option>
                    <option value="">Corrupción de menores</option>
                    <option value="">Trata de personas</option>
                    <option value="">Narcomenudeo</option>
                    <option value="">Violación</option>
                    <option value="">Armas de fuego</option>
                    <option value="">Estupro</option>
                    <option value="">Pederastia</option>
                    <option value="">Robo</option>
                    <option value="">Contra el medio ambiente</option>
                </select>
            </div>
            <h5>Datos Probable Responsable</h5>
            <div class="col-md-4">
                <label>Nombre Probable Responsable</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>

            <div class="col-md-2">
                <label>Número Delitos:</label>
                <input type="number" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Lugar de los Hechos:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>

            <div class="col-md-2">
                <label>Edad:</label>
                <input type="number" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Parentesco con víctima:</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <h5>Datos Víctima</h5>
            <div class="col-md-4">
                <label>Nombre Sujeto (Víctima):</label>
                <input type="text" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Edad:</label>
                <input type="number" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-2">
                <label>Número Víctimas:</label>
                <input type="number" class="form-control" placeholder="" id="" name="">
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Persona Tercera Edad
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Persona con alguna Discapacidad
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Violencia Contra la Mujer
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <h5>Género</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Masculino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Femenino
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <br>
                <label>Hechos:</label>
                </br>
                <textarea name="textarea" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-3">
                <br>
                <label>Observaciones:</label>
                <textarea name="textarea" class="form-control" rows="3"></textarea>
                </br>
            </div>
            <br></br>
            <br></br>
            <div align="right">
                <button type="button" class="button-siguiente">Siguiente</button>
                <button type="button" class="button-cancelar">Cancelar</button>

            </div>
        </div>

        <br></br>
        <br></br>
    </div>
    <?php include("../layout/footer.php"); ?>

</body>


</html>