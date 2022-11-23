<?php
require_once('../models/class_canalizacion.php');
$v = new Canalizacion();

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
		case 'fn_guardar_victima_can':
			$estatus = $v->insertar_victima_can($_REQUEST["can_delitos"], $_REQUEST["can_der_vul_vic"], $_REQUEST["can_nom_vic"],
			 $_REQUEST["can_edad_vic"],$_REQUEST["can_sexo_victima"],$_REQUEST["can_per_tercera_edad"], $_REQUEST["can_per_discapacidad"],
			  $_REQUEST["can_per_violencia"], $_REQUEST["can_per_indigena"],$_REQUEST["can_per_transgenero"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		
		
		//Canalizacion Reportante
		case 'fn_guardar_reportante':
			$estatus = $v->insertar_reportante($_REQUEST["can_inst_rep"], $_REQUEST["can_nom_rep"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		//Guardar solicitante
		case 'fn_guardar_solicitante':
			$estatus = $v->insertar_solicitante($_REQUEST["can_inst_sol"], $_REQUEST["can_nom_sol"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
			
		//Canalizacion Caso Reportando
		case 'fn_guardar_caso_reportado':
			$estatus = $v->insertar_caso_reportado($_REQUEST["can_des_suncita_rep"], $_REQUEST["can_ges_reporte"], $_REQUEST["ins_con_hechos"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
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


		//Canalizacion Expediente
		case 'fn_guardar_canalizacion':
			if ($_REQUEST["id"] == '0') // nuevo registro
			{
				$nom_archivo_can = '';
				if ($_FILES["archivo_can"]["size"] > 500000) //Si el archivo es mayor a 500 Kb
					$estatus = 'arch_pesado';

				else {
					$folio_img_1    = str_replace(' ', '', $_REQUEST["can_num_oficio"]);
					$folio_img      = str_replace('/', '_', $folio_img_1);
					$nombre_archivo_can = $_FILES['archivo_can']['name'];
					$tmp_archivo    = $_FILES['archivo_can']['tmp_name'];
					$ext            = explode(".", $_FILES['archivo_can']['name']);
					$extension      = end($ext);
					$nom_archivo_can    = $folio_img . '_' . rand() . '.' . $extension;
					$upload_folder  = '../images/canalizacion/';
					$archivador     = $upload_folder . $nom_archivo_can;

					if (compressImage($tmp_archivo, $archivador, 30)) {
						$estatus = $v->insertar_canalizacion(
						 $nom_archivo_can,$_REQUEST["can_num_oficio"],$_REQUEST["can_folio"],$_REQUEST["can_numero"], 
						$_REQUEST["can_fecha"], $_REQUEST["can_pais"], $_REQUEST["can_estado"],
						$_REQUEST["can_municipio"],$_REQUEST["can_mun_edo"],$_REQUEST["can_via_rec"]

					);
						if ($estatus == 'error_registro') {
							if (file_exists($archivador));
							unlink($archivador);
						}
					} else
						$estatus = 'error_subida_archivo';
				}	
			}
				
			else
				$estatus = $v->editar_canalizacion($_REQUEST["id"]
				, $_REQUEST["can_via_rec"], $_REQUEST["can_numero"]
				, $_REQUEST["can_num_oficio"], $_REQUEST["can_fecha"], $_REQUEST["can_estado"]
				, $_REQUEST["can_municipio"], $_REQUEST["can_mun_edo"]
			);


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
					<h2>¡ No hay datos !</h2>
				</center>';
			} else {
				$html = '  
				<div class="row">
					<div class="col-12">
						<table id="tbl_can" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									Folio
								</th>
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
								<tr class="text-11" align="center" id="lcan' . $row["id_canalizacion"] . '">
									<div class="row">
										<td class="col-md-1">
											<div>
											' . $row["can_folio"] . '
											</div>
										</td>
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
										<td class="col-md-1">
											<div>
											
											' . $row["estado"] . '
											</div>
										</td>
										<td class="col-md-1">
											<div >
											' . $row["municipio"] . '

											' . $row["can_mun_edo"] . '

									
											</div>
										</td>							
										<td class="col-md-2">
											<div>
												' . $row["can_via_rec"] . '
											</div>
										</td>
										<td class="col-md-1">								
											<div>
												<button type="button" class="btn btn-primary" aria-label="Editar Canalizacion" onclick="mod_canalizacion(2,' . $row["id_canalizacion"] . ',\'' . $row["can_folio_expediente"] . '\');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_canalizacion(' . $row["id_canalizacion"] . ',\'' . $row["can_numero"] . '\');">
													<i class="bi bi-trash"></i>
													<span></span>
												</button>
											</div>
										</td>   
										<td class="col-md-1">
											<button type="button" class="btn btn-sm btn-secondary" aria-label="modal_avances" onclick="fn_modal_avance(2);">
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
		case 'fn_obtener_canalizacion':
			$arr_res = $v->obtener_canalizacion($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_folio'=>$row["can_folio"],
					'can_pais'=>$row["can_pais"],
					'can_numero'    => $row["can_numero"],
					'can_numero_oficio'    => $row["can_numero_oficio"],
					'can_fecha'      => $row["can_fecha"],
					'can_estado'       => $row["can_estado"],
					'can_municipio'       => $row["can_municipio"],
					'can_mun_edo'       => $row["can_mun_edo"],
					'can_via_rec'       => $row["can_via_rec"],
					'can_folio_expediente'=> $row["can_folio_expediente"],


				);
				echo json_encode($datos, JSON_FORCE_OBJECT);
			}
			break;
			//Avances 
		case 'fn_guardar_avance':
			if ($_REQUEST['id'] == 0) // nuevo registro
				$estatus = $v->insertar_avance($_REQUEST["can_tipo_avance"], $_REQUEST["can_fecha_avance"], $_REQUEST["can_estatus_avance"], $_REQUEST["can_desc_avance"]);
			else
				$estatus = $v->editar_avance($_REQUEST["id"], $_REQUEST["can_tipo_avance"], $_REQUEST["can_fecha_avance"], $_REQUEST["can_estatus_avance"], $_REQUEST["can_desc_avance"]);

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
			$arr_res = $v->obtener_avance($_REQUEST["id"]);
			foreach ($arr_res as $row) {
				header('Content-Type: application/json');
				$datos = array(
					'can_tipo_avance'	=> $row["can_tipo_avance"],
					'can_fecha_avance'	=> $row["can_fecha_avance"],
					'can_estatus_avance' => $row["can_estatus_avance"],
					'can_desc_avance'	=> $row["can_desc_avance"],
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
						<table id="tbl_avances" class="table table-hover table-striped table-sm table-responsive-sm">
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
											
												<button type="button" class="btn btn-primary" aria-label="Editar Canalizacion" onclick="fn_modal_avance(3,'.$row["id_can_avance"].');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_avance(' . $row["id_can_avance"] . ',\'' . $row["can_tipo_avance"] . '\');">
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
	}
}
