
$(document).ready(function () {


  $('#table').DataTable({
    "destroy": true,
    "order": [[2, "desc"]],
    language: {
      "decimal": "",
      "emptyTable": "No hay datos",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
      "infoEmpty": "Mostrando 0 a 0 de 0 registros",
      "infoFiltered": "(Filtro de _MAX_ total registros)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ registros",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "No se encontraron coincidencias",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Próximo",
        "previous": "Anterior"
      },
      "aria": {
        "sortAscending": ": Activar orden de columna ascendente",
        "sortDescending": ": Activar orden de columna desendente"
      }
    }
  });

  //Canalizacion 
  $(document).on('click', '#Crear', function () {
    $('#avancesCanalizacion').modal('show');

  });

  $(document).on('click', '#AgregarAvance', function () {
    $('#crearAvance').modal('show');

  });
  $(document).on('click', '#EditarAvance', function () {
    $('#editarAvance').modal('show');
  });
  $(document).on('click', '#CancelarAvance', function () {
    $('#cancelarAvance').modal('show');
  });

  //Caso c-4
  $(document).on('click', '#CancelarCaso', function () {
    $('#cancelarCaso').modal('show');
  });

  $(document).on('click', '#AgregarVictima', function () {
    $('#agregarVictimaModal').modal('show');
  });
  $(document).on('click', '#EditarVictima', function () {
    $('#editarVictimaModal').modal('show');
  });
  $(document).on('click', '#EliminarVictima', function () {
    $('#eliminarVictimaModal').modal('show');
  });

  //Usuarios
  $(document).on('click', '#CrearUsuario', function () {
    $('#crearUsuarioModal').modal('show');
  });




});
