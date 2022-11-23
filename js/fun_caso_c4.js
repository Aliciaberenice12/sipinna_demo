var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

$(document).ready(function () {
    $("#c4_edo").change(function () {
        if ($(this).val() == "1")
            $("#c4_mun").show(),
                $("#c4_mun_edo").hide();

        else
            $("#c4_mun").hide(),
                $("#c4_mun_edo").show();

    });
    $("#actualizar_listado").click();

});

//Casos de c4

function mod_caso_c4(origen, id) {
    fn_carga_municipios('c4_mun');
    fn_carga_estados('c4_edo');
    fn_carga_delitos('c4_delitos');
    fn_carga_parentescos('c4_parentesco');

    if (origen == 1) {
        $('#tit_mod_c4').html('Crear Caso');
        $('#id_caso').val(0);
        $('#c4_folio').val("");
        $('#c4_ruta_sol_oficio').val("");
        $('#c4_no_oficio').val("");
        $('#c4_fecha_inicio').val("");
        $('#c4_edo').val("");
        $('#c4_mun').val("");
        $('#c4_mun_edo').val("");
        $('#c4_dirigido').val("");
        $('#c4_dg').val("");
        $('#c4_inst_rep').val("");
        $('#c4_nom_rep').val("");
        $('#c4_nom_responsable').val("");
        $('#c4_edad_responsable').val("");
        $('#c4_parentesco').val("");
        $('#c4_lugar_hechos').val("");
        $('#c4_des_hechos').val("");
        $('#c4_rep_der').val("");
        $('#c4_delitos').val("");
        $('#c4_per_tercera_edad').prop('checked', false).removeAttr('checked');
        $('#c4_per_discapacidad').prop('checked', false).removeAttr('checked');
        $('#c4_per_violencia').prop('checked', false).removeAttr('checked');
        $('#c4_nom_vic').val("");
        $('#c4_edad_vic').val("");
        $('#c4_masculino').prop('checked', false).removeAttr('checked');
        $('#c4_femenino').prop('checked', false).removeAttr('checked');
        $('#modal_c4').modal('show');
    }
    else if (origen == 2) {
        $('#tit_mod_c4').html('Editar Caso');
        $.post("../controllers/fun_casos_c4.php", { func: 'fn_obtener_caso_c4', id: id }, function (res) {
            $('#id_caso').val(id);
            $('#c4_folio').val(res.c4_folio);
            $('#c4_no_oficio').val(res.c4_no_oficio);
            $('#c4_ruta_sol_oficio').val(res.c4_ruta_sol_oficio);
            $('#c4_fecha_inicio').val(res.c4_fecha_inicio);
            $('#c4_edo').val(res.c4_edo);
            $('#c4_mun').val(res.c4_mun);
            $('#c4_mun_edo').val(res.c4_mun_edo);
            $('#c4_dirigido').val(res.c4_dirigido);
            $('#c4_dg').val(res.c4_dg);
            $('#c4_folio_expediente').val(res.c4_folio_expediente);
            $('#c4_estatus_caso').val(res.c4_estatus_caso);

            $('#modal_c4').modal('show');


        });
    }
    else if (origen == 3) {
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_agregar_avance', id: id }, function (res) {
            $('#id_gt').val(id);
            $('#nom_gt').val(res.nom_grupo);
            $('#sig_gt').val(res.siglas);
            $('#municipio_gt').val(res.id_municipio);
            $('#avancesCanalizacion').modal('show');


        });
    }

}
function fun_agregar_caso_c4() {
    hoy = $('#hoy').val();
    id = $('#id_caso').val();
    c4_folio = $.trim($('#c4_folio').val());
    c4_no_oficio = $.trim($('#c4_no_oficio').val());
    c4_ruta_sol_oficio = $.trim($('#c4_ruta_sol_oficio').val());
    c4_fecha_inicio = $.trim($('#c4_fecha_inicio').val());
    c4_edo = $.trim($('#c4_edo').val());
    c4_mun = $.trim($('#c4_mun').val());
    c4_mun_edo = $.trim($('#c4_mun_edo').val());
    c4_dirigido = $.trim($('#c4_dirigido').val());
    c4_dg = $.trim($('#c4_dg').val());
    file0 = document.getElementById('c4_ruta_sol_oficio');
    file = file0.files[0];




    if (typeof (file) != "undefined")//Si trae un archivo
    {
        if (file.size > 500000) {
            toastr.options.timeOut = 2500;
            toastr.warning('¡El archivo pesa más de 500 kb deberás reducirlo!');
            $('#c4_ruta_sol_oficio').focus();
            return false;
        }

        if (!(/\.(jpg|jpeg|png)$/i).test(file.name)) {
            toastr.options.timeOut = 2500;
            toastr.warning('¡El archivo debe ser formato jpg, jpeg o png!');
            $('#c4_ruta_sol_oficio').focus();
            return false;
        }
    }
    else {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes seleccionar el archivo!');
        $('#c4_ruta_sol_oficio').focus();
        return false;
    }

    if (c4_no_oficio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el numero de oficio!');
        $('#c4_no_oficio').focus();
        return false;
    }

    else if (c4_fecha_inicio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione una Fecha!');
        $('#c4_fecha_inicio').focus();
        return false;
    }
    else if (c4_edo == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione un Estado!');
        $('#c4_edo').focus();
        return false;
    }
    else if (c4_inst_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar Institución que reporta!');
        $('#c4_inst_rep').focus();
        return false;
    }


    else if (c4_fecha_inicio > hoy) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡La fecha no puede ser mayor al día de hoy!');
        $('#c4_fecha_inicio').focus();
        return false;
    }


    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de la canalización: <br>' + c4_no_oficio + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_caso_c4');
            data.append('id', id);
            data.append('c4_folio', c4_folio);
            data.append('c4_no_oficio', c4_no_oficio);
            data.append('c4_ruta_sol_oficio', c4_ruta_sol_oficio);
            data.append('c4_fecha_inicio', c4_fecha_inicio);
            data.append('c4_edo', c4_edo);
            data.append('c4_mun', c4_mun);
            data.append('c4_mun_edo', c4_mun_edo);
            data.append('c4_dirigido', c4_dirigido);
            data.append('c4_dg', c4_dg);
            data.append('archivo', file);
            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (res) {
                console.log(res);
                var result = JSON.parse(res);
                console.log(result);
                if (result.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    fun_agregar_reportante_c4();


                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#modalCanalizacion').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })



}
function fn_listar_casos_c4() {
    $("#ver_lista_casos_c4").html(cargando);
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_listar_casos_c4' }, function (data) {
        $('#ver_lista_casos_c4').html(data);
        $('#tbl_caso').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            ordering: [[1, "asc"]],
            searching: true,
        });
    });
}
function fn_eliminar_caso_c4(id, c4_no_oficio) {
    swal({
        title: '¿Estás seguro?',
        text: c4_no_oficio + ' será eliminado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { func: 'fn_eliminar_caso_c4', id: id, c4_no_oficio: c4_no_oficio };

            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    fn_listar_casos_c4();

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
//Reportante

function fun_agregar_reportante_c4() {

    c4_inst_rep = $.trim($('#c4_inst_rep').val());
    c4_nom_rep = $.trim($('#c4_nom_rep').val());

    if (c4_nom_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre de Reportante Reportante!');
        $('#c4_nom_rep').focus();
        return false;
    }
    else if (c4_inst_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Institución Reportante!');
        $('#c4_inst_rep').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Reportante: <br>' + c4_nom_rep + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_reportante_c4');
            data.append('c4_inst_rep', c4_inst_rep);
            data.append('c4_nom_rep', c4_nom_rep);

            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (res) {

                if (res.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    fun_agregar_pro_resp_c4();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#modal_c4').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })
}
//Probable Responsable c4
function fun_agregar_pro_resp_c4() {

    c4_nom_responsable = $.trim($('#c4_nom_responsable').val());
    c4_edad_responsable = $.trim($('#c4_edad_responsable').val());
    c4_parentesco = $.trim($('#c4_parentesco').val());

    if (c4_nom_responsable == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre Probable Responsable!');
        $('#c4_nom_responsable').focus();
        return false;
    }
    else if (c4_edad_responsable == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Edad Probable Responsable!');
        $('#c4_edad_responsable').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Probable Responsable: <br>' + c4_nom_responsable + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_prob_respo_c4');
            data.append('c4_nom_responsable', c4_nom_responsable);
            data.append('c4_edad_responsable', c4_edad_responsable);
            data.append('c4_parentesco', c4_parentesco);

            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (res) {

                if (res.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    fun_agregar_des_caso_c4();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#modal_c4').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })
}
//Agregar Caso
function fun_agregar_des_caso_c4() {

    c4_lugar_hechos = $.trim($('#c4_lugar_hechos').val());
    c4_des_hechos = $.trim($('#c4_des_hechos').val());

    if (c4_lugar_hechos == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Lugar de los hechos!');
        $('#c4_lugar_hechos').focus();
        return false;
    }
    else if (c4_des_hechos == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa lugar de los hechos!');
        $('#c4_des_hechos').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Lugar de los hechos serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_desc_caso_c4');
            data.append('c4_lugar_hechos', c4_lugar_hechos);
            data.append('c4_des_hechos', c4_des_hechos);

            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (res) {

                if (res.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    fun_agregar_victima_c4();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#modal_c4').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })
}
//Victima
function mod_can_victima(origen, id) {
    fn_carga_delitos('can_delitos');

    if (origen == 1) {
        $('#id_victima').val(0);
        $('#can_nom_victima').val("");
        $('#can_edad_victima').val("");
        $('#can_gen_victima').val("");
        $('#modalCanVictima').modal('show');

    }
    else if (origen == 2) {
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_grupo', id: id }, function (res) {
            $('#id_gt').val(id);
            $('#nom_gt').val(res.nom_grupo);
            $('#sig_gt').val(res.siglas);
            $('#municipio_gt').val(res.id_municipio);
            $('#editarCanalizacion').modal('show');


        });
    }

}
function fun_agregar_victima_c4() {
    c4_delitos = $.trim($('#c4_delitos').val());
    c4_rep_der = $.trim($('#c4_rep_der').val());
    c4_nom_vic = $.trim($('#c4_nom_vic').val());
    c4_edad_vic = $.trim($('#c4_edad_vic').val());
    c4_gen_vic = document.querySelector('input[name="c4_gen_vic"]:checked').value;
    if ($('#c4_per_discapacidad').prop('checked'))
        c4_per_discapacidad = 1;
    else
        c4_per_discapacidad = 0;

    if ($('#c4_per_tercera_edad').prop('checked'))
        c4_per_tercera_edad = 1;
    else
        c4_per_tercera_edad = 0;
    if ($('#c4_per_violencia').prop('checked'))
        c4_per_violencia = 1;
    else
        c4_per_violencia = 0;


    if (c4_rep_der == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Descripción!');
        $('#c4_rep_der').focus();
        return false;
    }
    else if (c4_nom_vic == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre!');
        $('#c4_nom_vic').focus();
        return false;
    }
    else if (c4_edad_vic == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Edad!');
        $('#c4_edad_vic').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de la victima: <br>' + c4_nom_vic + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_victima_c4');
            data.append('c4_delitos', c4_delitos);
            data.append('c4_rep_der', c4_rep_der);
            data.append('c4_nom_vic', c4_nom_vic);
            data.append('c4_edad_vic', c4_edad_vic);
            data.append('c4_per_tercera_edad', c4_per_tercera_edad);
            data.append('c4_per_discapacidad', c4_per_discapacidad);
            data.append('c4_per_violencia', c4_per_violencia);
            data.append('c4_gen_vic', c4_gen_vic);

            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (res) {
                //console.log(res);
                //var result = JSON.parse(res);
                //console.log(result);
                if (res.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#modal_c4').modal('hide');
                    fn_listar_casos_c4();

                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#modal_c4').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })
}

//Avances 
function fn_modal_avances_c4() {
    $('#tit_mod_can_avance').html('Listar Avances');
    $('#avances_c4').modal('show');
    fn_listar_avances_c4();
}
function fn_modal_avance(origen, id) {
    if (origen == 1) {
        $('#id_c4_avance').val(0);
        $('#can_tipo_avance').val("");
        $('#can_fecha_avance').val("");
        $('#can_estatus_avance').val("");
        $('#can_desc_avance').val("");
        $('#tit_mod_can_add_avance').html('Crear Avance');
        $('#crearAvance').modal('show');
        $('#avancesCanalizacion').modal('hide');
    } 
    else if (origen == 2) {


    }
    else if (origen == 3) {

        $('#tit_mod_can_add_avance').html('Editar Avance');
        $.post("../controllers/fun_casos_c4.php", { accion: 'fn_obtener_avance', id: id }, function (res) {
            $('#id_can_avance').val(id);
            $('#can_tipo_avance').val(res.can_tipo_avance);
            $('#can_fecha_avance').val(res.can_fecha_avance);
            $('#can_estatus_avance').val(res.can_estatus_avance);
            $('#can_desc_avance').val(res.can_desc_avance);
        });
        $('#crearAvance').modal('show');
    }

}
function fun_agregar_avance() {
    id = $('id_can_avance').val();
    can_tipo_avance = $.trim($('#can_tipo_avance').val());
    can_fecha_avance = $.trim($('#can_fecha_avance').val());
    can_estatus_avance = $.trim($('#can_estatus_avance').val());
    can_desc_avance = $.trim($('#can_desc_avance').val());

    if (can_tipo_avance == '0') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione tipo de avance!');
        $('#can_desc_avance').focus();
        return false;
    }
    if (can_estatus_avance == '0') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione!');
        $('#can_estatus_avance').focus();
        return false;
    }
    else if (can_fecha_avance == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Fecha de reporte!');
        $('#can_fecha_avance').focus();
        return false;
    }
    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Avance: <br>' + can_tipo_avance + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_avance');
            data.append('can_tipo_avance', can_tipo_avance);
            data.append('can_fecha_avance', can_fecha_avance);
            data.append('can_estatus_avance', can_estatus_avance);
            data.append('can_desc_avance', can_desc_avance);

            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (res) {
                //console.log(res);
                //var result = JSON.parse(res);
                //console.log(result);
                if (res.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#crearAvance').modal('hide');
                    fn_listar_avances();


                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#crearCanalizacion').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })



}
function fn_listar_avances_c4() {
    $("#ver_lista_avances").html(cargando);
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_listar_avances' }, function (data) {
        $('#ver_lista_avances').html(data);
        $('#tbl_avances').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: false,
        });
    });
}
function fn_eliminar_avance(id, can_tipo_avance) {
    swal({
        title: '¿Estás seguro?',
        text: can_tipo_avance + ' será eliminado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { func: 'fn_eliminar_avance', id: id, can_tipo_avance: can_tipo_avance };

            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    var tabla = $('#tbl_avance').DataTable();
                    tabla.row($('#l_avance' + id)).remove().draw();
                    fn_listar_avances();

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

//FUNCIONES TRAER DATOS DE CATALOGOS
function fn_carga_municipios(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_municipios' }, function (data) {
        $('#' + combo).html(data);
    });
}
function fn_carga_estados(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_estados' }, function (data) {
        $('#' + combo).html(data);
    });
}
function fn_carga_delitos(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_delitos' }, function (data) {
        $('#' + combo).html(data);
    });
}
function fn_carga_parentescos(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_parentescos' }, function (data) {
        $('#' + combo).html(data);
    });
}
//Aggregar Reportante ++
let agregar = document.getElementById('agregar');
let contenido = document.getElementById('contenedor');
let agregar_victima = document.getElementById('agregar_victima');
let contenido_victima = document.getElementById('contenedor_victima');

agregar.addEventListener('click', e => {
    e.preventDefault();
    let clonado = document.querySelector('.clonar');
    let clon = clonado.cloneNode(true);

    contenido.appendChild(clon).classList.remove('clonar');

    let remover_ocutar = contenido.lastChild.childNodes[1].querySelectorAll('span');
    remover_ocutar[0].classList.remove('ocultar');
});
agregar_victima.addEventListener('click', e => {
    e.preventDefault();
    let clonado_dato_victima = document.querySelector('.clonar_victima');
    let clon_vic = clonado_dato_victima.cloneNode(true);

    contenido_victima.appendChild(clon_vic).classList.remove('clonar_victima');

    let remover_ocultar = contenido_victima.lastChild.childNodes[1].querySelectorAll('span');
    remover_ocultar[0].classList.remove('ocultar_victima');
});

contenido.addEventListener('click', e => {
    e.preventDefault();
    if (e.target.classList.contains('puntero')) {
        let contenedor = e.target.parentNode.parentNode;

        contenedor.parentNode.removeChild(contenedor);
    }
});
contenido_victima.addEventListener('click', e => {
    e.preventDefault();
    if (e.target.classList.contains('puntero_victima')) {
        let contenedor_victima = e.target.parentNode.parentNode;

        contenedor_victima.parentNode.removeChild(contenedor_victima);
    }
});