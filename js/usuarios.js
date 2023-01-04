const MAINCTRL = "../controllers/mainCtrl.php";

var table = "";
$(document).ready(function () {

  $("#action").click(function () {

    insertUserX();
 

  });
  $("#btnAgregar").click(function (e) {
    e.preventDefault();
    $("#modalUsuario").modal("show");
    $("#formulario")[0].reset();
    $(".img_formUser").hide();
    $("#operacion").val("Crear");
    listRol();


  });
  /* llamar procedimiento que extrae los datos de usuarios  */
  getUsers();
});


/* ----------------- procedimientos agregados nuevos ---------------------- */


function getUserId(valor) {
  var arreglo = "";
  var arreglo = {
    accion: "obtener_usuarioId",
    id_usuario: valor
  };

  listRol();

  postAjax("POST", arreglo, MAINCTRL).then((response) => {

    switch (response.estatus) {
      case 200:
        if (response.total > 0) {
          $("#modalUsuario").modal("show");
          $("#nombre").val(response.data[0].nombre);
          $("#apellidos").val(response.data[0].apellidos);
          $("#departamento").val(response.data[0].departamento);
          $("#usuario").val(response.data[0].usuario);
          $("#contrasena").val(response.data[0].contrasena);
          $("#email").val(response.data[0].email);
          $("#rol_usuario").val(response.data[0].rol_id);
          $(".modal-title").text("Editar Usuario");
          $("#id_usuario").val(id_usuario);
          imagenhtml = '<img src="../vistas/usuario/imgUser/' + response.data[0].imagen + '" class="img_userForm" />';
          $("#imagen_subida").html(imagenhtml);
          $("#img_user").val(response.data[0].imagen);
          $("#action").val("Editar");
          $("#id_usuario").val(valor);
        } else {
          MessageSwal('!', 'Editar usuario', 'No se encontro el usuario seleccionado...');
        }
        break;
      default:
        MessageSwal('x', 'Editar usuario', response.message);
        break;
    }
  });


}

function getUsers() {
  var arreglo = "";
  var arreglo = {
    accion: "obtener_usuarios"
  };

  postAjax("POST", arreglo, MAINCTRL).then((response) => {
    switch (response.estatus) {
      case 200:
        if (response.total > 0) {
          // Se genera un arreglo para obtener filas de objeto response
          var dataSet = new Array();
          // se recorre el objeto response.data
          $.each(response.data, function (index, value) {
            // se inicializa el array temporal
            var tempArray = new Array();
            for (var o in value) {
              // se obtiene el valor del objeto para asignarlo al array
              tempArray.push(value[o]);
            }
            // se asignan los datos temporales al dataSet que sera enviado al dataTable
            dataSet.push(tempArray);
          });

          // se asignan los valores al dataTable
          table = $("#datos_usuario").DataTable({
            data: dataSet,
            language: {
              decimal: "",
              emptyTable: "No hay registros",
              info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
              infoFiltered: "(Filtrado de _MAX_ total entradas)",
              infoPostFix: "",
              thousands: ",",
              lengthMenu: "Mostrar _MENU_ Entradas",
              loadingRecords: "Cargando...",
              processing: "Procesando...",
              search: "Buscar: ",
              zeroRecords: "Sin resultados encontrados",
              paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
              },
            },
            columns: [
              { title: "Id" },
              { title: "Nombre" },
              { title: "Apellidos" },
              { title: "Departamento" },
              { title: "Usuario" },
              { title: "Email" },
              { title: "Imagen" },
            ],
            columnDefs: [
              {
                targets: 7,
                data: null,
                defaultContent: '<a class = "editar_ "><i class="fa fa-edit"></i></a>',
              },
              {
                targets: 8,
                data: null,
                defaultContent: '<a class = "eliminar_ "><i class="fa fa-trash"></i></a>',
              }
            ],
          });

          $('#datos_usuario tbody').on('click', '.editar_', function () {
            var data = table.row($(this).parents('tr')).data();

            getUserId(data[0]);

            $("#operacion").val("Editar")
            $(".img_formUser").show();


          });//Click Editar


          $('#datos_usuario tbody').on('click', '.eliminar_', function () {

            var data = table.row($(this).parents('tr')).data();

            $("#operacion").val("Eliminar")

            deleteUser(data[0]);



          })

          $('#datos_usuario tbody').on('click', 'tr', function () {
            RowIndexId(table.row(this).index());
          });


          ;

        } else {
          alert('Datos no encontrados');
        }

        break;

      default:
        alert(response.message);
        break;
    }
  });
}


function RowIndexId(valor) {
  $("#idRow").val(valor)
}

function insertUserX() {

  const evento = $("#operacion").val();

  
  let nombre = $("#nombre").val();
  let apellidos = $("#apellidos").val();
  let departamento = $("#departamento").val();
  let usuario = $("#usuario").val();
  let email = $("#email").val();
  let contrasena = $("#contrasena").val();
  let d_contrasena = $("#d_contrasena").val();
  let imagenhtml = $("#imagen_usuario").val();
  let rol_usuario = $("#rol_usuario").val();

  const formulario = document.getElementById('formulario');
  var formData = new FormData(formulario);

  if (evento == "Editar") {

    formData.append("accion", "editar_usuario")

  } else if (evento == "Crear") {

    formData.append("accion", "nuevo_usuario")
  }



  if (nombre != "" && apellidos != "" && usuario != "" && email != "" && rol_usuario != 0 ) {
    if (contrasena.length >= 8) {

      if (contrasena  == d_contrasena) {
        
        postAjaxForm("POST", formData, MAINCTRL).then((response) => {
      
          let jsonparse = JSON.parse(response);
      
          switch (jsonparse.estatus) {
            case 200:
              if (jsonparse.lastId > 0) {
                /* revisar funcion MessageSwal para ver la interpretacion de los tipos de mensajes a enviar */
      
                //Se manda a llamar la imagen desde la carpeta en el servidor
                imagenhtml = '<img src="../vistas/usuario/imgUser/' + jsonparse.imagen + '" class="img_user" />'
      
                mitabla = $("#datos_usuario").DataTable();
                if (evento == "Crear") {
      
                  mitabla.row.add([jsonparse.lastId, nombre, apellidos, departamento, usuario, email, imagenhtml]).draw(false);
      
                  MessageSwal('ok', 'Usuario Agregado!!!', jsonparse.message)
      
                } else if (evento == "Editar") {
      
                  var rowIndex = $("#idRow").val();
                  var temp = mitabla.row(rowIndex).data();
                  temp[1] = nombre;
                  temp[2] = apellidos;
                  temp[3] = departamento;
                  temp[4] = usuario;
                  temp[5] = email;
                  temp[6] = imagenhtml;
      
                  $('#datos_usuario').dataTable().fnUpdate(temp, rowIndex, undefined, false);
      
                  MessageSwal('ok', 'Usuario Actualizado!!!', jsonparse.message)
                }
                //MessageSwal('ok', 'Usuario Agregado!!!', jsonparse.message)
      
                $("#formulario")[0].reset();
                //$(".modal-backdrop").remove();
                $("#modalUsuario").modal("hide");
      
              } else {
                MessageSwal('!', 'Agregar usuario!!!', 'El usuario no pudo ser agregado a la base de datos...');
      
              }
              break;
      
            default:
              MessageSwal("x", "Agregar usuario!!!", jsonparse.message);
              break;
          }
        });

      }else{
        //contraseña diferentes
        MessageSwal("x", "!!!Contraseñas no coinciden¡¡¡", "Verifica las contraseña");
      }
      
    }else{

    // contraseña corta
    MessageSwal("!", "!!!Contraseña Corta¡¡¡", "Minimo deben ser 8 caracteres");

    }

  } else {
    MessageSwal("x", "!!!Algunos campos son obligatorios¡¡¡", "Verifica los campos");
  }
}

function deleteUser(valor) {

  var arreglo = "";
  var arreglo = {
    id_usuario: valor,
    accion: "borrar_usuario"
  };


  Swal.fire({
    icon: "question",
    type: "question",
    title: "¿Quieres eliminar este usuario",
    confirmButtonColor: "#dc3545",
    confirmButtonText: "Borrar",
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
    stopKeydownPropagation: false,
    showDenyButton: true,
    denyButtonText: "Cancelar",
    denyButtonColor: "#ccc",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        icon: "success",
        type: "success",
        title: "Usuario Borrado",
      });
    } else if (result.isDenied) {
      Swal.fire("Usuario no Borrado", "", "info");

      return false;
    }

    postAjax("POST", arreglo, MAINCTRL).then((response) => {
      // let jsonparse = JSON.parse(response);
      switch (response.estatus) {
        case 200:

          if (response.lastId > 0) {

            mitabla = $("#datos_usuario").DataTable();

            var rowIndex = $("#idRow").val();

            mitabla.row(':eq(' + rowIndex + ')').remove().draw();
          }

          break;

        default:
          break;
      }
    })


  });

}

function listRol() {

  var arreglo = "";
  var arreglo = {
    accion: "obtener_roles",
    
  };

  postAjax("POST", arreglo, MAINCTRL).then((response) => {
    switch (response.estatus) {
      case 200:
      if (response.total > 0){
        var micombo = document.getElementById("rol_usuario")
        $("#rol_usuario").empty().append('<option value="0">Seleccione rol de usuario</option>');
        for (var i = 0; i < response.data.length; i++) {
          micombo.options.add(new Option(response.data[i].rol, response.data[i].idRol));
        }
      }

        break;

      default:
        break;
    }
  });
 

}


/* Funcion para mostrar u ocultar segun el rol que inicie sesion */



// reciclables
/* Solo mensajes sin boton de opciones
Alertas para mostrar el proceso que se pidio
*/
function MessageSwal(type, title, text) {
  validar = type.toLowerCase();
  switch (validar) {
    case '!':
      // icon =  'warning';
      type = 'warning';
      break;
    case 'x':
      // icon =  'error';
      type = 'error';
      break;
    case 'ok':
      //icon =  'success';
      type = 'success';
      break;
    case '?':
      //icon =  'question';
      type = "question";
      break;
    case '¡':
      //icon =  'info';
      type = "info";
      break;
    default:
      break;
  }

  Swal.fire({
    //icon: icon,
    icon: type,
    text: text,
    title: title
  });

}

/* procedimiento backEnd ajax utilizando promesas */
async function postAjax(type, data, url) {
  let result;

  result = await $.ajax({
    url: url,
    method: type,
    dataType: "json",
    data: data,
  });
  return result;
}
/*Procedimiento para la insersion de archivos, llamado mediante un form y usando form data*/
async function postAjaxForm(type, data, url) {
  let result;

  result = await $.ajax({
    url: url,
    method: type,
    contentType: false,
    processData: false,
    data: data,
  });
  return result;
}









/* -------------------------Funciones anteriores------------------------------------------------- */



//Codigo para insertar Datos
/* $(document).on("submit", "#formulario", function insertUser(e) {
  e.preventDefault();

  let nombre = $("#nombre").val();
  let apellidos = $("#apellidos").val();
  let departamento = $("#departamento").val();
  let usuario = $("#usuario").val();
  let contrasena = $("#contrasena").val();
  let email = $("#email").val();
  let extension = $("#imagen_usuario").val().split(".").pop().toLowerCase();

  if (extension != "") {
    if (jQuery.inArray(extension, ["gif", "png", "jpg", "jpeg"]) == -1) {
      alert("Formato de imagen no valido");
      $("#imagen_usuario").val("");
      return false;
    }
  }

  if (nombre != "" && apellidos != "" && usuario != "" && email != "") {
    $.ajax({
      url: "../vistas/usuario/agregarUsuario.php",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (data) {
        if (data == "Creado") {
          Swal.fire({
            icon: "success",
            type: "success",
            title: "Usuario Agregado",
            allowOutSideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            stopKeydownPropagation: false,
          });


        } else if (data == "Actualizado") {
          Swal.fire({
            icon: "success",
            type: "success",
            title: "Usuario Actualizado",
            allowOutSideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            stopKeydownPropagation: false,
          });
        }


        $("#formulario")[0].reset();
        $(".modal-backdrop").remove();
        $("#modalUsuario").modal("hide");
        dataTable.ajax.reload();
      },
    });
  } else {
    alert("Algunos campos son obligatorios");
  }
}); //Fin Insertar

//Editar

$(document).on("click", ".editar", function editUser() {
  let id_usuario = $(this).attr("id");
  $.ajax({
    url: "../vistas/usuario/crearUsuario.php",
    method: "POST",
    data: { id_usuario: id_usuario },
    dataType: "json",
    success: function (data) {
      $("#modalUsuario").modal("show");
      $("#nombre").val(data.nombre);
      $("#apellidos").val(data.apellidos);
      $("#departamento").val(data.departamento);
      $("#usuario").val(data.usuario);
      $("#contrasena").val(data.contrasena);
      $("#email").val(data.email);
      $(".modal-title").text("Editar Usuario");
      $("#id_usuario").val(id_usuario);
      $("#imagen_subida").html(data.imagen_usuario);
      $("#action").val("Editar");
      $("#operacion").val("Editar");
    },
    error: function (jqXHR, textStatus, errorThrown) {
    },
  });
}); //Editar

//Borrar
$(document).on("click", ".borrar", function () {
  let id_usuario = $(this).attr("id");
  Swal.fire({
    icon: "question",
    type: "question",
    title: "¿Quieres eliminar este usuario",
    confirmButtonColor: "#dc3545",
    confirmButtonText: "Borrar",
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
    stopKeydownPropagation: false,
    showDenyButton: true,
    denyButtonText: "Cancelar",
    denyButtonColor: "#ccc",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        icon: "success",
        type: "success",
        title: "Usuario Borrado",
      });
    } else if (result.isDenied) {
      Swal.fire("Usuario no Borrado", "", "info");

      return false;
    }

    $.ajax({
      url: "../vistas/usuario/borrarUsuario.php",
      method: "POST",
      data: { id_usuario: id_usuario },
      success: function (data) {
        //alert(data);
        dataTable.ajax.reload();
      }, //Success
    }); //Ajax
  });
});

 */



