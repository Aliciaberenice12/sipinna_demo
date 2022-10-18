var cargando =
'<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

//Redireccionar 
function redireccionar(dir) {
    if (dir == 1)// Catalogo Agresion 
        setTimeout("location.href=' catalogo_agresion.php'", 1000);
    fn_listar_agresiones();
    if (dir == 2)// Catalogo Municipio 
        setTimeout("location.href=' catalogo_municipio.php'", 1000);
    fn_listar_agresiones();
}
//Boton Catalogo Agresiones
function catalogo_agresion() {
    redireccionar(1);
    fn_listar_agresiones();

}
//Boton Catalogo Municipios
function catalogo_municipio() {
    redireccionar(2);
    fn_listar_agresiones();
}


//Funciones Agresiones
function fn_listar_agresiones() {
    $("#ver_lista_agresiones").html(cargando);
    $.post("../controllers/fun_catalogos.php", { accion: 'fn_listar_agresiones' }, function (data) {
        $('#ver_lista_agresiones').html(data);
        $('#tbl_a').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function mod_cat_agresiones(origen, id) {
    if (origen == 1) {
        $('#tit_mod_agresiones').html('Nueva Agresión');
        $('#id_agr_cat').val(0);
        $('#agresion').val('');

    }
    else if (origen == 2) {
        $('#tit_mod_agresiones').html('Modificar Agresiones');
        $.post("../controllers/fun_catalogos.php", { accion: 'fn_obtener_agresion', id: id }, function (res) {
            $('#id_agr_cat').val(id);
            $('#agresion').val(res.agresion);

        });
    }
    if (origen == 1 || origen == 2)
        $('#mod_cat_agresiones').modal('show');
}
function fn_guardar_agresion() {
    id = $('#id_agr_cat').val();
    agresion = $.trim($('#agresion').val());
    if (agresion == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar Tipo de Agresion!');
        $('#agresion').focus();
        return false;
    }
    $('#btn_a').prop('disabled', true);
    swal({
        title: '¿Estás seguro?',
        html: 'Los datos: <br>' + agresion + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { accion: 'fn_guardar_agresion', id: id, agresion: agresion };
            $.ajax
                ({
                    url: "../controllers/fun_catalogos.php",
                    type: "POST",
                    data: datos
                }).done(function (res) {
                    if (res.estatus == 'ok') {
                        Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                        $('#btn_a').prop('disabled', false);
                        $('#mod_cat_agresiones').modal('hide');
                        fn_listar_agresiones();
                    }
                    else {
                        Swal({ type: 'warning', title: 'Faltan Datos ', showConfirmButton: false, timer: 1500 });
                        $('#btn_a').prop('disabled', false);
                        $('#mod_cat_agresiones').modal('hide');
                        fn_listar_agresiones();

                    }
                });
        }
    })
}
function fn_eliminar_agresion(id, agresion) {
    swal({
        title: '¿Estás seguro?',
        text: agresion + ' será eliminado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { accion: 'fn_eliminar_agresion', id: id, agresion: agresion };

            $.ajax({
                url: "../controllers/fun_catalogos.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    var tabla = $('#tbl_a').DataTable();
                    tabla.row($('#l_agresion' + id)).remove().draw();
                    fn_listar_agresiones();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
                    $('#btn_user').prop('disabled', false);
                    return false;
                }
            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })
}


//Funciones Parentescos
function mod_cat_parentesco(origen, id) {
    if (origen == 1) {
        $('#tit_mod_par').html('Nuevo Parentesco');
        $('#id_par_cat').val(0);
        $('#parentesco').val('');

    }
    else if (origen == 2) {
        $('#tit_mod_par').html('Modificar Parentesco');
        $.post("../controllers/fun_catalogos.php", { accion: 'fn_obtener_parentesco', id: id }, function (res) {
            $('#id_par_cat').val(id);
            $('#parentesco').val(res.parentesco);

        });
    }
    if (origen == 1 || origen == 2)
        $('#mod_cat_parentescos').modal('show');
}
function fn_listar_parentesco() {
    $("#ver_lista_parentescos").html(cargando);
    $.post("../controllers/fun_catalogos.php", { accion: 'fn_listar_parentescos' }, function (data) {
        $('#ver_lista_parentescos').html(data);
        $('#tbl_parentescos').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },

            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function fn_guardar_parentesco() {
    id = $('#id_par_cat').val();
    parentesco = $.trim($('#parentesco').val());

    if (parentesco == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el nombre!');
        $('#parentesco').focus();
        return false;
    }

    $('#btn_par').prop('disabled', true);

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de Parentesco: <br>' + parentesco + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { accion: 'fn_guardar_parentesco', id: id, parentesco: parentesco };

            $.ajax({
                url: "../controllers/fun_catalogos.php",
                type: "POST",
                data: datos
            }).done(function (res) {
                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#btn_par').prop('disabled', false);
                    $('#mod_cat_parentescos').modal('hide');
                    fn_listar_parentesco();
                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
                    $('#btn_par').prop('disabled', false);
                    return false;
                }
            })
        }
        else
            $('#btn_par').prop('disabled', false);
    })
}
function fn_eliminar_parentesco(id, parentesco) {
    swal({
        title: '¿Estás seguro?',
        text: 'El parentesco ' + parentesco + ' será eliminado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { accion: 'fn_eliminar_parentescos', id: id, parentesco: parentesco };

            $.ajax({
                url: "../controllers/fun_catalogos.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    var tabla = $('#tbl_parentesco').DataTable();
                    fn_listar_parentesco();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
                    $('#btn_par').prop('disabled', false);
                    return false;
                }
            })
        }
        else
            $('#btn_par').prop('disabled', false);
    })
}


//Funciones Municipios
function mod_cat_municipio(origen, id) {
    if (origen == 1) {
        $('#tit_mod_mun').html('Nuevo Municipio');
        $('#id_mun_cat').val(0);
        $('#municipio').val('');

    }
    else if (origen == 2) {
        $('#tit_mod_mun').html('Modificar Municipio');
        $.post("../controllers/fun_catalogos.php", { accion: 'fn_obtener_municipio', id: id }, function (res) {
            $('#id_mun_cat').val(id);
            $('#municipio').val(res.municipio);

        });
    }
    if (origen == 1 || origen == 2)
        $('#mod_cat_municipios').modal('show');
}
function fn_guardar_municipio() {
    id = $('#id_mun_cat').val();
    municipio = $.trim($('#municipio').val());

    if (municipio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el nombre!');
        $('#municipio').focus();
        return false;
    }

    $('#btn_mun').prop('disabled', true);

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de Municipio: <br>' + municipio + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { accion: 'fn_guardar_municipio', id: id, municipio:municipio };

            $.ajax({
                url: "../controllers/fun_catalogos.php",
                type: "POST",
                data: datos
            }).done(function (res) {
                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#btn_mun').prop('disabled', false);
                    $('#mod_cat_municipios').modal('hide');
                    fn_listar_municipios();
                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
                    $('#btn_mun').prop('disabled', false);
                    return false;
                }
            })
        }
        else
            $('#btn_par').prop('disabled', false);
    })
}
function fn_listar_municipios() {
    $("#ver_lista_municipios").html(cargando);
    $.post("../controllers/fun_catalogos.php", { accion: 'fn_listar_municipios' }, function (data) {
        $('#ver_lista_municipios').html(data);
        $('#tbl_mun').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            searching: true,
        });
    });
}
function fn_eliminar_municipio(id, municipio) {
    swal({
        title: '¿Estás seguro?',
        text: 'El municipio ' + municipio + ' será eliminado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { accion: 'fn_eliminar_municipios', id: id, municipio: municipio };

            $.ajax({
                url: "../controllers/fun_catalogos.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    var tabla = $('#tbl_mun').DataTable();
                    fn_listar_municipios();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
                    $('#btn_mun').prop('disabled', false);
                    return false;
                }
            })
        }
        else
            $('#btn_par').prop('disabled', false);
    })
}