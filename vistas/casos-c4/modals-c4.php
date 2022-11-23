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

                    <div class="row">
                        <h4><strong>Rellene los siguientes campos</strong></h4>
                        <div class="col-md-2">
                            <label for="c4_folio">Folio *</label>
                            <textarea class="form-control" name="c4_folio" id="c4_folio" placeholder="Folio *" rows="1"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label>Archivo Solicitud de Canalización:</label>
                            <input type="file" class="form-control" id="c4_ruta_sol_oficio" name="c4_ruta_sol_oficio" accept="image/*">
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-3">
                            <label>Número Oficio:</label>
                            <input type="text" class="form-control" placeholder="No.Oficio" id="c4_no_oficio" name="c4_no_oficio">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" placeholder="Fecha" id="c4_fecha_inicio" name="c4_fecha_inicio">
                        </div>

                        <div class="col-3">
                            <label for="c4_edo">Estado:</label>
                            <select name="c4_edo" id="c4_edo" class="form-select">
                                <option value="0">Seleccionar</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="c4_mun">Municipio:</label>
                            <select name="c4_mun" id="c4_mun" class="form-select" required>
                                <option value="">Seleccionar</option>
                            </select>
                            <input type="text" id="c4_mun_edo" name="c4_mun_edo" class="form-control">

                        </div>
                        <div class="col-md-6">
                            <label>Dirigido:</label>
                            <input type="text" class="form-control" id="c4_dirigido" name="c4_dirigido">
                        </div>
                        <div class="col-md-6">
                            <label>DG:</label>
                            <input class="form-control" type="text" id="c4_dg" name="c4_dg">
                        </div>


                        <h5><br><strong> Datos del Reportante:</strong></h5>
                        <!--Aqui empieza Reportantes-->

                        <div class="col-md-2">
                            <button class="btn btn-recepcion" id="agregar">Añadir campo</button>
                        </div>
                        <div class="form-row clonar">

                            <div class="form-group row col-md-12">

                                <div class="col-md-6">
                                    <label for="">Institución Reportante:</label>
                                    <input type="text" class="form-control" name="c4_inst_rep[]" id="c4_inst_rep">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nombre Reportante:</label>
                                    <input type="text" class="form-control" name="c4_nom_rep[]" id="c4_nom_rep">

                                </div>
                                <div class="col-sm-1">
                                    <p></p>
                                    <span class="btn btn-sm btn-recepcion puntero ocultar">Eliminar</span>
                                </div>

                            </div>
                        </div>
                        <div id="contenedor"></div>

                        <!--Aqui Termina Reportantes-->

                        <!--Probable Responsable-->
                        <div class="col-md-2">
                            <button class="btn btn-recepcion" id="agregar">Añadir campo</button>
                        </div>
                        <div class="form-row clonar">

                            <div class="form-group row col-md-12">

                                <div class="col-md-6">
                                    <label for="">Nombre Probable responsable:</label>
                                    <input type="text" class="form-control" name="c4_nom_responsable[]" id="c4_nom_responsable">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Edad Probable responsable:</label>
                                    <input type="number" class="form-control" name="c4_edad_responsable[]" id="c4_edad_responsable">
                                </div>

                                <div class="col-3">
                                    <label for="c4_parentesco">Parentesco con victima::</label>
                                    <select name="c4_parentesco" id="c4_parentesco" class="form-select" required>
                                        <option value="0">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <p></p>
                                    <span class="btn btn-sm btn-recepcion puntero ocultar">Eliminar</span>
                                </div>

                            </div>
                        </div>
                        <div id="contenedor"></div>
                        <!--Termina Probable Responsable-->

                        <div class="col-md-6">
                            <label>Lugar de los hechos :</label>
                            <textarea id="c4_lugar_hechos" name="c4_lugar_hechos" placeholder="Descripción..." class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Hechos:</label>
                            <textarea id="c4_des_hechos" name="c4_des_hechos" placeholder="Descripción..." class="form-control" rows="3"></textarea>
                        </div>


                        <h5><br><strong> Victima:</strong></h5>
                        <div class="col-md-2">
                            <button class="btn btn-recepcion" id="agregar_victima">Añadir Victima</button>
                        </div>

                        <div class="form-row clonar_victima">

                            <div class="form-group row col-md-12">

                                <div class="col-md-2">
                                    <label>Edad Victima:</label>
                                    <input type="number" class="form-control" placeholder="Edad Victima" id="c4_edad_vic" name="c4_edad_vic" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Nombre Victima:</label>
                                    <input type="text" class="form-control" placeholder="Nombre Victima" id="c4_nom_vic" name="c4_nom_vic" required>
                                </div>
                              
                                <div class="col-3">
                                    <label>Tipo de Delito</label>
                                    <select name="c4_delitos" id="c4_delitos" class="form-select" required>
                                        <option value="0"></option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Derechos Vulnerados/restringidos:</label>
                                    <input type="text" class="form-control" placeholder="Derecho vulnerado" id="c4_rep_der" name="c4_rep_der" required>
                                </div>
                                <div class="col-md-4">
                                    <label><STRONG>Agresión extraordinaria</STRONG></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_tercera_edad" id="c4_per_tercera_edad">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Persona Tercera Edad
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_violencia" id="c4_per_violencia">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Violencia Contra la mujer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_per_discapacidad" id="c4_per_discapacidad">
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
                                        <input class="form-check-input" type="checkbox" name="can_per_indigena" id="can_per_indigena">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Persona Transgenero
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label><STRONG>Sexo</STRONG></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_gen_vic" id="c4_masculino" value="Masculino">
                                        <label class="form-check-label" for="c4_masculino">
                                            Masculino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_gen_vic" id="c4_masculino" value="Femenino">
                                        <label class="form-check-label" for="c4_masculino">
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="c4_gen_vic" id="c4_ni" value="N/I">
                                        <label class="form-check-label" for="c4_ni">
                                            N/I
                                        </label>
                                    </div>

                                </div>
                                <div>
                                    <hr>
                                </div>
                                <!--Eliminar-->
                                <div class="col-sm-1">
                                    <p></p>
                                    <span class="btn btn-sm btn-recepcion puntero_victima ocultar_victima">Eliminar</span>
                                </div>

                            </div>
                        </div>
                        <div id="contenedor_victima"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-success" id="btn_create_caso" onclick="fun_agregar();">Agregar</button>

                <!-- <button type="submit" class="btn btn-success" id="btn_create_caso" onclick="fun_agregar_caso_c4();">Agregar</button> -->
            </div>

        </div>
    </div>
</div>
<!--Modal Editar-->
<div class="modal fade" id="editarCanalizacion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color:white;">Editar Canalización</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <h4>Rellene los siguientes campos</h4>
                            <div class="col-md-12">
                                <label>Vía de Recepción:</label><br>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio1_edit" id="btnradio1_edit" autocomplete="off" checked>
                                    <label class="btn btn-recepcion" for="btnradio1_edit">Telefónica</label>

                                    <input type="radio" class="btn-check" name="btnradio2_edit" id="btnradio2_edit" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio2_edit">Personal</label>

                                    <input type="radio" class="btn-check" name="btnradio3_edit" id="btnradio3_edit" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio3_edit">Correo</label>

                                    <input type="radio" class="btn-check" name="btnradio4_edit" id="btnradio4_edit" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio4_edit">Redes Sociales</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Número Oficio:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-4">
                                <label>Fecha:</label>
                                <input type="date" class="form-control" placeholder="Fecha" id="fecha" name="fecha">
                            </div>
                            <div class="col-md-4">
                                <label>Municipo:</label>
                                <select name="via_recepcion" class="form-select">
                                    <option value="" selected>Seleccione...</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Nombre Solicitante:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>

                            <div class="col-md-12">
                                <label>Avance(Descripción):</label>
                                <textarea name="textarea" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>
<!--Modal Cancelar-->
<div class="modal fade" id="cancelarCanalizacion">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" style="color:white;">Cancelar canalización</h5>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <p><strong>¿Desea Cancelar Reporte creado por USUARIO?</strong></p>
                    <p><strong>¿Motivos de Cancelación?</strong></p>

                    <div class="col-md-12">
                        <textarea id="" name="" class="form-control" rows="4"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">Cancelar</button>
            </div>

        </div>
    </div>
</div>

<!--Modal Agregar Datos Victima-->
<div class="modal fade" id="agregarVictimaModal">
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
</div>
<!--Modal Editar Datos Victima-->
<div class="modal fade" id="editarVictimaModal">
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
</div>
<!--Modal Cancelar Victima-->
<div class="modal fade" id="eliminarVictimaModal">
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
</div>
<!-- Modal  INDEX Avances -->
<div class="modal fade" id="avances_c4">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_can_avance" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-success" aria-label="Agregar Avance" onclick="fn_modal_avance(1);">
                    <i class="bi bi-plus"></i>
                    <span>Agregar</span>
                </button>

                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <p></p>
                            </div>
                            <div class="col-md-12">
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

<!-- Modal Crear Avances -->
<div class="modal fade" id="crearAvance">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="tit_mod_can_add_avance" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" name="id_can_avance" id="id_can_avance" value="0">

                            <div class="col-md-6">
                                <div class="row">
                                    <div>
                                        <label>Tipo Avance:</label>
                                        <select name="can_tipo_avance" id="can_tipo_avance" class="form-select">
                                            <option value="" selected>Seleccione...</option>
                                            <option value="1">Descripción Sucinta del caso.</option>
                                            <option value="2">Gestiones realizadas por la Secretaría Ejecutiva</option>
                                            <option value="3">Avances del caso, indicando fecha y actividades específicas</option>

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
                                            <option value="1">En proceso</option>
                                            <option value="2">Pendiente</option>
                                            <option value="3">Concluido</option>

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Descripción:</label>
                                <textarea name="textarea" id="can_desc_avance" name="can_desc_avance" class="form-control" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <!-- <button type="button" class="btn btn-success" onclick="fun_agregar_avance();">Agregar </button> -->

                <button type="button" class="btn btn-success" onclick="fun_agregar();">Agregar </button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editarAvance">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color:white;">Editar Avance</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div>
                                        <label>Tipo Avance:</label>
                                        <select name="can_tipo_avance_edit" id="can_tipo_avance_edit" class="form-select">
                                            <option value="" selected>Seleccione...</option>
                                            <option value="1">Avance</option>
                                            <option value="2">Gestiones realizadas por la Secretaría Ejecutiva</option>
                                            <option value="3">Avances del caso, indicando fecha y actividades específicas</option>

                                        </select>
                                    </div>
                                    <div>
                                        <label>Fecha:</label>
                                        <input type="date" class="form-control" id="fecha_edit" name="edit"></input>
                                    </div>
                                    <div>
                                        <label>Estatus:</label>
                                        <select name="can_estatus_avance_edit" id="can_estatus_avance_edit" class="form-select">
                                            <option value="" selected>Seleccione...</option>
                                            <option value="1">En proceso</option>
                                            <option value="2">Pendiente</option>
                                            <option value="3">Concluido</option>

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Avance(Descripción):</label>
                                <textarea name="textarea" class="form-control" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-success">Agregar</button>
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
