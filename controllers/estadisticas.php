<?php
require_once('../models/estadisticas.php');
$v = new Estadisticas();
session_start();

$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

if (isset($_POST['func'])) {
	switch ($_POST['func']) {
		case 'fn_obtener_reporte':
			$desde=$_POST["desde_fecha"];
			$hasta=$_POST["hasta_fecha"];
			if ($_POST["gen_reporte"] == 1) { //Canalizacion 
				if ($_POST["id_reporte"] == 1) {
					//Municipios de veracruz
					$lista_mun = $v->obtener_consul_mun($desde, $hasta);
					//Pais Mexico Estado diferente a veracruz
					$lista_edo = $v->lista_consulta_edo_mun($desde,$hasta);
					//Paises diferentes a mexico
					$lista_pais = $v->lista_consulta_pais($desde,$hasta);
					// Agrupa los resultados en un array
					$resultados = array('lista_mun' => $lista_mun,'lista_edo' => $lista_edo,'lista_pais' => $lista_pais);
					// Convierte el array a formato JSON para enviarlo
					 echo json_encode($resultados);
				} 
			}
			
		break;
			///Numero de casos 
		
		}
}
