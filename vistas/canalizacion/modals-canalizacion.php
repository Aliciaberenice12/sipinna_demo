<!--Modal Crear-->
<div id="modal_canalizacion" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_can" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="hidden" name="id_canalizacion" id="id_canalizacion" value="0">
                    <input type="hidden" name="can_folio_expediente" id="can_folio_expediente" value="0">
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <h4><strong>Rellene los siguientes campos</strong></h4>
                                <small id="helpCamposObligatorios" class="form-text text-muted">*Campos Obligatorios</small>

                            </div>
                          
                            <div class="col-md-6">
                                <label for="estatus">
                                    <strong>Estatus del caso* </strong>
                                </label>
                                <div class="btn-group" role="group" aria-label="Boton Estatus">

                                    <input type="radio" class="btn-check" name="estatus_expediente" id="pendiente" value="Pendiente" autocomplete="off">
                                    <label class="btn btn-recepcion" for="pendiente">Pendiente</label>

                                    <input type="radio" class="btn-check" name="estatus_expediente" id="en_proceso" value="En proceso" autocomplete="off">
                                    <label class="btn btn-recepcion" for="en_proceso">En proceso</label>

                                    <input type="radio" class="btn-check" name="estatus_expediente" id="concluido" value="Concluido" autocomplete="off">
                                    <label class="btn btn-recepcion" for="concluido">Concluido</label>


                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="card">
                            <div class="row card-body" id="card_can_exp">
                                <div class="col-md-6">
                                    <label for="can_via_rec" id="can_via">Vía de Recepción *</label><br>
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="can_via_rec" id="can_via_tel" value="Telefonica" autocomplete="off">
                                        <label class="btn btn-recepcion" for="can_via_tel">Telefónica</label>

                                        <input type="radio" class="btn-check" name="can_via_rec" id="can_via_per" value="Personal" autocomplete="off">
                                        <label class="btn btn-recepcion" for="can_via_per">Personal</label>

                                        <input type="radio" class="btn-check" name="can_via_rec" id="can_via_cor" value="Correo" autocomplete="off">
                                        <label class="btn btn-recepcion" for="can_via_cor">Correo</label>

                                        <input type="radio" class="btn-check" name="can_via_rec" id="can_via_red" value="Redes Sociales" autocomplete="off">
                                        <label class="btn btn-recepcion" for="can_via_red">Redes Sociales</label>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <label for="can_ruta_sol_oficio">Archivo Solicitud de Canalización *</label>
                                    <input type="file" class="form-control" id="can_ruta_sol_oficio" name="can_ruta_sol_oficio" accept="application/pdf">
                                    <input type="hidden" name="can_ruta_sol_oficio_edit" id="can_ruta_sol_oficio_edit" value="0">
                                    <span class="archivo_subido_local" id="imagen_subida_can"></span>

                                </div>
                                <br>
                                <div class="col-md-3">
                                    <label for="can_numero">Número *</label>
                                    <input type="text" class="form-control" placeholder="Número" id="can_numero" name="can_numero" onkeypress="return onlyNumberKey(event)" maxlength="10">
                                    <small id="helpNumeroc4" class="form-text text-muted">**Solo acepta Números</small>

                                </div>
                                <div class="col-md-3">
                                    <label for="can_num_oficio">Número Oficio *</label>
                                    <input type="text" class="form-control" placeholder="Número Oficio" id="can_num_oficio" name="can_num_oficio" maxlength="50">

                                </div>
                                <div class="col-md-3">
                                    <label for="can_folio">Folio </label>
                                    <input type="text" class="form-control" placeholder="Folio" id="can_folio" name="can_folio" maxlength="50">
                                </div>
                                <div class="col-md-3">
                                    <label for="can_fecha">Fecha *</label>
                                    <input type="date" class="form-control" placeholder="Fecha" id="can_fecha" name="can_fecha">
                                </div>

                                <div class="col-md-3">
                                    <label for="can_pais">Pais *</label>
                                    <select name="can_pais" id="can_pais" class="form-select">
                                        <option value="" selected disabled>Seleccione</option>
                                        <optgroup label="América">
                                            <option value="Argentina">Argentina</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Brasil">Brasil</option>
                                            <option value="Chile">Chile</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Guayana Francesa">Guayana Francesa</option>
                                            <option value="Granada">Granada</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guayana">Guayana</option>
                                            <option value="Haití">Haití</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="México">México</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Panamá">Panamá</option>
                                            <option value="Perú">Perú</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="República Dominicana">República Dominicana</option>
                                            <option value="Surinam">Surinam</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="Europa">
                                            <option value="7">España</option>
                                            <option value="8">Francia</option>
                                            <option value="9">Italia</option>
                                            <option value="10">Suiza</option>
                                            <option value="11">Alemania</option>
                                            <option value="13">Holanda</option>
                                            <option value="14">Polonia</option>
                                            <option value="15">Grecia</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-5" id="div_otros_estados">
                                    <label for="can_otros_estados">Descripción de Estado</label>
                                    <input type="text" class="form-control" placeholder="Describe estado" id="can_otros_estados" name="can_otros_estados" maxlength="30">

                                </div>

                                <div class="col-md-3" id="div_estado">
                                    <label for="can_estado_label">Estado *</label>
                                    <select name="can_estado" id="can_estado" class="form-select">
                                    </select>
                                </div>
                                <div class="col-md-3" id="div_municipio">
                                    <label for="can_mun" id="can_mun">Municipio *</label>
                                    <select name="can_municipio" id="can_municipio" class="form-select" required>
                                    </select>
                                    <input id="can_mun_edo" name="can_mun_edo" class="form-control" maxlength="30">
                                    </input>
                                </div>
                                <input type="hidden" name="id_caso_reportado" id="id_caso_reportado" value="0">

                                <div class="col-md-12">
                                    <label for="inst_con_hecho">Instancias que previamente han conocido los hechos:
                                    </label>
                                    <input type="text" class="form-control" id="ins_con_hechos" name="ins_con_hechos" maxlength="70"></input>

                                </div>
                                <div class="col-md-6">

                                    <label for="can_des_suncita_rep">Descripción sucinta del caso *</label>

                                    <textarea name="can_des_suncita_rep" id="can_des_suncita_rep" class="form-control" rows="3" maxlength="500"></textarea>
                                    <div id="contador">0/100</div>
                                </div>
                                <div class="col-md-6">

                                    <label for="can_ges_reporte">Gestiones realizadas por la Secretaría Ejecutiva del SIPINNA Estatal *</label>

                                    <textarea name="can_ges_reporte" id="can_ges_reporte" class="form-control" rows="3" maxlength="500"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--Aqui comienza solicitantes-->
                        <div class="card">
                            <div class="row card-body" id="card_solicitante">
                                <h5><br><strong>Datos Solicitante </strong></h5>

                                <input type="hidden" name="id_solicitante" id="id_solicitante" value="0">

                                <div class="col-md-6">
                                    <label for="can_inst_sol">Institución Solicitante</label>
                                    <input type="text" class="form-control" name="can_inst_sol" id="can_inst_sol" maxlength="50">
                                </div>
                                <div class="col-md-6">
                                    <label for="can_nom_sol">Nombre Solicitante *</label>
                                    <input type="text" class="form-control" name="can_nom_sol" id="can_nom_sol" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <!--Aqui Termina solicitantes-->
                        <div class="card">
                            <div class="row card-body" id="car_reportantes">
                                <div class="row col-md-12" id="datos_reportante">
                                    <input type="hidden" name="id_reportante" id="id_reportante" value="0">
                                    <h5><br><strong> Datos Reportante:</strong></h5>
                                    <div class="col-md-5">
                                        <label for="can_inst_rep">Institución Reportante </label>
                                        <input type="text" class="form-control" name="can_inst_rep" id="can_inst_rep" maxlength="50">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="can_nom_rep">Nombre Reportante </label>
                                        <input type="text" class="form-control" name="can_nom_rep" id="can_nom_rep" maxlength="50">
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button class="btn btn-success" type="button" onclick="carrito_reportante(1,0);">
                                            <i class="bi bi-plus-circle"></i> Registar
                                        </button>
                                    </div>
                                    <div id="lista_dat_rep"></div>
                                </div>
                                <div id="div_lista_reportantes">
                                    <br>

                                    <h5><strong>Lista de Reportantes Registrados</strong></h5>
                                    <div id="listado_reportantes"></div>
                                </div>

                                <div id="ver_lista_reportantes">

                                </div>
                            </div>
                        </div>
                        <!-- Victimas-->
                        <div class="card">
                            <div class="card-body" id="card_victima">
                                <div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="id_can_victima" id="id_can_victima" value="0">
                                        <h5><br><strong>Datos de presunta(s) victima(s) :</strong></h5>
                                    </div>
                                    <div class="row col-md-12" id="victimas">
                                        <div class="col-md-2">
                                            <label for="can_edad_vic">Edad(Años):</label>
                                            <select name="can_edad_vic" id="can_edad_vic" class="form-select">
                                                <option value="0" >Menos de 1 año</option> 
                                                <?php
                                                    for ($i = 1; $i <= 100; $i++) {
                                                        echo "<option value=" . $i . ">" . $i . " Años</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="can_nom_vic">Nombre Victima:</label>
                                            <input type="text" class="form-control" placeholder="Nombre Victima" id="can_nom_vic" name="can_nom_vic" maxlength="50" onkeypress="return check(event)">
                                            <small id="help_nom_vic" class="form-text text-muted">*Solo Aaepta letras</small>

                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label for="can_delito">Tipo de Delito:</label>
                                            <select name="can_delito[]" size="5" id="can_delito" class="form-select" multiple>
                                            </select>
                                            <small id="can_delito" class="form-text text-muted">Seleccione min. 1 max. 4</small>


                                        </div> -->

                                        
                                        <div class="col-md-6">
                                            <label for="can_der_vul_vic">Derechos Vulnerados o restringidos:</label>
                                            <select name="can_der_vul_vic[]" id="can_der_vul_vic" class="form-select">
                                            </select>
                                        </div>
                                        <p></p>
                                        <div class="row col-md-8">
                                            <label><STRONG>Agresión extraordinaria</STRONG></label>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="can_per_tercera_edad" id="can_per_tercera_edad">
                                                    <label class="form-check-label" for="can_per_tercera_edad">
                                                        Otros (personas de la tercera edad)
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="can_per_indigena" id="can_per_indigena">
                                                    <label class="form-check-label" for="can_per_indigena">
                                                        Persona Indigena
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="can_per_transgenero" id="can_per_transgenero">
                                                    <label class="form-check-label" for="can_per_transgenero">
                                                        Persona Transgenero
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="can_per_discapacidad" id="can_per_discapacidad">
                                                    <label class="form-check-label" for="can_per_discapacidad">
                                                        Persona con alguna discapacidad
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="can_per_violencia" id="can_per_violencia">
                                                    <label class="form-check-label" for="can_per_violencia">
                                                        Violencia Contra la mujer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2" id="sexo_victima">
                                            <label><STRONG>Sexo</STRONG></label>
                                            <br>
                                            <input type="radio" id="masculino" name="can_sexo_victima" value="Hombre">
                                            <label for="masculino">Hombre</label><br>
                                            <input type="radio" id="femenino" name="can_sexo_victima" value="Mujer">
                                            <label for="femenino">Mujer</label><br>
                                            <input type="radio" id="n_i" name="can_sexo_victima" value="N/I" checked>
                                            <label for="n_i">N/I</label>

                                        </div>

                                        <div class="col-md-2">
                                            <br>
                                            <button align="left" class="btn btn-success" type="button" onclick="carrito_victima(1,0);">
                                                <i class="bi bi-plus-circle"></i> Registrar
                                            </button>

                                        </div>
                                        <!--div Carrito Victimas-->
                                        <div id="lista_dat_vic"></div>

                                    </div>
                                    <div id="listado_victimas">
                                        <br>
                                        <h5><strong>Lista de victimas registradas</strong></h5>
                                        <div id="ver_lista_victimas"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success" onclick="fun_validar_campos();">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reportante-->
<div class="modal" tabindex="-1" id="modal_reportante">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="tit_mod_reportante" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row modal-body">
                <input type="hidden" name="id_reportante_edit" id="id_reportante_edit" value="0">

                <div class="col-md-6">
                    <label for="can_inst_rep">Institución Reportante:</label>
                    <input type="text" class="form-control" name="can_inst_rep_edit" id="can_inst_rep_edit" maxlength="50">
                </div>
                <div class="col-md-6">
                    <label for="can_nom_rep">Nombre Reportante:</label>
                    <input type="text" class="form-control" name="can_nom_rep_edit" id="can_nom_rep_edit" maxlength="50">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="fun_editar_reportante();">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Victima-->
<div class="modal fade" id="modal_victima">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_victima" style="color:white;">Agregar Victima</h5>
            </div>

            <div class="modal-body">
                <div>
                    <div class="col-md-12">
                        <input type="hidden" name="id_can_victima_edit" id="id_can_victima_edit" value="0">
                        <input type="hidden" name="can_exp_folio_victima_edit" id="can_exp_folio_victima_edit" value="0">
                        <h5><strong>Datos de presunta(s) victima(s) :</strong></h5>
                    </div>
                    <div class="row col-md-12" id="victimas">

                        <div class="col-md-4">
                            <label for="can_edad_vic_edit">Edad(Años):</label>
                            <select name="can_edad_vic_edit" id="can_edad_vic_edit" class="form-select">
                                <option value="0">Menos de un año</option>
                                <?php
                                for ($i = 1; $i <= 100; $i++) {
                                    echo "<option value=" . $i . ">" . $i . " Años</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="can_nom_vic_edit">Nombre Victima:</label>
                            <input type="text" class="form-control" placeholder="Nombre Victima" id="can_nom_vic_edit" name="can_nom_vic_edit" onkeypress="return check(event)">
                        </div>
                        <!-- <div class="col-md-12">
                            <label for="can_delito_edit">Tipo de Delito:</label>
                            <input type="hidden" name="id_can_del_victima_edit" id="id_can_del_victima_edit" value="0">
                            <small id="helpDel" class="form-text text-muted">(Multiple)</small>
                            <select name="can_delito_edit" id="can_delito_edit" class="form-select" multiple>
                                <option value="0"></option>
                            </select>
                        </div> -->
                        <!-- <div class="col-md-3">
                            <label for="can_num_del_edit">Numero delitos:</label>
                            <input type="numer" class="form-control" placeholder="Numero delitos" id="can_num_del_edit" name="can_num_del_edit" maxlength="11">
                        </div> -->
                        <p></p>
                        <div class="col-md-12">
                            <label for="can_der_vul_vic_edit">Derechos Vulnerados o restringidos:</label><br>
                            <input type="hidden" name="id_can_der_victima_edit" id="id_can_der_victima_edit" value="0">

                            <small id="helpDEr" class="form-text text-muted"></small>

                            <select name="can_der_vul_vic_edit[]" id="can_der_vul_vic_edit" class="form-select">
                                <option value="0"></option>
                            </select>
                        </div>
                        <p></p>
                        <div class="row col-md-8">
                            <label><STRONG>Agresión extraordinaria</STRONG></label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_tercera_edad_edit" id="can_per_tercera_edad_edit">
                                    <label class="form-check-label" for="can_per_tercera_edad_edit">
                                        Otros (personas de la tercera edad)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_indigena_edit" id="can_per_indigena_edit">
                                    <label class="form-check-label" for="can_per_indigena_edit">
                                        Persona Indigena
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_transgenero_edit" id="can_per_transgenero_edit">
                                    <label class="form-check-label" for="can_per_transgenero_edit">
                                        Persona Transgenero
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_discapacidad_edit" id="can_per_discapacidad_edit">
                                    <label class="form-check-label" for="can_per_discapacidad_edit">
                                        Persona con alguna discapacidad
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_violencia_edit" id="can_per_violencia_edit">
                                    <label class="form-check-label" for="can_per_violencia_edit">
                                        Violencia Contra la mujer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label><STRONG>Sexo</STRONG></label>
                            <br>
                            <input type="radio" id="masculino_edit" name="can_sexo_victima_edit" value="Hombre">
                            <label for="masculino_edit">Hombre</label><br>
                            <input type="radio" id="femenino_edit" name="can_sexo_victima_edit" value="Mujer">
                            <label for="femenino_edit">Mujer</label><br>
                            <input type="radio" id="n_i_edit" name="can_sexo_victima_edit" value="N/I">
                            <label for="n_i_edit">N/I</label>

                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="fun_editar_victima();">Guardar</button>
            </div>

        </div>
    </div>
</div>

<!--Modal  INDEX Avances-->
<div class="modal fade" id="avancesCanalizacion" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_can_avance" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 align="center"><strong>Avances del caso, indicando fecha y actividades específicas.</strong></h5>
                            <br>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="button" id="agregar_avance" class="btn btn-success" aria-label="limpiar_modal" onclick="fn_modal_avance(2);">
                                    <i class="bi bi-plus"></i>
                                    <span>Agregar</span>
                                </button>
                            </div>
                            <p></p>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 id="crear_nuevo_avance">
                                    <strong>Agregar Nuevo avance</strong>

                                </h5>
                                <h5 id="editar_avance">
                                    <strong>Editar </strong>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row col-md-12" id="avance" name="avance">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control" name="id_can_avance" id="id_can_avance" value="0" disabled>
                                        <input type="hidden" class="form-control" name="folio_can" id="folio_can" value="0">

                                    </div>


                                    <div class="col-md-4">
                                        <label>Fecha:</label>
                                        <input type="date" class="form-control" id="can_fecha_avance" name="can_fecha_avance"></input>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Actividades específicas:</label>
                                        <textarea name="textarea" id="can_desc_avance" name="can_desc_avance" class="form-control" rows="2" maxlength="500" > </textarea>

                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button type="button" class="btn btn-success" onclick="fun_agregar_avance();">Agregar </button>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="card" id="listado_avances">
                            <div class="card-body">
                                <div id="nombre_listado">
                                </div>
                                <h5 align="certer">Listado de Avances Registrados</h5>
                                <div id="ver_lista_avances"></div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>

        </div>
    </div>
</div>