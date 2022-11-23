$(document).ready(function () {
    $('#btnAgregar').click(function () {
        $('#formulario')[0].reset();
        $(".modal-title").text("Crear Nuevo Usuario")
        $('#action').val("Crear");
        $('#operacion').val("Crear");
        $('#imagen_subida').html("");
    });

    let dataTable = $('#datos_usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../vistas/usuario/datos_usuario.php",
            type: "POST"
        },
        "columnsDefs": [
            {
                "targets": [0],
                "orderable": false,
            },
        ],
        "language": {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });//Fin DataTable
    //TODO: Validar datos desde js

    //Codigo para insertar Datos
    $(document).on('submit', '#formulario', function (e) {
        e.preventDefault();

        let nombre = $('#nombre').val();
        let apellidos = $('#apellidos').val();
        let departamento = $('#departamento').val();
        let usuario = $('#usuario').val();
        let contrasena = $('#contrasena').val();
        let email = $('#email').val();
        let extension = $('#imagen_usuario').val().split('.').pop().toLowerCase();

        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Formato de imagen no valido");
                $("#imagen_usuario").val('');
                return false;
            }
        }

        if (nombre != '' && apellidos != '' && usuario != '' && email != '') {
            $.ajax({
                url: "../vistas/usuario/agregarUsuario.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 'Creado') {
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Usuario Agregado',
                            allowOutSideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            stopKeydownPropagation: false
                        });
                    }else if(data == 'Actualizado') {                         
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: 'Usuario Actualizado',
                                allowOutSideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                stopKeydownPropagation: false
                            });
                        
                    }
                    $('#formulario')[0].reset();
                    $('.modal-backdrop').remove();
                    $('#modalUsuario').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        } else {
            alert("Algunos campos son obligatorios")
        }
    })//Fin Insertar


    //Editar

    $(document).on('click', '.editar', function () {
        let id_usuario = $(this).attr("id");
        $.ajax({
            url: "../vistas/usuario/crearUsuario.php",
            method: "POST",
            data: { id_usuario: id_usuario },
            dataType: "json",
            success: function (data) {
                $('#modalUsuario').modal('show');
                $('#nombre').val(data.nombre);
                $('#apellidos').val(data.apellidos);
                $('#departamento').val(data.departamento);
                $('#usuario').val(data.usuario);
                $('#contrasena').val(data.contrasena);
                $('#email').val(data.email);
                $('.modal-title').text("Editar Usuario");
                $('#id_usuario').val(id_usuario);
                $('#imagen_subida').html(data.imagen_usuario);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    });//Editar

    //Borrar
    $(document).on('click', '.borrar', function () {
        let id_usuario = $(this).attr("id");
                Swal.fire({
                    icon: 'question',
                    type: 'question',
                    title: '¿Quieres eliminar este usuario',
                    confirmButtonColor:'#dc3545',
                    confirmButtonText:'Borrar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    stopKeydownPropagation: false,
                    showDenyButton: true,
                    denyButtonText: 'Cancelar',
                    denyButtonColor: '#ccc'
                }).then((result)=>{
                    if(result.isConfirmed){
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Usuario Borrado'

                        });

                    }else if(result.isDenied){
                        Swal.fire('Usuario no Borrado','','info');
                        return false;
                    }
                    
            $.ajax({
                url: "../vistas/usuario/borrarUsuario.php",
                method: "POST",
                data: { id_usuario: id_usuario },
                success: function (data) {    
                    var tabla = $('#datos_usuario').DataTable();
                    tabla.row($('#lusr' + id)).remove().draw();             
                    dataTable.ajax.reload();
                }//Success
            });//Ajax

            
        });
    //}

    });





























});//Fim del DocReady