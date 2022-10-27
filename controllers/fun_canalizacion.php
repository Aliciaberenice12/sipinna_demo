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
		case 'fn_guardar_victima':
			$estatus = $v->insertar_victima($_REQUEST["can_delitos"],$_REQUEST["can_nom_vic"],$_REQUEST["can_rep_der"],$_REQUEST["can_edad_vic"],$_REQUEST["can_gen_vic"],$_REQUEST["can_per_tercera_edad"],$_REQUEST["can_per_discapacidad"],$_REQUEST["can_per_violencia"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_guardar_reportante':
			$estatus = $v->insertar_reportante($_REQUEST["can_inst_rep"],$_REQUEST["can_nom_rep"],$_REQUEST["can_des_suncita"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;
		case 'fn_guardar_canalizacion':
			$nom_archivo = '';
			if ($_FILES["archivo"]["size"] > 500000) //Si el archivo es mayor a 500 Kb
				$estatus = 'arch_pesado';

			else {
				$folio_img_1    = str_replace(' ', '', $_REQUEST["can_no_oficio"]);
				$folio_img      = str_replace('/', '_', $folio_img_1);
				$nombre_archivo = $_FILES['archivo']['name'];
				$tmp_archivo    = $_FILES['archivo']['tmp_name'];
				$ext            = explode(".", $_FILES['archivo']['name']);
				$extension      = end($ext);
				$nom_archivo    = $folio_img . '_' . rand() . '.' . $extension;
				$upload_folder  = '../images/canalizacion/';
				$archivador     = $upload_folder . $nom_archivo;

				//No funciona en el servidor
				if (compressImage($tmp_archivo, $archivador, 30)) {
					$estatus = $v->fn_registrar_canalizacion($folio_img_1, $nom_archivo, $_REQUEST["can_fecha_inicio"],  $_REQUEST["can_estado"], $_REQUEST["can_municipio"], $_REQUEST["can_mun_edo"], $_REQUEST["can_via_rec"]);
					if ($estatus == 'error_registro') {
						if (file_exists($archivador));
						unlink($archivador);
					}
				} else
					$estatus = 'error_subida_archivo';
			}

			echo json_encode(['estatus' => $estatus]);
			break;
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
		case 'fn_listar_canalizaciones':
			$arr_res = $v->rel_estados();
			
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
						<table id="tbl_can" class="table table-hover table-striped table-sm table-responsive-sm">
							<thead class="tbl-estadisticas">
							<tr align="center">
								<th>
									No.oficio
								</th>
								<th>
									Via De Recepcion
								</th>
								<th>
									Estado
								</th>
								<th>
									Municipio
								</th>
								<th>
									Acciones
								</th>
							</tr>
							</thead>
							<tbody>';
				foreach ($arr_res as $row) {

					$html .= '
								<tr class="text-11" align="center" id="lcan' . $row["id_can_exp"] . '">
									<div class="row">
										<td>
											<div class="col-md-3">
											' . $row["can_no_oficio"] . '
											</div>
										</td>
										<td>
											<div class="col-md-3">
											' . $row["can_via_rec"] . '
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

											' . $row["can_mun_edo"] . '

									
											</div>
											
										</td>
										<td>
											<div class="col-md-3">
												
												<button type="button" class="btn btn-primary" aria-label="Editar Canalizacion" onclick="mod_canalizacion(2,' . $row["id_can_exp"] . ');">
													<i class="bi bi-pencil-square"></i>
													<span></span>
												</button>
												<button type="button" class="btn btn-danger " aria-label="Eliminar Canalizacion" onclick="fn_eliminar_canalizacion(' . $row["id_can_exp"] . ',\'' . $row["can_no_oficio"] . '\');">
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
		case 'fn_eliminar_canalizacion':
			$estatus = $v->eliminar_canalizacion($_REQUEST["id"], $_REQUEST["can_no_oficio"]);
			header('Content-Type: application/json');
			$datos = array('estatus' => $estatus);
			echo json_encode($datos, JSON_FORCE_OBJECT);
			break;



			

	}
}
