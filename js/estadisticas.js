$(document).ready(function () {
    const opciones = {
        1: [
            { valor: "1", texto: "Reporte por municipios" },
            { valor: "2", texto: "Reporte por General(Sin Municipios)" },
            { valor: "3", texto: "Reporte por General Total" },
            { valor: "4", texto: "Reporte por Dependencias" }

        ],
        2: [
            { valor: "1", texto: "Reporte por municipios" },
            { valor: "2", texto: "Reporte por General(Sin Municipios)" },
            { valor: "3", texto: "Reporte por General Total" }
        ]
    };

    $('#gen_reporte').on('change', function () {
        const valorSeleccionado = $(this).val();
        const opcionesSegundo = opciones[valorSeleccionado] || [];

        const segundoSelect = $('#id_reporte');
        segundoSelect.empty(); // Limpiar las opciones existentes

        // Agregar opción por defecto
        segundoSelect.append('<option value="0" selected disabled>Seleccione...</option>');

        // Agregar nuevas opciones
        opcionesSegundo.forEach(function (opcion) {
            segundoSelect.append(new Option(opcion.texto, opcion.valor));
        });
    });

    function cambiarTextoElemento(idElemento, texto) {
        document.getElementById(idElemento).textContent = texto;
    }

    function removerElemento(idElemento) {
        const elemento = document.getElementById(idElemento);
        while (elemento.firstChild) {
            elemento.removeChild(elemento.firstChild);
        }
    }

    document.getElementById('gen_reporte').addEventListener('change', function () {
        var div = document.getElementById('div_estatus');
        if (this.value === '1') {
            div.style.display = 'block';
            cambiarTextoElemento('tituloReporte', 'Se muestran los datos de Canalización');
            removerElemento('div_reportes');
        } else {
            div.style.display = 'none';
            $('#estatus').val("0");
            cambiarTextoElemento('tituloReporte', 'Se muestran los datos de Casos C4');
            removerElemento('div_reportes');
        }
    });

    document.getElementById('id_reporte').addEventListener('change', function () {
        removerElemento('div_reportes');
    });
    document.getElementById('estatus').addEventListener('change', function () {
        removerElemento('div_reportes');
    });
    document.getElementById('desde_fecha').addEventListener('change', function () {
        removerElemento('div_reportes');
    });
    document.getElementById('hasta_fecha').addEventListener('change', function () {
        removerElemento('div_reportes');
    });
});
function valida() {
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
    if (id_reporte == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('Seleccione Reporte a consultar!');
        $('#id_reporte').focus();
        return false;
    }
    if (gen_reporte == "1") {
        estatus = $.trim($('#estatus').val());
        if (estatus == '') {
            toastr.options.timeOut = 2500;
            toastr.warning('Seleccione Estatus!');
            $('#estatus').focus();
            return false;
        }
    }

    else if (desde_fecha == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione rango de fecha desde la fecha inicio a consultar!');
        $('#desde_fecha').focus();
        return false;
    }
    else if (hasta_fecha == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Seleccione rango de fecha hasta la fecha final a consultar!');
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
}
function consulta() {
    if (valida() != false) {
        obtiene_resultados();
    }
}
async function obtiene_resultados() {
    let result;
    let gen_reporte = $('#gen_reporte').val();
    let id_reporte = $('#id_reporte').val();
    let estatus = $('#estatus').val();
    let desde_fecha = $('#desde_fecha').val();
    let hasta_fecha = $('#hasta_fecha').val();
    let datos = { "gen_reporte": gen_reporte, "id_reporte": id_reporte, "estatus": estatus, "desde_fecha": desde_fecha, "hasta_fecha": hasta_fecha };
    const data = { "func": 'listar', "datos": datos };
    try {
        result = await $.ajax({
            type: 'POST',
            url: `../controllers/estadisticas.php`,
            dataType: "json",
            data: { data },
        });

        if (result.status == "200") {
            let datos = result.data;
            if (gen_reporte == '1')//canalizacion
            {
                if (id_reporte == '1') {
                    reporte1(datos);

                } else if (id_reporte == '2') {
                    reporte2(datos);
                }
                else if (id_reporte == '3') {
                    reporte3(datos);
                }
                else if (id_reporte == '4') {
                    reporte6(datos);
                }
            }
            else {
                if (id_reporte == '1') {
                    reporte1(datos);
                } else if (id_reporte == '2') {
                    reporte4(datos);
                }
                else if (id_reporte == '3') {
                    reporte5(datos);
                }
            }
            var pdf = document.getElementById("btn_pdf");
            pdf.addEventListener("click", async function () {
                modal_pdf(gen_reporte, id_reporte, desde_fecha, hasta_fecha, estatus)
            });

        } else if (result.status == "204") {
            $('#div_reportes').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
        }

    } catch (error) {
        return error.responseJSON;
    }
}
function reporte1(datos) {
    let encabezados = `
    <div><button type="button" id="btn_pdf" class="btn btn-secondary">Ver pdf</button></div>
    <h5 id="div1" align="center" class="mb-4"><strong >Total de casos en cada municipio(Estado de Veracruz )</strong></h5>
    <div class="col-12" id="mun"></div>
    <h5 id="div2"align="center" class="mb-4"><strong>Total de casos en estados diferentes de veracruz</strong></h5>
    <div class="col-12" id="edo"></div>
    <h5 id="div3"align="center" class="mb-4"><strong>Total de casos en pais diferentes de México</strong></h5>
    <div class="col-12" id="pais"></div>
     `;
    $('#div_reportes').html(encabezados);

    if (datos.consulta1 != "n/a") {
        let datosMun = datos.consulta1;
        pinta(datosMun, 'Municipio', 'mun');
    }
    else {
        removerElemento('mun'); // Vacía el contenido del div con id "mun"
    }
    if (datos.consulta2 != "n/a") {
        let datosEdo = datos.consulta2;
        pinta(datosEdo, 'Estado', 'edo')
    }
    else {
        removerElemento('edo'); // Vacía el contenido del div con id "edo"
        $('#edo').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta3 != "n/a") {
        let datosPais = datos.consulta3;
        pinta(datosPais, 'País', 'pais');
    }
    else {
        removerElemento('pais'); // Vacía el contenido del div con id "mun"
        $('#pais').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
}
function reporte2(datos) {
    let encabezados = `
        <div><button type="button" id="btn_pdf" class="btn btn-secondary">Ver pdf</button></div>

        <h5 id="div4"align="center" class="mb-4"><strong >Total de casos por mes </strong></h5>
        <div class="col-12" id="mes"></div>
        <h5 id="div5"align="center" class="mb-4"><strong>Total de victimas por género de todos los casos</strong></h5>
        <div class="col-12" id="genero"></div>
        <h5 id="div6"align="center" class="mb-4"><strong>Total de victimas menores de edad todos los casos </strong></h5>
        <div class="col-12" id="menos_edad"></div>
        <h5 id="div7"align="center" class="mb-4"><strong>Total de victimas mayores de edad todos los casos </strong></h5>
        <div class="col-12" id="mayor_edad"></div>
        <h5 id="div8"align="center" class="mb-4"><strong>Total de victimas de agresión extraordinaria </strong></h5>
        <div class="col-12" id="agresion"></div>
    `;
    $('#div_reportes').html(encabezados);

    if (datos.consulta1 != "n/a") {
        let datoMes = datos.consulta1;
        pinta(datoMes, 'MES', 'mes');
    }
    else {
        removerElemento('mes');
        $('#mes').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    }
    if (datos.consulta2 != "n/a") {
        let genero = datos.consulta2;
        pinta(genero, 'Género', 'genero');
    }
    else {
        removerElemento('genero');
        $('#genero').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    }
    if (datos.consulta3 != "n/a") {
        let genero = datos.consulta3;
        pinta(genero, 'Edad(Años)', 'menos_edad');
    }
    else {
        removerElemento('menos_edad');
        $('#menos_edad').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    }
    if (datos.consulta4 != "n/a") {
        let genero = datos.consulta4;
        pinta(genero, 'Edad(Años)', 'mayor_edad');

    }
    else {
        removerElemento('mayor_edad');
        $('#mayor_edad').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    }
    if (datos.consulta5 != "n/a") {
        let genero = datos.consulta5;
        pintaAgresion(genero, 'Agresión Extraordinaria', 'agresion');
    }
    else {
        removerElemento('agresion');
        $('#agresion').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    }

}
function reporte3(datos) {
    let encabezados = `
    <div><button type="button" id="btn_pdf" class="btn btn-secondary">Ver pdf</button></div>
    <h5 id="div1" align="center" class="mb-4"><strong >Total de casos en cada municipio(Estado de Veracruz )</strong></h5>
    <div class="col-12" id="mun"></div>
    <h5 id="div2"align="center" class="mb-4"><strong>Total de casos en estados diferentes de veracruz</strong></h5>
    <div class="col-12" id="edo"></div>
    <h5 id="div3"align="center" class="mb-4"><strong>Total de casos en pais diferentes de México</strong></h5>
    <div class="col-12" id="pais"></div>
    <h5 id="div4"align="center" class="mb-4"><strong >Total de casos por mes </strong></h5>
    <div class="col-12" id="mes"></div>
    <h5 id="div5"align="center" class="mb-4"><strong>Total de victimas por género de todos los casos</strong></h5>
    <div class="col-12" id="genero"></div>
    <h5 id="div6"align="center" class="mb-4"><strong>Total de victimas menores de edad todos los casos </strong></h5>
    <div class="col-12" id="menos_edad"></div>
    <h5 id="div7"align="center" class="mb-4"><strong>Total de victimas mayores de edad todos los casos </strong></h5>
    <div class="col-12" id="mayor_edad"></div>
    <h5 id="div8"align="center" class="mb-4"><strong>Total de victimas de agresión extraordinaria </strong></h5>
    <div class="col-12" id="agresion"></div>
    `;
    $('#div_reportes').html(encabezados);
    if (datos.consulta1 != "n/a") {
        let datosMun = datos.consulta1;
        pinta(datosMun, 'Municipio', 'mun');
    }
    else {
        removerElemento('mun');
        $('#mun').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    }
    if (datos.consulta2 != "n/a") {
        let datosEdo = datos.consulta2;
        pinta(datosEdo, 'Estado', 'edo')

    }
    else {
        removerElemento('edo');
        $('#edo').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta3 != "n/a") {
        let datosPais = datos.consulta3;
        pinta(datosPais, 'País', 'pais');
    } else {
        removerElemento('pais');
        $('#pais').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta4 != "n/a") {
        let datoMes = datos.consulta4;
        pinta(datoMes, 'MES', 'mes');
    } else {
        removerElemento('mes');
        $('#edo').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta5 != "n/a") {
        let genero = datos.consulta5;
        pinta(genero, 'Género', 'genero');
    } else {
        removerElemento('genero');
        $('#genero').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta6 != "n/a") {
        let genero = datos.consulta6;
        pinta(genero, 'Edad(Años)', 'menos_edad');
    } else {
        removerElemento('menos_edad');
        $('#menos_edad').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta7 != "n/a") {
        let genero = datos.consulta7;
        pinta(genero, 'Edad(Años)', 'mayor_edad');
    } else {
        removerElemento('mayor_edad');
        $('#mayor_edad').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }
    if (datos.consulta8 != "n/a") {
        let genero = datos.consulta8;
        pintaAgresion(genero, 'Agresión Extraordinaria', 'agresion');
    }
    else {
        removerElemento('agresion');
        $('#agresion').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');
    }

}
function reporte4(datos) {
    let encabezados = `
    <div><button type="button" id="btn_pdf" class="btn btn-secondary">Ver pdf</button></div>
    <h5 id="div4"align="center" class="mb-4"><strong >Total de casos por mes </strong></h5>
    <div class="col-12" id="mes"></div>
    <h5 id="div5"align="center" class="mb-4"><strong>Total de victimas por género de todos los casos</strong></h5>
    <div class="col-12" id="genero"></div>
    <h5 id="div6"align="center" class="mb-4"><strong>Total de victimas menores de edad todos los casos </strong></h5>
    <div class="col-12" id="menos_edad"></div>
    <h5 id="div7"align="center" class="mb-4"><strong>Total de victimas mayores de edad todos los casos </strong></h5>
    <div class="col-12" id="mayor_edad"></div>
    <h5 id="div8"align="center" class="mb-4"><strong>Total de victimas de agresión extraordinaria </strong></h5>
    <div class="col-12" id="agresion"></div>
    <h5 id="div9"align="center" class="mb-4"><strong>Total de delitos en todos los casos </strong></h5>
    <div class="col-12" id="delito"></div>
    `;
    $('#div_reportes').html(encabezados);


    if (datos.consulta3 != "n/a") {
        let datoMes = datos.consulta3;
        pinta(datoMes, 'MES', 'mes');
    }
    else {
        removerElemento('mes');
    }
    if (datos.consulta4 != "n/a") {
        let genero = datos.consulta4;
        pinta(genero, 'Género', 'genero');
    }
    else {
        removerElemento('genero');
    }
    if (datos.consulta5 != "n/a") {
        let genero = datos.consulta5;
        pinta(genero, 'Edad(Años)', 'menos_edad');
    }
    else {
        removerElemento('menos_edad');
    }
    if (datos.consulta6 != "n/a") {
        let genero = datos.consulta6;
        pinta(genero, 'Edad(Años)', 'mayor_edad');
    }
    else {
        removerElemento('mayor_edad');
    }
    if (datos.consulta7 != "n/a") {
        let delito = datos.consulta7;
        pinta(delito, 'Delito', 'delito');
    }
    else {
        removerElemento('delito');
    }
    if (datos.consulta8 != "n/a") {
        let genero = datos.consulta8;
        pintaAgresion(genero, 'Agresión Extraordinaria', 'agresion');
    }
    else {
        removerElemento('agresion');
    }

}
function reporte5(datos) {
    let encabezados = `
    <div><button type="button" id="btn_pdf" class="btn btn-secondary">Ver pdf</button></div>
    <h5 id="div1" align="center" class="mb-4"><strong >Total de casos en cada municipio(Estado de Veracruz )</strong></h5>
    <div class="col-12" id="mun"></div>
    <h5 id="div2"align="center" class="mb-4"><strong>Total de casos en estados diferentes de veracruz</strong></h5>
    <div class="col-12" id="edo"></div>
    <h5 id="div3"align="center" class="mb-4"><strong>Total de casos en pais diferentes de México</strong></h5>
    <div class="col-12" id="pais"></div>
    <h5 id="div4"align="center" class="mb-4"><strong >Total de casos por mes </strong></h5>
    <div class="col-12" id="mes"></div>
    <h5 id="div5"align="center" class="mb-4"><strong>Total de victimas por género de todos los casos</strong></h5>
    <div class="col-12" id="genero"></div>
    <h5 id="div6"align="center" class="mb-4"><strong>Total de victimas menores de edad todos los casos </strong></h5>
    <div class="col-12" id="menos_edad"></div>
    <h5 id="div7"align="center" class="mb-4"><strong>Total de victimas mayores de edad todos los casos </strong></h5>
    <div class="col-12" id="mayor_edad"></div>
    <h5 id="div8"align="center" class="mb-4"><strong>Total de victimas de agresión extraordinaria </strong></h5>
    <div class="col-12" id="agresion"></div>
    <h5 id="div9"align="center" class="mb-4"><strong>Total de delitos en todos los casos </strong></h5>
    <div class="col-12" id="delito"></div>
    `;
    $('#div_reportes').html(encabezados);
    if (datos.consulta1 != "n/a") {
        let datoMun = datos.consulta1;
        pinta(datoMun, 'Municipio', 'mun');
    }
    else {
        removerElemento('mes');
    }
    if (datos.consulta2 != "n/a") {
        let datoEdo = datos.consulta2;
        pinta(datoEdo, 'Estado', 'edo');
    }
    else {
        removerElemento('edo');
    }
    if (datos.consulta3 != "n/a") {
        let datoPais = datos.consulta3;
        pinta(datoPais, 'País', 'pais');
    }
    else {
        removerElemento('pais');
    }
    if (datos.consulta4 != "n/a") {
        let datoMes = datos.consulta4;
        pinta(datoMes, 'MES', 'mes');
    }
    else {
        removerElemento('mes');
    }
    if (datos.consulta5 != "n/a") {
        let genero = datos.consulta5;
        pinta(genero, 'Género', 'genero');
    }
    else {
        removerElemento('genero');
    }
    if (datos.consulta6 != "n/a") {
        let genero = datos.consulta6;
        pinta(genero, 'Edad(Años)', 'menos_edad');
    }
    else {
        removerElemento('menos_edad');
    }
    if (datos.consulta7 != "n/a") {
        let genero = datos.consulta7;
        pinta(genero, 'Edad(Años)', 'mayor_edad');
    }
    else {
        removerElemento('mayor_edad');
    }
    if (datos.consulta8 != "n/a") {
        let delito = datos.consulta8;
        pinta(delito, 'Delito', 'delito');
    }
    else {
        removerElemento('delito');
    }
    if (datos.consulta9 != "n/a") {
        let genero = datos.consulta9;
        pintaAgresion(genero, 'Agresión Extraordinaria', 'agresion');
    }
    else {
        removerElemento('agresion');
    }

}
function reporte6(datos) {
    let encabezados = `
    <div><button type="button" id="btn_pdf" class="btn btn-secondary">Ver pdf</button></div>
    <h5 id="div1" align="center" class="mb-4"><strong >Total de canalizaciones a dependencias</strong></h5>
    <div class="col-12" id="dep"></div>

     `;
    $('#div_reportes').html(encabezados);

    if (datos.consulta1 != "n/a") {
        let datosMun = datos.consulta1;
        pinta(datosMun, 'Dependencia', 'dep');
    }
    else {
        removerElemento('dep'); // Vacía el contenido del div con id "mun"
    }
}
function pinta(datos, origen, contenedor) {
    let suma = datos.reduce((acumulador, objeto) => acumulador + objeto.Numero, 0);
    let encabezadoTabla = `
    <table class="table" >
        <thead class="tbl-estadisticas">
            <tr align="center">
                <th>${origen}</th>
                <th>Número</th> 
            </tr>
        </thead>
        <tbody id="lista_${contenedor}" align="center">                    
        </tbody>
        <tfoot id="total_${contenedor}" align="center">
        
            <tr>
                <th>${datos.length}</th>
                <th>${suma}</th>
            </tr>
            
        </tfoot>
    </table>`;
    $('#' + contenedor).html(encabezadoTabla);

    for (let i = 0; i < datos.length; i++) {

        llena(datos[i], contenedor)
    }
}
function llena(datos, contenedor) {
    // Obtener las claves del objeto
    const keys = Object.keys(datos);

    // Acceder a los valores basados en las claves
    const dato1 = datos[keys[0]];
    const dato2 = datos[keys[1]];

    // Inicializar htmlDatos como una cadena vacía
    let htmlDatos = '';

    // Construir el HTML
    htmlDatos +=
        `<tr>
            <td width="60%">${dato1}</td>
            <td width="40%">${dato2}</td>
        </tr>`;

    // Agregar el HTML al contenedor
    $(`#lista_${contenedor}`).append(htmlDatos);
}
function pintaAgresion(datos, origen, contenedor) {

    // Convertir los valores de count_non_zero a números y sumarlos
    let suma = datos.reduce((acumulador, objeto) => acumulador + parseInt(objeto.count_non_zero, 10), 0);
    if (isNaN(suma)) {
        removerElemento('agresion');
        $('#agresion').html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

    } else {
        let encabezadoTabla = `
    <table class="table" >
        <thead class="tbl-estadisticas">
            <tr align="center">
                <th>${origen}</th>
                <th>Número</th> 
            </tr>
        </thead>
        <tbody id="lista_${contenedor}" align="center">                    
        </tbody>
        <tfoot id="total_${contenedor}" align="center">
        
            <tr>
                <th>${datos.length}</th>
                <th>${suma}</th>
            </tr>
            
        </tfoot>
    </table>`;
        $('#' + contenedor).html(encabezadoTabla);

        for (let i = 0; i < datos.length; i++) {

            llenaAgresion(datos[i], contenedor)
        }
    }

}
function llenaAgresion(datos, contenedor) {
    // Obtener las claves del objeto
    const keys = Object.keys(datos);
    // Acceder a los valores basados en las claves
    const dato1 = datos[keys[0]];
    const dato2 = datos[keys[1]];

    let nombre = '';
    // Asignar un valor a nombre basado en dato1
    if (dato1 === 'can_per_tercera_edad' || dato1 === 'c4_per_tercera_edad') {
        nombre = "(Otros)Persona de tercera edad";
    } else if (dato1 == "can_per_violencia" || dato1 === 'c4_per_violencia') {
        nombre = "Violencia contra la mujer";
    } else if (dato1 == "can_per_discapacidad" || dato1 === 'c4_per_discapacidad') {
        nombre = "Persona con alguna discapacidad";
    } else if (dato1 == "can_per_indigena" || dato1 === 'c4_per_indigena') {
        nombre = "Persona indigena";
    } else if (dato1 == "can_per_transgenero" || dato1 === 'c4_per_transgenero') {
        nombre = "Persona transgenero";
    }

    // Construir el HTML
    let htmlDatos = `
        <tr>
            <td width="60%">${nombre}</td>
            <td width="40%">${dato2}</td>
        </tr>`;

    // Agregar el HTML al contenedor
    $(`#lista_${contenedor}`).append(htmlDatos);
}
function removerElemento(id) {
    $('#' + id).empty(); // Elimina todo el contenido del elemento con el ID especificado
    $('#' + id).html('<p align="center"><u>Sin resultados para la búsqueda<u></p>');

}

function modal_pdf(gen_reporte, id_reporte, desde, hasta, estatus) {

    if (gen_reporte == '1') {
        if (id_reporte == '1') {
            $('#tit_modal_pdf').html('Reporte de consulta por municipio canalización');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe src="../vistas/reportes/canalizacion/reporteMunicipios.php?desde=' + desde + '&hasta=' + hasta + '&estatus=' + estatus + '" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        } else if (id_reporte == '2') {
            $('#tit_modal_pdf').html('Reporte general de canalización (sin municipio)');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe src="../vistas/reportes/canalizacion/reporteGeneral.php?desde=' + desde + '&hasta=' + hasta +'&estatus=' + estatus + '" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        } else if (id_reporte == '3') {
            $('#tit_modal_pdf').html('Reporte Total de Canalización');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe src="../vistas/reportes/canalizacion/reporteTotal.php?desde=' + desde + '&hasta=' + hasta + '&estatus=' + estatus +'" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        }
        else if (id_reporte == '4') {
            $('#tit_modal_pdf').html('Reporte por dependencias de Canalización');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe src="../vistas/reportes/canalizacion/reporteDependencias.php?desde=' + desde + '&hasta=' + hasta + '&estatus=' + estatus + '" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        }
    }
    else if (gen_reporte == '2') {
        if (id_reporte == '1') {
            $('#tit_modal_pdf').html('Reporte Municipio Casos C4');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe  src="../vistas/reportes/casos_c4/reporteMunicipios.php?desde=' + desde + '&hasta=' + hasta + '&estatus=' + estatus + '" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        }
        else if (id_reporte == '2') {
            $('#tit_modal_pdf').html('Reporte General Sin Municipio Casos C4');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe  src="../vistas/reportes/casos_c4/reporteGeneral.php?desde=' + desde + '&hasta=' + hasta + '&estatus=' + estatus + '" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        }
        else if (id_reporte == '3') {
            $('#tit_modal_pdf').html('Reporte Total Casos C4');
            $('#modal_pdf').modal({ backdrop: 'static', keyboard: false });
            $('#modal_pdf').modal('show');
            ref_pdf = '<iframe  src="../vistas/reportes/casos_c4/reporteTotal.php?desde=' + desde + '&hasta=' + hasta + '&estatus=' + estatus +'" width="100%" height="600px"></iframe>';
            $("#reporte").html(ref_pdf);
        }

    }
}

