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
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <h4><strong>Rellene los siguientes campos</strong></h4>
                                <small id="helpCamposObligatoriosC4" class="form-text text-muted">*Campos Obligatorios</small>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="card">
                            <div class=" row card-body">
                                <div class="col-md-2">
                                    <label for="c4_folio">Folio *</label>
                                    <input class="form-control" name="c4_folio" id="c4_folio" placeholder="Folio *" rows="1">
                                </div>
                                <div class="col-md-2">
                                    <label for="c4_numero">Número *</label>
                                    <input type="text" class="form-control" placeholder="Número" id="c4_numero" name="c4_numero" onkeypress="return onlyNumberKey(event)" maxlength="10">
                                    <small id="helpNumeroc4" class="form-text text-muted">*Solo acepta numeros</small>
                                </div>
                                <div class="col-md-2">
                                    <labe0l for="c4_no_oficio">Número Oficio *</label>
                                        <input type="text" class="form-control" placeholder="No.Oficio" id="c4_no_oficio" name="c4_no_oficio" maxlength="50">
                                </div>
                                <div class="col-md-6">
                                    <label for="c4_ruta_sol_oficio">Archivo Solicitud de Canalización</label>
                                    <input type="file" class="form-control" id="c4_ruta_sol_oficio" name="c4_ruta_sol_oficio" accept="application/pdf">
                                    <input type="hidden" name="c4_ruta_sol_oficio_edit" id="c4_ruta_sol_oficio_edit" value="0">

                                    <span class="archivo_subido_local" id="imagen_subida_c4"></span>
                                </div>
                                <div>
                                </div>
                                <div class="col-md-3">
                                    <label for="c4_fecha_inicio">Fecha *</label>
                                    <input type="date" class="form-control" placeholder="Fecha" id="c4_fecha_inicio" name="c4_fecha_inicio">
                                </div>
                                <div class="col-md-3">
                                    <label for="c4_pais">Pais *</label>
                                    <select name="c4_pais" id="c4_pais" class="form-select">
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
                                    <br>
                                </div>
                                <div class="col-md-5" id="div_otros_estados_c4">
                                    <label for="otros_estados_c4">Descripción de Estado</label>
                                    <input type="text" class="form-control" placeholder="Describe estado" id="otros_estados_c4" name="otros_estados_c4" maxlength="30">
                                </div>
                                <div class="col-md-3" id="div_estado_c4">
                                    <label for="c4_estado">Estado *</label>
                                    <select name="c4_edo" id="c4_edo" class="form-select">
                                    </select>
                                </div>
                                <div class="col-md-3" id="div_mun_c4">
                                    <label for="c4_municipio" id="c4_municipio">Municipio *</label>
                                    <select name="c4_mun" id="c4_mun" class="form-select" required>
                                    </select>
                                    <input id="c4_mun_edo" name="c4_mun_edo" class="form-control" maxlength="30">
                                    </input>
                                </div>
                                <div class="col-md-6">
                                    <label for="c4_dirigido">Dirigido:</label>
                                    <input type="text" class="form-control" id="c4_dirigido" name="c4_dirigido" maxlength="250">
                                </div>
                                <div class="col-md-6">
                                    <label for="c4_dg">Director General:</label>
                                    <input class="form-control" type="text" id="c4_dg" name="c4_dg" maxlength="250">
                                </div>
                                <!--Aqui comienza desc caso c4-->

                                <div class="col-md-4">
                                    <input type="hidden" name="id_desc_caso" id="id_desc_caso" value="0">
                                    <label for="c4_lugar_hechos">Lugar de los hechos *</label>
                                    <textarea id="c4_lugar_hechos" name="c4_lugar_hechos" placeholder="Descripción..." class="form-control" rows="3" maxlength="250"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="c4_des_hechos">Hechos *</label>
                                    <textarea id="c4_des_hechos" name="c4_des_hechos" placeholder="Descripción..." class="form-control" rows="3" maxlength="400"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="c4_observaciones">Observaciones:</label>
                                    <textarea id="c4_observaciones" name="c4_observaciones" placeholder="Observaciones..." class="form-control" rows="3" maxlength="400"></textarea>
                                </div>
                                <!--Aqui Termina desc caso c4-->

                            </div>
                        </div>
                        <!--Probable Responsable-->
                        <div class="card">
                            <h5><br><strong>Datos de probable(s) responsable(s) :</strong></h5>
                            <div class="row card-body" id="add_pro_resp">
                                <input type="hidden" name="id_pro_responsable" id="id_pro_responsable" value="0">

                                <div class="col-md-4">
                                    <label for="c4_nom_responsable">Nombre Probable responsable:</label>
                                    <input type="text" class="form-control" name="c4_nom_responsable" id="c4_nom_responsable">
                                </div>
                                <div class="col-md-4">
                                    <label for="c4_edad_responsable">Edad Probable responsable(Años):</label>
                                    <select name="c4_edad_responsable" id="c4_edad_responsable" class="form-select">
                                        <option value="0">Se desconoce</option>
                                        <?php
                                        for ($i = 1; $i <= 100; $i++) {
                                            echo "<option value=" . $i . ">" . $i . " Años</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
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
                        <!--Delitos victimas-->

                        <div class="card">
                            <h5><br><strong>Tipo delito:</strong></h5>

                            <div class="row col-md-12" id="agregar_delito_victima">
                                <br>
                                <div class="col-md-10">
                                    <br>
                                    <input type="hidden" name="id_c4_delito" id="id_c4_delito" value="0">
                                    <label for="id_c4_del_victima_edit">Tipo de Delito:</label>
                                    <input type="hidden" name="id_c4_del_victima_edit" id="id_c4_del_victima_edit" value="0">

                                    <select name="c4_delito_edit" id="c4_delito_edit" class="form-select" multiple>
                                        <option value="0"></option>
                                    </select>
                                    <small id="help_c4_del_edit" class="form-text text-muted">Seleccione min. 1 max. 4</small>
                                </div>
                                <div class="col-md-2" align="center">
                                    <br>
                                    <button type="button" class="btn btn-success" id="agregar_delito" onclick="fun_agregar_delito_c4();">
                                        <i class="bi bi-plus"></i>

                                    </button>
                                </div>
                            </div>
                            <div class="row card-body" id="add_delito">
                                <div class="col-md-8">
                                    <label for="c4_delitos">Tipo de Delito:</label>
                                    <select name="c4_delitos" id="c4_delitos" size="5" class="form-select">
                                    </select>
                                    <small id="help_c4_del" class="form-text text-muted">Seleccione min. 1 max. 4</small>

                                </div>
                              
                                <div class="col-md-4">
                                    <br>
                                    <button class="btn btn-success" type="button" onclick="carrito_delito(1,0);">
                                        <i class="bi bi-plus-circle"> </i>Agregar
                                    </button>
                                </div>
                                <div id="lista_delitos_res"></div>

                            </div>
                            <div id="lista_bd_delitos_res"></div>
                        </div>
                        <!--Termina Delitos Victimas-->
                        <!-- victimas -->
                        <div class="card">
                            <h5><br><strong>Datos de presunta(s) victima(s) :</strong></h5>

                            <input type="hidden" name="id_victima_c4" id="id_victima_c4" value="0">

                            <div class="row card-body" id="add_victimas">
                                <div class="col-md-3">
                                    <label for="c4_edad_vic">Edad(Años):</label>
                                    <select name="c4_edad_vic" id="c4_edad_vic" class="form-select">
                                        <option value="se desconoce" disabled selected>Se Desconoce</option>
                                        <option value="0">Menos de 1 año </option>

                                        <?php
                                        for ($i = 0; $i <= 100; $i++) {
                                            echo "<option value=" . $i . ">" . $i . " Años</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label for="c4_nom_vic">Nombre Victima:</label>
                                    <input type="text" class="form-control" placeholder="Nombre Victima" id="c4_nom_vic" name="c4_nom_vic" required>
                                </div>


                                <div class="col-md-4">
                                    <label for="c4_der_vul">Derechos Vulnerados o restringidos:</label>
                                    <select name="c4_der_vul" id="c4_der_vul" class="form-select" required>
                                        <option value="0"></option>
                                    </select>
                                </div>
                                <div class="row col-md-12">
                                    <label><strong>Agresión extraordinaria</strong></label>
                                    <div class="col-md-5">
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
                                    </div>
                                    <div class="col-md-5">
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
                                    <div class="col-md-2">
                                        <label><STRONG>Sexo</STRONG></label>
                                        <br>
                                        <input type="radio" id="masculino" name="c4_sexo_victima" value="Hombre">
                                        <label for="c4_masculino">Hombre</label><br>
                                        <input type="radio" id="femenino" name="c4_sexo_victima" value="Mujer">
                                        <label for="femenino">Mujer</label><br>
                                        <input type="radio" id="n_i" name="c4_sexo_victima" value="N/I" checked>
                                        <label for="n_i">N/I</label>
                                    </div>
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

                <button type="submit" class="btn btn-success" id="btn_create_caso" onclick="fun_agregar_caso_c4();">Guardar</button>
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
                <input type="hidden" name="c4_exp_folio_resp_edit" id="c4_exp_folio_resp_edit" value="0">

                <div class="col-md-4">
                    <br>
                    <label for="c4_edad_responsable_edit">Edad(Años):</label>
                    <select name="c4_edad_responsable_edit" id="c4_edad_responsable_edit" class="form-select">
                        <option value="0">Se desconoce</option>
                        <?php
                        for ($i = 1; $i <= 100; $i++) {
                            echo "<option value=" . $i . ">" . $i . " Años</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="c4_nom_responsable_edit">Nombre Probable Responsable:</label>
                    <input type="text" class="form-control" name="c4_nom_responsable_edit" id="c4_nom_responsable_edit">
                </div>
                <div class="col-md-4">
                    <br>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="row modal-body">
                <div>
                    <div class="col-md-12">
                        <input type="hidden" name="id_c4_victima_edit" id="id_c4_victima_edit" value="0">
                        <input type="hidden" name="can_exp_folio_victima_edit" id="can_exp_folio_victima_edit" value="0">
                        <h5><strong>Datos de presunta(s) victima(s) :</strong></h5>
                    </div>
                    <div class="row col-md-12" id="victimas">
                        <div class="col-md-4">
                            <label for="c4_edad_victima_edit">Edad(Años):</label>
                            <select name="c4_edad_victima_edit" id="c4_edad_victima_edit" class="form-select">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="0">Se desconoce</option>
                                <option value="Menos de 1 año">Menos de 1 año</option>

                                <?php
                                for ($i = 1; $i <= 100; $i++) {
                                    echo "<option value=" . $i . ">" . $i . " Años</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label for="c4_nom_victima_edit">Nombre Victima:</label>
                            <input type="text" class="form-control" placeholder="Nombre Victima" id="c4_nom_victima_edit" name="c4_nom_victima_edit" required>
                        </div>

                        <div class="col-md-12">
                            <label for="c4_der_vul_vic_edit">Derechos Vulnerados o restringidos:</label><br>
                            <input type="hidden" name="id_c4_der_victima_edit" id="id_c4_der_victima_edit" value="0" row="5">
                            <select name="c4_der_vul_vic_edit" id="c4_der_vul_vic_edit" class="form-select">
                                <option value="0"></option>
                            </select>
                        </div>
                        <p></p>
                        <div class="row col-md-10">
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
                            <input type="radio" id="masculino_edit" name="c4_sexo_victima_edit" value="Hombre">
                            <label for="masculino_edit">Hombre</label><br>
                            <input type="radio" id="femenino_edit" name="c4_sexo_victima_edit" value="Mujer">
                            <label for="femenino_edit">Mujer</label><br>
                            <input type="radio" id="n_i_edit" name="c4_sexo_victima_edit" value="N/I">
                            <label for="n_i_edit">N/I</label>

                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success" onclick="fun_editar_victima_c4();">Guardar</button>
            </div>

        </div>
    </div>
</div>