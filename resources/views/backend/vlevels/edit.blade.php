@extends('admin.layout')
@section('content')

<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Editar Estado de Salud</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('level_danger.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>		
		</div>

			{{-- Form para crear nuevoa cuota Igss --}}	
		<div class="col-lg-12">
			<hr>
		</div>

	<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
				
			<form data-parsley-validate class="form-horizontal" action="{{ route ('level_danger.update', $level_edit->id_level) }}" method="POST" autocomplete="off">
			<input name="_method" type="hidden" value="PATCH">
    		{{csrf_field()}}
				
				<div class="form-group">
					<small>* Campos obligatorios.</small>
				</div>
					
				
				{{--descripcion--}}
				<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
					<label for="descripcion">Descripción *:</label>
					<input type="text" id="descripcion" class="form-control" name="descripcion" placeholder="Medicina" value="{{ $level_edit->description }}" required="required">
					<span class="text-danger">{{ $errors->first('descripcion') }}</span>
				</div>
				
				<div class="form-group">
					<span>
	                	<button type="submit" class="btn btn-primary btn-sm pull-right" value="validate">
	                  		<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Guardar
	                	</button>
	              	</span>
				</div>				
			</form>
				
		</div>
	</div> <!-- col-lg-12 -->
</div>

@stop
