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
          // $('[data-toggle="tooltip"]').tooltip();
          _inicializarTooltips();
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

  $(div).html(texto);
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

        // Si trae url redirigimos a la url
        if(respuesta.url != undefined){
            location.href   = respuesta.url;
        }
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

function _formAjax(formulario,progress,notificacion,funcionExito){
    $(formulario).validate({
        submitHandler: function(form){
            $(form).ajaxSubmit({
                beforeSend: function() {
                    //Desactiva formulario
                    $(notificacion).html('');
                    $(progress).removeClass('hidden');
                    $(formulario).find('input, textarea, button, select').attr('disabled',true);

                    // Si existe un boton de submit le ponemos el loading
                    var btnSubmit   =   $(formulario).find('button[type=submit]')[0];
                    if(btnSubmit != undefined && btnSubmit != ""){
                        Ladda.create(btnSubmit).start()
                    };
                },
                success: function(respuesta){
                    $(formulario).find('input, textarea, button, select').attr('disabled',false);
                    $(progress).addClass('hidden');

                    var btnSubmit   = $(formulario).find('button[type=submit]')[0];
                    if(btnSubmit != undefined && btnSubmit != ""){
                        Ladda.create(btnSubmit).stop()
                    };

                    _interpretarRespuesta(respuesta, notificacion, funcionExito);
                },
                error: function(xhr, ajaxOptions, thrownError){
                    var btnSubmit   = $(formulario).find('button[type=submit]')[0];
                    if(btnSubmit != undefined && btnSubmit != ""){
                        Ladda.create(btnSubmit).stop()
                    };

                    _errorEjecucion(xhr,notificacion,formulario);
                }
            })
        }
    })
}

function _mostrarFormulario(url,modal,nombreModal,elementoFocus,funcionCargaForm,form,progress,notificacion,funcionExito){
    $.ajax({
        type: "GET",
        url: url,
        success: function(html){
            $(modal).html(html);
            $(modal).on('shown.bs.modal', function () {
              setTimeout(function(){ $(elementoFocus).focus(); }, 500);
            });
            if( $(nombreModal).length<=0){
               $("#modal-error").modal('show');
            }else{
               $(nombreModal).modal('show');
            }
            funcionCargaForm();
            _formAjax(form,progress,notificacion,funcionExito);

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });
        },
        error: function(xhr, ajaxOptions, thrownError){
            _errorEjecucion(xhr);
        }
    })
}

function _inicializarTooltips(){
    // data-toggle="tooltip" data-placement="top" data-original-title="Editar" 

    $('*[mi-tooltip]').each(function() {
        var contenido   =   $(this).attr('mi-tooltip');
        var placement   =   "top";

        if($(this).attr('data-placement') != null){
            placement   =   $(this).attr('data-placement');
        }

        $(this).attr('data-toogle', 'tooltip');
        $(this).attr('data-html', 'true');
        $(this).attr('data-placement', placement);
        $(this).attr('data-original-title', contenido);
        $(this).tooltip();
    });
}