<?php
require_once('../models/estadisticas.php');
$v = new Estadisticas();
session_start();
   
$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

if (isset($_POST['func'])) {
    switch ($_POST['func']) {
        case 'fn_listar_consulta_sexo_municipio':
            $arr_res = $v->lista_consulta_sexo_mun();

            $size    = sizeof($arr_res);

            if (empty($arr_res)) {
                $html =
                    '
				<center>
					<h4>¡ No hay datos de municipios !</h4>
				</center>';
            } else {
                $html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_con_sexo" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th>
									Municipios Veracruz
								</th>
								<th>
									Suma Masculino
								</th>
								<th>
									Suma Femenino
								</th>
								<th>
									Suma N/I
								</th>
								<th>
									Numero Delitos
								</th>
								<th>
									Suma de Casos
								</th>
								
							</tr>
							</thead>
							<tbody>';
                foreach ($arr_res as $row) {
                    $session  = 3;

                    $html .= '
								<tr class="text-11" align="center" id="l_con_sexo' . $row["municipio"] . '">
									<div class="row">
										
										<td class="col-md-3">
											<div>
											' . $row["municipio"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["Hombre"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											
											' . $row["Mujer"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											
											' . $row["Desconocido"] . '
											</div>
										</td>
										<td class="col-md-1">
											
										</td>	
										<td class="col-md-1">
											<div >

											</div>
										</td>								
										
									</div>
								</tr>';
                }
                $html .= '
							</tbody>
						</table>
					</div>
				</div>';
            }
            echo $html;
            break;
		
		case 'fn_obtener_reporte':
			if ($_POST["gen_reporte"] == 1){ //Canalizacion 
				if($_POST["id_reporte"] == 1){
				
					$estatus=$v->obtener_consul_mun($_POST["desde_fecha"],$_POST["hasta_fecha"]);
					// $estatus2=$v->obtener_total_mun($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 2){
					// echo' tipos de delitos';
					$estatus=$v->obtener_consul_delito($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 3){
					// echo' por edades';
					
					$estatus=$v->obtener_consul_mes($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 4){
					// echo' por Meses';
					$estatus=$v->obtener_consul_mun($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 5){
					// echo' por Municipio';
					$estatus=$v->obtener_consul_edad($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 6){
					$estatus=$v->con_ran_fec_sex($_POST["desde_fecha"],$_POST["hasta_fecha"]);

				}
				
				
			} 	
			else if ($_POST["gen_reporte"] == 2){
				if($_POST["id_reporte"] == 1){//Casos de c4
				
					$estatus=$v->obtener_consul_mun_c4($_POST["desde_fecha"],$_POST["hasta_fecha"]);
					// $estatus2=$v->obtener_total_mun($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 2){//Casos de c4 General sin municipio
				
					$estatus=$v->obtener_consul_genero_c4($_POST["desde_fecha"],$_POST["hasta_fecha"]);
					// $estatus2=$v->obtener_total_mun($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				else if($_POST["id_reporte"] == 3){//Casos de c4 General sin municipio
				
					$estatus=$v->obtener_consul_mes_c4($_POST["desde_fecha"],$_POST["hasta_fecha"]);
					// $estatus2=$v->obtener_total_mun($_POST["desde_fecha"],$_POST["hasta_fecha"]);
				}
				
				
			}
		
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		///Numero de casos 
		case 'fun_listar_numero_casos':
			if($_POST['gen_reporte']=='1'){
				$desde=$_POST['desde_fecha'];
				$hasta=$_POST['hasta_fecha'];
				$desde_mes=explode('-',$_POST['desde_fecha']);
				$hasta_mes=explode('-',$_POST['hasta_fecha']);
 

				
			$casos_can = $v->lista_casos_can($desde,$hasta);
			if (empty($casos_can)) {
				$html =
					'
				<center>
					<h4>¡ No hay datos Número de casos !</h4>
				</center>';
			} else {
				$html = '  
				<div class="row">
					
					<div class="col-md-12">
					
						<table id="tbl_consulta_num_caso" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
								Número de denuncias recibidas del mes de ' .$Meses[ $desde_mes[1]-1] . ' del año '.$desde_mes[0].'  a ' .$Meses[ $hasta_mes[1]-1] . ' del año '.$hasta_mes[0].'
								</th>			
							</tr>
							</thead>
							<tbody>';
				foreach ($casos_can as $row) {
					$session  = 3;

					$html .= '
								<tr class="text-11" align="center" id="l_con_sexo">
										<td>
											' . $row["Numero"] . '
										</td>
										
								</tr>';
								
				}
				
				$html .= '
							</tbody>
							
						</table>
					</div>
				</div>';
				
			}
			echo $html;
			}
			else if($_POST['gen_reporte']=='2'){

			}
			break;
		case 'fun_listar_numero_casos_c4':
			if ($_POST['gen_reporte'] == '2') {
				$desde = $_POST['desde_fecha'];
				$hasta = $_POST['hasta_fecha'];
				$desde_mes = explode('-', $_POST['desde_fecha']);
				$hasta_mes = explode('-', $_POST['hasta_fecha']);
				$casos_c4 = $v->lista_casos_c4($desde, $hasta);
				if (empty($casos_c4)) {
					$html =
						'
				<center>
					<h4>¡ No hay datos Número de casos !</h4>
				</center>';
				} else {
					$html = '  
				<div class="row">
					
					<div class="col-md-12">
					
						<table id="tbl_consulta_num_caso" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
								Número de denuncias recibidas del mes de ' . $Meses[$desde_mes[1] - 1] . ' del año ' . $desde_mes[0] . '  a ' . $Meses[$hasta_mes[1] - 1] . ' del año ' . $hasta_mes[0] . '
								</th>			
							</tr>
							</thead>
							<tbody>';
					foreach ($casos_c4 as $row) {
						$session  = 3;

						$html .= '
								<tr class="text-11" align="center" id="l_con_sexo">
										<td>
											' . $row["Numero"] . '
										</td>
										
								</tr>';
					}

					$html .= '
							</tbody>
							
						</table>
					</div>
				</div>';
				}
				echo $html;
			} 
			break;

			

		//Canalizacion
		
		case 'fn_listar_consulta_genero':
			
			$arr_res = $v->lista_consulta_sexo($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2 = $v->obtener_total_sexo($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por genero en el rango de fechas !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					
					<div class="col-md-12">
					
						<table id="tbl_consulta_genero" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Genero
								</th>
								<th>
									Número
								</th>
										
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;

					$html .= '
								<tr class="text-11" align="center" id="l_con_sexo">
										<td>
											' . $row["Genero"] . '
										</td>
										<td>
											' . $row["Numero"] . '
											
										</td>
								</tr>';
								
				}
				foreach ($arr_res2 as $row2) {
				$html .= '
							</tbody>
							<tfoot>

								<tr class="text-11"  align="center">
									<td><strong>Total</strong></td>
									<td>' . $row2["Total"] . '</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_delito':
			$arr_res = $v->lista_consulta_delito($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$arr_res2 = $v->obtener_total_delito($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_del = $v->fn_lista_delitos();
		
			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Delito !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_delito" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Delito
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				
				foreach ($arr_res as $row) 
				{
					$datos=explode(",",$row['can_delito']);
				
					foreach($datos as $dato){
						$session  = 3;
						print_r($datos);
					$html .= '
								<tr class="text-11" align="center" id="l_con_del">
										<td width="50%">
										'.$dato.'
										</td>								
										<td width="50%">
										
													
											
											
										</td>
								</tr>';		
					}
					
				}
				
				foreach ($arr_res2 as $row2) {
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center" >
									<td><strong>Total</strong></td>
									<td><strong>'.$row2['Total'].'</strong></td>

								</tr>

							</tfoot>
						</table>
					</div>
				</div>';
				}
				
			}
			echo $html;
			break;
		case 'fun_listar_consulta_edades':
			$arr_res = $v->lista_consulta_edades($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2 = $v->obtener_total_edades($_POST['desde_fecha'],$_POST['hasta_fecha']);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Edad  Menores de 18 años!</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_edades" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Edades NNA
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row_edad) {
					$session  = 3;
					if($row_edad["Edad"] <='18'){
					$html .= '
								<tr class="text-11" align="center" id="l_con_edad">
										<td width="50%">
										
											' . $row_edad["Edad"]  . ' Años
										</td>
										<td width="50%">
											
											' . $row_edad["Numero"] . '
										</td>
								</tr>
							
								
								';
					}
					
				}
				foreach ($arr_res2 as $row2) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2["Total"] . ' NNA</strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
					
				}

				/////		
			}
			echo $html;
			break;
		case 'fun_listar_consulta_edades_mayores':
			$arr_res_m = $v->lista_consulta_edades($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2_m = $v->obtener_total_edades_mayores($_POST['desde_fecha'],$_POST['hasta_fecha']);

			$size    = sizeof($arr_res_m);

			if (empty($arr_res_m)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Edad Mayores de 18 años !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_edades_mayores" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Edades > 18 Años
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res_m as $row_edad_m) {
					$session  = 3;
					if($row_edad_m["Edad"] >='19'){
					$html .= '
								<tr  align="center" id="l_con_edad_mayor">
										<td width="50%">
											
											' . $row_edad_m["Edad"]  . ' Años
										</td>
										<td width="50%">
											
											' . $row_edad_m["Numero"] . '
										</td>
								</tr>
							
								
								';
					}
					
				}
				foreach ($arr_res2_m as $row2_m) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr  align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2_m["Total"] . ' </strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
					
				}

				/////		
			}
			echo $html;
			break;
		case 'fun_listar_consulta_agresion':
			$arr_res_a = $v->lista_consulta_agresion($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2_a = $v->obtener_total_agresion($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$size    = sizeof($arr_res_a);

			if (empty($arr_res_a)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de  Personas vulnerables !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_agresion" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Personas Vulneradas
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res_a as $row_edad_a) {
					$session  = 3;
					
					$html .= '
								<tr  align="center" id="l_con_agresion">
										<td  class="tbl_div" width="50%">
												<div class="row col-md-12">
													<div class="tbl_div">
														Otros (personas de la tercera edad)
													</div>
													
													<div class="tbl_div">
														Persona Indigena	
													</div>
													<div class="tbl_div">
														Persona Trangenero
													</div>
													<div class="tbl_div">
														Persona Con alguna discapacidad
													</div>
													<div class="tbl_div">
														Violencia contra la mujer
													</div>
												</div>

										</td>
										<td class="tbl_div" width="50%">
											<div class="col-md-12">
												<div class="tbl_div">
													'.$row_edad_a['persona_tercera'].'
												</div>
											
												<div class="tbl_div">
													'.$row_edad_a['persona_indigena'].'
													
												</div>
													
												<div class="tbl_div">
													'.$row_edad_a['persona_transgenero'].'
													
												</div>
												
												<div class="tbl_div">
												'.$row_edad_a['persona_discapacidad'].'
												</div>
												
												<div class="tbl_div">
													
													'.$row_edad_a['persona_violencia'].'
												</div>
											</div>
											
										</td>
								</tr>
								
							
								
								';
					
					
				}
				foreach ($arr_res2_a as $row2_a) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr  align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2_a["Total"] . ' </strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
					
				}

				/////		
			}
			echo $html;
			break;			
		case 'fun_listar_consulta_mes':
			$gen_reporte=$_POST['gen_reporte'];
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_mes($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2 = $v->obtener_total_mes($_POST['desde_fecha'],$_POST['hasta_fecha']);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por mes en el rango de fecha !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class=" row col-md-12">
						<div class="col-md-6">
						</div>
						<div class="col-md-6" align="right">
							<button class="btn btn-secondary" onclick="modal_pdf(\'' . $gen_reporte . '\',\'' . $id_reporte . '\',\'' . $desde . '\',\'' . $hasta . '\')">
								<i class="bi bi-filetype-pdf"></i>Ver Pdf
							</button>
							<p></p>
						</div>
					</div>
					<div class="col-md-12">
						<table id="tbl_consulta_mes" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th>
									Mes
								</th>
								<th>
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;

					$html .= '
								<tr class="text-11" align="center" id="l_con_mes">
										<td>
											
											' .$Meses[ $row["Mes"]-1] . ' 
										</td>
										<td>
											' . $row["Numero"] . '
										</td>
								</tr>';
				}
				foreach ($arr_res2 as $row2) {
				$html .= '
							</tbody>
							<tfoot>
							<tr class="text-11" align="center" >
								<td><strong>Total</strong></td>
								<td><strong>' . $row2["Total"] . '</strong></td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>';
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_mun':
			
			$gen_reporte=$_POST['gen_reporte'];
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_mun($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$array_mun=$v->obtener_total_mun($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$size    = sizeof($arr_res);
			
			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Municipio !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class=" row col-md-12">
						
						<div class="col-md-6">
						</div>
						<div class="col-md-6" align="right">
							<button class="btn btn-secondary" onclick="modal_pdf(\'' . $gen_reporte . '\',\'' . $id_reporte . '\',\'' . $desde . '\',\'' . $hasta . '\')" id="exportarpdf_mun" name="exportarpdf_mun">
								<i class="bi bi-filetype-pdf"></i>Ver Pdf
							</button>
							<p></p>
						</div>
					
					</div>
					
					<div class="col-md-12">
						<table id="tbl_consulta_mun" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Municipio
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row_mun) {
					$session  = 3;
					if( $row_mun["can_estado"]=='30'){
					$html .= '
								<tr class="text-11" align="center" id="l_con_mes">
										<td width="50%">
											' .$row_mun["municipio"] . ' 
										</td>
										<td width="50%">
											' . $row_mun["Numero"] . '
										</td>
								</tr>';
					}
				}
				foreach ($array_mun as $row2) {
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2["Total"] . '</strong></td>
								</tr>

							</tfood>
						</table>
					</div>
				</div>';
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_edo_mun':
		
			$gen_reporte=$_POST['gen_reporte'];
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_edo_mun($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_edo_mun=$v->obtener_total_edo_mun($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$size    = sizeof($arr_res);
			
			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Municipio !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					
					
					<div class="col-md-12">
						<table id="tbl_consulta_mun_edo" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="25%">
									Estado
								</th>
								<th width="25%">
									Descripción estado
								</th>
								<th  width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row_mun) {
					$session  = 3;
					if( $row_mun["can_estado"]!='30' & $row_mun["can_estado"]!='0'){
					$html .= '
								<tr class="text-11" align="center" id="l_con_mun_can">
										<td  width="35%">
											' .$row_mun["estado"] . ' 
										</td>
										<td  width="35%">
											' .$row_mun["can_mun_edo"] . ' 
										</td>
										<td  width="30%">
											' . $row_mun["Numero"] . '
										</td>
								</tr>';
					}
				}
				foreach ($arr_edo_mun as $row_edo) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center">
									<td width="35%"><strong></strong></td>
									<td width="35%"><strong>Total</strong></td>
									<td width="30%"><strong></strong></td>
								</tr>

							</tfood>
						</table>
					</div>
				</div>';
					
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_pais_can':
	
			$gen_reporte=$_POST['gen_reporte'];
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_pais($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_pais=$v->obtener_total_pais($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$size    = sizeof($arr_res);
			
			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Pais Diferente a Mexico !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					
					
					<div class="col-md-12">
						<table id="tbl_consulta_pais" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="35%">
									Pais
								</th>
								<th  width="35%">
									Descripción Estado
								</th>
								<th  width="30%">
									Total
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row_mun) {
					$session  = 3;
				
					if($row_mun['can_pais']!='México'){
						
					$html .= '
								<tr class="text-11" align="center" id="l_con_pais">
										<td width="35%">
											' .$row_mun["can_pais"] . ' 
										</td>
										<td width="35%">
											' .$row_mun["can_otros_estados"] . ' 
										</td>
										<td width="30%">
										' .$row_mun["Numero"] . ' 
									</td>
										
								</tr>';
					}
					
				}
				foreach ($arr_pais as $row_pais) {
					$html .= '
								</tbody>
								<tfoot>
									<tr class="text-11" align="center">
										
										<td width="35%"></td>
										<td width="35%"><strong>Total</strong></td>
										<td width="30%"><strong>'.$row_pais['Total'].'</strong></td>
									</tr>

								</tfood>
							</table>
						</div>
					</div>';
				}
			
			}
			echo $html;
			break;
	
			
			
		
		///Casos c4

		case 'fun_listar_consulta_mun_c4':
			$gen_reporte=$_POST['gen_reporte'];
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_mun_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$array_mun=$v->obtener_total_mun_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$size    = sizeof($arr_res);
			
			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Municipio !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class=" row col-md-12">
						<div class="col-md-12">
						<br>
							<h5 align="center">Listado de municipios del estado de veracruz</h5>
						</div>
						<div class="col-md-6">
						</div>
						<div class="col-md-6" align="right">
							<button class="btn btn-secondary" onclick="modal_pdf(\'' . $gen_reporte . '\',\'' . $id_reporte . '\',\'' . $desde . '\',\'' . $hasta . '\')" id="exportarpdf_mun" name="exportarpdf_mun">
								<i class="bi bi-filetype-pdf"></i>Ver Pdf
							</button>
							<p></p>
						</div>
					
					</div>
					
					<div class="col-md-12">
						<table id="tbl_consulta_mun" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Municipio
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row_mun) {
					$session  = 3;
					if( $row_mun["c4_edo"]=='30'){
					$html .= '
								<tr class="text-11" align="center" id="l_con_mes">
										<td width="50%">
											' .$row_mun["municipio"] . ' 
										</td>
										<td width="50%">
											' . $row_mun["Numero"] . '
										</td>
								</tr>';
					}
				}
				foreach ($array_mun as $row2) {
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2["Total"] . '</strong></td>
								</tr>

							</tfood>
						</table>
					</div>
				</div>';
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_gen_c4':
			$gen_reporte=$_POST['gen_reporte'];
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_gen_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2 = $v->obtener_total_gen_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por genero !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
				<div class=" row col-md-12">
					<div class="col-md-12">
					<br>
						<h5 align="center">Listado de municipios del estado de veracruz</h5>
					</div>
					<div class="col-md-6">
					</div>
					<div class="col-md-6" align="right">
						<button class="btn btn-secondary" onclick="modal_pdf(\'' . $gen_reporte . '\',\'' . $id_reporte . '\',\'' . $desde . '\',\'' . $hasta . '\')" id="exportarpdf_mun" name="exportarpdf_mun">
							<i class="bi bi-filetype-pdf"></i>Ver Pdf
						</button>
						<p></p>
					</div>
				
				</div>
					<div class="col-md-12">
					
						<table id="tbl_consulta_genero" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Genero
								</th>
								<th>
									Número
								</th>
										
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;

					
					$html .= '
								<tr class="text-11" align="center" id="l_con_sexo">
										<td>
											' . $row["Genero"] . '
										</td>
										<td>
											' . $row["Numero"] . '
											
										</td>
								</tr>';
					
								
				}
				foreach ($arr_res2 as $row2) {
				$html .= '
							</tbody>
							<tfoot>

								<tr class="text-11"  align="center">
									<td><strong>Total</strong></td>
									<td><strong>'. $row2["Total"] .'</strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_edades_c4':
		
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_edades_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2 = $v->obtener_total_edades_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Edad  Menores de 18 años!</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_edades" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Edades NNA
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row_edad) {
					$session  = 3;
					if($row_edad["Edad"] <='18'){
					$html .= '
								<tr class="text-11" align="center" id="l_con_edad">
										<td width="50%">
										
											' . $row_edad["Edad"]  . ' Años
										</td>
										<td width="50%">
											
											' . $row_edad["Numero"] . '
										</td>
								</tr>
							
								
								';
					}
					
				}
				foreach ($arr_res2 as $row2) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2["Total"] . ' NNA</strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
					
				}

				/////		
			}
			echo $html;
			break;
		case 'fun_listar_consulta_edades_mayores_c4':
		
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha'];
			$hasta=$_POST['hasta_fecha'];
			$arr_res_m = $v->lista_consulta_edades_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2_m = $v->obtener_total_edades_mayores_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);

			$size    = sizeof($arr_res_m);

			if (empty($arr_res_m)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Edad Mayores de 18 años !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_edades_mayores_c4" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Edades > 18 Años
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res_m as $row_edad_m) {
					$session  = 3;
					if($row_edad_m["Edad"] >='19'){
					$html .= '
								<tr  align="center" id="l_con_edad_mayor_c4">
										<td width="50%">
											
											' . $row_edad_m["Edad"]  . ' Años
										</td>
										<td width="50%">
											
											' . $row_edad_m["Numero"] . '
										</td>
								</tr>
							
								
								';
					}
					
				}
				foreach ($arr_res2_m as $row2_m) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr  align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2_m["Total"] . ' </strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
					
				}

				/////		
			}
			echo $html;
			break;
		case 'fun_listar_consulta_mes_c4':
			$id_reporte=$_POST['id_reporte'];
			$desde=$_POST['desde_fecha']; 
			$hasta=$_POST['hasta_fecha'];
			$arr_res = $v->lista_consulta_mes_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2 = $v->obtener_total_mes_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Mes !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					
					<div class="col-md-12">
						<table id="tbl_consulta_mes_c4" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th>
									Mes
								</th>
								<th>
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;

					$html .= '
								<tr class="text-11" align="center" id="l_con_mes">
										<td>
											
											' .$Meses[ $row["Mes"]-1] . ' 
										</td>
										<td>
											' . $row["Numero"] . '
										</td>
								</tr>';
				}
				foreach ($arr_res2 as $row2) {
				$html .= '
							</tbody>
							<tfoot>
							<tr class="text-11" align="center" >
								<td><strong>Total</strong></td>
								<td><strong>' . $row2["Total"] . '</strong></td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>';
				}
			}
			echo $html;
			break;
		case 'fun_listar_consulta_delito_c4':
			$arr_res = $v->lista_consulta_delito_c4 ($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$arr_res2 = $v->obtener_total_delito_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$cat_del=$v->fn_lista_delitos();

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Delito !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_delito" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Delito
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
					
					$html .= '
								<tr class="text-11" align="center" id="l_con_del">
										<td width="50%">
										'.$row['delito'].'
										
										</td>								
										<td width="50%">
										'.$row['Numero'].'
									
										</td>
								</tr>';		
					
					
				}
				
				foreach ($arr_res2 as $row2) {
				$html .= '
							</tbody>
							<tfoot>
								<tr class="text-11" align="center" >
									<td><strong>Total</strong></td>
									<td><strong>'.$row2['Total'].'</strong></td>

								</tr>

							</tfoot>
						</table>
					</div>
				</div>';
				}
				
			}
			echo $html;
			break;
		case 'fun_listar_per_vul_c4':
			$arr_res_a = $v->lista_per_vul_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			$arr_res2_a = $v->obtener_total_per_vul_c4($_POST['desde_fecha'],$_POST['hasta_fecha']);
			
			$size    = sizeof($arr_res_a);
			
			if (empty($arr_res_a)) {
				$html =
					'
				<center>
					<h5>¡ No hay datos de consulta por Personas vulneradas !</h5>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_consulta_agresion" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th width="50%">
									Personas Vulneradas
								</th>
								<th width="50%">
									Número
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res_a as $row_edad_a) {
					$session  = 3;
					
					$html .= '
								<tr  align="center" id="l_con_agresion">
										<td  class="tbl_div" width="50%">
												<div class="row col-md-12">
													<div class="tbl_div">
														Otros (personas de la tercera edad)
													</div>
													
													<div class="tbl_div">
														Persona Indigena	
													</div>
													<div class="tbl_div">
														Persona Trangenero
													</div>
													<div class="tbl_div">
														Persona Con alguna discapacidad
													</div>
													<div class="tbl_div">
														Violencia contra la mujer
													</div>
												</div>

										</td>
										<td class="tbl_div" width="50%">
											<div class="col-md-12">
												<div class="tbl_div">
													'.$row_edad_a['persona_tercera'].'
												</div>
											
												<div class="tbl_div">
													'.$row_edad_a['persona_indigena'].'
													
												</div>
													
												<div class="tbl_div">
													'.$row_edad_a['persona_transgenero'].'
													
												</div>
												
												<div class="tbl_div">
												'.$row_edad_a['persona_discapacidad'].'
												</div>
												
												<div class="tbl_div">
													
													'.$row_edad_a['persona_violencia'].'
												</div>
											</div>
											
										</td>
								</tr>
								
							
								
								';
					
					
				}
				foreach ($arr_res2_a as $row2_a) {
					
				$html .= '
							</tbody>
							<tfoot>
								<tr  align="center">
									<td><strong>Total</strong></td>
									<td><strong>' . $row2_a["Total"] . ' </strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>';
					
				}

				/////		
			}
			echo $html;
			break;			
	
	}
}
