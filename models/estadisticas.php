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
									sum(case when 	can_sexo_victima = 'Hombre' then 1 else 0 end) Hombre,
									sum(case when 	can_sexo_victima = 'Mujer' then 1 else 0 end) Mujer,
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
	public function con_ran_fec_sex($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 	can_sexo_victima As Genero,
												can_fecha,
												can_folio_expediente,
												can_exp_folio_victima,
												COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE	can_fecha = ? AND can_fecha = ?
									GROUP BY 	can_sexo_victima	
										");
		if ($sql->execute(array($fecha_in,$fecha_fin))) {
			return 'consul_genero';
		} else
			return 'error';	

	}
	public function lista_consulta_sexo($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 	can_sexo_victima As Genero,
												COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE	can_fecha BETWEEN  ? AND ?
										AND		activo = ?
									GROUP BY 	can_sexo_victima	
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function total_consulta_sexo($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 	can_sexo_victima As Genero,
												COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE	can_fecha BETWEEN  ? AND ?
									GROUP BY 	can_sexo_victima	
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_sexo($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(*) AS Total 
										FROM 		(tbl_can_victimas 
										LEFT JOIN 	tbl_can_expediente 
										ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										AND			activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	//Consulta por Delito
	public function obtener_consul_delito($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		delito AS Delito,COUNT(*) AS Numero
										FROM 		((tbl_can_delitos_victimas
										LEFT JOIN	tbl_can_expediente
										ON			tbl_can_delitos_victimas.can_exp_folio_delito=tbl_can_expediente.can_folio_expediente)
										LEFT JOIN  	cat_tipos_delitos
										ON 			tbl_can_delitos_victimas.can_delito=cat_tipos_delitos.id_delito)
										WHERE 		can_fecha BETWEEN ? AND ?
										GROUP BY 	delito
										ORDER BY	id_delito
										");
		if ($sql->execute(array($fecha_in,$fecha_fin))) {
			return 'consul_delito';
			
		} else
			return 'error';	

	}
	public function lista_consulta_delito($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		can_delito,delito, count(*) as Numero
										FROM 		((tbl_can_delitos_victimas
										LEFT JOIN	tbl_can_expediente
										ON			tbl_can_delitos_victimas.can_exp_folio_delito=tbl_can_expediente.can_folio_expediente)
										LEFT JOIN  	cat_tipos_delitos
										ON 			(tbl_can_delitos_victimas.can_delito=cat_tipos_delitos.id_delito))
										WHERE 		can_fecha BETWEEN ? AND ?
										GROUP BY	delito
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row = $sql->fetchAll();
			
			return $row;
			

	}
	public function obtener_total_delito($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(*) AS Total 
										FROM 		((tbl_can_delitos_victimas
										LEFT JOIN	tbl_can_expediente
										ON			tbl_can_delitos_victimas.can_exp_folio_delito=tbl_can_expediente.can_folio_expediente)
										LEFT JOIN  	cat_tipos_delitos
										ON 			tbl_can_delitos_victimas.can_delito=cat_tipos_delitos.id_delito)
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function fn_lista_delitos()
	{
		$sql = $this->dbh->prepare("select id_delito, delito FROM cat_tipos_delitos GROUP BY id_delito");
		$sql->execute();
		$row = $sql->fetchAll();
		return $row;
	}
	//Consulta por Edad
	public function obtener_consul_edad($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 	can_edad_vic AS Edad ,COUNT(*) AS Numero
										FROM 	(tbl_can_victimas
									LEFT JOIN	tbl_can_expediente
										ON		tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 	can_fecha 
										BETWEEN	?
										AND 	?
										GROUP BY 	can_edad_vic
										ORDER BY	can_edad_vic
										");
		if ($sql->execute(array($fecha_in,$fecha_fin))) {
			return 'consul_edades';
			
		} else
			return 'error';	

	}
	public function lista_consulta_edades($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			can_edad_vic AS Edad ,COUNT(*) AS Numero,
														can_per_tercera_edad,
														can_per_violencia,
														can_per_discapacidad,
														can_per_indigena,
														can_per_transgenero
										FROM 			(tbl_can_victimas
										LEFT JOIN		tbl_can_expediente
										ON				tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 			can_fecha 
										BETWEEN			?
										AND 			?
										AND				activo = ?
										GROUP BY 		can_edad_vic
										ORDER BY 		can_edad_vic ASC
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_edades($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		sum(Case When 	can_edad_vic <=18 then 1 ELSE 0 END) AS Total
										FROM 		(tbl_can_victimas 
										LEFT JOIN 	tbl_can_expediente 
										ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		?
										AND			activo = ? 
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function obtener_total_edades_mayores($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		sum(Case When can_edad_vic >=19 then 1 ELSE 0 END) AS Total
										FROM 		(tbl_can_victimas 
										LEFT JOIN 	tbl_can_expediente 
										ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										AND 		activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function lista_consulta_agresion($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			sum(Case When 	can_per_tercera_edad then 1 ELSE 0 END) AS persona_tercera,
														sum(Case When 	can_per_violencia then 1 ELSE 0 END) AS persona_violencia,
														sum(Case When 	can_per_discapacidad then 1 ELSE 0 END) AS persona_discapacidad,
														sum(Case When 	can_per_indigena then 1 ELSE 0 END) AS persona_indigena,
														sum(Case When 	can_per_transgenero then 1 ELSE 0 END) AS persona_transgenero
										FROM 			(tbl_can_victimas
										LEFT JOIN		tbl_can_expediente
										ON				tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
										WHERE 			can_fecha 
										BETWEEN			?
										AND 			?
										AND				activo = ?										
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_agresion($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT persona_tercera,persona_violencia,persona_discapacidad,persona_indigena,persona_transgenero,
												(persona_tercera+persona_violencia+persona_discapacidad+persona_indigena+persona_transgenero) AS Total
												FROM
													(SELECT			sum(Case When 	can_per_tercera_edad then 1 ELSE 0 END) AS persona_tercera,
																	sum(Case When 	can_per_violencia then 1 ELSE 0 END) AS persona_violencia,
																	sum(Case When 	can_per_discapacidad then 1 ELSE 0 END) AS persona_discapacidad,
																	sum(Case When 	can_per_indigena then 1 ELSE 0 END) AS persona_indigena,
																	SUM(Case When 	can_per_transgenero then 1 ELSE 0 END) AS persona_transgenero
													FROM 			(tbl_can_victimas 
													LEFT JOIN 	tbl_can_expediente 
													ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
													WHERE 		can_fecha 
													BETWEEN 		?
													AND 			?
													AND 			activo = ?
													) AS tabla_Z	
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	//Consulta por Mes
	public function obtener_consul_mes($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT can_fecha,MONTH(can_fecha)Mes , COUNT(*) AS Numero
										FROM 	tbl_can_expediente
										WHERE can_fecha BETWEEN ? AND ?
										GROUP BY 	Mes
										ORDER BY	Mes
										");
		if ($sql->execute(array($fecha_in,$fecha_fin))) {
			return 'consul_mes';
			
		} else
			return 'error';	

	}
	public function lista_consulta_mes($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare(" 	SELECT 		can_fecha,MONTH(can_fecha)Mes , COUNT(*) AS Numero
											FROM 		tbl_can_expediente
											WHERE		can_fecha BETWEEN ? AND ?
											AND			activo=?
											GROUP BY 	Mes
											ORDER BY	Mes ASC;
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_mes($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(*) AS Total 
										FROM 		tbl_can_expediente 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										AND			activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	//Consulta por Municipo
	public function lista_consulta_mun($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare(" 	SELECT 		can_pais,can_estado,can_otros_estados,estado,can_mun_edo,can_municipio,
														municipio,COUNT(*) AS Numero
											FROM 		((tbl_can_expediente
											LEFT JOIN 	cat_municipios
											on			tbl_can_expediente.can_municipio=cat_municipios.id_municipio)
											LEFT JOIN 	cat_estados
											ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
											WHERE 		can_fecha 
											BETWEEN 	? AND ?
											GROUP BY 	can_municipio	
											ORDER BY	can_municipio
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_consul_mun($fecha_in,$fecha_fin)
	{
	
			$sql = $this->dbh->prepare("SELECT 		can_pais,estado,municipio, can_municipio,COUNT(*) AS Numero
										FROM 		((tbl_can_expediente
										LEFT JOIN 	cat_municipios
										ON 			tbl_can_expediente.can_municipio= cat_municipios.id_municipio)
										LEFT JOIN 	cat_estados
										ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
										WHERE 		can_fecha 
										BETWEEN 	? AND ?
										GROUP BY 	municipio
										ORDER BY	municipio
										");
		if ($sql->execute(array($fecha_in,$fecha_fin))) {
			return 'consul_mun';
			
		} else
			return 'error';	

	}
	public function obtener_total_mun($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		sum(Case When can_municipio then 1 ELSE 0 END) AS Total 
										FROM 		(tbl_can_expediente 
										LEFT JOIN 	cat_municipios 
										ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	//Obtener consulta por Estado Diferente
	
	public function lista_consulta_edo_mun($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare(" 	SELECT 		can_pais,can_estado,estado,can_mun_edo,COUNT(*) AS Numero
											FROM 		(tbl_can_expediente
											LEFT JOIN 	cat_estados
											ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
											WHERE 		can_fecha 
											BETWEEN 	? AND ?
											GROUP BY 	can_estado
											ORDER BY	can_estado
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_edo_mun($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(Case When can_mun_edo !='0' then 1 ELSE 0 END) AS Total,
													can_estado
										FROM 		tbl_can_expediente 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	//Obtener consulta por Pais Diferente
	public function lista_consulta_pais($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare(" 	SELECT 		can_pais,can_estado,can_otros_estados,estado,can_mun_edo,can_municipio,
														municipio,COUNT(*) AS Numero
											FROM 		((tbl_can_expediente
											LEFT JOIN 	cat_municipios
											on			tbl_can_expediente.can_municipio=cat_municipios.id_municipio)
											LEFT JOIN 	cat_estados
											ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
											WHERE 		can_fecha 
											BETWEEN 	? AND ?
											GROUP BY 	can_pais	
											ORDER BY	can_pais
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_pais($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
			$sql = $this->dbh->prepare("SELECT 		can_pais as pais 
										FROM 		(tbl_can_expediente 
										LEFT JOIN 	cat_municipios 
										ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
										WHERE 		can_fecha 
										BETWEEN 	? 
										AND 		? 
										");
			$sql->execute(array($fecha_in,$fecha_fin));
			$row2 = $sql->fetchAll();
			return $row2;
			print_r($row2);
	}

	///Consultas de c4 
	///
	/// Consulta por municipio
	public function obtener_consul_mun_c4($fecha_in,$fecha_fin)
	{
	
			$sql = $this->dbh->prepare("SELECT 		c4_pais,c4_edo,c4_mun,c4_mun_edo,COUNT(*) AS Numero
										FROM 		((tbl_c4_expedientes
										LEFT JOIN 	cat_municipios
										ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
										LEFT JOIN 	cat_estados
										ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
										WHERE 		c4_fecha_inicio
										BETWEEN 	? AND ?
										AND 		activo = ?
										GROUP BY 	municipio
										ORDER BY	municipio
										");
		if ($sql->execute(array($fecha_in,$fecha_fin,1))) {
			return 'consul_mun_c4';
			
		} else
			return 'error';	

	}
	public function lista_consulta_mun_c4($fecha_in,$fecha_fin)
	{
	
				$sql = $this->dbh->prepare("SELECT 		municipio,c4_pais,c4_edo,c4_mun,c4_mun_edo,COUNT(*) AS Numero
											FROM 		((tbl_c4_expedientes
											LEFT JOIN 	cat_municipios
											ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
											LEFT JOIN 	cat_estados
											ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
											WHERE 		c4_fecha_inicio
											BETWEEN 	? AND ?
											AND 		activo = ?

											GROUP BY 	municipio
											ORDER BY	municipio
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;
		 

	}
	public function obtener_total_mun_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		sum(Case When c4_mun then 1 ELSE 0 END) AS Total 
										FROM 		(tbl_c4_expedientes 
										LEFT JOIN 	cat_municipios 
										ON 			tbl_c4_expedientes.c4_mun=cat_municipios.id_municipio) 
										WHERE 		c4_fecha_inicio 
										BETWEEN 	? 
										AND 		? 
										AND 		activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}

	// Consulta por genero 
	public function obtener_consul_genero_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 	c4_sexo_victima As Genero,
												COUNT(*) AS Numero
										FROM 	(tbl_c4_victimas
									LEFT JOIN	tbl_c4_expedientes
										ON		tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
										WHERE	c4_fecha_inicio 
										BETWEEN ?
										AND 	?
										AND		activo = ?	
									GROUP BY 	c4_sexo_victima	
										");
			if ($sql->execute(array($fecha_in,$fecha_fin,1))) {
				return 'consul_genero_c4';
				
			} else
				return 'error';	

	}
	public function lista_consulta_gen_c4($fecha_in,$fecha_fin)
	{
	
			$sql = $this->dbh->prepare("	SELECT 	c4_sexo_victima As Genero,
													COUNT(*) AS Numero
											FROM 	(tbl_c4_victimas
										LEFT JOIN	tbl_c4_expedientes
											ON		tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
											WHERE	c4_fecha_inicio 
											BETWEEN ? 
											AND 	?
											AND 	activo = ?
										GROUP BY 	c4_sexo_victima	
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;
		 

	}
	public function obtener_total_gen_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(*) AS Total 
										FROM 		(tbl_c4_victimas 
										LEFT JOIN 	tbl_c4_expedientes 
										ON 			tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio) 
										WHERE 		c4_fecha_inicio
										BETWEEN 	? 
										AND 		? 
										AND 		activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function lista_consulta_edades_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero,
														c4_per_tercera_edad,
														c4_per_violencia,
														c4_per_discapacidad,
														c4_per_indigena,
														c4_per_transgenero
										FROM 			(tbl_c4_victimas
										LEFT JOIN		tbl_c4_expedientes
										ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
										WHERE 			c4_fecha_inicio 
										BETWEEN			?
										AND 			?
										AND 			activo = ?
										GROUP BY 		Edad
										ORDER BY 		Edad ASC
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_edades_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		sum(Case When 	c4_edad_victima <=18 then 1 ELSE 0 END) AS Total
										FROM 		(tbl_c4_victimas 
										LEFT JOIN 	tbl_c4_expedientes 
										ON 			tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio) 
										WHERE 		c4_fecha_inicio 
										BETWEEN 	? 
										AND 		? 
										AND 		activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function lista_consulta_edades_mayores_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			c4_edad_victima AS Edad 
														,COUNT(*) AS Numero,
														c4_per_tercera_edad,
														c4_per_violencia,
														c4_per_discapacidad,
														c4_per_indigena,
														c4_per_transgenero
										FROM 			(tbl_c4_victimas
										LEFT JOIN		tbl_c4_expedientes
										ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
										WHERE 			c4_fecha_inicio 
										BETWEEN			?
										AND 			?
										AND 			activo = ?
										
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_edades_mayores_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		sum(Case When c4_edad_victima >=19 then 1 ELSE 0 END) AS Total
										FROM 		(tbl_c4_victimas 
										LEFT JOIN 	tbl_c4_expedientes 
										ON 			tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio) 
										WHERE 		c4_fecha_inicio 
										BETWEEN 	? 
										AND 		? 
										AND 		activo = ? 
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function obtener_consul_mes_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 	can_fecha,MONTH(can_fecha)Mes , COUNT(*) AS Numero
										FROM 	tbl_can_expediente
										WHERE 	can_fecha 
										BETWEEN ? 
										AND 	?
										AND 	?
										GROUP BY 	Mes
										ORDER BY	Mes
										");
		if ($sql->execute(array($fecha_in,$fecha_fin,1))) {
			return 'consul_mes_c4';
			
		} else
			return 'error';	

	}
	public function lista_consulta_mes_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare(" 	SELECT 		c4_fecha_inicio,MONTH(c4_fecha_inicio)Mes , COUNT(*) AS Numero
											FROM 		tbl_c4_expedientes
											WHERE		c4_fecha_inicio BETWEEN ? AND ?
											AND 		activo = ?
											GROUP BY 	Mes
											ORDER BY	Mes ASC;
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_mes_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(*) AS Total 
										FROM 		tbl_c4_expedientes 
										WHERE 		c4_fecha_inicio 
										BETWEEN 	? 
										AND 		? 
										AND			activo = ?
										
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function lista_consulta_delito_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		c4_delito,delito,
													count(*) as Numero
													
										FROM 		((tbl_c4_delitos_victimas
										LEFT JOIN	tbl_c4_expedientes
										ON			tbl_c4_delitos_victimas.c4_exp_folio_delito=tbl_c4_expedientes.c4_exp_folio)
										LEFT JOIN  	cat_tipos_delitos
										ON 			tbl_c4_delitos_victimas.c4_delito=cat_tipos_delitos.id_delito)
										WHERE 		c4_fecha_inicio BETWEEN ? AND ?
										AND 		activo = ?
										GROUP BY 	delito
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			
			return $row;
			

	}
	public function obtener_total_delito_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 		COUNT(*) AS Total 
										FROM 		((tbl_c4_delitos_victimas
										LEFT JOIN	tbl_c4_expedientes
										ON			tbl_c4_delitos_victimas.c4_exp_folio_delito=tbl_c4_expedientes.c4_exp_folio)
										LEFT JOIN  	cat_tipos_delitos
										ON 			tbl_c4_delitos_victimas.c4_delito=cat_tipos_delitos.id_delito)
										WHERE 		c4_fecha_inicio 
										BETWEEN 	? 
										AND 		? 
										AND			activo = ?
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function lista_per_vul_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			sum(Case When 	c4_per_tercera_edad then 1 ELSE 0 END) AS persona_tercera,
														sum(Case When 	c4_per_violencia then 1 ELSE 0 END) AS persona_violencia,
														sum(Case When 	c4_per_discapacidad then 1 ELSE 0 END) AS persona_discapacidad,
														sum(Case When 	c4_per_indigena then 1 ELSE 0 END) AS persona_indigena,
														sum(Case When 	c4_per_transgenero then 1 ELSE 0 END) AS persona_transgenero
										FROM 			(tbl_c4_victimas
										LEFT JOIN		tbl_c4_expedientes
										ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
										WHERE 			c4_fecha_inicio 
										BETWEEN			?
										AND 			?
										AND 			activo = ?										
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function obtener_total_per_vul_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT persona_tercera,persona_violencia,persona_discapacidad,persona_indigena,persona_transgenero,
												(persona_tercera+persona_violencia+persona_discapacidad+persona_indigena+persona_transgenero) AS Total
												FROM
													(SELECT			sum(Case When 	c4_per_tercera_edad then 1 ELSE 0 END) AS persona_tercera,
																	sum(Case When 	c4_per_violencia then 1 ELSE 0 END) AS persona_violencia,
																	sum(Case When 	c4_per_discapacidad then 1 ELSE 0 END) AS persona_discapacidad,
																	sum(Case When 	c4_per_indigena then 1 ELSE 0 END) AS persona_indigena,
																	SUM(Case When 	c4_per_transgenero then 1 ELSE 0 END) AS persona_transgenero
													FROM 			(tbl_c4_victimas 
													LEFT JOIN 	tbl_c4_expedientes 
													ON 			tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio) 
													WHERE 		c4_fecha_inicio 
													BETWEEN 		?
													AND 			?
													AND 		activo = ?
													) AS tabla_Z	
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row2 = $sql->fetchAll();
			return $row2;

	}
	public function lista_casos_can($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			can_fecha,count(*) as Numero
										FROM			tbl_can_expediente
										WHERE 			can_fecha 
										BETWEEN			?
										AND 			?	
										AND				activo = ?									
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	public function lista_casos_c4($fecha_in,$fecha_fin)
	{
		//  print_r($dato);
		//  die();
		
			$sql = $this->dbh->prepare("SELECT 			c4_fecha_inicio,count(*) as Numero
										FROM			tbl_c4_expedientes
										WHERE 			c4_fecha_inicio
										BETWEEN			?
										AND 			?	
										AND 			activo =?									
										");
			$sql->execute(array($fecha_in,$fecha_fin,1));
			$row = $sql->fetchAll();
			return $row;

	}
	
}
