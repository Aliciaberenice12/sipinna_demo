<?php
require_once('../models/estadisticas.php');
$v = new Estadisticas();
session_start();
$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

if (isset($_POST['data']['func'])) {
	switch ($_POST['data']['func']) {
		case 'listar':
			$gen_reporte =$_POST['data']['datos']['gen_reporte'];
			$id_reporte =$_POST['data']['datos']['id_reporte'];

			if($gen_reporte =='1'){
				if($id_reporte == '1'){
					$result = $v->reporte1($_POST['data']['datos']);
				}
				else if($id_reporte =='2'){
					$result = $v->reporte2($_POST['data']['datos']);
				}
				else if($id_reporte =='3'){
					$result = $v->reporte3($_POST['data']['datos']);
				}
				else if($id_reporte =='4'){
					$result = $v->reporte7($_POST['data']['datos']);
				}
				
			}else if($gen_reporte =='2'){
				if($id_reporte == '1'){
					$result = $v->reporte4($_POST['data']['datos']);
				}
				if($id_reporte == '2'){
					$result = $v->reporte5($_POST['data']['datos']);
				}
				if($id_reporte == '3'){
					$result = $v->reporte6($_POST['data']['datos']);
				}
			}
			echo $result;
			
			break;

		}
}