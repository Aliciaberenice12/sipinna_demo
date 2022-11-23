<?php
require_once "./classLog.php";
$c = new Login();
session_start();

if (isset($_POST['func'])) {
    switch ($_POST['func']) {
        case 'valida_login':
            if (isset($_POST["log_user"]) and isset($_POST["log_psw"])) {
                $es = $c->valida_login($_POST['log_user'], $_POST['log_psw']);
                $es = explode('|', $es);
                if ($es[0] == 'ok') {
                    $arr_res = $c->retorna_datos_usuario($es[1]);
                    foreach ($arr_res as $row) {
                        $_SESSION["login_sipinna"] = "si";
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["nombre"] = $row["nombre"];
                        $_SESSION["apellidos"] = $row["apellidos"];
                        $_SESSION["departamento"] = $row["departamento"];
                        $_SESSION["imagen"] = $row["imagen"];

                        $datos = array(
                            'estatus' => 'ok',
                            'nombre' => $row["nombre"],
                            'apellidos' => $row["apellidos"],
                            'departamento' => $row["departamento"]
                        );
                    }
                    echo json_encode($datos, JSON_FORCE_OBJECT);
                } else
                    echo json_encode(['estatus' => $es[0]]);
            } else
                echo json_encode(['estatus' => 'user_psw_no_declarados']);
            break;

            case 'cerrar_sesion':
                if (isset($_SESSION["nombre"]))
                  $usuario = $_SESSION["nombre"];
                else
                  $usuario = 'no identificado';
                if (session_destroy()) {
                  $estatus = 'ok';
                  //$v->bitacora('Cierre de sesión',$usuario);
                } else
                  $estatus = 'error';
          
                echo json_encode(['estatus' => $estatus]);
                break;
        
            default:
            echo json_encode(['estatus' => 'valor_inválido']);
            break;
    }
} else
echo json_encode(['estatus' => 'no_declarado']);









/* 
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$query = $c->dbh->prepare("SELECT usuario, contrasena FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasena");

$query->bindParam(':usuario',$usuario);
$query->bindParam(':contrasena',$contrasena);
$query->execute();

if($row = $query->fetch(PDO::FETCH_ASSOC)){
    echo 1;
    $_SESSION['nameUser']= $usuario;
}else{
    echo 0;
}
 */
















$c->cerrarConexion();
