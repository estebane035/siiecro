function _toast(tipo, mensaje, titulo = null){
    toastr.options.escapeHtml       = true; // Acepta html
    toastr.options.closeButton      = true; // Con boton para cerrar
    toastr.options.newestOnTop      = false; // El mas nuevo hasta arriba
    toastr.options.progressBar      = true; // Progress bar
    switch(tipo){
        case "info":
            toastr.info(mensaje, titulo);
            break;
        case "alerta":
            toastr.warning(mensaje, titulo);
            break;
        case "error":
            toastr.error(mensaje, titulo);
            break;
        default:
            toastr.success(mensaje, titulo);
            break;
    }
}

function _cargarTabla(tabla, progreso, urlData, columnas, filas=10, sorting=0, typeSorting='desc'){
    $(tabla).on('preXhr.dt', function ( e, settings, data ) {
            $(progreso).parent(".ibox-content").addClass('sk-loading');
        }).on('xhr.dt', function ( e, settings, json, xhr ) {
            $(progreso).parent(".ibox-content").removeClass('sk-loading');
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

function _recargarTabla(tabla){
    $(tabla).DataTable().ajax.reload(null, false);
}

function _mostrarModal(modal, contenedor, url, callbackExito){
    $.ajax({
        url: url,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(contenido) {
        $(contenedor).html(contenido);
        $(contenedor).on('show.bs.modal', function () {
          callbackExito();
        });

        $(modal).modal('show');
    })
    .fail(function(xhr, ajaxOptions, thrownError) {
        _errorEjecucion(xhr);
    })
    .always(function() {
    });
}

function _inicializarFormulario(formulario, elementoFocus, divNotificacion, callbackExito){
    $(formulario).validate({
        submitHandler: function(form){
            $(form).ajaxSubmit({
                beforeSend: function() {
                    //Desactiva formulario
                    $(divNotificacion).html('');
                    $(formulario).find('input, textarea, button, select').attr('disabled',true);

                    // Si existe un boton de submit le ponemos el loading
                    var btnSubmit   = $(formulario).find('button[type=submit]')[0];
                    if(btnSubmit != undefined && btnSubmit != ""){
                        Ladda.create(btnSubmit).start()
                    };
                },
                success: function(respuesta){
                    // Si existe el boton de submit le quitamos el loading
                    var btnSubmit   = $(formulario).find('button[type=submit]')[0];
                    if(btnSubmit != undefined && btnSubmit != ""){
                        Ladda.create(btnSubmit).stop()
                    };

                    $(formulario).find('input, textarea, button, select').attr('disabled',false);
                    _interpretarRespuesta(respuesta, divNotificacion, callbackExito);
                },
                error: function(xhr, ajaxOptions, thrownError){
                    // Si existe el boton de submit le quitamos el loading
                    var btnSubmit   = $(formulario).find('button[type=submit]')[0];
                    if(btnSubmit != undefined && btnSubmit != ""){
                        Ladda.create(btnSubmit).stop()
                    };

                    _errorEjecucion(xhr, divNotificacion, formulario);
                }
            })
        }
    })
}

function _formularioEnModal(modal, contenedor, url, formulario, elementoFocus, divNotificacion, callbackExito){
    _mostrarModal(
            modal,
            contenedor,
            url,
            function(){
                _inicializarFormulario(
                        formulario,
                        elementoFocus, 
                        divNotificacion, 
                        callbackExito
                    );
            }
        );
}

function _notificationDiv(div,tipo,texto){
    //Tipos error, alerta, exito, info

    if(div === null){
        _toast(tipo, texto);
        return;
    }

    var titulo,icono,clase;
    switch(tipo) {
        case "error":
            titulo="Error";
            icono="frown-o";
            clase='danger';
            break;
        case "alerta":
            titulo="Alert";
            icono="meh-o";
            clase='warning';
            break;
        case "exito":
            titulo="Success";
            icono="smile-o";
            clase='success';
            break;
        default:
            titulo="Info";
            icono="commenting";
            clase='info';
  }

  $(div).html('<div class="alert alert-'+clase+' bordered" role="alert"><button style="margin-right: -11px;margin-top: -7px;" class="close" data-dismiss="alert"></button><p class="pull-left"><strong><i class="fa fa-'+icono+'" aria-hidden="true"></i> '+titulo+':</strong> '+texto+'</p><div class="clearfix"></div></div>');
}

function _errorEjecucion(xhr, notificacion = null, formulario = null){
          var string            =   'Algo ocurrio mal:<br/>';

          if(xhr.status==422){
              var errors        =   xhr.responseJSON.errors;

              $.each(errors, function(index2, item2){
                $.each(item2, function(index3, item3){
                  string        +=  '-' + item3 + "<br/>";
                  i++;
                });
              });

              _notificationDiv(notificacion,'alerta',string);

              if(formulario){
                $(formulario).find('input, textarea, button, select').attr('disabled',false);
              }

              return false;
          }
          try {
            json              =   $.parseJSON(xhr.responseText);
            var i             =   0;
            $.each(xhr.responseJSON, function(index, item){
                string      +=  '- '+item+"<br/>";
                i++;
            });

             _notificationDiv(notificacion,'alerta',string);
              
            if(formulario){
                $(formulario).find('input, textarea, button, select').attr('disabled',false);
            }
          } catch (e) {

            if(formulario){
                $(formulario).find('input, textarea, button, select').attr('disabled',false);
            }

            $('#modal-error-contenido').html(xhr.responseText);
            $('#modal-error').modal('show');
          }
}

function _interpretarRespuesta(respuesta, divNotificacion, callbackExito){
    if(!respuesta.error){
        callbackExito(respuesta);
        _toast("exito", respuesta.mensaje);
    } else{
        _notificationDiv(divNotificacion, "error", respuesta.mensaje);
    }
}

function _ocultarModal(modal, callback){
    $(modal + " .modal-content").removeClass('bounceInRight').addClass('bounceOutRight');
    setTimeout(function() {
        $(modal).modal('hide');
        callback();
    }, 550);
}