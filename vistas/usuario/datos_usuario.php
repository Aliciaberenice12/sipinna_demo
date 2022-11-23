<?php
require_once('../../config/class.pdo.php');
//include "./funcionesImagen.php";

$c = new Conexion();
$c->conectar();

$query = "";
    $salida = array();
    $query = "SELECT * FROM usuarios WHERE estado = 1 ";

    if (isset($_POST["search"]["value"])) {
       $query .= 'AND nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
       $query .= 'OR apellidos LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';        
    }else{
        $query .= ' ORDER BY usuarios . id DESC ';
    }
    //SELECT * FROM `usuarios` ORDER BY `usuarios`.`id` ASC 
    if($_POST["length"] != -1){
        $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    }


$stmt = $c->dbh->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();
foreach($resultado as $fila){
    $imagen = '';
    if($fila["imagen"] != ''){
        $imagen = '<img src="../vistas/usuario/imgUser/' . $fila["imagen"] . '"  class="img-thumbnail" width="50" height="50 " />';
    }else{
        $imagen = '';
    }

    $sub_array = array();
    //$sub_array[] = $fila["id"];
    $sub_array[] = $fila["nombre"];
    $sub_array[] = $fila["apellidos"];
    $sub_array[] = $fila["departamento"];
    $sub_array[] = $fila["usuario"];
    //$sub_array[] = $fila["contrasena"];
    $sub_array[] = $fila["email"];
    $sub_array[] = $imagen;
    $sub_array[] = '<button type="button" name="editar" id="'.$fila["id"].'" class="btn btn-primary btn-xs editar"><i class="bi bi-pencil-square"></i></button>';
    $sub_array[] = '<button type="button" name="borrar" id="'.$fila["id"].'" class="btn btn-danger btn-xs borrar"><i class="bi bi-trash"></i></button>';
    $datos[] = $sub_array;
} 

$salida = array(
    "draw"               => intval($_POST["draw"]),
    "recordsTotal"       => $filtered_rows,
    "recordsFiltered"    => $c->contarDatos(),
    "data"               => $datos,
    "msg"                => "probando"
);

echo json_encode($salida);




$c->cerrarConexion();
