@extends('layouts.dashboard')

@section('top-body')
    <div class="col-sm-12">
        <h2>Detalle de obra <strong>{{ $obra->nombre }}</strong></h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('dashboard.obras.index') }}">Obras</a>
            </li>
            <li class="active">
                <strong>{{ $obra->nombre }}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('body')

@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/obras/obras.js') !!}
@endsection