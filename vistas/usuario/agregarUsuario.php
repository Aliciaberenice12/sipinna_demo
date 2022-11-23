<?php
include "../../config/class.pdo.php";

$c = new Conexion();
$c->conectar();


//Agregar Usuario
if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = $c->cargarImagen();
    }
    $stmt = $c->dbh->prepare("INSERT INTO usuarios(nombre, apellidos, departamento, usuario, contrasena, email, imagen) VALUES (:nombre, :apellidos, :departamento, :usuario, :contrasena, :email, :imagen)");
    try {
        $stmt->bindParam(':nombre', $_POST["nombre"]);
        $stmt->bindParam(':apellidos', $_POST["apellidos"]);
        $stmt->bindParam(':departamento', $_POST["departamento"]);
        $stmt->bindParam(':usuario', $_POST["usuario"]);
        $stmt->bindParam(':contrasena', $_POST["contrasena"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':imagen', $imagen);
        $resultado = $stmt->execute();
       
        if (!empty($resultado)) {
            echo 'Creado';
        } else {
            echo 'Registro no creadp';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



/* ---------------------------------------------------*/
//Editar Usuario
if ($_POST["operacion"] == "Editar") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = $c->cargarImagen();
    } else {
        $imagen = $_POST["imagen_usuario_oculta"];
    }

    $stmt = $c->dbh->prepare("UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, departamento=:departamento, usuario=:usuario, contrasena=:contrasena, email=:email, imagen=:imagen WHERE id=:id");
    try {
        $stmt->bindParam(':nombre', $_POST["nombre"]);
        $stmt->bindParam(':apellidos', $_POST["apellidos"]);
        $stmt->bindParam(':departamento', $_POST["departamento"]);
        $stmt->bindParam(':usuario', $_POST["usuario"]);
        $stmt->bindParam(':contrasena', $_POST["contrasena"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':id', $_POST["id_usuario"]);
        $resultado = $stmt->execute();
        if (!empty($resultado)) {
            echo 'Actualizado';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/* ---------------------------------------------------*/
$c->cerrarConexion();