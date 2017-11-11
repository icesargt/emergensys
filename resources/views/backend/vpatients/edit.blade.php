@extends('admin.layout')
@section('content')

<div class="container-fluid">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h3>Editar Diagnostico</h3>	
			</div>

			<div class="col-lg-6">
			<br>
				<a href="{{route('patient_lists.index')}}" class="btn btn-info pull-right"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
			</div>		
		</div>

			{{-- Form para crear nuevoa cuota Igss --}}	
		<div class="col-lg-12">
			<hr>
		</div>

	<div class="col-lg-12">
		<div class="center-block" style="width:50%;">
				
			<form data-parsley-validate class="form-horizontal" action="{{ route ('patient_lists.update', $patient_edit->id_patient) }}" method="POST" autocomplete="off">
			<input name="_method" type="hidden" value="PATCH">
    		{{csrf_field()}}
				
				<div class="form-group">
					<small>* Campos obligatorios.</small>
				</div>

				{{--Descripcion y sintomas--}}
				<div class="form-group {{ $errors->has('dpi') ? 'has-error' : '' }}">
					<label for="dpi">DPI *:</label>
					<input type="number" id="dpi" class="form-control" name="dpi" placeholder="2440 90909 99949" value="{{ $patient_edit->dpi }}" required="required">
					<span class="text-danger">{{ $errors->first('dpi') }}</span>
				</div>

				<div class="form-group {{ $errors->has('primer_nombre') ? 'has-error' : '' }}">
					<label for="primer_nombre">Primer Nombre *:</label>
					<input type="text" id="primer_nombre" class="form-control" name="primer_nombre" placeholder="Primer nombre" value="{{ $patient_edit->first_name }}" required="required">
					<span class="text-danger">{{ $errors->first('primer_nombre') }}</span>
				</div>

				<div class="form-group {{ $errors->has('segundo_nombre') ? 'has-error' : '' }}">
					<label for="segundo_nombre">Segundo Nombre *:</label>
					<input type="text" id="segundo_nombre" class="form-control" name="segundo_nombre" placeholder="Segundo nombre" value="{{ $patient_edit->second_name }}" required="required">
					<span class="text-danger">{{ $errors->first('segundo_nombre') }}</span>
				</div>

				<div class="form-group {{ $errors->has('apellido') ? 'has-error' : '' }}">
					<label for="apellido">Apellido *:</label>
					<input type="text" id="apellido" class="form-control" name="apellido" placeholder="Apellido" value="{{ $patient_edit->last_name }}" required="required">
					<span class="text-danger">{{ $errors->first('apellido') }}</span>
				</div>

				<div class="form-group {{ $errors-> has('genero') ? 'has-error' : '' }} ">
					<label for="genero">Género *:</label>
					<select name="genero" id="genero" class="form-control" required="required">
						<option value="">--género--</option>								
						@foreach($list_gen as $gen => $genero)
							@if($list_gen[$gen] == $patient_edit->sex)
								<option selected="selected" value="{{ $gen }}">{{ $list_gen[$gen] }}</option>
							@else							
								<option value="{{ $gen }}">{{ $list_gen[$gen] }}</option>
							@endif
						@endforeach
					</select>
					<span class="text-danger">{{ $errors->first('genero') }}</span>
				</div>

				{{--Descripcion y sintomas--}}
				<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
					<label for="telefono">Móvil *:</label>
					<input type="number" id="telefono" class="form-control" name="telefono" placeholder="2440 9090" value="{{ $patient_edit->mobile_number }}" required="required">
					<span class="text-danger">{{ $errors->first('telefono') }}</span>
				</div>					

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label for="email">E-mail *:</label>
					<input type="email" id="email" class="form-control" name="email" placeholder="micorreo@midominio.com" value="{{ $patient_edit->email }}" required="required">
					<span class="text-danger">{{ $errors->first('email') }}</span>
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

	{{-- @push('scripts')    
	        <script src="{{asset('/admin/js/date_edit.js')}}"></script>	        
	@endpush --}}

@stop
