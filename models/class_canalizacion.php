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
	public function crear_expediente()
	{
	}
	public function insertar_canalizacion($can_no_oficio, $can_fecha_inicio, $can_estado, $can_municipio, $can_mun_edo)
	{
		$sql = $this->dbh->prepare("insert into tbl_can_expedientes(can_no_oficio,can_fecha_inicio,can_estado,can_municipio,can_mun_edo) VALUES(?,?,?,?,?)");
		$sql->bindParam(1, $can_no_oficio, PDO::PARAM_STR, 30);
		$sql->bindParam(2, $can_fecha_inicio, PDO::PARAM_STR);
		$sql->bindParam(3, $can_estado, PDO::PARAM_STR);
		$sql->bindParam(4, $can_municipio, PDO::PARAM_STR);
		$sql->bindParam(5, $can_mun_edo, PDO::PARAM_STR);

		if ($sql->execute()) {
			return 'ok';
		} else
			return 'error';
	}

	public function editar_canalizacion($id, $can_no_oficio, $can_fecha_inicio, $can_estado, $can_municipio)
	{
		$sql = $this->dbh->prepare("update tbl_can_expedientes set can_no_oficio = ?, can_fecha_inicio = ?, can_estado = ? ,can_mun=? where id = ?");
		if ($sql->execute(array($can_no_oficio, $can_fecha_inicio, $can_estado, $can_municipio, $id))) {
			return 'ok';
		} else
			return 'error';
	}

	public function lista_canalizaciones()
	{
		$sql = $this->dbh->prepare("select id_can_exp, can_no_oficio,can_mun_edo,can_via_rec ,can_fecha_inicio, can_estado, can_municipio from tbl_can_expedientes");
		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	public function rel_estados()
	{

		$sql = $this->dbh->prepare("
		select id_can_exp, can_no_oficio,can_mun_edo,can_via_rec ,can_fecha_inicio,
		tbl_can_expedientes.can_estado,tbl_can_expedientes.can_municipio,cat_estados.estado,cat_municipios.municipio 
		from ((tbl_can_expedientes 
		INNER JOIN cat_estados ON tbl_can_expedientes.can_estado = cat_estados.id_estado)
		LEFT JOIN cat_municipios ON tbl_can_expedientes.can_municipio = cat_municipios.id_municipio);
		");

		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	public function fn_registrar_canalizacion($folio, $archivo, $can_fecha_inicio, $can_estado, $can_municipio,  $can_mun_edo, $can_via_rec)
	{
		try {
			$sql   = $this->dbh->prepare("insert into tbl_can_expedientes (can_no_oficio,can_ruta_sol_oficio,can_fecha_inicio,can_estado,can_municipio,can_mun_edo,can_via_rec) values (?,?,?,?,?,?,?)");
			$sql->bindParam(1, $folio, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $archivo, PDO::PARAM_STR);
			$sql->bindParam(3, $can_fecha_inicio, PDO::PARAM_STR);
			$sql->bindParam(4, $can_estado, PDO::PARAM_STR);
			$sql->bindParam(5, $can_municipio, PDO::PARAM_STR);
			$sql->bindParam(6, $can_mun_edo, PDO::PARAM_STR, 15);
			$sql->bindParam(7, $can_via_rec, PDO::PARAM_STR);

			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}

	public function eliminar_canalizacion($id_can_exp)
	{
		$sql = $this->dbh->prepare("delete from tbl_can_expedientes where id_can_exp = ?");
		if ($sql->execute(array($id_can_exp))) {
			return 'ok';
		} else
			return 'error';
	}
	public function insertar_reportante($can_nom_rep, $can_inst_rep, $can_des_suncita)
	{

		try {
			$sql   = $this->dbh->prepare("insert into tbl_can_reportantes (can_inst_reportante,can_nom_reportante,can_des_sucinta) values (?,?,?)");
			$sql->bindParam(1, $can_inst_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_nom_rep, PDO::PARAM_STR);
			$sql->bindParam(3, $can_des_suncita, PDO::PARAM_STR);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function insertar_victima($can_delito, $can_rep_der, $can_nom_vic, $can_edad_vic, $can_gen_vic, $can_per_tercera_edad, $can_per_discapacidad, $can_per_violencia)
	{
		$sql = $this->dbh->prepare("insert into tbl_can_victimas(can_delito,can_nom_victima,can_rep_derecho,can_edad_victima,can_gen_victima,can_per_tercera_edad,can_per_discapacidad,can_per_violencia) VALUES(?,?,?,?,?,?,?,?)");
		if ($sql->execute(array($can_delito, $can_rep_der, $can_nom_vic, $can_edad_vic, $can_gen_vic, $can_per_tercera_edad, $can_per_discapacidad, $can_per_violencia))) {
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
