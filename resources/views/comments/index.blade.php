@extends('layouts.dashboard')
@section('title', 'Lista Areas PRC')
@section('content')

<div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Comentarios Aplicacion</h4>
                  <p class="card-category"> Lista de Puntajes y Comentarios</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      	<thead class=" text-primary">
                        	<tr>
                        		<th>Puntaje (0-5)</th>
                        		<th>Comentario</th>
                        	</tr>
 		                </thead>
                      	<tbody>
	                        @forelse($comments as $comment)
	                        <tr>
	                          	<td><strong class="text-primary">{{ $comment->rating }}</strong> / 5</td>
	                          	<td>{{ $comment->description }}</td>
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