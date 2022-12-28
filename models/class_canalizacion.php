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
	public function lista_canalizaciones()
	{

		$sql = $this->dbh->prepare("
									SELECT	id_canalizacion,
											can_numero,
											can_numero_oficio,
											date_format(can_fecha,'%d-%m-%Y') as can_fecha,
											activo,
											can_estado,
											can_municipio,
											can_mun_edo,
											can_via_rec,
											can_folio_expediente,
											anio,estatus_expediente,
											can_folio,
											tbl_can_expediente.can_estado,
											tbl_can_expediente.can_municipio,
											cat_estados.estado,
											cat_municipios.municipio
									FROM 	((tbl_can_expediente
							INNER 	JOIN 	cat_estados 
									ON 		tbl_can_expediente.can_estado = cat_estados.id_estado )
							LEFT 	JOIN 	cat_municipios
									ON 		tbl_can_expediente.can_municipio = cat_municipios.id_municipio)
									WHERE 	activo = ?
									");

		$sql->execute(array(1));
		$row = $sql->fetchAll();
		return $row;
	}

	//Generar
	public function gen_folio_can($tabla, $id)
	{
		$sql = $this->dbh->prepare("select max(" . $id . ")+1 as fol from " . $tabla . " where anio = ? ;");
		$sql->execute(array(date('Y')));

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}
	public function obtener_folio($tabla, $id)
	{
		$sql = $this->dbh->prepare("select max(" . $id . ") as fol from " . $tabla . " where anio = ? ;");
		$sql->execute(array(date('Y')));

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}

	//Registrar Canalizacion
	public function insertar_canalizacion($nom_archivo_can, $can_num_oficio, $can_folio, $can_numero, $can_fecha, $can_pais, $can_estado, $can_municipio, $can_mun_edo, $can_via_rec, $nombre_creador)
	{
		try {

			$id = $this->gen_folio_can('tbl_can_expediente', 'id_canalizacion');
			$can_folio_expediente = 'SE/OAyA/' . $id . '/' . date('Y');
			$anio  = date('Y');
			$conn = $this->dbh;
			$conn->beginTransaction();

			$sql   = $conn->prepare("insert into tbl_can_expediente 
			(can_numero_oficio,can_folio,can_numero,can_fecha,can_pais,can_estado,can_municipio,can_mun_edo,can_via_rec,
			can_ruta_sol_oficio,can_folio_expediente,anio,can_created_by) 
			values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
			$sql->bindParam(13, $nombre_creador, PDO::PARAM_STR, 50);

			if ($sql->execute()) {
				$conn->commit();
				$estatus = 'ok';
			} else {
				$conn->rollback();
				$estatus = 'error_registro';
			}
		} catch (PDOException $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_canalizacion($id, $can_via_rec, $can_numero, $can_folio, $can_pais, $can_numero_oficio, $can_fecha, $can_estado, $can_municipio, $can_mun_edo)
	{
		$sql = $this->dbh->prepare("update tbl_can_expediente set can_via_rec=?, can_numero=?,can_folio=?,can_pais=? ,can_numero_oficio = ?, can_fecha = ?, can_estado = ? ,can_municipio=? ,can_mun_edo =? where id_canalizacion = ?");
		if ($sql->execute(array($can_via_rec, $can_numero, $can_folio, $can_pais, $can_numero_oficio, $can_fecha, $can_estado, $can_municipio, $can_mun_edo, $id))) {
			return 'ok';
		} else
			return 'error';
	}
	public function obtener_canalizacion($id)
	{

		$sql = $this->dbh->prepare("
		select id_canalizacion,can_numero,can_numero_oficio,
		can_fecha,can_pais,can_ruta_sol_oficio,
		can_estado,can_municipio,can_mun_edo,can_via_rec,
		can_folio_expediente,can_folio,can_ruta_sol_oficio,
		tbl_can_expediente.can_estado,tbl_can_expediente.can_municipio,cat_estados.estado,cat_municipios.municipio
		from ((tbl_can_expediente 
		INNER JOIN cat_estados ON tbl_can_expediente.can_estado = cat_estados.id_estado)
		LEFT JOIN cat_municipios ON tbl_can_expediente.can_municipio = cat_municipios.id_municipio)
		where id_canalizacion=?
		");

		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	public function eliminar_canalizacion($id,$desc_elimina)
	{
		$sql = $this->dbh->prepare("update tbl_can_expediente set activo = ?,descripcion_elimina=? where id_canalizacion = ?");
		if ($sql->execute(array(0, $desc_elimina,$id))) {

			return 'ok';
		} else
			return 'error';
	}
	//Registrar Caso
	public function obtener_caso_reportado($folio_exp)
	{
		$sql = $this->dbh->prepare(
			"select id_caso_reportado,can_des_caso,can_gest_caso,exp_id_caso_reportado,estatus_caso,ins_con_hechos
			 from tbl_can_casos_reportados where exp_id_caso_reportado = ?"
		);

		$sql->execute(array($folio_exp));
		$row = $sql->fetchAll();
		return $row;
	}
	public function insertar_caso_reportado($can_des_suncita_rep, $can_ges_reporte, $ins_con_hechos, $nombre_creador)
	{

		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$id_expediente = $id;
			$exp_id_caso_reportado = 'SE/OAyA/' . $id . '/' . date('Y');
			$conn = $this->dbh;
			$conn->beginTransaction();
			$sql   = $conn->prepare("insert into tbl_can_casos_reportados (exp_id_caso_reportado,can_des_caso,can_gest_caso,ins_con_hechos,expediente_id_caso,can_created_by)
			 values (?,?,?,?,?,?)");
			$sql->bindParam(1, $exp_id_caso_reportado, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_des_suncita_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $can_ges_reporte, PDO::PARAM_STR);
			$sql->bindParam(4, $ins_con_hechos, PDO::PARAM_STR);
			$sql->bindParam(5, $id_expediente, PDO::PARAM_STR, 50);
			$sql->bindParam(6, $nombre_creador, PDO::PARAM_STR, 50);


			if ($sql->execute()) {
				$conn->commit();
				$estatus = 'ok';
			} else {
				$conn->rollback();
				$estatus = 'error_registro';
			}
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_caso_reportado($id, $can_des_suncita_rep, $can_ges_reporte, $ins_con_hechos, $nombre_creador)
	{
		try {
			$sql = $this->dbh->prepare("update tbl_can_casos_reportados set can_des_caso=?,can_gest_caso=?,ins_con_hechos=?, can_update_by=? where id_caso_reportado = ?");
			$sql->bindParam(1, $can_des_suncita_rep, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_ges_reporte, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $ins_con_hechos, PDO::PARAM_STR, 30);
			$sql->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
			$sql->bindParam(5, $id);


			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	//Solicitante
	public function obtener_dato_solicitante($folio_exp)
	{
		$sql = $this->dbh->prepare(
			"select id_solicitate,can_inst_solicitante,can_nom_solicitante,exp_id_solicitante
			 from tbl_can_solicitante where exp_id_solicitante = ?"
		);

		$sql->execute(array($folio_exp));
		$row = $sql->fetchAll();
		return $row;
	}
	public function insertar_solicitante($can_inst_sol, $can_nom_sol, $nombre_creador)
	{
		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$exp_id_solicitante = 'SE/OAyA/' . $id . '/' . date('Y');
			$id_caso_solicitante = $id;
			$sql   = $this->dbh->prepare("INSERT iNTO 	tbl_can_solicitante
														(exp_id_solicitante,
														can_inst_solicitante,
														can_nom_solicitante,
														caso_id_solicitante,
														can_created_by)
			 									VALUES	(?,?,?,?,?)");
			$sql->bindParam(1, $exp_id_solicitante, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_inst_sol, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $can_nom_sol, PDO::PARAM_STR);
			$sql->bindParam(4, $id_caso_solicitante, PDO::PARAM_STR, 50);
			$sql->bindParam(5, $nombre_creador, PDO::PARAM_STR, 50);

			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro solicitante';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_solicitante($id, $can_inst_sol, $can_nom_sol)
	{
		try {
			$sql = $this->dbh->prepare("UPDATE 	tbl_can_solicitante
										 SET 	can_inst_solicitante=?,
												can_nom_solicitante=?
										WHERE 	id_solicitate =?");
			$sql->bindParam(1, $can_inst_sol, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $can_nom_sol, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $id);

			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function lista_solicitantes()
	{
		$sql = $this->dbh->prepare(
			"select id_solicitate,can_inst_solicitante,can_nom_solicitante,exp_id_solicitante
			 from tbl_can_solicitante where exp_id_solicitante = ?"
		);
		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	


	//insertar reportante
	public function insertar_reportante($nombre_creador)
	{
		try {
			$cok            = 0;
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$exp_id_caso_reportado = 'SE/OAyA/' . $id . '/' . date('Y');
			$id_caso = $id;
			foreach ($_SESSION['reportante'] as $row) {
				$sql   = $this->dbh->prepare("insert into tbl_can_reportante (exp_id_reportante,can_inst_reportante,can_nom_reportante,can_created_by,caso_id_reportante)
				values (?,?,?,?,?)");
				if ($sql->execute(array($exp_id_caso_reportado, $row["institucion"], $row["reportante"], $nombre_creador, $id_caso))) {
					$cok++;
					$estatus = 'ok';
				} else {
					$estatus = 'error_registro';
				}
			}
		} catch (Exception $e) {
			$estatus = $e;
		}
		return $estatus;
	}
	public function editar_reportante($id, $can_inst_rep, $can_nom_rep, $nombre_creador)
	{
		$sql = $this->dbh->prepare("UPDATE 	tbl_can_reportante
									 SET 	can_inst_reportante=?,
									 		can_nom_reportante=?,
											 can_update_by=?
									WHERE	id_reportante= ?");
		if ($sql->execute(array($can_inst_rep, $can_nom_rep, $nombre_creador, $id))) {
			return 'ok';
		} else
			return 'error';
	}
	public function lista_reportantes($folio_exp)
	{
		$sql = $this->dbh->prepare("
										SELECT	expediente_id_caso,
												id_reportante,
												can_inst_reportante,
												can_nom_reportante,
												exp_id_reportante,
												caso_id_reportante,
												tbl_can_casos_reportados.expediente_id_caso,
												tbl_can_reportante.caso_id_reportante
										FROM 	(tbl_can_casos_reportados
									INNER JOIN 	tbl_can_reportante 
										ON 		tbl_can_casos_reportados.expediente_id_caso = tbl_can_reportante.caso_id_reportante)
										WHERE	exp_id_reportante = ?
									");
		$sql->execute(array($folio_exp));
		$row = $sql->fetchAll();
		return $row;
	}
	public function obtener_dato_reportante($id)
	{
		$sql = $this->dbh->prepare(
			"SELECT 		id_reportante,
												can_inst_reportante,
												can_nom_reportante
									FROM 		tbl_can_reportante 
									WHERE 		id_reportante = ?"
		);

		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}

	//insertar Victima
	public function insertar_victima_can($nombre_creador)
	{
		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$can_exp_folio_victima = 'SE/OAyA/' . $id . '/' . date('Y');
			$id_caso_reportado_victima = $id;
			$conn = $this->dbh;
			$conn->beginTransaction();

			foreach ($_SESSION['victima'] as $row) {

				$sql   = $conn->prepare("INSERT into tbl_can_victimas 
												(	can_edad_vic,
													can_nom_vic,
													can_per_tercera_edad,
													can_per_violencia,
													can_per_discapacidad,
													can_per_indigena,
													can_per_transgenero,
													can_sexo_victima,
													can_exp_folio_victima,
													can_created_by,
													id_caso_reportando_victima
													)
											values (?,?,?,?,?,?,?,?,?,?,?)");
				$sql->bindParam(1, $row["can_edad_vic"], PDO::PARAM_STR, 30);
				$sql->bindParam(2, $row["can_nom_vic"], PDO::PARAM_STR, 50);
				$sql->bindParam(3, $row["can_per_tercera_edad"], PDO::PARAM_INT, 2);
				$sql->bindParam(4, $row["can_per_violencia"], PDO::PARAM_INT, 2);
				$sql->bindParam(5, $row["can_per_discapacidad"], PDO::PARAM_INT, 2);
				$sql->bindParam(6, $row["can_per_indigena"], PDO::PARAM_INT, 2);
				$sql->bindParam(7, $row["can_per_transgenero"], PDO::PARAM_INT, 2);
				$sql->bindParam(8, $row["can_sexo_victima"], PDO::PARAM_STR, 11);
				$sql->bindParam(9, $can_exp_folio_victima, PDO::PARAM_STR, 50);
				$sql->bindParam(10, $nombre_creador, PDO::PARAM_STR, 50);
				$sql->bindParam(11, $id_caso_reportado_victima, PDO::PARAM_STR, 50);


				$sql->execute();
				if ($last = $conn->lastInsertId() > 0) {
				} else {
					$conn->rollback();
					$estatus = 'Error al registrar victima';
					break;
				}

				$last_id = $conn->lastInsertId();
				$sql2   = $conn->prepare("INSERT INTO 	tbl_can_delitos_victimas
														(can_exp_folio_delito,
														can_delito,
														can_id_victima,
														can_created_by)
												VALUES	(?,?,?,?)");
				$sql2->bindParam(1, $can_exp_folio_victima, PDO::PARAM_STR, 30);
				$sql2->bindParam(2, $row["can_delito"], PDO::PARAM_INT, 11);
				$sql2->bindParam(3, $last_id, PDO::PARAM_INT, 11);
				$sql2->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
				$sql2->execute();
				if ($last_2 = $conn->lastInsertId() > 0) {
				} else {
					$conn->rollback();
					$estatus = 'Error al registrar Delito';
					break;
				}

				$dero_vul =
					$sql3   = $conn->prepare("INSERT iNTO 	tbl_can_der_vul_victima
															(can_exp_folio_derecho,
															can_der_vul_vic,
															can_id_victima,
															can_created_by)
												VALUES	 	(?,?,?,?)");
				$sql3->bindParam(1, $can_exp_folio_victima, PDO::PARAM_STR, 30);
				$sql3->bindParam(2, $row["can_der_vul_vic"], PDO::PARAM_STR, 11);
				$sql3->bindParam(3, $last_id, PDO::PARAM_INT, 11);
				$sql3->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
				$sql3->execute();
				if ($last_id3 = $conn->lastInsertId() > 0) {
				} else {
					$conn->rollback();
					$estatus = 'Error al registrar Derecho';
					break;
				}
			}


			if ($last_id = $conn->lastInsertId() > 0) {
				$conn->commit();
				$estatus = 'ok';
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar victima';
			}
		} catch (PDOException $e) {

			$estatus = $e;
		}

		return $estatus;
	}


	public function editar_victima_can($id, $can_edad_vic, $can_nom_vic, $can_per_tercera_edad, $can_per_violencia, $can_per_discapacidad, $can_per_indigena, $can_per_transgenero, $can_sexo_victima, $nombre_creador)
	{
		$conn = $this->dbh;
		$conn->beginTransaction();
		$estatus = '';
		try {
			$sql = $conn->prepare("UPDATE 	tbl_can_victimas
									SET 	can_edad_vic=?,
											can_nom_vic=?,
											can_per_tercera_edad=?,
											can_per_violencia=?,
											can_per_discapacidad=?,
											can_per_indigena=?,
											can_per_transgenero=?,
											can_sexo_victima=?,
											can_update_by=?
									WHERE	id_can_victima= ?");
			if ($sql->execute(array(
				$can_edad_vic,
				$can_nom_vic,
				$can_per_tercera_edad,
				$can_per_violencia,
				$can_per_discapacidad,
				$can_per_indigena,
				$can_per_transgenero,
				$can_sexo_victima,
				$nombre_creador,
				$id
			))) 
			{
				$conn->commit();
				return 'ok';
			} else
				return 'error';
		} catch (PDOException $e) {

			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_delito_victima_can($id_del_victima, $delito, $nombre_creador)
	{
		$conn = $this->dbh;
		$conn->beginTransaction();
		$estatus2 = '';
		try {
			$sql = $conn->prepare("UPDATE 	tbl_can_delitos_victimas
									SET 	can_delito=?,
											can_update_by=?
									WHERE	id_del_victima= ?");
			if ($sql->execute(array(
				$delito,
				$nombre_creador,
				$id_del_victima
			))) 
			{
				$conn->commit();
				return 'ok';
			} else
				return 'error';
		} catch (PDOException $e) {

			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_derecho_victima_can($id_der_victima, $derecho, $nombre_creador)
	{
		$conn = $this->dbh;
		$conn->beginTransaction();
		$estatus2 = '';
		try {
			$sql = $conn->prepare("UPDATE 	tbl_can_der_vul_victima
									SET 	can_der_vul_vic=?,
											can_update_by=?
									WHERE	id_derecho= ?");
			if ($sql->execute(array(
				$derecho,
				$nombre_creador,
				$id_der_victima
			))) 
			{
				$conn->commit();
				return 'ok';
			} else
				return 'error';
		} catch (PDOException $e) {

			$estatus = $e;
		}

		return $estatus;
	}
	public function obtener_dato_victima_edit($id)
	{
		$sql = $this->dbh->prepare("SELECT 
											id_can_victima,
											can_edad_vic,
											can_nom_vic,
											can_per_tercera_edad,
											can_per_violencia,
											can_per_discapacidad,
											can_per_indigena,
											can_per_transgenero,
											can_sexo_victima,
											can_der_vul_vic,
											can_delito,
											id_del_victima,
											id_derecho,
											can_exp_folio_victima,
											tbl_can_victimas.id_can_victima,
											tbl_can_delitos_victimas.can_id_victima,
											tbl_can_der_vul_victima.can_id_victima
									FROM 	((tbl_can_victimas
								INNER JOIN 	tbl_can_delitos_victimas 
									ON 		tbl_can_victimas.id_can_victima = tbl_can_delitos_victimas.can_id_victima)
								INNER JOIN 	tbl_can_der_vul_victima
									ON 		tbl_can_victimas.id_can_victima = tbl_can_der_vul_victima.can_id_victima)
									WHERE	id_can_victima =?
									");

		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	public function lista_victimas($folio_exp)
	{
		$sql = $this->dbh->prepare("
										SELECT	id_can_victima,
												can_edad_vic,
												can_nom_vic,
												can_per_tercera_edad,
												can_per_violencia,
												can_per_discapacidad,
												can_per_indigena,
												can_per_transgenero,
												can_sexo_victima,
												can_exp_folio_victima,
												can_der_vul_vic,
												can_delito,
												tbl_can_victimas.id_can_victima,
												tbl_can_delitos_victimas.can_id_victima
										FROM 	((tbl_can_victimas
									INNER JOIN 	tbl_can_delitos_victimas 
										ON 		tbl_can_victimas.id_can_victima = tbl_can_delitos_victimas.can_id_victima)
									INNER JOIN 	tbl_can_der_vul_victima
										ON 		tbl_can_victimas.id_can_victima = tbl_can_der_vul_victima.can_id_victima)
										WHERE	can_exp_folio_victima =?
									");
		$sql->execute(array($folio_exp));
		$row = $sql->fetchAll();
		return $row;
	}

	//Avances
	public function insertar_avance($can_tipo_avance, $can_fecha_avance, $can_estatus_avance, $can_desc_avance)
	{

		try {
			$id = $this->obtener_folio('tbl_can_expediente', 'id_canalizacion');
			$can_exp_folio_avance = 'SE/OAyA/' . $id . '/' . date('Y');
			$sql   = $this->dbh->prepare("insert into tbl_can_avances (can_tipo_avance,can_fecha_avance,can_estatus_avance,can_desc_avance,can_exp_folio_avance) values (?,?,?,?,?)");
			$sql->bindParam(1, $can_tipo_avance, PDO::PARAM_STR);
			$sql->bindParam(2, $can_fecha_avance, PDO::PARAM_STR);
			$sql->bindParam(3, $can_estatus_avance, PDO::PARAM_STR);
			$sql->bindParam(4, $can_desc_avance, PDO::PARAM_STR);
			$sql->bindParam(5, $can_exp_folio_avance, PDO::PARAM_STR);



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
		if ($sql->execute(array($id, $can_tipo_avance, $can_fecha_avance, $can_estatus_avance, $can_desc_avance))) {
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
	public function fn_lista_derechos()
	{
		$sql = $this->dbh->prepare("select id_derecho, derecho FROM cat_derechos_vulnerados GROUP BY id_derecho");
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
