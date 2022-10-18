<?php
date_default_timezone_set("America/Mexico_City"); 

class SafePDO extends PDO
{
	public static function exception_handler($exception) 
	{	
		die("Uncaught exception: ".$exception->getMessage());
	}
	public function __construct($dsn, $username='', $password='', $driver_options=array()) 
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
		$this->dbh = new SafePDO("mysql:host=".$this->host.";dbname=".$this->db."", "".$this->us."", "".$this->pw."",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	
	function cerrarConexion()
	{
		$this->dbh = null;
	}
}
?>