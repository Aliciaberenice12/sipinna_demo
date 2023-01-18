<?php
require_once('../models/estadisticas.php');
$v = new Estadisticas();
session_start();

if (isset($_REQUEST['func'])) {
    switch ($_REQUEST['func']) {
        case 'fn_listar_consulta_sexo_municipio':
            $arr_res = $v->lista_consulta_sexo_mun();

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
						<table id="tbl_con_sexo" class="table">
							<thead class="tbl-estadisticas">
							<tr align="center">
							
								<th>
									Municipio
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
											' . $row["Masculino"] . '
											</div>
										</td>
										<td class="col-md-2">
											<div>
											
											' . $row["Femenino"] . '
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
			if (isset($_REQUEST["gen_reporte"]) != '1') //Si No es canalización
			{
				print_r('Seleccionada canalizacion');
				return
			}
			else
			{
				print_r('Seleccionado c4');
			}
			

			
			break;
			
    }
}
