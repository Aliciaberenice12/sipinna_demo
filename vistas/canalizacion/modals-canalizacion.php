<!--Modal Crear-->
<div class="modal fade" id="crearCanalizacion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" style="color:white;">Crear Canalización</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <h4><strong>Rellene los siguientes campos</strong></h4>
                            <div class="row col-md-6">
                                <label>Vía de Recepción:</label><br>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                    <label class="btn btn-recepcion" for="btnradio1">Telefónica</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio2">Personal</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio3">Correo</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio4">Redes Sociales</label>
                                </div>

                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label>Solicitud de Canalización:</label>
                                <input type="file" class="form-control" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Número Oficio:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Fecha:</label>
                                <input type="date" class="form-control" placeholder="Fecha" id="fecha" name="fecha">
                            </div>

                            <div class="col-md-3">
                                <label>Estado:</label>
                                <select name="via_recepcion" class="form-select">
                                    <option value="" selected>Seleccione...</option>
                                    <option value="">Estado 1...</option>
                                    <option value="">Estado 2...</option>
                                    <option value="">Estado 3...</option>
                                    Estado
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Municipo:</label>
                                <select name="via_recepcion" class="form-select">
                                    <option value="" selected>Seleccione...</option>
                                    <option value="">Municipio 1...</option>
                                    <option value="">Municipio 2...</option>
                                    <option value="">Municipio 3...</option>
                                    <option value="">Municipio 4...</option>
                                </select>
                            </div>
                            <h5><br><strong> Datos Reportante:</strong></h5>

                            <div class="col-md-4">
                                <label>Nombre Solicitante:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-4">
                                <label>Institución Solicitante:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <h5><br><strong> Reporte:</strong></h5>
                            <div class="col-md-4">
                                <label>Tipo Delito:</label>
                                <select name="via_recepcion" class="form-select">
                                    <option value="" selected>Seleccione...</option>
                                    <option value="">Delito 1...</option>
                                    <option value="">Delito 2...</option>
                                    <option value="">Delito 3...</option>
                                    <option value="">Delito 4...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Derechos Vulnerados o restringidos:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                          
                            <div class="col-md-4">
                                <label>Nombre Victima:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                           

                            <div class="col-md-4">
                                <label>Descripción Sucinta del caso :</label>
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
                <button type="submit" class="btn btn-success">Agregar</button>
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
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1_edit" autocomplete="off" checked>
                                    <label class="btn btn-recepcion" for="btnradio1_edit">Telefónica</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2_edit" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio2_edit">Personal</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3_edit" autocomplete="off">
                                    <label class="btn btn-recepcion" for="btnradio3_edit">Correo</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4_edit" autocomplete="off">
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