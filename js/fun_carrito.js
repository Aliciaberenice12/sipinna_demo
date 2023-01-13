
function carrito_victima_c4(origen, evento, id) {
    if (origen == 1) {
        if (evento == 1) //Agregar
        {
            can_edad_vic = $.trim($('#can_edad_vic').val());
            can_nom_vic = $.trim($('#can_nom_vic').val());
            can_delito = $.trim($('#can_delito').val());
            can_delito = $('#can_delito').val();
            combo = document.getElementById("can_delito");
            // txt_delito = combo.options[combo.selectedIndex].text;
            // alert(txt_delito+'--'+can_delito);
            // return false;
            can_der_vul_vic = $.trim($('#can_der_vul_vic').val());
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
            can_delito = '';
            can_der_vul_vic = '';
            can_per_tercera_edad = '';
            can_per_violencia = '';
            can_per_discapacidad = '';
            can_per_indigena = '';
            can_per_transgenero = '';
            can_sexo_victima = '';


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
            $('#can_delito').val('');
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





        });
    }
    else if (origen == 2) {
        if (evento == 1) //Agregar
        {
            c4_edad_vic = $.trim($('#c4_edad_vic').val());
            c4_edad_ms_vic = $.trim($('#c4_edad_ms_vic').val());

            c4_nom_vic = $.trim($('#c4_nom_vic').val());
            c4_delitos = $.trim($('#c4_delitos').val());
            c4_num_delitos = $.trim($('#c4_num_delitos').val());
            c4_der_vul = $.trim($('#c4_der_vul').val());
            c4_per_tercera_edad = $.trim($('#c4_per_tercera_edad').val());
            c4_per_violencia = $.trim($('#c4_per_violencia').val());
            c4_per_discapacidad = $.trim($('#c4_per_discapacidad').val());
            c4_per_indigena = $.trim($('#c4_per_indigena').val());
            c4_per_transgenero = $.trim($('#c4_per_transgenero').val());
            c4_sexo_victima = document.querySelector('input[name="c4_sexo_victima"]:checked').value;
            if(c4_edad_vic === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes ingresar el edad de la Victima!');
                $('#c4_edad_vic').focus();
                return false;
            }
            if(c4_edad_ms_vic === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes Seleccionar!');
                $('#c4_edad_ms_vic').focus();
                return false;
            }
            if(c4_nom_vic === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes ingresar el nombre de la Victima!');
                $('#c4_nom_vic').focus();
                return false;
            }
            if(c4_nom_vic === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes ingresar el nombre de la Victima!');
                $('#c4_nom_vic').focus();
                return false;
            }
            if(c4_delitos === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes Seleccionar el Delito!');
                $('#c4_delitos').focus();
                return false;
            }
            if(c4_num_delitos === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes ingresar el numero de los Delito!');
                $('#c4_num_delitos').focus();
                return false;
            }
            if(c4_num_delitos === ''){
                toastr.options.timeOut = 2500;
                toastr.warning('Debes ingresar el numero de los Delito!');
                $('#c4_num_delitos').focus();
                return false;
            }
            if ($('#c4_per_tercera_edad').prop('checked'))
                c4_per_tercera_edad = 1;
            else
                c4_per_tercera_edad = '';

            if ($('#c4_per_violencia').prop('checked'))
                c4_per_violencia = 1;
            else
                c4_per_violencia = '';

            if ($('#c4_per_discapacidad').prop('checked'))
                c4_per_discapacidad = 1;
            else
                c4_per_discapacidad = '';

            if ($('#c4_per_indigena').prop('checked'))
                c4_per_indigena = 1;
            else
                c4_per_indigena ='';

            if ($('#c4_per_transgenero').prop('checked'))
                c4_per_transgenero = 1;
            else
                c4_per_transgenero = '';
        }
        else {
            c4_edad_vic = '';
            c4_edad_ms_vic='';
            c4_nom_vic = '';
            c4_delitos = '';
            c4_num_delitos = '';
            c4_der_vul = '';
            c4_per_tercera_edad = '';
            c4_per_violencia = '';
            c4_per_discapacidad = '';
            c4_per_indigena = '';
            c4_per_transgenero = '';
            c4_sexo_victima = '';
        }
        $.post("../controllers/fun_casos_c4.php", {
            func: 'carrito_victima_c4', evento: evento, id: id, c4_edad_vic: c4_edad_vic,c4_edad_ms_vic:c4_edad_ms_vic,
            c4_nom_vic: c4_nom_vic, c4_delitos: c4_delitos, c4_num_delitos: c4_num_delitos, c4_der_vul: c4_der_vul,
            c4_per_tercera_edad: c4_per_tercera_edad, c4_per_violencia: c4_per_violencia, c4_per_discapacidad: c4_per_discapacidad,
            c4_per_indigena: c4_per_indigena, c4_per_transgenero: c4_per_transgenero, c4_sexo_victima: c4_sexo_victima
        }, function (data) {
            $('#lista_dat_vic_c4').html(data);
            $('#c4_edad_vic').val('');
            $('#c4_edad_ms_vic').val('');            
            $('#c4_nom_vic').val('');
            $('#c4_delitos').val('0');
            $('#c4_num_delitos').val('');
            $('#c4_der_vul').val('0');
            $('#c4_per_tercera_edad').prop('checked', false).removeAttr('checked');
            $('#c4_per_violencia').prop('checked', false).removeAttr('checked');
            $('#c4_per_discapacidad').prop('checked', false).removeAttr('checked');
            $('#can_per_discapacidad').prop('checked', false).removeAttr('checked');
            $('#c4_per_indigena').prop('checked', false).removeAttr('checked');
            $('#c4_per_transgenero').prop('checked', false).removeAttr('checked');
            $('#masculino').prop('checked', false).removeAttr('checked');
            $('#femenino').prop('checked', false).removeAttr('checked');
            $('#n_i').prop('checked', false).removeAttr('checked');

        });
    }

}//Cierre de funcion carrito victima

function carrito_probable_resp(evento, id) {

    if (evento == 1) //Agregar
    {
        c4_nom_responsable = $.trim($('#c4_nom_responsable').val());
        c4_edad_responsable = $.trim($('#c4_edad_responsable').val());
        c4_parentesco = $.trim($('#c4_parentesco').val());
        if(c4_nom_responsable === ''){
            toastr.options.timeOut = 2500;
            toastr.warning('Debes ingresar el nombre del Probable Responsable!');
            $('#c4_nom_responsable').focus();
            return false;
        }
        if(c4_edad_responsable === ''){
            toastr.options.timeOut = 2500;
            toastr.warning('Debes ingresar el Edad del Probable Responsable!');
            $('#c4_edad_responsable').focus();
            return false;
        }
        if(c4_parentesco === ''){
            toastr.options.timeOut = 2500;
            toastr.warning('Debes Seleccionar Parentesco');
            $('#c4_parentesco').focus();
            return false;
        }
        

    }
    else {
        c4_nom_responsable = '';
        c4_edad_responsable = '';
        c4_parentesco = '0';

    }

    $.post("../controllers/fun_casos_c4.php", { func: 'carrito_probable_resp_c4', evento: evento, id: id,
        c4_nom_responsable: c4_nom_responsable, c4_edad_responsable: c4_edad_responsable ,
        c4_parentesco: c4_parentesco}, function (data) {
        $('#lista_probable_res').html(data);
        $('#c4_nom_responsable').val('');
        $('#c4_edad_responsable').val('');
        $('#c4_parentesco').val('0');

    });
}

