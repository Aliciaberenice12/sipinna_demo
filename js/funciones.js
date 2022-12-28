$(document).ready(function () {

  obtenerPerfil();





});

const MAINCTRL = "../controllers/mainCtrl.php";

function obtenerPerfil() {

  var arreglo = "";
  var arreglo = {
    accion: "obtener_perfil",

  };

  postAjax("POST", arreglo, MAINCTRL).then((response) => {

    switch (response.estatus) {
      case 200:
        if (response.message == 1) {
          $('.administracion').removeClass("administracion");
        } else {
        }
        break;
      default:
        break;
    }
  });




}

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
