@extends('layouts.app')
@section('title', 'Busqueda Plan Regulador Comunal')
@section('content')
<div class="container">
    <div class="row">
		<div id="map" style="width:100%;height:100%;border:1px solid gray;margin:0px;position: absolute;">
            <div class="col-md-12" style="position: absolute;up: 10px;z-index:1000;text-align: center;width: 100%;background: white;">  
                <div class="navbar-header " style="">  
                    <strong>Plan Regulador Comunal</strong>
                   <img  src="/img/munilogo.png" alt="" style="height: 40px;margin-right: 10px;">
                </div>
            </div>

            <div class="" style="position: absolute;bottom: 10px;z-index:1000;margin-right: 5px;width: 100%" >
            <form action="{{ route('seachmap') }}" method="POST" class="col-md-12">
                {{ csrf_field() }}
                <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" title="Buscar por Dirección">
                        <i class="fa fa-search" aria-hidden="true"></i> 
                    </button>
                </span>
                <input type="hidden" name="place" value="map">
                <input type="text" name="address" class=" form-control" placeholder="Ingresa direccion a buscar" title="Buscar por Dirección">
                </div>
            </form>
            <div class="col-md-12">
            <form action="/rating_comment" method="post" class="" style="background: white;padding: 5px;margin-top:5px;">
            {{ csrf_field() }}
            Danos tu opinion! ¿Que tan util fue la información?<br><span class="rating"></span>  <strong id="rating_total" style="font-size: 15px;"></strong>  / 5
            <div class="input-group pull-right" >
                <button class="btn btn-primary btn-xs rigth" type="submit"> Enviar</button>
            </div>

            <input type="hidden" name="rating" id="rating_input" value="0" required>
            <div class="input-group" style="width:100%;">
                <textarea name="description" class="form-control"  rows="1" placeholder="Comentanos..." required></textarea>
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

    map2 = new L.map('map').on({
    'resize': setZoomPosition,
    'ready': setZoomPosition
    });

    var osmUrl='http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});
    map2.setView(new L.LatLng(-34.169581,-70.740136),12);
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
    @if(isset($message))
    alert('{{ $message }}');
    @endif
    @endif

    var marker = L.marker([-34.169581,-70.740136],{draggable: true}).addTo(map2).bindPopup('Mueve para obtener el Plan Regulador').openPopup();
    marker.on("dragend", function(ev) {
    var chagedPos = ev.target.getLatLng();
    //this.bindPopup(chagedPos.toString()).openPopup();
    this.bindPopup('Aqui estas!').openPopup();

});
   /** map2._handlers.forEach(function(handler) {
        handler.disable();
    }); **/

    function setZoomPosition () {
    var mapHalfHeight = map2.getSize().y / 6,
        container = map2.zoomControl.getContainer(),
        containerHalfHeight = parseInt(container.offsetHeight / 2),
        containerTop = mapHalfHeight - containerHalfHeight + 'px';
    
    container.style.position = 'absolute';
    container.style.top = containerTop;
}

setZoomPosition();

</script>

@endsection