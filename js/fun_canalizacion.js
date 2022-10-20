var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

$(document).ready(function () {
    $("#can_estado").change(function () {
        if ($(this).val() == "1")
            $("#can_municipio").show(),
                $("#can_mun_edo").hide();

        else
            $("#can_municipio").hide(),
                $("#can_mun_edo").show();

    });
});
function mod_canalizacion(origen, id) {
    $('#tit_mod_add_can').html('Crear Canalización');
    fn_carga_municipios('can_municipio');
    fn_carga_estados('can_estado');

    fn_carga_delitos('cat_delitos');

    if (origen == 1) {
        $('#id_can_exp').val(0);
        $('#can_via_rec').val("");
        $('#can_ruta_sol_oficio').val("");
        $('#can_no_oficio').val("");
        $('#can_fecha_inicio').val("");
        $('#can_estado').val("");
        $('#can_municipio').val("");
        $('#can_mun_edo').val("");
        $('#can_via_rec').prop('checked', false);

        $('#modalCanalizacion').modal('show');

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
function fn_listar_canalizaciones() {
    $("#ver_lista_canalizaciones").html(cargando);
    $.post("../controllers/fun_canalizacion.php", { func: 'fn_listar_canalizaciones' }, function (data) {
        $('#ver_lista_canalizaciones').html(data);
        $('#tbl_can').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: false,
        });
    });
}
function fun_agregar_reportante(){
    can_inst_rep = $.trim($('#can_inst_rep').val());
    can_nom_rep = $.trim($('#can_nom_rep').val());
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
            data.append('func','fn_guardar_reportante');
            data.append('can_inst_rep',can_inst_rep);
            data.append('can_nom_rep',can_nom_rep);
           
            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: data,
                contentType:false,
                processData:false,
                cache:false
            }).done(function (res) {
                console.log(res);
                var result = JSON.parse(res);
                console.log(result);
                if (result.estatus==="ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#btn_canalizacion').prop('disabled', false);
                    $('#modalCanalizacion').modal('hide');
                

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
function fun_agregarCanalizacion() {

    can_no_oficio = $.trim($('#can_no_oficio').val());
    can_ruta = $.trim($('#can_ruta_sol_oficio').val());
    can_fecha_inicio = $.trim($('#can_fecha_inicio').val());
    can_estado = $.trim($('#can_estado').val());
    can_municipio = $.trim($('#can_municipio').val());
    can_mun_edo = $.trim($('#can_mun_edo').val());
    file0 = document.getElementById('can_ruta_sol_oficio');
    file = file0.files[0];
    can_via_rec = document.querySelector('input[name="can_via_rec"]:checked').value;
    if (can_no_oficio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar el numero de oficio!');
        $('#can_no_oficio').focus();
        return false;
    }
    else if (can_fecha_inicio == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione una Fecha!');
        $('#can_fecha_inicio').focus();
        return false;
    }
    else if (can_estado == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione un Estado!');
        $('#can_estado').focus();
        return false;
    }
    else if (typeof (file) != "undefined")//Si trae un archivo
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

    swal({
        title: '¿Estás seguro?',
        html: 'Los datos de la canalización: <br>' + can_no_oficio + ' serán almacenados',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var data = new FormData();
            data.append('func','fn_guardar_canalizacion');
            data.append('can_ruta_sol_oficio',can_ruta_sol_oficio);
            data.append('can_no_oficio',can_no_oficio);
            data.append('can_fecha_inicio',can_fecha_inicio);
            data.append('can_estado',can_estado);
            data.append('can_municipio',can_municipio);
            data.append('can_mun_edo',can_mun_edo);
            data.append('can_via_rec',can_via_rec);
            data.append('archivo',file);
            $.ajax({
                url: "../controllers/fun_canalizacion.php",
                type: "POST",
                data: data,
                contentType:false,
                processData:false,
                cache:false
            }).done(function (res) {
                console.log(res);
                var result = JSON.parse(res);
                console.log(result);
                if (result.estatus==="ok") {
                    Swal({ type: 'success', title: 'Datos almacenados correctamente', showConfirmButton: false, timer: 1500 });
                    $('#btn_canalizacion').prop('disabled', false);  
                    fun_agregar_reportante();
                

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
function fun_guardar_sol() {
    can_nom = $.trim($('#can_nom_sol').val());
    can_tipo = $.trim($('#can_tipo_delito').val());
    der_vul = $.trim($('#der_vul').val());
    can_nom = $.trim($('#can_nom_vic').val());
    can_gen = $.trim($('#can_gen_vic').val());
    can_des_caso = $.trim($('#can_des_caso').val());
    can_ins = $.trim($('#can_inst_sol').val());

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
            datos = { func: 'fn_eliminar_canalizacion', id: id, can_no_oficio: can_no_oficio };

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

//FUNCIONES CATALOGOS
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