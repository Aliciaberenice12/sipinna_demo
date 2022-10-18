<!--Modal Edit-->
<div class="modal fade" id="editarUsuarioModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color:white;">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Imagen:</label><br>
                            <img src="../images/sipinna.png" height="50%">
                            <br></br>
                            <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre:</label>

                            <input class="form-control" type="text" name="" id="">
                            <label for="">Apellidos:</label>
                            <input class="form-control" type="text" name="" id="">
                            <label for="">Departamento:</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>

                        <div class="col-md-4">
                            <label for="">Usuario:</label>
                            <input class="form-control" type="text" name="" id="">

                            <label for="">Contraseña</label>
                            <input class="form-control" type="password" name="" id="">

                            <label for="">Repite Contraseña</label>
                            <input class="form-control" type="password" name="" id="">
                        </div>

                        <div class="col-md-12">
                            <label for="">Correo Electronico:</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>

        </div>
    </div>
</div>

<!--Modal Delete-->
<div class="modal fade" id="eliminarUsuarioModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" style="color:white;">Eliminar Usuario</h5>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <p><strong>¿Desea Eliminar al Usuario?</strong></p>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>

        </div>
    </div>
</div>
<!--Modal Crear-->
<div class="modal fade" id="crearUsuarioModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" style="color:white;">Agregar Usuario</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Imagen:</label><br>
                            <img src="../images/sipinna.png" height="50%">
                            <br></br>
                            <input class="form-control" type="file"  name="" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre:</label>

                            <input class="form-control" type="text" name="" id="">
                            <label for="">Apellidos:</label>
                            <input class="form-control" type="text" name="" id="">
                            <label for="">Departamento:</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>

                        <div class="col-md-4">
                            <label for="">Usuario:</label>
                            <input class="form-control" type="text" name="" id="">

                            <label for="">Contraseña</label>
                            <input class="form-control" type="password" name="" id="">

                            <label for="">Repite Contraseña</label>
                            <input class="form-control" type="password" name="" id="">
                        </div>

                        <div class="col-md-12">
                            <label for="">Correo Electronico:</label>
                            <input class="form-control" type="text" name="" id="">
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