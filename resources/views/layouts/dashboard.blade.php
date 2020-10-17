<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'SII-ECRO'.(isset($titulo) ? " | ".$titulo : "") }}</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('font-awesome/css/font-awesome.css')!!}

    <!-- Toastr style -->
    {!!Html::style('css/plugins/toastr/toastr.min.css')!!}

    <!-- Datepicker -->
    {!!Html::style('css/plugins/datapicker/datepicker3.css')!!}

    <!-- DateRangePicker -->
    {!!Html::style('css/plugins/daterangepicker/daterangepicker-bs3.css')!!}

    <!-- Datetimepicker -->
    {!!Html::style('css/plugins/datetimepicker/bootstrap-datetimepicker.min.css')!!}

    <!-- ClockPicker -->
    {!!Html::style('css/plugins/clockpicker/clockpicker.css')!!}

    <!-- TouchSpin -->
    {!!Html::style('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css')!!}

    <!-- Gritter -->
    {!!Html::style('js/plugins/gritter/jquery.gritter.css')!!}

    {!!Html::style('css/plugins/dataTables/datatables.min.css')!!}

    <!--SUMMERNOTE -->
    {!!Html::style('css/plugins/summernote/summernote.css')!!}

    <!--SELECT 2 -->
    {!!Html::style('css/plugins/select2/select2.min.css')!!}

    <!-- Jasny -->
    {!!Html::style('css/plugins/jasny/jasny-bootstrap.min.css')!!}

    <!-- Morris Chart -->
    {!!Html::style('css/plugins/morris/morris-0.4.3.min.css')!!}

    <!-- Cropper -->
    {!!Html::style('css/plugins/cropper/cropper.min.css')!!}

    <!--Dropzone-->
    {!!Html::style('css/plugins/dropzone/dropzone.css')!!}

    <!--Fullcalendar-->
    {!!Html::style('css/plugins/fullcalendar/fullcalendar.css')!!}

    <!-- Formeo -->
    {!!Html::style('css/plugins/formeo/formeo.min.css')!!}

    <!--iCheck-->
    {!!Html::style('css/plugins/iCheck/custom.css')!!}

    <!--Intro js-->
    {!!Html::style('css/plugins/introjs/introjs.css')!!}

    <!--Cropper js-->
    {!!Html::style('css/plugins/cropper/cropper.min.css')!!}

    <!-- Ladda style -->
    {!!Html::style('css/plugins/ladda/ladda-themeless.min.css')!!}


    <!--OWL-->
    {!!Html::style('css/plugins/owl/owl.carousel.css')!!}
    {!!Html::style('css/plugins/owl/owl.theme.default.css')!!}

    {!!Html::style('css/animate.css')!!}
    {!!Html::style('css/style.css')!!}
</head>

<body class="">
    <div id="wrapper">
        @include('layouts.dashboard-sidebar')
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <img src="{{ asset('/img/logo.jpeg') }}" height="50px" style="margin-top: 5px; margin-left: 5px;">
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                </nav>
            </div>

            <div class="row wrapper border-bottom white-bg page-heading">
                @yield('top-body')
            </div>

            <div class="wrapper wrapper-content">
                @yield('body')
            </div>

            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> ECRO &copy; {{ date('Y') }} - {{ date('Y',strtotime('4 year')) }}
                </div>
            </div>
        </div>
    </div>
</body>
<div id="modal-1"></div>
<div id="modal-2"></div>
<div id="modal-3"></div>

<!-- Mainly scripts -->
  {!!Html::script('js/jquery-3.1.1.min.js')!!}
  {!!Html::script('js/bootstrap.min.js')!!}
  {!!Html::script('js/plugins/metisMenu/jquery.metisMenu.js')!!}
  {!!Html::script('js/plugins/slimscroll/jquery.slimscroll.min.js')!!}

<!-- Flot -->
  {!!Html::script('js/plugins/flot/jquery.flot.js')!!}
  {!!Html::script('js/plugins/flot/jquery.flot.tooltip.min.js')!!}
  {!!Html::script('js/plugins/flot/jquery.flot.spline.js')!!}
  {!!Html::script('js/plugins/flot/jquery.flot.resize.js')!!}
  {!!Html::script('js/plugins/flot/jquery.flot.pie.js')!!}

<!-- Peity -->
  {!!Html::script('js/plugins/peity/jquery.peity.min.js')!!}
  {!!Html::script('js/demo/peity-demo.js')!!}

<!-- Custom and plugin javascript -->
  {!!Html::script('js/inspinia.js')!!}
  {!!Html::script('js/plugins/pace/pace.min.js')!!}

<!-- GITTER -->
  {!!Html::script('js/plugins/gritter/jquery.gritter.min.js')!!}

<!-- Sparkline -->
  {!!Html::script('js/plugins/sparkline/jquery.sparkline.min.js')!!}

<!-- Sparkline demo data  -->
  {!!Html::script('js/demo/sparkline-demo.js')!!}

<!-- ChartJS-->
  {!!Html::script('js/plugins/chartJs/Chart.min.js')!!}

<!-- Morris Chart -->
  {!!Html::script('js/plugins/morris/raphael-2.1.0.min.js')!!}
  {!!Html::script('js/plugins/morris/morris.js')!!}

<!-- Toastr -->
  {!!Html::script('js/plugins/toastr/toastr.min.js')!!}

<!-- VALIDATE -->
  {!!Html::script('js/jquery.validate.min.js')!!}
  {!!Html::script('js/localization/messages_es.js')!!}

<!-- Ajax FORM-->
  {!!Html::script('js/jquery.form.js')!!}

<!--Datatables-->
  {!!Html::script('js/plugins/dataTables/datatables.min.js')!!}
  {!!Html::script('js/plugins/dataTables/español.json')!!}

<!-- Datepicker -->
  {!!Html::script('js/plugins/datapicker/bootstrap-datepicker.js')!!}
  {!!Html::script('js/plugins/datapicker/bootstrap-datepicker.es.js')!!}

<!-- Moment -->
<!-- Date range use moment.js same as full calendar plugin -->
  {!!Html::script('js/plugins/fullcalendar/moment.min.js')!!}

<!-- Datetimepicker -->
  {!!Html::script('js/plugins/datetimepicker/bootstrap-datetimepicker.min.js')!!}

<!-- Clock picker -->
  {!!Html::script('js/plugins/clockpicker/clockpicker.js')!!}

<!-- Date range picker -->
  {!!Html::script('js/plugins/daterangepicker/daterangepicker.js')!!}

<!-- TouchSpin -->
  {!!Html::script('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js')!!}

<!-- SUMMERNOTE -->
  {!!Html::script('js/plugins/summernote/summernote.min.js')!!}

<!-- SELECT 2 -->
  {!!Html::script('js/plugins/select2/select2.full.min.js')!!}

<!-- Full Calendar -->
  {!!Html::script('js/plugins/fullcalendar/fullcalendar.min.js')!!}

<!-- DROPZONE -->
  {!!Html::script('js/plugins/dropzone/dropzone.js')!!}

<!-- Jasny -->
  {!!Html::script('js/plugins/jasny/jasny-bootstrap.min.js')!!}

<!-- JSKnob -->
  {!!Html::script('js/plugins/jsKnob/jquery.knob.js')!!}

<!-- OWL -->
  {!!Html::script('js/plugins/owl/owl.carousel.js')!!}

<!-- iCheck -->
  {!!Html::script('js/plugins/iCheck/icheck.min.js')!!}

<!-- intro js -->
  {!!Html::script('js/plugins/introjs/intro.js')!!}

<!-- cropper js -->
  {!!Html::script('js/plugins/cropper/cropper.min.js')!!}

<!-- Ladda -->
  {!!Html::script('js/plugins/ladda/spin.min.js')!!}
  {!!Html::script('js/plugins/ladda/ladda.min.js')!!}
  {!!Html::script('js/plugins/ladda/ladda.jquery.min.js')!!}


<!-- Comun -->
  {!!Html::script('scripts/dashboard/comun.js')!!}

@yield('scripts')

</html>
