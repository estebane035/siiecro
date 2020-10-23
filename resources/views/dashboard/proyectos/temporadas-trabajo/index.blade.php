@extends('layouts.dashboard', ["menu" => "area"])

@section('top-body')
    <div class="col-sm-4">
        <h2>Temporadas de trabajo del proyecto <strong>{{ $proyecto->nombre }}</strong></h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('dashboard.proyectos.index') }}">Proyectos</a>
            </li>
            <li class="active">
                {{ $proyecto->nombre }}
            </li>
            <li class="active">
                <strong>Temporadas de trabajo</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <btn onclick="crear({{ $proyecto->id }});" class="btn btn-primary">Crear nueva temporada de trabajo</btn>
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
                                    <th>Año</th>
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
    <input type="hidden" id="_proyecto_id" value="{{ $proyecto->id }}">
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/proyectos-temporadas-trabajo.js') !!}
@endsection