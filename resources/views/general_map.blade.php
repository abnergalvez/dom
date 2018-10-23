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
		        <input type="text" class=" form-control" placeholder="Ingresa Dirección..." title="Buscar por Dirección">
		        </div>
	        </form>
        </div>
    </div>
    <hr>
    <div class="row">
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
    	<div class="col-md-12" >
    		
    	</div>

    </div>
</div>
    
@endsection