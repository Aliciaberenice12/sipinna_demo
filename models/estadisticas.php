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
	public function lista_consulta_sexo_mun()
	{
		// print_r($datos_de_consulta);
		//  die();
		$sql = $this->dbh->prepare("SELECT			municipio,
									sum(case when 	can_sexo_victima = 'Masculino' then 1 else 0 end) Masculino,
									sum(case when 	can_sexo_victima = 'Femenino' then 1 else 0 end) Femenino,
									sum(case when	can_sexo_victima = 'N/I' then 1 else 0 END) Desconocido
									FROM 			((tbl_can_expediente
									INNER JOIN 		tbl_can_victimas 
									ON 				tbl_can_expediente.can_folio_expediente = tbl_can_victimas.can_exp_folio_victima )
									INNER JOIN 		cat_municipios
									ON 				tbl_can_expediente.can_municipio = cat_municipios.id_municipio)
								
									GROUP BY municipio
									");

		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
	public function con_ran_fec_sex($datos_de_consulta)
	{
		// print_r($datos_de_consulta);
		//  die();
		$sql = $this->dbh->prepare("SELECT			municipio,
									sum(case when 	can_sexo_victima = 'Masculino' then 1 else 0 end) Masculino,
									sum(case when 	can_sexo_victima = 'Femenino' then 1 else 0 end) Femenino,
									sum(case when	can_sexo_victima = 'N/I' then 1 else 0 END) Desconocido
									FROM 			((tbl_can_expediente
									INNER JOIN 		tbl_can_victimas 
									ON 				tbl_can_expediente.can_folio_expediente = tbl_can_victimas.can_exp_folio_victima )
									INNER JOIN 		cat_municipios
									ON 				tbl_can_expediente.can_municipio = cat_municipios.id_municipio)
								
									GROUP BY municipio
									");

		$sql->execute(array());
		$row = $sql->fetchAll();
		return $row;
	}
}
