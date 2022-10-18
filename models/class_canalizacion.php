<?php
require_once('../config/class.pdo.php');
class Canalizacion extends Conexion
{
    public $v;
	//Objeto principal del constructor de la clase
	public function __construct()
	{
		$this->conectar();
	}
	public function insertar_canalizacion($can_no_oficio,$can_fecha_inicio,$can_via_rec,$can_estado,$can_municipio)
	{
		$sql = $this->dbh->prepare("insert into tbl_can_expediente (can_no_oficio,can_fecha_inicio,can_via_rec,can_estado,can_municipio) VALUES(?,?,?,?,?)");
		if ($sql->execute(array($can_no_oficio,$can_fecha_inicio,$can_via_rec, $can_estado,$can_municipio))) {
			return 'ok';
		} else
			return 'error';
	}

	public function editar_canalizacion($id, $can_no_oficio, $can_fecha_inicio,$can_estado,$can_municipio)
	{
		$sql = $this->dbh->prepare("update tbl_can_expediente set can_no_oficio = ?, can_fecha_inicio = ?, can_estado = ? ,can_mun=? where id = ?");
		if ($sql->execute(array($can_no_oficio, $can_fecha_inicio,$can_estado,$can_municipio, $id))) {
			return 'ok';
		} else
			return 'error';
	}

	public function lista_canalizaciones()
	{
		$sql = $this->dbh->prepare("select id_can_exp, can_no_oficio, can_via_rec ,can_fecha_inicio, can_estado, can_municipio from tbl_can_expediente");
		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	
    public function eliminar_canalizacion($id_can_exp)
    {
        $sql = $this->dbh->prepare("delete from tbl_can_expediente where id_can_exp = ?");
        if ($sql->execute(array($id_can_exp))) {
            return 'ok';
        } else
            return 'error';
    }
	//catalogos
    public function fn_lista_municipios()
	{
		$sql = $this->dbh->prepare("select id_municipio, municipio FROM cat_municipios GROUP BY id_municipio");
		$sql->execute();
		$row = $sql->fetchAll();
		return $row;
	}
	public function fn_lista_estados()
	{
		$sql = $this->dbh->prepare("select id_estado, estado FROM cat_estados GROUP BY id_estado");
		$sql->execute();
		$row = $sql->fetchAll();
		return $row;
	}
    public function fn_lista_delitos()
	{
		$sql = $this->dbh->prepare("select id_delito, delito FROM cat_tipos_delitos GROUP BY id_delito");
		$sql->execute();
		$row = $sql->fetchAll();
		return $row;
	}



}