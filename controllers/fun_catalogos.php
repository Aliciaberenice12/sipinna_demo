<?php
require_once('../models/class_catalogos.php');
$v = new Catalogos();

if ($_REQUEST["accion"] == 'fn_listar_delitos') 
{

	$arr_res = $v->lista_delitos();
	$size = sizeof($arr_res);
	if (empty($arr_res)) {
		$html =
			'
        <p>!No Hay Datos</p>
        ';
	} else {
		$html = '  		
		<table id="tbl_a" class="table table-hover table-striped table-sm table-responsive-sm">
	    <thead class="tbl-estadisticas">
	      <tr align="center">
	        <th width="100%" align="center">
				<div class="row" >
					<div class="col-md-4">Id</div>
					<div class="col-md-4">Tipo Delito o Falta</div>
					<div class="col-md-4">Acciones</div>

				<div>
			
			</th>

	      </tr>
	    </thead>
	    <tbody>';
		foreach ($arr_res as $row) {
			$html .= '
	        <tr class="text-11" id="l_delitos' . $row["id_delito"] . '">
				<td align="center">
					<div class="row">
						<div class="col-md-4">
								' . $row["id_delito"] . '
						</div>
						<div class="col-md-4">
								' . $row["delito"] . '
						</div>
						<div class="col-md-4" aling="center">
							
							<button type="button" class="btn btn-dark btn-sm hint--bottom" aria-label="Editar Delito" onclick="mod_cat_delitos(2,\'' . $row["id_delito"] . '\');">
								<i class="bi bi-pencil-square"></i>
								<span>Editar</span>
							</button>
							<button type="button" class="btn btn-danger btn-sm hint--bottom" aria-label="Eliminar delito" onclick="fn_eliminar_delito(\'' . $row["id_delito"] . '\',\'' . $row["delito"] . '\');">
								<i class="bi bi-trash"></i>
								<span>Eliminar</span>
							</button>
						</div>              
					</div>
				</td>                
	        </tr>';
		}
		$html .= '
    	</tbody>
  	</table>';
	}
	echo $html;
}
elseif ($_REQUEST["accion"] == 'fn_guardar_delito') 
{

	if ($_REQUEST["id"] == "0") // nuevo registro
		$estatus = $v->insertar_delito($_REQUEST["delito"]);
	else
		$estatus = $v->editar_delito($_REQUEST["id"], $_REQUEST["delito"]);

	header('Content-Type: application/json');
	$datos = array('estatus' => $estatus);
	echo json_encode($datos, JSON_FORCE_OBJECT);
}
 elseif ($_REQUEST["accion"] == 'fn_eliminar_delito') 
{
	$estatus = $v->eliminar_delito($_REQUEST["id"], $_REQUEST["delito"]);
	header('Content-Type: application/json');
	$datos = array('estatus' => $estatus);
	echo json_encode($datos, JSON_FORCE_OBJECT);
} 
elseif ($_REQUEST["accion"] == 'fn_obtener_delito') {
	$arr_res = $v->obtener_delito($_REQUEST["id"]);
	foreach ($arr_res as $row) {
		header('Content-Type: application/json');
		$datos = array(
			'delito'     => $row["delito"],
		
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
}
//parentesco
elseif($_REQUEST["accion"] == 'fn_guardar_parentesco')
{

		if($_REQUEST["id"] == '0') // nuevo registro
			$estatus = $v->insertar_parentesco($_REQUEST["parentesco"]);
		else
			$estatus = $v->editar_parentesco($_REQUEST["id"],$_REQUEST["parentesco"]);


	header('Content-Type: application/json');	
	$datos = array('estatus' => $estatus);	
	echo json_encode($datos, JSON_FORCE_OBJECT);	
}
if ($_REQUEST["accion"] == 'fn_listar_parentescos') 
{

	$arr_res = $v->lista_parentescos();
	$size = sizeof($arr_res);
	if (empty($arr_res)) {
		$html =
			'
        <p>!No Hay Datos</p>
        ';
	} else {
		$html = '  		
		<table id="tbl_parentescos" class="table table-hover table-striped table-sm table-responsive-sm">
	    <thead class="tbl-estadisticas">
	      <tr align="center">
	        <th width="100%" align="center">
				<div class="row" >
					<div class="col-md-4">Id</div>
					<div class="col-md-4">Tipo Parentesco</div>
					<div class="col-md-4">Acciones</div>

				<div>
			
			</th>

	      </tr>
	    </thead>
	    <tbody>';
		foreach ($arr_res as $row) {
			$html .= '
	        <tr class="text-11" id="l_par' . $row["id_parentesco"] . '">
				<td align="center">
					<div class="row">
						<div class="col-md-4">
								' . $row["id_parentesco"] . '
						</div>
						<div class="col-md-4">
								' . $row["parentesco"] . '
						</div>
						<div class="col-md-4" aling="center">
							
							<button type="button" class="btn btn-dark btn-sm hint--bottom" aria-label="Editar Parentesco" onclick="mod_cat_parentesco(2,\'' . $row["id_parentesco"] . '\');">
								<i class="bi bi-pencil-square"></i>
								<span class="etiq_cel">Editar</span>
							</button>
							<button type="button" class="btn btn-danger btn-sm hint--bottom" aria-label="Eliminar Parentesco" onclick="fn_eliminar_parentesco(\'' . $row["id_parentesco"] . '\',\'' . $row["parentesco"] . '\');">
								<i class="bi bi-trash"></i>
								<span class="etiq_cel">Eliminar</span>
							</button>
						</div>              
					</div>
				</td>                
	        </tr>';
		}
		$html .= '
    	</tbody>
  	</table>';
	}
	echo $html;
}
elseif($_REQUEST["accion"] == 'fn_eliminar_parentescos')
{
		$estatus = $v->eliminar_parentesco($_REQUEST["id"],$_REQUEST["parentesco"]);

	header('Content-Type: application/json');	
	$datos = array('estatus' => $estatus);	
	echo json_encode($datos, JSON_FORCE_OBJECT);	
}
elseif ($_REQUEST["accion"] == 'fn_obtener_parentesco') {
	$arr_res = $v->obtener_parentesco($_REQUEST["id"]);
	foreach ($arr_res as $row) {
		header('Content-Type: application/json');
		$datos = array(
			'parentesco'     => $row["parentesco"],
		
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
}
//MUNICIPIO
elseif($_REQUEST["accion"] == 'fn_guardar_municipio')
{

		if($_REQUEST["id"] == '0') // nuevo registro
			$estatus = $v->insertar_municipio($_REQUEST["municipio"]);
		else
			$estatus = $v->editar_municipio($_REQUEST["id"],$_REQUEST["municipio"]);


	header('Content-Type: application/json');	
	$datos = array('estatus' => $estatus);	
	echo json_encode($datos, JSON_FORCE_OBJECT);	
}
if ($_REQUEST["accion"] == 'fn_listar_municipios') 
{

	$arr_res = $v->lista_municipios();
	$size = sizeof($arr_res);
	if (empty($arr_res)) {
		$html =
			'
        <p>!No Hay Datos</p>
        ';
	} else {
		$html = '  		
		<table id="tbl_mun" class="table table-hover table-striped table-sm table-responsive-sm">
	    <thead class="tbl-estadisticas">
	      <tr align="center">
	        <th width="100%" align="center">
				<div class="row" >
					<div class="col-md-4">Id</div>
					<div class="col-md-4">Municipio</div>
					<div class="col-md-4">Acciones</div>

				<div>
			
			</th>

	      </tr>
	    </thead>
	    <tbody>';
		foreach ($arr_res as $row) {
			$html .= '
	        <tr class="text-11" id="l_umn' . $row["id_municipio"] . '">
				<td align="center">
					<div class="row">
						<div class="col-md-4">
								' . $row["id_municipio"] . '
						</div>
						<div class="col-md-4">
								' . $row["municipio"] . '
						</div>
						<div class="col-md-4" aling="center">
							
							<button type="button" class="btn btn-dark btn-sm hint--bottom" aria-label="Editar Municipio" onclick="mod_cat_municipio(2,\'' . $row["id_municipio"] . '\');">
								<i class="bi bi-pencil-square"></i>
								<span class="etiq_cel">Editar</span>
							</button>
							<button type="button" class="btn btn-danger btn-sm hint--bottom" aria-label="Eliminar MUnicipio" onclick="fn_eliminar_municipio(\'' . $row["id_municipio"] . '\',\'' . $row["municipio"] . '\');">
								<i class="bi bi-trash"></i>
								<span class="etiq_cel">Eliminar</span>
							</button>
						</div>              
					</div>
				</td>                
	        </tr>';
		}
		$html .= '
    	</tbody>
  	</table>';
	}
	echo $html;
}
elseif($_REQUEST["accion"] == 'fn_eliminar_municipios')
{
		$estatus = $v->eliminar_municipio($_REQUEST["id"],$_REQUEST["municipio"]);

	header('Content-Type: application/json');	
	$datos = array('estatus' => $estatus);	
	echo json_encode($datos, JSON_FORCE_OBJECT);	
}
elseif ($_REQUEST["accion"] == 'fn_obtener_municipio') {
	$arr_res = $v->obtener_municipio($_REQUEST["id"]);
	foreach ($arr_res as $row) {
		header('Content-Type: application/json');
		$datos = array(
			'municipio'     => $row["municipio"],
		
		);
		echo json_encode($datos, JSON_FORCE_OBJECT);
	}
}