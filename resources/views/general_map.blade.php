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

            <div class="" style="position: fixed;bottom: 10px;z-index:401;margin-right: 5px;width: 100%" >

            <form  class="col-md-12">
                <div class="input-group">
                <input type="text" name="address" id="address" class=" form-control" placeholder="Ingresa direccion a buscar" title="Buscar por Dirección">
                <span class="input-group-btn">
                    <a href="javascript:seachAddress($('#address').val())" class="btn btn-primary" title="Buscar por Dirección">
                        <i class="fa fa-search"></i>  Buscar
                    </a>
                </span>
                </div>
            </form>
            <div class="col-md-12">
            <form action="/rating_comment" method="post" class="" style="background: white;padding: 5px;margin-top:5px;">
            {{ csrf_field() }}
            ¿Que tan util fue la información?<br><span class="rating"></span>  <strong id="rating_total" style="font-size: 15px;"></strong>  / 5
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
        <a id="link_document" href="" target="_blank">Ver Documento <i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
      </div>
              <div class="modal-body">
                    <h4><strong>Suelos Permitidos</strong></h4>
                    <span id="ground_allowed" style="font-size: 13px;">
                        
                    </span>
                    <h4><strong>Suelos No Permitidos</strong></h4>
                    <span id="ground_not_allowed" style="font-size: 13px;">
                        
                    </span>
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
    var datalayer;
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

    map2.on('dblclick', function (e){
        //alert(e.latlng.lat);
        marker.setLatLng([ e.latlng.lat, e.latlng.lng]);
        searchPoligon(e.latlng);
    });
    var marker = L.marker([-34.169581,-70.740136],{draggable: true}).addTo(map2).bindPopup('Mueve para obtener el Plan Regulador').openPopup();
    marker.on("dragend", function(ev) {
        var chagedPos = ev.target.getLatLng();
        //this.bindPopup(chagedPos.toString()).openPopup();
        this.bindPopup('Aqui estas!').openPopup();
        searchPoligon(chagedPos);
    });
   /** map2._handlers.forEach(function(handler) {
        handler.disable();
    }); **/

function setZoomPosition () {
    var mapHalfHeight = map2.getSize().y / 6;
    var container = map2.zoomControl.getContainer();
    var containerHalfHeight = parseInt(container.offsetHeight / 2);
    var containerTop = mapHalfHeight - containerHalfHeight + 'px';
    
    container.style.position = 'absolute';
    container.style.top = containerTop;
}

function searchPoligon(loc) {
    $.ajax({
        url: "http://209.97.156.75:3000/polygons/loc/" + loc.lng + "," + loc.lat,
        method: 'GET',
        headers: {
          "Content-Type": "application/json",
          "Access-Control-Allow-Origin": "*"
        },
        success: function(datajson){
            var data = datajson;    
            if(data.response == null){
                marker.bindPopup('No existen planes en este punto!').openPopup();
            }else{
                if(datalayer){
                    datalayer.clearLayers();
                }
                datalayer = L.geoJson(data.response, {
                onEachFeature: function(feature, featureLayer) {
                    if(feature.properties.ZONA_PRC){
                        featureLayer.bindPopup(feature.properties.ZONA_PRC +'<br>'+feature.properties.DESCRIP+'<br><br><button class="btn btn-success btn-sm" onclick="groundDetails(\''+feature.properties.ZONA_PRC+'\');"> Ver Detalle de Suelos </button>');
                    }
                    else{
                        featureLayer.bindPopup('No existen datos en esta zona');
                    }
                }
             }).addTo(map2);
            map2.setView(new L.LatLng(loc.lat,loc.lng),14);
            marker.bindPopup('Haz clic dentro de la zona traslucida para mas informacion!').openPopup();
            }
        }
    });
}

function seachAddress(address) {
        $.ajax({
        url: "http://209.97.156.75:3000/addresses/" + address +", Rancagua",
        method: 'GET',
        headers: {
          "Content-Type": "application/json",
          "Access-Control-Allow-Origin": "*"
        },
        success: function(datajson){
            var data = datajson;    
            if(data.response == null){
                marker.bindPopup('No es posible resolver la Direccion Ingresada!').openPopup();
            }else{
                if(datalayer){
                    datalayer.clearLayers();
                }         
               datalayer = L.geoJson(data.response.features[1], {
                onEachFeature: function(feature, featureLayer) {
                    if(feature.properties.ZONA_PRC){
                        featureLayer.bindPopup(feature.properties.ZONA_PRC +'<br>'+feature.properties.DESCRIP+'<br><br><button class="btn btn-success btn-sm" onclick="groundDetails(\''+feature.properties.ZONA_PRC+'\');"> Ver Detalle de Suelos </button>');
                    }
                    else{
                        featureLayer.bindPopup('No existen datos en esta zona');
                    }
                }
             }).addTo(map2);
            marker.setLatLng([data.response.features[0].geometry.coordinates[1] , data.response.features[0].geometry.coordinates[0]]);
            
            map2.setView(new L.LatLng(data.response.features[0].geometry.coordinates[1] , data.response.features[0].geometry.coordinates[0]),14);
            marker.bindPopup('Haz clic dentro de la zona traslucida para mas informacion!').openPopup();
            }
        }
    });
}

setZoomPosition();

</script>

@endsection