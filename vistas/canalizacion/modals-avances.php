<!--Modal  INDEX Avances-->
<div class="modal fade" id="avancesCanalizacion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" style="color:white;">Avances</h5>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-success" id="AgregarAvance">
                    <span class="fa fa-plus"></span>
                    Crear Avance
                </button>
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <br>
                            </div>

                            <div class="table-responsive col-md-12">
                                <table class="table">
                                    <thead class="tbl-estadisticas">
                                        <tr align="center">
                                            <th>Tipo Avance</th>
                                            <th>Avance(Descripción)</th>
                                            <th>Estatus</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr align="center">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="EditarAvance">
                                                    <span class="fa fa-pen"></span>
                                                    Editar
                                                </button>
                                                <button type="button" class="btn btn-danger" id="CancelarAvance">
                                                    <span class="fa fa-trash"></span>
                                                    Cancelar
                                                </button>


                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

<!--Modal Crear Avances-->
<div class="modal fade" id="crearAvance">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" style="color:white;">Crear Avance</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div>
                                        <label>Tipo Avance:</label>
                                        <select name="" class="form-select">
                                            <option value="" selected>Seleccione...</option>
                                            <option value="1">Descripción Sucinta del caso.</option>
                                            <option value="2">Gestiones realizadas por la Secretaría Ejecutiva</option>
                                            <option value="3">Avances del caso, indicando fecha y actividades específicas</option>

                                        </select>
                                    </div>
                                    <div>
                                        <label>Fecha:</label>
                                        <input type="date" class="form-control" id="" name=""></input>
                                    </div>
                                    <div>
                                        <label>Estatus:</label>
                                        <select name="" class="form-select">
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
                <button type="button" class="btn btn-success">Agregar</button>
            </div>

        </div>
    </div>
</div>
<!--Modal Editar Avances-->
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
                                        <select name="" class="form-select">
                                            <option value="" selected>Seleccione...</option>
                                            <option value="1">Avance</option>
                                            <option value="2">Gestiones realizadas por la Secretaría Ejecutiva</option>
                                            <option value="3">Avances del caso, indicando fecha y actividades específicas</option>

                                        </select>
                                    </div>
                                    <div>
                                        <label>Fecha:</label>
                                        <input type="date" class="form-control" id="" name=""></input>
                                    </div>
                                    <div>
                                        <label>Estatus:</label>
                                        <select name="" class="form-select">
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
<!--Modal Delete Avances-->
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