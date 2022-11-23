<!--Modal Crear-->
<div class="modal fade" id="modal_canalizacion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_can" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <div class="container-fluid">
                        <input type="hidden" name="id_canalizacion" id="id_canalizacion" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <h5><strong>Rellene los siguientes campos</strong></h5>
                            </div>
                            <div class="row col-md-6">
                                <label>Vía de Recepción:</label><br>
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

                                <label>Archivo Solicitud de Canalización:</label>
                                <input type="file" class="form-control" id="can_ruta_sol_oficio" name="can_ruta_sol_oficio" accept="">

                            </div>
                            <br>
                            <div class="col-md-3">
                                <label>Número:</label>
                                <input type="text" class="form-control" placeholder="Número" id="can_numero" name="can_numero">
                            </div>
                            <div class="col-md-3">
                                <label>Número Oficio:</label>
                                <input type="text" class="form-control" placeholder="Número Oficio" id="can_num_oficio" name="can_num_oficio">
                            </div>
                            <div class="col-md-3">
                                <label>Folio:</label>
                                <input type="text" class="form-control" placeholder="Folio" id="can_folio" name="can_folio">
                            </div>
                            <div class="col-md-3">
                                <label>Fecha:</label>
                                <input type="date" class="form-control" placeholder="Fecha" id="can_fecha" name="can_fecha">
                            </div>
                            <div class="col-md-3">
                                <label>Pais:</label>
                                <input type="text" class="form-control" placeholder="Pais" id="can_pais" name="can_pais">
                            </div>

                            <div class="col-3">
                                <label for="can_edo">Estados</label>
                                <select name="can_estado" id="can_estado" class="form-select">
                                    <option value="0">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="can_mun" id="can_mun" >Municipios</label>
                                <select name="can_municipio" id="can_municipio" class="form-select" required>
                                    <option value="0">Seleccionar</option>
                                </select>
                                <input id="can_mun_edo" name="can_mun_edo" class="form-control">
                                </input>
                            </div>
                            <div class="col-md-12">
                                <label for="inst_con_hecho">Instancias que previamente han conocido los hechos
                                </label>
                                <input type="text" class="form-control" id="ins_con_hechos" name="ins_con_hechos"></input>

                            </div>
                            <div class="col-md-4">
                                <br>
                                <label><br>Descripción sucinta del caso:</label>
                                </br>
                                <textarea name="can_des_suncita_rep" id="can_des_suncita_rep" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4">
                                <br>
                                <label>Gestiones realizadas por la Secretaría Ejecutiva:</label>
                                </br>
                                <textarea name="can_ges_reporte" id="can_ges_reporte" class="form-control" rows="3"></textarea>
                            </div>
                            <!-- <div class="col-md-4">
                                <br>
                                <label>Avances del caso, indicando fecha y actividades específicas:</label>
                                <textarea name="can_" class="form-control" rows="3"></textarea>
                                </br>
                            </div> -->

                            <h5><br><strong> Datos Reportante:</strong></h5>
                            <!--Aqui empieza Reportantes-->

                            <div class="col-md-2">
                                <button class="btn btn-recepcion" id="agregar">Añadir campo</button>
                            </div>
                            <div class="form-row clonar">

                                <div class="form-group row col-md-12">

                                    <div class="col-md-6">
                                        <label for="">Institución Reportante:</label>
                                        <input type="text" class="form-control" name="can_inst_rep[]" id="can_inst_rep">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nombre Reportante</label>
                                        <input type="text" class="form-control" name="can_nom_rep[]" id="can_nom_rep">

                                    </div>
                                    <div class="col-sm-1">
                                        <p></p>
                                        <span class="btn btn-sm btn-recepcion puntero ocultar">Eliminar</span>
                                    </div>

                                </div>
                            </div>
                            <div id="contenedor"></div>

                            <!--Aqui Termina Reportantes-->

                            <h5><br><strong> Datos Solicitante:</strong></h5>
                            <div class="col-md-6">
                                <label for="">Institución Solicitante:</label>
                                <input type="text" class="form-control" name="can_inst_sol[]" id="can_inst_sol">
                            </div>

                            <div class="col-md-6">
                                <label for="">Nombre Solicitante</label>
                                <input type="text" class="form-control" name="can_nom_sol[]" id="can_nom_sol">

                            </div>

                            <h5><br><strong>Datos de presunta(s) victima(s) :</strong></h5>
                            <div class="col-md-2">
                                <label>Edad:</label>
                                <input type="text" class="form-control" placeholder="Edad Victima" id="can_edad_vic" name="can_edad_vic" required>
                            </div>
                            <div class="col-md-3">
                                <label>Nombre Victima:</label>
                                <input type="text" class="form-control" placeholder="Nombre Victima" id="can_nom_vic" name="can_nom_vic" required>
                            </div>

                            <div class="col-md-3">
                                <label>Tipo de Delito</label>
                                <select name="can_delitos" id="can_delitos" class="form-select" required>
                                    <option value="0"></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Derechos Vulnerados o restringidos:</label>
                                <input type="text" class="form-control" placeholder="Derecho vulnerado" id="can_der_vul_vic" name="can_der_vul_vic" required>
                            </div>

                            <div class="col-md-4">
                                <label><STRONG>Agresión extraordinaria</STRONG></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_tercera_edad" id="can_per_tercera_edad">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Persona Tercera Edad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_violencia" id="can_per_violencia">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Violencia Contra la mujer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_discapacidad" id="can_per_discapacidad">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Persona con Alguna Discapacidad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_indigena" id="can_per_indigena">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Persona Indigena
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_per_transgenero" id="can_per_transgenero">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Persona Transgenero
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label><STRONG>Sexo</STRONG></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_sexo_victima" id="can_masculino" value="Masculino">
                                    <label class="form-check-label" for="can_masculino">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_sexo_victima" id="can_femenino" value="Femenino">
                                    <label class="form-check-label" for="can_femenino">
                                        Femenino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_sexo_victima" id="can_ni" value="N/I">
                                    <label class="form-check-label" for="can_ni">
                                        N/I
                                    </label>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-success" onclick="fun_agregar();">Agregar</button>

                <!-- <button type="submit" class="btn btn-success" onclick="fun_agregarCanalizacion();">Agregar</button> -->
            </div>

        </div>
    </div>
</div>
<!--Modal  INDEX Avances-->
<div class="modal fade" id="avancesCanalizacion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_can_avance" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <p></p>
                            </div>


                            <div class="col-md-3" id="avance" name="avance">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success" aria-label="limpiar_modal" onclick="fn_modal_avance(1);">
                                        <i class="bi bi-plus"></i>
                                        <span>Agregar</span>
                                    </button>
                                    <strong>
                                        <h5 class="modal-title" id="tit_mod_can_add_avance" style="color:black;"></h5>
                                    </strong>

                                    <input type="hidden" class="form-control" name="id_can_avance" id="id_can_avance" value="0" disabled>
                                </div>
                                <div>
                                    <label>Tipo Avance:</label>
                                    <select name="can_tipo_avance" id="can_tipo_avance" class="form-select">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="Descripción Sucinta del caso.">Descripción Sucinta del caso.</option>
                                        <option value="Gestiones realizadas por la Secretaría Ejecutiva.">Gestiones realizadas por la Secretaría Ejecutiva.</option>
                                        <option value="Avances del caso, indicando fecha y actividades específicas.">Avances del caso, indicando fecha y actividades específicas.</option>

                                    </select>
                                </div>
                                <div>
                                    <label>Fecha:</label>
                                    <input type="date" class="form-control" id="can_fecha_avance" name="can_fecha_avance"></input>
                                </div>
                                <div>
                                    <label>Estatus:</label>
                                    <select name="can_estatus_avance" id="can_estatus_avance" class="form-select">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Concluido">Concluido</option>

                                    </select>

                                </div>
                                <div>
                                    <label>Descripción:</label>
                                    <textarea name="textarea" id="can_desc_avance" name="can_desc_avance" class="form-control" rows="4"></textarea>

                                </div>
                                <div>
                                    <br>
                                    <!-- <button type="button" class="btn btn-success" onclick="fun_agregar_avance();">Agregar </button> -->
                                    <button type="button" class="btn btn-success" onclick="fun_agregar();">Agregar </button>

                                </div>

                            </div>
                            <div class="col-md-9">
                                <div id="ver_lista_avances"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>

        </div>
    </div>
</div>
-->
<!--Modal Crear Avances-->
<div class="modal fade" id="crearAvance">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_can_add_avance" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row">

                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="cancelarAvance">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" style="color:white;">Cancelar Avance</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="">
                                <p>Desea Cancelar Avance creado por <strong>Usuario?</strong></p>
                                <p>Motivo por el cual se elimina:</p>
                                <textarea name="textarea" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">Agregar</button>
            </div>

        </div>
    </div>
</div>



<!--Modal Agregar Datos Victima-->
<!-- <div class="modal fade" id="agregarVictimaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" style="color:white;">Agregar Victima</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre </label>
                                <input type="text" class="form-control">

                                <h5>Género</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="victimaMasculino">
                                    <label class="form-check-label" for="victimaMasculino">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="victimaFemenino" checked>
                                    <label class="form-check-label" for="victimaFemenino">
                                        Femenino
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Edad</label>
                                <input type="number" ondrop="return false;" onpaste="return false;" class="form-control" id="" name="">
                                <h5>Tipo de Violencia </h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agresion_tercera_edad">
                                    <label class="form-check-label" for="Agresion_tercera_edad">
                                        Persona Tercera Edad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agresion_discapacidad">
                                    <label class="form-check-label" for="agresion_discapacidad">
                                        Persona con alguna Discapacidad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agresion_contra_mujer">
                                    <label class="form-check-label" for="agresion_contra_mujer">
                                        Violencia Contra la Mujer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-success">Agregar</button>
            </div>

        </div>
    </div>
</div> -->
<!--Modal Editar Datos Victima-->
<!-- <div class="modal fade" id="editarVictimaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color:white;">Editar Victima</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre </label>
                                <input type="text" class="form-control">

                                <h5>Género</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="victimaMasculino">
                                    <label class="form-check-label" for="victimaMasculino">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="victimaFemenino" checked>
                                    <label class="form-check-label" for="victimaFemenino">
                                        Femenino
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Edad</label>
                                <input type="number" ondrop="return false;" onpaste="return false;" class="form-control" id="" name="">
                                <h5>Tipo de Violencia </h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agresion_tercera_edad">
                                    <label class="form-check-label" for="agresion_tercera_edad">
                                        Persona Tercera Edad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agresion_discapacidad">
                                    <label class="form-check-label" for="agresion_discapacidad">
                                        Persona con alguna Discapacidad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agresion_contra_mujer">
                                    <label class="form-check-label" for="agresion_contra_mujer">
                                        Violencia Contra la Mujer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div> -->
<!--Modal Cancelar Victima-->
<!-- <div class="modal fade" id="eliminarVictimaModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" style="color:white;">Eliminar Victima</h5>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <p><strong>¿Desea Eliminar Victima </strong></p>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">Aceptar</button>
            </div>

        </div>
    </div>
</div> -->