<?php
require_once('../config/class.pdo.php');

class Catalogos extends Conexion
{
    public $v;
    //Objeto principal del constructor de la clase
    public function __construct()
    {
        $this->conectar();
        $key = $this->key;
    }
    public function lista_delitos()
    {

        $sql = $this->dbh->prepare("select id_delito,delito from cat_tipos_delitos");
        $sql->execute(array());
        $row = $sql->fetchAll();
        return $row;
    }
    public function insertar_delito($delito)
    {
        $sql = $this->dbh->prepare("insert into cat_tipos_delitos(delito) VALUES(?)");
        if ($sql->execute(array($delito))) {
            return 'ok';
        } else
            return 'error';
    }
   
    public function eliminar_delito($id_delito)
    {
        $sql = $this->dbh->prepare("delete from cat_tipos_delitos where id_delito = ?");
        if ($sql->execute(array($id_delito))) {
            return 'ok';
        } else
            return 'error';
    }
    public function editar_delito($id, $delito)
	{
		$sql = $this->dbh->prepare("update cat_tipos_delitos set delito = ? where id_delito = ?");
		if ($sql->execute(array($delito,$id))) {
			return 'ok';
		} else
			return 'error';
	}
    public function obtener_delito($id)
    {
        $sql = $this->dbh->prepare("select id_delito, delito from cat_tipos_delitos where id_delito = ?");
        $sql->execute(array($id));
        $row = $sql->fetchAll();
        return $row;
    }
    ///parentesco
    public function insertar_parentesco($parentesco)
    {
        $sql = $this->dbh->prepare("insert into cat_tipos_parentescos (parentesco) VALUES(?)");
        if ($sql->execute(array($parentesco))) {
            return 'ok';
        } else
            return 'error';
    }
    public function editar_parentesco($id, $parentesco)
	{
		$sql = $this->dbh->prepare("update cat_tipos_parentescos set parentesco = ? where id_parentesco = ?");
		if ($sql->execute(array($parentesco, $id))) {
			return 'ok';
		} else
			return 'error';
	}
    public function lista_parentescos()
	{
		$sql = $this->dbh->prepare("select id_parentesco, parentesco from cat_tipos_parentescos ");
		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
    public function eliminar_parentesco($id)
	{
		$sql = $this->dbh->prepare("delete from cat_tipos_parentescos  where id_parentesco = ?");
		if ($sql->execute(array($id))) {
			return 'ok';
		} else
			return 'error';
	}
    public function obtener_parentesco($id)
	{
		$sql = $this->dbh->prepare("select id_parentesco, parentesco from cat_tipos_parentescos where id_parentesco = ?");
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}

     ///Municipio
     public function insertar_municipio($municipio)
    {
        $sql = $this->dbh->prepare("insert into cat_municipios (municipio) VALUES(?)");
        if ($sql->execute(array($municipio))) {
            return 'ok';
        } else
            return 'error';
    }
    public function editar_municipio($id, $municipio)
	{
		$sql = $this->dbh->prepare("update cat_municipios set municipio = ? where id_municipio = ?");
		if ($sql->execute(array($municipio, $id))) {
			return 'ok';
		} else
			return 'error';
	}
    public function lista_municipios()
	{
		$sql = $this->dbh->prepare("select id_municipio, municipio from cat_municipios ");
		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
    public function eliminar_municipio($id)
	{
		$sql = $this->dbh->prepare("delete from cat_municipios  where id_municipio = ?");
		if ($sql->execute(array($id))) {
			return 'ok';
		} else
			return 'error';
	}
    public function obtener_municipio($id)
	{
		$sql = $this->dbh->prepare("select id_municipio, municipio from cat_municipios where id_municipio = ?");
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}

}
