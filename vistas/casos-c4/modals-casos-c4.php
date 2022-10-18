<!--Modal Crear-->
<div class="modal fade" id="crearCaso-c4">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" style="color:white;">Crear Caso C-4</h5>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <h5><strong>Rellene los siguientes campos</strong></h5>
                            </div>

                            <div class="col-md-3">
                                <label>Código:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Número:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
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
                                <label>Dirigido:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Dirección General:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Municipo:</label>
                                <select name="via_recepcion" class="form-select">
                                    <option value="" selected>Seleccione...</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Lugar de los Hechos:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-6">
                                <br>
                                <label>Hechos:</label>
                                </br>
                                <textarea name="textarea" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <label>Observaciones:</label>
                                <textarea name="textarea" class="form-control" rows="3"></textarea>
                                </br>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <label>Tipo de Delito:</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Seleccione...</option>
                                    <option value="1">Violencia</option>
                                    <option value="2">familiar</option>
                                    <option value="3">Omisión de cuidado</option>
                                    <option value="">Abuso Sexual contra menores</option>
                                    <option value="">Amenazas</option>
                                    <option value="">Maltrato a persona incapaz</option>
                                    <option value="">Corrupción de menores</option>
                                    <option value="">Trata de personas</option>
                                    <option value="">Narcomenudeo</option>
                                    <option value="">Violación</option>
                                    <option value="">Armas de fuego</option>
                                    <option value="">Estupro</option>
                                    <option value="">Pederastia</option>
                                    <option value="">Robo</option>
                                    <option value="">Contra el medio ambiente</option>
                                </select>
                                <br>

                            </div>

                            <div class="row col-md-12">
                                <h5><strong>Datos Probable Responsable</strong></h5>
                                <div class="col-md-6">
                                    <label>Nombre Probable Responsable</label>
                                    <input type="text" class="form-control" placeholder="" id="" name="">
                                </div>

                                <div class="col-md-3">
                                    <label>Número Delitos:</label>
                                    <input type="number" class="form-control" ondrop="return false;" onpaste="return false;" placeholder="" id="" name="">
                                </div>
                                <div class="col-md-3">
                                    <label>Edad:</label>
                                    <input type="number" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="" id="" name="">
                                </div>
                                <div class="col-md-6">
                                    <label>Parentesco con víctima:</label>
                                    <select class="form-select" placeholder="" id="" name="">
                                        <option value="">parentesco 1</option>

                                        <option value="">parentesco 2</option>

                                    </select>
                                </div>

                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <h5><strong>Datos de Víctima</strong> </h5>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" id="AgregarVictima">
                                        <span class="fa fa-plus"></span>
                                        Agregar Victima
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive col-md-12">
                                <table class="table">
                                    <thead class="tbl-estadisticas">
                                        <tr align="center">
                                            <th>Nombre Del Sujeto Pasivo (Victima)</th>
                                            <th>Edad</th>
                                            <th>Género</th>
                                            <th>Agresión Extraordinaria</th>
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
                                                <button type="button" class="btn btn-primary" id="EditarVictima">
                                                    <span class="fa fa-pen"></span>

                                                </button>
                                                <button type="button" class="btn btn-danger" id="EliminarVictima">
                                                    <span class="fa fa-trash"></span>

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
                    Cancelar
                </button>
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>

        </div>
    </div>
</div>
<!--Modal Editar-->
<div class="modal fade" id="editarCaso-c4">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color:white;">Editar Caso C-4</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <h5><strong>Rellene los siguientes campos</strong></h5>
                            </div>

                            <div class="col-md-3">
                                <label>Código:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Número:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
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
                                <label>Dirigido:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Dirección General:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-3">
                                <label>Municipo:</label>
                                <select name="via_recepcion" class="form-select">
                                    <option value="" selected>Seleccione...</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Lugar de los Hechos:</label>
                                <input type="text" class="form-control" placeholder="" id="" name="">
                            </div>
                            <div class="col-md-6">
                                <br>
                                <label>Hechos:</label>
                                </br>
                                <textarea name="textarea" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <label>Observaciones:</label>
                                <textarea name="textarea" class="form-control" rows="3"></textarea>
                                </br>
                            </div>
                            <div class="col-md-4">
                                <label>Tipo de Delito:</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Seleccione...</option>
                                    <option value="1">Violencia</option>
                                    <option value="2">familiar</option>
                                    <option value="3">Omisión de cuidado</option>
                                    <option value="">Abuso Sexual contra menores</option>
                                    <option value="">Amenazas</option>
                                    <option value="">Maltrato a persona incapaz</option>
                                    <option value="">Corrupción de menores</option>
                                    <option value="">Trata de personas</option>
                                    <option value="">Narcomenudeo</option>
                                    <option value="">Violación</option>
                                    <option value="">Armas de fuego</option>
                                    <option value="">Estupro</option>
                                    <option value="">Pederastia</option>
                                    <option value="">Robo</option>
                                    <option value="">Contra el medio ambiente</option>
                                </select>
                                <br>

                            </div>

                            <div class="row col-md-12">
                                <h5><strong>Datos Probable Responsable</strong></h5>
                                <div class="col-md-6">
                                    <label>Nombre Probable Responsable</label>
                                    <input type="text" class="form-control" placeholder="" id="" name="">
                                </div>

                                <div class="col-md-3">
                                    <label>Número Delitos:</label>
                                    <input type="number" class="form-control" ondrop="return false;" onpaste="return false;" placeholder="" id="" name="">
                                </div>
                                <div class="col-md-3">
                                    <label>Edad:</label>
                                    <input type="number" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="" id="" name="">
                                </div>
                                <div class="col-md-6">
                                    <label>Parentesco con víctima:</label>
                                    <select class="form-select" placeholder="" id="" name="">
                                        <option value="">parentesco 1</option>

                                        <option value="">parentesco 2</option>

                                    </select>
                                </div>

                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <h5><strong>Datos de Víctima</strong> </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success" id="AgregarVictima">
                                            <span class="fa fa-plus"></span>
                                            Agregar Victima
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive col-md-12">
                                    <table class="table">
                                        <thead class="tbl-estadisticas">
                                            <tr align="center">
                                                <th>Nombre Del Sujeto Pasivo (Victima)</th>
                                                <th>Edad</th>
                                                <th>Género</th>
                                                <th>Agresión Extraordinaria</th>
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
                                                    <button type="button" class="btn btn-primary" id="EditarVictima">
                                                        <span class="fa fa-pen"></span>

                                                    </button>
                                                    <button type="button" class="btn btn-danger" id="EliminarVictima">
                                                        <span class="fa fa-trash"></span>

                                                    </button>


                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>
<!--Modal Cancelar-->
<div class="modal fade" id="cancelarCaso-c4">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" style="color:white;">Cancelar Caso</h5>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <p><strong>¿Desea Cancelar Caso creado por USUARIO?</strong></p>
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