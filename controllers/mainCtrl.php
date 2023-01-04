<?php

class ControllerMain
{


    public function process($evento)
    {
        switch ($evento) {

            case 'obtener_usuarios':
                include_once "../models/usersModel.php";
                $objeto = new UserModel();
                $result = $objeto->getUsuarios();
                echo $result;
                break;

            case 'obtener_usuarioId':
                include_once "../models/usersModel.php";
                $data = $_POST;
                $objeto = new UserModel();
                $result = $objeto->getUsuarioId($data);
                echo $result;
                break;

            case 'editar_usuario':
                include_once "../models/usersModel.php";
                $data = $_POST;
                $objeto = new UserModel();
                $result = $objeto->editarUsuario($data);
                echo $result;
                break;

            case 'nuevo_usuario':
                include_once "../models/usersModel.php";
                $data = $_POST;
                $objeto = new UserModel();
                $result = $objeto->crearUsuario($data);
                echo $result;
                break;

            case 'borrar_usuario':
                include_once "../models/usersModel.php";
                $data = $_POST;
                $objeto = new UserModel();
                $result = $objeto->eliminarUsuario($data);
                echo $result;
                break;

            case 'roles_usuario':
                include_once "../models/usersModel.php";
                $data = $_POST;
                $objeto = new UserModel();
                $result = $objeto->loginRolesUsuario($data);
                echo $result;
                break;

            case 'obtener_perfil':
                include_once "../models/usersModel.php";
                $objeto = new UserModel();
                $result = $objeto->getPerfil();
                echo $result;
                break;

            case 'cerrar_sesion':
                include_once "../models/usersModel.php";
                $objeto = new UserModel();
                $result = $objeto->close_sesion();
                echo $result;
                break;

            case 'obtener_roles':
                include_once "../models/usersModel.php";                
                $objeto = new UserModel();
                $result = $objeto->lista_roles();
                echo $result;
                break;


            default:
                $arreglo = array(

                    "estatus"   => 400,
                    "message"   => "Acción no encontrada"

                );
                echo json_encode($arreglo, http_response_code($data['estatus']));
                break;
        }
    }
}



if (isset($_POST["accion"])) {

    $objeto = new ControllerMain();
    $objeto->process($_POST['accion']);
} else {

    $aData = array(
        "estatus"    => 400,
        "results"   => "",
        "message"   => "Error: parámetro no recibido"
    );

    echo json_encode($aData, http_response_code($aData["estatus"]));
}
