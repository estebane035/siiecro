function _cargarTabla(tabla, progreso, urlData, columnas, filas=10, sorting=0, typeSorting='desc')
{
    $(tabla).on('preXhr.dt', function ( e, settings, data ) {
            $(progreso).addClass('sk-loading');
        }).on('xhr.dt', function ( e, settings, json, xhr ) {
            $(progreso).removeClass('sk-loading');
        } ).DataTable({
        ajax: {
            url: urlData,
            dataSrc: 'data'
        },
        drawCallback: function() {
          $('[data-toggle="popover"]').popover();
          $('[data-toggle="tooltip"]').tooltip();
        },
        dom: 'lfrtip',
        processing: false,
        serverSide: true,
        order: [[sorting, typeSorting]],
        columns: columnas,
        pageLength: filas,
        search:{regex: true},
        buttons: {}
      });

      // $(tabla).dataTable().fnFilterOnReturn();
}