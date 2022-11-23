<?php
require_once('../config/class.pdo.php');
class CasosC4 extends Conexion
{
	public $v;
	//Objeto principal del constructor de la clase
	public function __construct()
	{
		$this->conectar();
	}



	public function editar_canalizacion($id, $can_no_oficio, $can_fecha_inicio, $can_estado, $can_municipio)
	{
		$sql = $this->dbh->prepare("update tbl_can_expedientes set can_no_oficio = ?, can_fecha_inicio = ?, can_estado = ? ,can_mun=? where id = ?");
		if ($sql->execute(array($can_no_oficio, $can_fecha_inicio, $can_estado, $can_municipio, $id))) {
			return 'ok';
		} else
			return 'error';
	}
	public function lista_casos_c4()
	{

		$sql = $this->dbh->prepare("
		select id,c4_folio,c4_folio_expediente,c4_no_oficio,c4_mun_edo ,c4_fecha_inicio,c4_estatus_caso,
		tbl_c4_expedientes.c4_edo,tbl_c4_expedientes.c4_mun,cat_estados.estado,cat_municipios.municipio 
		from ((tbl_c4_expedientes 
		INNER JOIN cat_estados ON tbl_c4_expedientes.c4_edo = cat_estados.id_estado)
		LEFT JOIN cat_municipios ON tbl_c4_expedientes.c4_mun = cat_municipios.id_municipio);
		");

		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	public function obtener_caso_c4($id)
	{
		$sql = $this->dbh->prepare("select id,c4_folio,c4_no_oficio,c4_ruta_sol_oficio,c4_fecha_inicio,
		c4_edo,c4_mun,c4_mun_edo,c4_dirigido,c4_dg,c4_folio_expediente,c4_estatus_caso from tbl_c4_expedientes where id = ?");
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	//Generar
	public function gen_folio($tabla, $id)
	{
		$sql = $this->dbh->prepare("select max(".$id.")+1 as fol from ".$tabla." where anio = ? ;");
		$sql->execute(array(date('Y')));

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}
	public function obtener_folio($tabla, $id)
	{
		$sql = $this->dbh->prepare("select max(".$id.") as fol from ".$tabla." where anio = ? ;");
		$sql->execute(array(date('Y')));

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}
	//Registrar Caso Expediente
	public function fn_registrar_caso_c4($c4_folio,$c4_no_oficio,$archivo,$c4_fecha_inicio,$c4_edo,$c4_mun,$c4_mun_edo,$c4_dirigido,$c4_dg)
	{
		try {

			$id = $this->gen_folio('tbl_c4_expedientes', 'id');
			$c4_folio_expediente ='C4/DG/'.$id.'/'.date('Y');
			$anio  = date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_c4_expedientes 
			(c4_folio,c4_no_oficio,c4_ruta_sol_oficio,c4_fecha_inicio,c4_edo,c4_mun,c4_mun_edo,c4_dirigido,c4_dg,c4_folio_expediente,anio) 
			values (?,?,?,?,?,?,?,?,?,?,?)");
			$sql->bindParam(1, $c4_folio, PDO::PARAM_STR);
			$sql->bindParam(2, $c4_no_oficio, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $archivo, PDO::PARAM_STR);
			$sql->bindParam(4, $c4_fecha_inicio, PDO::PARAM_STR);
			$sql->bindParam(5, $c4_edo, PDO::PARAM_STR);
			$sql->bindParam(6, $c4_mun, PDO::PARAM_STR);
			$sql->bindParam(7, $c4_mun_edo, PDO::PARAM_STR, 15);
			$sql->bindParam(8, $c4_dirigido, PDO::PARAM_STR, 30);
			$sql->bindParam(9, $c4_dg, PDO::PARAM_STR, 30);
			$sql->bindParam(10, $c4_folio_expediente, PDO::PARAM_STR);
			$sql->bindParam(11, $anio, PDO::PARAM_STR, 30);

			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}

	public function eliminar_caso_c4($id)
	{
		$sql = $this->dbh->prepare("delete from tbl_c4_expedientes where id = ?");
		if ($sql->execute(array($id))) {
			return 'ok';
		} else
			return 'error';
	}

	//insertar reportante
	public function insertar_reportante_c4($c4_nom_rep, $c4_inst_rep)
	{

		try {
			$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
			$c4_exp_folio_rep ='C4/DG/'.$id.'/'.date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_c4_reportantes (c4_exp_folio_rep,c4_inst_reportante,c4_nom_reportante) values (?,?,?)");
			$sql->bindParam(1, $c4_exp_folio_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $c4_inst_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $c4_nom_rep, PDO::PARAM_STR);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	//insertar Probable Responsable
	public function insertar_prob_respo_c4($c4_nom_responsable, $c4_edad_responsable,$c4_parentesco)
	{

		try {
			$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
			$c4_exp_folio_resp ='C4/DG/'.$id.'/'.date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_c4_probable_responsable 
			(c4_nom_responsable,c4_edad_responsable,c4_parentesco,c4_exp_folio_resp) 
			values (?,?,?,?)");
			$sql->bindParam(1, $c4_edad_responsable, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $c4_nom_responsable, PDO::PARAM_STR);
			$sql->bindParam(3, $c4_parentesco, PDO::PARAM_STR);
			$sql->bindParam(4, $c4_exp_folio_resp, PDO::PARAM_STR, 30);




			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	//Insertar Descripcion de caso
	public function insertar_desc_caso_c4($c4_lugar_hechos, $c4_des_hechos)
	{

		try {
			$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
			$c4_exp_folio_desc_caso ='C4/DG/'.$id.'/'.date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_desc_casos_c4(c4_lugar_hechos,c4_des_hechos,c4_exp_folio_desc_caso) values (?,?,?)");
			$sql->bindParam(1, $c4_lugar_hechos, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $c4_des_hechos, PDO::PARAM_STR);
			$sql->bindParam(3, $c4_exp_folio_desc_caso, PDO::PARAM_STR);
			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	//insertar Victima
	public function insertar_victima_c4($c4_delito, $c4_rep_der, $c4_nom_vic, $c4_edad_vic, $c4_gen_vic, $c4_per_tercera_edad, $c4_per_discapacidad, $c4_per_violencia)
	{
		$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
		$c4_exp_folio_victima ='C4/DG/'.$id.'/'.date('Y');
		$sql = $this->dbh->prepare("insert into tbl_c4_victimas(c4_exp_folio_victima,c4_delito,c4_nom_victima,c4_rep_derecho,c4_edad_victima,c4_gen_victima,c4_per_tercera_edad,c4_per_discapacidad,c4_per_violencia) VALUES(?,?,?,?,?,?,?,?,?)");
		if ($sql->execute(array($c4_exp_folio_victima,$c4_delito, $c4_rep_der, $c4_nom_vic, $c4_edad_vic, $c4_gen_vic, $c4_per_tercera_edad, $c4_per_discapacidad, $c4_per_violencia))) {
			return 'ok';
		} else
			return 'error';
	}

	//Avances
	public function insertar_avance($can_tipo_avance, $can_fecha_avance, $can_estatus_avance, $can_desc_avance)
	{

		try {
			$sql   = $this->dbh->prepare("insert into tbl_can_avances (can_tipo_avance,can_fecha_avance,can_estatus_avance,can_desc_avance) values (?,?,?,?)");
			$sql->bindParam(1, $can_tipo_avance, PDO::PARAM_STR);
			$sql->bindParam(2, $can_fecha_avance, PDO::PARAM_STR);
			$sql->bindParam(3, $can_estatus_avance, PDO::PARAM_STR);
			$sql->bindParam(4, $can_desc_avance, PDO::PARAM_STR);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function lista_avances()
	{

		$sql = $this->dbh->prepare("
		select id_can_avance,can_tipo_avance,can_fecha_avance,can_estatus_avance,can_desc_avance from tbl_can_avances
		");

		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	public function obtener_avance($id)
	{
		$sql = $this->dbh->prepare("select id_can_avance,can_tipo_avance,can_fecha_avance,can_estatus_avance,can_des_avance  from tbl_can_avances where id_can_avance = ?");
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	public function eliminar_avance($id_can_avance)
	{
		$sql = $this->dbh->prepare("delete from tbl_can_avances where id_can_avance = ?");
		if ($sql->execute(array($id_can_avance))) {
			return 'ok';
		} else
			return 'error';
	}
	public function editar_avance($id, $can_tipo_avance, $can_fecha_avance, $can_estatus_avance, $can_des_avance)
	{
		$sql = $this->dbh->prepare("update tbl_can_avances set id_can_avance= ?, can_tipo_avance = ?, can_fecha_avance = ?, can_estatus_avance = ? ,can_desc_avance=? where id_can_avance = ?");
		if ($sql->execute(array($can_tipo_avance, $can_fecha_avance, $can_estatus_avance, $can_des_avance, $id))) {
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
	public function fn_lista_parentescos()
	{
		$sql = $this->dbh->prepare("select id_parentesco, parentesco FROM cat_parentescos GROUP BY id_parentesco");
		$sql->execute();
		$row = $sql->fetchAll();
		return $row;
	}
}
