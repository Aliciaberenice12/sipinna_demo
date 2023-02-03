<?php

session_start();

class UserModel
{
    public function getUsuarios(){

        include_once "../config/class.pdo.php";

        $conexion = new Conexion();
        $conexion->conectar();

        try {

            /* perfil 1 = administrador */
            /* perfil 0 = usuario normal */
            $sqlQuery = "SELECT * FROM usuarios WHERE estado = 1 AND perfil <> 1";

            $stmt = $conexion->dbh->prepare($sqlQuery);
            $stmt->execute();

            $aData = array();
            $aTempData = null;

            //$results= $stmt->fetchAll(PDO::FETCH_CLASS);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $picture = empty($imagen) ? 'avatar.jpg' : $imagen;

                $imagen = '<img src="../vistas/usuario/imgUser/' . $picture . '" class="img_user" />';

                $aTempData = array(
                    "id_usuario"    => $id_usuario,
                    "nombre"        => $nombre,
                    "apellidos"     => $apellidos,
                    "departamento"  => $departamento,
                    "usuario"       => $usuario,
                    "email"         => $email,
                    "imagen"        => $imagen,
                    "estado"        => $estado
                );

                array_push($aData, $aTempData);
            }

            $arreglo = array(
                "estatus"   => 200,
                "message"   => "Proceso completado",
                "total"     => count($aData),
                "data"      => $aData
            );
        } catch (PDOException $e) {

            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }

        echo json_encode($arreglo);
    }

    public function getUsuarioId($data) {

        include_once "../config/class.pdo.php";

        $conexion = new Conexion();
        $conexion->conectar();
        

        try {

            $sqlQuery = "SELECT id_usuario, nombre, apellidos, departamento, usuario, email, imagen, estado, perfil, rol_id FROM usuarios WHERE estado = 1 AND id_usuario = :id_usuario";

            $stmt = $conexion->dbh->prepare($sqlQuery);
            $stmt->bindParam(":id_usuario", $data['id_usuario']);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_CLASS);

            $arreglo = array(
                "estatus"   => 200,
                "message"   => "Proceso completado",
                "total"     => count($results),
                "data"      => $results
            );
        } catch (PDOException $e) {

            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }

        echo json_encode($arreglo);
    }

    public function crearUsuario($data) {

        include_once "../config/class.pdo.php";


        $conexion = new Conexion();
        $conexion->conectar();


        try {

            $imagen = '';
            if ($_FILES["imagen_usuario"]["name"] != '') {
                $imagen = $conexion->cargarImagen();
            } else {
                $imagen = "avatar.jpg";
            }

            /* Encripta el acceso antes de buscar en la base de datos */
            $cont = $conexion->criptpass($data["contrasena"]);

            $nombre         = $_POST['nombre'];
            $apellidos      = $_POST['apellidos'];
            $departamento   = $_POST['departamento'];
            $usuario        = $_POST['usuario'];
            $contrasena     = $cont;
            $email          = $_POST['email'];
            $rol            = (int)$_POST['rol_usuario'];

            $sqlQuery = "INSERT INTO usuarios (nombre, apellidos, departamento, usuario, contrasena, email, imagen, rol_id) 
                         VALUES (:nombre, :apellidos, :departamento, :usuario, :contrasena, :email, :imagen, :rol_id)";

            $stmt = $conexion->dbh->prepare($sqlQuery);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":departamento", $departamento);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":contrasena", $contrasena);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':rol_id', $rol);

            $stmt->execute();

            $arreglo = array(
                "lastId" => $conexion->dbh->lastInsertId(),
                "estatus"   => 200,
                "imagen"    => $imagen,
                "message"   => "Usuario agregado con éxito en la base de datos"
            );
        } catch (PDOException $e) {
            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }


        echo json_encode($arreglo);
    }

    public function editarUsuario($data) {
        include_once "../config/class.pdo.php";

        /* print_r($data);
        die(); */

        $conexion = new Conexion();
        $conexion->conectar();

        try {

            $imagen = '';
            if ($_FILES["imagen_usuario"]["name"] != '') {
                $imagen = $conexion->cargarImagen();
            } else {
                $imagen = $_POST["img_user"];
            }

            $sqlQuery = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, departamento=:departamento, usuario=:usuario, email=:email, rol_id=:rol_id, imagen=:imagen WHERE id_usuario=:id";

            $stmt = $conexion->dbh->prepare($sqlQuery);

            $stmt->bindParam(':nombre', $_POST["nombre"]);
            $stmt->bindParam(':apellidos', $_POST["apellidos"]);
            $stmt->bindParam(':departamento', $_POST["departamento"]);
            $stmt->bindParam(':usuario', $_POST["usuario"]);
            $stmt->bindParam(':email', $_POST["email"]);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':rol_id', $_POST["rol_usuario"]);
            $stmt->bindParam(':id', $_POST["id_usuario"]);

            $stmt->execute();

            $arreglo = array(
                "estatus"   => 200,
                "lastId"    => 1,
                "imagen"    => $imagen,
                "message"   => "Usuario Actualizado Correctamente"
            );
        } catch (PDOException $e) {
            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }

        echo json_encode($arreglo);
    }

    public function eliminarUsuario($data){
        include_once "../config/class.pdo.php";

        $conexion = new Conexion();
        $conexion->conectar();

        try {
            $stmt = $conexion->dbh->prepare("UPDATE usuarios SET estado = 0 WHERE id_usuario = :id");

            $stmt->bindParam(':id', $data["id_usuario"]);

            $stmt->execute();

            $arreglo = array(
                "estatus"   => 200,
                "lastId"    => $data["id_usuario"],
                "message"   => "Usuario Borrado Correctamente"
            );
        } catch (PDOException $e) {
            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }

        echo json_encode($arreglo);
    }

    public function loginRolesUsuario($data) {
        include_once "../config/class.pdo.php";

        $conexion = new Conexion();

        $conexion->conectar();

        try {

            $sqlQuery = "SELECT id_usuario, nombre, apellidos, departamento, usuario, imagen, contrasena, estado, perfil, rol_id FROM usuarios WHERE estado = 1 AND usuario = :usuario AND contrasena = :pass";

            /* Encripta el acceso antes de buscar en la base de datos */
            $pass = $conexion->criptpass($data['pass']);


            $stmt = $conexion->dbh->prepare($sqlQuery);
            $stmt->bindParam(":usuario", $data['usuario']);
            $stmt->bindParam(":pass", $pass);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $registros = $stmt->rowCount();

            if ($registros > 0) {

                $picture = empty($results[0]["imagen"]) ? 'avatar.jpg' : $results[0]["imagen"];

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION["login_sipinna"] = "si";
                $_SESSION["id"]            = $results[0]["id_usuario"];
                $_SESSION["nombre"]        = $results[0]["nombre"];
                $_SESSION["apellidos"]     = $results[0]["apellidos"];
                $_SESSION["departamento"]  = $results[0]["departamento"];
                $_SESSION["perfil"]        = $results[0]["perfil"];
                $_SESSION["imagen"]        = $picture;
                $_SESSION["rol_id"]        = $results[0]["rol_id"];



                $arreglo = array(
                    "estatus"        => 200,
                    "message"        => "Login Exitoso",
                );
            } else {
                $arreglo = array(
                    "estatus"        => 404,
                    "message"        => "Usuario y/o contraseña son incorrectos"
                );
            }
        } catch (PDOException $e) {

            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }

        echo json_encode($arreglo);
    }

    public function lista_roles()
    {
        include_once "../config/class.pdo.php";

        $conexion = new Conexion();
        $conexion->conectar();

        try {


            // Preparar la consulta
            $stmt = $conexion->dbh->prepare('SELECT * FROM roles');
            
            // Ejecutar la consulta
            $stmt->execute();

            // Recuperar los resultados
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $arreglo = array(
                    "estatus"        => 200,
                    "message"        => "Login Exitoso",
                    "total"          => count($results),
                    "data"           => $results
                );
            
        } catch (PDOException $e) {

            $arreglo = array(
                "estatus"   => 400,
                "message"   =>  $e->getMessage()
            );
        }

        echo json_encode($arreglo);
    }

    public function getPerfil(){


        $perfil = $_SESSION["perfil"];

        $arreglo = array(
            "estatus"   => 200,
            "message"   =>  $perfil
        );

        echo json_encode($arreglo);
    }

    public function close_sesion()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();

        $arreglo = array(
            "estatus"        => 200,
            "message"        => "Close Exitoso",
        );

        echo json_encode($arreglo);
    }
}
