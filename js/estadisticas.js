var cargando =
    '<div class="row"><div class="col-12" align="center"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div> Cargando...</div></div>';

$(document).ready(function () {

    $("#div_reportes_canalizacion").hide();
    $("#div_reportes_casos_c4").hide();
    $("#div_reportes_general").hide();

    $("#gen_reporte").change(function () {
        if ($(this).val() == "1") {
           
            $("#id_reporte").change(function () {
                if ($(this).val() == "1") {
                    $("#div_reportes_canalizacion").show(),
                    $("#div_reportes_casos_c4").hide(),
                    $("#div_consulta_general").hide(),
                    $("#div_consulta_mes_num_casos_can").hide(),
                    $("#div_cunsulta_genero_can").hide(),
                    $("#div_consulta_edad_can").hide(),
                    $("#div_consulta_casos_por_estado_dif_can").show(),                    
                    $("#div_consulta_casos_por_pais_dif_can").show(),
                    $("#div_consulta_casos_por_municipio_can").show()
     
                    
                    
                }
                else if ($(this).val() == "2") {
                    $("#div_reportes_canalizacion").show(),
                    $("#div_reportes_casos_c4").hide(),
                    $("#div_consulta_general").show(),
                    $("#div_consulta_mes_num_casos_can").show(),
                    $("#div_cunsulta_genero_can").show(),
                    $("#div_consulta_edad_can").show(),
                    $("#div_consulta_casos_por_municipio_can").hide(),
                    $("#div_consulta_casos_por_edo_mun_can").hide(),
                    $("#div_consulta_casos_por_estado_dif_can").hide(),                    
                    $("#div_consulta_casos_por_pais_dif_can").hide()
                  


                }
                else if ($(this).val() == "3") {
                    $("#div_reportes_canalizacion").show(),
                    $("#div_reportes_casos_c4").hide(),
                    $("#div_consulta_general").show(),
                    $("#div_consulta_mes_num_casos_can").show(),
                    $("#div_cunsulta_genero_can").show(),
                    $("#div_consulta_edad_can").show(),
                    $("#div_consulta_casos_por_municipio_can").show(),
                    $("#div_consulta_casos_por_edo_mun_can").show(),
                    $("#div_consulta_casos_por_estado_dif_can").show(),                    
                    $("#div_consulta_casos_por_pais_dif_can").show()
                }
            });
        }
        else if ($(this).val() == "2") {
            $("#id_reporte").change(function () {
                if ($(this).val() == "1") {
                    $("#div_reportes_casos_c4").show(),
                    $("#div_reportes_canalizacion").hide(),
                    $("#div_consulta_mes_num_casos_c4").hide(),
                    $("#div_consulta_genero_c4").hide(),
                    $("#div_consulta_edad_c4").hide(),
                    $("#div_consulta_num_delitos_casos_c4").hide(),
                    $("#div_consulta_casos_por_municipio_c4").show(),
                    $("#div_consulta_casos_por_estado_c4").show(),
                    $("#div_consulta_casos_por_pais_c4").show()

                

                }
                else if($(this).val() == "2"){
                    $("#div_reportes_casos_c4").show(),
                    $("#div_reportes_canalizacion").hide(),
                    $("#div_consulta_mes_num_casos_c4").show(),
                    $("#div_consulta_genero_c4").show(),
                    $("#div_consulta_edad_c4").show(),
                    $("#div_consulta_num_delitos_casos_c4").show(),
                    $("#div_consulta_casos_por_municipio_c4").hide(),
                    $("#div_consulta_casos_por_municipio_c4").hide(),
                    $("#div_consulta_casos_por_estado_c4").hide(),
                    $("#div_consulta_casos_por_pais_c4").hide()

                }
                else if($(this).val() == "3"){
                    $("#div_reportes_casos_c4").show(),
                    $("#div_reportes_canalizacion").hide(),
                    $("#div_consulta_mes_num_casos_c4").show(),
                    $("#div_consulta_genero_c4").show(),
                    $("#div_consulta_edad_c4").show(),
                    $("#div_consulta_num_delitos_casos_c4").show(),
                    $("#div_consulta_casos_por_municipio_c4").show(),
                    $("#div_consulta_casos_por_municipio_c4").show(),
                    $("#div_consulta_casos_por_estado_c4").show(),
                    $("#div_consulta_casos_por_pais_c4").show()

                }
            });
           



        }
        
    });
    
});
function limpiarModal(){
    $('#gen_reporte').val('0'),
    $('#id_reporte').val('0'),
    $('#desde_fecha').val(""),
    $('#hasta_fecha').val("")
}

function consulta() {
    hoy = $('#hoy').val();
    gen_reporte = $.trim($('#gen_reporte').val());
    id_reporte = $.trim($('#id_reporte').val());
    desde_fecha = $.trim($('#desde_fecha').val());
    hasta_fecha = $.trim($('#hasta_fecha').val());
    if (gen_reporte == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('Seleccione Reporte !');
        $('#gen_reporte').focus();
        return false;
    }
    else if (id_reporte == '') {
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
    else if (desde_fecha > hoy) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡La fecha no puede ser mayor al día de hoy!');
        $('#desde_fecha').focus();
        return false;
    }
    else if (hasta_fecha > hoy) {
        toastr.options.timeOut = 2500;
        toastr.warning('¡La fecha no puede ser mayor al día de hoy!');
        $('#hasta_fecha').focus();
        return false;
    }

    var data = new FormData();
    data.append('func', 'fn_obtener_reporte');
    data.append('gen_reporte', gen_reporte);
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

        if (res.estatus === "consul_mun") {
            fn_listar_municipio_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_numero_casos(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edo_mun_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha), 
            fn_listar_pais_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha)
            // limpiarModal()
        }
        else if (res.estatus === "consul_edades") {
            fn_listar_mes_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_numero_casos(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_gen_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_mayores_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_per_vul_can(id_reporte,desde_fecha,hasta_fecha)
            // limpiarModal()
           
       
        }
        else if (res.estatus === "consul_mes") {
            fn_listar_numero_casos(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_mes_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_municipio_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_gen_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_mayores_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_per_vul_can(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edo_mun_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha), 
            fn_listar_pais_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha)
            // limpiarModal()
        }
        else if (res.estatus === "consul_mun_c4") {
            fn_listar_numero_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_municipio_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_estado_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_pais_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha)
            

            // limpiarModal()
        }
        else if (res.estatus === "consul_genero_c4") {
            fn_listar_numero_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_mes_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_gen_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_mayores_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_per_vul_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_delitos_c4(id_reporte,desde_fecha,hasta_fecha)
            fn_carga_delitos()
            // limpiarModal()
        }
        else if (res.estatus === "consul_mes_c4") {
            fn_listar_numero_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_mes_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_gen_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_edad_mayores_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_per_vul_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_listar_delitos_c4(id_reporte,desde_fecha,hasta_fecha),
            fn_carga_delitos(),
            fn_listar_municipio_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha)
            // limpiarModal()
        }
        
       
    })
}

function modal_pdf(gen_reporte,id_reporte,desde,hasta){
 if(gen_reporte =='1'){
    if(id_reporte=='1'){
        $('#tit_modal_pdf').html('Reporte Municipio Canalización');
        $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pdf').modal('show');
        ref_pdf = '<iframe  src="../vistas/reportes/canalizacion/reporteMunicipios.php?desde='+desde+'&hasta='+hasta+'" width="100%" height="600px"></iframe>';
        $("#reporte").html(ref_pdf);
    }
    else if(id_reporte=='2'){
        $('#tit_modal_pdf').html('Reporte General de Canalización(sin municipio)');
        $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pdf').modal('show');
        fn_carga_delitos(),
        ref_pdf = '<iframe  src="../vistas/reportes/canalizacion/reporteGeneral.php?desde='+desde+'&hasta='+hasta+'" width="100%" height="600px"></iframe>';
        $("#reporte").html(ref_pdf);
    }
    else if(id_reporte=='3'){
        $('#tit_modal_pdf').html('Reporte Total de Canalización');
        $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pdf').modal('show');
        ref_pdf = '<iframe  src="../vistas/reportes/canalizacion/reporteTotal.php?desde='+desde+'&hasta='+hasta+'" width="100%" height="600px"></iframe>';
        $("#reporte").html(ref_pdf);
    }
  
  
 }  
 else if(gen_reporte =='2'){
    if(id_reporte=='1'){
        $('#tit_modal_pdf').html('Reporte Municipio Casos C4');
        $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pdf').modal('show');
        ref_pdf = '<iframe  src="../vistas/reportes/casos_c4/reporteMunicipios.php?desde='+desde+'&hasta='+hasta+'" width="100%" height="600px"></iframe>';
        $("#reporte").html(ref_pdf);
    }
    else if(id_reporte=='2'){
        $('#tit_modal_pdf').html('Reporte General Sin Municipio Casos C4');
        $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pdf').modal('show');
        ref_pdf = '<iframe  src="../vistas/reportes/casos_c4/reporteGeneral.php?desde='+desde+'&hasta='+hasta+'" width="100%" height="600px"></iframe>';
        $("#reporte").html(ref_pdf);
    }
    else if(id_reporte=='3'){
        $('#tit_modal_pdf').html('Reporte Total Casos C4');
        $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
        $('#modal_pdf').modal('show');
        ref_pdf = '<iframe  src="../vistas/reportes/casos_c4/reporteTotal.php?desde='+desde+'&hasta='+hasta+'" width="100%" height="600px"></iframe>';
        $("#reporte").html(ref_pdf);
    }

 } 
}
function fn_carga_delitos() {
    $.post("../controllers/estadisticas.php", { func: 'fn_carga_delitos' }, function (data) {

        
    });
}
function fn_listar_numero_casos(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#numero_casos").html(cargando);
    $.post("../controllers/estadisticas.php", { func:'fun_listar_numero_casos',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#numero_casos').html(data); 
    });
}
function fn_listar_numero_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#numero_casos_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func:'fun_listar_numero_casos_c4',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#numero_casos_c4').html(data); 
    });
}
///Canalización

function fn_listar_consulta_sexo_municipio() {
    $("#consulta_sexo_municipio").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fn_listar_consulta_sexo_municipio' }, function (data) {
        $('#consulta_sexo_municipio').html(data);
        $('#tbl_con_sexo').DataTable({
            language: { "url": "../lib/datatables/Spanish.json" },
            order: [[0, "asc"]],
            searching: true,
        });
        
    });
}
function fn_listar_municipio_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_casos_por_municipio_veracruz_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_mun',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_casos_por_municipio_veracruz_can').html(data);
        
    });
}
function fn_listar_edo_mun_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_casos_por_municipio_edo_mun_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_edo_mun',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_casos_por_municipio_edo_mun_can').html(data);
        
    });
}
function fn_listar_pais_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_casos_por_pais_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_pais_can',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_casos_por_pais_can').html(data);
        
    }); 
}
function fn_listar_mes_can(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_meses_num_casos_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_mes',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_meses_num_casos_can').html(data);
        // $('#tbl_con_sexo').DataTable({
        //     language: { "url": "../lib/datatables/Spanish.json" },
        //     order: [[0, "asc"]],
        //     searching: true,
        // });
        
    });
}
function fn_listar_gen_can(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_genero").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fn_listar_consulta_genero',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_genero').html(data);
        // $('#tbl_con_sexo').DataTable({
        //     language: { "url": "../lib/datatables/Spanish.json" },
        //     order: [[0, "asc"]],
        //     searching: true,
        // });
        
    });
}
function fn_listar_edad_can(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_edad_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_edades',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_edad_can').html(data);
        
        
    });
}
function fn_listar_edad_mayores_can(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_edad_mayores_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_edades_mayores',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_edad_mayores_can').html(data);
        
    });
}
function fn_listar_per_vul_can(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_per_vul_can").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_agresion',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_per_vul_can').html(data);     
    });
}

///Casos c4
function fn_listar_pais_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_casos_por_pais_dif_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_pais_c4',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_casos_por_pais_dif_c4').html(data);        
    });
}
function fn_listar_estado_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_casos_por_edo_dif_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_edo_c4',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_casos_por_edo_dif_c4').html(data);        
    });
}
function fn_listar_municipio_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_casos_por_municipio_veracruz_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_mun_c4',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_casos_por_municipio_veracruz_c4').html(data);
    
        
    });
}
function fn_listar_mes_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_meses_num_casos_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_mes_c4',gen_reporte:gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_meses_num_casos_c4').html(data);
      
    });
}
function fn_listar_gen_c4(gen_reporte,id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_genero_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_gen_c4',gen_reporte,gen_reporte,id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_genero_c4').html(data);
      
        
    });
}
function fn_listar_edad_c4(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_edad_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_edades_c4',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_edad_c4').html(data);
      
    });
}
function fn_listar_edad_mayores_c4(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_edad_mayores_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_edades_mayores_c4',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_edad_mayores_c4').html(data);
      
    });
}
function fn_listar_per_vul_c4(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_suma_datos_per_vul_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_per_vul_c4',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_suma_datos_per_vul_c4').html(data);
       
        
    });
}
function fn_listar_delitos_c4(id_reporte,desde_fecha,hasta_fecha) {
    $("#consulta_delitos_todos_casos_c4").html(cargando);
    $.post("../controllers/estadisticas.php", { func: 'fun_listar_consulta_delito_c4',id_reporte:id_reporte,desde_fecha:desde_fecha,hasta_fecha:hasta_fecha }, function (data) {
        $('#consulta_delitos_todos_casos_c4').html(data);
       
        
    });
}
function fn_carga_delitos() {
    $.post("../controllers/estadisticas.php", { func: 'fn_carga_delitos' }, function (data) {

    });
}