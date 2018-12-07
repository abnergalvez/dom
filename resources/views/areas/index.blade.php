@extends('layouts.dashboard')
@section('title', 'Lista Areas PRC')
@section('content')

<div class="container-fluid">

          <div class="row">
          	<div class="col-md-12">
          	<a href="/areas/create" class="btn btn-success pull-right"><i class="material-icons">add_circle</i> Crear<div class="ripple-container"></div></a>
          	</div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Areas PRC</h4>
                  <p class="card-category"> Lista de tipos de areas de prc</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      	<thead class=" text-primary">
                        	<tr>
                        		<th>ID</th>
                        		<th>Codigo</th>
                        		<th>Descripcion</th>
                            <th>Documento</th>
                        		<th class="text-right">Acciones</th>
                        	</tr>
 		                </thead>
                      	<tbody>
	                        @forelse($areas as $area)
	                        <tr>
	                          	<td>{{ $area->id }}</td>
	                          	<td>{{ $area->code }}</td>
	                          	<td>{{ $area->description }}</td>
                              <td>
                                @if($area->path)
                                <a href="{{ Storage::url($area->path) }}" target="_blank" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="{{$area->name}}"><i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </a>
                                @endif

                              </td>
	                          	<td>
	                          		<form  class="pull-right" action="/areas/{{ $area->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar la zona')){return false;}" >
        							          	<input type="hidden" name="_method" value="delete">
        							          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        							          	<button class="btn btn-sm btn-danger pull-right" type="submit" title="Eliminar" style="float:left;">
        							            	<i class="material-icons">delete</i>
        							          	</button>
        							        </form>
	                          		<a href="/areas/{{ $area->id }}/edit" class="btn btn-sm btn-info pull-right" title="Editar"><i class="material-icons">edit</i></a>
	                          		<a href="/areas/{{ $area->id }}/show" class="btn btn-sm btn-default pull-right" title="Ver Detalles"><i class="material-icons">remove_red_eye</i></a>

	                          	</td>
	                        </tr>
	                        @empty
	                        <strong>Sin registros aun</strong>
	                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection