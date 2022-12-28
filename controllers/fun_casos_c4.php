<?php
require_once('../models/class_casos_c4.php');
$v = new CasosC4();
session_start();

//print_r($_SESSION);

function compressImage($source, $destination, $quality)
{
	// Obtenemos la información de la imagen
	$imgInfo = getimagesize($source);
	$mime    = $imgInfo['mime'];

	// Creamos una imagen
	switch ($mime) {
		case 'image/jpeg':
			$image = imagecreatefromjpeg($source);
			break;
		case 'image/png':
			$image = imagecreatefrompng($source);
			break;
		case 'image/gif':
			$image = imagecreatefromgif($source);
			break;
		default:
			$image = imagecreatefromjpeg($source);
	}
	// Guardamos la imagen
	return imagejpeg($image, $destination, $quality);
}
if (isset($_REQUEST['func'])) {
	switch ($_REQUEST['func']) {
		//Casos c4 Victimas
		case 'carrito_reportante':
			if($_REQUEST["evento"] == 1 || $_REQUEST["evento"] == 2 || $_REQUEST["evento"] == 3)
			{
				if($_REQUEST["evento"] == 1)//Agregar al carrito
				{
					$c4_inst_rep = $_POST["c4_inst_rep"];
					$c4_nom_rep  = $_POST["c4_nom_rep"];
					$id           = date('is').rand(5,15);

					//Creamos el array con sus valores
					$_SESSION["reportante"][$id] = array('id'=>$id, 'reportante' => $c4_nom_rep, 'institucion' => $c4_inst_rep);
				}//Cierre del if de la accion 1
				elseif($_REQUEST["evento"] == 2)//Elimina un registro en particular
					unset($_SESSION['reportante'][$_POST["id"]]); 
				elseif($_REQUEST["evento"] == 3)//elimina el arreglo completo
					unset($_SESSION['reportante']); 

				if(!empty($_SESSION['reportante']))
				{			
					$html ='<br>
					<table class="table table-striped table-sm" width="100%">
						<tr align="center" class="thead">					
							<td>
								<div class="d-none d-sm-block">
									<div class="row" align="center">
										<div class="col-lg-4 col-sm-6 col-12 margin5">Institución Reportante</div>
										<div class="col-lg-5 col-sm-6 col-12 margin5">Nombre Reportante</div>
										<div class="col-lg-2 col-sm-6 col-12 margin5">Borrar
											<button type="button" class="btn btn-sm btn-dark" onclick="carrito_reportante(3,0)">
												<i class="bi bi-trash"></i>
											</button>
										</div>
									</div>
								</div>
							</td>
						</tr>';
						foreach($_SESSION['reportante'] as $row)
						{
							$html.='
							<tr align="center" class="thead">					
								<td>
									<div class="d-none d-sm-block">
										<div class="row" align="center">
											<div class="col-lg-4 col-sm-6 col-12 margin5">'.$row["institucion"].'</div>
											<div class="col-lg-5 col-sm-6 col-12 margin5">'.$row["reportante"].'</div>
											<div class="col-lg-2 col-sm-6 col-12 margin5">
												<button type="button" class="btn btn-sm btn-danger" onclick="carrito_reportante(2,'.$row["id"].')">
													Eliminar
												</button>
											</div>
										</div>
									</div>
								</td>
							</tr>';
						}
						$html.='
					</table>';						
				}
				else
					$html='<br><div class="alert alert-secondary textmd" align="center"><b>No hay datos</b></div>';

				echo $html;
			}
			
			
			break;
		
		
		case 'carrito_victima_c4':
			if($_REQUEST["evento"] == 1 || $_REQUEST["evento"] == 2 || $_REQUEST["evento"] == 3)
			{
				if($_REQUEST["evento"] == 1)//Agregar al carrito
				{
					$c4_edad_vic 			= $_POST["c4_edad_vic"];
					$c4_nom_vic  			= $_POST["c4_nom_vic"];
					$c4_delitos  			= $_POST["c4_delitos"];
					$c4_num_delitos  		= $_POST["c4_num_delitos"];
					$c4_der_vul  			= $_POST["c4_der_vul"];
					$c4_per_tercera_edad  	= $_POST["c4_per_tercera_edad"];
					$c4_per_violencia  		= $_POST["c4_per_violencia"];
					$c4_per_discapacidad  	= $_POST["c4_per_discapacidad"];
					$c4_per_indigena  		= $_POST["c4_per_indigena"];
					$c4_per_transgenero  	= $_POST["c4_per_transgenero"];
					$c4_sexo_victima  		= $_POST["c4_sexo_victima"];
					$id          			= date('is').rand(5,15);

					//Creamos el array con sus valores
					$_SESSION["victima_c4"][$id] = array('id'=>$id, 'c4_edad_vic' => $c4_edad_vic, 'c4_nom_vic' => $c4_nom_vic,
					 'c4_delitos' => $c4_delitos, 'c4_num_delitos' => $c4_num_delitos, 'c4_der_vul' => $c4_der_vul,
					  'c4_per_tercera_edad' => $c4_per_tercera_edad,'c4_per_violencia' => $c4_per_violencia, 
					  'c4_per_discapacidad' => $c4_per_discapacidad, 'c4_per_indigena' => $c4_per_indigena, 'c4_per_transgenero' => $c4_per_transgenero,
					  'c4_sexo_victima' => $c4_sexo_victima);
				}//Cierre del if de la accion 1
				elseif($_REQUEST["evento"] == 2)//Elimina un registro en particular
					unset($_SESSION['victima_c4'][$_POST["id"]]); 
				elseif($_REQUEST["evento"] == 3)//elimina el arreglo completo
					unset($_SESSION['victima_c4']); 

				if(!empty($_SESSION['victima_c4']))
				{			
					$html ='<br>
					<table class="table table-striped table-sm" width="100%">
						<tr align="center" class="thead">					
							<td>
								<div class="d-none d-sm-block">
									<div class="row" align="center">
										<div class="col-lg-2 col-sm-2 col-12 margin5">Nombre</div>
										<div class="col-lg-1 col-sm-1 col-12 margin5">Edad</div>
										<div class="col-lg-2 col-sm-2 col-12 margin5">Delito</div>
										<div class="col-lg-3 col-sm-3 col-12 margin5">Derecho Vulnerado</div>
										<div class="col-lg-2 col-sm-2 col-12 margin5">Agresión Extraordinaria</div>
										<div class="col-lg-1 col-sm-1 col-12 margin5">Sexo</div>
										<div class="col-lg-1 col-sm-1 col-10 margin5">
											Borrar
											<button type="button" class="btn btn-sm btn-dark" onclick="carrito_victima_c4(2,3,0)">
												<i class="bi bi-trash"></i>
											</button>
										
										</div>
									</div>
								</div>
							</td>
						</tr>';
						foreach($_SESSION['victima_c4'] as $row)
						{
							$aux = [];
							 $delitos = $row['c4_delitos'];
							 $delitos = explode(',', $row['c4_delitos']);
							 unset($_SESSION['cat_delito']);
							 foreach($delitos as $delito){
							 	array_push($aux,$_SESSION['cat_delitos'][$delito][0]);
							 } 
							 $aux2 = implode(",", $aux);
							
							$der = [];
							$arr_der_vul = $row['c4_der_vul'];
							$arr_der_vul = explode(',', $row['c4_der_vul']);
							unset($_SESSION['cat_derecho']);
							foreach($arr_der_vul as $der_vul){
								array_push($der,"■ ".$_SESSION['cat_derechos'][$der_vul][0]);
							} 
							$res_der_vul = implode("<br>", $der);
							$html.='
							<tr align="center" class="thead">					
								<td>
									<div class="d-none d-sm-block">
										<div class="row" align="center">
											<div class="col-lg-2 col-sm-2 col-12 margin5">'.$row["c4_nom_vic"].'</div>
											<div class="col-lg-1 col-sm-1 col-12 margin5" >'.$row["c4_edad_vic"].'</div>

											<div class="col-lg-2 col-sm-2 col-12 margin5">
												
												'.$aux2.'<br>

												<strong>Numero delitos:</strong>'.$row["c4_num_delitos"].'
											</div>

											<div class="col-lg-3 col-sm-3 col-12 margin5">
												'.$res_der_vul.'.<br>
												
											</div>
											<div class="col-lg-2 col-sm-2 col-12 margin5">
										
												' . ( $row["c4_per_tercera_edad"] == "1" ? "■ Otros (personas de la tercera edad).<br>" : ""). '
												' . ( $row["c4_per_discapacidad"] == "1" ? "■ Persona con alguna discapacidad.<br>":""). '
												' . ( $row["c4_per_indigena"] == "1" ? " ■ Persona perteneciente a pueblo indigena.<br>" : ""). '
												' . ( $row["c4_per_transgenero"] == "1" ? "■ Persona transgenero.<br>" : ""). '
												' . ( $row["c4_per_violencia"] == "1" ? "■ Violencia contra la mujer.</br>" : ""). '


											</div>
											<div class="col-lg-1 col-sm-1 col-12 margin5">'.$row["c4_sexo_victima"].'</div>
											<div class="col-lg-1 col-sm-1 col-12 margin5">
												<button type="button" class="btn btn-sm btn-danger" onclick="carrito_victima_c4(2,2,'.$row["id"].')">
												<i class="bi bi-trash"></i>
												</button>
											</div>
										</div>
									</div>
								</td>
							</tr>';
						}
						$html.='
					</table>';						
				}
				else
					$html='<br><div class="alert alert-secondary textmd" align="center"><b>No hay datos</b></div>';
				echo $html;
			}
			break;
		
		case 'fn_guardar_victima_c4':
			if($_REQUEST["id"]=='0')
			{
				if(isset($_SESSION['victima_c4']) and !empty($_SESSION['victima_c4']))
				{	
					$estatus= $v->insertar_victima_c4($_SESSION["nombre"]);	

				}
				else
				{
					$estatus = 'no insertado reportantes';
				}

			}
			else
			{
				$estatus = $v->editar_victima_c4($_REQUEST["c4_edad_victima_edit"], $_REQUEST["c4_nom_victima_edit"],$_REQUEST["c4_num_delitos_edit"], 
				$_REQUEST["c4_per_tercera_edad_edit"], $_REQUEST["c4_per_violencia_edit"],$_REQUEST["c4_per_discapacidad_edit"],
			 	$_REQUEST["c4_per_indigena_edit"],$_REQUEST["c4_per_transgenero_edit"],$_REQUEST["c4_sexo_victima_edit"],
				$_SESSION["nombre"],$_REQUEST["id"]);

				
				 $estatus2 = $v->editar_delito_victima_c4($_REQUEST["id_c4_del_victima_edit"],$_REQUEST["c4_delito_edit"],$_SESSION["nombre"]);
				 $estatus3 = $v->editar_derecho_victima_c4($_REQUEST["id_c4_der_victima_edit"],$_REQUEST["c4_der_vul_vic_edit"],$_SESSION["nombre"]);
			
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_lista_victimas_c4':
			$arr_res = $v->fn_lista_victimas_c4($_POST["fol_c4"]);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
					
				$html =
					'
				<center>
					<h2>¡ No hay datos !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12">
						<table id="lista_bd_victimas_c4" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<strong>
								<th>
									Edad
								</th>
								<th>
									Nombre Victima
								</th>
								<th>
									Tipo de Delito 
								</th>
								<th>
									Numero de delitos 
								</th>
								<th>
									Derechos Vulnerados 
								</th>
								<th>
									Agresión Extraordinaria 
								</th>
								<th>
									Sexo 
								</th>
								<th>
									Acciones
								</th>
								</strong>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
					$aux = [];
					$delitos = $row['c4_delito'];
					$delitos = explode(',', $row['c4_delito']);
					unset($_SESSION['cat_delito']);
					foreach($delitos as $delito){
						array_push($aux,$_SESSION['cat_delitos'][$delito][0]);
					} 
					$aux2 = implode(",", $aux);
				
					$der = [];
					$arr_der_vul = $row['c4_der_vul_victima'];
					$arr_der_vul = explode(',', $row['c4_der_vul_victima']);
					unset($_SESSION['cat_derecho']);
					foreach($arr_der_vul as $der_vul){
						array_push($der,"■ ".$_SESSION['cat_derechos'][$der_vul][0]);
					} 
					$res_der_vul	 = implode("<br>", $der);
					
					$html .= '
								<tr class="text-11" align="center" id="lvictima_c4' . $row["id_victima"] . '">
									<div class="row">
										<td class="col-md-2">
											<div>
											
											' . $row["c4_edad_victima"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["c4_nom_victima"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div align="left">
											'.$aux2.'
											
											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["c4_num_delitos"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div align="left">
										
											'.$res_der_vul.'.<br>

											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . ( $row["c4_per_tercera_edad"] == "1" ? "■ Otros (personas de la tercera edad).<br>" : ""). '
											' . ( $row["c4_per_indigena"] == "1" ? " ■ Persona perteneciente a pueblo indigena.<br>" : ""). '
											' . ( $row["c4_per_transgenero"] == "1" ? "■ Persona transgenero.<br>" : ""). '
											' . ( $row["c4_per_discapacidad"] == "1" ? "■ Persona con alguna discapacidad.<br>":""). '
											' . ( $row["c4_per_violencia"] == "1" ? "■ Violencia contra la mujer.</br>" : ""). '

											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["c4_sexo_victima"] . '
											</div>
										</td>
										
										<td class="col-md-2">								
											<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Victima" onclick="mod_caso_c4(6,' . $row["id_victima"] . ');">
												<i class="bi bi-pencil-square"></i>
												<span></span>
											</button>
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
		case 'fn_obtener_datos_victimas_c4':
			$arr_res = $v->obtener_dato_victima_c4($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'c4_edad_victima'=>$row["c4_edad_victima"],
					'c4_nom_victima'=>$row["c4_nom_victima"],
					'c4_num_delitos'=>$row["c4_num_delitos"],
					'c4_per_tercera_edad'=>$row["c4_per_tercera_edad"],
					'c4_per_violencia'=>$row["c4_per_violencia"],
					'c4_per_discapacidad'=>$row["c4_per_discapacidad"],
					'c4_per_indigena'=>$row["c4_per_indigena"],
					'c4_per_transgenero'=>$row["c4_per_transgenero"],
					'c4_sexo_victima'=>$row["c4_sexo_victima"],
					'id_c4_delito_victima'=>$row["id_c4_delito_victima"],
					'c4_delito'=>$row["c4_delito"],
					'id_c4_derecho'=>$row["id_c4_derecho"],
					'c4_der_vul_victima'=>$row["c4_der_vul_victima"],




				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
				
		
							
					
			
					
					
						
					
				
			
		
		
		//Datos Reportante
		case 'fn_guardar_reportante_c4':
			if($_REQUEST["id"]=='0')
			{
				if(isset($_SESSION['reportante']) and !empty($_SESSION['reportante']))
				{	
					$estatus= $v->insertar_reportante_c4($_SESSION["nombre"]);	

				}
				else
				{
					$estatus = 'no insertado reportantes';
				}

			}
			else
			{
				$estatus = $v->editar_reportante_c4( $_REQUEST["can_nom_rep_c4_edit"],$_REQUEST["can_inst_rep_c4_edit"],$_SESSION["nombre"],$_REQUEST["id"]);
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;

		case 'fn_lista_reportantes_c4':
			$arr_res = $v->lista_reportante_c4($_POST["fol_c4"]);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h2>¡ No hay datos !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12">
						<table id="tbl_reportantes_c4" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Institución Reportante
								</th>
								<th>
									Nombre Reportante
								</th>
								
								<th>
									Acciones
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
					
					$html .= '
								<tr class="text-11" align="center" id="lreportante_c4' . $row["id_reportante_c4"] . '">
									<div class="row">
										<td class="col-md-2">
											<div>
											
											' . $row["c4_inst_reportante"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["c4_nom_reportante"] . '
											</div>
										</td>
										
										<td class="col-md-2">								
											<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Reportante" onclick="mod_caso_c4(4,' . $row["id_reportante_c4"] . ');">
												<i class="bi bi-pencil-square"></i>
												<span></span>
											</button>
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
		case 'fn_obtener_datos_reportantes_c4':
			$arr_res = $v->obtener_dato_reportante_c4($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'c4_inst_reportante'=>$row["c4_inst_reportante"],
					'c4_nom_reportante'=>$row["c4_nom_reportante"],
				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
			
	
		//Probable Responsable
		case 'carrito_probable_resp_c4':
			if($_REQUEST["evento"] == 1 || $_REQUEST["evento"] == 2 || $_REQUEST["evento"] == 3)
			{
				if($_REQUEST["evento"] == 1)//Agregar al carrito
				{
					$c4_nom_responsable = $_POST["c4_nom_responsable"];
					$c4_edad_responsable  = $_POST["c4_edad_responsable"];
					$c4_parentesco  = $_POST["c4_parentesco"];
					$id           = date('is').rand(5,15);

					//Creamos el array con sus valores
					$_SESSION["probable_res"][$id] = array('id'=>$id, 'c4_nom_responsable' => $c4_nom_responsable,
					 'c4_edad_responsable' => $c4_edad_responsable,'c4_parentesco' => $c4_parentesco);
				}//Cierre del if de la accion 1
				elseif($_REQUEST["evento"] == 2)//Elimina un registro en particular
					unset($_SESSION['probable_res'][$_POST["id"]]); 
				elseif($_REQUEST["evento"] == 3)//elimina el arreglo completo
					unset($_SESSION['probable_res']); 

				if(!empty($_SESSION['probable_res']))
				{			
					$html ='<br>
					<table class="table table-striped table-sm" width="100%">
						<tr align="center" class="thead">					
							<td>
								<div class="d-none d-sm-block">
									<div class="row" align="center">
										<div class="col-lg-3 col-sm-3 col-12 margin5">
											<strong>
											Nombre Probable Responsable
											</strong>
										</div>
										<div class="col-lg-3 col-sm-3 col-12 margin5">
											<strong>
											Edad
											</strong>
										</div>
										<div class="col-lg-3 col-sm-3 col-12 margin5">
											<strong>
											Parentesco
											</strong>
										</div>
										<div class="col-lg-3 col-sm-3 col-12 margin5">
											<strong>
											Borrar <br>
											<button type="button" class="btn btn-sm btn-dark" onclick="carrito_probable_resp(3,0)">
												<i class="bi bi-trash"></i>
											</button>
											</strong>
										</div>
									</div>
								</div>
							</td>
						</tr>';
						foreach($_SESSION['probable_res'] as $row)
						{
							
						  
						   	//
							$con_pro = [];
							$parentescos = $row['c4_parentesco'];
							$parentescos = explode(',', $row['c4_parentesco']);
							unset($_SESSION['cat_parentesco']);
							foreach($parentescos as $parentesco){
								array_push($con_pro,$_SESSION['cat_parentescos'][$parentesco][0]);
							} 
							$ress_pro_resp = implode(",", $con_pro);
							$html.='
							<tr align="center" class="thead">					
								<td>
									<div class="d-none d-sm-block">
										<div class="row" align="center">
											<div class="col-lg-3 col-sm-3 col-12 margin5">
												'.$row["c4_nom_responsable"].'
											</div>
											<div class="col-lg-3 col-sm-3 col-12 margin5">
												'.$row["c4_edad_responsable"].'
											</div>
											<div class="col-lg-3 col-sm-3 col-12 margin5" align="left">
											'.$ress_pro_resp.'
											</div>

											<div class="col-lg-3 col-sm-3 col-12 margin5">
												<button type="button" class="btn btn-sm btn-danger" onclick="carrito_probable_resp(2,'.$row["id"].')">
													Eliminar
												</button>
											</div>
										</div>
									</div>
								</td>
							</tr>';
						}
						$html.='
					</table>';						
				}
				else
					$html='<br><div class="alert alert-secondary textmd" align="center"><b>No hay datos</b></div>';

				echo $html;
			}
			
			
			break;
		
		
		case 'fn_guardar_prob_respo_c4':
			if($_REQUEST["id"]=='0')
			{
				if(isset($_SESSION['probable_res']) and !empty($_SESSION['probable_res']))
				{	
					$estatus= $v->insertar_prob_respo_c4($_SESSION["nombre"]);	

				}
				else
				{
					$estatus = 'no insertado Probables responsables';
				}

			}
			else
			{
				$estatus = $v->editar_pro_res_c4( $_REQUEST["c4_edad_responsable_edit"],$_REQUEST["c4_nom_responsable_edit"],$_REQUEST["c4_parentesco_edit"],$_SESSION["nombre"],$_REQUEST["id"]);
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_lista_pro_res_c4':
			$arr_res = $v->lista_pro_res_c4($_POST["fol_c4"]);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h2>¡ No hay datos !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12">
						<table id="lista_bd_dat_pro_rep_c4" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Nombre Responsable
								</th>
								<th>
									Edad
								</th>
								<th>
									Parentesco con la victima 
								</th>
								<th>
									Acciones
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
						$aux = [];
						$parentescos = $row['c4_parentesco'];
						$parentescos = explode(',', $row['c4_parentesco']);
						unset($_SESSION['cat_parentesco']);
						foreach($parentescos as $parentesco){
							array_push($aux,$_SESSION['cat_parentescos'][$parentesco][0]);
						} 
						$aux2 = implode(",", $aux);
				   
					
					$html .= '
								<tr class="text-11" align="center" id="lreps_c4' . $row["id_pro_responsable"] . '">
									<div class="row">
										<td class="col-md-2">
											<div>
											
											' . $row["c4_nom_responsable"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["c4_edad_responsable"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											'.$aux2.'
											
											</div>
										</td>
										
										<td class="col-md-2">								
											<button type="button" class="btn btn-sm btn-primary" aria-label="editar_pro_repos" onclick="mod_caso_c4(5,' . $row["id_pro_responsable"] . ');">
												<i class="bi bi-pencil-square"></i>
												<span></span>
											</button>
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
					
		case 'fn_obtener_datos_pro_res_c4':
			$arr_res = $v->obtener_dato_pro_resp_c4($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'c4_edad_responsable'=>$row["c4_edad_responsable"],
					'c4_nom_responsable'=>$row["c4_nom_responsable"],
					'c4_parentesco'=>$row["c4_parentesco"],

				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
			
		
					
		
				
				
					
				
			
		//Descripción Caso
		case 'fn_guardar_desc_caso_c4':
			if($_REQUEST["id"]== 0){
				$estatus = $v->insertar_desc_caso_c4(
					$_REQUEST["c4_lugar_hechos"], $_REQUEST["c4_des_hechos"],
					$_REQUEST["c4_observaciones"],$_SESSION["nombre"]);
			}
			else{
				$estatus=$v->editar_desc_caso_c4(
						$_REQUEST["id"],$_REQUEST["c4_lugar_hechos"],$_REQUEST["c4_des_hechos"],
						$_REQUEST["c4_observaciones"],$_SESSION["nombre"]
				);
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		
		case 'fn_obtener_desc_caso_c4':
			$arr_res = $v->obtener_des_caso_c4($_REQUEST["fol_c4"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'id_desc_caso'    => $row["id_desc_caso"],
					'c4_lugar_hechos'    => $row["c4_lugar_hechos"],
					'c4_des_hechos'    => $row["c4_des_hechos"],
					'c4_observaciones'    => $row["c4_observaciones"]
				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
		
		//Caso c4 Expediente
		case 'fn_guardar_caso_c4':
			if($_REQUEST["id"]== 0){
				
				$nom_archivo = '';
				if ($_FILES["archivo"]["size"] > 500000) //Si el archivo es mayor a 500 Kb
					$estatus = 'arch_pesado';

				else {
					$folio_img_1    = str_replace(' ', '', $_REQUEST["c4_no_oficio"]);
					$folio_img      = str_replace('/', '_', $folio_img_1);
					$nombre_archivo = $_FILES['archivo']['name'];
					$tmp_archivo    = $_FILES['archivo']['tmp_name'];
					$ext            = explode(".", $_FILES['archivo']['name']);
					$extension      = end($ext);
					$nom_archivo    = $folio_img . '_' . rand() . '.' . $extension;
					$upload_folder  = '../images/casos_c4/';
					$archivador     = $upload_folder . $nom_archivo;

					if (compressImage($tmp_archivo, $archivador, 30)) {
						$estatus = $v->fn_registrar_caso_c4($_REQUEST["c4_codigo"],$_REQUEST["c4_folio"],$_REQUEST["c4_numero"],
						$_REQUEST["c4_no_oficio"], $nom_archivo,$_REQUEST["c4_fecha_inicio"], $_REQUEST["c4_pais"], 
						$_REQUEST["c4_edo"], $_REQUEST["c4_mun"], $_REQUEST["c4_mun_edo"],
						$_REQUEST["c4_dirigido"],$_REQUEST["c4_dg"],$_SESSION["nombre"]
					);
						if ($estatus == 'error_registro') {
							if (file_exists($archivador));
							unlink($archivador);
						}
					} else
						$estatus = 'error_subida_archivo';
				}	
			}else{
				$estatus=$v->editar_caso_c4(
						$_REQUEST["id"],$_REQUEST["c4_codigo"],$_REQUEST["c4_folio"],$_REQUEST["c4_numero"],
						$_REQUEST["c4_no_oficio"],$_REQUEST["c4_fecha_inicio"], $_REQUEST["c4_pais"], 
						$_REQUEST["c4_edo"], $_REQUEST["c4_mun"], $_REQUEST["c4_mun_edo"],
						$_REQUEST["c4_dirigido"],$_REQUEST["c4_dg"],$_SESSION["nombre"]
				);
			}

			echo json_encode(['estatus' => $estatus]);
			break;
		
		case 'fn_listar_casos_c4':
			$arr_res = $v->lista_casos_c4();

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h2>¡ No hay datos !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12" style="overflow-x:auto;">
						<table id="tbl_caso" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									No.oficio
								</th>
								<th>
									Folio
								</th>
								
								<th>
									Estado
								</th>
								<th>
									Municipio
								</th>
								<th>
									Estatus
								</th>
								<th>
									Acciones
								</th>
								
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {

					$html .= '
								<tr class="text-11" align="center" id="lcan' . $row["id"] . '">
									<div class="row">
										<td>
											<div >
											' . $row["c4_no_oficio"] . '
											</div>
										</td>
										<td>
											<div ">
											' . $row["c4_folio"] . '
											</div>
										</td>
										
										<td>
											<div>
											
											' . $row["estado"] . '
											</div>
										</td>
										<td>
											<div>
											' . ( $row["municipio"] == "Seleccionar" ? "" : $row["municipio"] ). '


											' . $row["c4_mun_edo"] . '

									
											</div>
										</td>
										
										<td>
											<strong>' . $row["c4_estatus_caso"] . '</strong>
										<br>
										</td>
										<td>								
											<div >
											
												<button type="button" class="btn btn-primary" aria-label="Editar Canalizacion" onclick="mod_caso_c4(2,' . $row["id"] . ',\'' . $row["c4_exp_folio"] . '\');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-danger " aria-label="Eliminar Canalizacion"  onclick="mensaje(1);">
													<i class="bi bi-trash"></i>
													<span></span>
												</button>
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
		case 'fn_eliminar_caso_c4':
			$estatus = $v->eliminar_caso_c4($_REQUEST["id"], $_REQUEST["c4_no_oficio"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_obtener_caso_c4':
			$arr_res = $v->obtener_caso_c4($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'c4_codigo'    => $row["c4_codigo"],
					'c4_folio'    => $row["c4_folio"],
					'c4_numero'    => $row["c4_numero"],
					'c4_no_oficio'    => $row["c4_no_oficio"],
					'c4_ruta_sol_oficio'    => $row["c4_ruta_sol_oficio"],
					'c4_fecha_inicio'    => $row["c4_fecha_inicio"],
					'c4_pais'    => $row["c4_pais"],
					'id_estado'    => $row["id_estado"],
					'c4_mun'       => $row["c4_mun"],
					'c4_mun_edo'       => $row["c4_mun_edo"],
					'c4_dirigido'       => $row["c4_dirigido"],
					'c4_dg'      => $row["c4_dg"],
					'c4_exp_folio'=> $row["c4_exp_folio"],
					'c4_estatus_caso'      => $row["c4_estatus_caso"],

				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
		//Avances 
		case 'fn_guardar_avance':
			if ($_REQUEST['id'] == 0) // nuevo registro
				$estatus = $v->insertar_avance($_REQUEST["can_tipo_avance"], $_REQUEST["can_fecha_avance"], $_REQUEST["can_estatus_avance"], $_REQUEST["can_desc_avance"]);
			else
				$estatus = $v->editar_avance($_REQUEST["id"],$_REQUEST["can_tipo_avance"], $_REQUEST["can_fecha_avance"], $_REQUEST["can_estatus_avance"], $_REQUEST["can_desc_avance"]);

			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_eliminar_avance':
			$estatus = $v->eliminar_avance($_REQUEST["id"], $_REQUEST["can_tipo_avance"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_obtener_avance':
			$arr_res=$v->obtener_avance($_REQUEST["id"]);
			foreach ($arr_res as $row){
				header('Content-Type: application/json');
				$datos=array(
					'can_tipo_avance'	=>$row["can_tipo_avance"],
					'can_fecha_avance'	=>$row["can_fecha_avance"],
					'can_estatus_avance'=>$row["can_estatus_avance"],
					'can_desc_avance'	=>$row["can_desc_avance"],
				);
				echo json_encode($datos, JSON_FORCE_OBJECT);

			}
			break;
		case 'fn_listar_avances':
			$arr_res = $v->lista_avances();

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<span>¡ No hay datos !</span>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12" align="left">
						<table id="tbl_avance" class="table table-hover table-striped table-sm table-responsive-sm">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Fecha Avance
								</th>
								<th>
									Tipo Avance
								</th>
								<th>
									Descripción avance
								</th>
								<th>
									Estatus
								</th>
								<th>
									Acciones
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {

					$html .= '
								<tr class="text-11" align="center" id="l_avance' . $row["id_can_avance"] . '">
									<div class="row">
										<td>
										<div class="col-md-5">
											' . $row["id_can_avance"] . '
											</div>
											<div class="col-md-5">
											' . $row["can_fecha_avance"] . '
											</div>
										</td>
										<td>
											<div class="col-md-3">
											' . $row["can_tipo_avance"] . '
											</div>
										</td>
										<td>
											<div class="col-md-3">
											' . $row["can_desc_avance"] . '
											</div>
										</td>
										<td>
											<div class="col-md-3">
											
											' . $row["can_estatus_avance"] . '
											</div>
										</td>
								
			
										<td>

										
											<div class="col-md-3">
											
												<button type="button" class="btn btn-primary" aria-label="Editar Canalizacion" onclick="fn_modal_avance(3,' . $row["id_can_avance"] . ');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_avance_(' . $row["id_can_avance"] . ',\'' . $row["can_tipo_avance"] . '\');">
													<i class="bi bi-trash"></i>
													<span></span>
												</button>
											</div>
										</td>   
										

									
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
		//Cargar Catálogos
		case 'fn_carga_municipios':
			$html = '<option value="">Seleccionar</option>';
			$arr_res = $v->fn_lista_municipios();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_municipio"] . '">' . $row["municipio"] . '</option>';
			}
			echo $html;
			break;
		case 'fn_carga_estados':
			$html = '<option value="0">Seleccionar</option>';
			$arr_res = $v->fn_lista_estados();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_estado"] . '">' . $row["estado"] . '</option>';
			}
			echo $html;
			break;
		case 'fn_carga_delitos':
			$html = '<option value="0">Seleccionar</option>';
			$arr_res = $v->fn_lista_delitos();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_delito"] . '">' . $row["delito"] . '</option>';
				$_SESSION['cat_delitos'][$row["id_delito"]]=[$row["delito"]];

			}
			echo $html;
			break;
		case 'fn_carga_parentescos':
			$html = '<option value="0">Seleccionar</option>';
			$arr_res = $v->fn_lista_parentescos();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_parentesco"] . '">' . $row["parentesco"] . '</option>';
				$_SESSION['cat_parentescos'][$row["id_parentesco"]]=[$row["parentesco"]];

			}
			echo $html;
			break;
		case 'fn_carga_derechos':
			$html = '<option value="0">Seleccionar</option>';
			$arr_res = $v->fn_lista_derechos();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_derecho"] . '">' . $row["derecho"] . '</option>';
				$_SESSION['cat_derechos'][$row["id_derecho"]]=[$row["derecho"]];

			}
			echo $html;
			break;
				
			
		

		
	}
}