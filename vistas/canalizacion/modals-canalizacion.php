<!--Modal Crear-->
<div class="modal fade" id="modalCanalizacion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" style="color:white;">Crear Canalización</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_can_exp" id="id_can_exp" value="0">
                <div class="row">
                    <h4><strong>Rellene los siguientes campos</strong></h4>
                    <div class="row col-md-6">
                        <label>Vía de Recepción:</label><br>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="can_via_rec" id="can_via_telefonica" value="Telefonica" autocomplete="off">
                            <label class="btn btn-recepcion" for="can_via_telefonica">Telefónica</label>

                            <input type="radio" class="btn-check" name="can_via_rec" id="can_via_personal" value="Personal" autocomplete="off">
                            <label class="btn btn-recepcion" for="can_via_personal">Personal</label>

                            <input type="radio" class="btn-check" name="can_via_rec" id="can_via_correo" value="Correo" autocomplete="off">
                            <label class="btn btn-recepcion" for="can_via_correo">Correo</label>

                            <input type="radio" class="btn-check" name="can_via_rec" id="can_via_redes" value="Redes Sociales" autocomplete="off">
                            <label class="btn btn-recepcion" for="can_via_redes">Redes Sociales</label>
                        </div>
                    </div>

                    <div class="col-md-2"></div>

                    <div class="col-md-4">
                        <label>Solicitud de Canalización:</label>
                        <input type="file" class="form-control" id="can_ruta_sol_oficio" name="can_ruta_sol_oficio">
                    </div>
                    <div class="col-md-3">
                        <label>Número Oficio:</label>
                        <input type="text" class="form-control" placeholder="No.Oficio" id="can_no_oficio" name="can_no_oficio">
                    </div>
                    <div class="col-md-3">
                        <label>Fecha:</label>
                        <input type="date" class="form-control" placeholder="Fecha" id="can_fecha_inicio" name="can_fecha_inicio">
                    </div>

                    <div class="col-3">
                        <label for="can_municipio">Estados</label>
                        <select name="can_estado" id="can_estado" class="form-select">
                            <option value="0">Seleccionar</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="can_municipio">Municipios</label>
                        <select name="can_municipio" id="can_municipio" class="form-select" required>
                            <option value="">Seleccionar</option>
                        </select>
                        <input id="can_mun_edo" name="can_mun_edo" class="form-control">
                        </input>
                    </div>

                    <h5><br><strong> Datos Reportante:</strong></h5>
                    <div class="col-md-4">
                        <label>Institución Reportante:</label>
                        <input type="text" class="form-control" placeholder="Solicitante" id="can_inst_rep" name="can_inst_rep" required>
                    </div>
                    <div class="col-md-4">
                        <label>Nombre Solicitante:</label>
                        <input type="text" class="form-control" placeholder="Nombre Solicitante" id="can_nom_rep" name="can_nom_rep" required>
                    </div>
                    <div class="col-md-4">
                        <label>Agresión extraordinaria</label>
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
                      
                    </div>
                    <div class="col-md-4">
                        <label>Descripción Sucinta del caso :</label>
                        <textarea name="textarea" id="can_des_suncita" name="can_des_suncita" placeholder="Descripción..." class="form-control" rows="3"></textarea required>
                    </div>
                  
                   
                    <h5><br><strong> Victima:</strong></h5>
                    
                    <div class="col-4">
                        <label>Tipo de Delito</label>
                        <select name="can_delitos" id="can_delitos" class="form-select" required>
                            <option value="0">Seleccionar</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Derechos Vulnerados o restringidos:</label>
                        <input type="text" class="form-control" placeholder="Derecho vulnerado" id="can_rep_der" name="can_rep_der" required>
                    </div>

                    <div class="col-md-4">
                        <label>Nombre Victima:</label>
                        <input type="text" class="form-control" placeholder="Nombre Victima" id="can_nom_vic" name="can_nom_vic" required>
                    </div>
                    <div class="col-md-2">
                        <label>Edad Victima:</label>
                        <input type="number" class="form-control" placeholder="Edad Victima" id="can_edad_vic" name="can_edad_vic" required>
                    </div>
                   
                    <div class="row col-md-3">
                        <label>Género:</label><br>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="can_gen_vic" id="masculino" value="Masculino" autocomplete="off" >
                            <label class="btn btn-recepcion" for="masculino">Masculino</label>

                            <input type="radio" class="btn-check" name="can_gen_vic" id="femenino" value="Femenino" autocomplete="off">
                            <label class="btn btn-recepcion" for="femenino">Femenino</label>

                           
                        </div>
                    </div>
                   

                    
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-success" id="btn_create_can" onclick="fun_agregarCanalizacion();">Agregar</button>
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