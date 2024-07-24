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
	public function obtener_consul_mun($estatus, $fecha_in, $fecha_fin)
	{
		$consulta = "	SELECT 		can_pais,estado,municipio, can_municipio,COUNT(*) AS Numero
						FROM 		((tbl_can_expediente
						LEFT JOIN 	cat_municipios
						ON 			tbl_can_expediente.can_municipio= cat_municipios.id_municipio)
						LEFT JOIN 	cat_estados
						ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
						WHERE 		can_fecha 
						BETWEEN 	? AND ?
						AND			activo = ?
						AND 		can_estado='30'
						AND 		estatus_expediente=?
						GROUP BY 	municipio
						ORDER BY	numero desc";

		try {
			$stmt = $this->dbh->prepare($consulta);
			$stmt->execute(array($fecha_in,$fecha_fin,1,$estatus));
			$filas = $stmt->rowCount();
			if ($filas > 0) {
				$result = $stmt->fetchAll(PDO::FETCH_CLASS);
				
				$aData = array(
					"status"    => 200,
					"message"   => "Proceso completado",
					"data"      => $result
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
