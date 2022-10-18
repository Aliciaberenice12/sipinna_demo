<?php
require_once('../models/class_canalizacion.php');
$v = new Canalizacion();

//catalogo municipios
if ($_REQUEST["accion"] == 'fn_carga_municipios') {
	$html = '<option value="0">Seleccionar</option>';
	$arr_res = $v->fn_lista_municipios();
	foreach ($arr_res as $row) {
		$html .= '<option value="' . $row["id_municipio"] . '">' . $row["municipio"] . '</option>';
	}
	echo $html;
} 
else if ($_REQUEST["accion"] == 'fn_carga_estados') {
	$html = '<option value="0">Seleccionar</option>';
	$arr_res = $v->fn_lista_estados();
	foreach ($arr_res as $row) {
		$html .= '<option value="' . $row["id_estado"] . '">' . $row["estado"] . '</option>';
	}
	echo $html;
}
else if ($_REQUEST["accion"] == 'fn_carga_delitos') {
	$html = '<option value="0">Seleccionar</option>';
	$arr_res = $v->fn_lista_delitos();
	foreach ($arr_res as $row) {
		$html .= '<option value="' . $row["id_delito"] . '">' . $row["delito"] . '</option>';
	}
	echo $html;
}

//
else if ($_REQUEST["accion"] == 'fn_guardar_canalizacion') {

	if ($_REQUEST["id"] == 0) // nuevo registro
		$estatus = $v->insertar_canalizacion($_REQUEST["can_no_oficio"], $_REQUEST["can_fecha_inicio"], $_REQUEST["can_via_rec"], $_REQUEST["can_estado"], $_REQUEST["can_municipio"]);
	else
		$estatus = $v->editar_canalizacion($_REQUEST["id"], $_REQUEST["can_no_oficio"], $_REQUEST["can_via_rec"], $_REQUEST["can_fecha_inicio"], $_REQUEST["can_estado"], $_REQUEST["can_municipio"]);

	header('Content-Type: application/json');
	$datos = array('estatus' => $estatus);
	echo json_encode($datos, JSON_FORCE_OBJECT);
}
else if ($_REQUEST["accion"] == 'fn_listar_canalizaciones') {
	$arr_res = $v->lista_canalizaciones();
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
							Estado
						</th>
						<th>
							Via De Recepcion
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
									' . $row["can_estado"] . '
									</div>
								</td>
								<td>
									<div class="col-md-3">
									' . $row["can_via_rec"] . '
									</div>
								</td>
								<td>
									<div class="col-md-3">
									' . $row["can_municipio"] . '
									
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
}
elseif ($_REQUEST["accion"] == 'fn_eliminar_canalizacion') 
{
	$estatus = $v->eliminar_canalizacion($_REQUEST["id"], $_REQUEST["can_no_oficio"]);
	header('Content-Type: application/json');
	$datos = array('estatus' => $estatus);
	echo json_encode($datos, JSON_FORCE_OBJECT);
} 