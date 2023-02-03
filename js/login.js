const f = "./controllers/mainCtrl.php";

var mibtn = document.getElementById("btn_login");

if (mibtn) {
    document.getElementById("btn_login").addEventListener("click", function (event) {
        event.preventDefault()
        login_roles();
    });
}



function login_roles() {

    log_user = $.trim($('#usuario').val());
    log_psw = $.trim($('#contrasena').val());

    var arreglo = "";
    var arreglo = {
        accion: "roles_usuario",
        usuario: log_user,
        pass: log_psw
    };

    if (log_user == '' || log_psw == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Inicio de sesión',
            text: '¡Algunos campos son obligatorios!',
            showConfirmButton: false,
            timer: 2500
        });
        $('#usuario').focus();
        return false;
    }


    postAjax("POST", arreglo, f).then((data) => {
        
        switch (data.estatus) {
            case 200:

                Swal.fire({
                    icon: 'success',
                    title: 'Inicio de sesión correcto',
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout("window.location.href = 'vistas/administracion.php'", 1000);
                
                
                
                break;

            case 404:

                Swal.fire({
                    icon: 'warning',
                    title: 'Login de usuario',
                    text: '¡Las credenciales ingresadas son incorrectas!',
                    showConfirmButton: true
                });

                break

            default:
                break;
        }

    });

}

function close_sesion() {
    var arreglo = "";
    var arreglo = {
        accion: "cerrar_sesion"
    };

    Swal.fire({
        title: "¿Estas seguro?",
        text: 'Se cerrará la sesión',
        icon: "question",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Salir",
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        stopKeydownPropagation: false,
        showDenyButton: true,
        denyButtonText: "Cancelar",
        denyButtonColor: "#red",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: "success",
                title: "Sesion Cerrada",
            });
            postAjax("POST", arreglo, "../controllers/mainCtrl.php").then((response) => {
                // let jsonparse = JSON.parse(response);

                switch (response.estatus) {
                    case 200:
    
                        window.location.href = "../index.php";
                        break;
    
                    default:
                        break;
                }
            })
        } else if (result.isDenied) {
            return false;
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

