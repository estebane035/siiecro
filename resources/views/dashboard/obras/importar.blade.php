<div class="modal inmodal" id="modal-importar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras</h4>
                <small class="font-bold">Importar Obras</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.importar'], 'method' => 'PUT', 'id' => 'form-importar', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 div-input required">
                        <label for="archivo">Archivo Excel</label>
                        <input type="file" id="archivo" name="archivo" class="form-control" required autocomplete="off" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>
                </div>

                <div class="row m-t-md" id="div-notificacion-importar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Importar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>