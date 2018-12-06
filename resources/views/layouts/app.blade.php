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
    <style>
        html {
     height: 100%;
}
body {
    background-color: #FF9900;
    height: 100%;
    margin-top: 0px;
}
.container{
    margin-right: 0 !important;
    margin-left: 0 !important;
}
</style>
</head>
<body>
    <div id="app" >
        @yield('content')
    </div>
@section('scripts')
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.2.3.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
     <script type="text/javascript">
        function groundDetails(zone)
        {
            $.ajax({
            url:'api/ground_details/'+zone,
            headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            success: function(data){
                if(data){
                $('#area_name').html(data.code);
                $('#area_grounds').css('display','block');    
                $('#ground_allowed').html(data.ground_allowed);
                $('#ground_not_allowed').html(data.ground_not_allowed);
                $('#suelos').modal('show');
                }
            }
            });
        }
        </script>
        <!--<script href="{{ asset('js/app.js') }}" type="text/javascript"></script>-->
        @show
</body>
</html>
