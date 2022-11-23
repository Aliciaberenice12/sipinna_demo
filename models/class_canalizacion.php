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



	public function editar_canalizacion($id,$can_via_rec,$can_numero, $can_numero_oficio, $can_fecha, $can_estado, $can_municipio,$can_mun_edo)
	{
		$sql = $this->dbh->prepare("update tbl_can_expediente set can_via_rec=?, can_numero=?,can_numero_oficio = ?, can_fecha = ?, can_estado = ? ,can_municipio=? ,can_mun_edo =? where id_canalizacion = ?");
		if ($sql->execute(array($can_via_rec,$can_numero,$can_numero_oficio, $can_fecha, $can_estado, $can_municipio,$can_mun_edo, $id))) {
			return 'ok';
		} else
			return 'error';
	}


	public function lista_canalizaciones()
	{

		$sql = $this->dbh->prepare("
		select id_canalizacion,can_numero,can_numero_oficio,
		date_format(can_fecha,'%d-%m-%Y') as can_fecha,
		can_estado,can_municipio,can_mun_edo,can_via_rec,
		can_folio_expediente,anio,can_folio,
		tbl_can_expediente.can_estado,tbl_can_expediente.can_municipio,cat_estados.estado,cat_municipios.municipio
		from ((tbl_can_expediente 
		INNER JOIN cat_estados ON tbl_can_expediente.can_estado = cat_estados.id_estado)
		LEFT JOIN cat_municipios ON tbl_can_expediente.can_municipio = cat_municipios.id_municipio);
		");

		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	
	//Generar
	public function gen_folio_can($tabla, $id)
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
	public function insertar_canalizacion($nom_archivo_can,$can_num_oficio,$can_folio,$can_numero,$can_fecha,$can_pais,$can_estado,$can_municipio,$can_mun_edo,$can_via_rec)
	{
		try {

			$id = $this->gen_folio_can('tbl_can_expediente', 'id_canalizacion');
			$can_folio_expediente ='SE/OAyA/'.$id.'/'.date('Y');
			$anio  = date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_can_expediente 
			(can_numero_oficio,can_folio,can_numero,can_fecha,can_pais,can_estado,can_municipio,can_mun_edo,can_via_rec,
			can_ruta_sol_oficio,can_folio_expediente,anio) 
			values (?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->bindParam(1, $can_num_oficio, PDO::PARAM_STR);
			$sql->bindParam(2, $can_folio, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $can_numero, PDO::PARAM_STR);
			$sql->bindParam(4, $can_fecha, PDO::PARAM_STR, 30);
			$sql->bindParam(5, $can_pais, PDO::PARAM_STR, 30);
			$sql->bindParam(6, $can_estado, PDO::PARAM_STR, 30);
			$sql->bindParam(7, $can_municipio, PDO::PARAM_STR, 30);
			$sql->bindParam(8, $can_mun_edo, PDO::PARAM_STR);
			$sql->bindParam(9, $can_via_rec, PDO::PARAM_STR);
			$sql->bindParam(10, $nom_archivo_can, PDO::PARAM_STR);
			$sql->bindParam(11, $can_folio_expediente, PDO::PARAM_STR);
			$sql->bindParam(12, $anio, PDO::PARAM_STR, 30);

		
		
			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function obtener_canalizacion($id)
	{
		$sql = $this->dbh->prepare("select id_canalizacion,can_numero,can_folio,can_pais,can_numero_oficio,can_fecha,can_via_rec,can_estado,
		can_municipio,can_mun_edo,can_folio_expediente from tbl_can_expediente where id_canalizacion = ?"
			);
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
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
	public function insertar_reportante($can_nom_rep, $can_inst_rep)
	{

		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$exp_id_reportante ='SE/OAyA/'.$id.'/'.date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_can_reportante (exp_id_reportante,can_inst_reportante,can_nom_reportante)
			 values (?,?,?)");
			$sql->bindParam(1, $exp_id_reportante, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_nom_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $can_inst_rep, PDO::PARAM_STR);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}

	//insertar solicitante
	public function insertar_solicitante($can_inst_sol, $can_nom_sol)
	{

		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$exp_id_solicitante ='SE/OAyA/'.$id.'/'.date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_can_solicitante (exp_id_solicitante,can_inst_solicitante,can_nom_solicitante)
			 values (?,?,?)");
			$sql->bindParam(1, $exp_id_solicitante, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_inst_sol, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $can_nom_sol, PDO::PARAM_STR);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	//insertar reportante
	public function insertar_caso_reportado($can_des_suncita_rep, $can_ges_reporte,$ins_con_hechos)
	{

		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$exp_id_caso_reportado ='SE/OAyA/'.$id.'/'.date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_can_casos_reportados (exp_id_caso_reportado,can_des_caso,can_gest_caso,ins_con_hechos)
			 values (?,?,?,?)");
			$sql->bindParam(1, $exp_id_caso_reportado, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_des_suncita_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $can_ges_reporte, PDO::PARAM_STR);
			$sql->bindParam(4, $ins_con_hechos, PDO::PARAM_STR);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}

	//insertar Vctima
	public function insertar_victima_can($can_delito, $can_der_vul_vic, $can_nom_vic, $can_edad_vic, $can_sexo_victima, $can_per_tercera_edad, $can_per_discapacidad, $can_per_violencia,$can_per_indigena,$can_per_transgenero)
	{
		$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
		$can_exp_folio_victima ='SE/OAyA/'.$id.'/'.date('Y');
		$sql = $this->dbh->prepare("insert into tbl_can_victimas(can_exp_folio_victima,can_delito,can_nom_vic,can_der_vul_vic,can_edad_vic,can_sexo_victima,can_per_tercera_edad,can_per_discapacidad,can_per_violencia,can_per_indigena,can_per_transgenero) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		if ($sql->execute(array($can_exp_folio_victima,$can_delito, $can_der_vul_vic, $can_nom_vic, $can_edad_vic, $can_sexo_victima, $can_per_tercera_edad, $can_per_discapacidad, $can_per_violencia,$can_per_indigena,$can_per_transgenero))) {
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
		$sql = $this->dbh->prepare("select id_can_avance,can_tipo_avance,can_fecha_avance,can_estatus_avance,can_desc_avance  from tbl_can_avances where id_can_avance = ?");
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
	public function editar_avance($id, $can_tipo_avance, $can_fecha_avance, $can_estatus_avance, $can_desc_avance)
	{
		$sql = $this->dbh->prepare("update tbl_can_avances set id_can_avance=?, can_tipo_avance=?, can_fecha_avance=?, can_estatus_avance=? ,can_desc_avance=?, where id_can_avance= ?");
		if ($sql->execute(array($id,$can_tipo_avance,$can_fecha_avance,$can_estatus_avance,$can_desc_avance))) {
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
