var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

$(document).ready(function () {
    $("#can_mun_edo").hide();
    $("#can_municipio").hide();
    $("#can_mun").hide();

    $("#can_estado").change(function () {


        if ($(this).val() == "1")

            $("#can_mun_edo").hide(),
                $("#can_municipio").show(400),
                $("#can_mun").show(400);


        else
            $("#can_municipio").hide(),
                $("#can_mun_edo").show(200),
                $("#can_mun").show(200);


    });

    $("#actualizar_canalizaciones").click();


});

//Canalizacion
function mod_canalizacion(origen, id) {
    fn_carga_municipios('can_municipio');
    fn_carga_estados('can_estado');
    fn_carga_delitos('can_delitos');
    if (origen == 1) {
        $('#tit_mod_can').html('Crear Canalización');
        $('#id_canalizacion').val(0);
        $('#can_numero').val("");
        $('#can_num_oficio').val("");
        $('#can_fecha').val("");
        $('#can_estado').val("");
        $('#can_municipio').val("");
        $('#can_mun_edo').val("");
        $('#can_ruta_sol_oficio').val("");
        $('#can_folio').val("");
        $('#can_via_tel').prop('checked', false).removeAttr('checked');
        $('#can_via_per').prop('checked', false).removeAttr('checked');
        $('#can_via_cor').prop('checked', false).removeAttr('checked');
        $('#can_via_red').prop('checked', false).removeAttr('checked');
        $('#can_per_tercera_edad').prop('checked', false).removeAttr('checked');
        $('#can_per_discapacidad').prop('checked', false).removeAttr('checked');
        $('#can_per_violencia').prop('checked', false).removeAttr('checked');
        $('#can_per_indigena').prop('checked', false).removeAttr('checked');
        $('#can_per_transgenero').prop('checked', false).removeAttr('checked');
        $('#can_masculino').prop('checked', false).removeAttr('checked');
        $('#can_femenino').prop('checked', false).removeAttr('checked');
        $('#can_ni').prop('checked', false).removeAttr('checked');
        $('#can_inst_rep').val("");
        $('#can_nom_rep').val("");
        $('#can_des_suncita_rep').val("");
        $('#can_ges_reporte').val("");
        $('#can_inst_sol').val("");
        $('#can_nom_sol').val("");
        $('#ins_con_hechos').val("");
        $('#can_edad_vic').val("");
        $('#can_nom_vic').val("");
        $('#can_delitos').val("");
        $('#can_der_vul_vic').val("");
        $('#modal_canalizacion').modal('show');


    }
    else if (origen == 2) {
        $('#tit_mod_can').html('Editar Canalización');
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_canalizacion', id: id }, function (res) {
            $('#id_canalizacion').val(id);
            $('#can_folio').val(res.can_folio);
            $('#can_pais').val(res.can_pais);
            $('#can_numero').val(res.can_numero);
            $('#can_num_oficio').val(res.can_numero_oficio);
            $('#can_fecha').val(res.can_fecha);
            $('#can_estado').val(res.can_estado);
            $('#can_municipio').val(res.can_municipio);
            $('#can_mun_edo').val(res.can_mun_edo);
            $('#can_via_rec').val(res.can_via_rec);
            $('#can_folio_expediente').val(res.can_folio_expediente);
            $('#modal_canalizacion').modal('show');


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
function fun_agregarCanalizacion() {
    hoy = $('#hoy').val();
    id = $('#id_canalizacion').val();
    can_via_rec = document.querySelector('input[name="can_via_rec"]:checked').value;
    can_num_oficio = $.trim($('#can_num_oficio').val());
    can_numero = $.trim($('#can_numero').val());
    can_folio = $.trim($('#can_folio').val());
    can_fecha = $.trim($('#can_fecha').val());
    can_pais = $.trim($('#can_pais').val());
    can_estado = $.trim($('#can_estado').val());
    can_municipio = $.trim($('#can_municipio').val());
    can_mun_edo = $.trim($('#can_mun_edo').val());
    can_ruta_sol_oficio = $.trim($('#can_ruta_sol_oficio').val());
    can_inst_rep = $.trim($('#can_inst_rep').val());
    can_nom_rep = $.trim($('#can_nom_rep').val());
    can_des_suncita_rep = $.trim($('#can_des_suncita_rep').val());
    can_ges_reporte = $.trim($('#can_ges_reporte').val());
    file0 = document.getElementById('can_ruta_sol_oficio');
    file = file0.files[0];


    if (typeof (file) != "undefined")//Si trae un archivo
    {
        if (file.size > 500000) {
            toastr.options.timeOut = 2500;
            toastr.warning('¡El archivo pesa más de 500 kb deberás reducirlo!');
            $('#can_ruta_sol_oficio').focus();
            return false;
        }

        if (!(/\.(jpg|jpeg|png)$/i).test(file.name)) {
            toastr.options.timeOut = 2500;
            toastr.warning('¡El archivo debe ser formato jpg, jpeg o png!');
            $('#can_ruta_sol_oficio').focus();
            return false;
        }
    }
    else {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes seleccionar el archivo!');
        $('#can_ruta_sol_oficio').focus();
        return false;
    }
    if (can_numero == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar Número!');
        $('#can_numero').focus();
        return false;
    }
    else if (can_folio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el numero de Folio!');
        $('#can_folio').focus();
        return false;
    }
    else if (can_num_oficio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el numero de oficio!');
        $('#can_num_oficio').focus();
        return false;
    }
    else if (can_via_rec == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes seleccionar una via de recepción!');
        $('#can_via_rec').focus();
        return false;
    }
    else if (can_fecha == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione una Fecha!');
        $('#can_fecha').focus();
        return false;
    }
    else if (can_fecha > hoy) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡La fecha no puede ser mayor al día de hoy!');
        $('#can_fecha').focus();
        return false;
    }
    else if (can_pais == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione un Estado!');
        $('#can_estado').focus();
        return false;
    }
    else if (can_estado == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione un Estado!');
        $('#can_estado').focus();
        return false;
    }
    else if (can_inst_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar Institución que reporta!');
        $('#can_inst_rep').focus();
        return false;
    }
    else if (can_nom_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes Ingresar nombre de reportante!');
        $('#can_nom_rep').focus();
        return false;
    }
    else if (can_des_suncita_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes Ingresar descripción del reporte!');
        $('#can_des_suncita_rep').focus();
        return false;
    }


    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de la canalización: <br>' + can_num_oficio + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_canalizacion');
            data.append('id', id);
            data.append('can_num_oficio', can_num_oficio);
            data.append('can_folio', can_folio);
            data.append('can_numero', can_numero);
            data.append('can_fecha', can_fecha);
            data.append('can_pais', can_pais);
            data.append('can_estado', can_estado);
            data.append('can_municipio', can_municipio);
            data.append('can_mun_edo', can_mun_edo);
            data.append('can_via_rec', can_via_rec);
            data.append('archivo_can', file);

            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                cache: false
            }).done(function (result) {
                if (result.estatus === "ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    fun_agregar_reportante();


                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
                    $('#btn_create_can').prop('disabled', false);
                    $('#modal_canalizacion').modal('hide');


                    return false;
                }


            })
        }
        else
            $('#btn_user').prop('disabled', false);
    })



}
function fn_listar_canalizaciones() {
    $("#ver_lista_canalizaciones").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_canalizaciones' }, function (data) {
        $('#ver_lista_canalizaciones').html(data);
        $('#tbl_can').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function fn_eliminar_canalizacion(id, can_no_oficio) {
    swal({
        title: '¿Estás seguro?',
        text: can_no_oficio + ' será eliminado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { func: 'fn_eliminar_canalizacion_', id: id, can_no_oficio: can_no_oficio };

            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    var tabla = $('#tbl_can').DataTable();
                    tabla.row($('#l_can' + id)).remove().draw();
                    fn_listar_canalizaciones();

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

function fun_agregar_reportante() {

    can_inst_rep = $.trim($('#can_inst_rep').val());
    can_nom_rep = $.trim($('#can_nom_rep').val());
    ins_con_hechos
    if (can_nom_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre de Reportante Reportante!');
        $('#can_nom_rep').focus();
        return false;
    }
    else if (can_inst_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Institución Reportante!');
        $('#can_inst_rep').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Reportante: <br>' + can_nom_rep + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_reportante');
            data.append('can_inst_rep', can_inst_rep);
            data.append('can_nom_rep', can_nom_rep);

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
                    fun_agregar_caso_reportado();

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

//Caso Reportado

function fun_agregar_caso_reportado() {

    can_des_suncita_rep = $.trim($('#can_des_suncita_rep').val());
    can_ges_reporte = $.trim($('#can_ges_reporte').val());
    ins_con_hechos = $.trim($('#ins_con_hechos').val());

    if (can_des_suncita_rep == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Descripción del caso!');
        $('#can_des_suncita_rep').focus();
        return false;
    }
    else if (can_ges_reporte == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Gestiones del caso !');
        $('#can_ges_reporte').focus();
        return false;
    }
    else if (ins_con_hechos == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa instituciones con conocimiento de los hechos!');
        $('#ins_con_hechos').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Caso serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_caso_reportado');
            data.append('can_des_suncita_rep', can_des_suncita_rep);
            data.append('can_ges_reporte', can_ges_reporte);
            data.append('ins_con_hechos', ins_con_hechos);


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
                    fun_agregar_solicitante();

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
//Solicitante
function fun_agregar_solicitante() {

    can_inst_sol = $.trim($('#can_inst_sol').val());
    can_nom_sol = $.trim($('#can_nom_sol').val());

    if (can_inst_sol == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Institución solicitante!');
        $('#can_inst_sol').focus();
        return false;
    }
    else if (can_nom_sol == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre solicitante!');
        $('#can_nom_sol').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos del Solicitante: <br>' + can_nom_sol + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_solicitante');
            data.append('can_inst_sol', can_inst_sol);
            data.append('can_nom_sol', can_nom_sol);

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
                    fun_agregar_victima();

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
function fun_agregar_victima() {
    can_edad_vic = $.trim($('#can_edad_vic').val());
    can_nom_vic = $.trim($('#can_nom_vic').val());
    can_delitos = $.trim($('#can_delitos').val());
    can_der_vul_vic = $.trim($('#can_der_vul_vic').val());
    can_sexo_victima = document.querySelector('input[name="can_sexo_victima"]:checked').value;
    if ($('#can_per_discapacidad').prop('checked'))
        can_per_discapacidad = 1;
    else
        can_per_discapacidad = 0;

    if ($('#can_per_tercera_edad').prop('checked'))
        can_per_tercera_edad = 1;
    else
        can_per_tercera_edad = 0;

    if ($('#can_per_violencia').prop('checked'))
        can_per_violencia = 1;
    else
        can_per_violencia = 0;

    if ($('#can_per_indigena').prop('checked'))
        can_per_indigena = 1;
    else
        can_per_indigena = 0;

    if ($('#can_per_transgenero').prop('checked'))
        can_per_transgenero = 1;
    else
        can_per_transgenero = 0;


    if (can_der_vul_vic == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Derecho Vulnerado!');
        $('#can_der_vul_vic').focus();
        return false;
    }
    else if (can_nom_vic == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre!');
        $('#can_nom_vic').focus();
        return false;
    }
    else if (can_edad_vic == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Edad!');
        $('#can_edad_vic').focus();
        return false;
    }

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de la victima: <br>' + can_nom_vic + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func', 'fn_guardar_victima_can');
            data.append('can_delitos', can_delitos);
            data.append('can_der_vul_vic', can_der_vul_vic);
            data.append('can_nom_vic', can_nom_vic);
            data.append('can_edad_vic', can_edad_vic);
            data.append('can_edad_vic', can_edad_vic);
            data.append('can_per_tercera_edad', can_per_tercera_edad);
            data.append('can_per_discapacidad', can_per_discapacidad);
            data.append('can_per_violencia', can_per_violencia);
            data.append('can_per_indigena', can_per_indigena);
            data.append('can_per_transgenero', can_per_transgenero);
            data.append('can_sexo_victima', can_sexo_victima);

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
                    $('#modal_canalizacion').modal('hide');

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
} 3

//Avances 

function fn_modal_avance(origen, id) {
    if (origen == 1) {
        $('#id_can_avance').val(0);
        $('#can_tipo_avance').val("");
        $('#can_fecha_avance').val("");
        $('#can_estatus_avance').val("");
        $('#can_desc_avance').val("");
        $('#tit_mod_can_add_avance').html('Crear Avance');

    }
    else if (origen == 2) {
        $('#tit_mod_can_avance').html('Listar Avances ');
        $('#id_can_avance').val(0);
        $('#can_tipo_avance').val("");
        $('#can_fecha_avance').val("");
        $('#can_estatus_avance').val("");
        $('#can_desc_avance').val("");
        $('#avancesCanalizacion').modal('show');
        fn_listar_avances();

    }
    else if (origen == 3) {

        $('#tit_mod_can_add_avance').html('Editar Avance');
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_avance', id: id }, function (res) {
            $('#id_can_avance').val(id);
            $('#can_tipo_avance').val(res.can_tipo_avance);
            $('#can_fecha_avance').val(res.can_fecha_avance);
            $('#can_estatus_avance').val(res.can_estatus_avance);
            $('#can_desc_avance').val(res.can_desc_avance);
            $('#avancesCanalizacion').modal('show');


        });

    }

}
function fun_agregar_avance() {
    id = $('#id_can_avance').val();
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
        html: 'Los datos del Avance: <br>' + can_desc_avance + ' serán almacenados',
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
            data.append('id', id);
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
                    $('#avancesCanalizacion').modal('show');
                    fn_listar_avances();
                    fn_modal_avance(2);

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
function fn_listar_avances() {
    $("#ver_lista_avances").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_avances' }, function (data) {
        $('#ver_lista_avances').html(data);
        $('#tbl_avances').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
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
            datos = { func: 'fn_eliminar_avance_', id: id, can_tipo_avance: can_tipo_avance };

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
                    fn_modal_avance(2)

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
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_carga_municipios' }, function (data) {
        $('#' + combo).html(data);
    });
}
function fn_carga_estados(combo) {
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_carga_estados' }, function (data) {
        $('#' + combo).html(data);
    });
}
function fn_carga_delitos(combo) {
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_carga_delitos' }, function (data) {
        $('#' + combo).html(data);
    });
}
//Aggregar Reportante ++
let agregar_reportante = document.getElementById('agregar');
let contenido = document.getElementById('contenedor');

agregar.addEventListener('click', e => {
    e.preventDefault();
    let clonado = document.querySelector('.clonar');
    let clon = clonado.cloneNode(true);

    contenido.appendChild(clon).classList.remove('clonar');

    let remover_ocutar = contenido.lastChild.childNodes[1].querySelectorAll('span');
    remover_ocutar[0].classList.remove('ocultar');
});
contenido.addEventListener('click', e => {
    e.preventDefault();
    if (e.target.classList.contains('puntero')) {
        let contenedor = e.target.parentNode.parentNode;

        contenedor.parentNode.removeChild(contenedor);
    }
});