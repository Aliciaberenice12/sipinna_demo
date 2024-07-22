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
	public function obtener_consul_mun($fecha_in,$fecha_fin)
	{
	
		$consulta=("SELECT 
					municipio,COUNT(*) AS Numero
					FROM 		((tbl_can_expediente
					LEFT JOIN 	cat_municipios
					ON 			tbl_can_expediente.can_municipio= cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo = ?
					GROUP BY 	municipio
					ORDER BY	municipio
					");
		try {
			$stmt = $this->dbh->prepare($consulta);
			$stmt->execute(array($fecha_in, $fecha_fin,1));
			$filas = $stmt->rowCount();
			if ($filas > 0) {
				$result = $stmt->fetchAll(PDO::FETCH_CLASS);
				$sql = $this->dbh->prepare("SELECT
					sum(Case When can_municipio then 1 ELSE 0 END) AS Total 
					FROM 		(tbl_can_expediente 
					LEFT JOIN 	cat_municipios 
					ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
					WHERE 		can_fecha 
					BETWEEN 	? 
					AND 		?
					AND 		activo = ? 
				");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$total = $sql->fetchAll();                    
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data_1"    => $result,
					"tdata_1"	=>$total
				);
			} else {
    
				$aData = array(
					"status"    => 400,
					"message"   => "Sin datos que mostrar"
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
	public function lista_consulta_edo_mun($fecha_in,$fecha_fin)
	{
	
		$consulta=("SELECT 		can_estado,estado,can_mun_edo,COUNT(*) AS Numero			
					FROM 		(tbl_can_expediente
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND			activo =?
					GROUP BY 	can_estado
					ORDER BY	can_estado
					");
		try {
			$stmt = $this->dbh->prepare($consulta);
			$stmt->execute(array($fecha_in, $fecha_fin,1));
			$filas = $stmt->rowCount();
			if ($filas > 0) {
				$result = $stmt->fetchAll(PDO::FETCH_CLASS);
				$sql = $this->dbh->prepare("SELECT
					sum(Case When can_municipio then 1 ELSE 0 END) AS Total 
					FROM 		(tbl_can_expediente 
					LEFT JOIN 	cat_municipios 
					ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
					WHERE 		can_fecha 
					BETWEEN 	? 
					AND 		?
					AND 		activo = ? 
				");
				$sql->execute(array($fecha_in,$fecha_fin,1));
				$total = $sql->fetchAll();     
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data_2"    => $result,
					"tdata_2"	=>$total
				);
			} else {
    
				$aData = array(
					"status"    => 400,
					"message"   => "Sin datos que mostrar"
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
	public function lista_consulta_pais($fecha_in,$fecha_fin)
	{
		
		$consulta=("SELECT 		can_pais,COUNT(*) AS Numero
					FROM 		((tbl_can_expediente
					LEFT JOIN 	cat_municipios
					on			tbl_can_expediente.can_municipio=cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
					WHERE 		can_fecha 
					BETWEEN 	? AND ?
					AND 		activo= ?
					GROUP BY 	can_pais	
					ORDER BY	can_pais
					");
		try {
			$stmt = $this->dbh->prepare($consulta);
			$stmt->execute(array($fecha_in, $fecha_fin,1));
			$filas = $stmt->rowCount();
			if ($filas > 0) {
				$result = $stmt->fetchAll(PDO::FETCH_CLASS);
				$sql = $this->dbh->prepare("SELECT
										can_pais as pais, SUM(can_pais != 'Mexico') AS total 
										FROM 		(tbl_can_expediente 
										LEFT JOIN 	cat_municipios 
										ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
										WHERE 		can_fecha 
										BETWEEN 	? AND ? 
										AND 		activo =?
				");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$total = $sql->fetchAll();                    
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data_3"    => $result,
					"tdata_3"	=>$total
				);
			} else {
    
				$aData = array(
					"status"    => 400,
					"message"   => "Sin datos que mostrar"
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
