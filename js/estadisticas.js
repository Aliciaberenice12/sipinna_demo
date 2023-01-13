$(document).ready(function () {

    fn_listar_consulta_sexo_municipio();
});
function mensaje(origen){
    if(origen==1){
        toastr.options.timeOut = 2500;
        toastr.warning('¡Aun en proceso!');
        return false;
    }
    else{
        
    }
}
function consulta() {
    id_reporte = $('#id_reporte').val();
    desde_fecha = $.trim($('#desde_fecha').val());
    hasta_fecha = $.trim($('#hasta_fecha').val());

    if (id_reporte == '0') {
        toastr.options.timeOut = 2500;
        toastr.warning('Seleccione Reporte a Consultar!');
        $('#id_reporte').focus();
        return false;
    }
    else if (desde_fecha == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione Rango de fecha de inicio!');
        $('#desde_fecha').focus();
        return false;
    }
    else if (hasta_fecha == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione Rango de fecha de Final!');
        $('#hasta_fecha').focus();
        return false;
    }

    var data = new FormData();
    data.append('func', 'fn_obtener_reporte');
    data.append('id_reporte', id_reporte);
    data.append('desde_fecha', desde_fecha);
    data.append('hasta_fecha', hasta_fecha);

    $.ajax({
        url: "../controllers/estadisticas.php",
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
       




function fn_listar_consulta_sexo_municipio() {
    $("#consulta_sexo_municipio").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fn_listar_consulta_sexo_municipio' }, function (data) {
        $('#consulta_sexo_municipio').html(data);
        $('#tbl_con_sexo').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
        fun_reportante();//funcion para Eliminar variables de session array 
    });
}