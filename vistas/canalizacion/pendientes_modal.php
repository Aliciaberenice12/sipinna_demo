
<!--Modal Crear-->
<div class="modal fade" id="mostrar_canalizacion" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="tit_mod_mostrar" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="hidden" name="id_canalizacion" id="id_canalizacion" value="0">

                    <div class="row">

                        <div class="col-md-4">
                            <label><strong>vía de Recepción:</strong></label><br>
                            <hr>
                            <p> </p>
                        </div>
                        <div class="col-md-4">
                            <label><strong>Archivo Solicitud de Canalización</strong> </label>
                            <hr>
                        </div>
                        <br>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-3">
                            <label><strong>Número:</strong></label>
                            <hr>

                            <p>Numero</p>
                        </div>
                        <div class="col-md-3">
                            <label><strong>Número Oficio:</strong></label>
                            <hr>
                            <p>Numero Oficio</p>
                        </div>
                        <div class="col-md-3">
                            <label><strong>Folio:</strong></label>
                            <hr>
                            <p>Folio</p>
                        </div>

                        <div class="col-md-3">
                            <label><strong>Fecha:</strong></label>
                            <hr>
                            <p>fecha</p>
                        </div>
                        <div class="col-md-3">
                            <label><strong>Pais:</strong></label>
                            <hr>
                            <p>Pais</p>
                        </div>
                        <div class="col-md-3">
                            <label><strong>Estado:</strong></label>
                            <hr>
                            <p>Estado</p>
                        </div>
                        <div class="col-md-3">
                            <label><strong>Municipio:</strong></label>
                            <hr>
                            <p>Municipio</p>
                        </div>
                        <div class="col-md-12">
                            <label><strong>Instancias que previamente han conocido los hechos::</strong></label>
                            <hr>
                            <p>Instancias que previamente han conocido los hechos:</p>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Descripción sucinta del caso:</strong></label>
                            <hr>
                            <p></p>
                        </div>
                        <div class="col-md-6">
                            <label><strong>Gestiones realizadas por la Secretaría Ejecutiva:</strong></label>
                            <hr>
                            <p></p>
                        </div>
                        <h4><strong> Datos Solicitante:</strong> <br></h4>

                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <label><strong>Institución Solicitante:</strong></label>
                                <hr>
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Nombre Solicitante:</strong></label>
                                <hr>
                                <p></p>
                            </div>
                        </div>
                        <!--Aqui Termina Reportantes-->

                        <h4><strong> Datos Reportante:</strong></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr align="center">
                                    <th>Institución Reportante</th>
                                    <th>Nombre Reportante</th>
                                </tr>
                                <tr align="center">
                                    <td>---</td>
                                    <td>----</td>
                                </tr>
                            </table>
                        </div>

                        <h4><strong>Datos de presunta(s) victima(s):</strong></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr align="center">
                                    <th>Edad</th>
                                    <th>Nombre Victima</th>
                                    <th>Tipo de Delito</th>
                                    <th>Derechos Vulnerados o restringidos</th>
                                    <th>Agresión extraordinaria</th>
                                    <th>Sexo</th>
                                </tr>
                                <tr align="center">
                                    <td>---</td>
                                    <td>----</td>
                                    <td>---</td>
                                    <td>----</td>
                                    <td>---</td>
                                    <td>----</td>
                                </tr>
                            </table>
                        </div>



                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

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
                            <p></p>
                        </div>
                        <div class="col-md-3" id="avance" name="avance">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" aria-label="limpiar_modal" onclick="fn_modal_avance(1);">
                                    <i class="bi bi-plus"></i>
                                    <span>Agregar</span>
                                </button>
                                

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
                                <button type="button" class="btn btn-success" onclick="fun_agregar_avance();">Agregar </button>

                            </div>

                        </div>
                        <div class="col-md-9">
                            <div id="ver_lista_avances"></div>
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


