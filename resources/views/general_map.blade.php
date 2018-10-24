@extends('layouts.app')
@section('title', 'Busqueda Plan Regulador Comunal')
@section('content')
<div class="container">
    <div class="row">
		<div id="map" style="width:auto;height:500px;border:1px solid gray;margin-bottom:20px;">
    </div>
    <div class="row" style="margin-top: -10px;">
    	<div class="col-md-12" >
	    	<form action="{{ route('seachmap') }}" method="POST">
	       		{{ csrf_field() }}
		       	<div class="input-group">
		        <span class="input-group-btn">
		            <button class="btn btn-primary" type="submit" title="Buscar por Dirección">
		                <i class="fa fa-search" aria-hidden="true"></i> Buscar 
		            </button>
		        </span>
                <input type="hidden" name="place" value="map">
		        <input type="text" name="address" class=" form-control" placeholder="Ingresa Dirección..." title="Buscar por Dirección">
		        </div>
	        </form>
        </div>
    </div>
    <hr>
    <div class="row">

    	<div class="col-md-12" >
            <div class="col-md-12" >
    		<form action="/rating_comment" method="post">
			{{ csrf_field() }}
    		¿Que tan util fue la información?<br><span class="rating"></span>  <strong id="rating_total" style="font-size: 15px;"></strong>  / 5
    		<div class="input-group pull-right" >
    			<button class="btn btn-primary btn-sm rigth" type="submit"> Enviar</button>
    		</div>

    		<input type="hidden" name="rating" id="rating_input" value="0">
    		<div class="input-group" style="width:100%;">
    			<textarea name="description" class="form-control"  rows="2" placeholder="Comentanos..." ></textarea>
    		</div>

    		</form>
            </div>
    	</div>


    </div>
</div>

       <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="suelos">
             <div class="modal-dialog" role="document">
            <div class="modal-content">
                         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ZONA : <span class="label label-primary" id="area_name"></span></h4>
      </div>
              <div class="modal-body">
                    <h4>Suelos Permitidos</h4>
                    <span id="ground_allowed"></span>
                    <h4>Suelos No Permitidos</h4>
                    <span id="ground_not_allowed"></span>
              </div>  
            </div>
          </div>
        </div>

@endsection

@section('scripts')
@parent
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="/assets/plugins/leaflet_awesome/leaflet.awesome-markers.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.js"></script>
    <script src="/js/SimpleStarRating.js"></script>

<script>
    var ratings = document.getElementsByClassName('rating');
    for (var i = 0; i < ratings.length; i++) {
        var r = new SimpleStarRating(ratings[i]);
        ratings[i].addEventListener('rate', function(e) {
            $('#rating_total').html(e.detail);
            $('#rating_input').val(e.detail);
            console.log('Rating: ' + e.detail);
        });
    }

    map2 = new L.map('map');
    var osmUrl='http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});
    map2.setView(new L.LatLng(-34.1593915,-70.7738044),12);
    map2.addLayer(osm);
    @if(isset($prc_y_punto))
    var data = {!! $prc_y_punto !!};
    var datalayer = L.geoJson(data ,{
        onEachFeature: function(feature, featureLayer) {
            if(feature.properties.zona_prc){
                featureLayer.bindPopup(feature.properties.zona_prc +'<br>'+feature.properties.descrip+'<br><br><button class="btn btn-success btn-sm" onclick="groundDetails(\''+feature.properties.zona_prc+'\');"> Ver Detalle de Suelos </button>');
            }
            else{
                featureLayer.bindPopup('No existen datos en esta zona');
            }
        }
    }).addTo(map2);
    map2.fitBounds(datalayer.getBounds());
    @else
    alert('{{ $message }}');
    @endif

    map2._handlers.forEach(function(handler) {
        handler.disable();
    });

</script>

@endsection