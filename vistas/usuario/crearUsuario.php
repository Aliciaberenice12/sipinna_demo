<?php
include "../../config/class.pdo.php";
//include "./funcionesImagen.php";

$c = new Conexion();
$c->conectar();

if (isset($_POST["id_usuario"])) {
    $salida = array();
    $stmt = $c->dbh->prepare("SELECT * FROM usuarios WHERE id='" . $_POST["id_usuario"] . "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        $salida["nombre"] = $fila["nombre"];
        $salida["apellidos"] = $fila["apellidos"];
        $salida["departamento"] = $fila["departamento"];
        $salida["usuario"] = $fila["usuario"];
        $salida["contrasena"] = $fila["contrasena"];
        $salida["email"] = $fila["email"];
        

     
        if ($fila["imagen"] != "") {
            $salida["imagen_usuario"] = '<img src="../vistas/usuario/imgUser/' . $fila["imagen"] . '"  class="img-thumbnail" width="150" height="150" />
            <input type="hidden" name="imagen_usuario_oculta" value="' . $fila["imagen"] . '" />';
        } else {
            $salida["imagen_usuario"] = '<input type="hidden" name="imagen_usuario_oculta" value="" />';
        }
    }

    echo json_encode($salida);
}