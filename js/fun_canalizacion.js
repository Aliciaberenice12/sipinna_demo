var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

$(document).ready(function () {
    $("#can_mun_edo").hide();
    $("#can_municipio").hide();
    $("#can_mun").hide();
    $("#listado_victimas").hide();


    $("#can_estado").change(function () {

        if ($(this).val() == "30")

            $("#can_mun_edo").hide(),
                $("#can_municipio").show(400),
                $("#can_mun").show(400),
                $("#can_mun_edo").val("");

        else
            $("#can_municipio").hide(),
                $("#can_mun_edo").show(200),
                $("#can_mun").show(200),
                $("#can_municipio").val("0");

    });

    $("#actualizar_canalizaciones").click();

    $(document).on('click', '#agregar_victima', function () {
        $('#agregarVictimaModal').modal('show');
    });

});
function mensaje(origen) {
    if (origen == 1) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Aun en proceso!');
        return false;
    }
    else {

    }
}
//Canalizacion
function mod_canalizacion(origen, id, folio_exp) {
    fn_carga_municipios('can_municipio');
    fn_carga_estados('can_estado');
    fn_carga_delitos('can_delito');
    fn_carga_derechos('can_der_vul_vic');


    if (origen == 1)//Agregar
    {
        $('#tit_mod_can').html('Crear Canalización');
        carrito_reportante(3, 0);
        carrito_victima(3, 0);
        $("#carrito_victima_show").show();
        $("#victimas").show();
        $("#listado_victimas").hide();
        $("#datos_reportante").show();
        $("#div_lista_reportantes").hide();
        $('#id_canalizacion').val(0);
        $('#id_solicitante').val(0);
        $('#id_reportante').val(0);
        $('#can_numero').val("");
        $('#can_num_oficio').val("");
        $('#can_fecha').val("");
        $('#can_estado').val("");
        $('#can_municipio').val("");
        $('#can_mun_edo').val("");
        $('#can_pais').val("");
        $('#can_ruta_sol_oficio').val("");
        $('#victimasCheck').prop('checked', false).removeAttr('checked');
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
        $('#modal_canalizacion').modal({ backdrop: 'static', keyboard: false });
        $('#modal_canalizacion').modal('show');




    }
    else if (origen == 2) //Editar...
    {
        fn_listar_victimas(folio_exp);
        fn_listar_reportantes(folio_exp);
        $('#tit_mod_can').html('Editar Canalización');
        //$("#actualizar_victimas").click();
        $("#victimas").hide();//crea en carrito victima
        $("#listado_victimas").show();
        $("#datos_reportante").hide();//crean en carrito reportante
        $("#div_lista_reportantes").show();
        $('#modal_canalizacion').modal('show');
        $('#modal_canalizacion').modal({ backdrop: 'static', keyboard: false });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_canalizacion', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_canalizacion').val(id);
            $('#can_folio').val(res.can_folio);
            $('#can_pais').val(res.can_pais);
            $('#can_numero').val(res.can_numero);
            $('#can_num_oficio').val(res.can_numero_oficio);
            ruta = res.can_ruta_sol_oficio;
            $('#can_fecha').val(res.can_fecha);
            $('#can_estado').val(res.can_estado);
            if (res.can_estado == '30') {
                $("#can_mun_edo").hide(),
                    $("#can_mun_edo").val("");
                $("#can_municipio").show(400),
                    $("#can_mun").show(400);

            }
            else {
                $("#can_municipio").hide(),
                    $("#can_municipio").val("");
                $("#can_mun_edo").show(200),
                    $("#can_mun").show(200);

            }
            $('#can_municipio').val(res.can_municipio);
            $('#can_mun_edo').val(res.can_mun_edo);
            $('#can_via_rec').val(res.can_via_rec);
            switch (res.can_via_rec) {
                case 'Telefonica':
                    $('#can_via_tel').click();
                    break;
                case 'Personal':
                    $('#can_via_per').click();
                    break;
                case 'Correo':
                    $('#can_via_cor').click();
                    break;

                case 'Redes Sociales':
                    $('#can_via_red').click();
                    break;
            }
            $('#can_folio_expediente').val(res.can_folio_expediente);
        });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_casos_reportados', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_caso_reportado').val(id);
            $('#can_des_suncita_rep').val(res.can_des_caso);
            $('#can_ges_reporte').val(res.can_gest_caso);
            $('#can_estatus_caso').val(res.can_estatus_caso);
            $('#ins_con_hechos').val(res.ins_con_hechos);

        });

        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_solicitantes', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_solicitante').val(id);
            $('#can_inst_sol').val(res.can_inst_solicitante);
            $('#can_nom_sol').val(res.can_nom_solicitante);
        });
        fn_listar_victimas(folio_exp);
        fn_listar_reportantes(folio_exp);
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
    else if (origen == 4) {
        $('#tit_mod_mostrar').html('Mostar Canalización');
        $('#mostrar_canalizacion').modal('show');
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_canalizacion', id: id, folio_exp: folio_exp }, function (res) {
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
        });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_casos_reportados', id: id, folio_exp: folio_exp }, function (res) {
            $('#can_des_suncita_rep').val(res.can_des_caso);
            $('#can_ges_reporte').val(res.can_gest_caso);
            $('#can_estatus_caso').val(res.can_estatus_caso);
            $('#ins_con_hechos').val(res.ins_con_hechos);

        });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_reportantes', folio_exp: folio_exp }, function (res) {
            $('#can_inst_rep').val(res.can_inst_reportante);
            $('#can_nom_rep').val(res.can_nom_reportante);
        });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_solicitantes', folio_exp: folio_exp }, function (res) {
            $('#can_inst_sol').val(res.can_inst_solicitante);
            $('#can_nom_sol').val(res.can_nom_solicitante);
        });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_victimas', folio_exp: folio_exp }, function (res) {
            $('#can_edad_vic').val(res.can_edad_vic);
            $('#can_nom_vic').val(res.can_nom_vic);
            $('#can_delito').val(res.can_delito);
            $('#can_der_vul_vic').val(res.can_der_vul_vic);
            $('#can_per_tercera_edad').val(res.can_per_tercera_edad);
            $('#can_per_violencia').val(res.can_per_violencia);
            $('#can_per_discapacidad').val(res.can_per_discapacidad);
            $('#can_per_indigena').val(res.can_per_indigena);
            $('#can_per_transgenero').val(res.can_per_transgenero);
            $('#can_sexo_victima').val(res.can_sexo_victima);


        });
    }
    else if (origen == 5) {//Editar Reportante
        $('#tit_mod_reportante').html('Editar reportante');
        $('#modal_canalizacion').modal('hide');
        $('#modal_reportante').modal('show');

        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_reportantes', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_reportante_edit').val(id);
            $('#can_inst_rep_edit').val(res.can_inst_reportante);
            $('#can_nom_rep_edit').val(res.can_nom_reportante);

        });
    }
    else if (origen == 6) {//Editar Victima
        $('#tit_mod_victima').html('Editar Victima');
        $('#modal_canalizacion').modal('hide');
        $('#modal_victima').modal('show');

        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_victimas_edit', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_can_victima_edit').val(id);
            $('#id_can_del_victima_edit').val(res.id_del_victima);
            $('#id_can_der_victima_edit').val(res.id_derecho);
            $('#can_edad_vic_edit').val(res.can_edad_vic);
            $('#can_nom_vic_edit').val(res.can_nom_vic);
            $('#can_delito_edit').val(res.can_delito);
            $('#can_der_vul_vic_edit').val(res.can_der_vul_vic);
            $('#can_exp_folio_victima_edit').val(res.can_exp_folio_victima);

            res.can_per_tercera_edad == 1 ? $('#can_per_tercera_edad_edit').prop('checked', true) : $('#can_per_tercera_edad_edit').prop('checked', false);
            res.can_per_indigena == 1 ? $('#can_per_indigena_edit').prop('checked', true) : $('#can_per_indigena_edit').prop('checked', false);
            res.can_per_transgenero == 1 ? $('#can_per_transgenero_edit').prop('checked', true) : $('#can_per_transgenero_edit').prop('checked', false);
            res.can_per_discapacidad == 1 ? $('#can_per_discapacidad_edit').prop('checked', true) : $('#can_per_discapacidad_edit').prop('checked', false);
            res.can_per_violencia == 1 ? $('#can_per_violencia_edit').prop('checked', true) : $('#can_per_violencia_edit').prop('checked', false);
            $('#can_sexo_victima_edit').val(res.can_sexo_victima);
            switch (res.can_sexo_victima) {
                case 'Femenino':
                    $('#femenino_edit').prop('checked', true)
                    break;
                case 'Masculino':
                    $('#masculino_edit').prop('checked', true)
                    break;
                case 'N/I':
                    $('#n_i_edit').prop('checked', true)

                    break;
            }
        });

    }


}
//Validación de Campos obligatorios
function fun_validar_campos() {
    hoy = $('#hoy').val();
    id = $('#id_canalizacion').val();
    let can_via_rec = document.querySelector('input[name="can_via_rec"]:checked');
    if (can_via_rec) {
      
    } else {
        toastr.warning('¡Debes Seleccionar Una la via de recepción!');
        $('input[name="can_via_rec"]').focus();
        return false;
        
    }
    can_num_oficio = $.trim($('#can_num_oficio').val());
    can_numero = $.trim($('#can_numero').val());
    can_folio = $.trim($('#can_folio').val());
    can_fecha = $.trim($('#can_fecha').val());
    can_pais = $.trim($('#can_pais').val());
    can_estado = $.trim($('#can_estado').val());
    can_municipio = $.trim($('#can_municipio').val());
    can_mun_edo = $.trim($('#can_mun_edo').val());
    can_ruta_sol_oficio = $.trim($('#can_ruta_sol_oficio').val());
    file0 = document.getElementById('can_ruta_sol_oficio');
    file = file0.files[0];
    can_des_suncita_rep = $.trim($('#can_des_suncita_rep').val());
    can_ges_reporte = $.trim($('#can_ges_reporte').val());
    ins_con_hechos = $.trim($('#ins_con_hechos').val());
    can_inst_sol = $.trim($('#can_inst_sol').val());
    can_nom_sol = $.trim($('#can_nom_sol').val());


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
    if (can_ruta_sol_oficio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes Seleccionar Archivo!');
        $('#can_ruta_sol_oficio').focus();
        return false;
    }
    if (can_numero == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar Número!');
        $('#can_numero').focus();
        return false;
    }
    else if (can_num_oficio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el numero de oficio!');
        $('#can_num_oficio').focus();
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
    else if (can_estado == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione un Estado!');
        $('#can_estado').focus();
        return false;
    }
    else if (can_des_suncita_rep == '') {
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

    else if (can_nom_sol == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Nombre solicitante!');
        $('#can_nom_sol').focus();
        return false;
    }
    fun_agregarCanalizacion();

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
    file0 = document.getElementById('can_ruta_sol_oficio');
    file = file0.files[0];

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
            fun_agregar_caso_reportado();


        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });


            return false;
        }


    })
}
//Caso Reportado

function fun_agregar_caso_reportado() {
    id = $('#id_caso_reportado').val();
    can_des_suncita_rep = $.trim($('#can_des_suncita_rep').val());
    can_ges_reporte = $.trim($('#can_ges_reporte').val());
    ins_con_hechos = $.trim($('#ins_con_hechos').val());

    var data = new FormData();
    data.append('func', 'fn_guardar_caso_reportado');
    data.append('id', id);
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
            fun_agregar_solicitante();
        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modalCanalizacion').modal('hide');
            return false;
        }
    })
}
//Solicitante
function fun_agregar_solicitante() {
    id = $('#id_solicitante').val();
    can_inst_sol = $.trim($('#can_inst_sol').val());
    can_nom_sol = $.trim($('#can_nom_sol').val());

    var data = new FormData();
    data.append('func', 'fn_guardar_solicitante');
    data.append('id', id);
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
        if (res.estatus === "ok") {

            fun_agregar_reportante();

        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modalCanalizacion').modal('hide');
            fn_listar_canalizaciones();

            return false;
        }


    })
}
//Reportante
function fun_agregar_reportante(id) {
    id = $('#id_reportante').val();

    var data = new FormData();
    data.append('func', 'fn_guardar_reportante');
    data.append('id', id);
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
            fun_agregar_victima();
        }
        else {
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_canalizacion').modal('hide');
            fn_listar_canalizaciones();

        }
    })
}
function fun_editar_reportante() {
    id = $('#id_reportante_edit').val();
    can_inst_rep_edit = $.trim($('#can_inst_rep_edit').val());
    can_nom_rep_edit = $.trim($('#can_nom_rep_edit').val());

    var data = new FormData();
    data.append('func', 'fn_guardar_reportante');
    data.append('id', id);
    data.append('can_inst_rep_edit', can_inst_rep_edit);
    data.append('can_nom_rep_edit', can_nom_rep_edit);

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
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_reportante').modal('hide');
            $('#modal_canalizacion').modal('show');

            $("#actualizar_canalizaciones").click();

        }
        else {
            Swal.fire({ icon: 'warning', title: 'Datos no guardados correctamente', showConfirmButton: false, timer: 1500 });
        }
    })
}
//Guardar Victima
function fun_agregar_victima() {
    id = $('#id_can_victima').val();
    can_edad_vic = $.trim($('#can_edad_vic').val());
    can_nom_vic = $.trim($('#can_nom_vic').val());
    can_sexo_victima = $.trim($('#can_sexo_victima').val());
    can_per_tercera_edad = $.trim($('#can_per_tercera_edad').val());
    can_per_violencia = $.trim($('#can_per_violencia').val());
    can_per_discapacidad = $.trim($('#can_per_discapacidad').val());
    can_per_indigena = $.trim($('#can_per_indigena').val());
    can_per_transgenero = $.trim($('#can_per_transgenero').val());

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
    else {
        can_per_transgenero = 0;
    }

    var data = new FormData();
    data.append('func', 'fn_guardar_victima_can');
    data.append('id', id);
    data.append('can_nom_vic', can_nom_vic);
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
        if (res.estatus === "ok") {
            Swal.fire({ icon: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_canalizacion').modal('hide');
            fn_listar_canalizaciones();

        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modalCanalizacion').modal('hide');


            return false;
        }


    })
}

function fun_editar_victima() {
    id = $('#id_can_victima_edit').val();
    id_can_del_victima_edit = $.trim($('#id_can_del_victima_edit').val());
    can_delito_edit = $.trim($('#can_delito_edit').val());
    id_can_der_victima_edit = $.trim($('#id_can_der_victima_edit').val());
    can_der_vul_vic_edit = $.trim($('#can_der_vul_vic_edit').val());
    can_edad_vic_edit = $.trim($('#can_edad_vic_edit').val());
    can_nom_vic_edit = $.trim($('#can_nom_vic_edit').val());
    can_sexo_victima_edit = document.querySelector('input[name="can_sexo_victima_edit"]:checked').value;
    can_per_tercera_edad_edit = $.trim($('#can_per_tercera_edad_edit').val());
    can_per_indigena_edit = $.trim($('#can_per_indigena_edit').val());
    can_per_transgenero_edit = $.trim($('#can_per_transgenero_edit').val());
    can_per_discapacidad_edit = $.trim($('#can_per_discapacidad_edit').val());
    can_per_violencia_edit = $.trim($('#can_per_violencia_edit').val());
    if ($('#can_per_discapacidad_edit').prop('checked'))
        can_per_discapacidad_edit = 1;
    else
        can_per_discapacidad_edit = 0;

    if ($('#can_per_tercera_edad_edit').prop('checked'))
        can_per_tercera_edad_edit = 1;
    else
        can_per_tercera_edad_edit = 0;

    if ($('#can_per_violencia_edit').prop('checked'))
        can_per_violencia_edit = 1;
    else
        can_per_violencia_edit = 0;

    if ($('#can_per_indigena_edit').prop('checked'))
        can_per_indigena_edit = 1;
    else
        can_per_indigena_edit = 0;

    if ($('#can_per_transgenero_edit').prop('checked'))
        can_per_transgenero_edit = 1;
    else {
        can_per_transgenero_edit = 0;
    }

    var data = new FormData();
    data.append('func', 'fn_guardar_victima_can');
    data.append('id', id);
    data.append('can_edad_vic_edit', can_edad_vic_edit);
    data.append('can_nom_vic_edit', can_nom_vic_edit);
    data.append('id_can_der_victima_edit', id_can_der_victima_edit);
    data.append('can_der_vul_vic_edit', can_der_vul_vic_edit);
    data.append('id_can_del_victima_edit', id_can_del_victima_edit);
    data.append('can_delito_edit', can_delito_edit);
    data.append('can_per_tercera_edad_edit', can_per_tercera_edad_edit);
    data.append('can_per_indigena_edit', can_per_indigena_edit);
    data.append('can_per_transgenero_edit', can_per_transgenero_edit);
    data.append('can_per_discapacidad_edit', can_per_discapacidad_edit);
    data.append('can_per_violencia_edit', can_per_violencia_edit);
    data.append('can_sexo_victima_edit', can_sexo_victima_edit);

    $.ajax({
        url: "../controllers/fun_canalizacion.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        cache: false
    }).done(function (res) {
        if (res.estatus === "ok") {
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $("#actualizar_canalizaciones").click();
            $('#modal_canalizacion').modal('show');
            $('#modal_victima').modal('hide');

        }
        else {
            Swal.fire({ icon: 'warning', title: 'Datos no guardados correctamente', showConfirmButton: false, timer: 1500 });
        }
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
        fun_reportante();//funcion para Eliminar variables de session array 
    });
}

function fn_eliminar_canalizacion(id, can_no_oficio) {
    swal.fire({
        title: '¿Estás seguro?',
        input: 'text',
        text: 'El oficio ' + can_no_oficio + ' será eliminado Describe por que:',
        icon: 'warning',
        autocapitalize: 'off',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar',
        inputValidator: desc_eliminar => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!desc_eliminar) {
                return "Por favor escribe la Descripción";
            } else {
                return undefined;
            }
        }
    }).then((result) => {
        if (result.value) {
            let desc_eliminar = result.value;
            datos = { func: 'fn_eliminar_canalizacion', id: id, desc_eliminar: desc_eliminar };
            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal.fire({ icon: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
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
//Victima
function mod_can_victima(origen, id) {

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
function fun_reportante() {
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_reportante' });
}
function fn_listar_victimas(folio_exp) {
    $("#ver_lista_victimas").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_victimas', folio_exp: folio_exp }, function (data) {
        $('#ver_lista_victimas').html(data);
        $('#tbl_victimas').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}

function fn_listar_reportantes(folio_exp) {
    $("#listado_reportantes").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_reportantes', folio_exp: folio_exp }, function (data) {
        $('#listado_reportantes').html(data);
        $('#tbl_reportados').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
//Avances 
function fn_modal_avance(origen, folio_exp) {
    if (origen == 1) {
        $('#id_can_avance').val(0);
        $('#can_folio').val(res.can_folio);
        $('#can_tipo_avance').val("");
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
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_avance', id: id, folio_exp: folio_exp }, function (res) {
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
        $('#can_delito_edit').html(data);

    });
}
function fn_carga_derechos(combo) {
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_carga_derechos' }, function (data) {
        $('#' + combo).html(data);
        $('#can_der_vul_vic_edit').html(data);

    });
}


function carrito_reportante(evento, id) {

    if (evento == 1) //Agregar
    {
        can_inst_rep = $.trim($('#can_inst_rep').val());
        can_nom_rep = $.trim($('#can_nom_rep').val());
        if (can_nom_rep == '') {
            toastr.options.timeOut = 2500;
            toastr.warning('Ingresar Nombre del reportante!');
            $('#can_nom_rep').focus();
            return false;
        }

    }
    else {
        can_inst_rep = '';
        can_nom_rep = '';
    }

    $.post("../controllers/fun_canalizacion.php", { func: 'carrito_reportante', evento: evento, id: id, can_inst_rep: can_inst_rep, can_nom_rep: can_nom_rep }, function (data) {
        $('#lista_dat_rep').html(data);
        $('#can_inst_rep').val('');
        $('#can_nom_rep').val('');
    });
}

function carrito_victima(evento, id) {

    if (evento == 1) //Agregar
    {
        can_edad_vic = $.trim($('#can_edad_vic').val());
        if (can_edad_vic == '') {
            toastr.options.timeOut = 2500;
            toastr.warning('Ingresar Edad!');
            $('#can_edad_vic').focus();
            return false;
        }

        can_nom_vic = $.trim($('#can_nom_vic').val());
        if (can_nom_vic == '') {
            toastr.options.timeOut = 2500;
            toastr.warning('Ingresar Nombre de la victima!');
            $('#can_nom_vic').focus();
            return false;
        }
        can_delito = $.trim($('#can_delito').val());
        if (can_delito == '0') {
            toastr.options.timeOut = 2500;
            toastr.warning('Seleccionar Delito!');
            $('#can_delito').focus();
            return false;
        }
        
        can_der_vul_vic = $.trim($('#can_der_vul_vic').val());
        if (can_der_vul_vic == '0') {
            toastr.options.timeOut = 2500;
            toastr.warning('Debe Seleccionar al menos un derecho vulnerado!');
            $('#can_der_vul_vic').focus();
            return false;
        }
        can_per_tercera_edad = $.trim($('#can_per_tercera_edad').val());
        can_per_violencia = $.trim($('#can_per_violencia').val());
        can_per_discapacidad = $.trim($('#can_per_discapacidad').val());
        can_per_indigena = $.trim($('#can_per_indigena').val());
        can_per_transgenero = $.trim($('#can_per_transgenero').val());
        can_sexo_victima = document.querySelector('input[name="can_sexo_victima"]:checked').value;


        if ($('#can_per_discapacidad').prop('checked'))
            can_per_discapacidad = 1;
        else
            can_per_discapacidad = '';

        if ($('#can_per_tercera_edad').prop('checked'))
            can_per_tercera_edad = 1;
        else
            can_per_tercera_edad = '';

        if ($('#can_per_violencia').prop('checked'))
            can_per_violencia = 1;
        else
            can_per_violencia = '';

        if ($('#can_per_indigena').prop('checked'))
            can_per_indigena = 1;
        else
            can_per_indigena = '';

        if ($('#can_per_transgenero').prop('checked'))
            can_per_transgenero = 1;
        else
            can_per_transgenero = '';



    }
    else {
        can_edad_vic = '';
        can_nom_vic = '';
        can_delito = '0';
        can_der_vul_vic = '0';
        can_per_tercera_edad = '0';
        can_per_violencia = '0';
        can_per_discapacidad = '0';
        can_per_indigena = '0';
        can_per_transgenero = '0';
        can_sexo_victima = 'N/I';


    }

    $.post("../controllers/fun_canalizacion.php", {
        func: 'carrito_victima', evento: evento, id: id, can_edad_vic: can_edad_vic,
        can_nom_vic: can_nom_vic, can_delito: can_delito, can_der_vul_vic: can_der_vul_vic, can_per_tercera_edad: can_per_tercera_edad,
        can_per_violencia: can_per_violencia, can_per_discapacidad: can_per_discapacidad, can_per_indigena: can_per_indigena,
        can_per_transgenero: can_per_transgenero, can_sexo_victima: can_sexo_victima
    }, function (data) {
        $('#lista_dat_vic').html(data);
        $('#can_edad_vic').val('');
        $('#can_nom_vic').val('');
        $('#can_delito').val('0');
        $('#can_der_vul_vic').val('0');
        $('#can_per_tercera_edad').prop('checked', false).removeAttr('checked');
        $('#can_per_violencia').prop('checked', false).removeAttr('checked');
        $('#can_per_violencia').prop('checked', false).removeAttr('checked');
        $('#can_per_discapacidad').prop('checked', false).removeAttr('checked');
        $('#can_per_indigena').prop('checked', false).removeAttr('checked');
        $('#can_per_transgenero').prop('checked', false).removeAttr('checked');
        $('#masculino').prop('checked', false).removeAttr('checked');
        $('#femenino').prop('checked', false).removeAttr('checked');
        $('#n_i').prop('checked', false).removeAttr('checked');





    });
}