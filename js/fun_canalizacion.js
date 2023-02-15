var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';
$(document).ready(function () {


    $("#can_municipio").hide();
    $("#listado_victimas").hide();
    $("#div_otros_estados").hide();
    $("#div_estado").hide();
    $("#can_mun").hide();
    $("#can_mun_edo").hide();
    $("#div_municipio").hide();
    $("#canalizaciones_inactivas").hide();
    $("#canalizaciones_activas").show();
    $("#can_pais").change(function () {

        if ($(this).val() == "México") {
            $("#div_estado").show(),
                $("#div_otros_estados").hide(),
                $("#can_otros_estados").val(""),
                $("#div_municipio").hide(),
                $("#can_estado_label").show(400),
                $("#can_estado").show()

        }
        else {
            $("#div_estado").hide(),
                $("#div_otros_estados").show(400),
                $("#can_otros_estados").show(),
                $("#can_estado").val("0"),
                $("#can_estado").hide(),
                $("#can_municipio").val("0"),
                $("#can_municipio").hide(),
                $("#can_mun_edo").val(""),
                $("#can_mun_edo").hide(),
                $("#can_mun").hide(),
                $("#can_estado_label").hide(400),
                $("#div_mun_c4").hide()

        }
    });
    $("#can_estado").change(function () {
        if ($(this).val() == "30") {
            $("#div_municipio").show(),
                $("#can_municipio").show(200),
                $("#can_mun").show(200),
                $("#can_mun_edo").val(""),
                $("#can_mun_edo").hide(200)
        }


        else {
            $("#can_mun").show(200)
            $("#can_mun_edo").show(200),
                $("#div_municipio").show(),
                $("#can_municipio").hide(),
                $("#can_municipio").val("0")
        }

    });
    $("#can_pais").change(function () {

        if ($(this).val() == "México") {
            $("#div_estado").show(),
                $("#div_otros_estados").hide(),
                $("#can_otros_estados").val(""),
                $("#div_municipio").hide(),
                $("#can_estado_label").show(400),
                $("#can_estado").show()

        }
        else {
            $("#div_estado").hide(),
                $("#div_otros_estados").show(400),
                $("#can_otros_estados").show(),
                $("#can_estado").val("0"),
                $("#can_estado").hide(),
                $("#can_municipio").val("0"),
                $("#can_municipio").hide(),
                $("#can_mun_edo").val(""),
                $("#can_mun_edo").hide(),
                $("#can_mun").hide(),
                $("#can_estado_label").hide(400),
                $("#div_mun_c4").hide()

        }
    });
    $("#can_estado").change(function () {
        if ($(this).val() == "30") {
            $("#div_municipio").show(),
                $("#can_municipio").show(200),
                $("#can_mun").show(200),
                $("#can_mun_edo").val(""),
                $("#can_mun_edo").hide(200)
        }


        else {
            $("#can_mun").show(200)
            $("#can_mun_edo").show(200),
                $("#div_municipio").show(),
                $("#can_municipio").hide(),
                $("#can_municipio").val("0")
        }

    });
    $("#actualizar_canalizaciones").click();
    // fn_listar_canalizaciones_inactivas();

    $(document).on('click', '#agregar_victima', function () {
        $('#agregarVictimaModal').modal('show');
    });
    //Contador de letras descripcion sucinta del caso
    const can_des_suncita_rep = document.getElementById('can_des_suncita_rep');
    const contador = document.getElementById('contador');
    can_des_suncita_rep.addEventListener('input', function (e) {
        const target = e.target;
        const longitudMax = target.getAttribute('maxlength');
        const longitudAct = target.value.length;
        contador.innerHTML = `${longitudAct}/${longitudMax}`;
    });

});

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
        $("#imagen_can").hide();//imagen_can
        $("#div_lista_reportantes").hide();
        $('#id_canalizacion').val(0);
        $('#id_solicitante').val(0);
        $('#id_reportante').val(0);
        $('#can_numero').val("");
        $('#can_num_oficio').val("");
        $('#can_fecha').val("");
        $('#can_estado').val("");
        $('#can_otros_estados').val("");
        $('#can_municipio').val("");
        $('#can_mun_edo').val("");
        $('#can_pais').val("");
        $('#can_ruta_sol_oficio').val("");
        $('#victimasCheck').prop('checked', false).removeAttr('checked');
        $('#can_folio').val("");
        $('#pendiente').prop('checked', false).removeAttr('checked');
        $('#en_proceso').prop('checked', false).removeAttr('checked');
        $('#concluido').prop('checked', false).removeAttr('checked');
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
        can_der_vul_vic
        $('#can_nom_rep').val("");
        imagencan = $("#imagen_subida_can").val("");
        $('#can_des_suncita_rep').val("");
        $('#can_ges_reporte').val("");
        $('#can_inst_sol').val("");
        $('#can_nom_sol').val("");
        $('#ins_con_hechos').val("");
        $('#can_edad_vic').val("");
        $('#can_nom_vic').val("");
        $('#can_delitos').val("0");
        $('#can_der_vul_vic').val("0");
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
        $("#imagen_can").show();//imagen_can
        $('#can_ruta_sol_oficio').val("");
        $('#modal_canalizacion').modal('show');
        $('#modal_canalizacion').modal({ backdrop: 'static', keyboard: false });
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_canalizacion', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_canalizacion').val(id);
            $('#can_folio').val(res.can_folio);
            $('#can_numero').val(res.can_numero);
            $('#can_num_oficio').val(res.can_numero_oficio);
            $('#c4_ruta_sol_oficio_edit').val(res.c4_ruta_sol_oficio);

            imagen_can = '<a  href="../images/canalizacion/' + res.can_ruta_sol_oficio + '" target="_blank"><i class="bi bi-file-pdf"></i>Mostar Archivo Subido</a>';
            $("#imagen_subida_can").html(imagen_can);

            $('#can_fecha').val(res.can_fecha);
            $('#can_pais').val(res.can_pais);
            $('#can_otros_estados').val(res.can_otros_estados);

            if (res.can_pais == 'México') {
                $("#div_estado").show(),
                    $("#can_estado").show(),
                    $("#div_municipio").show(),
                    $("#div_otros_estados").hide(),
                    $("#can_otros_estados").val("")

            }
            else {

                $("#div_otros_estados").show(),
                    $("#can_otros_estados").show(),
                    $("#can_estado").val("0"),
                    $("#div_estado").hide(),
                    $("#div_municipio").hide(),
                    $("#can_municipio").val("0"),
                    $("#can_mun_edo").val("")
            }

            $('#can_estado').val(res.can_estado);

            setTimeout(function () {
                $('#can_estado').val(res.can_estado);
            }, 500);
            if (res.can_estado == '30') {
                $("#can_mun").show(400),
                    $("#can_municipio").show(400),
                    $("#can_mun_edo").hide(),

                    $("#can_mun_edo").val("")
            }
            else {
                $("#can_mun_edo").show(200),
                    $("#can_mun").show()
            }

            $('#can_ruta_sol_oficio_edit').val(res.can_ruta_sol_oficio);
            $('#can_municipio').val(res.can_municipio);
            $('#can_mun_edo').val(res.can_mun_edo);
            $('#can_folio_expediente').val(res.can_folio_expediente);

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

            $('#estatus_expediente').val(res.estatus_expediente);
            switch (res.estatus_expediente) {
                case 'En proceso':
                    $('#en_proceso').click();
                    break;
                case 'Pendiente':
                    $('#pendiente').click();
                    break;
                case 'Concluido':
                    $('#concluido').click();
                    break;
            }
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
    else if (origen == 3) //Agregar Avance
    {
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_agregar_avance', id: id }, function (res) {
            $('#id_gt').val(id);
            $('#nom_gt').val(res.nom_grupo);
            $('#sig_gt').val(res.siglas);
            $('#municipio_gt').val(res.id_municipio);
            $('#avancesCanalizacion').modal('show');
        });
    }
    // else if (origen == 4) {
    //     $('#tit_mod_mostrar').html('Mostar Canalización');
    //     $('#mostrar_canalizacion').modal('show');
    //     $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_canalizacion', id: id, folio_exp: folio_exp }, function (res) {
    //         $('#id_canalizacion').val(id);
    //         $('#can_folio').val(res.can_folio);
    //         $('#can_pais').val(res.can_pais);
    //         $('#can_numero').val(res.can_numero);
    //         $('#can_num_oficio').val(res.can_numero_oficio);
    //         $('#can_fecha').val(res.can_fecha);
    //         $('#can_estado').val(res.can_estado);
    //         $('#can_municipio').val(res.can_municipio);
    //         $('#can_mun_edo').val(res.can_mun_edo);
    //         $('#can_via_rec').val(res.can_via_rec);
    //         $('#can_folio_expediente').val(res.can_folio_expediente);
    //     });
    //     $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_casos_reportados', id: id, folio_exp: folio_exp }, function (res) {
    //         $('#can_des_suncita_rep').val(res.can_des_caso);
    //         $('#can_ges_reporte').val(res.can_gest_caso);
    //         $('#can_estatus_caso').val(res.can_estatus_caso);
    //         $('#ins_con_hechos').val(res.ins_con_hechos);

    //     });
    //     $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_reportantes', folio_exp: folio_exp }, function (res) {
    //         $('#can_inst_rep').val(res.can_inst_reportante);
    //         $('#can_nom_rep').val(res.can_nom_reportante);
    //     });
    //     $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_solicitantes', folio_exp: folio_exp }, function (res) {
    //         $('#can_inst_sol').val(res.can_inst_solicitante);
    //         $('#can_nom_sol').val(res.can_nom_solicitante);
    //     });
    //     $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_victimas', folio_exp: folio_exp }, function (res) {
    //         $('#can_edad_vic').val(res.can_edad_vic);
    //         $('#can_nom_vic').val(res.can_nom_vic);
    //         $('#can_delito').val(res.can_delito);
    //         $('#can_der_vul_vic').val(res.can_der_vul_vic);
    //         $('#can_per_tercera_edad').val(res.can_per_tercera_edad);
    //         $('#can_per_violencia').val(res.can_per_violencia);
    //         $('#can_per_discapacidad').val(res.can_per_discapacidad);
    //         $('#can_per_indigena').val(res.can_per_indigena);
    //         $('#can_per_transgenero').val(res.can_per_transgenero);
    //         $('#can_sexo_victima').val(res.can_sexo_victima);


    //     });
    // }
    else if (origen == 7) {//Agregar Reportante
        $('#tit_mod_reportante').html('Agregar reportante');
        $('#modal_canalizacion').modal('hide');
        $('#modal_reportante').modal('show');

        // $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_reportantes', id: id, folio_exp: folio_exp }, function (res) {
        //     $('#id_reportante_edit').val(id);
        //     $('#can_inst_rep_edit').val(res.can_inst_reportante);
        //     $('#can_nom_rep_edit').val(res.can_nom_reportante);

        // });
    }
    else if (origen == 5) {//Editar Reportante
        $('#tit_mod_reportante').html('Editar reportante');
        $('#modal_reportante').modal('show');

        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_reportantes', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_reportante_edit').val(id);
            $('#can_inst_rep_edit').val(res.can_inst_reportante);
            $('#can_nom_rep_edit').val(res.can_nom_reportante);

        });
    }
    else if (origen == 6) {//Editar Victima
        $('#tit_mod_victima').html('Editar Victima');
        $('#modal_victima').modal('show');

        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_datos_victimas_edit', id: id, folio_exp: folio_exp }, function (res) {
            $('#id_can_victima_edit').val(id);
            $('#id_can_del_victima_edit').val(res.id_del_victima);
            $('#id_can_der_victima_edit').val(res.id_derecho);
            $('#can_edad_vic_edit').val(res.can_edad_vic);
            $('#can_nom_vic_edit').val(res.can_nom_vic);

            setTimeout(function () {
                $('#can_der_vul_vic_edit').val(res.can_der_vul_vic);
            }, 500);
            $('#can_exp_folio_victima_edit').val(res.can_exp_folio_victima);

            res.can_per_tercera_edad == 1 ? $('#can_per_tercera_edad_edit').prop('checked', true) : $('#can_per_tercera_edad_edit').prop('checked', false);
            res.can_per_indigena == 1 ? $('#can_per_indigena_edit').prop('checked', true) : $('#can_per_indigena_edit').prop('checked', false);
            res.can_per_transgenero == 1 ? $('#can_per_transgenero_edit').prop('checked', true) : $('#can_per_transgenero_edit').prop('checked', false);
            res.can_per_discapacidad == 1 ? $('#can_per_discapacidad_edit').prop('checked', true) : $('#can_per_discapacidad_edit').prop('checked', false);
            res.can_per_violencia == 1 ? $('#can_per_violencia_edit').prop('checked', true) : $('#can_per_violencia_edit').prop('checked', false);
            $('#can_sexo_victima_edit').val(res.can_sexo_victima);
            switch (res.can_sexo_victima) {
                case 'Mujer':
                    $('#femenino_edit').prop('checked', true)
                    break;
                case 'Hombre':
                    $('#masculino_edit').prop('checked', true)
                    break;
                case 'N/I':
                    $('#n_i_edit').prop('checked', true)

                    break;
            }
        });

    }


}

function onlyNumberKey(evt) //Solo Permite Numeros
{
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}
function check(e)//Solo permite letras sin caracteres especiales 
{
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patrón de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
//Validación de Campos obligatorios
function fun_validar_campos() {
    hoy = $('#hoy').val();
    id = $('#id_canalizacion').val();
    let can_via_rec = document.querySelector('input[name="can_via_rec"]:checked');
    if (can_via_rec) {

    } else {
        toastr.warning('¡Debes Seleccionar una via de recepción!');
        $('input[name="can_via_rec"]').focus();
        return false;

    }
    let estatus_expediente = document.querySelector('input[name="estatus_expediente"]:checked');
    if (estatus_expediente) {

    } else {
        toastr.warning('¡Debes Seleccionar un Estatus de Expediente!');
        $('input[name="estatus_expediente"]').focus();
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
    swal.fire({
        title: '¿Estás seguro que quieres guardar?',
        html: 'Los datos serán almacenados',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    })
        .then((result) => {
            if (result.value) {
                fun_agregarCanalizacion();
            }
        })
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
    can_otros_estados = $.trim($('#can_otros_estados').val());
    can_estado = $.trim($('#can_estado').val());
    can_municipio = $.trim($('#can_municipio').val());
    can_mun_edo = $.trim($('#can_mun_edo').val());
    can_ruta_sol_oficio_edit = $.trim($('#can_ruta_sol_oficio_edit').val());
    can_ruta_sol_oficio = $.trim($('#can_ruta_sol_oficio').val());
    file0 = document.getElementById('can_ruta_sol_oficio');
    file = file0.files[0];
    //Aqui comienza el caso
    id_caso = $('#id_caso_reportado').val();
    can_des_suncita_rep = $.trim($('#can_des_suncita_rep').val());
    can_ges_reporte = $.trim($('#can_ges_reporte').val());
    ins_con_hechos = $.trim($('#ins_con_hechos').val());
    estatus_expediente = document.querySelector('input[name="estatus_expediente"]:checked').value;

    //Datos Solicitante
    id_solicitante = $('#id_solicitante').val();
    can_inst_sol = $.trim($('#can_inst_sol').val());
    can_nom_sol = $.trim($('#can_nom_sol').val());
    var data = new FormData();
    data.append('func', 'fn_guardar_canalizacion');
    data.append('id', id);
    data.append('can_num_oficio', can_num_oficio);
    data.append('can_folio', can_folio);
    data.append('can_numero', can_numero);
    data.append('can_fecha', can_fecha);
    data.append('can_pais', can_pais);
    data.append('can_otros_estados', can_otros_estados);
    data.append('can_estado', can_estado);
    data.append('can_municipio', can_municipio);
    data.append('can_mun_edo', can_mun_edo);
    data.append('can_via_rec', can_via_rec);
    data.append('archivo_can', file);
    data.append('can_ruta_sol_oficio_edit', can_ruta_sol_oficio_edit);
    //Datos para Caso
    data.append('id_caso', id_caso);
    data.append('can_des_suncita_rep', can_des_suncita_rep);
    data.append('can_ges_reporte', can_ges_reporte);
    data.append('ins_con_hechos', ins_con_hechos);
    //datos para solicitante
    data.append('id_solicitante', id_solicitante);
    data.append('can_inst_sol', can_inst_sol);
    data.append('can_nom_sol', can_nom_sol);
    data.append('estatus_expediente', estatus_expediente);


    $.ajax({
        url: "../controllers/fun_canalizacion.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        cache: false
    }).done(function (result) {
        if (result.estatus === "ok") {
            Swal.fire({ icon: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_canalizacion').modal('hide');
            fn_listar_canalizaciones();

        }
        else if (result.estatus === "editado") {
            Swal.fire({ icon: 'success', title: 'Datos Expediente Editado correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_canalizacion').modal('hide');
            fn_listar_canalizaciones();

        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });


            return false;
        }


    })
}

function fun_editar_reportante() {
    id = $('#id_reportante_edit').val();
    folio_exp = $.trim($('#can_folio_expediente').val());

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
        if (res.estatus === "ok") {
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_reportante').modal('hide');
            fn_listar_reportantes(folio_exp);

        }
        else {
            Swal.fire({ icon: 'warning', title: 'Datos no guardados correctamente', showConfirmButton: false, timer: 1500 });
        }
    })
}

function fun_editar_victima() {
    id = $('#id_can_victima_edit').val();
    folio_exp = $.trim($('#can_exp_folio_victima_edit').val());
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
    if (can_edad_vic_edit == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes Seleccionar la edad de la victima!');
        $('#can_edad_vic_edit').focus();
        return false;
    }
    if (can_nom_vic_edit == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡El nombre de la victima no puede estar vacio!');
        $('#can_nom_vic_edit').focus();
        return false;
    }

    if (can_der_vul_vic_edit == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes Seleccionar un derecho vulnerado!');
        $('#can_der_vul_vic_edit').focus();
        return false;
    }
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
            $('#modal_victima').modal('hide');
            fn_listar_victimas(folio_exp);
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
    });
}
function fn_listar_canalizaciones_inactivas() {
    $("#ver_lista_canalizaciones_inactivas").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_can_inactivas' }, function (data) {
        $('#ver_lista_canalizaciones_inactivas').html(data);
        $('#tbl_can_inactivas').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function tgl() {
    var t = document.getElementById("myBtn");
    if (t.value == "Inactivos") {

        t.value = "Activos";
        fn_listar_canalizaciones();
        $("#canalizaciones_inactivas").hide();
        $("#canalizaciones_activas").show();
    }
    else if (t.value == "Activos") {
        t.value = "Inactivos";
        fn_listar_canalizaciones_inactivas();
        $("#canalizaciones_inactivas").show();
        $("#canalizaciones_activas").hide();
    }
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
                    var tabla = $('#tbl_can_inactiva').DataTable();
                    tabla.row($('#l_can_inactiva' + id)).remove().draw();
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
function fn_modal_avance(origen, folio_exp, id_avance) {

    if (origen == 1) {
        $('#tit_mod_can_avance').html('Listar Avances ');
        $('#id_can_avance').val(0);
        $('#folio_can').val(folio_exp);
        $('#can_fecha_avance').val("");
        $('#can_desc_avance').val("");
        $('#avancesCanalizacion').modal('show');
        $("#avance").show();
        $("#crear_nuevo_avance").show();
        $("#editar_avance").hide();
        fn_listar_avances(folio_exp);

    }
    if (origen == 2) {//limpia el modal
        $('#id_can_avance').val(0);
        $('#can_fecha_avance').val("");
        $('#can_desc_avance').val("");
        $("#crear_nuevo_avance").show();
        $("#editar_avance").hide();

    }
    else if (origen == 3) {

        $('#tit_mod_can_add_avance').html('Editar Avance');
        $.post("../controllers/fun_canalizacion.php", { func: 'fn_obtener_avance', id_avance: id_avance, folio_exp: folio_exp }, function (res) {
            $('#id_can_avance').val(id_avance);
            $('#folio_can').val(folio_exp);
            $('#can_fecha_avance').val(res.can_fecha_avance);
            $('#can_desc_avance').val(res.can_desc_avance);
            $('#avancesCanalizacion').modal('show');
            $("#crear_nuevo_avance").hide();
            $("#editar_avance").show();
        });

    }

}
function fun_agregar_avance() {
    id = $('#id_can_avance').val();
    folio_can = $.trim($('#folio_can').val());
    can_fecha_avance = $.trim($('#can_fecha_avance').val());
    can_desc_avance = $.trim($('#can_desc_avance').val());

    if (can_fecha_avance == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Ingresa Fecha de Avance!');
        $('#can_fecha_avance').focus();
        return false;
    }
    else if (can_desc_avance == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes de ingresar Actividad Especifica!');
        $('#can_desc_avance').focus();
        return false;
    }
    swal.fire({
        title: '¿Estás seguro?',
        html: 'Los datos del Avance: <br>' + can_desc_avance + ' serán almacenados',
        icon: 'warning',
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
            data.append('folio_can', folio_can);
            data.append('can_fecha_avance', can_fecha_avance);
            data.append('can_desc_avance', can_desc_avance);

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
                    $('#crearAvance').modal('hide');
                    $('#avancesCanalizacion').modal('show');
                    fn_listar_avances(folio_can);
                    fn_modal_avance(2);

                }
                else if (res.estatus === "editado") {
                    Swal.fire({ icon: 'success', title: 'Expediente Editado correctamente', showConfirmButton: false, timer: 1500 });
                    fn_listar_avances(folio_can);
                    fn_modal_avance(2);

                }
                else {
                    Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
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
function fn_listar_avances(folio_exp) {
    $("#ver_lista_avances").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_avances', folio_exp: folio_exp }, function (data) {
        $('#ver_lista_avances').html(data);
        $('#tbl_avances').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function fn_eliminar_avance(id, can_desc_avance) {
    swal.fire({
        title: '¿Estás seguro?',
        text: can_desc_avance + ' será eliminado',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { func: 'fn_eliminar_avance', id: id, can_desc_avance: can_desc_avance };

            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal.fire({ icon: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    var tabla = $('#tbl_avance').DataTable();
                    tabla.row($('#l_avance' + id)).remove().draw();
                    fn_listar_avances();
                    fn_modal_avance(2)

                }
                else {
                    Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
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
        // can_delito = $.trim($('#can_delito').val());
        // if (can_delito == '') {
        //     toastr.options.timeOut = 2500;
        //     toastr.warning('Seleccionar Delito!');
        //     $('#can_delito').focus();
        //     return false;
        // }

        can_der_vul_vic = $.trim($('#can_der_vul_vic').val());
        if (can_der_vul_vic == '') {
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

        if (!document.querySelector('input[name="can_sexo_victima"]:checked')) {
            toastr.options.timeOut = 2500;
            toastr.warning('Seleccionar Sexo!');
            $('#masculino').focus();

            setTimeout(() => {
                $('#masculino').prop('checked', true);
                setTimeout(() => {
                    $('#masculino').prop('checked', false);
                    $('#femenino').prop('checked', true);
                    setTimeout(() => {
                        $('#femenino').prop('checked', false);
                        $('#n_i').prop('checked', true);
                        setTimeout(() => {
                            $('#n_i').prop('checked', false);
                        }, 500);
                    }, 500);
                }, 500);
            }, 500);

            return false;
        }
        can_sexo_victima = document.querySelector('input[name="can_sexo_victima"]:checked').value;

        // can_delito_c=can_delito.split(",");
        // can_num_del=can_delito_c.length;
    }
    else {
        can_edad_vic = '';
        can_nom_vic = '';
        // can_delito = '';
        can_der_vul_vic = '';
        can_per_tercera_edad = '0';
        can_per_violencia = '0';
        can_per_discapacidad = '0';
        can_per_indigena = '0';
        can_per_transgenero = '0';
        can_sexo_victima = '';
        // can_num_del = '';


    }

    $.post("../controllers/fun_canalizacion.php", {
        func: 'carrito_victima', evento: evento, id: id, can_edad_vic: can_edad_vic,
        can_nom_vic: can_nom_vic, can_der_vul_vic: can_der_vul_vic, can_per_tercera_edad: can_per_tercera_edad,
        can_per_violencia: can_per_violencia, can_per_discapacidad: can_per_discapacidad, can_per_indigena: can_per_indigena,
        can_per_transgenero: can_per_transgenero, can_sexo_victima: can_sexo_victima,
    }, function (data) {
        $('#lista_dat_vic').html(data);
        $('#can_edad_vic').val('');
        $('#can_nom_vic').val('');
        // $('#can_delito').val('');
        $('#can_der_vul_vic').val('');
        $('#can_per_tercera_edad').prop('checked', false).removeAttr('checked');
        $('#can_per_violencia').prop('checked', false).removeAttr('checked');
        $('#can_per_violencia').prop('checked', false).removeAttr('checked');
        $('#can_per_discapacidad').prop('checked', false).removeAttr('checked');
        $('#can_per_indigena').prop('checked', false).removeAttr('checked');
        $('#can_per_transgenero').prop('checked', false).removeAttr('checked');
        $('#masculino').prop('checked', false).removeAttr('checked');
        $('#femenino').prop('checked', false).removeAttr('checked');
        $('#n_i').prop('checked', false).removeAttr('checked');
        // $('#can_num_del').val('');

    });
}
