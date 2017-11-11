@extends('admin.layout')
@section('content')

	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Crear Puesto de trabajo</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('positions.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>		
		</div>
			
		<div class="col-lg-12">
			<hr>
		</div>

		<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
					<form data-parsley-validate class="form-horizontal" action="{{ route('positions.store') }}" method="POST" autocomplete="off" novalidate="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<small>* Campos obligatorios.</small>
						</div>

						<div class="form-group {{ $errors-> has('tipo') ? 'has-error' : '' }} ">
							<label for="tipo">Tipo *:</label>
							<select name="tipo" id="tipo" class="form-control" required="required">
								<option value="">--elegir--</option>
								@foreach($list_types as $type)
									<option value="{{$type->id_type}}">{{$type->description}}</option>
								@endforeach								
							</select>
							<span class="text-danger">{{ $errors->first('tipo') }}</span>
						</div>
												
						{{--Perio de descripcion = año--}}
						<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
							<label for="descripcion">Descripción *:</label>
							<input type="text" id="descripcion" class="form-control" name="descripcion" placeholder="Jefe de Operaciones" value="{{ old('descripcion') }}" required="required">
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
