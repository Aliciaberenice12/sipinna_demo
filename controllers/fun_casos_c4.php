<?php
require_once('../models/class_casos_c4.php');
$v = new CasosC4();

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
		case 'fn_guardar_victima_c4':
			$estatus = $v->insertar_victima_c4($_REQUEST["c4_delitos"], $_REQUEST["c4_nom_vic"], $_REQUEST["c4_rep_der"], $_REQUEST["c4_edad_vic"], $_REQUEST["c4_gen_vic"], $_REQUEST["c4_per_tercera_edad"], $_REQUEST["c4_per_discapacidad"], $_REQUEST["c4_per_violencia"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		
		//Datos Reportante
		case 'fn_guardar_reportante_c4':
			$estatus = $v->insertar_reportante_c4($_REQUEST["c4_inst_rep"], $_REQUEST["c4_nom_rep"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		//Probable Responsable
		case 'fn_guardar_prob_respo_c4':
			$estatus = $v->insertar_prob_respo_c4($_REQUEST["c4_nom_responsable"], $_REQUEST["c4_edad_responsable"], $_REQUEST["c4_parentesco"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		//Descripción Caso
		case 'fn_guardar_desc_caso_c4':
			$estatus = $v->insertar_desc_caso_c4($_REQUEST["c4_lugar_hechos"], $_REQUEST["c4_des_hechos"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
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
						$estatus = $v->fn_registrar_caso_c4($_REQUEST["c4_folio"],
						$_REQUEST["c4_no_oficio"], $nom_archivo,$_REQUEST["c4_fecha_inicio"], 
						$_REQUEST["c4_edo"], $_REQUEST["c4_mun"], $_REQUEST["c4_mun_edo"],
						$_REQUEST["c4_dirigido"],$_REQUEST["c4_dg"]
					);
						if ($estatus == 'error_registro') {
							if (file_exists($archivador));
							unlink($archivador);
						}
					} else
						$estatus = 'error_subida_archivo';
				}	
			}else{
				$estatus=$v->editar_canalizacion($_REQUEST["id"],$_REQUEST["can_no_oficio"],$_REQUEST["can_fecha_inicio"],$_REQUEST["can_edo"],$_REQUEST["can_mun"]);
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
					<div class="col-12">
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
								
								<th>
									Avances
								</th>
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {

					$html .= '
								<tr class="text-11" align="center" id="lcan' . $row["id"] . '">
									<div class="row">
										<td>
											<div class="col-md-3">
											' . $row["c4_no_oficio"] . '
											</div>
										</td>
										<td>
											<div class="col-md-3">
											' . $row["c4_folio"] . '
											</div>
										</td>
										
										<td>
											<div class="col-md-3">
											
											' . $row["estado"] . '
											</div>
										</td>
										<td>
											<div class="col-md-3">
											' . $row["municipio"] . '

											' . $row["c4_mun_edo"] . '

									
											</div>
										</td>
										
										<td>
											<strong>' . $row["c4_estatus_caso"] . '</strong>
										<br>
										</td>
										<td>								
											<div class="col-md-3">
											
												<button type="button" class="btn btn-primary" aria-label="Editar Canalizacion" onclick="mod_caso_c4(2,' . $row["id"] . ');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_caso_c4_(' . $row["id"] . ',\'' . $row["c4_no_oficio"] . '\');">
													<i class="bi bi-trash"></i>
													<span></span>
												</button>
											</div>
										</td>   
										<td>
										<button type="button" class="btn btn-sm btn-secondary" aria-label="modal_avances_c4" onclick="fn_modal_avances_c4();">
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
					'c4_folio'    => $row["c4_folio"],
					'c4_no_oficio'    => $row["c4_no_oficio"],
					'c4_ruta_sol_oficio'    => $row["c4_ruta_sol_oficio"],
					'c4_fecha_inicio'    => $row["c4_fecha_inicio"],
					'c4_edo'    => $row["c4_edo"],
					'c4_mun'       => $row["c4_mun"],
					'c4_mun_edo'       => $row["c4_mun_edo"],
					'c4_dirigido'       => $row["c4_dirigido"],
					'c4_dg'      => $row["c4_dg"],
					'c4_folio_expediente'=> $row["c4_folio_expediente"],
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
		

		
	}
}