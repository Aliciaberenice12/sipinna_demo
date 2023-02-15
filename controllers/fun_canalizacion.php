<?php
require_once('../models/class_canalizacion.php');
$v = new Canalizacion();
session_start();

if (isset($_REQUEST['func'])) {
	switch ($_REQUEST['func']) {
		
		case 'carrito_victima':
			if ($_REQUEST["evento"] == 1 || $_REQUEST["evento"] == 2 || $_REQUEST["evento"] == 3) {
				if ($_REQUEST["evento"] == 1) //Agregar al carrito
				{
					$can_edad_vic = $_POST["can_edad_vic"];
					$can_nom_vic  = $_POST["can_nom_vic"];
					// $can_delito  = $_POST["can_delito"];
					
					$can_der_vul_vic  = $_POST["can_der_vul_vic"];
					$can_per_tercera_edad  = $_POST["can_per_tercera_edad"];
					$can_per_violencia  = $_POST["can_per_violencia"];
					$can_per_discapacidad  = $_POST["can_per_discapacidad"];
					$can_per_indigena  = $_POST["can_per_indigena"];
					$can_per_transgenero  = $_POST["can_per_transgenero"];
					$can_sexo_victima  = $_POST["can_sexo_victima"];
					// $can_num_del  = $_POST["can_num_del"];


					$id           = date('is') . rand(5, 15);

					//Creamos el array con sus valores
					$_SESSION["victima"][$id] = array(
						'id' => $id, 'can_edad_vic' => $can_edad_vic, 'can_nom_vic' => $can_nom_vic,
						 'can_der_vul_vic' => $can_der_vul_vic, 'can_per_tercera_edad' => $can_per_tercera_edad,
						'can_per_violencia' => $can_per_violencia, 'can_per_discapacidad' => $can_per_discapacidad,
						'can_per_indigena' => $can_per_indigena, 'can_per_transgenero' => $can_per_transgenero, 'can_sexo_victima' => $can_sexo_victima
					);
				} //Cierre del if de la accion 1
				elseif ($_REQUEST["evento"] == 2) //Elimina un registro en particular
					unset($_SESSION['victima'][$_POST["id"]]);
				elseif ($_REQUEST["evento"] == 3) //elimina el arreglo completo
					unset($_SESSION['victima']);

				if (!empty($_SESSION['victima'])) {
					$html = '<br>
					<table class="table table-striped table-sm" width="100%">
						<tr align="center" class="thead">					
							<td>
								<div class="d-none d-sm-block">
									<div class="row" align="center">
										<div class="col-lg-2 col-sm-12 col-12 margin5">Nombre</div>
										<div class="col-lg-1 col-sm-10 col-12 margin5">Edad</div>
										<div class="col-lg-3 col-sm-10 col-12 margin5">Derecho Vulnerado</div>
										<div class="col-lg-2 col-sm-10 col-12 margin5">Agresión Extraordinaria</div>
										<div class="col-lg-2 col-sm-10 col-12 margin5">Sexo</div>
										<div class="col-lg-2 col-sm-10 col-12 margin5">Borrar
											<button type="button" class="btn btn-sm btn-dark" onclick="carrito_victima(3,0)">
												<i class="bi bi-trash"></i>
											</button>
										</div>
									</div>
								</div>
							</td>
						</tr>';
					foreach ($_SESSION['victima'] as $row) {
						// $aux = [];
						// $delitos = $row['can_delito'];
						// $delitos = explode(',', $row['can_delito']);
						// unset($_SESSION['cat_delito']);
						// foreach ($delitos as $delito) {
						// 	array_push($aux, "■" . $_SESSION['cat_delitos'][$delito][0]);
						// }
						// $aux2 = implode("<br>", $aux);

						$der = [];
						$arr_der_vul = $row['can_der_vul_vic'];
						$arr_der_vul = explode(',', $row['can_der_vul_vic']);
						unset($_SESSION['cat_derecho']);
						foreach ($arr_der_vul as $der_vul) {
							array_push($der, "■" . $_SESSION['cat_derechos'][$der_vul][0]);
						}
						$res_der_vul = implode("<br>", $der);

						$html .= '
							<tr align="center" class="thead">					
								<td>
									<div class="d-none d-sm-block">
										<div class="row" align="center">
											<div class="col-lg-2 ">' . $row["can_nom_vic"] . '</div>
											<div class="col-lg-1 " >
											' . ($row["can_edad_vic"] == "0" ? "Menos de 1 año" : $row["can_edad_vic"]) . '

											</div>


											

											<div class="col-lg-3" align="left">
											' . $res_der_vul . '.<br>
											</div>
											<div class="col-lg-2 "align="left">
											' . ($row["can_per_tercera_edad"] == "1" ? "■ Otros (personas de la tercera edad).<br>" : "") . '
											' . ($row["can_per_indigena"] == "1" ? " ■ Persona perteneciente a pueblo indigena.<br>" : "") . '
											' . ($row["can_per_transgenero"] == "1" ? "■ Persona transgenero.<br>" : "") . '
											' . ($row["can_per_discapacidad"] == "1" ? "■ Persona con alguna discapacidad.<br>" : "") . '
											' . ($row["can_per_violencia"] == "1" ? "■ Violencia contra la mujer.</br>" : "") . '

											</div>
											<div class="col-lg-2">' . $row["can_sexo_victima"] . '</div>
											<div class="col-lg-2">
												<button type="button" class="btn btn-sm btn-danger" onclick="carrito_victima(2,' . $row["id"] . ')">
												<i class="bi bi-trash"></i>
												</button>
											</div>
										</div>
									</div>
								</td>
							</tr>';
					}
					$html .= '
					</table>';
				} else
					$html = '<br><div class="alert alert-secondary textmd" align="center"><b>No hay datos de victimas por registrar</b></div>';

				echo $html;
			}

			break;

		case 'fn_guardar_victima_can':
			if ($_REQUEST["id"] == '0') {
				if (isset($_SESSION['victima']) and !empty($_SESSION['victima'])) {
					// $estatus= $v->insertar_victima_can($_SESSION["nombre"]);

				} else {
					$estatus = 'Victimas No insertadas  ';
				}
			} else {
				$estatus = $v->editar_victima_can(
					$_REQUEST["id"],
					$_REQUEST["can_edad_vic_edit"],
					$_REQUEST["can_nom_vic_edit"],
					$_REQUEST["can_per_tercera_edad_edit"],
					$_REQUEST["can_per_violencia_edit"],
					$_REQUEST["can_per_discapacidad_edit"],
					$_REQUEST["can_per_indigena_edit"],
					$_REQUEST["can_per_transgenero_edit"],
					$_REQUEST["can_sexo_victima_edit"],
					$_SESSION["nombre"]
				);

				

				$estatus1 = $v->editar_derecho_victima_can($_REQUEST["id_can_der_victima_edit"], $_REQUEST["can_der_vul_vic_edit"], $_SESSION["nombre"]);
			}

			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;


		case 'fn_obtener_datos_victimas_edit':
			$arr_res = $v->obtener_dato_victima_edit($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_edad_vic' => $row["can_edad_vic"],
					'can_nom_vic' => $row["can_nom_vic"],
					'can_per_tercera_edad'    => $row["can_per_tercera_edad"],
					'can_per_violencia'    => $row["can_per_violencia"],
					'can_per_discapacidad'    => $row["can_per_discapacidad"],
					'can_per_indigena'    => $row["can_per_indigena"],
					'can_per_transgenero'    => $row["can_per_transgenero"],
					'can_sexo_victima'    => $row["can_sexo_victima"],
					'can_der_vul_vic'    => $row["can_der_vul_vic"],
					
					
					'id_derecho'    => $row["id_derecho"],
					'can_exp_folio_victima'    => $row["can_exp_folio_victima"],
					

				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;


		case 'fn_listar_victimas':
			$arr_res = $v->lista_victimas($_POST["folio_exp"]);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h2>¡ No hay datos de victimas !</h2>

				</center>';
			} else {
				$html = '  
				<div class="row">
				
					<div class="col-md-12" style="overflow-x:auto;">
						<table id="tbl_victimas" class="table"  >
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Edad
								</th>
								<th>
									Nombre
								</th>
								
								<th>
									Derecho Vulnerado
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
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
					

					$der = [];
					$arr_der_vul = $row['can_der_vul_vic'];
					$arr_der_vul = explode(',', $row['can_der_vul_vic']);
					unset($_SESSION['cat_derecho']);
					foreach ($arr_der_vul as $der_vul) {
						array_push($der, "■" . $_SESSION['cat_derechos'][$der_vul][0]);
					}
					$res_der_vul = implode("<br>", $der);
					$html .= '
								<tr class="text-11" align="center" id="lvictimas' . $row["id_can_victima"] . '">
									<div class="row">
										<td class="col-md-1">
											<div>
											' . ($row["can_edad_vic"] == "0" ? "Menor de 1 año" : $row["can_edad_vic"]) . '

											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["can_nom_vic"] . '
											</div>
										</td>
										
										<td class="col-md-2" align="left">
											<div>
										
											' . $res_der_vul . '.<br>

											</div>
										</td>
										<td class="col-md-2" align="left">
											<div>
											
											' . ($row["can_per_tercera_edad"] == "1" ? "■ Otros (personas de la tercera edad).<br>" : "") . '
											' . ($row["can_per_indigena"] == "1" ? " ■ Persona perteneciente a pueblo indigena.<br>" : "") . '
											' . ($row["can_per_transgenero"] == "1" ? "■ Persona transgenero.<br>" : "") . '
											' . ($row["can_per_discapacidad"] == "1" ? "■ Persona con alguna discapacidad.<br>" : "") . '
											' . ($row["can_per_violencia"] == "1" ? "■ Violencia contra la mujer.</br>" : "") . '

											</div>
										</td>
										<td class="col-md-2">
											<div >
											' . $row["can_sexo_victima"] . '
											</div>
										</td>							
										
										<td class="col-md-1">								
											<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Canalizacion"  onclick="mod_canalizacion(6,' . $row["id_can_victima"] . ');">
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
		case 'fun_guardar_delito_victima':
			if ($_REQUEST["id"] == '0') {
				$estatus = 'no insertado delito';
			} else {
				$estatus = $v->editar_reportante($_REQUEST["id"], $_REQUEST["can_inst_rep_edit"], $_REQUEST["can_nom_rep_edit"], $_SESSION["nombre"]);
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
			//Canalizacion Reportante
		case 'fn_guardar_reportante':
			if ($_REQUEST["id"] == '0') {
				if (isset($_SESSION['reportante']) and !empty($_SESSION['reportante'])) {
					// $estatus= $v->insertar_reportante($_SESSION["nombre"]);	
				} else {
					$estatus = 'no insertado reportantes';
				}
			} else {
				$estatus = $v->editar_reportante($_REQUEST["id"], $_REQUEST["can_inst_rep_edit"], $_REQUEST["can_nom_rep_edit"], $_SESSION["nombre"]);
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'carrito_reportante':
			if ($_REQUEST["evento"] == 1 || $_REQUEST["evento"] == 2 || $_REQUEST["evento"] == 3) {
				if ($_REQUEST["evento"] == 1) //Agregar al carrito
				{
					$can_inst_rep = $_POST["can_inst_rep"];
					$can_nom_rep  = $_POST["can_nom_rep"];
					$id           = date('is') . rand(5, 15);

					//Creamos el array con sus valores
					$_SESSION["reportante"][$id] = array('id' => $id, 'reportante' => $can_nom_rep, 'institucion' => $can_inst_rep);
				} //Cierre del if de la accion 1
				elseif ($_REQUEST["evento"] == 2) //Elimina un registro en particular
					unset($_SESSION['reportante'][$_POST["id"]]);
				elseif ($_REQUEST["evento"] == 3) //elimina el arreglo completo
					unset($_SESSION['reportante']);

				if (!empty($_SESSION['reportante'])) {
					$html = '<br>
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
					foreach ($_SESSION['reportante'] as $row) {
						$html .= '
							<tr align="center" class="thead">					
								<td>
									<div class="d-none d-sm-block">
										<div class="row" align="center">
											<div class="col-lg-4 col-sm-6 col-12 margin5">' . $row["institucion"] . '</div>
											<div class="col-lg-5 col-sm-6 col-12 margin5">' . $row["reportante"] . '</div>
											<div class="col-lg-2 col-sm-6 col-12 margin5">
												<button type="button" class="btn btn-danger" onclick="carrito_reportante(2,' . $row["id"] . ')">
													Eliminar
												</button>
											</div>
										</div>
									</div>
								</td>
							</tr>';
					}
					$html .= '
					</table>';
				} else
					$html = '<br><div class="alert alert-secondary textmd" align="center"><b>No hay datos de Reportantes por registar</b></div>';

				echo $html;
			}


			break;

		case 'fn_listar_reportantes':
			$arr_res = $v->lista_reportantes($_POST["folio_exp"]);

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
				
					<h2>¡ No hay datos de reportantes!</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12">
						<table id="tbl_reportados" class="table">
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
								<tr class="text-11" align="center" id="lreportantes' . $row["id_reportante"] . '">
									<div class="row">
										<td class="col-md-2">
											<div>
											
											' . $row["can_inst_reportante"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											' . $row["can_nom_reportante"] . '
											</div>
										</td>
										
										<td class="col-md-2">								
											<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Canalizacion" onclick="mod_canalizacion(5,' . $row["id_reportante"] . ');">
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

		
			//Guardar solicitante
		case 'fn_guardar_solicitante':
			if ($_REQUEST["id"] == '0') {
				// $estatus = $v->insertar_solicitante($_REQUEST["can_inst_sol"], $_REQUEST["can_nom_sol"],$_SESSION["nombre"]);
			} else {
				$estatus = $v->editar_solicitante($_REQUEST["id"], $_REQUEST["can_inst_sol"], $_REQUEST["can_nom_sol"]);
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;

			//Canalizacion Caso Reportando
		case 'fn_guardar_caso_reportado':
			if ($_REQUEST["id"] == '0') //Nuevo Caso
			{
				// $estatus = $v->insertar_caso_reportado($_REQUEST["can_des_suncita_rep"],
				//  $_REQUEST["can_ges_reporte"], $_REQUEST["ins_con_hechos"],$_SESSION["nombre"]);

			} else {
				$estatus = $v->editar_caso_reportado($_REQUEST["id"], $_REQUEST["can_des_suncita_rep"], $_REQUEST["can_ges_reporte"], $_REQUEST["ins_con_hechos"], $_SESSION["nombre"]);
			}

			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
			//Cargar Catálogos
		case 'fn_carga_municipios':
			$html = '<option value="0">Seleccionar</option>';
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
		// case 'fn_carga_delitos':
		// 	$html = '<option value="0" disabled>Seleccionar</option>';
		// 	$arr_res = $v->fn_lista_delitos();

		// 	foreach ($arr_res as $row) {
		// 		$html .= '<option value="' . $row["id_delito"] . '">' . $row["delito"] . '</option>';
		// 		$_SESSION['cat_delitos'][$row["id_delito"]] = [$row["delito"]];
		// 	}
		// 	echo $html;
		// 	break;
		case 'fn_carga_derechos':
			$html = '<option value="0" disabled selected>Seleccionar</option>';
			$arr_res = $v->fn_lista_derechos();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_derecho"] . '">' . $row["derecho"] . '</option>';
				$_SESSION['cat_derechos'][$row["id_derecho"]] = [$row["derecho"]];
			}
			echo $html;
			break;

		case 'fn_carga_parentescos':
			$html = '<option value="0">Seleccionar</option>';
			$arr_res = $v->fn_lista_parentescos();
			foreach ($arr_res as $row) {
				$html .= '<option value="' . $row["id_parentesco"] . '">' . $row["parentesco"] . '</option>';
			}
			echo $html;
			break;



			//Canalizacion Expediente
		
		case 'fn_guardar_canalizacion':
			
			if (isset($_SESSION["rol_id"]) and $_SESSION["rol_id"] != '4') //Rol Administrador 
			{
				if ($_REQUEST["id"] == '0') // nuevo registro
				{
					$nom_archivo_can = '';
					if (isset($_FILES["archivo_can"]) and $_FILES["archivo_can"] != '') //si lleva archivo
					{
						if ($_FILES["archivo_can"]["size"] > 1000000) //Si el archivo es mayor a 
							$estatus = 'arch_pesado';

						else {
							$folio_img_1    = str_replace(' ', '', $_REQUEST["can_num_oficio"]);
							$folio_img      = str_replace('/', '_', $folio_img_1);
							$fichero = $_FILES["archivo_can"];
							$ext            = explode(".", $_FILES['archivo_can']['name']);
							$extension      = end($ext);
							$nom_archivo_can    = $folio_img . '_' . rand() . '.' . $extension;

							move_uploaded_file($fichero["tmp_name"], "../images/canalizacion/" . $nom_archivo_can);
							$datos_exp_can = $_POST;
							$estatus = $v->insertar_canalizacion($nom_archivo_can, $datos_exp_can);
							
						}	
					}
					else //Nuevo Registro Sin imagen
					{
						
						$datos_exp_can = $_POST;
						$sin_imagen='no.png';
						$estatus = $v->insertar_canalizacion($sin_imagen, $datos_exp_can);
						

					}
					
				}
				else ///Editar Registro Administrador
				{
					if (isset($_FILES["archivo_can"]) and $_FILES["archivo_can"] != '') //Si lleva Archivo de canalización
					{
						$folio_img_1    = str_replace(' ', '', $_REQUEST["can_num_oficio"]);
						$folio_img      = str_replace('/', '_', $folio_img_1);
						$fichero = $_FILES["archivo_can"];
						$obt_fecha_folio = $_POST["can_fecha"];
						$ext            = explode(".", $_FILES['archivo_can']['name']);
						$extension      = end($ext);
						$nom_archivo    = $folio_img . '_' . rand() . '.' . $extension;
						$upload_folder  = '../images/canalizacion/';
						move_uploaded_file($fichero["tmp_name"], "../images/canalizacion/" . $nom_archivo);
						unlink($upload_folder . $_REQUEST["can_ruta_sol_oficio_edit"]);

						$estatus = $v->editar_canalizacion(
							$_POST["can_via_rec"],
							$_POST["can_numero"],
							$_POST["can_folio"],
							$_POST["can_num_oficio"],
							$_POST["can_pais"],
							$_POST["can_otros_estados"],
							$_POST["can_estado"],
							$_POST["can_municipio"],
							$_POST["can_mun_edo"],
							$_POST["can_fecha"],
							$_POST["estatus_expediente"],
							$nom_archivo,
							$_SESSION["nombre"],
							$_POST["id"]
						);
						$estatus2 = $v->editar_caso_reportado(
							$_POST["id_caso"],
							$_POST["can_des_suncita_rep"],
							$_POST["can_ges_reporte"],
							$_POST["ins_con_hechos"],
							$_SESSION["nombre"]
						);
						$estatus3 = $v->editar_solicitante(
							$_POST["id_solicitante"],
							$_POST["can_inst_sol"],
							$_POST["can_nom_sol"],
							$_SESSION["nombre"]
						);
						
						
					} 
					else 
					{
						$estatus = $v->editar_canalizacion(
							
							$_POST["can_via_rec"],
							$_POST["can_numero"],
							$_POST["can_folio"],
							$_POST["can_num_oficio"],
							$_POST["can_pais"],
							$_POST["can_otros_estados"],
							$_POST["can_estado"],
							$_POST["can_municipio"],
							$_POST["can_mun_edo"],
							$_POST["can_fecha"],
							$_POST["estatus_expediente"],
							$_POST["can_ruta_sol_oficio_edit"],
							$_SESSION["nombre"],
							$_POST["id"]

						);
						$estatus2 = $v->editar_caso_reportado(
							$_POST["id_caso"],
							$_POST["can_des_suncita_rep"],
							$_POST["can_ges_reporte"],
							$_POST["ins_con_hechos"],
							$_SESSION["nombre"]
						);
						$estatus3 = $v->editar_solicitante(
							$_POST["id_solicitante"],
							$_POST["can_inst_sol"],
							$_POST["can_nom_sol"],
							$_SESSION["nombre"]
						);
						
					}
				}
			}
			else if (isset($_SESSION["rol_id"]) and $_SESSION["rol_id"] == '4')// Rol Historico 
			{
				if($_REQUEST["id"] == '0') // historico nuevo registro
				{
					$nom_archivo_can = '';
					if (isset($_FILES["archivo_can"]) and $_FILES["archivo_can"] != '') {  ///Si lleva imagen en perfil administrador
						if ($_FILES["archivo_can"]["size"] > 500000) //Si el archivo es mayor a 500 Kb
							$estatus = 'arch_pesado';

						else {
							$folio_img_1    = str_replace(' ', '', $_REQUEST["can_num_oficio"]);
							$folio_img      = str_replace('/', '_', $folio_img_1);
							$fichero = $_FILES["archivo_can"];
							$obt_fecha_folio = $_POST["can_fecha"];
							$anio_fol = explode("-", $obt_fecha_folio);
							$anio_folio = $anio_fol['0'];
							$ext            = explode(".", $_FILES['archivo_can']['name']);

							$extension      = end($ext);
							$nom_archivo    = $folio_img . '_' . rand() . '.' . $extension;

							move_uploaded_file($fichero["tmp_name"], "../images/canalizacion/" . $nom_archivo);
							$datos_exp_historico_can = $_POST;
							$estatus = $v->insertar_canalizacion_historico($nom_archivo, $datos_exp_historico_can, $anio_folio);
						}
					}
					else{ // si no lleva imagen en perfil Histirico
						$obt_fecha_folio = $_POST["can_fecha"];
						$anio_fol = explode("-", $obt_fecha_folio);
						$anio_folio = $anio_fol['0'];
						$datos_exp_historico_can = $_POST;
						$nom_archivo='no.png';
						$estatus = $v->insertar_canalizacion_historico($nom_archivo, $datos_exp_historico_can, $anio_folio);

					}
				}	
				 
				else//   Editar Historico
				{  
					$datos_historico_edit_can=$_POST;
					if (isset($_POST['archivo_can'])) {//si no se cambia la imagen 
						$estatus = $v->editar_canalizacion(
							
							$_POST["can_via_rec"],
							$_POST["can_numero"],
							$_POST["can_folio"],
							$_POST["can_num_oficio"],
							$_POST["can_pais"],
							$_POST["can_otros_estados"],
							$_POST["can_estado"],
							$_POST["can_municipio"],
							$_POST["can_mun_edo"],
							$_POST["can_fecha"],
							$_POST["estatus_expediente"],
							$_POST["can_ruta_sol_oficio_edit"],
							$_SESSION["nombre"],
							$_POST["id"]

						);
						$estatus2 = $v->editar_caso_reportado(
							$_POST["id_caso"],
							$_POST["can_des_suncita_rep"],
							$_POST["can_ges_reporte"],
							$_POST["ins_con_hechos"],
							$_SESSION["nombre"]
						);
						$estatus3 = $v->editar_solicitante(
							$_POST["id_solicitante"],
							$_POST["can_inst_sol"],
							$_POST["can_nom_sol"],
							$_SESSION["nombre"]
						);
					} 
					else 
					{
						$folio_img_1    = str_replace(' ', '', $_REQUEST["can_num_oficio"]);
						$folio_img      = str_replace('/', '_', $folio_img_1);
						$fichero = $_FILES["archivo_can"];
						$obt_fecha_folio = $_POST["can_fecha"];
						$ext            = explode(".", $_FILES['archivo_can']['name']);
						$extension      = end($ext);
						$nom_archivo    = $folio_img . '_' . rand() . '.' . $extension;
						$upload_folder  = '../images/canalizacion/';
						move_uploaded_file($fichero["tmp_name"], "../images/canalizacion/" . $nom_archivo);
						unlink($upload_folder . $_REQUEST["can_ruta_sol_oficio_edit"]);

						$estatus = $v->editar_canalizacion(
							$_POST["can_via_rec"],
							$_POST["can_numero"],
							$_POST["can_folio"],
							$_POST["can_num_oficio"],
							$_POST["can_pais"],
							$_POST["can_otros_estados"],
							$_POST["can_estado"],
							$_POST["can_municipio"],
							$_POST["can_mun_edo"],
							$_POST["can_fecha"],
							$_POST["estatus_expediente"],
							$nom_archivo,
							$_SESSION["nombre"],
							$_POST["id"]
						);
						$estatus2 = $v->editar_caso_reportado(
							$_POST["id_caso"],
							$_POST["can_des_suncita_rep"],
							$_POST["can_ges_reporte"],
							$_POST["ins_con_hechos"],
							$_SESSION["nombre"]
						);
						$estatus3 = $v->editar_solicitante(
							$_POST["id_solicitante"],
							$_POST["can_inst_sol"],
							$_POST["can_nom_sol"],
							$_SESSION["nombre"]
						);
					}

				}
			}
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_listar_canalizaciones':
			$arr_res = $v->lista_canalizaciones();
 
			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h2>¡ No hay datos Registrados !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_can" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th>
									Numero Oficio
								</th>
								<th>
									Fecha
								</th>
								<th>
									Estado
								</th>
								<th>
									Municipio
								</th>
								<th>
									via de Recepción
								</th>
								<th>
									Estatus del caso 
								</th>
								<th>
									Acciones
								</th>
								<th>
									Avance
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
 
					$html .= '
								<tr class="text-11" align="center" id="l_can' . $row["id"] . '">
									<div class="row">
										
										<td class="col-md-2">
											<div>
											' . $row["can_numero_oficio"] . '
											</div>
										</td>
										<td class="col-md-1">
											<div>
											' . $row["can_fecha"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											
											' . $row["estado"] . '
											' . $row["can_otros_estados"] . '


											</div>
										</td>
										<td class="col-md-1">
											<div >
											' . ($row["municipio"] == "Seleccionar" ? "" : $row["municipio"]) . '

											' . $row["can_mun_edo"] . '

									
											</div>
										</td>							
										<td class="col-md-2">
											<div>
												' . $row["can_via_rec"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div >
											
											' . $row["estatus_expediente"] . '
											</div>
										</td>
										<td class="col-md-1">								
											<div>
											
												<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Canalizacion" onclick="mod_canalizacion(2,' . $row["id"] . ',\'' . $row["can_folio_expediente"] . '\');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-sm btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_canalizacion(' . $row["id"] . ',\'' . $row["can_numero"] . '\');" ' . ($session == 3 ? "" : "hidden") . '>
													<i class="bi bi-trash"></i>
													<span></span>
												</button>
												
											
											</div>
										</td>   
										<td class="col-md-1">
											<button type="button" class="btn btn-sm btn-secondary " aria-label="Avance Canalizacion" onclick="fn_modal_avance(1,\'' . $row["can_folio_expediente"] . '\',0);">
												<i class="bi bi-eye"></i>
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
		case 'fn_listar_can_inactivas':
			$arr_res = $v->lista_can_inactivas();

			$size    = sizeof($arr_res);

			if (empty($arr_res)) {
				$html =
					'
				<center>
					<h2>¡ No hay datos Registrados !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-md-12">
						<table id="tbl_can_inactivas" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th>
									Numero Oficio
								</th>
								<th>
									Fecha
								</th>
								<th>
									Estado
								</th>
								<th>
									Municipio
								</th>
								<th>
									via de Recepción
								</th>
								<th>
									Estatus del caso 
								</th>
								<th>
									Acciones
								</th>
								<th>
									Avance
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {
					$session  = 3;
	
					$html .= '
								<tr class="text-11" align="center" id="l_can_inactiva' . $row["id"] . '">
									<div class="row">
										
										<td class="col-md-2">
											<div>
											' . $row["can_numero_oficio"] . '
											</div>
										</td>
										<td class="col-md-1">
											<div>
											' . $row["can_fecha"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											
											' . $row["estado"] . '
											' . $row["can_otros_estados"] . '


											</div>
										</td>
										<td class="col-md-1">
											<div >
											' . ($row["municipio"] == "Seleccionar" ? "" : $row["municipio"]) . '

											' . $row["can_mun_edo"] . '

									
											</div>
										</td>							
										<td class="col-md-2">
											<div>
												' . $row["can_via_rec"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div >
											
											' . $row["estatus_expediente"] . '
											</div>
										</td>
										<td class="col-md-1">								
											<div>
											
												<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Canalizacion" onclick="mod_canalizacion(2,' . $row["id"] . ',\'' . $row["can_folio_expediente"] . '\');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-sm btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_canalizacion(' . $row["id"] . ',\'' . $row["can_numero"] . '\');" ' . ($session == 3 ? "" : "hidden") . '>
													<i class="bi bi-trash"></i>
													<span></span>
												</button>
												
											
											</div>
										</td>   
										<td class="col-md-1">
											<button type="button" class="btn btn-sm btn-secondary " aria-label="Avance Canalizacion" onclick="fn_modal_avance(1,\'' . $row["can_folio_expediente"] . '\',0);">
												<i class="bi bi-eye"></i>
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
			
		case 'fn_eliminar_canalizacion':
			$estatus = $v->eliminar_canalizacion($_REQUEST["id"], $_REQUEST["desc_eliminar"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_obtener_canalizacion':
			$arr_res = $v->obtener_canalizacion($_REQUEST["id"], $_REQUEST["folio_exp"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_folio' => $row["can_folio"],
					'can_numero'    => $row["can_numero"],
					'can_numero_oficio'    => $row["can_numero_oficio"],
					'can_fecha'      => $row["can_fecha"],
					'can_pais' => $row["can_pais"],
					'can_otros_estados' => $row["can_otros_estados"],
					'can_estado'       => $row["can_estado"],
					'can_municipio'       => $row["can_municipio"],
					'can_mun_edo'       => $row["can_mun_edo"],
					'can_via_rec'       => $row["can_via_rec"],
					'can_folio_expediente' => $row["can_folio_expediente"],
					'can_ruta_sol_oficio' => $row["can_ruta_sol_oficio"],
					'estatus_expediente' => $row["estatus_expediente"],


				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;

		case 'fn_obtener_casos_reportados':
			$arr_res = $v->obtener_caso_reportado($_REQUEST["folio_exp"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_des_caso' => $row["can_des_caso"],
					'can_gest_caso' => $row["can_gest_caso"],
					'estatus_caso'    => $row["estatus_caso"],
					'ins_con_hechos'    => $row["ins_con_hechos"],
				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
		case 'fn_obtener_datos_reportantes':
			$arr_res = $v->obtener_dato_reportante($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_inst_reportante' => $row["can_inst_reportante"],
					'can_nom_reportante' => $row["can_nom_reportante"],
				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
		case 'fn_obtener_datos_solicitantes':
			$arr_res = $v->obtener_dato_solicitante($_REQUEST["folio_exp"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_inst_solicitante' => $row["can_inst_solicitante"],
					'can_nom_solicitante' => $row["can_nom_solicitante"],

				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;

			//Avances 
		case 'fn_guardar_avance':
			if ($_REQUEST['id'] == 0) // nuevo registro
				$estatus = $v->insertar_avance($_REQUEST["can_fecha_avance"], $_REQUEST["can_desc_avance"], $_SESSION["nombre"], $_REQUEST["folio_can"]);
			else
				$estatus = $v->editar_avance($_REQUEST["id"], $_REQUEST["can_fecha_avance"],  $_REQUEST["can_desc_avance"], $_REQUEST["folio_can"], $_SESSION["nombre"]);

			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_eliminar_avance':
			$estatus = $v->eliminar_avance($_REQUEST["id"], $_REQUEST["can_desc_avance"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_obtener_avance':
			$arr_res = $v->obtener_avance($_REQUEST["id_avance"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_fecha_avance'	=> $row["can_fecha_avance"],
					'can_desc_avance'	=> $row["can_desc_avance"],
					'can_exp_folio_avance'	=> $row["can_exp_folio_avance"],

				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
		case 'fn_listar_avances':
			$arr_res = $v->lista_avances($_POST["folio_exp"]);

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
					<div class="col-md-12">
						<table id="tbl_avances" class="table-hover">
							<thead class="tbl-estadisticas">
							<tr class="text-11" align="center">
								<th class="col-md-2">
									Fecha Avance
								</th>
							
								<th class="col-md-8" align="center">
									Descripción avance
								</th>
								
								<th class="col-md-2">
									Acciones
								</th>
								
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {

					$html .= '
								<tr class="text-11" align="justify" id="l_avance' . $row["id_can_avance"] . '">
									<div class="row">
										<td class="col-md-2">
											<div>
											' . $row["can_fecha_avance"] . '
											</div>
										</td >
										
										<td class="col-md-8">
											<div>
											' . $row["can_desc_avance"] . '
											</div>
										</td>
			
										<td class="col-md-2">
										
												<button type="button" class="btn btn-sm btn-primary" aria-label="Editar Canalizacion" onclick="fn_modal_avance(3,\'' . $row["can_exp_folio_avance"] . '\',' . $row["id_can_avance"] . ');">
													<i class="bi bi-pencil-square"></i>
												</button>
											
												<button type="button" class="btn btn-sm btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_avance(' . $row["id_can_avance"] . ',\'' . $row["can_desc_avance"] . '\');">
													<i class="bi bi-trash"></i>
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
	}
}
