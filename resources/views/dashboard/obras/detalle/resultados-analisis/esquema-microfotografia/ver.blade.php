<div id="contenedor-esquema-microfotografia">
	<div class="owl-carousel owl-theme" id="carrusel-esquema-microfotografia">
	    @foreach ($esquema_microfotografia as $imagen)
	        <div class="item p-r-sm p-l-sm">
	            <img class="img-responsive" src="{{ asset('img/obras/resultados-analisis-esquema-microfotografia/'.$imagen->imagen) }}" style="height: 150px; width: auto; margin: auto;">
	            <i onclick="eliminarImagenEsquemaResultadoAnalisisMicrofotografia({{ $imagen->id }}, {{ $imagen->resultado_analisis_id }})" class="fa fa-trash texto-rojo fa-lg icono-img" aria-hidden="true" data-placement="left" mi-tooltip="Eliminar"></i>
	        </div>
	    @endforeach
	</div>	
</div>