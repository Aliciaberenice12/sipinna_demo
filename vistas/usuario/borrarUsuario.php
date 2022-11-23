<?php
include "../../config/class.pdo.php";
//include "./funcionesImagen.php";

$c = new Conexion();
$c->conectar();

if (isset($_POST["id_usuario"])) {

    /* $imagen = $c->nombre_img($_POST["id_usuario"]);

    if ($imagen != '') {
        unlink("../usuario/imgUser/" . $imagen);
    }
 */
    $stmt = $c->dbh->prepare("UPDATE usuarios SET estado = 0 WHERE id = :id");

    $resultado = $stmt->execute(
        array(
            ':id' => $_POST["id_usuario"]
        )
        );

        if (!empty($resultado)) {
            echo 'Borrado';
        }
}

$c->cerrarConexion();