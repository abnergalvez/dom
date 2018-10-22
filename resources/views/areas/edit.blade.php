@extends('layouts.dashboard')
@section('title', 'Editar Area PRC')
@section('content')
<div class="container-fluid">
    <div class="row">
<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Crear Nuevo</h4>
                </div>
                <div class="card-body">
                  <form action="/areas/{{ $area->id }}" method="POST">
                  	  <input type="hidden" name="_method" value="put">
     					{{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Codigo / Nombre *</label>
                          <input class="form-control" name="code" value="{{ $area->code }}" type="text">
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Descripcion *</label>
                          <input class="form-control" name="description" value="{{ $area->description }}" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Suelo Permitido</label>
                          <textarea class="form-control" rows="5" name="ground_allowed">{{ $area->ground_allowed }}</textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Suelo no Permitido</label>
                          <textarea class="form-control" rows="5" name="ground_not_allowed">{{ $area->ground_not_allowed }}</textarea>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Actualizar</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
	</div>
</div>
@endsection