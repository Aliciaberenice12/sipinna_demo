<!--Modal Crear-->
<div class="modal fade" id="modal_c4">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_c4" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id=form_agregar>
                    <input type="hidden" name="id_caso" id="id_caso" value="0">
                    <input type="hidden" name="c4_exp_folio" id="c4_exp_folio" value="0">

                    <div class="row">
                        <div class="card">
                            <div class=" row card-body">
                                <h4><strong>Rellene los siguientes campos</strong></h4>
                                <div class="col-md-2">
                                    <label for="c4_codigo">Codigo *</label>
                                    <input class="form-control" name="c4_codigo" id="c4_codigo" placeholder="Codigo *" rows="1">
                                </div>
                                <div class="col-md-2">
                                    <label for="c4_folio">Folio *</label>
                                    <input class="form-control" name="c4_folio" id="c4_folio" placeholder="Folio *" rows="1">
                                </div>
                                <div class="col-md-2">
                                    <label for="c4_numero">Número:</label>
                                    <input type="text" class="form-control" placeholder="Número" id="c4_numero" name="c4_numero">
                                </div>
                                <div class="col-md-2">
                                    <labe0l for="c4_no_oficio">Número Oficio:</label>
                                        <input type="text" class="form-control" placeholder="No.Oficio" id="c4_no_oficio" name="c4_no_oficio">
                                </div>
                                <div class="col-md-4">
                                    <label for="c4_ruta_sol_oficio">Archivo Solicitud de Canalización:</label>
                                    <input type="file" class="form-control" id="c4_ruta_sol_oficio" name="c4_ruta_sol_oficio" accept="image/*">
                                </div>
                                <div class="col-md-3">
                                    <label for="c4_fecha_inicio">Fecha:</label>
                                    <input type="date" class="form-control" placeholder="Fecha" id="c4_fecha_inicio" name="c4_fecha_inicio">
                                </div>
                                <div class="col-3">
                                    <label for="c4_pais">Pais:</label>
                                    <input type="text" id="c4_pais" name="c4_pais" placeholder="Pais" class="form-control">

                                </div>
                                <div class="col-3">
                                    <label for="c4_edo">Estado:</label>
                                    <select name="c4_edo" id="c4_edo" class="form-select">
                                        <option value="0">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="c4_municipio">Municipio:</label>
                                    <select name="c4_mun" id="c4_mun" class="form-select" required>
                                        <option value="0">Seleccionar</option>
                                    </select>
                                    <input type="text" id="c4_mun_edo" name="c4_mun_edo" class="form-control">

                                </div>
                                <div class="col-md-6">
                                    <label for="c4_dirigido">Dirigido:</label>
                                    <input type="text" class="form-control" id="c4_dirigido" name="c4_dirigido">
                                </div>
                                <div class="col-md-6">
                                    <label for="c4_dg">Director General:</label>
                                    <input class="form-control" type="text" id="c4_dg" name="c4_dg">
                                </div>
                                <!--Aqui comienza desc caso c4-->

                                <div class="col-md-4">
                                    <input type="hidden" name="id_desc_caso" id="id_desc_caso" value="0">
                                    <label for="c4_lugar_hechos">Lugar de los hechos :</label>
                                    <textarea id="c4_lugar_hechos" name="c4_lugar_hechos" placeholder="Descripción..." class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="c4_des_hechos">Hechos:</label>
                                    <textarea id="c4_des_hechos" name="c4_des_hechos" placeholder="Descripción..." class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="c4_observaciones">Observaciones:</label>
                                    <textarea id="c4_observaciones" name="c4_observaciones" placeholder="Observaciones..." class="form-control" rows="3"></textarea>
                                </div>
                                <!--Aqui Termina desc caso c4-->

                            </div>

                        </div>

                        <!--Aqui empieza Reportantes-->

                        <div class="card">
                            <h5><br><strong> Datos del Reportante:</strong></h5>

                            <div class="row card-body" id="add_reportantes">
                                <input type="hidden" name="id_reportante_c4" id="id_reportante_c4" value="0">

                                <div class="col-md-5">
                                    <label for="c4_inst_rep">Institución Reportante:</label>
                                    <input type="text" class="form-control" name="c4_inst_rep" id="c4_inst_rep">
                                </div>
                                <div class="col-md-5">
                                    <label for="c4_nom_rep">Nombre Reportante:</label>
                                    <input type="text" class="form-control" name="c4_nom_rep" id="c4_nom_rep">
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button class="btn btn-success" type="button" onclick="carrito_reportante(1,0);">
                                        <i class="bi bi-plus-circle"> </i>Agregar
                                    </button>
                                </div>
                                <div id="lista_dat_rep_c4"></div>

                            </div>
                            <div id="lista_bd_dat_rep_c4"></div>

                        </div>


                        <!--Aqui Termina Reportantes-->

                        <!--Probable Responsable-->

                        <div class="card">
                            <h5><br><strong>Datos de probable(s) responsable(s) :</strong></h5>

                            <div class="row card-body" id="add_pro_resp">
                                <input type="hidden" name="id_pro_responsable" id="id_pro_responsable" value="0">

                                <div class="col-md-4">
                                    <label for="c4_nom_responsable">Nombre Probable responsable:</label>
                                    <input type="text" class="form-control" name="c4_nom_responsable" id="c4_nom_responsable">
                                </div>
                                <div class="col-md-3">
                                    <label for="c4_edad_responsable">Edad Probable responsable:</label>
                                    <input type="text" class="form-control" name="c4_edad_responsable" id="c4_edad_responsable">
                                </div>

                                <div class="col-md-3">
                                    <label for="c4_parentesco">Parentesco con victima:</label>
                                    <select name="c4_parentesco" id="c4_parentesco" class="form-select" required>
                                        <option value="0">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button class="btn btn-success" type="button" onclick="carrito_probable_resp(1,0);">
                                        <i class="bi bi-plus-circle"> </i>Agregar
                                    </button>
                                </div>
                                <div id="lista_probable_res"></div>

                            </div>
                            <div id="lista_bd_probable_res"></div>

                        </div>

                        <!--Termina Probable Responsable-->

                        <div class="card">
                            <h5><br><strong>Datos de presunta(s) victima(s) :</strong></h5>

                            <input type="hidden" name="id_victima_c4" id="id_victima_c4" value="0">

                            <div class="row card-body" id="add_victimas">
                                <div class="col-md-3">
                                    <label for="c4_edad_vic">Edad Victima:</label>
                                    <input type="text" class="form-control" placeholder="Edad Victima" id="c4_edad_vic" name="c4_edad_vic" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="c4_nom_vic">Nombre Victima:</label>
                                    <input type="text" class="form-control" placeholder="Nombre Victima" id="c4_nom_vic" name="c4_nom_vic" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="c4_delitos">Tipo de Delito:</label>
                                    <select name="c4_delitos" id="c4_delitos" class="form-select" required>
                                        <option value="0"></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="c4_num_delitos">Número de delitos:</label>
                                    <input type="NUMBER" class="form-control" placeholder="Número de Delitos" id="c4_num_delitos" name="c4_num_delitos" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="c4_der_vul">Derechos Vulnerados o restringidos:</label>
                                    <select name="c4_der_vul" id="c4_der_vul" class="form-select" required>
                                        <option value="0"></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Agresión extraordinaria</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_tercera_edad" id="c4_per_tercera_edad">
                                        <label class="form-check-label" for="c4_per_tercera_edad">
                                            Otros (personas de la tercera edad)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_violencia" id="c4_per_violencia">
                                        <label class="form-check-label" for="c4_per_violencia">
                                            Violencia Contra la mujer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_discapacidad" id="c4_per_discapacidad">
                                        <label class="form-check-label" for="c4_per_discapacidad">
                                            Persona con Alguna Discapacidad
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_indigena" id="c4_per_indigena">
                                        <label class="form-check-label" for="c4_per_indigena">
                                            Persona Indigena
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_transgenero" id="c4_per_transgenero">
                                        <label class="form-check-label" for="c4_per_transgenero">
                                            Persona Transgenero
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label><STRONG>Sexo</STRONG></label>
                                    <br>
                                    <input type="radio" id="masculino" name="c4_sexo_victima" value="Masculino">
                                    <label for="c4_masculino">Masculino</label><br>
                                    <input type="radio" id="femenino" name="c4_sexo_victima" value="Femenino">
                                    <label for="femenino">Femenino</label><br>
                                    <input type="radio" id="n_i" name="c4_sexo_victima" value="N/I" checked>
                                    <label for="n_i">N/I</label>
                                </div>
                                <div>
                                    <button class="btn btn-success" type="button" onclick="carrito_victima_c4(2,1,0);">
                                        <i class="bi bi-plus-circle"> Agregar</i>
                                    </button>
                                </div>
                                <div id="lista_dat_vic_c4"></div>
                            </div>
                            <div id="lista_bd_victimas"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button type="submit" class="btn btn-success" id="btn_create_caso" onclick="fun_agregar_caso_c4();">Agregar</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Reportante-->
<div class="modal" tabindex="-1" id="modal_reportante_c4">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="tit_mod_reportante_c4" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row modal-body">
                <input type="hidden" name="id_reportante_c4_edit" id="id_reportante_c4_edit" value="0">

                <div class="col-md-6">
                    <label for="can_inst_rep_c4">Institución Reportante:</label>
                    <input type="text" class="form-control" name="can_inst_rep_c4_edit" id="can_inst_rep_c4_edit">
                </div>
                <div class="col-md-6">
                    <label for="can_nom_rep">Nombre Reportante:</label>
                    <input type="text" class="form-control" name="can_nom_rep_c4_edit" id="can_nom_rep_c4_edit">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="fun_editar_reportante_c4();">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Problable Responsable-->
<div class="modal" tabindex="-1" id="modal_pro_resp_c4">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="tit_mod_pro_res_c4" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row modal-body">
                <input type="hidden" name="id_pro_responsable_edit" id="id_pro_responsable_edit" value="0">

                <div class="col-md-4">
                    <label for="c4_edad_responsable_edit">Edad Probable Responsable:</label>
                    <input type="text" class="form-control" name="c4_edad_responsable_edit" id="c4_edad_responsable_edit">
                </div>
                <div class="col-md-4">
                    <label for="c4_nom_responsable_edit">Nombre Probable Responsable:</label>
                    <input type="text" class="form-control" name="c4_nom_responsable_edit" id="c4_nom_responsable_edit">
                </div>
                <div class="col-md-4">
                    <label for="c4_parentesco_edit">Parentesco con victima:</label>
                    <select name="c4_parentesco_edit" id="c4_parentesco_edit" class="form-select" required>
                        <option value="0">Seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="fun_editar_pro_res_c4();">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--Modal Agregar Datos Victima-->
<div class="modal fade" id="modal_victima_c4">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_victima_c4" style="color:white;">Agregar Victima</h5>
            </div>
            
            <div class="row modal-body">
                <div>
                    <div class="col-md-12">
                        <input type="hidden" name="id_c4_victima_edit" id="id_c4_victima_edit" value="0">
                        <input type="hidden" name="can_exp_folio_victima_edit" id="can_exp_folio_victima_edit" value="0">
                        <h5><strong>Datos de presunta(s) victima(s) :</strong></h5>
                    </div>
                    <div class="row col-md-12" id="victimas">
                        <div class="col-md-2">
                            <label for="c4_edad_victima_edit">Edad:</label>
                            <input type="text" class="form-control" placeholder="Edad Victima" id="c4_edad_victima_edit" name="c4_edad_victima_edit" required>
                        </div>
                        <div class="col-md-5">
                            <label for="c4_nom_victima_edit">Nombre Victima:</label>
                            <input type="text" class="form-control" placeholder="Nombre Victima" id="c4_nom_victima_edit" name="c4_nom_victima_edit" required>
                        </div>
                        <div class="col-md-5">
                            <label for="c4_num_delitos_edit">Número de delitos:</label>
                            <input type="text" class="form-control" placeholder="Nombre Victima" id="c4_num_delitos_edit" name="c4_num_delitos_edit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="id_c4_del_victima_edit">Tipo de Delito:</label>
                            <input type="hidden" name="id_c4_del_victima_edit" id="id_c4_del_victima_edit" value="0">

                            <select name="c4_delito_edit" id="c4_delito_edit" class="form-select">
                                <option value="0"></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="c4_der_vul_vic_edit">Derechos Vulnerados o restringidos:</label><br>
                            <input type="hidden" name="id_c4_der_victima_edit" id="id_c4_der_victima_edit" value="0">
                            <select name="c4_der_vul_vic_edit" id="c4_der_vul_vic_edit" class="form-select">
                                <option value="0"></option>
                            </select>
                        </div>
                        <p></p>
                        <div class="row col-md-8">
                            <label><STRONG>Agresión extraordinaria</STRONG></label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="c4_per_tercera_edad_edit" id="c4_per_tercera_edad_edit">
                                    <label class="form-check-label" for="c4_per_tercera_edad_edit">
                                        Otros (personas de la tercera edad)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="c4_per_indigena_edit" id="c4_per_indigena_edit">
                                    <label class="form-check-label" for="c4_per_indigena_edit">
                                        Persona Indigena
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="c4_per_transgenero_edit" id="c4_per_transgenero_edit">
                                    <label class="form-check-label" for="c4_per_transgenero_edit">
                                        Persona Transgenero
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="c4_per_discapacidad_edit" id="c4_per_discapacidad_edit">
                                    <label class="form-check-label" for="c4_per_discapacidad_edit">
                                        Persona con alguna discapacidad
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="c4_per_violencia_edit" id="c4_per_violencia_edit">
                                    <label class="form-check-label" for="c4_per_violencia_edit">
                                        Violencia Contra la mujer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label><STRONG>Sexo</STRONG></label>
                            <br>
                            <input type="radio" id="masculino_edit" name="c4_sexo_victima_edit" value="Masculino">
                            <label for="masculino_edit">Masculino</label><br>
                            <input type="radio" id="femenino_edit" name="c4_sexo_victima_edit" value="Femenino">
                            <label for="femenino_edit">Femenino</label><br>
                            <input type="radio" id="n_i_edit" name="c4_sexo_victima_edit" value="N/I" >
                            <label for="n_i_edit">N/I</label>

                        </div>

                    </div>
                  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success" onclick="fun_editar_victima_c4();">Agregar</button>
            </div>
 
        </div>
    </div>
</div>