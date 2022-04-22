$(document).ready(function () {

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data(
            'href'));

        $('.debug-url').html('Delete URL: <Strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });

    $('#documentos').DataTable({
        "order": [[1, "asc"]],
        "autoWidth": false,
        "scrollY": "400px",
        "scrollCollapse": true,
        "responsive": {
            details: false
        },
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }

        }
    });

    $('#directorio').DataTable({
        "order": [[1, "asc"]],
        "autoWidth": false,
        "scrollY": "400px",
        "scrollCollapse": true,
        "responsive": {
            details: false
        },
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }

        }
    });

    $('#calendario-table').DataTable({
        "order": [[1, "asc"]],
        "autoWidth": false,
        "scrollY": "400px",
        "scrollCollapse": true,
        "responsive": {
            details: false
        },
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }

        }
    });

});