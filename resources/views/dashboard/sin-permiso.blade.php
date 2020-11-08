@extends('layouts.dashboard', ['menu' => "dashboard"])

@section('top-body')
	<div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <strong>Dashboard</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
    </div>
@endsection

@section('body')
 	<div class="middle-box text-center">
        <div class="error-desc">
            <i class="fa fa-frown-o fa-5x" aria-hidden="true"></i>
            <br/>
            <h2>Lo sentimos, pero no tienes acceso a esta sección.</h2>
        </div>
    </div>
@endsection