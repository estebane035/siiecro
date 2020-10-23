<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'SII-ECRO'.(isset($titulo) ? $titulo : '') }}</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('font-awesome/css/font-awesome.css')!!}

    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/animate.css')!!}
</head>

<body class="gray-bg body-login">
	@yield('body')
</body>

	<!-- Mainly scripts -->
	{!!Html::script('js/jquery-3.1.1.min.js')!!}
  	{!!Html::script('js/bootstrap.min.js')!!}
</html>