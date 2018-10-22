@extends('layouts.app')
@section('title', 'Busqueda Plan Regulador Comunal')
@section('content')
<div class="container">
    <div class="row">
		<div id="map" style="width:auto;height:500px;border:1px solid gray;margin-bottom:20px;">
    </div>
    <div class="row">
    	<div class="col-md-12" >
	    	<form action="{{ route('seachmap') }}" method="POST">
	       		{{ csrf_field() }}
		       	<div class="input-group">
		        <span class="input-group-btn">
		            <button class="btn btn-default" type="submit" title="Buscar por Dirección">
		                <i class="fa fa-search" aria-hidden="true"></i>
		            </button>
		        </span>
		        <input type="text" class="form-control" placeholder="Ingresa Dirección..." title="Buscar por Dirección">
		        </div>
	        </form>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12" >
    		
    	</div>
    </div>
</div>
    
@endsection