@extends('layouts.dashboard', ['menu' => "obras"])

@section('top-body')
    <div class="col-sm-4">
        <h2>Administración de Obras</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Obras</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <button class="btn btn-outline btn-success dim m-t-md pull-right" type="button" onclick="importarObras();">Importar <i class="fa fa-upload"></i></button>
    </div>
@endsection

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-datos">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <th>Tipo bien cultural</th>
                                    <th>Tipo de objeto</th>
                                    <th>Año</th>
                                    <th>Época</th>
                                    <th>Temporalidad</th>
                                    <th>Área</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/obras/obras.js') !!}
@endsection