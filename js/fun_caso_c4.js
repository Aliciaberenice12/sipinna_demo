var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

$(document).ready(function () {
    $("#c4_mun").hide();
    $("#c4_mun_edo").hide();
    $("#c4_municipio").hide();
    $("#c4_edo").hide();
    $("#otros_estados_c4").hide();
    $("#c4_estado").hide();
    $("#div_otros_estados_c4").hide();
    $("#div_estado_c4").hide();
    $("#div_mun_c4").hide();


    $("#c4_pais").change(function () {

        if ($(this).val() == "México") {
            $("#div_estado_c4").show(),
            $("#div_otros_estados_c4").hide(),
            $("#otros_estados_c4").val(""),

            $("#c4_edo").show(400),
            $("#c4_estado").show()

        }
        else {
            $("#div_estado_c4").hide(),

            $("#div_otros_estados_c4").show(400),
                $("#otros_estados_c4").show(),
                $("#c4_edo").val("0"),
                $("#c4_mun_edo").val(""),
                $("#c4_mun").val("0"),

                $("#c4_edo").hide(400),
                $("#c4_estado").hide(),
                $("#div_mun_c4").hide()


        }
    });
    $("#c4_edo").change(function () {
        if ($(this).val() == "30") {
            $("#div_mun_c4").show(),
            $("#c4_municipio").show(200),
            $("#c4_mun").show(200),
                $("#c4_mun_edo").val(""),
                $("#c4_mun_edo").hide(200)
        }


        else {
            $("#c4_municipio").show(200),
            $("#div_mun_c4").show(),
            $("#c4_mun").hide(),
                $("#c4_mun").val("0"),
                $("#c4_mun_edo").show(200)
        }

    });


    $("#actualizar_listado").click();
});
//Casos de c4
function mensaje(origen) {
    if (origen == 1) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Aun en proceso!');
        return false;
    }
    else {

    }
}
function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}
function mod_caso_c4(origen, id, fol_c4) {
    fn_carga_municipios('c4_mun');
    fn_carga_estados('c4_edo');
    fn_carga_delitos('c4_delitos');
    fn_carga_parentescos('c4_parentesco');
    fn_carga_derechos('c4_der_vul');
    fn_combo_parentescos('c4_parentesco_edit');


    if (origen == 1) {
        carrito_victima_c4(2, 3, 0);
        carrito_probable_resp(3, 0);
        $("#add_reportantes").show();
        $("#add_pro_resp").show();
        $("#add_victimas").show();
        $("#lista_bd_dat_rep_c4").hide();
        $("#lista_bd_probable_res").hide();
        $("#lista_bd_victimas").hide();
        $("#imagen_c4").hide();//imagen_c4
        $('#tit_mod_c4').html('Crear Caso ');
        $('#id_caso').val(0);
        $('#c4_numero').val("");
        $('#c4_pais').val("");
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
        $('#c4_observaciones').val("");
        $('#c4_rep_der').val("");
        $('#c4_delitos').val("");
        $('#c4_per_tercera_edad').prop('checked', false).removeAttr('checked');
        $('#c4_per_discapacidad').prop('checked', false).removeAttr('checked');
        $('#c4_per_violencia').prop('checked', false).removeAttr('checked');
        $('#c4_nom_vic').val("");
        $('#c4_edad_vic').val("");
        $('#masculino').prop('checked', false).removeAttr('checked');
        $('#femenino').prop('checked', false).removeAttr('checked');
        $('#n_i').prop('checked', false).removeAttr('checked');

        $('#modal_c4').modal({ backdrop: 'static', keyboard: false });
        $('#modal_c4').modal('show');

    }
    //editar
    else if (origen == 2) {
        $('#tit_mod_c4').html('Editar Caso');
        $("#add_reportantes").hide();
        $("#add_pro_resp").hide();
        $("#add_victimas").hide();
        $("#lista_bd_dat_rep_c4").show();
        $("#lista_bd_probable_res").show();
        $("#lista_bd_victimas").show();
        $("#imagen_c4").show();//imagen_c4

        $.post("../controllers/fun_casos_c4.php", { func: 'fn_obtener_caso_c4', id: id }, function (res) {
            $('#id_caso').val(id);
            $('#c4_folio').val(res.c4_folio);
            $('#c4_numero').val(res.c4_numero);
            $('#c4_no_oficio').val(res.c4_no_oficio);
            $('#c4_ruta_sol_oficio_edit').val(res.c4_ruta_sol_oficio);
            //$('#c4_ruta_sol_oficio').val(res.c4_ruta_sol_oficio);
            imagenc4 = '<a  href="../images/casos_c4/' + res.c4_ruta_sol_oficio + '"  /a>';
            $("#imagen_subida_c4").html(imagenc4);
            $('#c4_fecha_inicio').val(res.c4_fecha_inicio);
            $('#c4_pais').val(res.c4_pais);
            if(res.c4_pais == 'México'){
                $("#div_estado_c4").show(),
                $("#c4_edo").show(),
                $("#c4_estado").show(),
                $("#div_mun_c4").show(),  
                $("#div_otros_estados_c4").hide()
            }
            else{

                $("#div_otros_estados_c4").show(),
                $("#otros_estados_c4").show(),
                $("#div_estado_c4").hide(),
                $("#div_mun_c4").hide()  
            }
            $('#c4_edo').val(res.id_estado);
            setTimeout(function () {
                $('#c4_edo').val(res.id_estado);
            }, 500);
            if (res.id_estado == '30') {
                $("#c4_mun").show(400),
                $("#c4_municipio").show(400),
                $("#c4_mun_edo").val("")
            }
            else {
                $("#c4_mun_edo").show(200),
                $("#c4_mun").hide()
            }
            $('#otros_estados_c4').val(res.c4_otros_estados);
            $('#c4_mun').val(res.c4_mun);
            $('#c4_mun_edo').val(res.c4_mun_edo);
            $('#c4_dirigido').val(res.c4_dirigido);
            $('#c4_dg').val(res.c4_dg);
            $('#c4_exp_folio').val(res.c4_exp_folio);
            $('#c4_estatus_caso').val(res.c4_estatus_caso);
            $('#modal_c4').modal('show');
        });
        $.post("../controllers/fun_casos_c4.php", { func: 'fn_obtener_desc_caso_c4', id: id, fol_c4: fol_c4 }, function (res) {
            $('#id_desc_caso').val(id);
            $('#c4_lugar_hechos').val(res.c4_lugar_hechos);
            $('#c4_des_hechos').val(res.c4_des_hechos);
            $('#c4_observaciones').val(res.c4_observaciones);


        });
        fn_listar_pro_res_c4(fol_c4);
        fn_listar_victimas_c4(fol_c4);

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
    else if (origen == 4) {//Editar Reportante c4
        $('#modal_c4').modal('hide');
        $('#tit_mod_reportante_c4').html('Editar Reportante');

        $('#modal_reportante_c4').modal({ backdrop: 'static', keyboard: false });
        $('#modal_reportante_c4').modal('show');
        $.post("../controllers/fun_casos_c4.php", { func: 'fn_obtener_datos_reportantes_c4', id: id, fol_c4: fol_c4 }, function (res) {
            $('#id_reportante_c4_edit').val(id);
            $('#can_inst_rep_c4_edit').val(res.c4_inst_reportante);
            $('#can_nom_rep_c4_edit').val(res.c4_nom_reportante);

        });
    }
    else if (origen == 5) {// Editar Probable Responsable c4
        $('#modal_c4').modal('hide');
        $('#tit_mod_pro_res_c4').html('Editar Probable Responsable');
        $('#modal_pro_resp_c4').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pro_resp_c4').modal('show');
        $.post("../controllers/fun_casos_c4.php", { func: 'fn_obtener_datos_pro_res_c4', id: id, fol_c4: fol_c4 }, function (res) {
            $('#id_pro_responsable_edit').val(id);
            $('#c4_edad_responsable_edit').val(res.c4_edad_responsable);
            $('#c4_nom_responsable_edit').val(res.c4_nom_responsable);
            setTimeout(function () {
                $('#c4_parentesco_edit').val(res.c4_parentesco);
            }, 500);
        });
    }
    else if (origen == 6) {// Editar Victima c4
        $('#modal_c4').modal('hide');
        $('#tit_mod_victima_c4').html('Editar Victima');
        $('#modal_victima_c4').modal({ backdrop: 'static', keyboard: false });
        $('#modal_victima_c4').modal('show');
        $.post("../controllers/fun_casos_c4.php", { func: 'fn_obtener_datos_victimas_c4', id: id, fol_c4: fol_c4 }, function (res) {
            $('#id_c4_victima_edit').val(id);
            $('#c4_edad_victima_edit').val(res.c4_edad_victima);
            $('#c4_nom_victima_edit').val(res.c4_nom_victima);
            $('#c4_num_delitos_edit').val(res.c4_num_delitos);
            $('#id_c4_del_victima_edit').val(res.id_c4_delito_victima);
            $('#c4_delito_edit').val(res.c4_delito);
            setTimeout(function () {
                $('#c4_delito_edit').val(res.c4_delito);
            }, 500);
            $('#id_c4_der_victima_edit').val(res.id_c4_derecho);
            $('#c4_der_vul_vic_edit').val(res.c4_der_vul_victima);
            setTimeout(function () {
                $('#c4_der_vul_vic_edit').val(res.c4_der_vul_victima);
            }, 500);
            $('#c4_per_tercera_edad_edit').val(res.c4_per_tercera_edad);
            $('#c4_per_violencia_edit').val(res.c4_per_violencia);
            $('#c4_per_discapacidad_edit').val(res.c4_per_discapacidad);
            $('#c4_per_indigena_edit').val(res.c4_per_indigena);
            $('#c4_per_transgenero_edit').val(res.c4_per_transgenero);
            res.c4_per_tercera_edad == 1 ? $('#c4_per_tercera_edad_edit').prop('checked', true) : $('#c4_per_tercera_edad_edit').prop('checked', false);
            res.c4_per_indigena == 1 ? $('#c4_per_indigena_edit').prop('checked', true) : $('#c4_per_indigena_edit').prop('checked', false);
            res.c4_per_transgenero == 1 ? $('#c4_per_transgenero_edit').prop('checked', true) : $('#c4_per_transgenero_edit').prop('checked', false);
            res.c4_per_discapacidad == 1 ? $('#c4_per_discapacidad_edit').prop('checked', true) : $('#c4_per_discapacidad_edit').prop('checked', false);
            res.c4_per_violencia == 1 ? $('#c4_per_violencia_edit').prop('checked', true) : $('#c4_per_violencia_edit').prop('checked', false);
            $('#c4_sexo_victima_edit').val(res.c4_sexo_victima);
            switch (res.c4_sexo_victima) {
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

function fun_agregar_caso_c4() {
    hoy = $('#hoy').val();
    id = $('#id_caso').val();
    c4_folio = $.trim($('#c4_folio').val());
    c4_numero = $.trim($('#c4_numero').val());
    c4_no_oficio = $.trim($('#c4_no_oficio').val());
    c4_ruta_sol_oficio = $.trim($('#c4_ruta_sol_oficio').val());
    c4_fecha_inicio = $.trim($('#c4_fecha_inicio').val());
    c4_pais = $.trim($('#c4_pais').val());
    otros_estados_c4 = $.trim($('#otros_estados_c4').val());
    c4_edo = $.trim($('#c4_edo').val());
    c4_mun = $.trim($('#c4_mun').val());
    c4_mun_edo = $.trim($('#c4_mun_edo').val());
    c4_dirigido = $.trim($('#c4_dirigido').val());
    c4_dg = $.trim($('#c4_dg').val());
    file0 = document.getElementById('c4_ruta_sol_oficio');
    file = file0.files[0];
    id_caso = $('#id_desc_caso').val();    
    c4_ruta_sol_oficio_edit = $.trim($('#c4_ruta_sol_oficio_edit').val());    
    c4_lugar_hechos = $.trim($('#c4_lugar_hechos').val());
    c4_des_hechos = $.trim($('#c4_des_hechos').val());
    c4_observaciones = $.trim($('#c4_observaciones').val());

    if (typeof (file) != "undefined")//Si trae un archivo
    {
        if (file.size > 500000) {
            toastr.options.timeOut = 2500;
            toastr.warning('¡El archivo pesa más de 500 kb deberás reducirlo!');
            $('#c4_ruta_sol_oficio').focus();
            return false;
        }

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
   

    else if (c4_fecha_inicio > hoy) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡La fecha no puede ser mayor al día de hoy!');
        $('#c4_fecha_inicio').focus();
        return false;
    }
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
    var data = new FormData();
    data.append('func', 'fn_guardar_caso_c4');
    data.append('id', id);
    data.append('c4_folio', c4_folio);
    data.append('c4_numero', c4_numero);
    data.append('c4_no_oficio', c4_no_oficio);
    data.append('c4_ruta_sol_oficio', c4_ruta_sol_oficio);
    data.append('c4_fecha_inicio', c4_fecha_inicio);
    data.append('c4_pais', c4_pais);
    data.append('otros_estados_c4', otros_estados_c4);
    data.append('c4_edo', c4_edo);
    data.append('c4_mun', c4_mun);
    data.append('c4_mun_edo', c4_mun_edo);
    data.append('c4_dirigido', c4_dirigido);
    data.append('c4_dg', c4_dg);
    data.append('archivo', file);
    data.append('id_caso', id_caso);
    data.append('c4_ruta_sol_oficio_edit', c4_ruta_sol_oficio_edit);
    data.append('c4_lugar_hechos', c4_lugar_hechos);
    data.append('c4_des_hechos', c4_des_hechos);
    data.append('c4_observaciones', c4_observaciones);

    $.ajax({
        url: "../controllers/fun_casos_c4.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        cache: false
    }).done(function (result) {
        console.log(result);
        if (result.estatus === "ok expediente registrado") {
            Swal.fire({ icon: 'success', title: 'Expediente guardado correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_c4').modal('hide');
            fn_listar_casos_c4();


        }
        else if (result.estatus === "editado") {
            Swal.fire({ icon: 'success', title: 'Expediente Editado correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_c4').modal('hide');
            fn_listar_casos_c4();

        }
        else {

            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modalCanalizacion').modal('hide');


            return false;
        }

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

function fn_listar_pro_res_c4(fol_c4) {
    $("#lista_bd_probable_res").html(cargando);
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_lista_pro_res_c4', fol_c4: fol_c4 }, function (data) {
        $('#lista_bd_probable_res').html(data);
        $('#lista_bd_dat_pro_rep_c4').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function fn_listar_victimas_c4(fol_c4) {
    $("#lista_bd_victimas").html(cargando);
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_lista_victimas_c4', fol_c4: fol_c4 }, function (data) {
        $('#lista_bd_victimas').html(data);
        $('#lista_bd_victimas_c4').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
    });
}
function fn_eliminar_caso_c4(id, c4_no_oficio) {
    swal.fire({
        title: '¿Estás seguro?',
        input: 'text',
        text: c4_no_oficio + ' será eliminado',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!',
        cancelButtonText: 'Cancelar',
        inputValidator: desc_eliminar_c4 => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!desc_eliminar_c4) {
                return "Por favor escribe la Descripción";
            } else {
                return undefined;
            }
        }
    }).then((result) => {
        if (result.value) {
            let desc_eliminar_c4 = result.value;

            datos = { func: 'fn_eliminar_caso_c4', id: id, desc_eliminar_c4: desc_eliminar_c4 };

            $.ajax({
                url: "../controllers/fun_casos_c4.php",
                type: "POST",
                data: datos
            }).done(function (res) {

                if (res.estatus == 'ok') {
                    Swal.fire({ icon: 'success', title: 'Eliminado correctamente', showConfirmButton: false, timer: 1500 });
                    fn_listar_casos_c4();

                }
                else {
                    Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
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
    id = $('#id_reportante_c4').val();
    var data = new FormData();
    data.append('func', 'fn_guardar_reportante_c4');
    data.append('id', id);

    $.ajax({
        url: "../controllers/fun_casos_c4.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        cache: false
    }).done(function (res) {

        if (res.estatus === "ok") {
            //Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
            fun_agregar_pro_resp_c4();

        }
        else {
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showCnfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modal_c4').modal('hide');


            return false;
        }


    })

}
function fun_editar_reportante_c4() {
    id = $('#id_reportante_c4_edit').val();
    can_inst_rep_c4_edit = $.trim($('#can_inst_rep_c4_edit').val());
    can_nom_rep_c4_edit = $.trim($('#can_nom_rep_c4_edit').val());

    var data = new FormData();
    data.append('func', 'fn_guardar_reportante_c4');
    data.append('id', id);
    data.append('can_inst_rep_c4_edit', can_inst_rep_c4_edit);
    data.append('can_nom_rep_c4_edit', can_nom_rep_c4_edit);

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
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_reportante_c4').modal('hide');

            $("#actualizar_canalizaciones").click();

        }
        else {
            Swal.fire({ icon: 'warning', title: 'Datos no guardados correctamente', showConfirmButton: false, timer: 1500 });
        }
    })
}
//Probable Responsable c4
function fun_agregar_pro_resp_c4() {
    id = $('#id_pro_responsable').val();

    var data = new FormData();
    data.append('func', 'fn_guardar_prob_respo_c4');
    data.append('id', id);

    $.ajax({
        url: "../controllers/fun_casos_c4.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        cache: false
    }).done(function (res) {

        if (res.estatus === "ok") {
            fun_agregar_victima_c4();
        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modal_c4').modal('hide');


            return false;
        }


    })

}
function fun_editar_pro_res_c4() {
    id = $('#id_pro_responsable_edit').val();
    c4_edad_responsable_edit = $.trim($('#c4_edad_responsable_edit').val());
    c4_nom_responsable_edit = $.trim($('#c4_nom_responsable_edit').val());
    c4_parentesco_edit = $.trim($('#c4_parentesco_edit').val());

    var data = new FormData();
    data.append('func', 'fn_guardar_prob_respo_c4');
    data.append('id', id);
    data.append('c4_edad_responsable_edit', c4_edad_responsable_edit);
    data.append('c4_nom_responsable_edit', c4_nom_responsable_edit);
    data.append('c4_parentesco_edit', c4_parentesco_edit);


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
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_pro_resp_c4').modal('hide');

            $("#actualizar_canalizaciones").click();

        }
        else {
            Swal.fire({ icon: 'warning', title: 'Datos no guardados correctamente', showConfirmButton: false, timer: 1500 });
        }
    })
}
//Agregar Caso
// function fun_agregar_des_caso_c4() {
//     id = $('#id_desc_caso').val();
//     c4_lugar_hechos = $.trim($('#c4_lugar_hechos').val());
//     c4_des_hechos = $.trim($('#c4_des_hechos').val());
//     c4_observaciones = $.trim($('#c4_observaciones').val());

//     if (c4_lugar_hechos == '') {
//         toastr.options.timeOut = 2500;
//         toastr.warning('¡Ingresa Lugar de los hechos!');
//         $('#c4_lugar_hechos').focus();
//         return false;
//     }
//     else if (c4_des_hechos == '') {
//         toastr.options.timeOut = 2500;
//         toastr.warning('¡Ingresa lugar de los hechos!');
//         $('#c4_des_hechos').focus();
//         return false;
//     }


//     var data = new FormData();
//     data.append('func', 'fn_guardar_desc_caso_c4');
//     data.append('c4_lugar_hechos', c4_lugar_hechos);
//     data.append('c4_des_hechos', c4_des_hechos);
//     data.append('c4_observaciones', c4_observaciones);
//     data.append('id', id);


//     $.ajax({
//         url: "../controllers/fun_casos_c4.php",
//         type: "POST",
//         data: data,
//         contentType: false,
//         processData: false,
//         cache: false
//     }).done(function (res) {

//         if (res.estatus === "ok") {
//             fun_agregar_reportante_c4();

//         }
//         else {
//             Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
//             $('#modal_c4').modal('hide');


//             return false;
//         }


//     })

// }
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
    id = $('#id_victima_c4').val();
    var data = new FormData();
    data.append('func', 'fn_guardar_victima_c4');
    data.append('id', id);
    $.ajax({
        url: "../controllers/fun_casos_c4.php",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        cache: false
    }).done(function (res) {

        if (res.estatus === "ok") {
            Swal.fire({ icon: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_c4').modal('hide');
            fn_listar_casos_c4();

        }
        else {
            Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
            $('#btn_create_can').prop('disabled', false);
            $('#modal_c4').modal('hide');
            return false;
        }

    })

}
function fun_editar_victima_c4() {
    id = $('#id_c4_victima_edit').val();
    c4_edad_victima_edit = $.trim($('#c4_edad_victima_edit').val());
    c4_nom_victima_edit = $.trim($('#c4_nom_victima_edit').val());
    c4_num_delitos_edit = $.trim($('#c4_num_delitos_edit').val());
    id_c4_del_victima_edit = $.trim($('#id_c4_del_victima_edit').val());
    c4_delito_edit = $.trim($('#c4_delito_edit').val());
    id_c4_der_victima_edit = $.trim($('#id_c4_der_victima_edit').val());
    c4_der_vul_vic_edit = $.trim($('#c4_der_vul_vic_edit').val());
    c4_per_tercera_edad_edit = $.trim($('#c4_per_tercera_edad_edit').val());
    c4_per_indigena_edit = $.trim($('#c4_per_indigena_edit').val());
    c4_per_transgenero_edit = $.trim($('#c4_per_transgenero_edit').val());
    c4_per_discapacidad_edit = $.trim($('#c4_per_discapacidad_edit').val());
    c4_per_violencia_edit = $.trim($('#c4_per_violencia_edit').val());
    c4_sexo_victima_edit = document.querySelector('input[name="c4_sexo_victima_edit"]:checked').value;

    var data = new FormData();
    data.append('func', 'fn_guardar_victima_c4');
    data.append('id', id);
    data.append('c4_edad_victima_edit', c4_edad_victima_edit);
    data.append('c4_nom_victima_edit', c4_nom_victima_edit);
    data.append('c4_num_delitos_edit', c4_num_delitos_edit);
    data.append('id_c4_del_victima_edit', id_c4_del_victima_edit);
    data.append('c4_delito_edit', c4_delito_edit);
    data.append('id_c4_der_victima_edit', id_c4_der_victima_edit);
    data.append('c4_der_vul_vic_edit', c4_der_vul_vic_edit);
    data.append('c4_per_tercera_edad_edit', c4_per_tercera_edad_edit);
    data.append('c4_per_indigena_edit', c4_per_indigena_edit);
    data.append('c4_per_transgenero_edit', c4_per_transgenero_edit);
    data.append('c4_per_discapacidad_edit', c4_per_discapacidad_edit);
    data.append('c4_per_violencia_edit', c4_per_violencia_edit);
    data.append('c4_sexo_victima_edit', c4_sexo_victima_edit);

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
            Swal.fire({ icon: 'success', title: 'Datos Actualizados correctamente', showConfirmButton: false, timer: 1500 });
            $('#modal_reportante_c4').modal('hide');

            $("#actualizar_canalizaciones").click();

        }
        else {
            Swal.fire({ icon: 'warning', title: 'Datos no guardados correctamente', showConfirmButton: false, timer: 1500 });
        }
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
                    Swal.fire({ icon: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#crearAvance').modal('hide');
                    fn_listar_avances();


                }
                else {
                    Swal.fire({ icon: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showCnfirmButton: false, timer: 1500 });
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
        $('#c4_delito_edit').html(data);

    });
}
function fn_carga_parentescos(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_parentescos' }, function (data) {
        $('#' + combo).html(data);
        // $('#c4_parentesco_edit'+combo).html(data);

    });
}

function fn_combo_parentescos(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_parentescos' }, function (data) {
        $('#' + combo).html(data);
    });
}
function fn_carga_derechos(combo) {
    $.post("../controllers/fun_casos_c4.php", { func: 'fn_carga_derechos' }, function (data) {
        $('#' + combo).html(data);
        $('#c4_der_vul_vic_edit').html(data);

    });
}
