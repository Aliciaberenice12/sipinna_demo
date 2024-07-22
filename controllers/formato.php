<?php
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
						$sin_imagen='';
						$estatus = $v->insertar_canalizacion($sin_imagen, $datos_exp_can);
						

					}
					
				}
				else ///Editar Registro Administrador
				{
                    print_r($_POST);
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
						$nom_archivo='';
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