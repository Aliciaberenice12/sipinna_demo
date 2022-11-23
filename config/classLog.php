<?php

require_once('class.pdo.php');
class Login extends Conexion
{
   public $c;

    function valida_login($usuario, $contrasena)
    {
        $this->conectar();
        $sql = $this->dbh->prepare("SELECT id, usuario, contrasena FROM usuarios WHERE usuario = ? AND contrasena = ?");        

		$sql->execute(array($usuario,  $contrasena));
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($sql->rowCount() >= 1) {
			$id      = $row["id"];
			$estatus = 'ok';
		} else {
			$id      = 0;
			$estatus = 'user_pasword_incorrectos';
		}

		return $estatus . '|' . $id;
    }

    public function retorna_datos_usuario($id)
	{
		$sql = $this->dbh->prepare("SELECT id, nombre, apellidos, departamento, imagen from usuarios where id = ?");//Datos a mostrar en las variables de sesion
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		//$this->bitacora('Inicio de sesión ', $id);
		return $row;
	}
}
