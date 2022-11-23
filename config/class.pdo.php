<?php
date_default_timezone_set("America/Mexico_City");

class SafePDO extends PDO
{
	public static function exception_handler($exception)
	{
		die("Uncaught exception: " . $exception->getMessage());
	}
	public function __construct($dsn, $username = '', $password = '', $driver_options = array())
	{
		set_exception_handler(array(__CLASS__, 'exception_handler'));
		parent::__construct($dsn, $username, $password, $driver_options);
		restore_exception_handler();
	}
}

class Conexion
{
	var $db   = "sipinna";
	var $host = "localhost";
	var $us   = "root";
	var $pw   = "";
	var $key  = '51c3b22!';
	var $dbh;

	function conectar()
	{
		$this->dbh = new SafePDO("mysql:host=" . $this->host . ";dbname=" . $this->db . "", "" . $this->us . "", "" . $this->pw . "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	function cerrarConexion()
	{
		$this->dbh = null;
	}




	function cargarImagen()
	{
		if (isset($_FILES['imagen_usuario'])) {
			$extension = explode('.', $_FILES["imagen_usuario"]['name']);
			$nombre = rand() . '.' . $extension[1];
			$ubicacion = "../usuario/imgUser/" . $nombre;
			move_uploaded_file($_FILES["imagen_usuario"]['tmp_name'], $ubicacion);
			return $nombre;
		}
	}

	function nombre_img($id_user)
	{
		//include "../../config/class.pdo.php";
		$stmt = $this->dbh->prepare("SELECT imagen FROM usuarios WHERE id ='$id_user'");
		$stmt->execute();
		$resultado = $stmt->fetchAll();
		foreach ($resultado as $fila) {
			return $fila["imagen"];
		}
	}

	function contarDatos(){
		$stmt = $this->dbh->prepare("SELECT * FROM usuarios WHERE estado = 1 ");
		$stmt->execute();
		$resultado = $stmt->fetchAll();
		return $stmt->rowCount();
	}
	function retornaDatosUsuario($id){}

}
