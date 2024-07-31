<?php
require_once('../config/class.pdo.php');

class Estadisticas extends Conexion
{
	public $v;
	//Objeto principal del constructor de la clase
	public function __construct()
	{
		$this->conectar();
	}

	public function reporte1($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		$estatus = $datos['estatus'];
		//Consulta de municipios en veracruz
		$consulta = "SELECT 		municipio,COUNT(*) AS Numero
					FROM 		((tbl_can_expediente
					LEFT JOIN 	cat_municipios
					ON 			tbl_can_expediente.can_municipio= cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo = 1
					AND 		can_estado =30
					AND			estatus_expediente=?	
					GROUP BY 	municipio
					ORDER BY	Numero desc
		";
		//Consulta e mexico pero estado diferente a veracruz
		$consulta2 = "SELECT 		estado,COUNT(*) AS Numero			
					FROM 		(tbl_can_expediente
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo =1
					AND 		estatus_expediente=?
					AND			can_estado !=30	
					AND			can_pais='México'				
					GROUP BY 	can_estado
					ORDER BY	Numero desc";
		//Consulta de Estados diferentes de mexico 
		$consulta3 = "SELECT 		can_pais,COUNT(*) AS Numero			
					FROM 		(tbl_can_expediente
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo =1
					AND 		estatus_expediente=?
					AND			can_pais != 'México'				
					GROUP BY 	can_pais
					ORDER BY	numero desc
		";
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			$stmt =  $this->dbh->prepare($consulta);
			$stmt->execute(array($desde, $hasta, $estatus));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta1'] = $result;
			} else {
				$result['consulta1'] = "n/a";
			}
			$stmt2 =  $this->dbh->prepare($consulta2);
			$stmt2->execute(array($desde, $hasta, $estatus));
			$result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result2)) {
				$dataFound = true;
				$result['consulta2'] = $result2;
			} else {
				$result['consulta2'] = "n/a";
			}
			$stmt3 =  $this->dbh->prepare($consulta3);
			$stmt3->execute(array($desde, $hasta, $estatus));
			$result3 = $stmt3->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result3)) {
				$dataFound = true;
				$result['consulta3'] = $result3;
			} else {
				$result['consulta3'] = "n/a";
			}
			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
	public function reporte2($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		$estatus = $datos['estatus'];
		$activo = '1';
		
		//Consulta de por mes
		$consulta = " SELECT 
						CASE MONTH(can_fecha)
							WHEN 1 THEN 'Enero'
							WHEN 2 THEN 'Febrero'
							WHEN 3 THEN 'Marzo'
							WHEN 4 THEN 'Abril'
							WHEN 5 THEN 'Mayo'
							WHEN 6 THEN 'Junio'
							WHEN 7 THEN 'Julio'
							WHEN 8 THEN 'Agosto'
							WHEN 9 THEN 'Septiembre'
							WHEN 10 THEN 'Octubre'
							WHEN 11 THEN 'Noviembre'
							WHEN 12 THEN 'Diciembre'
						END AS Mes,
						COUNT(*) AS Numero
					FROM tbl_can_expediente
					WHERE can_fecha BETWEEN ? AND ?
					AND		estatus_expediente=?
					AND		activo = 1
	
					GROUP BY MONTH(can_fecha)
					ORDER BY MONTH(can_fecha);

		";
		//Consulta por género
		$consulta2 = "SELECT 	can_sexo_victima As Genero,
					COUNT(*) AS Numero
					FROM 	(tbl_can_victimas
					LEFT JOIN	tbl_can_expediente
					ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
					WHERE	can_fecha BETWEEN  ? AND ?										
					AND		activo = 1
					AND		estatus_expediente=?
					GROUP BY 	can_sexo_victima	

		";
		//Consulta de menores de edad
		$consulta3 = "SELECT 	can_edad_vic AS Edad ,COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 	can_fecha 
										BETWEEN	? AND 	?
										AND	estatus_expediente=?
										and 	can_edad_vic <=17	
										GROUP BY 	can_edad_vic
										ORDER BY	Numero desc
		";
		//Consulta de mayores de edad
		$consulta4 = "SELECT 	can_edad_vic AS Edad ,COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 	can_fecha 
										BETWEEN	? AND 	?
										AND	estatus_expediente=?
										and 	can_edad_vic >=17	
										GROUP BY 	can_edad_vic
										ORDER BY	Numero desc
		";
		//Personas vulneradas
		$consulta5 = "SELECT 'can_per_tercera_edad' AS column_name, SUM(CASE WHEN can_per_tercera_edad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_tercera_edad
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_violencia' AS column_name, SUM(CASE WHEN can_per_violencia != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_violencia
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_discapacidad' AS column_name, SUM(CASE WHEN can_per_discapacidad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_discapacidad
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_indigena' AS column_name, SUM(CASE WHEN can_per_indigena != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_indigena
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_transgenero' AS column_name, SUM(CASE WHEN can_per_transgenero != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_transgenero
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery 
						ORDER BY count_non_zero desc;

		";
		
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			
			$stmt =  $this->dbh->prepare($consulta);
			$stmt->execute(array($desde, $hasta, $estatus));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta1'] = $result;
			} else {
				$result['consulta1'] = "n/a";
			}
			$stmt2 =  $this->dbh->prepare($consulta2);
			$stmt2->execute(array($desde, $hasta, $estatus));
			$result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result2)) {
				$dataFound = true;
				$result['consulta2'] = $result2;
			} else {
				$result['consulta2'] = "n/a";
			}
			$stmt3 =  $this->dbh->prepare($consulta3);
			$stmt3->execute(array($desde, $hasta, $estatus));
			$result3 = $stmt3->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result3)) {
				$dataFound = true;
				$result['consulta3'] = $result3;
			} else {
				$result['consulta3'] = "n/a";
			}
			$stmt4 =  $this->dbh->prepare($consulta4);
			$stmt4->execute(array($desde, $hasta, $estatus));
			$result4 = $stmt4->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result4)) {
				$dataFound = true;
				$result['consulta4'] = $result4;
			} else {
				$result['consulta4'] = "n/a";
			}
			$stmt5 =  $this->dbh->prepare($consulta5);
			$stmt5->execute(array($desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo));
			$result5 = $stmt5->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result5)) {
				$dataFound = true;
				$result['consulta5'] = $result5;
			} else {
				$result['consulta5'] = "n/a";
			}

			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
	public function reporte3($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		$estatus = $datos['estatus'];
		$activo = '1';
		//Consulta de municipios en veracruz
		$consulta1 = "SELECT 		municipio,COUNT(*) AS Numero
					FROM 		((tbl_can_expediente
					LEFT JOIN 	cat_municipios
					ON 			tbl_can_expediente.can_municipio= cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo = 1
					AND 		can_estado =30
					AND			estatus_expediente=?	
					GROUP BY 	municipio
					ORDER BY	Numero desc
		";
		//Consulta e mexico pero estado diferente a veracruz
		$consulta2 = "SELECT 		estado,COUNT(*) AS Numero			
					FROM 		(tbl_can_expediente
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo =1
					AND 		estatus_expediente=?
					AND			can_estado !=30	
					AND			can_pais='México'				
					GROUP BY 	can_estado
					ORDER BY	Numero desc";
		//Consulta de Estados diferentes de mexico 
		$consulta3 = "SELECT 		can_pais,COUNT(*) AS Numero			
					FROM 		(tbl_can_expediente
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo =1
					AND 		estatus_expediente=?
					AND			can_pais != 'México'				
					GROUP BY 	can_pais
					ORDER BY	numero desc
		";
		//Consulta de por mes
		$consulta4 = " SELECT 
						CASE MONTH(can_fecha)
							WHEN 1 THEN 'Enero'
							WHEN 2 THEN 'Febrero'
							WHEN 3 THEN 'Marzo'
							WHEN 4 THEN 'Abril'
							WHEN 5 THEN 'Mayo'
							WHEN 6 THEN 'Junio'
							WHEN 7 THEN 'Julio'
							WHEN 8 THEN 'Agosto'
							WHEN 9 THEN 'Septiembre'
							WHEN 10 THEN 'Octubre'
							WHEN 11 THEN 'Noviembre'
							WHEN 12 THEN 'Diciembre'
						END AS Mes,
						COUNT(*) AS Numero
					FROM tbl_can_expediente
					WHERE can_fecha BETWEEN ? AND ?
					AND		estatus_expediente=?
					AND		activo = 1
					GROUP BY MONTH(can_fecha)
					ORDER BY MONTH(can_fecha);

		";
		//Consulta por género
		$consulta5 = "SELECT 	can_sexo_victima As Genero,
					COUNT(*) AS Numero
					FROM 	(tbl_can_victimas
					LEFT JOIN	tbl_can_expediente
					ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
					WHERE	can_fecha BETWEEN  ? AND ?										
					AND		activo = 1
					AND		estatus_expediente=?
					GROUP BY 	can_sexo_victima	

		";
		//Consulta de menores de edad
		$consulta6 = "SELECT 	can_edad_vic AS Edad ,COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 	can_fecha 
										BETWEEN	? AND 	?
										AND	estatus_expediente=?
										and 	can_edad_vic <=17
										AND 	activo = 1	
										GROUP BY 	can_edad_vic
										ORDER BY	Numero desc
		";
		//Consulta de mayores de edad
		$consulta7 = "SELECT 	can_edad_vic AS Edad ,COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 	can_fecha 
										BETWEEN	? AND 	?
										AND	estatus_expediente=?
										and 	can_edad_vic >=17	
										GROUP BY 	can_edad_vic
										ORDER BY	Numero desc
		";
		//Personas vulneradas
		$consulta8 = "SELECT 'can_per_tercera_edad' AS column_name, SUM(CASE WHEN can_per_tercera_edad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_tercera_edad
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_violencia' AS column_name, SUM(CASE WHEN can_per_violencia != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_violencia
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_discapacidad' AS column_name, SUM(CASE WHEN can_per_discapacidad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_discapacidad
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_indigena' AS column_name, SUM(CASE WHEN can_per_indigena != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_indigena
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery
						UNION ALL
						SELECT 'can_per_transgenero' AS column_name, SUM(CASE WHEN can_per_transgenero != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM (
							SELECT tcv.can_per_transgenero
							FROM tbl_can_victimas tcv
							INNER JOIN tbl_can_expediente tce ON tcv.can_exp_folio_victima = tce.can_folio_expediente
							WHERE tce.can_fecha BETWEEN ? AND ?
							AND tce.estatus_expediente = ?
							AND tce.activo = ?
						) AS subquery 
						ORDER BY count_non_zero desc;

		";
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			$stmt =  $this->dbh->prepare($consulta1);
			$stmt->execute(array($desde, $hasta, $estatus));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta1'] = $result;
			} else {
				$result['consulta1'] = "n/a";
			}
			$stmt2 =  $this->dbh->prepare($consulta2);
			$stmt2->execute(array($desde, $hasta, $estatus));
			$result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result2)) {
				$dataFound = true;
				$result['consulta2'] = $result2;
			} else {
				$result['consulta2'] = "n/a";
			}
			$stmt3 =  $this->dbh->prepare($consulta3);
			$stmt3->execute(array($desde, $hasta, $estatus));
			$result3 = $stmt3->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result3)) {
				$dataFound = true;
				$result['consulta3'] = $result3;
			} else {
				$result['consulta3'] = "n/a";
			}
			$stmt4 =  $this->dbh->prepare($consulta4);
			$stmt4->execute(array($desde, $hasta, $estatus));
			$result4 = $stmt4->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result4)) {
				$dataFound = true;
				$result['consulta4'] = $result4;
			} else {
				$result['consulta4'] = "n/a";
			}
			$stmt5 =  $this->dbh->prepare($consulta5);
			$stmt5->execute(array($desde, $hasta, $estatus));
			$result5 = $stmt5->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result5)) {
				$dataFound = true;
				$result['consulta5'] = $result5;
			} else {
				$result['consulta5'] = "n/a";
			}
			$stmt6 =  $this->dbh->prepare($consulta6);
			$stmt6->execute(array($desde, $hasta, $estatus));
			$result6 = $stmt6->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result6)) {
				$dataFound = true;
				$result['consulta6'] = $result6;
			} else {
				$result['consulta6'] = "n/a";
			}
			$stmt7 =  $this->dbh->prepare($consulta7);
			$stmt7->execute(array($desde, $hasta, $estatus));
			$result7 = $stmt7->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result7)) {
				$dataFound = true;
				$result['consulta7'] = $result7;
			} else {
				$result['consulta7'] = "n/a";
			}
			$stmt8 =  $this->dbh->prepare($consulta8);
			$stmt8->execute(array($desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo, $desde, $hasta, $estatus, $activo));
			$result8 = $stmt8->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result8)) {
				$dataFound = true;
				$result['consulta8'] = $result8;
			} else {
				$result['consulta8'] = "n/a";
			}
			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
	public function reporte4($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		//Consulta de municipios en veracruz
		$consulta = "SELECT 		municipio,COUNT(*) AS Numero
					FROM 		((tbl_c4_expedientes
					LEFT JOIN 	cat_municipios
					ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
					WHERE 		c4_fecha_inicio
					BETWEEN 	? AND ?
					AND 		activo = ?
					AND 		c4_edo = 30
					GROUP BY 	municipio
					ORDER BY	Numero desc
										
		";
		//Consulta e mexico pero estado diferente a veracruz
		$consulta2 = "	SELECT 	estado,COUNT(*) AS Numero
						FROM 		((tbl_c4_expedientes
						LEFT JOIN 	cat_municipios
						ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
						LEFT JOIN 	cat_estados
						ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
						WHERE 		c4_fecha_inicio
						BETWEEN 	? AND ?
						AND 		activo = ?
						AND 		c4_edo !=30
						AND 		c4_pais ='México'
						GROUP BY 	municipio
						ORDER BY	Numero desc";
		//Consulta de Estados diferentes de mexico 
		$consulta3 = "	SELECT 		c4_pais,COUNT(*) AS Numero			
						FROM 		tbl_c4_expedientes
						WHERE 		c4_fecha_inicio 
						BETWEEN 	? AND ?
						AND			activo =?
						AND 		c4_pais !='México'
						GROUP by 	c4_pais
						ORDER BY Numero desc
			";
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			$stmt =  $this->dbh->prepare($consulta);
			$stmt->execute(array($desde, $hasta, 1));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta1'] = $result;
			} else {
				$result['consulta1'] = "n/a";
			}
			$stmt2 =  $this->dbh->prepare($consulta2);
			$stmt2->execute(array($desde, $hasta, 1));
			$result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result2)) {
				$dataFound = true;
				$result['consulta2'] = $result2;
			} else {
				$result['consulta2'] = "n/a";
			}
			$stmt3 =  $this->dbh->prepare($consulta3);
			$stmt3->execute(array($desde, $hasta, 1));
			$result3 = $stmt3->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result3)) {
				$dataFound = true;
				$result['consulta3'] = $result3;
			} else {
				$result['consulta3'] = "n/a";
			}
			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
	public function reporte5($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		$estatus = $datos['estatus'];
		$activo = '1';
		//Consulta de por mes
		$consulta3 = " SELECT 
						CASE MONTH(c4_fecha_inicio)
						WHEN 1 THEN 'Enero'
						WHEN 2 THEN 'Febrero'
						WHEN 3 THEN 'Marzo'
						WHEN 4 THEN 'Abril'
						WHEN 5 THEN 'Mayo'
						WHEN 6 THEN 'Junio'
						WHEN 7 THEN 'Julio'
						WHEN 8 THEN 'Agosto'
						WHEN 9 THEN 'Septiembre'
						WHEN 10 THEN 'Octubre'
						WHEN 11 THEN 'Noviembre'
						WHEN 12 THEN 'Diciembre'
						END AS Mes,
						COUNT(*) AS Numero

						FROM 		tbl_c4_expedientes
						WHERE		c4_fecha_inicio BETWEEN ? AND ?
						AND 		activo = ?
						GROUP BY 	Mes
						ORDER BY	Numero DESC;

		";
		//Consulta por género
		$consulta4 = "SELECT 	c4_sexo_victima As Genero,
						COUNT(*) AS Numero
						FROM 	(tbl_c4_victimas
						LEFT JOIN	tbl_c4_expedientes
						ON		tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE	c4_fecha_inicio 
						BETWEEN ?
						AND 	?
						AND		activo =?	
						GROUP BY 	c4_sexo_victima	
						ORDER BY Numero desc

		";
		//Consulta de menores de edad
		$consulta5 = "SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero													
						FROM 			(tbl_c4_victimas
						LEFT JOIN		tbl_c4_expedientes
						ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE 			c4_fecha_inicio 
						BETWEEN			?
						AND 			?
						AND 			activo = ?
						AND 			c4_edad_victima<=18
						GROUP BY 		Edad
						ORDER BY 		Edad ASC
		";
		//Consulta de mayores de edad
		$consulta6 = "	SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero													
						FROM 			(tbl_c4_victimas
						LEFT JOIN		tbl_c4_expedientes
						ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE 			c4_fecha_inicio 
						BETWEEN			?
						AND 			?
						AND 			activo = ?
						AND 			c4_edad_victima>=18
						GROUP BY 		Edad
						ORDER BY 		Edad ASC
						";
		//Consulta de delitos de edad
		$consulta7 = "SELECT 		delito,
						count(*) as Numero
						FROM 		((tbl_c4_delitos_victimas
						LEFT JOIN	tbl_c4_expedientes
						ON			tbl_c4_delitos_victimas.c4_exp_folio_delito=tbl_c4_expedientes.c4_exp_folio)
						LEFT JOIN  	cat_tipos_delitos
						ON 			tbl_c4_delitos_victimas.c4_delito=cat_tipos_delitos.id_delito)
						WHERE 		c4_fecha_inicio BETWEEN ? AND ?
						AND 		activo = ?
						GROUP BY 	delito
						ORDER BY Numero desc
						";
		//Personas vulneradas
		$consulta8 = "SELECT 
							'c4_per_tercera_edad' AS column_name,
							SUM(CASE WHEN c4_per_tercera_edad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_tercera_edad
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_violencia' AS column_name,
							SUM(CASE WHEN c4_per_violencia != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_violencia
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_discapacidad' AS column_name,
							SUM(CASE WHEN c4_per_discapacidad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_discapacidad
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_indigena' AS column_name,
							SUM(CASE WHEN c4_per_indigena != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_indigena
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_transgenero' AS column_name,
							SUM(CASE WHEN c4_per_transgenero != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_transgenero
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery 

						ORDER BY count_non_zero DESC;



		";
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			$stmt =  $this->dbh->prepare($consulta3);
			$stmt->execute(array($desde, $hasta, 1));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta3'] = $result;
			} else {
				$result['consulta3'] = "n/a";
			}
			$stmt2 =  $this->dbh->prepare($consulta4);
			$stmt2->execute(array($desde, $hasta, 1));
			$result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result2)) {
				$dataFound = true;
				$result['consulta4'] = $result2;
			} else {
				$result['consulta4'] = "n/a";
			}
			$stmt3 =  $this->dbh->prepare($consulta5);
			$stmt3->execute(array($desde, $hasta, 1));
			$result3 = $stmt3->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result3)) {
				$dataFound = true;
				$result['consulta5'] = $result3;
			} else {
				$result['consulta5'] = "n/a";
			}
			$stmt4 =  $this->dbh->prepare($consulta6);
			$stmt4->execute(array($desde, $hasta, 1));
			$result4 = $stmt4->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result4)) {
				$dataFound = true;
				$result['consulta6'] = $result4;
			} else {
				$result['consulta6'] = "n/a";
			}
			$stmt5 =  $this->dbh->prepare($consulta7);
			$stmt5->execute(array($desde, $hasta, 1));
			$result5 = $stmt5->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result5)) {
				$dataFound = true;
				$result['consulta7'] = $result5;
			} else {
				$result['consulta7'] = "n/a";
			}
			$stmt6 =  $this->dbh->prepare($consulta8);
			$stmt6->execute(array($desde, $hasta, 1, $desde, $hasta, 1, $desde, $hasta, 1, $desde, $hasta, 1, $desde, $hasta, 1));
			$result6 = $stmt6->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result6)) {
				$dataFound = true;
				$result['consulta8'] = $result6;
			} else {
				$result['consulta8'] = "n/a";
			}
			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
	public function reporte6($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		$estatus = $datos['estatus'];
		$activo = '1';
		//Consulta de municipios en veracruz
		$consulta1 = "SELECT 		municipio,COUNT(*) AS Numero
					FROM 		((tbl_c4_expedientes
					LEFT JOIN 	cat_municipios
					ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
					WHERE 		c4_fecha_inicio
					BETWEEN 	? AND ?
					AND 		activo = ?
					AND 		c4_edo = 30
					GROUP BY 	municipio
					ORDER BY	Numero desc
										
		";
		//Consulta e mexico pero estado diferente a veracruz
		$consulta2 = "	SELECT 	estado,COUNT(*) AS Numero
						FROM 		((tbl_c4_expedientes
						LEFT JOIN 	cat_municipios
						ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
						LEFT JOIN 	cat_estados
						ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
						WHERE 		c4_fecha_inicio
						BETWEEN 	? AND ?
						AND 		activo = ?
						AND 		c4_edo !=30
						AND 		c4_pais ='México'
						GROUP BY 	municipio
						ORDER BY	Numero desc";
		//Consulta de Estados diferentes de mexico 
		$consulta3 = "	SELECT 		c4_pais,COUNT(*) AS Numero			
						FROM 		tbl_c4_expedientes
						WHERE 		c4_fecha_inicio 
						BETWEEN 	? AND ?
						AND			activo =?
						AND 		c4_pais !='México'
						GROUP by 	c4_pais
						ORDER BY Numero desc
			";
		//Consulta de por mes
		$consulta4 = " SELECT 
						CASE MONTH(c4_fecha_inicio)
						WHEN 1 THEN 'Enero'
						WHEN 2 THEN 'Febrero'
						WHEN 3 THEN 'Marzo'
						WHEN 4 THEN 'Abril'
						WHEN 5 THEN 'Mayo'
						WHEN 6 THEN 'Junio'
						WHEN 7 THEN 'Julio'
						WHEN 8 THEN 'Agosto'
						WHEN 9 THEN 'Septiembre'
						WHEN 10 THEN 'Octubre'
						WHEN 11 THEN 'Noviembre'
						WHEN 12 THEN 'Diciembre'
						END AS Mes,
						COUNT(*) AS Numero

						FROM 		tbl_c4_expedientes
						WHERE		c4_fecha_inicio BETWEEN ? AND ?
						AND 		activo = ?
						GROUP BY 	Mes
						ORDER BY	Numero DESC;

		";
		//Consulta por género
		$consulta5 = "SELECT 	c4_sexo_victima As Genero,
						COUNT(*) AS Numero
						FROM 	(tbl_c4_victimas
						LEFT JOIN	tbl_c4_expedientes
						ON		tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE	c4_fecha_inicio 
						BETWEEN ?
						AND 	?
						AND		activo =?	
						GROUP BY 	c4_sexo_victima	
						ORDER BY Numero desc

		";
		//Consulta de menores de edad
		$consulta6 = "SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero													
						FROM 			(tbl_c4_victimas
						LEFT JOIN		tbl_c4_expedientes
						ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE 			c4_fecha_inicio 
						BETWEEN			?
						AND 			?
						AND 			activo = ?
						AND 			c4_edad_victima<=18
						GROUP BY 		Edad
						ORDER BY 		Edad ASC
		";
		$consulta7 = "SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero													
			FROM 			(tbl_c4_victimas
			LEFT JOIN		tbl_c4_expedientes
			ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
			WHERE 			c4_fecha_inicio 
			BETWEEN			?
			AND 			?
			AND 			activo = ?
			AND 			c4_edad_victima>=18
			GROUP BY 		Edad
			ORDER BY 		Edad ASC";
		//Consulta de delitos de edad
		$consulta8 = "SELECT 		delito,
						count(*) as Numero
						FROM 		((tbl_c4_delitos_victimas
						LEFT JOIN	tbl_c4_expedientes
						ON			tbl_c4_delitos_victimas.c4_exp_folio_delito=tbl_c4_expedientes.c4_exp_folio)
						LEFT JOIN  	cat_tipos_delitos
						ON 			tbl_c4_delitos_victimas.c4_delito=cat_tipos_delitos.id_delito)
						WHERE 		c4_fecha_inicio BETWEEN ? AND ?
						AND 		activo = ?
						GROUP BY 	delito
						ORDER BY Numero desc
						";
		//Personas vulneradas
		$consulta9 = "SELECT 
							'c4_per_tercera_edad' AS column_name,
							SUM(CASE WHEN c4_per_tercera_edad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_tercera_edad
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_violencia' AS column_name,
							SUM(CASE WHEN c4_per_violencia != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_violencia
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_discapacidad' AS column_name,
							SUM(CASE WHEN c4_per_discapacidad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_discapacidad
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_indigena' AS column_name,
							SUM(CASE WHEN c4_per_indigena != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_indigena
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_transgenero' AS column_name,
							SUM(CASE WHEN c4_per_transgenero != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_transgenero
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery 

						ORDER BY count_non_zero DESC;



		";
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			$stmt =  $this->dbh->prepare($consulta1);
			$stmt->execute(array($desde, $hasta, 1));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta1'] = $result;
			} else {
				$result['consulta1'] = "n/a";
			}
			$stmt2 =  $this->dbh->prepare($consulta2);
			$stmt2->execute(array($desde, $hasta, 1));
			$result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result2)) {
				$dataFound = true;
				$result['consulta2'] = $result2;
			} else {
				$result['consulta2'] = "n/a";
			}
			$stmt3 =  $this->dbh->prepare($consulta3);
			$stmt3->execute(array($desde, $hasta, 1));
			$result3 = $stmt3->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result3)) {
				$dataFound = true;
				$result['consulta3'] = $result3;
			} else {
				$result['consulta3'] = "n/a";
			}
			$stmt4 =  $this->dbh->prepare($consulta4);
			$stmt4->execute(array($desde, $hasta, 1));
			$result4 = $stmt4->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result4)) {
				$dataFound = true;
				$result['consulta4'] = $result4;
			} else {
				$result['consulta4'] = "n/a";
			}
			$stmt5 =  $this->dbh->prepare($consulta5);
			$stmt5->execute(array($desde, $hasta, 1));
			$result5 = $stmt5->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result5)) {
				$dataFound = true;
				$result['consulta5'] = $result5;
			} else {
				$result['consulta5'] = "n/a";
			}
			$stmt6 =  $this->dbh->prepare($consulta6);
			$stmt6->execute(array($desde, $hasta, 1));
			$result6 = $stmt6->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result6)) {
				$dataFound = true;
				$result['consulta6'] = $result6;
			} else {
				$result['consulta6'] = "n/a";
			}
			$stmt7 =  $this->dbh->prepare($consulta7);
			$stmt7->execute(array($desde, $hasta, 1));
			$result7 = $stmt7->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result7)) {
				$dataFound = true;
				$result['consulta7'] = $result7;
			} else {
				$result['consulta7'] = "n/a";
			}
			$stmt8 =  $this->dbh->prepare($consulta8);
			$stmt8->execute(array($desde, $hasta, 1));
			$result8 = $stmt8->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result8)) {
				$dataFound = true;
				$result['consulta8'] = $result8;
			} else {
				$result['consulta8'] = "n/a";
			}
			$stmt9 =  $this->dbh->prepare($consulta9);
			$stmt9->execute(array($desde, $hasta, 1, $desde, $hasta, 1, $desde, $hasta, 1, $desde, $hasta, 1, $desde, $hasta, 1));
			$result9 = $stmt9->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result9)) {
				$dataFound = true;
				$result['consulta9'] = $result9;
			} else {
				$result['consulta9'] = "n/a";
			}
			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
	public function reporte7($datos)
	{

		$desde = $datos['desde_fecha'];
		$hasta = $datos['hasta_fecha'];
		$estatus = $datos['estatus'];
		$activo = '1';
		
		//Consulta por dependencia
		$consulta6="SELECT des_dependencia,COUNT(*) AS Numero FROM tbl_can_expediente AS tce
					INNER JOIN tbl_can_dependencia AS tcd ON tce.can_folio_expediente = tcd.exp_clave_caso
					INNER JOIN cat_dependencias AS cat_dep ON tcd.id_dependencia_fk=cat_dep.id_dependencia
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo =1
					AND		estatus_expediente=?
					GROUP BY des_dependencia
					ORDER BY Numero desc
		";
		// Variable de bandera para verificar si se encontraron datos
		$dataFound = false;
		try {
			
			$stmt =  $this->dbh->prepare($consulta6);
			$stmt->execute(array($desde, $hasta, $estatus));
			$result = $stmt->fetchAll(PDO::FETCH_CLASS);
			if (!empty($result)) {
				$dataFound = true;
				$result['consulta1'] = $result;
			} else {
				$result['consulta1'] = "n/a";
			}
			// Si al menos una consulta trajo resultados, agregar a $aData
			if ($dataFound) {
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
				);
			} else {
				$aData = array(
					"status"    => 204,
					"message"   => "No se encontraron datos"
				);
			}
		} catch (PDOException $e) {
			$aData = array(
				"status"    => 400,
				"message"   => $e->getMessage()
			);
		}
		return json_encode($aData);
	}
}
