<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/assets/plugins/leaflet_awesome/leaflet.awesome-markers.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/SimpleStarRating.css">




</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                   <img  class="pull-left" src="/img/munilogo.png" alt="" style="height: 50px;margin-right: 10px;">&nbsp;&nbsp;&nbsp;

                    <a class="navbar-brand" href="{{ url('/') }}"> Plan Regulador Comunal</a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.2.3.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="/assets/plugins/leaflet_awesome/leaflet.awesome-markers.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.js"></script>
    <script src="/js/SimpleStarRating.js"></script>
     <script type="text/javascript">
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
        //var marker = L.marker([-34.1593915,-70.7738044],{draggable: false}).addTo(map2);
        var popup = L.popup();
        
        $.getJSON("map-out.json",function(data){

        // add GeoJSON layer to the map once the file is loaded
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
        });
        function groundDetails(zone)
        {
            alert(zone);
        }
        </script>
        <script href="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
