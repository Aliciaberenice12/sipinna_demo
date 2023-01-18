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
	//historico
	public function gen_folio_historico($tabla, $id,$anio_folio)
	{
		$sql = $this->dbh->prepare("select max(" . $id . ")+1 as fol from " . $tabla . " where c4_anio = ? ;");
		$sql->execute(array($anio_folio));
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}
	public function fn_registrar_caso_c4_historico($nom_archivo_c4, $datos_exp_histirico,$anio_folio)
	{
		try {
			//   print_r($anio_folio);
			//   die();
			$nombre_creador = $_SESSION['nombre'];
			$id = $this->gen_folio_historico('tbl_c4_expedientes', 'id_c4_anio',$anio_folio);
			$c4_anio  = $anio_folio;
			$c4_folio_expediente = 'C4/DG/' . $anio_folio . '/' . sprintf("%04s",$id);
			
			$conn = $this->dbh;
			$conn->beginTransaction();
			$sql   = $conn->prepare("INSERT INTO 		tbl_c4_expedientes 
													(	
														c4_folio,
														c4_numero,
														c4_no_oficio,
														c4_ruta_sol_oficio,
														c4_fecha_inicio,
														c4_pais,
														c4_otros_estados,
														c4_edo,
														c4_mun,
														c4_mun_edo,
														c4_dirigido,
														c4_dg,
														c4_exp_folio,
														c4_anio,
														c4_created_by,
														id_c4_anio
													) 	
											VALUES 		(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->bindParam(1, $datos_exp_histirico['c4_folio'], PDO::PARAM_STR);
			$sql->bindParam(2, $datos_exp_histirico['c4_numero'], PDO::PARAM_STR, 30);
			$sql->bindParam(3, $datos_exp_histirico['c4_no_oficio'], PDO::PARAM_STR, 30);
			$sql->bindParam(4, $nom_archivo_c4, PDO::PARAM_STR);
			$sql->bindParam(5, $datos_exp_histirico['c4_fecha_inicio'], PDO::PARAM_STR);
			$sql->bindParam(6, $datos_exp_histirico['c4_pais'], PDO::PARAM_STR);
			$sql->bindParam(7, $datos_exp_histirico['otros_estados_c4'], PDO::PARAM_STR);
			$sql->bindParam(8, $datos_exp_histirico['c4_edo'], PDO::PARAM_STR);
			$sql->bindParam(9, $datos_exp_histirico['c4_mun'], PDO::PARAM_STR);
			$sql->bindParam(10, $datos_exp_histirico['c4_mun_edo'], PDO::PARAM_STR, 15);
			$sql->bindParam(11, $datos_exp_histirico['c4_dirigido'], PDO::PARAM_STR, 30);
			$sql->bindParam(12, $datos_exp_histirico['c4_dg'], PDO::PARAM_STR, 30);
			$sql->bindParam(13, $c4_folio_expediente, PDO::PARAM_STR);
			$sql->bindParam(14, $c4_anio);
			$sql->bindParam(15, $nombre_creador, PDO::PARAM_STR, 30);
			$sql->bindParam(16, $id, PDO::PARAM_STR, 30);

			$sql->execute();
			if ($conn->lastInsertId() > 0) {
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar Expediente';
				
			}
			$c4_exp_folio_desc_caso = $c4_folio_expediente;
			$id_caso = $anio_folio.'/'.$id;
			
			$sql2   = $conn->prepare("INSERT into 	tbl_c4_desc_casos(
														c4_lugar_hechos,
														c4_des_hechos,
														c4_observaciones,
														c4_exp_folio_desc_caso,
														c4_exp_id_caso,
														c4_created_by) 
											VALUES		(?,?,?,?,?,?)");
			$sql2->bindParam(1, $datos_exp_histirico['c4_lugar_hechos'], PDO::PARAM_STR, 30);
			$sql2->bindParam(2, $datos_exp_histirico['c4_des_hechos'], PDO::PARAM_STR);
			$sql2->bindParam(3, $datos_exp_histirico['c4_observaciones'], PDO::PARAM_STR);
			$sql2->bindParam(4, $c4_exp_folio_desc_caso, PDO::PARAM_STR);
			$sql2->bindParam(5, $id_caso, PDO::PARAM_STR);
			$sql2->bindParam(6, $nombre_creador, PDO::PARAM_STR);

			$sql2->execute();
			if ($conn->lastInsertId() > 0) {
				
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar datos del caso';
				
			}
			
			
			if (isset($_SESSION['probable_res']) and !empty($_SESSION['probable_res'])) {

				$c4_exp_folio_resp = $c4_folio_expediente;
			

				foreach ($_SESSION['probable_res'] as $row) {
					$sql4   = $conn->prepare("INSERT INTO 	tbl_c4_probable_responsable
																(c4_edad_responsable,
																c4_nom_responsable,
																c4_parentesco,
																c4_id_victima,
																c4_exp_folio_resp,
																c4_created_by)
													VALUES 		(?,?,?,?,?,?)");
					$sql4->bindParam(1, $row["c4_edad_responsable"], PDO::PARAM_STR, 30);
					$sql4->bindParam(2, $row["c4_nom_responsable"], PDO::PARAM_STR);
					$sql4->bindParam(3, $row["c4_parentesco"], PDO::PARAM_STR);
					$sql4->bindParam(4, $id_caso, PDO::PARAM_STR);
					$sql4->bindParam(5, $c4_exp_folio_resp, PDO::PARAM_STR, 30);
					$sql4->bindParam(6, $nombre_creador, PDO::PARAM_STR, 30);
					$sql4->execute();
					if ($conn->lastInsertId() > 0) {
					
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar Probable Responsable';
						break;
					}

				}
			}
			if (isset($_SESSION['victima_c4']) and !empty($_SESSION['victima_c4'])) {

				$c4_exp_folio_victima = $c4_folio_expediente;
				
		

				foreach ($_SESSION['victima_c4'] as $row) {

					$sql5   = $conn->prepare("INSERT INTO tbl_c4_victimas 
													(	
														c4_edad_victima,
														c4_edad_ms_victima,
														c4_nom_victima,
														c4_num_delitos,
														c4_per_tercera_edad,
														c4_per_violencia,
														c4_per_discapacidad,
														c4_per_indigena,
														c4_per_transgenero,
														c4_sexo_victima,
														c4_exp_folio_victima,
														c4_created_by,
														c4_id_desc_caso
														)
												values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$sql5->bindParam(1, $row["c4_edad_vic"], PDO::PARAM_STR, 30);
					$sql5->bindParam(2, $row["c4_edad_ms_vic"], PDO::PARAM_STR, 30);
					$sql5->bindParam(3, $row["c4_nom_vic"], PDO::PARAM_STR, 50);
					$sql5->bindParam(4, $row["c4_num_delitos"], PDO::PARAM_STR, 2);
					$sql5->bindParam(5, $row["c4_per_tercera_edad"], PDO::PARAM_INT, 2);
					$sql5->bindParam(6, $row["c4_per_violencia"], PDO::PARAM_INT, 2);
					$sql5->bindParam(7, $row["c4_per_discapacidad"], PDO::PARAM_INT, 2);
					$sql5->bindParam(8, $row["c4_per_indigena"], PDO::PARAM_INT, 2);
					$sql5->bindParam(9, $row["c4_per_transgenero"], PDO::PARAM_INT, 2);
					$sql5->bindParam(10, $row["c4_sexo_victima"], PDO::PARAM_STR, 11);
					$sql5->bindParam(11, $c4_exp_folio_victima, PDO::PARAM_STR, 50);
					$sql5->bindParam(12, $nombre_creador, PDO::PARAM_STR, 50);
					$sql5->bindParam(13, $id_caso, PDO::PARAM_STR, 50);
					$sql5->execute();
					if ($conn->lastInsertId() > 0) {
					
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar victima';
						break;
					}
					$last_id = $conn->lastInsertId();
					$sql6   = $conn->prepare("INSERT INTO 	tbl_c4_delitos_victimas
															(
															c4_exp_folio_delito,
															c4_delito,
															c4_id_victima,
															c4_created_by)
													VALUES	(?,?,?,?)");
					$sql6->bindParam(1, $c4_exp_folio_victima, PDO::PARAM_STR, 30);
					$sql6->bindParam(2, $row["c4_delitos"], PDO::PARAM_STR, 30);
					$sql6->bindParam(3, $last_id, PDO::PARAM_INT, 11);
					$sql6->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
					$sql6->execute();
					if ($conn->lastInsertId() > 0) {
						
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar Delito';
						break;
					}
					$sql7   = $conn->prepare("INSERT iNTO 	tbl_c4_der_vul_victima
														(
															c4_exp_folio_der_vul_vic,
															c4_der_vul_victima,
															c4_id_victima,
															c4_created_by)
													VALUES 	(?,?,?,?)");
					$sql7->bindParam(1, $c4_exp_folio_victima, PDO::PARAM_STR, 30);
					$sql7->bindParam(2, $row["c4_der_vul"], PDO::PARAM_INT, 11);
					$sql7->bindParam(3, $last_id, PDO::PARAM_INT, 11);
					$sql7->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
					$sql7->execute();
					if ($conn->lastInsertId() > 0) {
						
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar Derecho';
						break;
					}
				}
			}
			if ($last_id = $conn->lastInsertId() > 0) {
				$conn->commit();
				$estatus = 'ok expediente registrado';
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar victima';
			}
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_caso_c4_c_img( $c4_folio, $c4_numero, $c4_no_oficio, $c4_fecha_inicio, 
	$c4_pais,$otros_estados_c4, $c4_edo, $c4_mun, $c4_mun_edo, $c4_dirigido, $c4_dg,$nom_archo,$nombre_creador,$id)
	{
		$sql = $this->dbh->prepare("UPDATE 	tbl_c4_expedientes 
									SET		
										 	c4_folio=?,
											c4_numero=?,
											c4_no_oficio=?,
											c4_fecha_inicio = ?,
											c4_pais=?,
											c4_otros_estados=?,
											c4_edo = ?,
											c4_mun=?,
											c4_mun_edo=?,
											c4_dirigido=?,
											c4_dg=?,
											c4_ruta_sol_oficio=?,
											c4_update_by=?
									WHERE	id = ?");
		if ($sql->execute(array( 	$c4_folio,
									$c4_numero,
									$c4_no_oficio,
									$c4_fecha_inicio, 
									$c4_pais,
									$otros_estados_c4,
									$c4_edo,
									$c4_mun,
									$c4_mun_edo,
									$c4_dirigido,
									$c4_dg,
									$nom_archo,
									$nombre_creador,
									$id
								)
							)
							)
		{
			return 'editado';
		} else
			return 'error';
	}
	//historico
	//Registrar Caso Expediente
	public function fn_registrar_caso_c4($nom_archivo_c4, $datos_exp_c4)
	{
		try {
			//  print_r($datos_exp_c4);
			//  die();
			$nombre_creador = $_SESSION['nombre'];
			$id = $this->gen_folio('tbl_c4_expedientes', 'id');
			$c4_folio_expediente = 'C4/DG/' . $id . '/' . date('Y');
			$c4_anio  = date('Y');
			$conn = $this->dbh;
			$conn->beginTransaction();
			$sql   = $conn->prepare("INSERT INTO 		tbl_c4_expedientes 
													(	
														c4_folio,
														c4_numero,
														c4_no_oficio,
														c4_ruta_sol_oficio,
														c4_fecha_inicio,
														c4_pais,
														c4_otros_estados,
														c4_edo,
														c4_mun,
														c4_mun_edo,
														c4_dirigido,
														c4_dg,
														c4_exp_folio,
														c4_anio,
														c4_created_by
													) 	
											VALUES 		(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->bindParam(1, $datos_exp_c4['c4_folio'], PDO::PARAM_STR);
			$sql->bindParam(2, $datos_exp_c4['c4_numero'], PDO::PARAM_STR, 30);
			$sql->bindParam(3, $datos_exp_c4['c4_no_oficio'], PDO::PARAM_STR, 30);
			$sql->bindParam(4, $nom_archivo_c4, PDO::PARAM_STR);
			$sql->bindParam(5, $datos_exp_c4['c4_fecha_inicio'], PDO::PARAM_STR);
			$sql->bindParam(6, $datos_exp_c4['c4_pais'], PDO::PARAM_STR);
			$sql->bindParam(7, $datos_exp_c4['otros_estados_c4'], PDO::PARAM_STR);
			$sql->bindParam(8, $datos_exp_c4['c4_edo'], PDO::PARAM_STR);
			$sql->bindParam(9, $datos_exp_c4['c4_mun'], PDO::PARAM_STR);
			$sql->bindParam(10, $datos_exp_c4['c4_mun_edo'], PDO::PARAM_STR, 15);
			$sql->bindParam(11, $datos_exp_c4['c4_dirigido'], PDO::PARAM_STR, 30);
			$sql->bindParam(12, $datos_exp_c4['c4_dg'], PDO::PARAM_STR, 30);
			$sql->bindParam(13, $c4_folio_expediente, PDO::PARAM_STR);
			$sql->bindParam(14, $c4_anio);
			$sql->bindParam(15, $nombre_creador, PDO::PARAM_STR, 30);
			$sql->execute();
			if ($conn->lastInsertId() > 0) {
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar Expediente';
				
			}
			$c4_exp_folio_desc_caso = 'C4/DG/' . $id . '/' . date('Y');
			$id_caso = $id;
			$sql2   = $conn->prepare("INSERT into 	tbl_c4_desc_casos(
														c4_lugar_hechos,
														c4_des_hechos,
														c4_observaciones,
														c4_exp_folio_desc_caso,
														c4_exp_id_caso,
														c4_created_by) 
											VALUES		(?,?,?,?,?,?)");
			$sql2->bindParam(1, $datos_exp_c4['c4_lugar_hechos'], PDO::PARAM_STR, 30);
			$sql2->bindParam(2, $datos_exp_c4['c4_des_hechos'], PDO::PARAM_STR);
			$sql2->bindParam(3, $datos_exp_c4['c4_observaciones'], PDO::PARAM_STR);
			$sql2->bindParam(4, $c4_exp_folio_desc_caso, PDO::PARAM_STR);
			$sql2->bindParam(5, $id_caso, PDO::PARAM_STR);
			$sql2->bindParam(6, $nombre_creador, PDO::PARAM_STR);

			$sql2->execute();
			if ($conn->lastInsertId() > 0) {
				
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar datos del caso';
				
			}
			
			
			if (isset($_SESSION['probable_res']) and !empty($_SESSION['probable_res'])) {

				$c4_exp_folio_resp = 'C4/DG/' . $id . '/' . date('Y');
				$id_caso = $id;

				foreach ($_SESSION['probable_res'] as $row) {
					$sql4   = $conn->prepare("INSERT INTO 	tbl_c4_probable_responsable
																(c4_edad_responsable,
																c4_nom_responsable,
																c4_parentesco,
																c4_id_victima,
																c4_exp_folio_resp,
																c4_created_by)
													VALUES 		(?,?,?,?,?,?)");
					$sql4->bindParam(1, $row["c4_edad_responsable"], PDO::PARAM_STR, 30);
					$sql4->bindParam(2, $row["c4_nom_responsable"], PDO::PARAM_STR);
					$sql4->bindParam(3, $row["c4_parentesco"], PDO::PARAM_STR);
					$sql4->bindParam(4, $id_caso, PDO::PARAM_STR);
					$sql4->bindParam(5, $c4_exp_folio_resp, PDO::PARAM_STR, 30);
					$sql4->bindParam(6, $nombre_creador, PDO::PARAM_STR, 30);
					$sql4->execute();
					if ($conn->lastInsertId() > 0) {
					
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar Probable Responsable';
						break;
					}

				}
			}
			if (isset($_SESSION['victima_c4']) and !empty($_SESSION['victima_c4'])) {

				$c4_exp_folio_victima = 'C4/DG/' . $id . '/' . date('Y');
				$id_caso_reportado_victima = $id;
		

				foreach ($_SESSION['victima_c4'] as $row) {

					$sql5   = $conn->prepare("INSERT INTO tbl_c4_victimas 
													(	
														c4_edad_victima,
														c4_edad_ms_victima,
														c4_nom_victima,
														c4_num_delitos,
														c4_per_tercera_edad,
														c4_per_violencia,
														c4_per_discapacidad,
														c4_per_indigena,
														c4_per_transgenero,
														c4_sexo_victima,
														c4_exp_folio_victima,
														c4_created_by,
														c4_id_desc_caso
														)
												values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$sql5->bindParam(1, $row["c4_edad_vic"], PDO::PARAM_STR, 30);
					$sql5->bindParam(2, $row["c4_edad_ms_vic"], PDO::PARAM_STR, 30);
					$sql5->bindParam(3, $row["c4_nom_vic"], PDO::PARAM_STR, 50);
					$sql5->bindParam(4, $row["c4_num_delitos"], PDO::PARAM_STR, 2);
					$sql5->bindParam(5, $row["c4_per_tercera_edad"], PDO::PARAM_INT, 2);
					$sql5->bindParam(6, $row["c4_per_violencia"], PDO::PARAM_INT, 2);
					$sql5->bindParam(7, $row["c4_per_discapacidad"], PDO::PARAM_INT, 2);
					$sql5->bindParam(8, $row["c4_per_indigena"], PDO::PARAM_INT, 2);
					$sql5->bindParam(9, $row["c4_per_transgenero"], PDO::PARAM_INT, 2);
					$sql5->bindParam(10, $row["c4_sexo_victima"], PDO::PARAM_STR, 11);
					$sql5->bindParam(11, $c4_exp_folio_victima, PDO::PARAM_STR, 50);
					$sql5->bindParam(12, $nombre_creador, PDO::PARAM_STR, 50);
					$sql5->bindParam(13, $id_caso_reportado_victima, PDO::PARAM_STR, 50);
					$sql5->execute();
					if ($conn->lastInsertId() > 0) {
					
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar victima';
						break;
					}
					$last_id = $conn->lastInsertId();
					$sql6   = $conn->prepare("INSERT INTO 	tbl_c4_delitos_victimas
															(
															c4_exp_folio_delito,
															c4_delito,
															c4_id_victima,
															c4_created_by)
													VALUES	(?,?,?,?)");
					$sql6->bindParam(1, $c4_exp_folio_victima, PDO::PARAM_STR, 30);
					$sql6->bindParam(2, $row["c4_delitos"], PDO::PARAM_INT, 11);
					$sql6->bindParam(3, $last_id, PDO::PARAM_INT, 11);
					$sql6->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
					$sql6->execute();
					if ($conn->lastInsertId() > 0) {
						
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar Delito';
						break;
					}
					$sql7   = $conn->prepare("INSERT iNTO 	tbl_c4_der_vul_victima
														(
															c4_exp_folio_der_vul_vic,
															c4_der_vul_victima,
															c4_id_victima,
															c4_created_by)
													VALUES 	(?,?,?,?)");
					$sql7->bindParam(1, $c4_exp_folio_victima, PDO::PARAM_STR, 30);
					$sql7->bindParam(2, $row["c4_der_vul"], PDO::PARAM_INT, 11);
					$sql7->bindParam(3, $last_id, PDO::PARAM_INT, 11);
					$sql7->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
					$sql7->execute();
					if ($conn->lastInsertId() > 0) {
						
					} else {
						$conn->rollback();
						$estatus = 'Error al registrar Derecho';
						break;
					}
				}
			}
			if ($last_id = $conn->lastInsertId() > 0) {
				$conn->commit();
				$estatus = 'ok expediente registrado';
			} else {
				$conn->rollback();
				$estatus = 'Error al registrar victima';
			}
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_caso_c4($id,  $c4_folio, $c4_numero, $c4_no_oficio, $c4_fecha_inicio, 
	$c4_pais,$otros_estados_c4, $c4_edo, $c4_mun, $c4_mun_edo, $c4_dirigido, $c4_dg,$nom_archo,$nombre_creador)
	{
		$sql = $this->dbh->prepare("UPDATE 	tbl_c4_expedientes 
									SET		
										 	c4_folio=?,
											c4_numero=?,
											c4_no_oficio=?,
											c4_fecha_inicio = ?,
											c4_pais=?,
											c4_otros_estados=?,
											c4_edo = ?,
											c4_mun=?,
											c4_mun_edo=?,
											c4_dirigido=?,
											c4_dg=?,
											c4_ruta_sol_oficio=?,
											c4_update_by=?
									WHERE	id = ?");
		if ($sql->execute(array( $c4_folio, $c4_numero, $c4_no_oficio, $c4_fecha_inicio, $c4_pais, 
		$otros_estados_c4,$c4_edo, $c4_mun, $c4_mun_edo, $c4_dirigido,
		 $c4_dg,$nom_archo,$nombre_creador, $id))) {
			return 'editado';
		} else
			return 'error';
	}
	public function lista_casos_c4()
	{

		$sql = $this->dbh->prepare("SELECT 	id,
											id_c4_anio,	
											c4_folio,
											c4_numero,
											c4_no_oficio,
											c4_exp_folio,
											c4_ruta_sol_oficio,
											c4_mun,
											c4_edo,
											c4_mun_edo,
											c4_fecha_inicio,
											municipio,
											estado,
											date_format(c4_fecha_inicio,'%d-%m-%Y') as c4_fecha_inicio,
											c4_pais,
											c4_otros_estados
									FROM	((tbl_c4_expedientes 
								LEFT JOIN    cat_municipios
									ON		tbl_c4_expedientes.c4_mun=cat_municipios.id_municipio)
								LEFT JOIN	cat_estados
									ON		tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
									WHERE	activo=?
								");

		$sql->execute(array(1));
		$row = $sql->fetchAll();
		return $row;
	}
	

	public function obtener_caso_c4($id)
	{
		$sql = $this->dbh->prepare("SELECT
									 		id,
											c4_folio,
											c4_numero,
											c4_no_oficio,
											c4_ruta_sol_oficio,
									 		c4_fecha_inicio,
											c4_pais,
											c4_otros_estados,
											c4_edo,
											c4_mun,
											c4_mun_edo,
											c4_dirigido,
											c4_dg,
											c4_exp_folio
									FROM	tbl_c4_expedientes
									WHERE	id = ?");
		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	//Generar
	public function gen_folio($tabla, $id)
	{
		$sql = $this->dbh->prepare("select max(" . $id . ")+1 as fol from " . $tabla . " where c4_anio = ? ;");
		$sql->execute(array(date('Y')));

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}
	public function obtener_folio($tabla, $id)
	{
		$sql = $this->dbh->prepare("select max(" . $id . ") as fol from " . $tabla . " where c4_anio = ? ;");
		$sql->execute(array(date('Y')));

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if ($row["fol"] == "")
			return 1;
		else
			return $row["fol"];
	}


	public function eliminar_caso_c4($id,$des_elimina_c4)
	{
		$sql = $this->dbh->prepare("UPDATE 		tbl_c4_expedientes
											SET	activo=?,
												des_eliminar=?
										WHERE	id = ?");
		if ($sql->execute(array(0,$des_elimina_c4,$id))) {
			return 'ok';
		} else
			return 'error';
	}
	//Victimas 
	public function insertar_victima_c4($nombre_creador)
	{
		try {
			$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
			$c4_exp_folio_victima = 'C4/DG/' . $id . '/' . date('Y');
			$id_caso_reportado_victima = $id;
			$conn = $this->dbh;
			$conn->beginTransaction();

			foreach ($_SESSION['victima_c4'] as $row) {

				$sql   = $conn->prepare("INSERT into tbl_c4_victimas 
												(	
													c4_edad_victima,
													c4_edad_ms_victima,
													c4_nom_victima,
													c4_num_delitos,
													c4_per_tercera_edad,
													c4_per_violencia,
													c4_per_discapacidad,
													c4_per_indigena,
													c4_per_transgenero,
													c4_sexo_victima,
													c4_exp_folio_victima,
													c4_created_by,
													c4_id_desc_caso
													)
											values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$sql->bindParam(1, $row["c4_edad_vic"], PDO::PARAM_STR, 30);
				$sql->bindParam(2, $row["c4_edad_ms_vic"], PDO::PARAM_STR, 30);
				$sql->bindParam(3, $row["c4_nom_vic"], PDO::PARAM_STR, 50);
				$sql->bindParam(4, $row["c4_num_delitos"], PDO::PARAM_STR, 2);
				$sql->bindParam(5, $row["c4_per_tercera_edad"], PDO::PARAM_INT, 2);
				$sql->bindParam(6, $row["c4_per_violencia"], PDO::PARAM_INT, 2);
				$sql->bindParam(7, $row["c4_per_discapacidad"], PDO::PARAM_INT, 2);
				$sql->bindParam(8, $row["c4_per_indigena"], PDO::PARAM_INT, 2);
				$sql->bindParam(9, $row["c4_per_transgenero"], PDO::PARAM_INT, 2);
				$sql->bindParam(10, $row["c4_sexo_victima"], PDO::PARAM_STR, 11);
				$sql->bindParam(11, $c4_exp_folio_victima, PDO::PARAM_STR, 50);
				$sql->bindParam(12, $nombre_creador, PDO::PARAM_STR, 50);
				$sql->bindParam(13, $id_caso_reportado_victima, PDO::PARAM_STR, 50);
				$sql->execute();
				if ($last = $conn->lastInsertId() > 0) {
				} else {
					$conn->rollback();
					$estatus = 'Error al registrar victima';
					break;
				}
				$last_id = $conn->lastInsertId();
				$sql2   = $conn->prepare("INSERT INTO 	tbl_c4_delitos_victimas
														(
														c4_exp_folio_delito,
														c4_delito,
														c4_id_victima,
														c4_created_by)
												VALUES	(?,?,?,?)");
				$sql2->bindParam(1, $c4_exp_folio_victima, PDO::PARAM_STR, 30);
				$sql2->bindParam(2, $row["c4_delitos"], PDO::PARAM_INT, 11);
				$sql2->bindParam(3, $last_id, PDO::PARAM_INT, 11);
				$sql2->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
				$sql2->execute();
				if ($last_2 = $conn->lastInsertId() > 0) {
				} else {
					$conn->rollback();
					$estatus = 'Error al registrar Delito';
					break;
				}
				$sql3   = $conn->prepare("INSERT iNTO 	tbl_c4_der_vul_victima
													(
														c4_exp_folio_der_vul_vic,
														c4_der_vul_victima,
														c4_id_victima,
														c4_created_by)
												VALUES 	(?,?,?,?)");
				$sql3->bindParam(1, $c4_exp_folio_victima, PDO::PARAM_STR, 30);
				$sql3->bindParam(2, $row["c4_der_vul"], PDO::PARAM_INT, 11);
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
	public function fn_lista_victimas_c4($fol_c4)
	{
		$sql = $this->dbh->prepare("
										SELECT	id_victima,
												c4_edad_victima,
												c4_edad_ms_victima,
												c4_nom_victima,
												c4_num_delitos,
												c4_exp_folio_victima,
												c4_sexo_victima,
												c4_per_tercera_edad,
												c4_per_discapacidad,
												c4_per_indigena,
												c4_per_transgenero,
												c4_per_violencia,
												c4_id_desc_caso,
												c4_delito,
												c4_der_vul_victima,
												tbl_c4_victimas.c4_id_desc_caso,
												tbl_c4_delitos_victimas.c4_id_victima,
												tbl_c4_der_vul_victima.c4_id_victima
										FROM 	((tbl_c4_victimas
									INNER JOIN 	tbl_c4_delitos_victimas 
										ON 		tbl_c4_victimas.id_victima = tbl_c4_delitos_victimas.c4_id_victima)
									INNER JOIN	tbl_c4_der_vul_victima
										ON		tbl_c4_victimas.id_victima = tbl_c4_der_vul_victima.c4_id_victima)
										WHERE	c4_exp_folio_victima = ?
									");
		$sql->execute(array($fol_c4));
		$row = $sql->fetchAll();
		return $row;
	}
	public function obtener_dato_victima_c4($id)
	{
		$sql = $this->dbh->prepare(
			"SELECT 	id_victima,
												c4_edad_victima,
												c4_edad_ms_victima,
												c4_nom_victima,
												c4_num_delitos,
												c4_per_tercera_edad,
												c4_per_violencia,
												c4_per_discapacidad,
												c4_per_indigena,
												c4_per_transgenero,
												c4_sexo_victima,
												id_c4_delito_victima,
												c4_exp_folio_victima,
												c4_delito,
												id_c4_derecho,
												c4_der_vul_victima,
												tbl_c4_victimas.id_victima,
												tbl_c4_delitos_victimas.c4_id_victima,
												tbl_c4_der_vul_victima.c4_id_victima
									FROM 		((tbl_c4_victimas 
									INNER JOIN	tbl_c4_delitos_victimas
									ON			tbl_c4_victimas.id_victima=tbl_c4_delitos_victimas.c4_id_victima)
									INNER JOIN 	tbl_c4_der_vul_victima
									ON			tbl_c4_victimas.id_victima=tbl_c4_der_vul_victima.c4_id_victima)
									WHERE 		id_victima = ?"
		);

		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	public function editar_victima_c4($edad,$edad_ms, $nom, $num_del, $per_ter, $per_vio, $per_dis, $per_ind, $per_tran, $c4_sex, $nombre_creador, 	$id)
	{
		$conn = $this->dbh;
		$conn->beginTransaction();
		$estatus = '';
		try {
			$sql = $conn->prepare("UPDATE 	tbl_c4_victimas
									SET 	c4_edad_victima=?,
											c4_edad_ms_victima=?,
											c4_nom_victima=?,
											c4_num_delitos=?,
											c4_per_tercera_edad=?,
											c4_per_violencia=?,
											c4_per_discapacidad=?,
											c4_per_indigena=?,
											c4_per_transgenero=?,
											c4_sexo_victima=?,
											c4_update_by=?
									WHERE	id_victima= ?");
			if ($sql->execute(array(
				$edad,
				$edad_ms,
				$nom,
				$num_del,
				$per_ter,
				$per_vio,
				$per_dis,
				$per_ind,
				$per_tran,
				$c4_sex,
				$nombre_creador,
				$id
			))) {
				$conn->commit();
				return 'ok';
			} else
				return 'error';
		} catch (PDOException $e) {

			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_delito_victima_c4($id_del_victima, $delito, $nombre_creador)
	{
		$sql = $this->dbh->prepare("UPDATE 	tbl_c4_delitos_victimas
									SET 	c4_delito=?,
											c4_update_by=?
									WHERE	id_c4_delito_victima= ?");
		if ($sql->execute(array( 	$delito,
									$nombre_creador,
									$id_del_victima
								))) {
			return 'editado';
		} else
			return 'error';

	}
	public function editar_derecho_victima_c4($id_der_victima_c4, $derecho_c4, $nombre_creador)
	{
		$sql = $this->dbh->prepare(
		"UPDATE 	tbl_c4_der_vul_victima
									SET 	c4_der_vul_victima=?,
											c4_update_by=?
									WHERE	id_c4_derecho= ?");
		if ($sql->execute(array(
			$derecho_c4,
			$nombre_creador,
			$id_der_victima_c4
		))) {
			return 'editado';
		} else
		return 'error';



	}
	//insertar Probable Responsable
	public function insertar_prob_respo_c4($nombre_creador)
	{
		try {
			$cok            = 0;
			$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
			$c4_exp_folio_resp = 'C4/DG/' . $id . '/' . date('Y');
			$id_caso = $id;
			foreach ($_SESSION['probable_res'] as $row) {
				$sql   = $this->dbh->prepare("INSERT INTO 	tbl_c4_probable_responsable
														 	(c4_edad_responsable,
														 	c4_nom_responsable,
														 	c4_parentesco,
														 	c4_id_victima,
														 	c4_exp_folio_resp,
														 	c4_created_by)
												VALUES 		(?,?,?,?,?,?)");
				$sql->bindParam(1, $row["c4_edad_responsable"], PDO::PARAM_STR, 30);
				$sql->bindParam(2, $row["c4_nom_responsable"], PDO::PARAM_STR);
				$sql->bindParam(3, $row["c4_parentesco"], PDO::PARAM_STR);
				$sql->bindParam(4, $id_caso, PDO::PARAM_STR);
				$sql->bindParam(5, $c4_exp_folio_resp, PDO::PARAM_STR, 30);
				$sql->bindParam(6, $nombre_creador, PDO::PARAM_STR, 30);
				$cok++;
				if ($sql->execute()) {
					$cok++;
					$estatus = 'ok';
				} else
					$estatus = 'error_registro';
			}
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function lista_pro_res_c4($fol_c4)
	{
		$sql = $this->dbh->prepare("
										SELECT	id_pro_responsable,
												c4_edad_responsable,
												c4_nom_responsable,
												c4_parentesco,
												c4_id_victima,
												c4_exp_folio_resp,
												tbl_c4_probable_responsable.c4_id_victima,
												tbl_c4_desc_casos.c4_exp_id_caso
										FROM 	(tbl_c4_probable_responsable
									INNER JOIN 	tbl_c4_desc_casos 
										ON 		tbl_c4_probable_responsable.c4_id_victima = tbl_c4_desc_casos.c4_exp_id_caso)
										WHERE	c4_exp_folio_resp = ?
									");
		$sql->execute(array($fol_c4));
		$row = $sql->fetchAll();
		return $row;
	}
	public function obtener_dato_pro_resp_c4($id)
	{
		$sql = $this->dbh->prepare(
			"SELECT 	id_pro_responsable,
												c4_edad_responsable,
												c4_nom_responsable,
												c4_parentesco,
												c4_exp_folio_resp
									FROM 		tbl_c4_probable_responsable 
									WHERE 		id_pro_responsable = ?"
		);

		$sql->execute(array($id));
		$row = $sql->fetchAll();
		return $row;
	}
	public function editar_pro_res_c4($c4_edad_responsable_edit, $c4_nom_responsable_edit, $c4_parentesco_edit, $nombre_creador, $id)
	{
		$sql = $this->dbh->prepare("UPDATE 		tbl_c4_probable_responsable
		 							SET 		c4_edad_responsable=?,
										 		c4_nom_responsable=?,
												c4_parentesco=?,
												c4_update_by=?
									WHERE	 	id_pro_responsable= ?");
		if ($sql->execute(array($c4_edad_responsable_edit, $c4_nom_responsable_edit, $c4_parentesco_edit, $nombre_creador, $id))) {
			return 'ok';
		} else
			return 'error';
	}
	//


	//Insertar Descripcion de caso
	public function insertar_desc_caso_c4($c4_lugar_hechos, $c4_des_hechos, $c4_observaciones, $nombre_creador)
	{

		try {
			$id = $this->obtener_folio('tbl_c4_expedientes', 'id');
			$c4_exp_folio_desc_caso = 'C4/DG/' . $id . '/' . date('Y');
			$id_caso = $id;
			$sql   = $this->dbh->prepare("INSERT into 	tbl_c4_desc_casos(
														c4_lugar_hechos,
														c4_des_hechos,
														c4_observaciones,
														c4_exp_folio_desc_caso,
														c4_exp_id_caso,
														c4_created_by) 
											VALUES		(?,?,?,?,?,?)");
			$sql->bindParam(1, $c4_lugar_hechos, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $c4_des_hechos, PDO::PARAM_STR);
			$sql->bindParam(3, $c4_observaciones, PDO::PARAM_STR);
			$sql->bindParam(4, $c4_exp_folio_desc_caso, PDO::PARAM_STR);
			$sql->bindParam(5, $id_caso, PDO::PARAM_STR);
			$sql->bindParam(6, $nombre_creador, PDO::PARAM_STR);



			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error_registro caso';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function editar_desc_caso_c4($id, $c4_lugar_hechos, $c4_des_hechos, $c4_observaciones, $nombre_creador)
	{
		try {
			$sql = $this->dbh->prepare("UPDATE 	tbl_c4_desc_casos
										 SET 	c4_lugar_hechos=?,
										 		c4_des_hechos=?,
												c4_observaciones=?,
												c4_update_by=?
										WHERE 	id_desc_caso =?");
			$sql->bindParam(1, $c4_lugar_hechos, PDO::PARAM_STR, 30);
			$sql->bindParam(2, $c4_des_hechos, PDO::PARAM_STR, 30);
			$sql->bindParam(3, $c4_observaciones, PDO::PARAM_STR, 30);
			$sql->bindParam(4, $nombre_creador, PDO::PARAM_STR, 30);
			$sql->bindParam(5, $id);

			if ($sql->execute()) {
				$estatus = 'ok';
			} else
				$estatus = 'error al actualizar Descripcion de caso';
		} catch (Exception $e) {
			$estatus = $e;
		}

		return $estatus;
	}
	public function obtener_des_caso_c4($fol_c4)
	{
		$sql = $this->dbh->prepare("SELECT
											id_desc_caso,
											c4_lugar_hechos,
											c4_des_hechos,
											c4_observaciones,
											c4_exp_folio_desc_caso,
											c4_exp_id_caso
			 						FROM 	tbl_c4_desc_casos 
									WHERE 	c4_exp_folio_desc_caso = ?
									");

		$sql->execute(array($fol_c4));
		$row = $sql->fetchAll();
		return $row;
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
	public function fn_lista_derechos()
	{
		$sql = $this->dbh->prepare("select id_derecho, derecho FROM cat_derechos_vulnerados GROUP BY id_derecho");
		$sql->execute();
		$row = $sql->fetchAll();
		return $row;
	}
}
