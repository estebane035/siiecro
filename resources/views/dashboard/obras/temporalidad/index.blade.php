@extends('layouts.dashboard')

@section('top-body')
    <div class="col-sm-4">
        <h2>Administración de Temporalidades</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Obras | Temporalidad</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <btn onclick="crear();" class="btn btn-primary">Crear nueva Temporalidad</btn>
        </div>
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
                                    <th>ID</th>
                                    <th>Nombre</th>
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
    {!! Html::script('scripts/dashboard/obras/temporalidad.js') !!}
@endsection