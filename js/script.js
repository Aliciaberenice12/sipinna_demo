function fn_login() {
    log_user = $.trim($('#usuario').val());
    log_psw = $.trim($('#contrasena').val());

    if (log_user == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar un usuario!');
        $('#usuario').focus();
        return false;
    }
    else if (log_psw == '') {
        toastr.options.timeOut = 2500;
        toastr.warning('¡Debes ingresar una contraseña!');
        $('#contrasena').focus();
        return false;
    }

    datos = { accion: 'fn_login', log_user: log_user, log_psw: log_psw, func: 'valida_login' };

    $.ajax({
        url: "./config/funLog.php",
        type: "POST",
        dataType: "JSON",
        data: datos
    }).done(function (res) {
        if (res.estatus == 'ok') {
            Swal({ type: 'success', title: 'Inicio de sesión correcto', showConfirmButton: false, timer: 1500 });
            setTimeout(' location.href = "vistas/canalizacion-index.php" ', 1000);
        }
        else if (res.estatus == 'user_pasword_incorrectos') {
            toastr.options.timeOut = 2500;
            toastr.error('¡Usuario o contraseña incorrectos!');
            return false;
        }
        else {
            Swal({ type: 'error', title: 'Hubo un problema', text: 'Estatus: ' + res.estatus, showConfirmButton: true });
            return false;
        }
    });
}

function fn_cerrar_sesion() {
    swal({
        title: '¿Estás seguro?',
        text: 'Se cerrará la sesión',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            datos = { func: 'cerrar_sesion' };

            $.ajax({
                url: "../config/funLog.php",
                type: "POST",
                dataType: 'JSON',
                data: datos
            }).done(function (res) {
                if (res.estatus == 'ok') {
                    Swal({ type: 'success', title: 'Cierre de sesión correcto', showConfirmButton: false, timer: 1500 });
                    setTimeout(' location.href = "../index.php" ', 1000);
                }
                else {
                    Swal({ type: 'error', title: 'Hubo un problema', text: 'Vuelve a intentarlo', showConfirmButton: false, timer: 1500 });
                    return false;
                }
            })
        }
    })
}